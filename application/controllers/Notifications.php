<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

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
		
		$whereCount = array(
      'isRead'      => 0
    );

    $notificationCount = $this->general_model->getCount('trn_notifications',$whereCount);
    if($notificationCount > 0){
      $notifications = $this->general_model->get('trn_notifications',$whereCount);
    }else{
      $notifications = array();
    }
    $global_data = array(
      'notificationCount' => $notificationCount,
      'notifications'     => $notifications
    );
    $this->load->vars($global_data);
	}

	public function index(){
		if($this->session->userdata('logged_in_type') != "admin") { redirect(base_url().'admin/login');	}
		
		$where = array();
		$data['notifications'] =$this->general_model->get('trn_notifications',$where);

		$data['currentMenu'] = 'Notifications';
		$data['pageHeading'] = 'Notifications';
		$data['singleHeading'] = 'Notification';
		$data['pageTitle'] = "Notifications | ".HEX_APPLICATION_NAME;

		

		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/notifications/notifications',$data);
		$this->load->view('admin/templates/footer');
	}


}