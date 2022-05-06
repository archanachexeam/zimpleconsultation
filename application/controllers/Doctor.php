<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
		parent::__construct();

		$this->load->model('general_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper("url");
		$this->load->library('encryption');
		$this->load->library('pagination');
		$this->load->helper('date');
	}

	public function index(){
		$this->session->set_userdata('site_lang',  "english");
		redirect(base_url().'doctor/login');
	}

	public function login(){

		$data['currentMenu'] = 'Doctor login';
		$data['pageHeading'] = 'Doctor Login';
		$data['pageTitle'] = "Doctor Login | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'Doctor/checklogin';

		$this->load->view('doctor/login/login',$data);
	}

	public function checklogin(){
		$this->form_validation->set_rules('login', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {	
			//var_dump(validation_errors());
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			$data['loginRedirect']=base_url().'Doctor/checklogin';
			
			redirect(base_url().'Doctor/login');
		}else{
			$userName=$this->input->post('login');
			$userPassword=$this->input->post('password');
			$user_record =$this->general_model->check_doctor_login($userName,$userPassword);
			if($user_record == false){
				// throw invalid email id or password error
				$this->session->set_flashdata('registerMessage','Invalid Login or Password',':old:');
				redirect(base_url().'Doctor/login');
			}else{
				$admindata = array(
					'logged_in'					=> true,
					'user_logged_in' 		=> true,
					'logged_in_type'		=> 'doctor',
					'userId' 						=> $user_record['doctorId'],
					'userName'		    	=> $user_record['doctorFName']." ".$user_record['doctorLName']
				);
				
				$this->session->set_userdata('adminAccess',1);
				$this->session->set_userdata($admindata);
				redirect(base_url().'Doctor/dashboard');

			}
		}

	}

	public function dashboard(){
    if($this->session->userdata('logged_in_type') != "doctor") { redirect(base_url().'Doctor/login');	}
    

		redirect(base_url().'Doctor/bookings');

		$data['currentMenu'] = 'dashboard';
		$data['pageHeading'] = 'Dashboard';
		$data['pageTitle'] = "Doctor Dashboard | ".HEX_APPLICATION_NAME;

		$this->load->view('admin/templates/header',$data);
		$this->load->view('doctor/dashboard/dashboard',$data);
		$this->load->view('admin/templates/footer');
	}

	public function logout() {		
		$this->session->sess_destroy();
		session_start();
		session_destroy();
		redirect(base_url().'Doctor/login');
	}	

	public function bookings(){
		if($this->session->userdata('logged_in_type') != "doctor") { redirect(base_url().'Doctor/login');	}

		$doctorId = $this->session->userdata('userId');
		
		if(isset($_POST['consultationDate'])){
			$consultationDate = date('Y-m-d',strtotime(str_replace('/','-',$this->input->post('consultationDate'))));
		}else{
			$consultationDate = date('Y-m-d');
		}

		$where = array(
			'trn_bookings.doctor'						=> $doctorId,
			'trn_bookings.consultationDate'	=> $consultationDate,
			'trn_bookings.isCancelled' 			=> 0
		);
		$data['bookings'] =$this->general_model->get_bookings($where);
		$data['consultationDate'] = $consultationDate;

		$data['currentMenu'] = 'Bookings';
		$data['pageHeading'] = 'Bookings';
		$data['singleHeading'] = 'Bookings';
		$data['pageTitle'] = "Bookings | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'Doctor/bookings';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('doctor/bookings/bookings',$data);
		$this->load->view('admin/templates/footer');
	}

	public function consultation($bookingId = 0){
		if($this->session->userdata('logged_in_type') != "doctor") { redirect(base_url().'doctor/login');	}

		$doctorId = $this->session->userdata('userId');

		$whereSingleCategory = array('trn_bookings.bookingId' => $bookingId);
		$data['singleBooking'] = $this->general_model->get_bookings($whereSingleCategory);

		// Disease List
		$data['diseases'] = $this->general_model->get_list('diseaseId','diseaseName','mst_diseases', array('Select' => 'Select Diseases'), array('isActive' => 1, 'isDeleted' => 0));

		// Medicines List
		$data['medicines'] = $this->general_model->get_combined_list_two_hiphen('medicineId','medicineName','medicineGenericName','mst_basic_medicines', array('Select' => 'Select Medicine'), array('isActive' => 1, 'isDeleted' => 0));

		// Lab Test List
		$data['labtests'] = $this->general_model->get_list('labTestId','labTestName','mst_basic_lab_tests', array('Select' => 'Select Lab Test'), array('isActive' => 1, 'isDeleted' => 0));

		$patient = $data['singleBooking'][0]['patient'];
		$doctor = $doctorId;

		$wherePVme = array(
			'trn_bookings.patient'							=> $patient,
			'trn_bookings.doctor'								=> $doctor,
			'trn_bookings.bookingId !='					=> $bookingId,
			'trn_bookings.consultationDate <'		=> date('Y-m-d'),
			'trn_bookings.bookingStatus'				=> 5
		);

		$data['pvSameDrList'] = $this->general_model->get_bookings($wherePVme);

		$wherePVOth = array(
			'trn_bookings.patient'							=> $patient,
			'trn_bookings.doctor !='						=> $doctor,
			'trn_bookings.bookingId !='					=> $bookingId,
			'trn_bookings.consultationDate <'		=> date('Y-m-d'),
			'trn_bookings.bookingStatus'				=> 5
		);

		$data['pvOthDrList'] = $this->general_model->get_bookings($wherePVOth);

		$data['currentMenu'] = 'Consultation';
		$data['pageHeading'] = 'Consultation';
		$data['singleHeading'] = 'Consultation';
		$data['pageTitle'] = "Consultation | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'Doctor/updateConsultation';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('transactions/bookings/consultation',$data);
		$this->load->view('admin/templates/footer');
	}

	public function updateConsultation(){
		if($this->session->userdata('logged_in_type') != "doctor") { redirect(base_url().'doctor/login');	}

		$this->form_validation->set_rules('bookingId','Booking Id','required|numeric');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'Doctor/Bookings');
		}else{
			$data = array(
				'consultationSummary'	=> $this->input->post('consultationSummary'),
				//'medicines'						=> $this->input->post('medicines'),
				//'labTests'						=> $this->input->post('labTests'),
				'bookingRemarks'			=> $this->input->post('bookingRemarks'),
				'bookingStatus'				=> 5
			);

			$where = array(
				'bookingId'	=> $this->input->post('bookingId')
			);

			// Add Diseases
			$diseases = $this->input->post('disease');
			foreach($diseases as $disease){
				$dataDisease = array(
					'booking'			=> $this->input->post('bookingId'),
					'disease'			=> $disease
				);
				$this->general_model->insert('link_booking_diseases',$dataDisease);
			}

			// Add Medicines
			$medicine = $this->input->post('medicine');
			$dosage = $this->input->post('dosage');
			$period = $this->input->post('period');
			$medicineremarks = $this->input->post('medicineremarks');
			$medicineCount = count($medicine);

			for($i=0;$i<$medicineCount;$i++){
				$dataMedicine = array(
					'booking'				=> $this->input->post('bookingId'),
					'medicine'			=> $medicine[$i],
					'dosage'				=> $dosage[$i],
					'period'				=> $period[$i],
					'remarks'				=> $medicineremarks[$i]
				);
				$this->general_model->insert('link_booking_medicines',$dataMedicine);
			}
			// Add Lab Tests
			$labtest = $this->input->post('labtest');
			$labtestremarks = $this->input->post('labtestremarks');
			$labtestCount = count($labtest);

			for($i=0;$i<$labtestCount;$i++){
				$dataLabtest = array(
					'booking'					=> $this->input->post('bookingId'),
					'labtest'					=> $labtest[$i],
					'remarks'					=> $labtestremarks[$i],
					'resultsFilename'	=> ''
				);
				$this->general_model->insert('link_booking_labtests',$dataLabtest);
			}

			$this->general_model->update('trn_bookings',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'Doctor/Bookings');
		}
	}

	public function viewbookings($bookingId = 0){
		if($this->session->userdata('logged_in_type') != "doctor") { redirect(base_url().'Doctor/login');	}

		$doctorId = $this->session->userdata('userId');

		$where = array('trn_bookings.bookingId' => $bookingId,);
		$data['singleBooking'] =$this->general_model->get_bookings($where);

		$whereDisease = array('booking' => $bookingId, 'link_booking_diseases.isDeleted' => 0);
		$data['bookingDiseases'] =$this->general_model->get_booking_diseases($whereDisease);

		$whereMedicine = array('booking' => $bookingId);
		$data['bookingMedicines'] =$this->general_model->get_booking_medicines($whereMedicine);

		$whereLabtest = array('booking' => $bookingId);
		$data['bookingLabtests'] =$this->general_model->get_booking_labtests($whereLabtest);

		$data['currentMenu'] = 'Bookings';
		$data['pageHeading'] = 'Bookings';
		$data['singleHeading'] = 'Bookings';
		$data['pageTitle'] = "Bookings | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('doctor/bookings/viewBooking',$data);
		$this->load->view('admin/templates/footer');
	}

	public function get_medicine_table(){
		$medicineId = $_POST['medicine'];

		$where = array('medicineId'	=> $medicineId);
		$medicines = $this->general_model->get('mst_basic_medicines', $where);
		$returnString ="";
		if(is_array($medicines)){
			foreach($medicines as $medicine){
				$returnString .="<tr>";
					$returnString .="<td>";
						$returnString .= $medicine['medicineName'];
						$returnString .= "<input type='hidden' name='medicine[]' value='".$medicine['medicineId']."' placeholder='' required='required'>";
					$returnString .="</td>";
					$returnString .="<td>";
						$returnString .= "<input type='text' class='form-control' name='dosage[]' value='' placeholder='' required='required'>";
					$returnString .="</td>";
					$returnString .="<td>";
						$returnString .= "<input type='text' class='form-control' name='period[]' value='' placeholder='In Days' required='required'>";
					$returnString .="</td>";
					$returnString .="<td>";
						$returnString .= "<input type='text' class='form-control' name='medicineremarks[]' value='' placeholder=''>";
					$returnString .="</td>";
					$returnString .="<td>";
						$returnString .= "<button class='btn btn-danger removeMedicineBtn'> X </button>";
					$returnString .="</td>";
				$returnString .="</tr>";
			}
		}

		echo $returnString;
		exit;
	}

	public function get_labtest_table(){
		$labTestId = $_POST['labtest'];

		$where = array('labTestId'	=> $labTestId);
		$labtests = $this->general_model->get('mst_basic_lab_tests', $where);
		$returnString ="";
		if(is_array($labtests)){
			foreach($labtests as $labtest){
				$returnString .="<tr>";
					$returnString .="<td>";
						$returnString .= $labtest['labTestName'];
						$returnString .= "<input type='hidden' name='labtest[]' value='".$labtest['labTestId']."' placeholder='' required='required'>";
					$returnString .="</td>";
					$returnString .="<td>";
						$returnString .= "<input type='text' class='form-control' name='labtestremarks[]' value='' placeholder=''>";
					$returnString .="</td>";
					$returnString .="<td>";
						$returnString .= "<button class='btn btn-danger removeLabtestBtn'> X </button>";
					$returnString .="</td>";
				$returnString .="</tr>";
			}
		}

		echo $returnString;
		exit;
	}

}