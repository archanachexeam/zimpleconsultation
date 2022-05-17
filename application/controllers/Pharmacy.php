<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacy extends CI_Controller {

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
		$this->session->set_userdata('site_lang',  "english");
		redirect(base_url().'Pharmacy/login');
	}

	public function login()
	{

		$data['currentMenu'] = 'Pharmacy login';
		$data['pageHeading'] = 'Pharmacy Login';
		$data['pageTitle'] = "Pharmacy Login | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'Pharmacy/checklogin';

		$this->load->view('Pharmacy/login/login',$data);
	}

	public function checklogin(){
		$this->form_validation->set_rules('login', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {	
			//var_dump(validation_errors());
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			$data['loginRedirect']=base_url().'Pharmacy/checklogin';
			
			redirect(base_url().'Pharmacy/login');
		}else{
			$userName=$this->input->post('login');
			$userPassword=$this->input->post('password');
			$user_record =$this->general_model->check_Pharmacy_login($userName,$userPassword);
			if($user_record == false)
			{
				// throw invalid email id or password error
				$this->session->set_flashdata('registerMessage','Invalid Login or Password',':old:');
				redirect(base_url().'Pharmacy/login');
			}else{
				$Pharmacydata = array(
					'logged_in'					=> true,
					'pharmacy_logged_in' 	=> true,
					'logged_in_type'		=> 'pharmacy',
                    // 'pharmacyUserName'      =>$user_record['pharmacyUserName'],
					'userId' 				=> $user_record['pharmacyId'],
					'userName'		    	=> $user_record['pharmacyName']
				);
				
				$this->session->set_userdata('pharmacyAccess',1);
				$this->session->set_userdata($Pharmacydata);
				redirect(base_url().'Pharmacy/dashboard');

			}
		}
	}

	public function switchLang($language = "") {
		//echo $language; exit;
    $this->session->set_userdata('site_lang', $language);
    $prevUrl = $_SERVER['HTTP_REFERER'];
    redirect($prevUrl);
    //header("location:javascript://history.go(-1)");
  }

	public function dashboard()
	{
    if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}
    $where = array(
    	'isActive'	=> 1,
    	'isDeleted'	=> 0
           );
		
	// 	$where = array('isDeleted' => 0, 'isActive' => 1);
	// 	$whereBooking = array('isCancelled' => 0);
	// 	$whereBookingToday = array('consultationDate' => date('Y-m-d'),'isCancelled' => 0);
    // $data['departmentCount'] = $this->general_model->getCount('mst_departments',$where);
    // $data['doctorsCount'] = $this->general_model->getCount('mst_doctors',$where);
    // $data['frontofficesCount'] = $this->general_model->getCount('mst_frontoffices',$where);
    // $data['bookingsCount'] = $this->general_model->getCount('trn_bookings',$whereBooking);
    // //$data['doctorsCount'] = $this->general_model->getCount('mst_doctors',$where);
    // $data['bookings'] =$this->general_model->get_bookings($whereBookingToday);

		

		$data['currentMenu'] = 'dashboard';
		$data['pageHeading'] = 'Dashboard';
		$data['pageTitle'] = "pharmacy Dashboard | ".HEX_APPLICATION_NAME;

		$this->load->view('admin/templates/header',$data);
		$this->load->view('pharmacy/dashboard/dashboard',$data);
		$this->load->view('admin/templates/footer');
	}
	
	
	public function logout() {		
		$this->session->sess_destroy();
		session_start();
		session_destroy();
		redirect(base_url().'pharmacy/login');
		
	}	
    public function purchaseInvoice()
    {
        if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}


		// Department List
		$data['manufacturer'] = $this->general_model->get_list('manufacturerId','manufacturerName','mst_medicine_manufacturers', array('Select' => 'Select Manufacturer'), array('isActive' => 1, 'isDeleted' => 0));
         //Box Pattern List
		//  $data['boxpattern'] = $this->general_model->get_combined_list('medicine_BoxId','medicine_BoxName','medicne_numberPerBox','mst_medicine_boxpattern', array('Select' => 'Select Leaf Type'), array('isActive' => 1, 'isDeleted' => 0));
		$data['boxpattern']= $this->general_model->get_boxpattern();
		$data['currentMenu'] = 'Purchase Invoice';
		$data['pageHeading'] = 'Purchase Invoice';
		$data['singleHeading'] = 'Purchase Invoice';
		$data['pageTitle'] = "Purchase Invoice | ".HEX_APPLICATION_NAME;

		$data['loginRedirect']=base_url().'pharmacy/insert';

		$this->load->view('admin/templates/header',$data);
        $this->load->view('pharmacy/purchaseInvoice/purchaseInvoice',$data);
		$this->load->view('admin/templates/footer');
    }
	public function insert(){
		if($this->session->userdata('logged_in_type') != "pharmacy") { redirect(base_url().'pharmacy/login');	}

		$this->form_validation->set_rules('day','day','required');
		$this->form_validation->set_rules('ExpiryDate','ExpiryDate','required');

		if ($this->form_validation->run() == FALSE) {	
			$this->session->set_flashdata('registerMessage',validation_errors(),':old:');
			redirect(base_url().'pharmacy/purchaseInvoice');
		}else{
			$data = array(
				'manufacturerName'							=> $this->input->post('manufacturerName'),
				'date'			=> $this->input->post('date'),
				'InvoiceNo'			=> $this->input->post('InvoiceNo'),
				'details'			=> $this->input->post('details'),
				'day'			=> $this->input->post('day'),
				'MedicineInformatio'			=> $this->input->post('MedicineInformatio'),
				'BatchId'			=> $this->input->post('BatchId'),
				'ExpiryDate'			=> $this->input->post('ExpiryDate'),
				'StockQty'			=> $this->input->post('StockQty'),
				'medicine_BoxName'			=> $this->input->post('medicine_BoxName'),
				'BoxQty'			=> $this->input->post('BoxQty'),
				'Quantity'			=> $this->input->post('Quantity'),
				'ManufacturerPrice'			=> $this->input->post('ManufacturerPrice'),
				'BoxMRP'			=> $this->input->post('BoxMRP'),
				'TotalPurchasePrice'			=> $this->input->post('TotalPurchasePrice'),
				'sub_total'			=> $this->input->post('sub_total'),
				'vat'			=> $this->input->post('vat'),
				'discount'			=> $this->input->post('discount'),
				'grand_total_price'			=> $this->input->post('grand_total_price'),
				'paid_amount'			=> $this->input->post('paid_amount'),
				'due_amount'			=> $this->input->post('due_amount'),
				'isActive'								=> 1
			);
			$this->general_model->insert('mst_purchase_invoice',$data);
			$this->session->set_flashdata('registerMessage','Added Successfully',':old:');
			redirect(base_url().'Pharmacy/purchaseInvoice');
		}
	}


}
