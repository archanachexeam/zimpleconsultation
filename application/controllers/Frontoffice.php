<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontoffice extends CI_Controller {

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
		redirect(base_url().'frontoffice/login');
	}

	public function login(){

		$data['currentMenu'] = 'Front Office login';
		$data['pageHeading'] = 'Front Office Login';
		$data['pageTitle'] = "Front Office Login | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'frontoffice/checklogin';

		$this->load->view('frontoffice/login/login',$data);
	}

	public function checklogin(){
		$this->form_validation->set_rules('login', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {	
			//var_dump(validation_errors());
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			$data['loginRedirect']=base_url().'frontoffice/checklogin';
			
			redirect(base_url().'frontoffice/login');
		}else{
			$userName=$this->input->post('login');
			$userPassword=$this->input->post('password');
			$user_record =$this->general_model->check_frontoffice_login($userName,$userPassword);
			if($user_record == false){
				// throw invalid email id or password error
				$this->session->set_flashdata('registerMessage','Invalid Login or Password',':old:');
				redirect(base_url().'frontoffice/login');
			}else{
				$admindata = array(
					'logged_in'					=> true,
					'user_logged_in' 		=> true,
					'logged_in_type'		=> 'frontoffice',
					'userId' 						=> $user_record['frontOfficeId'],
					'userName'		    	=> $user_record['frontOfficeName']
				);
				
				$this->session->set_userdata('adminAccess',1);
				$this->session->set_userdata($admindata);
				redirect(base_url().'frontoffice/dashboard');

			}
		}

	}

	public function dashboard(){
    if($this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'frontoffice/login');	}
    $where = array(
    	'isActive'	=> 1,
    	'isDeleted'	=> 0
    );
		
		$where = array('isDeleted' => 0, 'isActive' => 1);
		$whereBooking = array('isCancelled' => 0);
		$whereBookingToday = array('consultationDate' => date('Y-m-d'),'isCancelled' => 0);
    $data['departmentCount'] = $this->general_model->getCount('mst_departments',$where);
    $data['doctorsCount'] = $this->general_model->getCount('mst_doctors',$where);
    $data['frontofficesCount'] = $this->general_model->getCount('mst_frontoffices',$where);
    $data['bookingsCount'] = $this->general_model->getCount('trn_bookings',$whereBooking);
    //$data['doctorsCount'] = $this->general_model->getCount('mst_doctors',$where);
    $data['bookings'] =$this->general_model->get_bookings($whereBookingToday);

		

		$data['currentMenu'] = 'dashboard';
		$data['pageHeading'] = 'Dashboard';
		$data['pageTitle'] = "Dashboard | ".HEX_APPLICATION_NAME;

		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/dashboard/dashboard',$data);
		$this->load->view('admin/templates/footer');
	}

	public function logout() {		
		$this->session->sess_destroy();
		session_start();
		session_destroy();
		redirect(base_url().'frontoffice/login');
	}	

	public function bookings(){
		if($this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'frontoffice/login');	}

		$doctorId = $this->session->userdata('userId');
		
		$where = array(
			'trn_bookings.doctor'				=> $doctorId,
			'trn_bookings.isCancelled' 	=> 0
		);
		$data['bookings'] =$this->general_model->get_bookings($where);

		$data['currentMenu'] = 'Bookings';
		$data['pageHeading'] = 'Bookings';
		$data['singleHeading'] = 'Bookings';
		$data['pageTitle'] = "Bookings | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('doctor/bookings/bookings',$data);
		$this->load->view('admin/templates/footer');
	}


	public function viewbookings($bookingId = 0){
		if($this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'frontoffice/login');	}

		$doctorId = $this->session->userdata('userId');

		$where = array('trn_bookings.bookingId' => $bookingId,);
		$data['singleBooking'] =$this->general_model->get_bookings($where);

		$data['currentMenu'] = 'Bookings';
		$data['pageHeading'] = 'Bookings';
		$data['singleHeading'] = 'Bookings';
		$data['pageTitle'] = "Bookings | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('doctor/bookings/viewBooking',$data);
		$this->load->view('admin/templates/footer');
	}

	public function profile(){
		if($this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'frontoffice/login');	}

		$userId = $this->session->userdata('userId');
		$where = array('frontOfficeId'	=> $this->session->userdata('userId'));
		$data['users'] = $this->general_model->get('mst_frontoffices',$where);

		$data['loginRedirect']=base_url().'frontoffice/updateProfile';

		$data['currentMenu'] = 'Profile';
		$data['pageHeading'] = 'Profile';
		$data['singleHeading'] = 'Profile';
		$data['pageTitle'] = "Profile | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('frontoffice/profile/profile',$data);
		$this->load->view('admin/templates/footer');
	}

	public function updateProfile(){
		if($this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'frontoffice/login');	}

		$this->form_validation->set_rules('frontOfficeName','Front Office Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'frontoffice/profile');
		}else{
			$data = array(
				'frontOfficeName'				=> $this->input->post('frontOfficeName')
			);

			if($this->input->post('frontOfficePassword') != ""){
				$data['frontOfficePassword'] = md5($this->input->post('frontOfficePassword'));
			}
			$where = array('frontOfficeId'	=> $this->session->userdata('userId'));
			$this->general_model->update('mst_frontoffices',$data,$where);

			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'frontoffice/profile');
		}
	}

}