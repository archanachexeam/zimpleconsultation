<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicines extends CI_Controller {

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
		$data['medicines'] =$this->general_model->get('mst_basic_medicines',$where);

		$data['currentMenu'] = 'Medicines';
		$data['pageHeading'] = 'Medicines';
		$data['singleHeading'] = 'Medicines';
		$data['pageTitle'] = "Medicines | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Medicines/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/medicines/medicines',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('medicineName','Medicine Name','required');
		$this->form_validation->set_rules('medicineGenericName','Genric Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Medicines');
		}else{
			$data = array(
				'medicineName'						=> $this->input->post('medicineName'),
				'medicineGenericName'			=> $this->input->post('medicineGenericName'),
				'isActive'								=> 1
			);
			$this->general_model->insert('mst_basic_medicines',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/Medicines');
		}
	}

	public function edit($medicineId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('mst_basic_medicines.isDeleted' => 0);
		$data['medicines'] =$this->general_model->get('mst_basic_medicines',$where);

		$whereSingleMedicine = array('mst_basic_medicines.medicineId' => $medicineId);
		$data['singlemedicine'] =$this->general_model->get('mst_basic_medicines',$whereSingleMedicine);

		$data['currentMenu'] = 'Medicines';
		$data['pageHeading'] = 'Medicines';
		$data['singleHeading'] = 'Medicines';
		$data['pageTitle'] = "Medicines | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Medicines/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/Medicines/editMedicine',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('medicineName','Medicine Name','required');
		$this->form_validation->set_rules('medicineGenericName','Genric Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Medicines');
		}else{
			$data = array(
				'medicineName'						=> $this->input->post('medicineName'),
				'medicineGenericName'			=> $this->input->post('medicineGenericName'),
			);
			$where = array(
				'medicineId'	=> $this->input->post('medicineId')
			);
			$this->general_model->update('mst_basic_medicines',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/Medicines');
		}
	}

	public function delete($medicineId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('medicineId' => $medicineId);
		$this->general_model->update('mst_basic_medicines',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'masters/Medicines');
	}

	public function makeactive($medicineId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('medicineId' => $medicineId);
		$this->general_model->update('mst_basic_medicines',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'masters/Medicines');
	}

	public function makeinactive($medicineId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('medicineId' => $medicineId);
		$this->general_model->update('mst_basic_medicines',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'masters/Medicines');
	}


}
