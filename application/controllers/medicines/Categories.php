<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

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
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}


		$where = array('isDeleted' => 0);
		$data['categories'] =$this->general_model->get('mst_medicine_categories',$where);

		$data['currentMenu'] = 'Medicine Categories';
		$data['pageHeading'] = 'Medicine Categories';
		$data['singleHeading'] = 'Medicine Categories';
		$data['pageTitle'] = "Medicine Categories | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'medicines/Categories/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/categories/categories',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$this->form_validation->set_rules('medicineCategoryName','Category Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'medicines/categories');
		}else{
			$data = array(
				'medicineCategoryName'			=> $this->input->post('medicineCategoryName'),
				'isActive'						=> 1
			);
			$this->general_model->insert('mst_medicine_categories',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'medicines/categories');
		}
	}

	public function edit($medicineCategoryId = 0){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$where = array('mst_medicine_categories.isDeleted' => 0);
		$data['categories'] =$this->general_model->get('mst_medicine_categories',$where);

		$whereSingleCategory = array('mst_medicine_categories.medicineCategoryId' => $medicineCategoryId);
		$data['singlecategory'] =$this->general_model->get('mst_medicine_categories',$whereSingleCategory);

		$data['currentMenu'] = 'Medicine Categories';
		$data['pageHeading'] = 'Medicine Categories';
		$data['singleHeading'] = 'Medicine Categories';
		$data['pageTitle'] = "Medicine Categories | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'medicines/Categories/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/categories/editCategory',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$this->form_validation->set_rules('medicineCategoryName','Department Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'medicines/categories');
		}else{
			$data = array(
				'medicineCategoryName'			=> $this->input->post('medicineCategoryName'),
			);
			$where = array(
				'medicineCategoryId'	=> $this->input->post('medicineCategoryId')
			);
			$this->general_model->update('mst_medicine_categories',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'medicines/categories');
		}
	}

	public function delete($medicineCategoryId = 0){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('medicineCategoryId' => $medicineCategoryId);
		$this->general_model->update('mst_medicine_categories',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'medicines/categories');
	}

	public function makeactive($medicineCategoryId = 0){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('medicineCategoryId' => $medicineCategoryId);
		$this->general_model->update('mst_medicine_categories',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'medicines/categories');
	}

	public function makeinactive($medicineCategoryId = 0){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('medicineCategoryId' => $medicineCategoryId);
		$this->general_model->update('mst_medicine_categories',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'medicines/categories');
	}


}
