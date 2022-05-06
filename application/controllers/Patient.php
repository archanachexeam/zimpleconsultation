<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

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
		redirect(base_url().'Patient/login');
	}

	

	public function login(){

		$data['currentMenu'] = 'Patient login';
		$data['pageHeading'] = 'Patient Login';
		$data['pageTitle'] = "Patient Login | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'Patient/checklogin';
		$data['loginRedirectRegister']=base_url().'Patient/register';

		$this->load->view('patient/login/login',$data);
	}

	public function checklogin(){
		$this->form_validation->set_rules('login', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {	
			//var_dump(validation_errors());
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			$data['loginRedirect']=base_url().'Patient/checklogin';
			
			redirect(base_url().'Patient/login');
		}else{
			$userName=$this->input->post('login');
			$userPassword=$this->input->post('password');
			$user_record =$this->general_model->check_user_login($userName,$userPassword);
			if($user_record == false){
				// throw invalid email id or password error
				$this->session->set_flashdata('registerMessage','Invalid Login or Password',':old:');
				redirect(base_url().'Patient/login');
			}else{
				if($user_record['isOTPVerified'] == 0){
					$admindata = array(
						'logged_in'					=> true,
						'user_logged_in' 		=> true,
						'logged_in_type'		=> 'user',
						'userId' 						=> $user_record['userId'],
						'userName'		    	=> $user_record['userFName']." ".$user_record['userLName']
					);
					
					$this->session->set_userdata('tempUserId',$user_record['userId']);
					$this->session->set_flashdata('registerMessage','OTP Not verified',':old:');
					redirect(base_url().'Patient/otp');
				}else if($user_record['isActive'] == 0){
					$this->session->set_flashdata('registerMessage','User is inactive',':old:');
					redirect(base_url().'Patient/login');
				}else{
					$admindata = array(
						'logged_in'					=> true,
						'user_logged_in' 		=> true,
						'logged_in_type'		=> 'user',
						'userId' 						=> $user_record['userId'],
						'userName'		    	=> $user_record['userFName']." ".$user_record['userLName']
					);
					
					$this->session->set_userdata('adminAccess',1);
					$this->session->set_userdata($admindata);
					redirect(base_url().'Patient/dashboard');
				}
			}
		}

	}

	public function register(){

		$data['currentMenu'] = 'Patient Registration';
		$data['pageHeading'] = 'Patient Registration';
		$data['pageTitle'] = "Patient Registration | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'Patient/addUser';
		$data['loginRedirectLogin']=base_url().'Patient/login';

		$this->load->view('patient/login/register',$data);
	}

	public function addUser(){
		$this->form_validation->set_rules('userFName','First Name','required');
		$this->form_validation->set_rules('userLName','Last Name','required');
		$this->form_validation->set_rules('userPhone','Contact Number','required|is_unique[mst_users.userPhone]');
		$this->form_validation->set_rules('userEmail','Email Address','required|valid_email|is_unique[mst_users.userEmail]');
		$this->form_validation->set_rules('userLogin','Username','required|is_unique[mst_users.userLogin]');
		$this->form_validation->set_rules('userPassword','Password','required');


		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'Patient/register');
		}else{

			$otp = "123456";

			$data = array(
				'userFName'						=> $this->input->post('userFName'),
				'userLName'						=> $this->input->post('userLName'),
				'userPhone'						=> $this->input->post('userPhone'),
				'userEmail'						=> $this->input->post('userEmail'),
				'userLogin'						=> $this->input->post('userLogin'),
				'userPassword'				=> md5($this->input->post('userPassword')),
				'userOTP'							=> $otp,
				'userOTPGenDateTime'	=> date('Y-m-d H:i:s')
			);
			$userId = $this->general_model->insert('mst_users',$data);
			$this->session->set_userdata('tempUserId',$userId);
			//$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			
			redirect(base_url().'Patient/otp');
		}
	}

	public function otp(){

		$data['userId'] = $this->session->userdata('tempUserId');

		$data['currentMenu'] = 'Patient Register';
		$data['pageHeading'] = 'Patient Register';
		$data['pageTitle'] = "Patient Login | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'Patient/otpVerification';

		$this->load->view('patient/login/otpVerification',$data);
	}

	public function otpVerification(){
		$this->form_validation->set_rules('userId','User ID','required|numeric');
		$this->form_validation->set_rules('userOTP','OTP','required|numeric');


		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'Patient/otp');
		}else{

			$where = array('userId' => $this->session->userdata('tempUserId'));
			$userDetails = $this->general_model->get('mst_users', $where);

			$userOTPGenDateTime = $userDetails[0]['userOTPGenDateTime'];
			$userOTP = $userDetails[0]['userOTP'];
			$otp = $this->input->post('userOTP');

			$start_date = new DateTime($userOTPGenDateTime);
			$since_start = $start_date->diff(new DateTime());

			if($userOTP == $otp){
				if($since_start->i < 5){
					$data = array(
						'isOTPVerified'	=> 1,
						'isActive'			=> 1
					);
					$whereUpdate = array('userId'	=> $this->session->userdata('tempUserId'));
					$this->general_model->update('mst_users',$data,$whereUpdate);

					$dataInsert = array(
						'patientFName'		=> $userDetails[0]['userFName'],
						'patientLName'		=> $userDetails[0]['userLName'],
						'patientPhone'		=> $userDetails[0]['userPhone'],
						'patientEmail'		=> $userDetails[0]['userEmail'],
						'isActive'				=> 1,
						'isOTPVerified'		=> 1,
					);
					$patientId = $this->general_model->insert('mst_patients',$dataInsert);
					$dataLink = array(
						'user'			=> $this->session->userdata('tempUserId'),
						'patient'		=> $patientId
					);
					$this->general_model->insert('link_user_patient',$dataLink);
					$this->session->set_flashdata('registerMessage',"OTP verification completed",':old:');
					redirect(base_url().'Patient/login');
				}else{
					$this->session->set_flashdata('registerMessage',"OTP expired",':old:');
					redirect(base_url().'Patient/otp');
				}
			}else{
				$this->session->set_flashdata('registerMessage',"OTP Invalid",':old:');
				redirect(base_url().'Patient/otp');
			}
		}
	}

	public function dashboard(){
    if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}
    
    $userId = $this->session->userdata('userId');

		$where = array('isDeleted' => 0, 'isActive' => 1);
    $data['departmentCount'] = $this->general_model->getCount('mst_departments',$where);
    $data['doctorsCount'] = $this->general_model->getCount('mst_doctors',$where);


    $wherePatients = array('user' => $userId, 'isDeleted' => 0);
    $data['familyMembersCount'] = $this->general_model->getCount('link_user_patient',$wherePatients);

    $linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients)){
			foreach($linkedPatients as $linkedPatient){
				array_push($patients, $linkedPatient['patient']);
			}
			$where = array('trn_bookings.isCancelled' => 0);
			$data['bookingsCount'] =$this->general_model->get_bookings_count($where, null, null, null, null, null, null, 'patient', $patients);
			$data['bookings'] =$this->general_model->get_bookings($where, null, null, null, null, null, null, 'patient', $patients);
		}else{
			$data['bookingsCount'] = 0;
			$data['bookings'] = array();
		}
		

		$data['currentMenu'] = 'dashboard';
		$data['pageHeading'] = 'Dashboard';
		$data['pageTitle'] = "Dashboard | ".HEX_APPLICATION_NAME;

		$this->load->view('admin/templates/header',$data);
		$this->load->view('patient/dashboard/dashboard',$data);
		$this->load->view('admin/templates/footer');
	}

	public function logout() {		
		$this->session->sess_destroy();
		session_start();
		session_destroy();
		redirect(base_url().'Patient/login');
	}	

	public function bookings(){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}

		$userId = $this->session->userdata('userId');
		//$userId = 1;
		$wherePatients = array('user' => $userId, 'isDeleted' => 0);

		$linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients)){
			foreach($linkedPatients as $linkedPatient){
				array_push($patients, $linkedPatient['patient']);
			}
			$where = array('trn_bookings.isCancelled' => 0);
			$data['bookings'] =$this->general_model->get_bookings($where, null, null, null, null, null, null, 'patient', $patients);
		}else{
			$data['bookings'] = array();
		}

		

		$data['currentMenu'] = 'My Bookings';
		$data['pageHeading'] = 'My Bookings';
		$data['singleHeading'] = 'My Bookings';
		$data['pageTitle'] = "My Bookings | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'Patient/searchDoctor';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('patient/bookings/bookings',$data);
		$this->load->view('admin/templates/footer');
	}

	public function newbooking(){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}

		$userId = $this->session->userdata('userId');
		$userId = 1;
		$wherePatients = array('user' => $userId, 'isDeleted' => 0);

		$linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients)){
			foreach($linkedPatients as $linkedPatient){
				array_push($patients, $linkedPatient['patient']);
			}
			// Patients List
			$data['patients'] = $this->general_model->get_combined_list_four('patientId','patientOPNumber','patientFName','patientLName','patientPhone','mst_patients', array('Select' => 'Select Patient'), array('isActive' => 1, 'isDeleted' => 0),'patientId', $patients);
		}else{
			$data['patients'] = array();
		}

		// Department List
		$data['departments'] = $this->general_model->get_list('departmentId','departmentName','mst_departments', array('Select' => 'Select Department'), array('isActive' => 1, 'isDeleted' => 0));

		



		$data['currentMenu'] = 'Bookings';
		$data['pageHeading'] = 'Bookings';
		$data['singleHeading'] = 'Bookings';
		$data['pageTitle'] = "Bookings | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'Patient/addbooking';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('transactions/bookings/addBooking',$data);
		$this->load->view('admin/templates/footer');
	}

	public function addbooking(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('consultationDate','Consultation Date','required');
		$this->form_validation->set_rules('patient','Patient','required|numeric');
		$this->form_validation->set_rules('doctor','Doctor','required|numeric');
		$this->form_validation->set_rules('bookingSlot','Booking Slot','required|numeric');


		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'Patient/newbooking');
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
				'isOnline'					=> 1,
				'consulationFee'		=> $this->input->post('consulationFee'),
				'paymentStatus'			=> 0,
				'bookingStatus'			=> 2
			);
			$this->general_model->insert('trn_bookings',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'Patient/bookings');
		}
	}

	public function viewbookings($bookingId = 0){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}

		$userId = $this->session->userdata('userId');
		//$userId = 1;
		$wherePatients = array('user' => $userId, 'isDeleted' => 0);

		$linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients)){
			foreach($linkedPatients as $linkedPatient){
				array_push($patients, $linkedPatient['patient']);
			}
			$where = array('trn_bookings.bookingId' => $bookingId,);
			$data['singleBooking'] =$this->general_model->get_bookings($where, null, null, null, null, null, null, 'patient', $patients);

			$whereDisease = array('booking' => $bookingId, 'link_booking_diseases.isDeleted' => 0);
			$data['bookingDiseases'] =$this->general_model->get_booking_diseases($whereDisease);

			$whereMedicine = array('booking' => $bookingId);
			$data['bookingMedicines'] =$this->general_model->get_booking_medicines($whereMedicine);

			$whereLabtest = array('booking' => $bookingId);
			$data['bookingLabtests'] =$this->general_model->get_booking_labtests($whereLabtest);
		}else{
			$data['singleBooking'] = array();
			$data['bookingDiseases'] = array();
			$data['bookingMedicines'] = array();
			$data['bookingLabtests'] = array();
		}




		$data['currentMenu'] = 'Bookings';
		$data['pageHeading'] = 'Bookings';
		$data['singleHeading'] = 'Bookings';
		$data['pageTitle'] = "Bookings | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('patient/bookings/viewBooking',$data);
		$this->load->view('admin/templates/footer');
	}

	public function viewMedicineList($bookingId = 0){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}

		$userId = $this->session->userdata('userId');
		//$userId = 1;
		$wherePatients = array('user' => $userId, 'isDeleted' => 0);

		$linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients)){
			foreach($linkedPatients as $linkedPatient){
				array_push($patients, $linkedPatient['patient']);
			}
			$where = array('trn_bookings.bookingId' => $bookingId,);
			$data['singleBooking'] =$this->general_model->get_bookings($where, null, null, null, null, null, null, 'patient', $patients);
			$whereMedicine = array('booking' => $bookingId);
			$data['bookingMedicines'] =$this->general_model->get_booking_medicines($whereMedicine);
		}else{
			$data['singleBooking'] = array();
			$data['bookingMedicines'] = array();
		}

		$data['settings'] = $this->general_model->get('adm_settings');

		$data['currentMenu'] = 'Bookings';
		$data['pageHeading'] = 'Bookings';
		$data['singleHeading'] = 'Bookings';
		$data['pageTitle'] = "Bookings | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('patient/bookings/viewMedicineList',$data);
		$this->load->view('admin/templates/footer');
	}

	public function viewLabTestList($bookingId = 0){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}

		$userId = $this->session->userdata('userId');
		//$userId = 1;
		$wherePatients = array('user' => $userId, 'isDeleted' => 0);

		$linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients)){
			foreach($linkedPatients as $linkedPatient){
				array_push($patients, $linkedPatient['patient']);
			}
			$where = array('trn_bookings.bookingId' => $bookingId,);
			$data['singleBooking'] =$this->general_model->get_bookings($where, null, null, null, null, null, null, 'patient', $patients);
			$whereLabtest = array('booking' => $bookingId);
			$data['bookingLabtests'] =$this->general_model->get_booking_labtests($whereLabtest);
		}else{
			$data['singleBooking'] = array();
			$data['bookingLabtests'] = array();
		}

		$data['settings'] = $this->general_model->get('adm_settings');

		$data['currentMenu'] = 'Bookings';
		$data['pageHeading'] = 'Bookings';
		$data['singleHeading'] = 'Bookings';
		$data['pageTitle'] = "Bookings | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('patient/bookings/viewLabTestList',$data);
		$this->load->view('admin/templates/footer');
	}

	public function searchDoctor(){
		if($this->session->userdata('logged_in_type') != "user") 
		{ 
			redirect(base_url().'Patient/login');
			}

		$userId = $this->session->userdata('userId');
		//$userId = 1;
		$wherePatients = array('user' => $userId, 'isDeleted' => 0);

		$linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients))
		{
			foreach($linkedPatients as $linkedPatient)
			{
				array_push($patients, $linkedPatient['patient']);
			}
			// Patients List
			$data['patients'] = $this->general_model->get_combined_list_four('patientId','patientOPNumber',
			'patientFName','patientLName','patientPhone','mst_patients',
			 array('Select' => 'Select Patient'), array('isActive' => 1, 'isDeleted' => 0),'patientId', $patients);
		}else{
			$data['patients'] = array();
		}

		// Department List
		$data['departments'] = $this->general_model->get_list('departmentId','departmentName','mst_departments', array('Select' => 'Select Department'), array('isActive' => 1, 'isDeleted' => 0));

		$data['loginRedirect']=base_url().'Patient/insertBooking';

		$data['currentMenu'] = 'Search Doctor';
		$data['pageHeading'] = 'Search Doctor';
		$data['singleHeading'] = 'Search Doctor';
		$data['pageTitle'] = "Search Doctor | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('patient/bookings/searchdoctor',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insertBooking(){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}

		$this->form_validation->set_rules('consultationDate','Consultation Date','required');
		$this->form_validation->set_rules('patient','Patient','required|numeric');
		$this->form_validation->set_rules('doctor','Doctor','required|numeric');
		$this->form_validation->set_rules('bookingSlot','Booking Slot','required|numeric');


		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'Patient/searchDoctor');
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
				'isOnline'					=> 1,
				'consulationFee'		=> $this->input->post('consulationFee'),
				'paymentStatus'			=> 0,
				'bookingStatus'			=> 2
			);
			$this->general_model->insert('trn_bookings',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'Patient/bookings');
		}
	}

	public function familymembers(){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}

		$userId = $this->session->userdata('userId');
		//$userId = 1;
		$wherePatients = array('link_user_patient.user' => $userId, 'link_user_patient.isDeleted' => 0);
		$data['patients'] = $this->general_model->get_linked_patients($wherePatients);

		$data['loginRedirect']=base_url().'Patient/newFamilyMember';
		$data['loginRedirectPatient']=base_url().'Patient/newPatient';

		$data['currentMenu'] = 'Family Members';
		$data['pageHeading'] = 'Family Members';
		$data['singleHeading'] = 'Family Members';
		$data['pageTitle'] = "Family Members | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('patient/familymembers/familymembers',$data);
		$this->load->view('admin/templates/footer');
	}

	public function newFamilyMember(){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}
		
		$data['loginRedirect']=base_url().'Patient/addFamilyMember';

		$data['currentMenu'] = 'Add Family Members';
		$data['pageHeading'] = 'Add Family Members';
		$data['singleHeading'] = 'Add Family Members';
		$data['pageTitle'] = "Add Family Members | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('patient/familymembers/add',$data);
		$this->load->view('admin/templates/footer');
	}

	public function newPatient(){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}

		$userId = $this->session->userdata('userId');
		

		$data['loginRedirect']=base_url().'Patient/addPatient';

		$data['currentMenu'] = 'Patients';
		$data['pageHeading'] = 'Patients';
		$data['singleHeading'] = 'Patients';
		$data['pageTitle'] = "Patients | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('patient/patient/newPatient',$data);
		$this->load->view('admin/templates/footer');
	}

	public function addPatient(){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}

		$this->form_validation->set_rules('patientFName','First Name','required');
		$this->form_validation->set_rules('patientLName','Last Name','required');
		$this->form_validation->set_rules('patientPhone','Contact Number','required');
		$this->form_validation->set_rules('patientEmail','Email Address','required|valid_email');
		$this->form_validation->set_rules('patientAddress1','Address (Line 1)','required');
		$this->form_validation->set_rules('patientAddress2','Address (Line 2)','required');
		$this->form_validation->set_rules('patientCity','City','required');
		$this->form_validation->set_rules('patientState','State','required');


		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'Patient/familymembers');
		}else{

			$data = array(
				'patientFName'						=> $this->input->post('patientFName'),
				'patientLName'						=> $this->input->post('patientLName'),
				'patientPhone'						=> $this->input->post('patientPhone'),
				'patientEmail'						=> $this->input->post('patientEmail'),
				'patientAddress1'					=> $this->input->post('patientAddress1'),
				'patientAddress2'					=> $this->input->post('patientAddress2'),
				'patientCity'							=> $this->input->post('patientCity'),
				'patientState'						=> $this->input->post('patientState'),
				'isActive'								=> 1
			);
			$patientId = $this->general_model->insert('mst_patients',$data);

			$dataLink = array(
				'user'			=> $this->session->userdata('userId'),
				'patient'		=> $patientId
			);
			$this->general_model->insert('link_user_patient',$dataLink);

			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			
			redirect(base_url().'Patient/familymembers');
		}
	}

	public function profile(){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}
		
		$userId = $this->session->userdata('userId');
		$where = array('userId'	=> $this->session->userdata('userId'));
		$data['users'] = $this->general_model->get('mst_users',$where);

		$data['loginRedirect']=base_url().'Patient/updateProfile';

		$data['currentMenu'] = 'Profile';
		$data['pageHeading'] = 'Profile';
		$data['singleHeading'] = 'Profile';
		$data['pageTitle'] = "Profile | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('patient/profile/profile',$data);
		$this->load->view('admin/templates/footer');
	}

	public function updateProfile(){
		if($this->session->userdata('logged_in_type') != "user") { redirect(base_url().'Patient/login');	}

		$this->form_validation->set_rules('userFName','First Name','required');
		$this->form_validation->set_rules('userLName','Last Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'Patient/profile');
		}else{
			$data = array(
				'userFName'				=> $this->input->post('userFName'),
				'userLName'				=> $this->input->post('userLName')
			);

			if($this->input->post('userPassword') != ""){
				$data['userPassword'] = md5($this->input->post('userPassword'));
			}
			$where = array('userId'	=> $this->session->userdata('userId'));
			$this->general_model->update('mst_users',$data,$where);

			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'Patient/profile');
		}
	}



	function get_patient_by_opnumber(){
		$patientOPNumber = $_POST['patientOPNumber'];

		//$patientOPNumber = 1001;
		$where = array(
			'patientOPNumber'	=> $patientOPNumber,
			'isActive'				=> 1,
			'isDeleted'				=> 0
		);

		$patients = $this->general_model->get('mst_patients',$where);

		$returnString = "";
		if(is_array($patients)){
			foreach($patients as $patient){
				$whereCheck = array(
					'user'					=> $this->session->userdata('userId'),
					'patient'				=> $patient['patientId'],
					'isDeleted'			=> 0
				);
				$checkCount = $this->general_model->getCount('link_user_patient',$whereCheck);
				if($checkCount == 0){
					$otp = "123456";
					$data = array(
						'patientOTP'					=> $otp,
						'patientOTPGenTime'		=> date('Y-m-d H:i:s')
					);
					$whereUpdate = array('patientId'=> $patient['patientId']);
					$this->general_model->update('mst_patients',$data, $whereUpdate);

					$returnString .= "<tr>";
					$returnString .= "<td>".$patient['patientOPNumber']."</td>";
					$returnString .= "<td>".$patient['patientFName']." ".$patient['patientLName']."</td>";
					$returnString .= "<td>".$patient['patientPhone']."</td>";
					$returnString .= "<td><input type='text' class='form-control patientOTP' name='patientOTP' placeholder='OTP'></td>";
					$returnString .= "<td class='actionCol'><input type='hidden' class='form-control patientId' name='patientId' value='".$patient['patientId']."'><button type='button' class='btn btn-primary addPatient' >Add</button></td>";
					$returnString .= "</tr>";
				}
			}	
		}
		
		echo $returnString;
		exit;
	}

	function get_patient_by_phone(){
		//print_r($_POST);exit;
		$patientPhone = $_POST['patientPhone'];

		//$patientPhone = "7418520963";

		$where = array(
			'patientPhone'		=> $patientPhone,
			'isActive'				=> 1,
			'isDeleted'				=> 0
		);

		$patients = $this->general_model->get('mst_patients',$where);

		$returnString = "";
		if(is_array($patients)){
			foreach($patients as $patient){
				$whereCheck = array(
					'user'					=> $this->session->userdata('userId'),
					'patient'				=> $patient['patientId'],
					'isDeleted'			=> 0
				);
				$checkCount = $this->general_model->getCount('link_user_patient',$whereCheck);
				if($checkCount == 0){
					$otp = "123456";
					$data = array(
						'patientOTP'					=> $otp,
						'patientOTPGenTime'		=> date('Y-m-d H:i:s')
					);
					$whereUpdate = array('patientId'=> $patient['patientId']);
					$this->general_model->update('mst_patients',$data, $whereUpdate);

					$returnString .= "<tr>";
					$returnString .= "<td>".$patient['patientOPNumber']."</td>";
					$returnString .= "<td>".$patient['patientFName']." ".$patient['patientLName']."</td>";
					$returnString .= "<td>".$patient['patientPhone']."</td>";
					$returnString .= "<td><input type='text' class='form-control patientOTP' name='patientOTP' placeholder='OTP'></td>";
					$returnString .= "<td class='actionCol'><input type='hidden' class='form-control patientId' name='patientId' value='".$patient['patientId']."'><button type='button' class='btn btn-primary addPatient' >Add</button></td>";
					$returnString .= "</tr>";
				}
			}	
		}
		
		echo $returnString;
		exit;
	}

	public function addFamilyMember(){
		$patientId = $_POST['patientId'];
		$patientOTP = $_POST['patientOTP'];

		// $patientId = 2;
		// $patientOTP = "123456";

		$where = array('patientId'	=> $patientId);
		$patientDetails = $this->general_model->get('mst_patients',$where);
		$otp = $patientDetails[0]['patientOTP'];

		$patientOTPGenTime = $patientDetails[0]['patientOTPGenTime'];
		$start_date = new DateTime($patientOTPGenTime);
		$since_start = $start_date->diff(new DateTime());

		if($patientOTP == $otp){
			if($since_start->i < 5){
				$data = array(
					'user'		=> $this->session->userdata('userId'),
					'patient'	=> $patientId
				);
				$this->general_model->insert('link_user_patient',$data);
				//echo "Patient linked Successfully";
				echo 1;
			}else{
				//echo "OTP Expired";
				echo 2;
			}
		}else{
			//echo "Invalid OTP";
			echo 3;
		}

		exit;
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

		$returnString = "<div class='row'>";
		if(is_array($doctors)){
			foreach($doctors as $doctor){
				$returnString .= "<div class='col-md-4 col-xl-4'>";
					$returnString .= "<div class='card '>";
						$returnString .= "<div class='card-body text-center '>";
							$returnString .= "<span class='avatar avatar-xxl brround cover-image' data-image-src='".base_url()."/uploads/doctors/".$doctor['doctorPhoto']."' style='background: url(&quot;".base_url()."/uploads/doctors/".$doctor['doctorPhoto']."&quot;) center center;'></span>";
							$returnString .= "<h4 class='h4 mb-0 mt-3'>".$doctor['doctorFName'].''.$doctor['doctorLName']."</h4>";
							$returnString .= "<p class='card-text'>".$doctor['doctorQualifications']."</p>";
							$returnString .= "<a class='btn btn-info selectDoctor' rel='".$doctor['doctorId']."'>Select Doctor</a>";
						$returnString .= "</div>";
					$returnString .= "</div>";
				$returnString .= "</div>";
			}
		}
		$returnString .= "</div>";
		
		echo $returnString;
		exit;
	}

}