<?php
class rental_records{
	var $record_id 					=	0;
	var $rental_id					=	'';
	var $user_id					=	'';
	var $checkin_date				=	'';
	var $checkout_date 				=	'';
	var $guests						=	'';
	var $parking					=	'';
	var $accommodation_charges		=	'';
	var $parking_charges			=	'';
	var $tax_charges				=	'';
	var $total_charges				=	'';
	var $table_name					=	TABLE_RENTAL_RECORDS;
	var $table_buildings			=	TABLE_RENTAL_BUILDING;

function save(){
				$sqlarray = array(
				"rental_id"							=>	$this->rental_id,
				"user_id"							=>	$this->user_id,
				"checkout_date"						=>	$this->checkout_date,
				"guests"							=>	$this->guests,
				"checkin_date"						=>	$this->checkin_date,
				"total_charges"						=>	$this->total_charges,
				"parking_charges"					=>	$this->parking_charges,
				"tax_charges"						=>	$this->tax_charges,
				"accommodation_charges"				=>	$this->accommodation_charges,
				"parking"							=>	$this->parking
				);
		if($this->record_id>0)	tep_db_perform($this->table_name,$sqlarray,'update',' record_id="' . $this->record_id . '"');
		else {
			tep_db_perform($this->table_name,$sqlarray);
			$this->record_id=tep_db_insert_id();
		}
}
	
function delete($id){
		$query = "delete from {$this->table_name}  where record_id='$id';";
		tep_db_query($query);
}
	
	
function load($id){
		
		$sql 			= 	"select * from {$this->table_name}    where record_id=$id";
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);
		
		if($sqlarray){
			$this->guests 								= isset($sqlarray['guests'])					?$sqlarray['guests']:'';
			$this->rental_id 							= isset($sqlarray['rental_id'])					?$sqlarray['rental_id']:'';
			$this->user_id 								= isset($sqlarray['user_id'])					?$sqlarray['user_id']:'';
			$this->checkin_date 						= isset($sqlarray['checkin_date'])				?$sqlarray['checkin_date']:'';
			$this->record_id 							= isset($sqlarray['record_id'])					?$sqlarray['record_id']:0;			
			$this->checkout_date 						= isset($sqlarray['checkout_date'])				?$sqlarray['checkout_date']:'';
			$this->parking 								= isset($sqlarray['parking'])					?$sqlarray['parking']:'';
			$this->accommodation_charges 				= isset($sqlarray['accommodation_charges'])		?$sqlarray['accommodation_charges']:'';
			$this->total_charges 						= isset($sqlarray['total_charges'])				?$sqlarray['total_charges']:'';
			$this->parking_charges 						= isset($sqlarray['parking_charges'])			?$sqlarray['parking_charges']:'';
			$this->tax_charges 							= isset($sqlarray['tax_charges'])				?$sqlarray['tax_charges']:'';
		}
}


function getlist($order_by=''){
		
		$order_by		=		($order_by!='')?$order_by:'record_id';
		$query 			= 		"select r.*,b.* from {$this->table_name} r left join {$this->table_buildings} b on r.rental_id = b.rental_id  order by r.$order_by DESC";
		$query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);
		
		if($num_rows>0)	{
			
				$result = array();
				while($query_result=tep_db_fetch_array($query_sql)){
				array_push($result, $query_result);
				}
				return $result;
		}
		else 
		return "empty";
}
	
	
function getTotalRecords(){

		$query 			=	"select count(*) as total from {$this->table_name}";
		$query_sql		=	tep_db_query($query);
		$num_rows 		=	tep_db_num_rows($query_sql);
		
		if($num_rows>0) {
				$query_result	=	tep_db_fetch_array($query_sql);
				return $query_result['total'];
		}
		else
		return "empty";

}


/////////////////////////////////end of class definition////////////////	
}
?>