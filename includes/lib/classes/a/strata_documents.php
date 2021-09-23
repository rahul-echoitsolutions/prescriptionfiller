<?php
class strata_documents {
	var $document_id 	= 0;
	var $building_id	= '';
	var $document_url 	= '';
	var $table_name		= TABLE_STRATA_DOCUMENTS;


	function save(){
								$sqlarray = array(
									"building_id"				=>	$this->building_id,
									"document_url"				=>	$this->document_url,
									);
		if($this->document_id>0)	tep_db_perform($this->table_name,$sqlarray,'update',"document_id='{$this->document_id}'");
		else{
			tep_db_perform($this->table_name,$sqlarray);
			$this->document_id=tep_db_insert_id();
		}
	}
	
	function delete($id){
		$query = "delete from {$this->table_name} where document_id='$id';";
		tep_db_query($query);
	}
	
	
	function load($id){
		$sql 		= "select * from {$this->table_name} where document_id='$id'";
		$sqlresult 	= tep_db_query($sql);
		$sqlarray 	= tep_db_fetch_array($sqlresult);
		
		if($sqlarray){
			$this->document_id 			= isset($sqlarray['document_id'])	?	$sqlarray['document_id']:0;
			$this->building_id 			= isset($sqlarray['building_id'])	?	$sqlarray['building_id']:'';
			$this->document_url			= isset($sqlarray['document_url'])	?	$sqlarray['document_url']:'';
		}
	}
	

	function getlist($building_id){
		$query			=	"select * from {$this->table_name} where building_id = '$building_id' order by document_id DESC";
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