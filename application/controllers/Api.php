<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

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
		$this->load->view('welcome_message');
	}

	// 1. User Login
	public function login(){
		$obj = array();
		$userName = $_POST['userLogin'];
    $userPassword = $_POST['userPassword'];
    $userDevice = $_POST['userDevice'];
    $userDeviceToken = $_POST['userDeviceToken'];
    $user_record =$this->general_model->check_user_login($userName,$userPassword);
    if($user_record == false){
			// throw invalid email id or password error
			$obj['status'] = 0;
      $obj['message'] = 'Invalid Login or Password';
		}else{
			if($user_record['isOTPVerified'] == 0){
				$obj['status'] = 2;
     	 	$obj['message'] = 'OTP Not verified';
			}else if($user_record['isActive'] == 0){
				$obj['status'] = 0;
     	 	$obj['message'] = 'User is Inactive';
			}else{
				$data = array(
					'userDevice'			=> $userDevice,
					'userDeviceToken'	=> $userDeviceToken
				);
				$where = array('userId'	=> $user_record['userId']);
				$this->general_model->update('mst_users',$data,$where);

				$obj['userId'] = $user_record['userId'];
				$obj['userFName'] = $user_record['userFName'];
				$obj['userLName'] = $user_record['userLName'];
				$obj['userPhone'] = $user_record['userPhone'];
				$obj['userEmail'] = $user_record['userEmail'];
				$obj['status'] = 1;
	      $obj['message'] = 'Success';
			}		
		}

		echo json_encode($obj);
	}

	// 2. User Registration
	public function register(){
		$this->form_validation->set_rules('userFName','Name','required');
		$this->form_validation->set_rules('userPhone','Phone','required|numeric|is_unique[mst_users.userPhone]');
		$this->form_validation->set_rules('userEmail','Email','required|valid_email|is_unique[mst_users.userEmail]');
		$this->form_validation->set_rules('userPassword','Password','required');

		if ($this->form_validation->run() == FALSE) {	
			$obj['status'] = 0;
    	$obj['message'] = validation_errors();
		}else{
			$obj = array();
			$userFName = $_POST['userFName'];
			$userLName = $_POST['userLName'];
	    $userPhone = $_POST['userPhone'];
	    $userEmail = $_POST['userEmail'];
	    $userLogin = $_POST['userPhone'];
	    $userPassword = md5($_POST['userPassword']);

	    $data = array(
	    	'userFName'			=> $userFName,
	    	'userLName'			=> $userLName,
	    	'userPhone'			=> $userPhone,
	    	'userEmail'			=> $userEmail,
	    	'userLogin'			=> $userLogin,
	    	'userPassword'	=> $userPassword
	    );

	    $userId = $this->general_model->insert('mst_users',$data);

	    // $otp = rand(1000,9999);
	    $otp = 1111;
	    $where = array(
		    'userId'    =>  $userId
			);
			$data = array(
	      'userOTP'             => $otp,
	      'userOTPGenDateTime'  => date('Y-m-d H:i:s'),
	      'isOTPVerified'       => 0
	    );
		  $this->general_model->update('mst_users', $data, $where);

		  // Send OTP in SMS
	   //  $apiKey = "38e906fa-6b13-4595-bf81-9effd6c442d8";
	   //  $clientID = "a33f172b-55c4-47da-871f-7a2ec88e6422";
	   //  $mesage = "Your request to reset the password for Bakery app need an OTP. Your OTP is :".$otp;
	    
		  // $data = array(
    //     'apikey'        => $apiKey,
    //     'clientid'      => $clientID,
    //     'msisdn'        => $phone,
    //     'sid'           => "FOODOY",
    //     'msg'           => $mesage,
    //     'fl'            =>"0",
    //     'gwid'          => 2
    //   );
    //   list($header,$content) =$this->PostRequest("http://sms.nettyfish.com/vendorsms/pushsms.aspx",$data);

	    $obj['userId'] = $userId;
			$obj['userFName'] = $userFName;
			$obj['userLName'] = $userLName;
			$obj['userPhone'] = $userPhone;
			$obj['userEmail'] = $userEmail;
			$obj['status'] = 1;
	    $obj['message'] = 'Succesfully Registered';
		}
		echo json_encode($obj);
	}

	// 3. OTP verification
	public function verifyOtp(){
	  $obj = array();
		$userId = $_POST['userId'];
		$otp = $_POST['otp'];
		
		$where = array(
	    'userId'                             			=> $userId,
	    'userOTP'                               	=> $otp,
	    'isOTPVerified'                           => 0,
	    'TIMEDIFF(now(), userOTPGenDateTime) <='	=> '00:10:00'
		);
		
		$userCount = $this->general_model->getCount('mst_users',$where);
		$users = $this->general_model->get('mst_users',$where);
		if($userCount > 0){
	    $dataUpdate = array(
	      'isOTPVerified'  => 1
	    );
		  $this->general_model->update('mst_users', $dataUpdate, $where);
		  $obj['userId'] = $users[0]['userId'];
		  $obj['status'] = 1;
	    $obj['message'] = 'OTP Verified Successfully';
		}else{
		  $obj['status'] = 0;
	    $obj['message'] = 'Wrong OTP';
		}
		echo json_encode($obj);
	}
	
	// 4. User Forgot Password
	public function forgotpassword(){
	  $obj = array();
		$userPhone = $_POST['userPhone'];
		
		// $otp = rand(1000,9999);
		$otp = 1111;
		$where = array(
		  'userPhone'    =>  $userPhone
		);
		
		$userCount = $this->general_model->getCount('mst_users',$where);
		$users = $this->general_model->get('mst_users',$where);
		if($userCount > 0){
	    $data = array(
	      'userOTP'             => $otp,
	      'userOTPGenDateTime'  => date('Y-m-d H:i:s')
	    );
		  $this->general_model->update('mst_users', $data, $where);
		    
	    // Send OTP in SMS
	   //  $apiKey = "38e906fa-6b13-4595-bf81-9effd6c442d8";
	   //  $clientID = "a33f172b-55c4-47da-871f-7a2ec88e6422";
	   //  $mesage = "Your request to reset the password for Bakery app need an OTP. Your OTP is :".$otp;
	    
		  // $data = array(
    //     'apikey'        => $apiKey,
    //     'clientid'      => $clientID,
    //     'msisdn'        => $phone,
    //     'sid'           => "FOODOY",
    //     'msg'           => $mesage,
    //     'fl'            =>"0",
    //     'gwid'          => 2
    //   );
    //   list($header,$content) =$this->PostRequest("http://sms.nettyfish.com/vendorsms/pushsms.aspx",$data);
      //echo $content;
		  
		  $obj['userId'] = $users[0]['userId'];
		  $obj['status'] = 1;
	    $obj['message'] = 'OTP Sent to given phone number';
		}else{
		  $obj['status'] = 0;
	    $obj['message'] = 'No Customer Registered with given Phone Number';
		}
		echo json_encode($obj);
	}
	

	// 5. Customer Reset Password
	public function resetPassword(){
	  $obj = array();
		$userId = $_POST['userId'];
		$userPassword = $_POST['userPassword'];
		
		$data = array(
		  'userPassword'    => md5($userPassword)
		);
		
		$where = array(
		  'userId'        => $userId 
		);
		
		$this->general_model->update('mst_users', $data, $where);
		
		$obj['status'] = 1;
	  $obj['message'] = 'Password Updated Successfully';
	     
	  echo json_encode($obj);
	}
	

	function PostRequest($url, $_data) {
    // convert variables array to string:
    $data = array(); 
    while(list($n,$v) = each($_data))
    {
        $data[] = "$n=$v";
    }
    $data = implode('&', $data);
    // format --> test1=a&test2=b etc.
    // parse the given URL
    $url = parse_url($url);
    if ($url['scheme'] != 'http') {
        die('Only HTTP request are supported !');
    }
    // extract host and path:
    $host = $url['host'];
    $path = $url['path'];
    // open a socket connection on port 80
    $fp = fsockopen($host, 80);
    // send the request headers:
    fputs($fp, "POST $path HTTP/1.1\r\n");
    fputs($fp, "Host: $host\r\n");
    fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
    fputs($fp, "Content-length: ". strlen($data) ."\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $data);
    $result = '';
    while(!feof($fp)) {
        // receive the results of the request
        $result .= fgets($fp, 128);
    }
    // close the socket connection:
    fclose($fp);
    // split the result header from the content
    $result = explode("\r\n\r\n", $result, 2);
    $header = isset($result[0]) ? $result[0] : '';
    $content = isset($result[1]) ? $result[1] : '';
    // return as array:
    return array($header, $content);
  }

  // 06. Dashboard
  public function dashboard(){
  	$obj = array();
  	$userId = $_POST['userId'];

  	$where = array('isDeleted' => 0, 'isActive' => 1);
    $obj['departmentCount'] = $this->general_model->getCount('mst_departments',$where);
    $obj['doctorsCount'] = $this->general_model->getCount('mst_doctors',$where);

    $wherePatients = array('user' => $userId, 'isDeleted' => 0);
    $obj['familyMembersCount'] = $this->general_model->getCount('link_user_patient',$wherePatients);

    $linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients)){
			foreach($linkedPatients as $linkedPatient){
				array_push($patients, $linkedPatient['patient']);
			}
			$where = array('trn_bookings.isCancelled' => 0);
			$obj['bookingsCount'] =$this->general_model->get_bookings_count($where, null, null, null, null, null, null, 'patient', $patients);
			$bookings =$this->general_model->get_bookings($where, null, null, null, null, null, null, 'patient', $patients);

			if(is_array($bookings)){
				$i=0;
				foreach($bookings as $booking){
					$obj['bookings'][$i]['bookingId'] = $booking['bookingId'];
					$obj['bookings'][$i]['date'] = date('d-m-Y', strtotime($booking['consultationDate']));
					$obj['bookings'][$i]['doctor'] = $booking['doctorFName']." ".$booking['doctorLName'];
					$obj['bookings'][$i]['patient'] = $booking['patientFName']." ".$booking['patientLName'];
					$obj['bookings'][$i]['status'] = $booking['bookingStatusName'];

					$i++;
				}
			}
		}else{
			$obj['bookingsCount'] = 0;
			$obj['bookings'] = array();
		}

		echo json_encode($obj);
  }

  // 07. Patients List
	public function patients(){
	  $obj = array();
	  $userId = $_POST['userId'];
    $where = array(
    		'link_user_patient.user' => $userId,
        'link_user_patient.isDeleted' => 0,
        'mst_patients.isActive'	=> 1,
        'mst_patients.isDeleted' => 0
   	);
	   
	  $linkedPatients = $this->general_model->get_linked_patients($where);
	   
	  if(isset($linkedPatients) && is_array($linkedPatients)){
			$i=0;
			foreach($linkedPatients as $linkedPatient){
        $obj['results'][$i]['patientId'] = $linkedPatient['patientId'];
		    $obj['results'][$i]['patientOPNumber'] = $linkedPatient['patientOPNumber'];
		    $obj['results'][$i]['patientFName'] = $linkedPatient['patientFName'];
				$obj['results'][$i]['patientLName'] = $linkedPatient['patientLName'];
		    $i++;
			}
			$obj['status'] = 1;
      $obj['message'] = "";
	   }else{
	    $obj['status'] = 0;
      $obj['message'] = "No Patients Found";
	   }
	   echo json_encode($obj);
	}

  // 08. Departments
	public function departments(){
		$obj = array();
		$where = array(
			'isDeleted'					=> 0,
			'isActive'					=> 1
		);
		$departments = $this->general_model->get('mst_departments', $where);
		if(isset($departments) && is_array($departments)){
			$i=0;
			foreach($departments as $department){
				$obj['results'][$i]['departmentId'] = $department['departmentId'];
				$obj['results'][$i]['departmentName'] = $department['departmentName'];
				$i++;
			}
			$obj['status'] = 1;
      $obj['message'] = "";
		}else{
			$obj['status'] = 0;
      $obj['message'] = "No Departments";
		}
		echo json_encode($obj);
	}

	// 09. Doctors
	public function doctors(){
		$obj = array();
		$department = $_POST['department'];

		$where = array(
			'doctorDepartment'	=> $department,
			'isDeleted'					=> 0,
			'isActive'					=> 1
		);
		$doctors = $this->general_model->get('mst_doctors', $where);
		if(isset($doctors) && is_array($doctors)){
			$i=0;
			foreach($doctors as $doctor){
				$obj['results'][$i]['doctorId'] = $doctor['doctorId'];
				$obj['results'][$i]['doctorFName'] = $doctor['doctorFName'];
				$obj['results'][$i]['doctorLName'] = $doctor['doctorLName'];
				$obj['results'][$i]['doctorQualifications'] = $doctor['doctorQualifications'];
				$obj['results'][$i]['doctorConsultationFee'] = $doctor['doctorConsultationFee'];
				$obj['results'][$i]['doctorPhoto'] = base_url().'uploads/doctors/'.$doctor['doctorPhoto'];
				$i++;
			}
			$obj['status'] = 1;
      $obj['message'] = "";
		}else{
			$obj['status'] = 0;
      $obj['message'] = "No Doctors";
		}
		echo json_encode($obj);
	}
	
	// 10. Booking Slots
	public function bookingslots(){
		$obj = array();
		$doctor = $_POST['doctor'];
		$weekDay = date('l',strtotime(str_replace('/','-',$_POST['consultationDate'])));
		$consultationDate = date('Y-m-d',strtotime(str_replace('/','-',$_POST['consultationDate'])));

		$whereLeaveCheck = array(
			'doctor'		=> $doctor,
			'leaveDate'	=> $consultationDate,
			'isDeleted'	=> 0
		);

		$leaveCheckCount = $this->general_model->getCount('trn_doctor_leaves',$whereLeaveCheck);

		if($leaveCheckCount == 0){
			$where = array(
				'doctor'	=> $doctor,
				'day'			=> $weekDay
			);

			$slots = $this->general_model->get_available_slots($where);

			if(isset($slots) && is_array($slots)){
				$i=0;
				foreach($slots as $slot){
					$whereCount = array(
						'consultationDate'		=> $consultationDate,
						'bookingSlot'					=> $slot['doctorSlotId']
					);
					$maxTokens = $slot['maxTokens'];
					$usedTokens = $this->general_model->getCount('trn_bookings',$whereCount);
					$availableTokens = $maxTokens - $usedTokens;
					if($availableTokens > 0){
						$obj['results'][$i]['doctorSlotId'] = $slot['doctorSlotId'];
						$obj['results'][$i]['slotName'] = $slot['slotName'];
						$obj['results'][$i]['availableTokens'] = $availableTokens;
						$i++;
					}
				}
				$obj['status'] = 1;
	      $obj['message'] = "";
			}else{
				$obj['status'] = 0;
	      $obj['message'] = "No Slots";
			}
		}else{
			$obj['status'] = 2;
	    $obj['message'] = "Doctor is on Leave";
		}
		echo json_encode($obj);
	}

	// 11. Add Booking
	public function addBooking(){
		$obj = array();
		$consultationDate = date('Y-m-d',strtotime(str_replace('/','-',$_POST['consultationDate'])));
		$weekDay = date('l',strtotime(str_replace('/','-',$_POST['consultationDate'])));
		$patient = $_POST['patient'];
		$doctor = $_POST['doctor'];
		$bookingSlot = $_POST['bookingSlot'];
		$consulationFee = $_POST['consulationFee'];

		$whereSlot = array(
			'doctorSlotId' => $bookingSlot
		);

		$slots = $this->general_model->get_available_slots($whereSlot);

		$whereCount = array(
			'consultationDate'		=> $consultationDate,
			'bookingSlot'					=> $bookingSlot
		);
		$maxTokens = $slots[0]['maxTokens'];
		$usedTokens = $this->general_model->getCount('trn_bookings',$whereCount);
		$availableTokens = $maxTokens - $usedTokens;

		if($availableTokens > 0){
			$whereToken = array(
				'consultationDate'	=> $consultationDate,
				'doctor'						=> $doctor
			);

			$tokenNumber = $this->general_model->getmax('tokenNumber','trn_bookings',$whereToken);

			$data = array(
				'bookingDate'				=> date('Y-m-d'),
				'consultationDate'	=> $consultationDate,
				'patient'						=> $patient,
				'doctor'						=> $doctor,
				'tokenNumber'				=> $tokenNumber,
				'bookingSlot'				=> $bookingSlot,
				'isOnline'					=> 1,
				'consulationFee'		=> $consulationFee,
				'paymentStatus'			=> 0,
				'bookingStatus'			=> 2
			);
			$this->general_model->insert('trn_bookings',$data);

			$obj['status'] = 1;
			$obj['tokenNumber'] = $tokenNumber;
		  $obj['message'] = "Booking Succesfully";
		}else{
			$obj['status'] = 0;
		  $obj['message'] = "No Available tokens in selected slot.";
		}

		

	  echo json_encode($obj);
	}

	// 12. My Bookings
	public function myBookings(){
		$obj = array();
	  $userId = $_POST['userId'];

	  $wherePatients = array('user' => $userId, 'isDeleted' => 0);

		$linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients)){
			foreach($linkedPatients as $linkedPatient){
				array_push($patients, $linkedPatient['patient']);
			}
			$where = array('trn_bookings.isCancelled' => 0);
			$bookings =$this->general_model->get_bookings($where, null, null, null, null, null, null, 'patient', $patients);

			if(isset($bookings) && is_array($bookings)){
				$i=0;
				foreach($bookings as $booking){
					$obj['results'][$i]['bookingId'] = $booking['bookingId'];
					$obj['results'][$i]['consultationDate'] = date('d-m-Y',strtotime($booking['consultationDate']));
					$obj['results'][$i]['patientOPNumber'] = $booking['patientOPNumber'];
					$obj['results'][$i]['patientFName'] = $booking['patientFName'];
					$obj['results'][$i]['patientLName'] = $booking['patientLName'];
					$obj['results'][$i]['slotName'] = $booking['slotName'];
					$obj['results'][$i]['tokenNumber'] = $booking['tokenNumber'];
					$obj['results'][$i]['doctorFName'] = $booking['doctorFName'];
					$obj['results'][$i]['doctorLName'] = $booking['doctorLName'];
					$obj['results'][$i]['consulationFee'] = $booking['consulationFee'];
					$obj['results'][$i]['bookingStatusName'] = $booking['bookingStatusName'];
					$i++;
				}
				$obj['status'] = 1;
	      $obj['message'] = "";
			}else{
				$obj['status'] = 0;
	      $obj['message'] = "No Bookings Found";
			}
		}else{
			$obj['status'] = 0;
	    $obj['message'] = "No Bookings Found";
		}

		echo json_encode($obj);
	}

	// 13. View Booking
	public function viewBooking(){
		$obj = array();
	  $userId = $_POST['userId'];
	  $bookingId = $_POST['bookingId'];

	  $wherePatients = array('user' => $userId, 'isDeleted' => 0);

		$linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients)){
			foreach($linkedPatients as $linkedPatient){
				array_push($patients, $linkedPatient['patient']);
			}
			$where = array('trn_bookings.bookingId' => $bookingId,);
			$singleBooking =$this->general_model->get_bookings($where, null, null, null, null, null, null, 'patient', $patients);

			$obj['booking']['patientOPNumber'] = $singleBooking[0]['patientOPNumber'];
			$obj['booking']['patientFName'] = $singleBooking[0]['patientFName'];
			$obj['booking']['patientLName'] = $singleBooking[0]['patientLName'];
			$obj['booking']['consultationDate'] = date('d F Y',strtotime($singleBooking[0]['consultationDate']));
			$obj['booking']['tokenNumber'] = $singleBooking[0]['tokenNumber'];
			$obj['booking']['doctorFName'] = $singleBooking[0]['doctorFName'];
			$obj['booking']['doctorLName'] = $singleBooking[0]['doctorLName'];
			$obj['booking']['slotName'] = $singleBooking[0]['slotName'];
			$obj['booking']['consulationFee'] = $singleBooking[0]['consulationFee'];
			$obj['booking']['bookingStatusName'] = $singleBooking[0]['bookingStatusName'];


			$whereDisease = array('booking' => $bookingId, 'link_booking_diseases.isDeleted' => 0);
			$bookingDiseases = $this->general_model->get_booking_diseases($whereDisease);

			if(is_array($bookingDiseases)){
				$i = 0;
				foreach($bookingDiseases as $bookingDisease){
					$obj['diseases'][$i]['diseaseName'] = $bookingDisease['diseaseName'];
					$i++;
				}
			}else{
				$obj['diseases'] = array();
			}

			$whereMedicine = array('booking' => $bookingId);
			$bookingMedicines = $this->general_model->get_booking_medicines($whereMedicine);

			if(is_array($bookingMedicines)){
				$i = 0;
				foreach($bookingMedicines as $bookingMedicine){
					$obj['medicines'][$i]['medicineName'] = $bookingMedicine['medicineName'];
					$obj['medicines'][$i]['dosage'] = $bookingMedicine['dosage'];
					$obj['medicines'][$i]['period'] = $bookingMedicine['period'];
					$obj['medicines'][$i]['remarks'] = $bookingMedicine['remarks'];
					$i++;
				}
			}else{
				$obj['medicines'] = array();
			}

			$whereLabtest = array('booking' => $bookingId);
			$bookingLabtests = $this->general_model->get_booking_labtests($whereLabtest);

			if(is_array($bookingLabtests)){
				$i = 0;
				foreach($bookingLabtests as $bookingLabtest){
					$obj['labtests'][$i]['labTestName'] = $bookingLabtest['labTestName'];
					$obj['labtests'][$i]['remarks'] = $bookingLabtest['remarks'];
					$i++;
				}
			}else{
				$obj['labtests'] = array();
			}	
			$obj['status'] = 1;
	    $obj['message'] = "";
		}else{
			$obj['status'] = 0;
	    $obj['message'] = "No Bookings Found";
			$obj['booking'] = array();
			$obj['medicines'] = array();
			$obj['labtests'] = array();
			$obj['diseases'] = array();
		}

		echo json_encode($obj);
	}

	// 14. Medicine PDF
	public function medicinePdf(){
		$obj = array();
	  $userId = $_POST['userId'];
	  $bookingId = $_POST['bookingId'];

	  $settings = $this->general_model->get('adm_settings');

	  $obj['info']['hospitalName'] = $settings[0]['hospitalName'];
	  $obj['info']['hospitalLogo'] = base_url().'/uploads/settings/'.$settings[0]['hospitalLogo'];
	  $obj['info']['hospitalAddress1'] = $settings[0]['hospitalAddress1'];
	  $obj['info']['hospitalAddress2'] = $settings[0]['hospitalAddress2'];
	  $obj['info']['hospitalCity'] = $settings[0]['hospitalCity'];
	  $obj['info']['hospitalState'] = $settings[0]['hospitalState'];
	  $obj['info']['hospitalCountry'] = $settings[0]['hospitalCountry'];
	  $obj['info']['hospitalPincode'] = $settings[0]['hospitalPincode'];
	  $obj['info']['hospitalContactNumber'] = $settings[0]['hospitalContactNumber'];
	  $obj['info']['hospitalWebsite'] = $settings[0]['hospitalWebsite'];
	  $obj['info']['hospitalPincode'] = $settings[0]['hospitalPincode'];

	  $wherePatients = array('user' => $userId, 'isDeleted' => 0);

		$linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients)){
			foreach($linkedPatients as $linkedPatient){
				array_push($patients, $linkedPatient['patient']);
			}
			$where = array('trn_bookings.bookingId' => $bookingId,);
			$singleBooking =$this->general_model->get_bookings($where, null, null, null, null, null, null, 'patient', $patients);

			$obj['booking']['patientOPNumber'] = $singleBooking[0]['patientOPNumber'];
			$obj['booking']['patientFName'] = $singleBooking[0]['patientFName'];
			$obj['booking']['patientLName'] = $singleBooking[0]['patientLName'];
			$obj['booking']['patientAddress1'] = $singleBooking[0]['patientAddress1'];
			$obj['booking']['patientAddress2'] = $singleBooking[0]['patientAddress2'];
			$obj['booking']['patientCity'] = $singleBooking[0]['patientCity'];
			$obj['booking']['patientState'] = $singleBooking[0]['patientState'];
			$obj['booking']['patientPhone'] = $singleBooking[0]['patientPhone'];
			$obj['booking']['consultationDate'] = date('d F Y',strtotime($singleBooking[0]['consultationDate']));
			$obj['booking']['tokenNumber'] = $singleBooking[0]['tokenNumber'];
			$obj['booking']['doctorFName'] = $singleBooking[0]['doctorFName'];
			$obj['booking']['doctorLName'] = $singleBooking[0]['doctorLName'];
			$obj['booking']['doctorQualifications'] = $singleBooking[0]['doctorQualifications'];
			$obj['booking']['slotName'] = $singleBooking[0]['slotName'];
			$obj['booking']['consulationFee'] = $singleBooking[0]['consulationFee'];
			$obj['booking']['bookingStatusName'] = $singleBooking[0]['bookingStatusName'];


			$whereMedicine = array('booking' => $bookingId);
			$bookingMedicines = $this->general_model->get_booking_medicines($whereMedicine);

			if(is_array($bookingMedicines)){
				$i = 0;
				foreach($bookingMedicines as $bookingMedicine){
					$obj['medicines'][$i]['medicineName'] = $bookingMedicine['medicineName'];
					$obj['medicines'][$i]['dosage'] = $bookingMedicine['dosage'];
					$obj['medicines'][$i]['period'] = $bookingMedicine['period'];
					$obj['medicines'][$i]['remarks'] = $bookingMedicine['remarks'];
					$i++;
				}
			}else{
				$obj['medicines'] = array();
			}

			
			$obj['status'] = 1;
	    $obj['message'] = "";
		}else{
			$obj['status'] = 0;
	    $obj['message'] = "No Bookings Found";
			$obj['booking'] = array();
			$obj['medicines'] = array();
		}

		echo json_encode($obj);
	}

	// 15. Lab Test PDF
	public function labtestPdf(){
		$obj = array();
	  $userId = $_POST['userId'];
	  $bookingId = $_POST['bookingId'];

	  $settings = $this->general_model->get('adm_settings');

	  $obj['info']['hospitalName'] = $settings[0]['hospitalName'];
	  $obj['info']['hospitalLogo'] = base_url().'/uploads/settings/'.$settings[0]['hospitalLogo'];
	  $obj['info']['hospitalAddress1'] = $settings[0]['hospitalAddress1'];
	  $obj['info']['hospitalAddress2'] = $settings[0]['hospitalAddress2'];
	  $obj['info']['hospitalCity'] = $settings[0]['hospitalCity'];
	  $obj['info']['hospitalState'] = $settings[0]['hospitalState'];
	  $obj['info']['hospitalCountry'] = $settings[0]['hospitalCountry'];
	  $obj['info']['hospitalPincode'] = $settings[0]['hospitalPincode'];
	  $obj['info']['hospitalContactNumber'] = $settings[0]['hospitalContactNumber'];
	  $obj['info']['hospitalWebsite'] = $settings[0]['hospitalWebsite'];
	  $obj['info']['hospitalPincode'] = $settings[0]['hospitalPincode'];

	  $wherePatients = array('user' => $userId, 'isDeleted' => 0);

		$linkedPatients = $this->general_model->get('link_user_patient', $wherePatients);
		$patients = array();
		if(is_array($linkedPatients)){
			foreach($linkedPatients as $linkedPatient){
				array_push($patients, $linkedPatient['patient']);
			}
			$where = array('trn_bookings.bookingId' => $bookingId,);
			$singleBooking =$this->general_model->get_bookings($where, null, null, null, null, null, null, 'patient', $patients);

			$obj['booking']['patientOPNumber'] = $singleBooking[0]['patientOPNumber'];
			$obj['booking']['patientFName'] = $singleBooking[0]['patientFName'];
			$obj['booking']['patientLName'] = $singleBooking[0]['patientLName'];
			$obj['booking']['patientAddress1'] = $singleBooking[0]['patientAddress1'];
			$obj['booking']['patientAddress2'] = $singleBooking[0]['patientAddress2'];
			$obj['booking']['patientCity'] = $singleBooking[0]['patientCity'];
			$obj['booking']['patientState'] = $singleBooking[0]['patientState'];
			$obj['booking']['patientPhone'] = $singleBooking[0]['patientPhone'];
			$obj['booking']['consultationDate'] = date('d F Y',strtotime($singleBooking[0]['consultationDate']));
			$obj['booking']['tokenNumber'] = $singleBooking[0]['tokenNumber'];
			$obj['booking']['doctorFName'] = $singleBooking[0]['doctorFName'];
			$obj['booking']['doctorLName'] = $singleBooking[0]['doctorLName'];
			$obj['booking']['doctorQualifications'] = $singleBooking[0]['doctorQualifications'];
			$obj['booking']['slotName'] = $singleBooking[0]['slotName'];
			$obj['booking']['consulationFee'] = $singleBooking[0]['consulationFee'];
			$obj['booking']['bookingStatusName'] = $singleBooking[0]['bookingStatusName'];


			$whereLabtest = array('booking' => $bookingId);
			$bookingLabtests = $this->general_model->get_booking_labtests($whereLabtest);

			if(is_array($bookingLabtests)){
				$i = 0;
				foreach($bookingLabtests as $bookingLabtest){
					$obj['labtests'][$i]['labTestName'] = $bookingLabtest['labTestName'];
					$obj['labtests'][$i]['remarks'] = $bookingLabtest['remarks'];
					$i++;
				}
			}else{
				$obj['labtests'] = array();
			}	
			$obj['status'] = 1;
	    $obj['message'] = "";
		}else{
			$obj['status'] = 0;
	    $obj['message'] = "No Bookings Found";
			$obj['booking'] = array();
			$obj['labtests'] = array();
		}

		echo json_encode($obj);
	}

	// 16. Family Members
	public function familymembers(){
		$obj = array();
	  $userId = $_POST['userId'];

	  $wherePatients = array('link_user_patient.user' => $userId, 'link_user_patient.isDeleted' => 0);
		$patients = $this->general_model->get_linked_patients($wherePatients);

		if(is_array($patients)){
			$i=0;
			foreach($patients as $patient){
				$obj['patients'][$i]['patientId'] = $patient['patientId'];
				$obj['patients'][$i]['patientFName'] = $patient['patientFName'];
				$obj['patients'][$i]['patientLName'] = $patient['patientLName'];
				$obj['patients'][$i]['patientOPNumber'] = $patient['patientOPNumber'];
				$obj['patients'][$i]['patientPhone'] = $patient['patientPhone'];
				$obj['patients'][$i]['patientCity'] = $patient['patientCity'];
				$i++;
			}
			$obj['status'] = 1;
	    $obj['message'] = "";
		}else{
			$obj['status'] = 0;
	    $obj['message'] = "No Members Found";
		}

		echo json_encode($obj);
	}

	// 17. Get Patient By OP Number
	public function get_patient_by_opnumber(){
		$obj = array();
	  $userId = $_POST['userId'];
	  $patientOPNumber = $_POST['patientOPNumber'];

	  $where = array(
			'patientOPNumber'	=> $patientOPNumber,
			'isActive'				=> 1,
			'isDeleted'				=> 0
		);

		$patients = $this->general_model->get('mst_patients',$where);

		if(is_array($patients)){
			foreach($patients as $patient){
				$whereCheck = array(
					'user'					=> $userId,
					'patient'				=> $patient['patientId'],
					'isDeleted'			=> 0
				);
				$checkCount = $this->general_model->getCount('link_user_patient',$whereCheck);
				if($checkCount == 0){
					$otp = "123456";
					$data = array(
						'patientOTP'					=> $otp,
						'patientOTPGenTime'		=> date('Y-m-d H:i:s')
					);
					$whereUpdate = array('patientId'=> $patient['patientId']);
					$this->general_model->update('mst_patients',$data, $whereUpdate);

					$obj['patients']['patientId'] = $patient['patientId'];
					$obj['patients']['patientOPNumber'] = $patient['patientOPNumber'];
					$obj['patients']['patientFName'] = $patient['patientFName'];
					$obj['patients']['patientLName'] = $patient['patientLName'];
					$obj['patients']['patientPhone'] = $patient['patientPhone'];

					$obj['status'] = 1;
	    		$obj['message'] = "";
				}else{
					$obj['status'] = 2;
	    		$obj['message'] = "Patient Already Linked";
				}
			}	
		}else{
			$obj['status'] = 0;
	    $obj['message'] = "No Patient Found";
		}
		echo json_encode($obj);
	}

	// 18. Get Patient By Phone Number
	function get_patient_by_phone(){
		$obj = array();
		$userId = $_POST['userId'];
		$patientPhone = $_POST['patientPhone'];

		$where = array(
			'patientPhone'		=> $patientPhone,
			'isActive'				=> 1,
			'isDeleted'				=> 0
		);

		$patients = $this->general_model->get('mst_patients',$where);

		if(is_array($patients)){
			foreach($patients as $patient){
				$whereCheck = array(
					'user'					=> $userId,
					'patient'				=> $patient['patientId'],
					'isDeleted'			=> 0
				);
				$checkCount = $this->general_model->getCount('link_user_patient',$whereCheck);
				if($checkCount == 0){
					$otp = "123456";
					$data = array(
						'patientOTP'					=> $otp,
						'patientOTPGenTime'		=> date('Y-m-d H:i:s')
					);
					$whereUpdate = array('patientId'=> $patient['patientId']);
					$this->general_model->update('mst_patients',$data, $whereUpdate);

					$obj['patients']['patientId'] = $patient['patientId'];
					$obj['patients']['patientOPNumber'] = $patient['patientOPNumber'];
					$obj['patients']['patientFName'] = $patient['patientFName'];
					$obj['patients']['patientLName'] = $patient['patientLName'];
					$obj['patients']['patientPhone'] = $patient['patientPhone'];

					$obj['status'] = 1;
	    		$obj['message'] = "";
				}else{
					$obj['status'] = 2;
	    		$obj['message'] = "Patient Already Linked";
				}
			}	
		}else{
			$obj['status'] = 0;
	    $obj['message'] = "No Patient Found";
		}
		echo json_encode($obj);
	}

	// 19. Add family Member
	public function addFamilyMember(){
		$obj = array();
		$userId = $_POST['userId'];
		$patientId = $_POST['patientId'];
		$patientOTP = $_POST['patientOTP'];

		$where = array('patientId'	=> $patientId);
		$patientDetails = $this->general_model->get('mst_patients',$where);
		$otp = $patientDetails[0]['patientOTP'];

		$patientOTPGenTime = $patientDetails[0]['patientOTPGenTime'];
		$start_date = new DateTime($patientOTPGenTime);
		$since_start = $start_date->diff(new DateTime());

		if($patientOTP == $otp){
			if($since_start->i < 5){
				$data = array(
					'user'		=> $userId,
					'patient'	=> $patientId
				);
				$this->general_model->insert('link_user_patient',$data);
				
				$obj['status'] = 1;
	    	$obj['message'] = "Patient Added Successfully";
			}else{
				$obj['status'] = 2;
	    	$obj['message'] = "OTP Expired";
			}
		}else{
			$obj['status'] = 0;
	    $obj['message'] = "Invalid OTP";
		}
		echo json_encode($obj);
	}

	// 20. Add New Patient
	public function addPatient(){
		$obj = array();
		$userId = $_POST['userId'];
		$patientFName = $_POST['patientFName'];
		$patientLName = $_POST['patientLName'];
		$patientPhone = $_POST['patientPhone'];
		$patientEmail = $_POST['patientEmail'];
		$patientAddress1 = $_POST['patientAddress1'];
		$patientAddress2 = $_POST['patientAddress2'];
		$patientCity = $_POST['patientCity'];
		$patientState = $_POST['patientState'];

		$data = array(
			'patientFName'						=> $patientFName,
			'patientLName'						=> $patientLName,
			'patientPhone'						=> $patientPhone,
			'patientEmail'						=> $patientEmail,
			'patientAddress1'					=> $patientAddress1,
			'patientAddress2'					=> $patientAddress2,
			'patientCity'							=> $patientCity,
			'patientState'						=> $patientState,
			'isActive'								=> 1
		);
		$patientId = $this->general_model->insert('mst_patients',$data);

		$dataLink = array(
			'user'			=> $userId,
			'patient'		=> $patientId
		);
		$this->general_model->insert('link_user_patient',$dataLink);

		$obj['status'] = 1;
		$obj['patientId'] = $patientId;
	  $obj['message'] = "Patient Added Successfully";

	  echo json_encode($obj);
	}
}
