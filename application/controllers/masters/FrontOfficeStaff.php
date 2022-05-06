<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontofficestaff extends CI_Controller {

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
		$data['frontoffices'] =$this->general_model->get('mst_frontoffices',$where);

		$data['currentMenu'] = 'Front Office Staff';
		$data['pageHeading'] = 'Front Office Staff';
		$data['singleHeading'] = 'Front Office Staff';
		$data['pageTitle'] = "Front Office Staff | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Frontofficestaff/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/frontoffices/frontoffices',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('frontOfficeName','Front Office Name','required');
		$this->form_validation->set_rules('frontOfficeLogin','Username','required');
		$this->form_validation->set_rules('frontOfficePassword','Password','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Frontofficestaff');
		}else{
			$data = array(
				'frontOfficeName'				=> $this->input->post('frontOfficeName'),
				'frontOfficePhone'			=> $this->input->post('frontOfficePhone'),
				'frontOfficeEmail'			=> $this->input->post('frontOfficeEmail'),
				'frontOfficeLogin'			=> $this->input->post('frontOfficeLogin'),
				'frontOfficePassword'		=> md5($this->input->post('frontOfficePassword')),
				'isActive'							=> 1
			);
			$this->general_model->insert('mst_frontoffices',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/Frontofficestaff');
		}
	}

	public function edit($frontOfficeId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('mst_frontoffices.isDeleted' => 0);
		$data['frontoffices'] =$this->general_model->get('mst_frontoffices',$where);

		$whereSingleCategory = array('mst_frontoffices.frontOfficeId' => $frontOfficeId);
		$data['singlefrontoffice'] =$this->general_model->get('mst_frontoffices',$whereSingleCategory);

		$data['currentMenu'] = 'Front Office Staff';
		$data['pageHeading'] = 'Front Office Staff';
		$data['singleHeading'] = 'Front Office Staff';
		$data['pageTitle'] = "Front Office Staff | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Frontofficestaff/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/frontoffices/editFrontoffice',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('frontOfficeName','Front Office Name','required');
		$this->form_validation->set_rules('frontOfficeLogin','Username','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Frontofficestaff');
		}else{
			$data = array(
				'frontOfficeName'				=> $this->input->post('frontOfficeName'),
				'frontOfficePhone'			=> $this->input->post('frontOfficePhone'),
				'frontOfficeEmail'			=> $this->input->post('frontOfficeEmail'),
				'frontOfficeLogin'			=> $this->input->post('frontOfficeLogin'),
			);

			if($this->input->post('frontOfficePassword') != ""){
				$data['frontOfficePassword']	= md5($this->input->post('frontOfficePassword'));
			}
			$where = array(
				'frontOfficeId'	=> $this->input->post('frontOfficeId')
			);
			$this->general_model->update('mst_frontoffices',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/Frontofficestaff');
		}
	}

	public function delete($frontOfficeId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('frontOfficeId' => $frontOfficeId);
		$this->general_model->update('mst_frontoffices',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'masters/Frontofficestaff');
	}

	public function makeactive($frontOfficeId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('frontOfficeId' => $frontOfficeId);
		$this->general_model->update('mst_frontoffices',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'masters/Frontofficestaff');
	}

	public function makeinactive($frontOfficeId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('frontOfficeId' => $frontOfficeId);
		$this->general_model->update('mst_frontoffices',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'masters/Frontofficestaff');
	}


}
