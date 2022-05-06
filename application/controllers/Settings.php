<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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


		$data['loginRedirect']=base_url().'Settings/update';


		$data['settings'] = $this->general_model->get('adm_settings');

		$data['currentMenu'] = 'Settings';
		$data['pageHeading'] = 'Settings';
		$data['singleHeading'] = 'Settings';
		$data['pageTitle'] = "Settings | ".HEX_APPLICATION_NAME;

		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/settings/settings',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('hospitalName','Hospital Name','required');
		$this->form_validation->set_rules('hospitalEmail','Email','required|valid_email');
		$this->form_validation->set_rules('hospitalAddress1','Address (Line 1)','required');
		$this->form_validation->set_rules('hospitalAddress2','Address (Line 2)','required');
		$this->form_validation->set_rules('hospitalCity','City','required');
		$this->form_validation->set_rules('hospitalState','State','required');
		$this->form_validation->set_rules('hospitalCountry','Country','required');
		$this->form_validation->set_rules('hospitalPincode','Pincode','required|numeric');
		$this->form_validation->set_rules('hospitalContactNumber','Contact Number','required');
		$this->form_validation->set_rules('hospitalWebsite','Website','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'Settings');
		}else{
			$doctorPhoto ="";
			if (isset($_FILES['hospitalLogo']) && !empty($_FILES['hospitalLogo']['tmp_name'])){
				$config['upload_path'] 		= './uploads/settings/';
				$config['allowed_types']    = 'jpg|png';
				$config['max_size']         = 5000000;
				$config['max_width']        = 1024000;
				$config['max_height']       = 7680000;
				$config['encrypt_name'] 		= TRUE;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('hospitalLogo')){
					$this->session->set_flashdata('registerMessage',$this->upload->display_errors(),':old:');
					$hospitalLogo ="";
				}else{
					$dataUpload = $this->upload->data();
					$hospitalLogo = $dataUpload['file_name']; 
				}
			}

			$checkCount = $this->general_model->get('adm_settings');

			if($checkCount == 0){
				// Insert Settings
				$data = array(
					'hospitalName'						=> $this->input->post('hospitalName'),
					'hospitalEmail'						=> $this->input->post('hospitalEmail'),
					'hospitalAddress1'				=> $this->input->post('hospitalAddress1'),
					'hospitalAddress2'				=> $this->input->post('hospitalAddress2'),
					'hospitalCity'						=> $this->input->post('hospitalCity'),
					'hospitalState'						=> $this->input->post('hospitalState'),
					'hospitalCountry'					=> $this->input->post('hospitalCountry'),
					'hospitalPincode'					=> $this->input->post('hospitalPincode'),
					'hospitalContactNumber'		=> $this->input->post('hospitalContactNumber'),
					'hospitalWebsite'					=> $this->input->post('hospitalWebsite'),
					'hospitalLogo'						=> $hospitalLogo
				);
				$this->general_model->insert('adm_settings',$data);
			}else{
				// Update Settings
				$data = array(
					'hospitalName'						=> $this->input->post('hospitalName'),
					'hospitalEmail'						=> $this->input->post('hospitalEmail'),
					'hospitalAddress1'				=> $this->input->post('hospitalAddress1'),
					'hospitalAddress2'				=> $this->input->post('hospitalAddress2'),
					'hospitalCity'						=> $this->input->post('hospitalCity'),
					'hospitalState'						=> $this->input->post('hospitalState'),
					'hospitalCountry'					=> $this->input->post('hospitalCountry'),
					'hospitalPincode'					=> $this->input->post('hospitalPincode'),
					'hospitalContactNumber'		=> $this->input->post('hospitalContactNumber'),
					'hospitalWebsite'					=> $this->input->post('hospitalWebsite'),
					'hospitalLogo'						=> $hospitalLogo
				);
				$where = array('settingsId'	=> 1);
				$this->general_model->update('adm_settings',$data,$where);
			}

			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'Settings');
		}
	}

	


}
