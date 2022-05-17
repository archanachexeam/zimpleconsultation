<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Units extends CI_Controller {

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
		$data['units'] =$this->general_model->get('mst_medicine_units',$where);

		$data['currentMenu'] = 'Medicine Units';
		$data['pageHeading'] = 'Medicine Units';
		$data['singleHeading'] = 'Medicine Units';
		$data['pageTitle'] = "Medicine Units | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Units/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/Units/Units',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('medicineUnitName','Medicine Name','required');
		$this->form_validation->set_rules('medicineUnitSF','Medicine Symbol','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Labtests');
		}else{
			$data = array(
				'medicineUnitName'							=> $this->input->post('medicineUnitName'),
				'medicineUnitSF'			=> $this->input->post('medicineUnitSF'),
				'isActive'								=> 1
			);
			$this->general_model->insert('mst_medicine_units',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/Units');
		}
	}


	public function edit($medicineUnitId = 0)
	{
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('mst_medicine_units.isDeleted' => 0);
		$data['Units'] =$this->general_model->get('mst_medicine_units',$where);

		$whereSingleunit = array('mst_medicine_units.medicineUnitId' => $medicineUnitId);
		$data['singleunit'] =$this->general_model->get('mst_medicine_units',$whereSingleunit);

		$data['currentMenu'] = 'Medicine Units';
		$data['pageHeading'] = 'Medicine Units';
		$data['singleHeading'] = 'Medicine Units';
		$data['pageTitle'] = "Medicine Units | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Units/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/Units/editUnit',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('medicineUnitName','Medicine Name','required');
		$this->form_validation->set_rules('medicineUnitSF','Medicine Symbol','required');


		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Units');
		}else{
			$data = array(
				'medicineUnitName'							=> $this->input->post('medicineUnitName'),
				'medicineUnitSF'			=> $this->input->post('medicineUnitSF'),
			);
			$where = array(
				'medicineUnitId'	=> $this->input->post('medicineUnitId')
			);
			$this->general_model->update('mst_medicine_units',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/Units');
		}
	}

	public function delete($medicineUnitId  = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('medicineUnitId' => $medicineUnitId );
		$this->general_model->update('mst_medicine_units',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'masters/Units');
	}

	public function makeactive($medicineUnitId  = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('medicineUnitId' => $medicineUnitId );
		$this->general_model->update('mst_medicine_units',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'masters/Units');
	}

	public function makeinactive($medicineUnitId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('medicineUnitId' => $medicineUnitId);
		$this->general_model->update('mst_medicine_units',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'masters/Units');
	}


}
