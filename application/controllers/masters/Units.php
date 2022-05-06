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
		$data['units'] =$this->general_model->get('mst_units',$where);

		$data['currentMenu'] = 'Units';
		$data['pageHeading'] = 'Units';
		$data['singleHeading'] = 'Units';
		$data['pageTitle'] = "Units | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Units/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/units/units',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert()
    {
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('unitName','unitName','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/units');
		}else{
			$data = array(
				'unitName'			=> $this->input->post('unitName'),
                'unitSymbol'			=> $this->input->post('unitSymbol'),
				'isActive'						=> 1,
                'iSDeleted'						=> 0
			);
			$this->general_model->insert('mst_units',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/units');
		}
	}

	public function edit($unitId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('mst_units.isDeleted' => 0);
		$data['units'] =$this->general_model->get('mst_units',$where);

		$whereSingleCategory = array('mst_units.unitId' => $unitId);
		$data['singleUnit'] =$this->general_model->get('mst_units',$whereSingleCategory);

		$data['currentMenu'] = 'Units';
		$data['pageHeading'] = 'Units';
		$data['singleHeading'] = 'Units';
		$data['pageTitle'] = "Units | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/units/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/units/editUnit',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('unitName',' unitName','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/units');
		}else{
			$data = array(
				'unitName'			=> $this->input->post('unitName'),
                'unitSymbol'			=> $this->input->post('unitSymbol'),
			);
			$where = array(
				'unitId'	=> $this->input->post('unitId')
			);
			$this->general_model->update('mst_units',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/units');
		}
	}

	public function delete($slotId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('unitId' => $slotId);
		$this->general_model->update('mst_units',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'masters/units');
	}

	public function makeactive($unitId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('unitId' => $unitId);
		$this->general_model->update('mst_units',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'masters/units');
	}

	public function makeinactive($unitId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('unitId' => $unitId);
		$this->general_model->update('mst_units',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'masters/units');
	}


}
