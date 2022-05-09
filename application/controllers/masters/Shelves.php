<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shelves extends CI_Controller {

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
		$data['shelves'] =$this->general_model->get('mst_medicine_shelves',$where);

		$data['currentMenu'] = 'Medicine Shelves';
		$data['pageHeading'] = 'Medicine Shelves';
		$data['singleHeading'] = 'Medicine Shelves';
		$data['pageTitle'] = "Medicine Shelves | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Shelves/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/shelves/shelves',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('medicineShelfName','Shelf Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Shelves');
		}else{
			$data = array(
				'medicineShelfName'			=> $this->input->post('medicineShelfName'),
				'isActive'						=> 1
			);
			$this->general_model->insert('mst_medicine_shelves',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/Shelves');
		}
	}

	public function edit($medicineShelfId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('mst_medicine_shelves.isDeleted' => 0);
		$data['shelves'] =$this->general_model->get('mst_medicine_shelves',$where);

		$whereSingleShelf = array('mst_medicine_shelves.medicineShelfId' => $medicineShelfId);
		$data['singleshelves'] =$this->general_model->get('mst_medicine_shelves',$whereSingleShelf);

		$data['currentMenu'] = 'Medicine Shelves';
		$data['pageHeading'] = 'Medicine Shelves';
		$data['singleHeading'] = 'Medicine Shelves';
		$data['pageTitle'] = "Medicine Shelves | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Shelves/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/shelves/editShelves',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('medicineShelfName','Shelf Name','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Shelves');
		}else{
			$data = array(
				'medicineShelfName'			=> $this->input->post('medicineShelfName'),
			);
			$where = array(
				'medicineShelfId'	=> $this->input->post('medicineShelfId')
			);
			$this->general_model->update('mst_medicine_shelves',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/Shelves');
		}
	}

	public function delete($medicineShelfId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('medicineShelfId' => $medicineShelfId);
		$this->general_model->update('mst_medicine_shelves',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'masters/Shelves');
	}

	public function makeactive($medicineShelfId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('medicineShelfId' => $medicineShelfId);
		$this->general_model->update('mst_medicine_shelves',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'masters/Shelves');
	}

	public function makeinactive($medicineShelfId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('medicineShelfId' => $medicineShelfId);
		$this->general_model->update('mst_medicine_shelves',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'masters/Shelves');
	}


}
