<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$userId = $this->session->userdata('userId');
		$where = array('adminId'	=> $this->session->userdata('userId'));
		$data['users'] = $this->general_model->get('adm_admin',$where);

		$data['loginRedirect']=base_url().'Profile/update';

		$data['currentMenu'] = 'Profile';
		$data['pageHeading'] = 'Profile';
		$data['singleHeading'] = 'Profile';
		$data['pageTitle'] = "Profile | ".HEX_APPLICATION_NAME;


		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/profile/profile',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'Admin/login');	}

		$this->form_validation->set_rules('adminName','Admin Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'profile');
		}else{
			$data = array(
				'adminName'				=> $this->input->post('adminName')
			);

			if($this->input->post('adminPassword') != ""){
				$data['adminPassword'] = md5($this->input->post('adminPassword'));
			}
			$where = array('adminId'	=> $this->session->userdata('userId'));
			$this->general_model->update('adm_admin',$data,$where);

			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'profile');
		}
	}

	


}
