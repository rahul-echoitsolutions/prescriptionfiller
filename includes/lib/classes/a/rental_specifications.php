<?php
class rental_specifications	{
	var $specification_id 	=	0;
	var $title				=	'';
	var $description		=	'';
	var $rental_id 			=	'';
	var $availability 		= 	'';
	var $icon 				= 	'';
	var $table_name			=	TABLE_RENTAL_SPECIFICATIONS;

function save(){
				$sqlarray = array(
				"title"				=>	$this->title,
				"icon"				=>	$this->icon,
				"rental_id"			=>	$this->rental_id,
				"description"		=>	$this->description,
				"availability"		=>	$this->availability,
				);
		if	($this->specification_id>0)	tep_db_perform($this->table_name,$sqlarray,'update',' specification_id="' . $this->specification_id . '"');
		else {
				tep_db_perform($this->table_name,$sqlarray);
				$this->specification_id=tep_db_insert_id();
		}
}
	
function delete($id){
		$query = "delete from {$this->table_name}  where specification_id='" . $id . "';";
		tep_db_query($query);
}
	
	
function load($id){
		
		$sql 			= 	"select * from {$this->table_name}  where specification_id=" . $id;
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);
		
		if($sqlarray){
			
			$this->title 				= isset($sqlarray['title'])				?$sqlarray['title']:'';
			$this->icon		 			= isset($sqlarray['icon'])				?$sqlarray['icon']:'';
			$this->rental_id 			= isset($sqlarray['rental_id'])			?$sqlarray['rental_id']:'';
			$this->description 			= isset($sqlarray['description'])		?$sqlarray['description']:'';
			$this->availability 		= isset($sqlarray['availability'])		?$sqlarray['availability']:'';
			$this->specification_id 	= isset($sqlarray['specification_id'])	?$sqlarray['specification_id']:0;
		}
}


function getlist($rental_id){
		
		$query 			= 		"select * from {$this->table_name}  where rental_id = '$rental_id' and icon='' group by title order by specification_id DESC";
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
	
	

function getlistNew($id_list){
		
		$query 			= 		"select * from {$this->table_name}  where specification_id in($id_list) order by specification_id DESC";
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

function getlistGeneral(){
		
		$query 			= 		"select * from {$this->table_name} where icon!='' group by title order by title asc";
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

function getAllSpecifications(){
		
		$query 			= 		"select * from {$this->table_name} group by title order by title asc";
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

/////////////////////////////////end of class definition////////////////	
}
?>