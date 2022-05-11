<?php 
class General_Model extends CI_Model {
	public function __construct() {
		$this->load->database();
		$this->load->library('encryption');
		$this->load->helper("date");
	}
	
	// select records
	function get($table_name = '', $where=array(),$limit=null,
	$offset=null,$order_by_field=null,
	$order_by_order=null,$like=null, $or_where=null)
	{
		if(!is_null($offset) and !is_null($limit)){
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null){
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) {
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) 
		{
			$this->db->or_where($or_where);
		}
		
		$rs = $this->db->get_where($table_name, $where);
		if($rs->num_rows() > 0)
		{
			return $rs->result_array();
		}
		else{
			return false;
		}
	}
	
	function getCount($table_name = '', $where=array(),$limit=null,
			$offset=null,$order_by_field=null,$order_by_order=null,
			$like=null, $or_where=null)
			{
		if(!is_null($offset) and !is_null($limit))
		{
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null)
		{
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like))
		 {
			foreach($like as $key=>$value)
			 {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) {
			$this->db->or_where($or_where);
		}
		
		$rs = $this->db->get_where($table_name, $where);
		return $rs->num_rows();
	}

	function getSum($field_name = '', $table_name = '', $where=array(),$limit=null,$offset=null,$order_by_field=null,$order_by_order=null,$like=null, $or_where=null){
		if(!is_null($offset) and !is_null($limit))
		{
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null)
		{
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) 
		{
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}

		$this->db->select_sum($field_name);
		
		if($or_where) {
			$this->db->or_where($or_where);
		}
		
		$rs = $this->db->get_where($table_name, $where);
		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}


	
	// get list of records for drop down
	function get_list($id_field_name,$value_field_name,$table_name,$init_list=array(),$where=array())
	 {
		$this->db->select($id_field_name);
		$this->db->select($value_field_name);
		$this->db->where($where);
		$rs = $this->db->get($table_name);
		if($rs->num_rows()>0)
		{
			$records = $rs->result_array();
			foreach($records as $record)
			{
				$init_list[$record[$id_field_name]] = $record[$value_field_name];
			}
			return $init_list;
		}
		else
		 {
			return array();
		 }
	 }
	

	function get_combined_list($id_field_name="",$value_field_name1="",$value_field_name2="",$value_field_name3="",$table_name="",$init_list=array(),$where=array()){

		$this->db->select($id_field_name);

		if($value_field_name1 != ""){
			$this->db->select($value_field_name1);
		}

		if($value_field_name2 != ""){
			$this->db->select($value_field_name2);
		}

		if($value_field_name3 != ""){
			$this->db->select($value_field_name3);
		}

		$this->db->where($where);
		$rs = $this->db->get($table_name);
		if($rs->num_rows()>0){
			$records = $rs->result_array();
			foreach($records as $record){
				$init_list[$record[$id_field_name]] = $record[$value_field_name1].'-'.$record[$value_field_name2].' '.$record[$value_field_name3];
			}
			return $init_list;
		}
		else{
			return $init_list;;
		}
	}

	function get_combined_list_two($id_field_name="",$value_field_name1="",$value_field_name2="",$table_name="",$init_list=array(),$where=array()){

		$this->db->select($id_field_name);

		if($value_field_name1 != ""){
			$this->db->select($value_field_name1);
		}

		if($value_field_name2 != ""){
			$this->db->select($value_field_name2);
		}

		$this->db->where($where);
		$rs = $this->db->get($table_name);
		if($rs->num_rows()>0){
			$records = $rs->result_array();
			foreach($records as $record){
				$init_list[$record[$id_field_name]] = $record[$value_field_name1].' '.$record[$value_field_name2];
			}
			return $init_list;
		}
		else{
			return $init_list;;
		}
	}

	function get_combined_list_two_hiphen($id_field_name="",$value_field_name1="",$value_field_name2="",$table_name="",$init_list=array(),$where=array()){

		$this->db->select($id_field_name);

		if($value_field_name1 != ""){
			$this->db->select($value_field_name1);
		}

		if($value_field_name2 != ""){
			$this->db->select($value_field_name2);
		}

		$this->db->where($where);
		$rs = $this->db->get($table_name);
		if($rs->num_rows()>0){
			$records = $rs->result_array();
			foreach($records as $record){
				$init_list[$record[$id_field_name]] = $record[$value_field_name1].' - '.$record[$value_field_name2];
			}
			return $init_list;
		}
		else{
			return $init_list;;
		}
	}

	function get_combined_list_four($id_field_name="",$value_field_name1="",$value_field_name2="",$value_field_name3="",$value_field_name4="",$table_name="",$init_list=array(),$where=array(),$where_in_field = null, $where_in = array()){

		$this->db->select($id_field_name);

		if($value_field_name1 != ""){
			$this->db->select($value_field_name1);
		}

		if($value_field_name2 != ""){
			$this->db->select($value_field_name2);
		}

		if($value_field_name3 != ""){
			$this->db->select($value_field_name3);
		}

		if($value_field_name4 != ""){
			$this->db->select($value_field_name4);
		}

		if(!empty($where_in) && $where_in_field !=null){
			$this->db->where_in($where_in_field, $where_in);
		}

		$this->db->where($where);
		$rs = $this->db->get($table_name);
		if($rs->num_rows()>0){
			$records = $rs->result_array();
			foreach($records as $record){
				$init_list[$record[$id_field_name]] = $record[$value_field_name1].'-'.$record[$value_field_name2].' '.$record[$value_field_name3].' '.$record[$value_field_name4];
			}
			return $init_list;
		}
		else{
			return $init_list;;
		}
	}	

	
	
	
	// create new record
	function insert($table_name = '', $data=array())
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}	

	// insert batch of records
	function insert_batch($table_name = '', $data=array()){
		$this->db->insert_batch($table_name,$data);
	}
	
	// update existing record
	function update($table_name = '', $data=array(),$where=array()){
		$this->db->update($table_name,$data,$where);
	}
	
	// delete existing record
	function delete($table_name = '', $where=array(), $multiple=false){
		if($multiple) {
			$this->db->where_in($where["key"], $where["value"]);
			$this->db->delete($table_name);
		} else {
			$this->db->delete($table_name,$where);
		}
	}
	
	
	// Check Admin Login
	function check_admin_login($userName='',$userPassword='')
	{
		$where = array(
			'adminUsername' 	=> $userName,
			'adminPassword' 	=> md5($userPassword),
			'isActive'			=> 1
		);
		$records = $this->get('adm_admin',$where);
		
		if($records != false)
		{//if email id and password available in db return true
			return $records[0];
		}
		else
		{// else return false
			return false;
		}
	}

	// Check Admin Login
	function check_user_login($userName='',$userPassword='')
	{
		$where = array(
			'userLogin'     => $userName,
			'userPassword' 	=> md5($userPassword)
		);
		$records = $this->get('mst_users',$where);
		
		if($records != false)
		{//if email id and password available in db return true
			return $records[0];
		}
		else
		{// else return false
			return false;
		}
	}

	// Check Admin Login
	function check_doctor_login($userName='',$userPassword='')
	{
		$where = array(
			'doctorLogin' 		=> $userName,
			'doctorPassword' 	=> md5($userPassword),
			'isActive'				=> 1,
			'isDeleted'				=> 0
		);
		$records = $this->get('mst_doctors',$where);
		
		if($records != false)
		{//if email id and password available in db return true
			return $records[0];
		}
		else
		{// else return false
			return false;
		}
	}

	// Check Admin Login
	function check_frontoffice_login($userName='',$userPassword='')
	{
		$where = array(
			'frontOfficeLogin' 			=> $userName,
			'frontOfficePassword' 	=> md5($userPassword),
			'isActive'							=> 1,
			'isDeleted'							=> 0
		);
		$records = $this->get('mst_frontoffices',$where);
		
		if($records != false)
		{//if email id and password available in db return true
			return $records[0];
		}
		else
		{// else return false
			return false;
		}
	}

	public function checkPassword($userId=0, $password=''){
		$where = array(
			'userId' => $userId,
			'userPassword' => md5($password)
		);
		$records = $this->get('users',$where);
		
		if($records != false)
		{//if email id and password available in db return true
			return $records[0];
		}
		else
		{// else return false
			return false;
		}
	}
	
	public function randomPassword() {
    	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    	$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	
	
	public function getmax($field_name,$table_name,$where=array()){
		
		$this->db->select_max($field_name);
		$this->db->where($where);
		$res1 = $this->db->get($table_name);
		if ($res1->num_rows() > 0) {
			$res2 = $res1->result_array();        			
		}
		$max = $res2[0][$field_name];
		if($max == NULL) return 1; else return $max+1;
	}
    
	function get_medicines($where=array(),$limit=null,$offset=null,$order_by_field=null,
	$order_by_order=null,$like=null, $or_where=null,$where_in_field = null, $where_in = array())
	{
		if(!is_null($offset) and !is_null($limit)){
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null){
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) {
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) {
			$this->db->or_where($or_where);
		}

		if(!empty($where_in) && $where_in_field !=null){
			$this->db->where_in($where_in_field, $where_in);
		}

		$this->db->select('mst_medicines.*');
		$this->db->select('mst_medicine_units.* ');
		$this->db->select('mst_medicine_shelves.* ');
		$this->db->select('mst_medicine_categories.* ');
		$this->db->select('mst_medicine_types.* ');
		 $this->db->select('mst_medicine_manufacturers.*');
		


		$this->db->join('mst_medicine_units', 'mst_medicines.medicineUnit = mst_medicine_units.medicineUnitId', 'left');
		 $this->db->join('mst_medicine_shelves', 'mst_medicines.medicineShelf = mst_medicine_shelves.medicineShelfId ', 'left');
		 $this->db->join('mst_medicine_categories', 'mst_medicines.medicineCategory = mst_medicine_categories.medicineCategoryId  ', 'left');
		$this->db->join('mst_medicine_types', 'mst_medicines.medicineType = mst_medicine_types.medicineTypeId ', 'left');
		$this->db->join('mst_medicine_manufacturers', 'mst_medicines.medicineManufacturer = mst_medicine_manufacturers.manufacturerId', 'left');
		
		

		$rs = $this->db->get_where('mst_medicines', $where);
		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}





	function get_doctors($where=array(),$limit=null,$offset=null,
	$order_by_field=null,$order_by_order=null,$like=null, $or_where=null)
	{
		if(!is_null($offset) and !is_null($limit)){
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null){
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) {
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) {
			$this->db->or_where($or_where);
		}

		$this->db->select('mst_doctors.*');
		$this->db->select('mst_departments.departmentName');


		$this->db->join('mst_departments', 'mst_doctors.doctorDepartment = mst_departments.departmentId', 'left');
		

		$rs = $this->db->get_where('mst_doctors', $where);
		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}

	function get_available_slots($where=array(),$limit=null,$offset=null,$order_by_field=null,$order_by_order=null,$like=null, $or_where=null){
		if(!is_null($offset) and !is_null($limit)){
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null){
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) {
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) {
			$this->db->or_where($or_where);
		}

		$this->db->select('link_doctor_slots.*');
		$this->db->select('mst_slots.slotName');


		$this->db->join('mst_slots', 'link_doctor_slots.slot = mst_slots.slotId', 'left');
		

		$rs = $this->db->get_where('link_doctor_slots', $where);
		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}

	function get_bookings($where=array(),$limit=null,$offset=null,$order_by_field=null,
	$order_by_order=null,$like=null, $or_where=null,$where_in_field = null, $where_in = array())
	{
		if(!is_null($offset) and !is_null($limit)){
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null){
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) {
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) {
			$this->db->or_where($or_where);
		}

		if(!empty($where_in) && $where_in_field !=null){
			$this->db->where_in($where_in_field, $where_in);
		}

		$this->db->select('trn_bookings.*');
		$this->db->select('mst_departments.departmentName');
		$this->db->select('mst_doctors.doctorFName,mst_doctors.doctorLName,mst_doctors.doctorQualifications');
		$this->db->select('mst_patients.*');
		$this->db->select('mst_slots.slotName');
		$this->db->select('sys_bookingstatus.bookingStatusName');


		$this->db->join('mst_doctors', 'trn_bookings.doctor = mst_doctors.doctorId', 'left');
		$this->db->join('mst_departments', 'mst_doctors.doctorDepartment = mst_departments.departmentId', 'left');
		$this->db->join('mst_patients', 'trn_bookings.patient = mst_patients.patientId', 'left');
		$this->db->join('link_doctor_slots', 'trn_bookings.bookingSlot = link_doctor_slots.doctorSlotId', 'left');
		$this->db->join('mst_slots', 'link_doctor_slots.slot = mst_slots.slotId', 'left');
		$this->db->join('sys_bookingstatus', 'trn_bookings.bookingStatus = sys_bookingstatus.bookingStatusId', 'left');
		

		$rs = $this->db->get_where('trn_bookings', $where);
		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}

	function get_bookings_count($where=array(),$limit=null,$offset=null,$order_by_field=null,$order_by_order=null,$like=null, $or_where=null,$where_in_field = null, $where_in = array()){
		if(!is_null($offset) and !is_null($limit)){
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null){
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) {
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) {
			$this->db->or_where($or_where);
		}

		if(!empty($where_in) && $where_in_field !=null){
			$this->db->where_in($where_in_field, $where_in);
		}

		$this->db->select('trn_bookings.*');
		$this->db->select('mst_departments.departmentName');
		$this->db->select('mst_doctors.doctorFName,mst_doctors.doctorLName');
		$this->db->select('mst_patients.patientFName, mst_patients.patientLName, mst_patients.patientOPNumber,mst_patients.patientPhone');
		$this->db->select('mst_slots.slotName');
		$this->db->select('sys_bookingstatus.bookingStatusName');


		$this->db->join('mst_doctors', 'trn_bookings.doctor = mst_doctors.doctorId', 'left');
		$this->db->join('mst_departments', 'mst_doctors.doctorDepartment = mst_departments.departmentId', 'left');
		$this->db->join('mst_patients', 'trn_bookings.patient = mst_patients.patientId', 'left');
		$this->db->join('mst_slots', 'trn_bookings.bookingSlot = mst_slots.slotId', 'left');
		$this->db->join('sys_bookingstatus', 'trn_bookings.bookingStatus = sys_bookingstatus.bookingStatusId', 'left');
		

		$rs = $this->db->get_where('trn_bookings', $where);
		return $rs->num_rows();
	}

	function get_linked_patients($where=array(),$limit=null,$offset=null,$order_by_field=null,$order_by_order=null,$like=null, $or_where=null){
		if(!is_null($offset) and !is_null($limit)){
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null){
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) {
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) {
			$this->db->or_where($or_where);
		}

		$this->db->select('link_user_patient.*');
		$this->db->select('mst_patients.*');


		$this->db->join('mst_patients','link_user_patient.patient = mst_patients.patientId', 'left');
		

		$rs = $this->db->get_where('link_user_patient', $where);
		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}

	function get_doctorleaves($where=array(),$limit=null,$offset=null,$order_by_field=null,$order_by_order=null,$like=null, $or_where=null){
		if(!is_null($offset) and !is_null($limit)){
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null){
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) {
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) {
			$this->db->or_where($or_where);
		}

		$this->db->select('trn_doctor_leaves.*');
		$this->db->select('mst_doctors.doctorFName,mst_doctors.doctorLName,mst_doctors.doctorPhone');
		$this->db->select('mst_departments.departmentName');


		$this->db->join('mst_doctors','trn_doctor_leaves.doctor = mst_doctors.doctorId', 'left');
		$this->db->join('mst_departments','mst_doctors.doctorDepartment = mst_departments.departmentId', 'left');
		

		$rs = $this->db->get_where('trn_doctor_leaves', $where);
		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}

	function get_booking_diseases($where=array(),$limit=null,$offset=null,$order_by_field=null,$order_by_order=null,$like=null, $or_where=null){
		if(!is_null($offset) and !is_null($limit)){
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null){
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) {
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) {
			$this->db->or_where($or_where);
		}

		$this->db->select('link_booking_diseases.*');
		$this->db->select('mst_diseases.diseaseName');


		$this->db->join('mst_diseases','link_booking_diseases.disease = mst_diseases.diseaseId', 'left');
		

		$rs = $this->db->get_where('link_booking_diseases', $where);
		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}

	function get_booking_medicines($where=array(),$limit=null,$offset=null,$order_by_field=null,$order_by_order=null,$like=null, $or_where=null){
		if(!is_null($offset) and !is_null($limit)){
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null){
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) {
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) {
			$this->db->or_where($or_where);
		}

		$this->db->select('link_booking_medicines.*');
		$this->db->select('mst_basic_medicines.medicineName');


		$this->db->join('mst_basic_medicines','link_booking_medicines.medicine = mst_basic_medicines.medicineId', 'left');
		

		$rs = $this->db->get_where('link_booking_medicines', $where);
		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}

	function get_booking_labtests($where=array(),$limit=null,$offset=null,$order_by_field=null,$order_by_order=null,$like=null, $or_where=null){
		if(!is_null($offset) and !is_null($limit)){
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null){
			$this->db->order_by($order_by_field, $order_by_order);
		}
		
		if($like !=null && is_array($like)) {
			foreach($like as $key=>$value) {			
				$this->db->like($key, $value); 
			}
		}
		
		if($or_where) {
			$this->db->or_where($or_where);
		}

		$this->db->select('link_booking_labtests.*');
		$this->db->select('mst_basic_lab_tests.labTestName');


		$this->db->join('mst_basic_lab_tests','link_booking_labtests.labtest = mst_basic_lab_tests.labTestId', 'left');
		

		$rs = $this->db->get_where('link_booking_labtests', $where);
		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}


	public function hex_getmax($field_name,$table_name, $where = array()){
		
		$this->db->select_max($field_name);
		$res1 = $this->db->get_where($table_name,$where);
		if ($res1->num_rows() > 0) {
			$res2 = $res1->result_array();        			
		}
		$max = $res2[0][$field_name];
		return $max;
	}
	
	public function hex_getmin($field_name,$table_name, $where = array()){
		
		$this->db->select_min($field_name);
		$res1 = $this->db->get_where($table_name,$where);
		if ($res1->num_rows() > 0) {
			$res2 = $res1->result_array();        			
		}
		$min = $res2[0][$field_name];
		return $min;
	}


} 