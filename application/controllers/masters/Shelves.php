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
		$data['shelves'] =$this->general_model->get('mst_shelves',$where);

		$data['currentMenu'] = 'Shelves';
		$data['pageHeading'] = 'Shelves';
		$data['singleHeading'] = 'Shelves';
		$data['pageTitle'] = "Shelves | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Shelves/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/Shelves/Shelves',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert()
    {
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('shelveName','shelveName','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Shelves');
		}else{
			$data = array(
				'shelveName'			=> $this->input->post('shelveName'),
                'isActive'						=> 1,
                'iSDeleted'						=> 0
			);
			$this->general_model->insert('mst_shelves',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/shelves');
		}
	}

	public function edit($shelveId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('mst_shelves.isDeleted' => 0);
		$data['shelves'] =$this->general_model->get('mst_shelves',$where);

		$whereSingleCategory = array('mst_shelves.shelveId' => $shelveId);
		$data['singleUnit'] =$this->general_model->get('mst_shelves',$whereSingleCategory);

        $data['currentMenu'] = 'Shelves';
		$data['pageHeading'] = 'Shelves';
		$data['singleHeading'] = 'Shelves';
		$data['pageTitle'] = "Shelves | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/shelves/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/Shelves/editShelve',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('shelveName',' shelveName','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/shelves');
		}else{
			$data = array(
				'shelveName'			=> $this->input->post('shelveName'),
              
			);
			$where = array(
				'shelveId'	=> $this->input->post('shelveId')
			);
			$this->general_model->update('mst_shelves',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/shelves');
		}
	}

	public function delete($shelveId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('shelveId' => $shelveId);
		$this->general_model->update('mst_shelves',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'masters/shelves');
	}

	public function makeactive($shelveId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('shelvesId' => $shelveId);
		$this->general_model->update('mst_shelves',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'masters/shelves');
	}

	public function makeinactive($shelveId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('shelveId' => $shelveId);
		$this->general_model->update('mst_shelves',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'masters/shelves');
	}


}
