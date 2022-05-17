<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boxpattern extends CI_Controller {

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

		// $where = array('isDeleted' => 0);
		// $data['Pattern'] =$this->general_model->get('mst_medicine_boxpattern',$where);
        $where = array(
			
			'mst_medicine_boxpattern.isDeleted' 	=> 0
		);
        $data['boxpattern'] =$this->general_model->get('mst_medicine_boxpattern',$where);

		$data['currentMenu'] = 'Box Pattern';
		$data['pageHeading'] = 'Box Pattern';
		$data['singleHeading'] = 'Box Pattern';
		$data['pageTitle'] = "Box Pattern | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Boxpattern/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/Boxpattern/Boxpattern',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
        if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$this->form_validation->set_rules('medicine_BoxName','medicine Box Pattern','required');
		

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Boxpattern');
		}else{
			$data = array(
				'medicine_BoxName'		=> $this->input->post('medicine_BoxName'),
				'medicne_numberPerBox'		=> $this->input->post('medicne_numberPerBox'),
				
				'isActive'						=> 1
			);
			$this->general_model->insert('mst_medicine_boxpattern',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/Boxpattern');
		}
	}

	public function edit($medicine_BoxId  = 0){
        if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$where = array('mst_medicine_boxpattern.isDeleted' => 0);
		$data['singleboxpattern'] =$this->general_model->get('mst_medicine_boxpattern',$where);

		$whereSinglePattern = array('mst_medicine_boxpattern.medicine_BoxId ' => $medicine_BoxId );
		$data['boxpattern'] =$this->general_model->get('mst_medicine_boxpattern',$whereSinglePattern);

		$data['currentMenu'] = 'Box Pattern';
		$data['pageHeading'] = 'Box Pattern';
		$data['singleHeading'] = 'Box Pattern';
		$data['pageTitle'] = "Box Pattern | ".HEX_APPLICATION_NAME;


		$data['loginRedirect']=base_url().'masters/Boxpattern/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/Boxpattern/editBoxpattern',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
        if($this->session->userdata('logged_in_type') != "pharmacy")
		 {
			  redirect(base_url().'pharmacy/login');	
			}

		$this->form_validation->set_rules('medicine_BoxName','medicine Box Pattern','required');
		

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'Boxpattern/edit');
		}else{
			$data = array(
				'medicine_BoxName'		=> $this->input->post('medicine_BoxName'),
				'medicne_numberPerBox'		=> $this->input->post('medicne_numberPerBox'),
				
			);
			$where = array(
				'medicine_BoxId'	=> $this->input->post('medicine_BoxId')
			);
			$this->general_model->update('mst_medicine_boxpattern',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/Boxpattern');
		}
	}

	public function delete($medicine_BoxId  = 0){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('medicine_BoxId' => $medicine_BoxId );
		$this->general_model->update('mst_medicine_boxpattern',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'masters/Boxpattern');
	}

	public function makeactive($medicine_BoxId  = 0){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('medicine_BoxId ' => $medicine_BoxId );
		$this->general_model->update('mst_medicine_boxpattern',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'masters/Boxpattern');
	}

	public function makeinactive($medicine_BoxId  = 0){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('medicine_BoxId ' => $medicine_BoxId );
		$this->general_model->update('mst_medicine_boxpattern',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'masters/Boxpattern');
	}


}
