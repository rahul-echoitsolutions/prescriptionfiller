<?php
class rental_users{
	var $rental_user_id 	= 0;
	var $password			= '';
	var $email 				= '';
	var $first_name			= '';
	var $address			= '';
	var $last_name			= '';
	var $city				= '';
	var $state				= '';
	var $country			= '';
	var $register_date		= '';
	var $table_name 		= TABLE_RENTAL_USERS;
	var $table_buildings	= TABLE_RENTAL_BUILDING;


	function save(){
		$sqlarray = array(
								"password"		=>	$this->password,
								"first_name"	=>	$this->first_name,
								"last_name"		=>	$this->last_name,
								"email"			=>	$this->email,
								"country"		=>	$this->country,
								"state"			=>	$this->state,
								"city"			=>	$this->city,
								"address"		=>	$this->address,
								"register_date"	=>	$this->register_date,
								);
		if($this->rental_user_id>0){ tep_db_perform($this->table_name,$sqlarray,'update',' rental_user_id="' . $this->rental_user_id . '"'); }
		else
		{
			tep_db_perform($this->table_name,$sqlarray);
			$this->rental_user_id=tep_db_insert_id();
		}
	}
	
	function delete($userid){
		$query = "delete from {$this->table_name}  where rental_user_id='$userid';";
		tep_db_query($query);
	}
	
	
	function load($userid){
		$sql 			= "select * from {$this->table_name}  where rental_user_id=$userid";
		$sqlresult 		= tep_db_query($sql);
		$sqlarray 		= tep_db_fetch_array($sqlresult);
		if($sqlarray){
			$this->rental_user_id 	= isset($sqlarray['rental_user_id'])?$sqlarray['rental_user_id']:0;
			$this->password 		= isset($sqlarray['password'])?$sqlarray['password']:'';
			$this->first_name 		= isset($sqlarray['first_name'])?$sqlarray['first_name']:'';
			$this->last_name 		= isset($sqlarray['last_name'])?$sqlarray['last_name']:'';
			$this->email 			= isset($sqlarray['email'])?$sqlarray['email']:'';
			$this->city 			= isset($sqlarray['city'])?$sqlarray['city']:'';
			$this->state 			= isset($sqlarray['state'])?$sqlarray['state']:'';
			$this->country 			= isset($sqlarray['country'])?$sqlarray['country']:'';
			$this->address 			= isset($sqlarray['address'])?$sqlarray['address']:'';
			$this->register_date	= isset($sqlarray['register_date'])?$sqlarray['register_date']:'';
		}
	}
	
	function getlist(){
		$query 		=	"select concat(u.first_name,' ',u.last_name) as full_name,u.rental_user_id,u.email,u.register_date, count(b.user_id) as total from {$this->table_name} u ";
		$query	   .=	" left join {$this->table_buildings} b on u.rental_user_id = b.user_id group by u.rental_user_id";
		$query_sql	=	tep_db_query($query);
		$rowscount	=	tep_db_num_rows($query_sql);
		
		$result = array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}
	
	
	function getusername($userid){ 
		$sql = "select first_name as username from {$this->table_name}  where rental_user_id=$userid";
		$row = tep_db_result_row($sql);
		if($row){
			return $row[0];
		}
		return '';
	}

	function getUserID($email){ 
		$sql = "select rental_user_id from {$this->table_name}  where email='$email'";
		$row = tep_db_result_row($sql);
		if($row){
			return $row[0];
		}
		return '';
	}

	
	function emailexists($email,$userid){ 
		$sql = "select count(*) as count from {$this->table_name}  where rental_user_id<>$userid and email='$email'";
		$row = tep_db_result_row($sql);
		if($row){
			if($row[0]>0) return true;
		}
		return false;
	}
	
		function fbemailexists($email){ 
		$sql = "select count(*) as count from {$this->table_name}  where email='$email'";
		$row = tep_db_result_row($sql);
		if($row){
			if($row[0]>0) return true;
		}
		return false;
	}

	
	
	
	function validate($login, &$error){
	$sql = "select rental_user_id from {$this->table_name}  where first_name='" . tep_db_input($login) . "'";
	#die();
		$row = tep_db_result_row($sql);
		if($row){
			if($row[0]>0){
				$this->load($row[0]);
				return true;
			}
		}
		$error="Invalid Login!";
		return false;
	}
	
	function validate_user(){
	$sql = "select rental_user_id from {$this->table_name}  where first_name='" . tep_db_input($this->first_name) . "' and password='" . tep_db_input($this->password) . "'";
	#die();
		$row = tep_db_result_row($sql);
		if($row){
			if($row[0]>0){
				$this->load($row[0]);
				if($this->address=='inactive')
				return 'inactive';
				else
				{
					return 'active';
				}
			}
		}
		return "invalid";
	}


	function checkIfEmailExists($email) { 
				$sql 		= "select * from {$this->table_name}  where email='{$this->email}'";
				$sqlresult 	= tep_db_query($sql);
				$rows 		= tep_db_num_rows($sqlresult);
				if($rows>0){
					return "1";
				}
				else return "0";
	}

	
	
}
?>