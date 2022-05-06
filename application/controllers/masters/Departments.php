<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

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
		if($this->session->userdata('logged_in_type') != "admin")
		 { 
			 redirect(base_url().'admin/login');
			}

		$where = array('isDeleted' => 0);
		$data['departments'] =$this->general_model->get('mst_departments',$where);

		$data['currentMenu'] = 'Departments';
		$data['pageHeading'] = 'Departments';
		$data['singleHeading'] = 'Departments';
		$data['pageTitle'] = "Departments | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Departments/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/departments/departments',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('departmentName','Department Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Departments');
		}else{
			$data = array(
				'departmentName'			=> $this->input->post('departmentName'),
				'isActive'						=> 1
			);
			$this->general_model->insert('mst_departments',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/Departments');
		}
	}

	public function edit($departmentId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('mst_departments.isDeleted' => 0);
		$data['departments'] =$this->general_model->get('mst_departments',$where);

		$whereSingleCategory = array('mst_departments.departmentId' => $departmentId);
		$data['singledepartment'] =$this->general_model->get('mst_departments',$whereSingleCategory);

		$data['currentMenu'] = 'Departments';
		$data['pageHeading'] = 'Departments';
		$data['singleHeading'] = 'Departments';
		$data['pageTitle'] = "Departments | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Departments/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/departments/editDepartment',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('departmentName','Department Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Departments');
		}else{
			$data = array(
				'departmentName'			=> $this->input->post('departmentName'),
			);
			$where = array(
				'departmentId'	=> $this->input->post('departmentId')
			);
			$this->general_model->update('mst_departments',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/Departments');
		}
	}

	public function delete($departmentId = 0)
	{
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('departmentId' => $departmentId);
		$this->general_model->update('mst_departments',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'masters/Departments');
	}

	public function makeactive($departmentId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('departmentId' => $departmentId);
		$this->general_model->update('mst_departments',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'masters/Departments');
	}

	public function makeinactive($departmentId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('departmentId' => $departmentId);
		$this->general_model->update('mst_departments',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'masters/Departments');
	}


}
