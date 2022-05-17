<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class medicineDetails extends CI_Controller {

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
		$where = array(
			
			'mst_medicines.isDeleted' 	=> 0
		);
		// $data['medicines'] =$this->general_model->get('mst_medicines',$where);
		$data['medicines'] =$this->general_model->get_medicines($where);

		$data['currentMenu'] = 'Medicine Details';
		$data['pageHeading'] = 'Medicine Details';
		$data['singleHeading'] = 'Medicine Details';
		$data['pageTitle'] = "Medicine Details | ".HEX_APPLICATION_NAME;
		$data['loginRedirect']=base_url().'medicines/medicineDetails/insert';
		
        $data['medicineGenericName'] = $this->general_model->get_combined_list_two('medicineId','medicineName','medicineGenericName','mst_basic_medicines', array('Select' => 'Select medicineName '), array('isActive' => 1, 'isDeleted' => 0));
		$data['medicineUnit'] = $this->general_model->get_list('medicineUnitId','medicineUnitName','mst_medicine_units', array('Select' => 'Select Medicine Unit '), array('isActive' => 1, 'isDeleted' => 0));
		$data['medicineShelf'] = $this->general_model->get_list('medicineShelfId','medicineShelfName','mst_medicine_shelves', array('Select' => 'Select Shelf '), array('isActive' => 1, 'isDeleted' => 0));
	    $data['medicineCategory'] = $this->general_model->get_list('medicineCategoryId','medicineCategoryName','mst_medicine_categories', array('Select' => 'Select Medicine Category '), array('isActive' => 1, 'isDeleted' => 0));
		$data['medicineType'] = $this->general_model->get_list('medicineTypeId','medicineTypeName','mst_medicine_types', array('Select' => 'Select Medicine Type '), array('isActive' => 1, 'isDeleted' => 0));
		$data['medicineManufacturer'] = $this->general_model->get_list('manufacturerId','manufacturerName','mst_medicine_manufacturers', array('Select' => 'Select Medicine Manufacture '), array('isActive' => 1, 'isDeleted' => 0));
		

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/medicineDetails/medicineDetails',$data);
		$this->load->view('admin/templates/footer');
	}



	public function insert(){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

	
		$this->form_validation->set_rules('medicineUnitName','Medicine Unit','required');
		$this->form_validation->set_rules('medicineShelfName','Medicine Shelf','required');
		$this->form_validation->set_rules('medicineCategoryName','Medicine Category','required');
		$this->form_validation->set_rules('medicineTypeName','Medicine Type','required');
				

		if ($this->form_validation->run() == FALSE) 
		{	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'medicines/medicineDetails');
		}
		
			$data = array(
				'medicineName'						=> $this->input->post('medicineName'),
				'medicineGenericName'				=> $this->input->post('medicineGenericName'),
				'medicineUnit'			             => $this->input->post('medicineUnitName'),
				'medicineShelf'						=> $this->input->post('medicineShelfName'),
				'medicineDetails'						=> $this->input->post('medicineDetails'),
				'medicineCategory'         	=> $this->input->post('medicineCategoryName'),
				'medicineType'				=> $this->input->post('medicineTypeName'),
				'medicinePrice'						=> $this->input->post('medicinePrice'),
				'medicineManufacturer'				=> $this->input->post('manufacturerName'),
				'medicineManufacturerPrice'				=> $this->input->post('medicineManufacturerPrice'),
				'medicineBarcode'				=> $this->input->post('medicineBarcode'),
				'isActive'						=> 1
			
				
			);
			$this->general_model->insert('mst_medicines',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'medicines/medicineDetails');
		
	}

	
	public function edit($medicineId = 0){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$where = array('mst_medicines.isDeleted' => 0);
		$data['doctors'] =$this->general_model->get('mst_medicines',$where);

		$whereSingleMedicine = array('mst_medicines.medicineId' => $medicineId);
		$data['singlemedicine'] =$this->general_model->get('mst_medicines',$whereSingleMedicine);

		// Department List
		 $data['medicineUnit'] = $this->general_model->get_list('medicineUnitId','medicineUnitName','mst_medicine_units', array('Select' => 'Select Unit'), array('isActive' => 1, 'isDeleted' => 0));
		$data['medicineShelf'] = $this->general_model->get_list('medicineShelfId','medicineShelfName','mst_medicine_shelves', array('Select' => 'Select Department'), array('isActive' => 1, 'isDeleted' => 0));
		$data['medicineCategory'] = $this->general_model->get_list('medicineCategoryId','medicineCategoryName','mst_medicine_categories', array('Select' => 'Select Department'), array('isActive' => 1, 'isDeleted' => 0));
		$data['medicineType'] = $this->general_model->get_list('medicineTypeId','medicineTypeName','mst_medicine_Types', array('Select' => 'Select Department'), array('isActive' => 1, 'isDeleted' => 0));
		$data['medicineManufacturer'] = $this->general_model->get_list('manufacturerId','manufacturerName','mst_medicine_manufacturers', array('Select' => 'Select Department'), array('isActive' => 1, 'isDeleted' => 0));
		

		$data['currentMenu'] = 'Medicine Details';
		$data['pageHeading'] = 'Medicine Details';
		$data['singleHeading'] = 'Medicine Details';
		$data['pageTitle'] = "Medicine Details | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'masters/medicineDetails/update';

		$this->load->view('admin/templates/header',$data);
		$this->load->view('masters/medicineDetails/editMedicine',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update()
	{
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$this->form_validation->set_rules('medicineName','medicineName','required');
		$this->form_validation->set_rules('medicineUnit','Medicine Unit','required');
		$this->form_validation->set_rules('medicineShelf','Medicine Shelf','required');
		$this->form_validation->set_rules('medicineCategory','Medicine Category','required');
		$this->form_validation->set_rules('medicineType','Medicine Type','required');
		$this->form_validation->set_rules('medicineManufacturerPrice','medicineManufacturerPrice','required');
		$this->form_validation->set_rules('medicineDetails','medicineDetails','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'medicines/medicineDetails');
		}
		
		$data = array(
			'medicineName'						=> $this->input->post('medicineName'),
			'medicineGenericName'				=> $this->input->post('medicineGenericName'),
			'medicineUnit'			             => $this->input->post('medicineUnit'),
			'medicineShelf'						=> $this->input->post('medicineShelf'),
			'medicineDetails'						=> $this->input->post('medicineDetails'),
			'medicineCategory'         	=> $this->input->post('medicineCategory'),
			'medicineType'				=> $this->input->post('medicineType'),
			'medicinePrice'						=> $this->input->post('medicinePrice'),
			'medicineManufacturer'				=> $this->input->post('medicineManufacturer'),
			'medicineManufacturerPrice'				=> $this->input->post('medicineManufacturerPrice'),
			'medicineBarcode'				=> $this->input->post('medicineBarcode'),
		
			
		);

			$where = array(
				'medicineId'	=> $this->input->post('medicineId')
			);
			$this->general_model->update('mst_medicines',$data, $where);
			$this->session->set_flashdata('registerMessage','Updated Successfully',':old:');
			redirect(base_url().'medicines/medicineDetails');
		
		
	}

	public function delete($medicineId  = 0){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$data = array(
			'isDeleted'		=>	1
		);
		$where = array('medicineId' => $medicineId );
		$this->general_model->update('mst_medicines',$data, $where);
		$this->session->set_flashdata('registerMessage','Deleted Successfully',':old:');
		redirect(base_url().'medicines/medicineDetails');
	}

	public function makeactive($medicineId  = 0)
	{
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$data = array(
			'isActive'		=>	1
		);
		$where = array('medicineId' => $medicineId );
		$this->general_model->update('mst_medicines',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Active',':old:');
		redirect(base_url().'medicines/medicineDetails');
	}

	public function makeinactive($medicineId  = 0)
	{
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$data = array(
			'isActive'		=>	0
		);
		$where = array('medicineId' => $medicineId );
		$this->general_model->update('mst_medicines',$data, $where);
		$this->session->set_flashdata('registerMessage','Status Changed to Inactive',':old:');
		redirect(base_url().'medicines/medicineDetails');
	}
}
