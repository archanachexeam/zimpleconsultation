<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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

	public function index()
	{
		$this->session->set_userdata('site_lang',  "english");
		redirect(base_url().'admin/login');
	}

	public function login()
	{

		$data['currentMenu'] = 'Admin login';
		$data['pageHeading'] = 'Admin Login';
		$data['pageTitle'] = "Admin Login | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'admin/checklogin';

		$this->load->view('admin/login/login',$data);
	}

	public function checklogin(){
		$this->form_validation->set_rules('login', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {	
			//var_dump(validation_errors());
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			$data['loginRedirect']=base_url().'admin/checklogin';
			
			redirect(base_url().'admin/login');
		}else{
			$userName=$this->input->post('login');
			$userPassword=$this->input->post('password');
			$user_record =$this->general_model->check_admin_login($userName,$userPassword);
			if($user_record == false)
			{
				// throw invalid email id or password error
				$this->session->set_flashdata('registerMessage','Invalid Login or Password',':old:');
				redirect(base_url().'admin/login');
			}else{
				$admindata = array(
					'logged_in'					=> true,
					'admin_logged_in' 	=> true,
					'logged_in_type'		=> 'admin',
					'userId' 				=> $user_record['adminId'],
					'userName'		    	=> $user_record['adminName']
				);
				
				$this->session->set_userdata('adminAccess',1);
				$this->session->set_userdata($admindata);
				redirect(base_url().'admin/dashboard');

			}
		}
	}

	public function switchLang($language = "") {
		//echo $language; exit;
    $this->session->set_userdata('site_lang', $language);
    $prevUrl = $_SERVER['HTTP_REFERER'];
    redirect($prevUrl);
    //header("location:javascript://history.go(-1)");
  }

	public function dashboard()
	{
    if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}
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
		$data['pageTitle'] = "Admin Dashboard | ".HEX_APPLICATION_NAME;

		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/dashboard/dashboard',$data);
		$this->load->view('admin/templates/footer');
	}
	
	
	public function logout() {		
		$this->session->sess_destroy();
		session_start();
		session_destroy();
		redirect(base_url().'admin/login');
		
	}	

}
