<?php
class rental_messages{
	var $message_id			=	0;
	var $sender_first_name	=	'';
	var $sender_last_name	=	'';
	var $sender_email		=	'';
	var $sender_phone		=	'';
	var $city				=	'';
	var $state				=	'';
	var $country			=	'';
	var $rental_id			=	'';
	var $date_sent			=	'';
	var $address			=	'';
	var $checkin_date		=	'';
	var $checkout_date		= 	'';
	var $guests				= 	'';
	var $parking			=	'';
	var	$nightly_charges	=	'';
	var	$duration			=	'';
	var $tax				=	'';

	
	var $status				=	'new';
	var $table_name			=	TABLE_RENTAL_MESSAGES;

function save(){
		$sqlarray 			=	 array(
								"sender_first_name"	=>	$this->sender_first_name,
								"sender_last_name"	=>	$this->sender_last_name,
								"sender_email"		=>	$this->sender_email,
								"checkin_date"		=>	$this->checkin_date,
								"checkout_date"		=>	$this->checkout_date,
								"guests"			=>	$this->guests,
								"parking"			=>	$this->parking,
								"sender_phone"		=>	$this->sender_phone,
								"rental_id"			=>	$this->rental_id,
								"address"			=>	$this->address,
								"city"				=>	$this->city,
								"state"				=>	$this->state,
								"country"			=>	$this->country,
								"date_sent"			=>	$this->date_sent,
								"nightly_charges"	=>	$this->nightly_charges,
								"duration"			=>	$this->duration,
								"tax"				=>	$this->tax,
								"status"			=>	$this->status
								);
								
						
		$check_result = tep_db_fetch_array(tep_db_query("select count(*) as count from  {$this->table_name} where message_id='{$this->message_id}'"));
		if($check_result['count']>0) 	tep_db_perform($this->table_name,$sqlarray,'update',' message_id="' . $this->message_id . '"');
		else 							tep_db_perform($this->table_name,$sqlarray);
		
}
	
function delete($message_id){
		tep_db_query("delete from {$this->table_name} where message_id=$message_id");
}



function getlist(){
		$sql		=	"select concat(m.sender_first_name, ' ',m.sender_last_name) as sender_name, m.message_id, m.sender_email, m.date_sent, r.title, r.rental_id,m.tax,m.duration";
		$sql	   .=	" ,m.city,m.state,m.country,m.nightly_charges, m.sender_phone, m.address, m.status, m.guests,m.checkin_date,m.checkout_date,m.parking from {$this->table_name} m ";
		$sql	   .=	" left join ".TABLE_RENTAL_BUILDING." r on r.rental_id = m.rental_id";
		$sql	   .=	" order by m.message_id DESC";
		
		$query_sql	=	tep_db_query($sql);
		$result 	= 	array();
		while($query_result = tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
}



function load($msgID){
			$sql 						= "select * from {$this->table_name} where message_id=$msgID";
			$sqlresult 					= tep_db_query($sql);
			$sqlarray 					= tep_db_fetch_array($sqlresult);
			
			if($sqlarray){
			$this->guests 				= isset($sqlarray['guests'])			?	$sqlarray['guests']:'';
			$this->status 				= isset($sqlarray['status'])			?	$sqlarray['status']:'';
			$this->address 				= isset($sqlarray['address'])			?	$sqlarray['address']:'';
			$this->city 				= isset($sqlarray['city'])				?	$sqlarray['city']:'';
			$this->state 				= isset($sqlarray['state'])				?	$sqlarray['state']:'';
			$this->country 				= isset($sqlarray['country'])			?	$sqlarray['country']:'';
			$this->parking 				= isset($sqlarray['parking'])			?	$sqlarray['parking']:'';
			$this->date_sent 			= isset($sqlarray['date_sent'])			?	$sqlarray['date_sent']:'';
			$this->rental_id 			= isset($sqlarray['rental_id'])			?	$sqlarray['rental_id']:'';
			$this->message_id 			= isset($sqlarray['message_id'])		?	$sqlarray['message_id']:0;
			$this->sender_email 		= isset($sqlarray['sender_email'])		?	$sqlarray['sender_email']:'';
			$this->sender_phone 		= isset($sqlarray['sender_phone'])		?	$sqlarray['sender_phone']:'';
			$this->nightly_charges 		= isset($sqlarray['nightly_charges'])	?	$sqlarray['nightly_charges']:'';
			$this->duration 			= isset($sqlarray['duration'])			?	$sqlarray['duration']:'';
			$this->tax 					= isset($sqlarray['tax'])				?	$sqlarray['tax']:'';
			$this->checkin_date 		= isset($sqlarray['checkin_date'])		?	$sqlarray['checkin_date']:'';
			$this->checkout_date 		= isset($sqlarray['checkout_date'])		?	$sqlarray['checkout_date']:'';
			$this->sender_last_name 	= isset($sqlarray['sender_last_name'])	?	$sqlarray['sender_last_name']:'';			
			$this->sender_first_name 	= isset($sqlarray['sender_first_name'])	?	$sqlarray['sender_first_name']:'';
			}
}
	
/////////// ********** end of class ////////////////////
}
?>