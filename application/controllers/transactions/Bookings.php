<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookings extends CI_Controller {

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
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		if(isset($_POST['consultationDate']) && $_POST['consultationDate'] != ""){
			$consultationDate = date('Y-m-d',strtotime(str_replace('/','-',$this->input->post('consultationDate'))));
		}else{
			$consultationDate = date('Y-m-d');
		}

		$where = array(
			'trn_bookings.consultationDate'	=> $consultationDate,
			'trn_bookings.isCancelled' 			=> 0
		);

		if(isset($_POST['doctor']) && $_POST['doctor'] > 0){
			$where['trn_bookings.doctor'] = $this->input->post('doctor');
		}
		$data['bookings'] =$this->general_model->get_bookings($where);

		// Doctors List
		$data['doctors'] = $this->general_model->get_combined_list_two('doctorId','doctorFName','doctorLName','mst_doctors', array('0' => 'All Doctors'), array('isActive' => 1, 'isDeleted' => 0));

		$data['currentMenu'] = 'Bookings';
		$data['pageHeading'] = 'Bookings';
		$data['singleHeading'] = 'Bookings';
		$data['pageTitle'] = "Bookings | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'transactions/Bookings/add';
		$data['loginRedirectSearch']=base_url().'transactions/Bookings';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('transactions/bookings/bookings',$data);
		$this->load->view('admin/templates/footer');
	}

	public function add(){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}


		// Department List
		$data['departments'] = $this->general_model->get_list('departmentId','departmentName','mst_departments', array('Select' => 'Select Department'), array('isActive' => 1, 'isDeleted' => 0));

		// Patients List
		$data['patients'] = $this->general_model->get_combined_list_four('patientId','patientOPNumber','patientFName','patientLName','patientPhone','mst_patients', array('Select' => 'Select Patient'), array('isActive' => 1, 'isDeleted' => 0));



		$data['currentMenu'] = 'Bookings';
		$data['pageHeading'] = 'Bookings';
		$data['singleHeading'] = 'Bookings';
		$data['pageTitle'] = "Bookings | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'transactions/Bookings/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('transactions/bookings/addBooking',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('consultationDate','Consultation Date','required');
		$this->form_validation->set_rules('patient','Patient','required|numeric');
		$this->form_validation->set_rules('doctor','Doctor','required|numeric');
		$this->form_validation->set_rules('bookingSlot','Booking Slot','required|numeric');


		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'transactions/Bookings');
		}else{

			$consultationDate = date('Y-m-d',strtotime(str_replace('/','-',$this->input->post('consultationDate'))));

			$whereToken = array(
				'consultationDate'	=> $consultationDate,
				'doctor'						=> $this->input->post('doctor')
			);

			$tokenNumber = $this->general_model->getmax('tokenNumber','trn_bookings',$whereToken);

			$data = array(
				'bookingDate'				=> date('Y-m-d'),
				'consultationDate'	=> $consultationDate,
				'patient'						=> $this->input->post('patient'),
				'doctor'						=> $this->input->post('doctor'),
				'tokenNumber'				=> $tokenNumber,
				'bookingSlot'				=> $this->input->post('bookingSlot'),
				'isOnline'					=> 0,
				'consulationFee'		=> $this->input->post('consulationFee'),
				'paymentStatus'			=> $this->input->post('paymentStatus'),
				'bookingStatus'			=> 2
			);
			$this->general_model->insert('trn_bookings',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'transactions/Bookings');
		}
	}

	public function view($bookingId = 0){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice" && $this->session->userdata('logged_in_type') != "doctor") { redirect(base_url().'admin/login');	}


		$whereSingleCategory = array('trn_bookings.bookingId' => $bookingId);
		$data['singleBooking'] =$this->general_model->get_bookings($whereSingleCategory);

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
		$this->load->view('transactions/bookings/viewBooking',$data);
		$this->load->view('admin/templates/footer');
	}

	public function edit($bookingId = 0){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}


		$whereSingleCategory = array('trn_bookings.bookingId' => $bookingId);
		$data['singleBooking'] =$this->general_model->get_bookings($whereSingleCategory);

		$data['currentMenu'] = 'Bookings';
		$data['pageHeading'] = 'Bookings';
		$data['singleHeading'] = 'Bookings';
		$data['pageTitle'] = "Bookings | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'transactions/Bookings/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('transactions/bookings/editBooking',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('consultationDate','Consultation Date','required');
		$this->form_validation->set_rules('patient','Patient','required|numeric');
		$this->form_validation->set_rules('doctor','Doctor','required|numeric');
		$this->form_validation->set_rules('bookingSlot','Booking Slot','required|numeric');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'transactions/Bookings');
		}else{
			$data = array(
				'bookingDate'				=> date('Y-m-d'),
				'consultationDate'	=> $this->input->post('consultationDate'),
				'patient'						=> $this->input->post('patient'),
				'doctor'						=> $this->input->post('doctor'),
				'tokenNumber'				=> $this->input->post('tokenNumber'),
				'bookingSlot'				=> $this->input->post('bookingSlot'),
				'consulationFee'		=> $this->input->post('consulationFee')
			);

			$where = array(
				'bookingId'	=> $this->input->post('bookingId')
			);
			$this->general_model->update('trn_bookings',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'transactions/Bookings');
		}
	}

	public function consultation($bookingId = 0){
		if($this->session->userdata('logged_in_type') != "doctor") { redirect(base_url().'doctor/login');	}


		$whereSingleCategory = array('trn_bookings.bookingId' => $bookingId);
		$data['singleBooking'] = $this->general_model->get_bookings($whereSingleCategory);

		// Disease List
		$data['diseases'] = $this->general_model->get_list('diseaseId','diseaseName','mst_diseases', array('Select' => 'Select Diseases'), array('isActive' => 1, 'isDeleted' => 0));

		// Medicines List
		$data['medicines'] = $this->general_model->get_combined_list_two('medicineId','medicineName','medicineGenericName','mst_basic_medicines', array('Select' => 'Select Medicine'), array('isActive' => 1, 'isDeleted' => 0));

		// Lab Test List
		$data['labtests'] = $this->general_model->get_list('labTestId','labTestName','mst_basic_lab_tests', array('Select' => 'Select Lab Test'), array('isActive' => 1, 'isDeleted' => 0));


		$patient = $data['singleBooking'][0]['patient'];
		$doctor = $data['singleBooking'][0]['doctor'];

		$wherePVme = array(
			'patient'							=> $patient,
			'doctor'							=> $doctor,
			'bookingId !='				=> $bookingId,
			//'consultationDate <'	=> date('Y-m-d'),
			'bookingStatus'				=> 5
		);

		$data['pvSameDrList'] = $this->general_model->get_bookings($wherePVme);

		$wherePVOth = array(
			'patient'							=> $patient,
			'doctor !='						=> $doctor,
			'bookingId !='				=> $bookingId,
			'consultationDate <'	=> date('Y-m-d'),
			'bookingStatus'				=> 5
		);

		$data['pvOthDrList'] = $this->general_model->get_bookings($wherePVOth);

		$data['currentMenu'] = 'Consultation';
		$data['pageHeading'] = 'Consultation';
		$data['singleHeading'] = 'Consultation';
		$data['pageTitle'] = "Consultation | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'transactions/Bookings/updateConsultation';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('transactions/bookings/consultation',$data);
		$this->load->view('admin/templates/footer');
	}

	public function updateConsultation(){
		if($this->session->userdata('logged_in_type') != "doctor") { redirect(base_url().'doctor/login');	}

		$this->form_validation->set_rules('bookingId','Booking Id','required|numeric');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'transactions/Bookings');
		}else{
			$data = array(
				'consultationSummary'	=> $this->input->post('consultationSummary'),
				'medicines'						=> $this->input->post('medicines'),
				'labTests'						=> $this->input->post('labTests'),
				'bookingRemarks'			=> $this->input->post('bookingRemarks'),
				'consultationTime'		=> date('Y-m-d H:i:s'),
				'bookingStatus'				=> 5
			);

			$where = array(
				'bookingId'	=> $this->input->post('bookingId')
			);
			$this->general_model->update('trn_bookings',$data, $where);

			

			
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'transactions/Bookings');
		}
	}

	public function cancel($trn_bookings = 0){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$data = array(
			'bookingStatus'	=>  4,
			'isCancelled'		=>	1
		);
		$where = array('trn_bookings' => $trn_bookings);
		$this->general_model->update('trn_bookings',$data, $where);
		$this->session->set_flashdata('registerMessage','Cancelled Successfully',':old:');
		redirect(base_url().'transactions/Bookings');
	}


	function get_doctors_list(){
		$department = $_POST['department'];
		$consultationDate = date('Y-m-d',strtotime(str_replace('/','-',$_POST['consultationDate'])));

		$where = array(
			'mst_doctors.doctorDepartment'	=> $department,
			'mst_doctors.isActive'		=> 1,
			'mst_doctors.isDeleted'		=> 0
		);

		$doctors = $this->general_model->get('mst_doctors',$where);

		$returnString = "<select name='doctor' id='doctor' class='form-control select2-show-search'><option value='select'>Select Doctor</option>";
		if(is_array($doctors)){
			foreach($doctors as $doctor){
				$returnString .="<option value='".$doctor['doctorId']."'>".$doctor['doctorFName'].''.$doctor['doctorLName']."</option>";
			}
		}
		$returnString .= "</select>";
		echo $returnString;
		exit;
	}

	function get_slots(){
		$doctor = $_POST['doctor'];
		$weekDay = date('l',strtotime(str_replace('/','-',$_POST['consultationDate'])));
		$consultationDate = date('Y-m-d',strtotime(str_replace('/','-',$_POST['consultationDate'])));

		$whereLeaveCheck = array(
			'doctor'		=> $doctor,
			'leaveDate'	=> $consultationDate,
			'isDeleted'	=> 0
		);

		$leaveCheckCount = $this->general_model->getCount('trn_doctor_leaves',$whereLeaveCheck);

		if($leaveCheckCount == 0){
			$where = array(
				'doctor'	=> $doctor,
				'day'			=> $weekDay
			);

			$slots = $this->general_model->get_available_slots($where);
			//echo $this->db->last_query();exit;
			$returnString = "<select name='bookingSlot' id='bookingSlot' class='form-control select2-show-search'><option value='select'>Select Slot</option>";
			if(is_array($slots)){
				foreach($slots as $slot){
					$whereCount = array(
						'consultationDate'		=> $consultationDate,
						'bookingSlot'					=> $slot['doctorSlotId']
					);
					$maxTokens = $slot['maxTokens'];
					$usedTokens = $this->general_model->getCount('trn_bookings',$whereCount);
					$availableTokens = $maxTokens - $usedTokens;
					if($availableTokens > 0){
						$returnString .="<option value='".$slot['doctorSlotId']."'>".$slot['slotName']."</option>";
					}
					
				}
			}
			$returnString .= "</select>";
		}else{
			$returnString = "<select name='bookingSlot' id='bookingSlot' class='form-control select2-show-search'><option value='select'>Doctor is on Leave</option></select>";
		}
		
		echo $returnString;
		exit;
	}

	function get_available_tokens(){
		$doctor = $_POST['doctor'];
		$doctorSlotId = $_POST['slotId'];
		$consultationDate = date('Y-m-d',strtotime(str_replace('/','-',$_POST['consultationDate'])));
		$weekDay = date('l',strtotime(str_replace('/','-',$_POST['consultationDate'])));

		$whereSlots = array('doctorSlotId'	=> $doctorSlotId);
		$slots = $this->general_model->get_available_slots($whereSlots);
		$maxTokens = $slots[0]['maxTokens'];

		$whereCount = array(
			'consultationDate'		=> $consultationDate,
			'bookingSlot'					=> $doctorSlotId
		);

		$usedTokens = $this->general_model->getCount('trn_bookings',$whereCount);
		$availableTokens = $maxTokens - $usedTokens;

		echo $availableTokens;
		exit;
	}

	function get_consultation_fee(){
		$doctor = $_POST['doctor'];

		$where = array('doctorId'	=> $doctor);
		$doctors = $this->general_model->get('mst_doctors',$where);

		echo $doctors[0]['doctorConsultationFee'];
		exit;
	}

	function makePaid(){
		$bookingId = $_POST['bookingId'];
		$data = array('paymentStatus' => 1);
		$where = array('bookingId'	=> $bookingId);
		$this->general_model->update('trn_bookings',$data,$where);

		echo 1;
		exit;
	}

	function makeNotPaid(){
		$bookingId = $_POST['bookingId'];
		$data = array('paymentStatus' => 0);
		$where = array('bookingId'	=> $bookingId);
		$this->general_model->update('trn_bookings',$data,$where);

		echo 1;
		exit;
	}



}
