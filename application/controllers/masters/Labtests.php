<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Labtests extends CI_Controller {

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
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('isDeleted' => 0);
		$data['labtests'] =$this->general_model->get('mst_basic_lab_tests',$where);

		$data['currentMenu'] = 'Lab Tests';
		$data['pageHeading'] = 'Lab Tests';
		$data['singleHeading'] = 'Lab Tests';
		$data['pageTitle'] = "Lab Tests | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Labtests/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/labtests/labtests',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('labTestName','Test Name','required');
		$this->form_validation->set_rules('labTestDescription','Description','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Labtests');
		}else{
			$data = array(
				'labTestName'							=> $this->input->post('labTestName'),
				'labTestDescription'			=> $this->input->post('labTestDescription'),
				'isActive'								=> 1
			);
			$this->general_model->insert('mst_basic_lab_tests',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/Labtests');
		}
	}

	public function edit($labTestId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('mst_basic_lab_tests.isDeleted' => 0);
		$data['labtests'] =$this->general_model->get('mst_basic_lab_tests',$where);

		$whereSingleLabtest = array('mst_basic_lab_tests.labTestId' => $labTestId);
		$data['singlelabtest'] =$this->general_model->get('mst_basic_lab_tests',$whereSingleLabtest);

		$data['currentMenu'] = 'Lab Tests';
		$data['pageHeading'] = 'Lab Tests';
		$data['singleHeading'] = 'Lab Tests';
		$data['pageTitle'] = "Lab Tests | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Labtests/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/labtests/editLabtest',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('labTestName','Test Name','required');
		$this->form_validation->set_rules('labTestDescription','Description','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Labtests');
		}else{
			$data = array(
				'labTestName'							=> $this->input->post('labTestName'),
				'labTestDescription'			=> $this->input->post('labTestDescription'),
			);
			$where = array(
				'labTestId'	=> $this->input->post('labTestId')
			);
			$this->general_model->update('mst_basic_lab_tests',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/Labtests');
		}
	}

	public function delete($labTestId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('labTestId' => $labTestId);
		$this->general_model->update('mst_basic_lab_tests',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'masters/Labtests');
	}

	public function makeactive($labTestId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('labTestId' => $labTestId);
		$this->general_model->update('mst_basic_lab_tests',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'masters/Labtests');
	}

	public function makeinactive($labTestId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('labTestId' => $labTestId);
		$this->general_model->update('mst_basic_lab_tests',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'masters/Labtests');
	}


}
