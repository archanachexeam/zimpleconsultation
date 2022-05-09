<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Types extends CI_Controller {

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
		$data['types'] =$this->general_model->get('mst_medicine_types',$where);

		$data['currentMenu'] = 'Medicine Types';
		$data['pageHeading'] = 'Medicine Types';
		$data['singleHeading'] = 'Medicine Types';
		$data['pageTitle'] = "Medicine Types | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'medicines/Types/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/types/types',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('medicineTypeName','Type Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'medicines/Types');
		}else{
			$data = array(
				'medicineTypeName'			=> $this->input->post('medicineTypeName'),
				'isActive'						=> 1
			);
			$this->general_model->insert('mst_medicine_types',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'medicines/Types');
		}
	}

	public function edit($medicineTypeId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('mst_medicine_types.isDeleted' => 0);
		$data['types'] =$this->general_model->get('mst_medicine_types',$where);

		$whereSingleType = array('mst_medicine_types.medicineTypeId' => $medicineTypeId);
		$data['singletypes'] =$this->general_model->get('mst_medicine_types',$whereSingleType);

		$data['currentMenu'] = 'Medicine Types';
		$data['pageHeading'] = 'Medicine Types';
		$data['singleHeading'] = 'Medicine Types';
		$data['pageTitle'] = "Medicine Types | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'medicines/Types/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/types/editType',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('medicineTypeName','Type Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'medicines/Types');
		}else{
			$data = array(
				'medicineTypeName'			=> $this->input->post('medicineTypeName'),
			);
			$where = array(
				'medicineTypeId'	=> $this->input->post('medicineTypeId')
			);
			$this->general_model->update('mst_medicine_types',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'medicines/Types');
		}
	}

	public function delete($medicineTypeId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('medicineTypeId' => $medicineTypeId);
		$this->general_model->update('mst_medicine_types',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'medicines/Types');
	}

	public function makeactive($medicineTypeId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('medicineTypeId' => $medicineTypeId);
		$this->general_model->update('mst_medicine_types',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'medicines/Types');
	}

	public function makeinactive($medicineTypeId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('medicineTypeId' => $medicineTypeId);
		$this->general_model->update('mst_medicine_types',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'medicines/Types');
	}


}
