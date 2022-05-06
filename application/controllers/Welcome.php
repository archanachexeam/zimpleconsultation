<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		redirect(base_url().'admin/login');
	}

	public function login(){

		$data['currentMenu'] = 'login';
		$data['pageHeading'] = 'Login';
		$data['pageTitle'] = "Login | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'welcome/checklogin';

		$this->load->view('bakery/login/login',$data);
	}

	public function checklogin(){
		$this->form_validation->set_rules('login', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {	
			//var_dump(validation_errors());
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			$data['loginRedirect']=base_url().'welcome/checklogin';
			redirect(base_url().'login');
		}else{
			$userName=$this->input->post('login');
			$userPassword=$this->input->post('password');
			$user_record =$this->general_model->check_bakery_login($userName,$userPassword);
			if($user_record == false){
				// throw invalid email id or password error
				$this->session->set_flashdata('registerMessage','Invalid Login or Password',':old:');
				redirect(base_url().'login');
			}else{

				$where = array(
					'userId'	=> $user_record['userId']
				);
				$bakeryDetails = $this->general_model->get('mst_bakeries',$where);
				//echo $this->db->last_query();
				// print_r($user_record);exit;
				$bakeryId = $bakeryDetails[0]['bakeryId'];
				
				$admindata = array(
					'logged_in'					=> true,
					'bakery_logged_in' 	=> true,
					'logged_in_type'		=> 'bakery',
					'userId' 						=> $user_record['userId'],
					'adminName'		    	=> $user_record['userName'],
					'bakeryId'					=> $bakeryId
				);
				
				
				$this->session->set_userdata('adminAccess',1);
				$this->session->set_userdata($admindata);
				redirect(base_url().'bakery/dashboard');

			}
		}
	}

	public function logout() {		
		$this->session->sess_destroy();
		session_start();
		session_destroy();
		redirect(base_url().'login');
		
	}	
}
