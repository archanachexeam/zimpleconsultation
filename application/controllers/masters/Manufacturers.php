<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manufacturers extends CI_Controller {

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
		$data['manufacturers'] =$this->general_model->get('mst_medicine_manufacturers',$where);

		$data['currentMenu'] = 'Medicine Manufacturers';
		$data['pageHeading'] = 'Medicine Manufacturers';
		$data['singleHeading'] = 'Medicine Manufacturers';
		$data['pageTitle'] = "Medicine Manufacturers | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'medicines/Manufacturers/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/manufacturers/manufacturers',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('manufacturerName','Manufacturer Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'medicines/manufacturers');
		}else{
			$data = array(
				'manufacturerName'			=> $this->input->post('manufacturerName'),
				'isActive'						=> 1
			);
			$this->general_model->insert('mst_medicine_manufacturers',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'medicines/manufacturers');
		}
	}

	public function edit($manufacturerId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('mst_medicine_manufacturers.isDeleted' => 0);
		$data['manufacturers'] =$this->general_model->get('mst_medicine_manufacturers',$where);

		$whereSingleManufacturer = array('mst_medicine_manufacturers.manufacturerId' => $manufacturerId);
		$data['singleManufacturer'] =$this->general_model->get('mst_medicine_manufacturers',$whereSingleManufacturer);

		$data['currentMenu'] = 'Medicine Manufacturers';
		$data['pageHeading'] = 'Medicine Manufacturers';
		$data['singleHeading'] = 'Medicine Manufacturers';
		$data['pageTitle'] = "Medicine Manufacturers | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'medicines/manufacturers/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/manufacturers/editManufacturer',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('manufacturerName','Manufacturer Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'medicines/manufacturers');
		}else{
			$data = array(
				'manufacturerName'			=> $this->input->post('manufacturerName'),
			);
			$where = array(
				'manufacturerId'	=> $this->input->post('manufacturerId')
			);
			$this->general_model->update('mst_medicine_manufacturers',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'medicines/manufacturers');
		}
	}

	public function delete($manufacturerId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('manufacturerId' => $manufacturerId);
		$this->general_model->update('mst_medicine_manufacturers',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'medicines/manufacturers');
	}

	public function makeactive($manufacturerId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('manufacturerId' => $manufacturerId);
		$this->general_model->update('mst_medicine_manufacturers',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'medicines/manufacturers');
	}

	public function makeinactive($manufacturerId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('manufacturerId' => $manufacturerId);
		$this->general_model->update('mst_medicine_manufacturers',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'medicines/manufacturers');
	}


}
