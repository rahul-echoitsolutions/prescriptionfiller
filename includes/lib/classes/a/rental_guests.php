<?php
class rental_guests{
	var $guest_id 				= 0;
	var $guest_first_name		= '';
	var $guest_email 			= '';
	var $guest_last_name		= '';
	var $guest_contact_no		= '';
	var $guest_address			= '';
	var $user_id				= 0;
	var $table_name 			= TABLE_RENTAL_GUESTS;
	var $table_rental_users		= TABLE_RENTAL_USERS;


	function save(){
		$sqlarray = array(
								"guest_first_name"	=>	$this->guest_first_name,
								"guest_last_name"	=>	$this->guest_last_name,
								"guest_address"		=>	$this->guest_address,
								"guest_email"		=>	$this->guest_email,
								"guest_contact_no"	=>	$this->guest_contact_no,
								"user_id"			=>	$this->user_id
								);
		if($this->guest_id>0){ tep_db_perform($this->table_name,$sqlarray,'update',' guest_id="' . $this->guest_id . '"'); }
		else
		{
			tep_db_perform($this->table_name,$sqlarray);
			$this->guest_id=tep_db_insert_id();
		}
	}
	
	function delete($guestid){
		$query = "delete from {$this->table_name}  where guest_id='$guestid';";
		tep_db_query($query);
	}
	
	
	function load($guestid){
		$sql 			= "select * from {$this->table_name}  where guest_id=$guestid";
		$sqlresult 		= tep_db_query($sql);
		$sqlarray 		= tep_db_fetch_array($sqlresult);
		if($sqlarray){
			$this->guest_id 		= isset($sqlarray['guest_id'])?$sqlarray['guest_id']:0;
			$this->user_id 			= isset($sqlarray['user_id'])?$sqlarray['user_id']:0;
			$this->guest_first_name = isset($sqlarray['guest_first_name'])?$sqlarray['guest_first_name']:'';
			$this->guest_last_name 	= isset($sqlarray['guest_last_name'])?$sqlarray['guest_last_name']:'';
			$this->guest_address 	= isset($sqlarray['guest_address'])?$sqlarray['guest_address']:'';
			$this->guest_email 		= isset($sqlarray['guest_email'])?$sqlarray['guest_email']:'';
			$this->guest_contact_no = isset($sqlarray['guest_contact_no'])?$sqlarray['guest_contact_no']:0;
		}
	}
	
	function getlist($options){
		
		$user_id	=	$options['user_id'];
		
		$subquery	=	($user_id>0)?" where g.user_id = '$user_id'":'';
		$query 		=	"select g.*,concat(u.first_name,' ',u.last_name) as full_name,u.rental_user_id from {$this->table_name} g ";
		$query	   .=	" left join {$this->table_rental_users} u on g.user_id = u.rental_user_id $subquery";
		$query_sql	=	tep_db_query($query);
		$rowscount	=	tep_db_num_rows($query_sql);
		
		$result = array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}
	
	

	function checkIfEmailExists($email) { 
				$sql 		= "select * from {$this->table_name}  where guest_email='{$this->guest_email}'";
				$sqlresult 	= tep_db_query($sql);
				$rows 		= tep_db_num_rows($sqlresult);
				if($rows>0){
					return "1";
				}
				else return "0";
	}
	
	
	
}
?>