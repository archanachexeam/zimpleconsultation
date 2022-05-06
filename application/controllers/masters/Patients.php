<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patients extends CI_Controller {

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
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$where = array('isDeleted' => 0);
		$data['patients'] =$this->general_model->get('mst_patients',$where);

		$data['currentMenu'] = 'Patients';
		$data['pageHeading'] = 'Patients';
		$data['singleHeading'] = 'Patients';
		$data['pageTitle'] = "Patients | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Patients/add';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/patients/patients',$data);
		$this->load->view('admin/templates/footer');
	}

	public function add(){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}


		$data['currentMenu'] = 'Patients';
		$data['pageHeading'] = 'Patients';
		$data['singleHeading'] = 'Patients';
		$data['pageTitle'] = "Patients | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Patients/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/patients/addPatient',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('patientOPNumber','OP Number','required');
		$this->form_validation->set_rules('patientFName','First Name','required');
		$this->form_validation->set_rules('patientLName','Last Name','required');
		$this->form_validation->set_rules('patientPhone','Contact Number','required');


		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Patients');
		}else{
			$data = array(
				'patientOPNumber'		=> $this->input->post('patientOPNumber'),
				'patientFName'			=> $this->input->post('patientFName'),
				'patientLName'			=> $this->input->post('patientLName'),
				'patientPhone'			=> $this->input->post('patientPhone'),
				'patientEmail'			=> $this->input->post('patientEmail'),
				'patientAddress1'		=> $this->input->post('patientAddress1'),
				'patientAddress2'		=> $this->input->post('patientAddress2'),
				'patientCity'				=> $this->input->post('patientCity'),
				'patientState'			=> $this->input->post('patientState'),
				'isActive'					=> 1
			);
			$this->general_model->insert('mst_patients',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/Patients');
		}
	}

	public function edit($patientId = 0){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$where = array('mst_patients.isDeleted' => 0);
		$data['patients'] =$this->general_model->get('mst_patients',$where);

		$whereSingleCategory = array('mst_patients.patientId' => $patientId);
		$data['singlePatient'] =$this->general_model->get('mst_patients',$whereSingleCategory);

		$data['currentMenu'] = 'Patients';
		$data['pageHeading'] = 'Patients';
		$data['singleHeading'] = 'Patients';
		$data['pageTitle'] = "Patients | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Patients/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/patients/editPatient',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('patientOPNumber','OP Number','required');
		$this->form_validation->set_rules('patientFName','First Name','required');
		$this->form_validation->set_rules('patientLName','Last Name','required');
		$this->form_validation->set_rules('patientPhone','Contact Number','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Patients');
		}else{
			$data = array(
				'patientOPNumber'		=> $this->input->post('patientOPNumber'),
				'patientFName'			=> $this->input->post('patientFName'),
				'patientLName'			=> $this->input->post('patientLName'),
				'patientPhone'			=> $this->input->post('patientPhone'),
				'patientEmail'			=> $this->input->post('patientEmail'),
				'patientAddress1'		=> $this->input->post('patientAddress1'),
				'patientAddress2'		=> $this->input->post('patientAddress2'),
				'patientCity'				=> $this->input->post('patientCity'),
				'patientState'			=> $this->input->post('patientState'),
			);

			$where = array(
				'patientId'	=> $this->input->post('patientId')
			);
			$this->general_model->update('mst_patients',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/Patients');
		}
	}

	public function delete($patientId = 0){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('patientId' => $patientId);
		$this->general_model->update('mst_patients',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'masters/Patients');
	}

	public function makeactive($patientId = 0){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('patientId' => $patientId);
		$this->general_model->update('mst_patients',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'masters/Patients');
	}

	public function makeinactive($patientId = 0){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('patientId' => $patientId);
		$this->general_model->update('mst_patients',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'masters/Patients');
	}


}
