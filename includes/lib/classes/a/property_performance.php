<?php
class property_performance{
	var $performance_id 	= 0;
	var $month_year			= '';
	var $properties_managed = '';
	var $properties_rented	= '';
	var $table_name			= TABLE_PROPERTY_PERFORMANCE;


	function save(){
								$sqlarray = array(
									"month_year"				=>	$this->month_year,
									"properties_managed"		=>	$this->properties_managed,
									"properties_rented"			=>	$this->properties_rented,
									);
		if($this->performance_id>0)	tep_db_perform($this->table_name,$sqlarray,'update',"performance_id='{$this->performance_id}'");
		else{
			tep_db_perform($this->table_name,$sqlarray);
			$this->performance_id=tep_db_insert_id();
		}
	}
	
	function delete($id){
		$query = "delete from {$this->table_name} where performance_id='$id';";
		tep_db_query($query);
	}
	
	
	function load($id){
		$sql 		= "select * from {$this->table_name} where performance_id='$id'";
		$sqlresult 	= tep_db_query($sql);
		$sqlarray 	= tep_db_fetch_array($sqlresult);
		
		if($sqlarray){
			$this->performance_id 				= isset($sqlarray['performance_id'])	?	$sqlarray['performance_id']:0;
			$this->month_year 					= isset($sqlarray['month_year'])		?	$sqlarray['month_year']:'';
			$this->properties_managed			= isset($sqlarray['properties_managed'])?	$sqlarray['properties_managed']:'';
			$this->properties_rented 			= isset($sqlarray['properties_rented'])	?	$sqlarray['properties_rented']:'';
		}
	}
	

	function getlist(){
		$query			=	"select * from {$this->table_name} order by performance_id DESC";
		$query_sql		=	tep_db_query($query);
		$rowscount 		= 	tep_db_num_rows($query_sql);
		
		if($rowscount>0)
		{
				$result = array();
				while($query_result=tep_db_fetch_array($query_sql)){
				array_push($result, $query_result);
				}
				return $result;
		}
		else return "empty";
	}

/////////////////////////////////end of class definition////////////////	
}
?>