<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctorleaves extends CI_Controller {

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
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$where = array('trn_doctor_leaves.isDeleted' => 0);
		$data['doctorLeaves'] =$this->general_model->get_doctorleaves($where);

		// Patients List
		$data['doctors'] = $this->general_model->get_combined_list_two('doctorId','doctorFName','doctorLName','mst_doctors', array('Select' => 'Select Doctor'), array('isActive' => 1, 'isDeleted' => 0));

		$data['currentMenu'] = 'Doctors on Leave';
		$data['pageHeading'] = 'Doctors on Leave';
		$data['singleHeading'] = 'Doctors on Leave';
		$data['pageTitle'] = "Doctors on Leave | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'transactions/Doctorleaves/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('transactions/doctorleaves/doctorleaves',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('doctor','Doctor','required|numeric');
		$this->form_validation->set_rules('leaveDate','Leave Date','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'transactions/Doctorleaves/');
		}else{

			$leaveDate = date('Y-m-d',strtotime(str_replace('/','-',$this->input->post('leaveDate'))));

			$data = array(
				'doctor'				=> $this->input->post('doctor'),
				'leaveDate'			=> $leaveDate,
				'addedOn'				=> date('Y-m-d')
			);

			$this->general_model->insert('trn_doctor_leaves',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'transactions/Doctorleaves/');
		}
	}

	public function delete($doctorLeaveId = 0){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('doctorLeaveId' => $doctorLeaveId);
		$this->general_model->update('trn_doctor_leaves',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'transactions/Doctorleaves/');
	}



}
