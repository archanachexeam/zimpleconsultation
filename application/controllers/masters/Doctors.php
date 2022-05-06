<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctors extends CI_Controller {

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

		$where = array('mst_doctors.isDeleted' => 0);
		$data['doctors'] =$this->general_model->get_doctors($where);

		$data['currentMenu'] = 'Doctors';
		$data['pageHeading'] = 'Doctors';
		$data['singleHeading'] = 'Doctors';
		$data['pageTitle'] = "Doctors | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Doctors/add';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/doctors/doctors',$data);
		$this->load->view('admin/templates/footer');
	}

	public function add(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}


		// Department List
		$data['departments'] = $this->general_model->get_list('departmentId','departmentName','mst_departments', array('Select' => 'Select Department'), array('isActive' => 1, 'isDeleted' => 0));


		$data['currentMenu'] = 'Doctors';
		$data['pageHeading'] = 'Doctors';
		$data['singleHeading'] = 'Doctors';
		$data['pageTitle'] = "Doctors | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Doctors/insert';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/doctors/addDoctor',$data);
		$this->load->view('admin/templates/footer');
	}

	public function insert(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('doctorFName','First Name','required');
		$this->form_validation->set_rules('doctorPhone','Phone Number','required');
		$this->form_validation->set_rules('doctorEmail','Email','required');
		$this->form_validation->set_rules('doctorQualifications','Qualifications','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Doctors');
		}else{
			$doctorPhoto ="";
			if (isset($_FILES['doctorPhoto']) && !empty($_FILES['doctorPhoto']['tmp_name'])){
				$config['upload_path'] 		= './uploads/doctors/';
				$config['allowed_types']    = 'jpg|png';
				$config['max_size']         = 5000000;
				$config['max_width']        = 1024000;
				$config['max_height']       = 7680000;
				$config['encrypt_name'] 		= TRUE;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('doctorPhoto')){
					$this->session->set_flashdata('registerMessage',$this->upload->display_errors(),':old:');
					$doctorPhoto ="";
				}else{
					$dataUpload = $this->upload->data();
					$doctorPhoto = $dataUpload['file_name']; 
				}
			}
			$data = array(
				'doctorFName'						=> $this->input->post('doctorFName'),
				'doctorLName'						=> $this->input->post('doctorLName'),
				'doctorDepartment'			=> $this->input->post('doctorDepartment'),
				'doctorPhone'						=> $this->input->post('doctorPhone'),
				'doctorEmail'						=> $this->input->post('doctorEmail'),
				'doctorQualifications'	=> $this->input->post('doctorQualifications'),
				'doctorConsultationFee'	=> $this->input->post('doctorConsultationFee'),
				'doctorLogin'						=> $this->input->post('doctorLogin'),
				'doctorPassword'				=> md5($this->input->post('doctorPassword')),
				'doctorPhoto'						=> $doctorPhoto,
				'isActive'							=> 1
			);
			$this->general_model->insert('mst_doctors',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/Doctors');
		}
	}

	public function view($doctorId = 0){
		if($this->session->userdata('logged_in_type') != "admin" && $this->session->userdata('logged_in_type') != "frontoffice")
		 
		{ redirect(base_url().'admin/login');	}

		$whereSingleCategory = array('mst_doctors.doctorId' => $doctorId);
		$data['singledoctor'] = $this->general_model->get_doctors($whereSingleCategory);

		$data['currentMenu'] = 'Doctors';
		$data['pageHeading'] = 'Doctors';
		$data['singleHeading'] = 'Doctors';
		$data['pageTitle'] = "Doctors | ".HEX_APPLICATION_NAME;

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/doctors/viewDoctor',$data);
		$this->load->view('admin/templates/footer');
	}

	public function edit($doctorId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('mst_doctors.isDeleted' => 0);
		$data['doctors'] =$this->general_model->get('mst_doctors',$where);

		$whereSingleCategory = array('mst_doctors.doctorId' => $doctorId);
		$data['singledoctor'] =$this->general_model->get('mst_doctors',$whereSingleCategory);

		// Department List
		$data['departments'] = $this->general_model->get_list('departmentId','departmentName','mst_departments', array('Select' => 'Select Department'), array('isActive' => 1, 'isDeleted' => 0));

		$data['currentMenu'] = 'Doctors';
		$data['pageHeading'] = 'Doctors';
		$data['singleHeading'] = 'Doctors';
		$data['pageTitle'] = "Doctors | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Doctors/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/doctors/editDoctor',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('doctorFName','First Name','required');
		$this->form_validation->set_rules('doctorPhone','Phone Number','required');
		$this->form_validation->set_rules('doctorEmail','Email','required');
		$this->form_validation->set_rules('doctorQualifications','Qualifications','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Doctors');
		}else{
			$doctorPhoto ="";
			if (isset($_FILES['doctorPhoto']) && !empty($_FILES['doctorPhoto']['tmp_name'])){
				$config['upload_path'] 		= './uploads/doctors/';
				$config['allowed_types']    = 'jpg|png';
				$config['max_size']         = 5000000;
				$config['max_width']        = 1024000;
				$config['max_height']       = 7680000;
				$config['encrypt_name'] 		= TRUE;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('doctorPhoto')){
					$this->session->set_flashdata('registerMessage',$this->upload->display_errors(),':old:');
					$doctorPhoto ="";
				}else{
					$dataUpload = $this->upload->data();
					$doctorPhoto = $dataUpload['file_name']; 
				}
			}

			$data = array(
				'doctorFName'						=> $this->input->post('doctorFName'),
				'doctorLName'						=> $this->input->post('doctorLName'),
				'doctorDepartment'			=> $this->input->post('doctorDepartment'),
				'doctorPhone'						=> $this->input->post('doctorPhone'),
				'doctorEmail'						=> $this->input->post('doctorEmail'),
				'doctorQualifications'	=> $this->input->post('doctorQualifications'),
				'doctorConsultationFee'	=> $this->input->post('doctorConsultationFee'),
				'doctorLogin'						=> $this->input->post('doctorLogin')
			);

			if($doctorPhoto != ""){
				$data['doctorPhoto'] = $doctorPhoto;
			}

			if($this->input->post('doctorPassword') != ""){
				$data['doctorPassword'] = md5($this->input->post('doctorPassword'));
			}

			$where = array(
				'doctorId'	=> $this->input->post('doctorId')
			);
			$this->general_model->update('mst_doctors',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/Doctors');
		}
	}

	public function delete($doctorId = 0)
	{
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('doctorId' => $doctorId);
		$this->general_model->update('mst_doctors',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'masters/Doctors');
	}

	public function makeactive($doctorId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('doctorId' => $doctorId);
		$this->general_model->update('mst_doctors',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'masters/Doctors');
	}

	public function makeinactive($doctorId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('doctorId' => $doctorId);
		$this->general_model->update('mst_doctors',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'masters/Doctors');
	}

	public function timeslots($doctorId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('link_doctor_slots.doctor' => $doctorId, 'link_doctor_slots.isDeleted' => 0);
		$data['timeslots'] =$this->general_model->get_available_slots($where);
		$data['doctor'] = $doctorId;

		// Slots List
		$data['slots'] = $this->general_model->get_list('slotId','slotName','mst_slots', array('Select' => 'Select Slots'), array('isActive' => 1, 'isDeleted' => 0));

		$data['currentMenu'] = 'Timeslots';
		$data['pageHeading'] = 'Timeslots';
		$data['singleHeading'] = 'Timeslots';
		$data['pageTitle'] = "Timeslots | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Doctors/addTimeslot';
		$data['loginRedirectBack']=base_url().'masters/Doctors';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/doctors/timeslots',$data);
		$this->load->view('admin/templates/footer');
	}

	public function addTimeslot(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('doctor','Doctor','required');
		$this->form_validation->set_rules('maxTokens','Max Tokens','required|numeric');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Doctors/timeslots/'.$this->input->post('doctor'));
		}else{

			$day = $this->input->post('day');
			$slot = $this->input->post('slot');

			foreach($day as $singleDay){
				foreach($slot as $singleSlot){
					$whereCheck = array(
						'doctor'		=> $this->input->post('doctor'),
						'day'				=> $singleDay,
						'slot'			=> $singleSlot,
						'isDeleted'	=> 0
					);
					$checkCount = $this->general_model->getCount('link_doctor_slots',$whereCheck);
					if($checkCount == 0){
						$data = array(
							'doctor'		=> $this->input->post('doctor'),
							'day'				=> $singleDay,
							'slot'			=> $singleSlot,
							'maxTokens' => $this->input->post('maxTokens')
						);
						$this->general_model->insert('link_doctor_slots',$data);
					}
				}
			}
			

			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'masters/Doctors/timeslots/'.$this->input->post('doctor'));
		}
	}

	public function editTimeslot($doctorSlotId = 0){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$where = array('link_doctor_slots.doctorSlotId' => $doctorSlotId);
		$data['timeslots'] =$this->general_model->get_available_slots($where);
		$data['doctor'] = $data['timeslots'][0]['doctor'];

		$data['currentMenu'] = 'Doctors Timeslots';
		$data['pageHeading'] = 'Doctors Timeslots';
		$data['singleHeading'] = 'Doctors Timeslots';
		$data['pageTitle'] = "Doctors Timeslots| ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/Doctors/updateTimeslot';
		$data['loginRedirectCancel']=base_url().'masters/Doctors/timeslots/'.$data['doctor'];

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/doctors/editTimeslot',$data);
		$this->load->view('admin/templates/footer');
	}

	public function updateTimeslot(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}

		$this->form_validation->set_rules('doctorSlotId','Doctor Slot','required');
		$this->form_validation->set_rules('maxTokens','Max Tokens','required|numeric');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'masters/Doctors/timeslots/'.$this->input->post('doctor'));
		}else{

			$data = array('maxTokens'	=> $this->input->post('maxTokens'));
			$where = array('doctorSlotId'	=> $this->input->post('doctorSlotId'));
			$this->general_model->update('link_doctor_slots',$data,$where);

			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'masters/Doctors/timeslots/'.$this->input->post('doctor'));
		}
	}


}
