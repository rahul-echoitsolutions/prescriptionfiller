<?php
class strata_buildings {
	var $building_id 		= 0;
	var $building_address	= '';
	var $building_password 	= '';
	var $table_name			= TABLE_STRATA_BUILDINGS;
	var $table_documents	= TABLE_STRATA_DOCUMENTS;



	function save(){
								$sqlarray = array(
									"building_address"				=>	$this->building_address,
									"building_password"				=>	$this->building_password,
									);
		if($this->building_id>0)	tep_db_perform($this->table_name,$sqlarray,'update',"building_id='{$this->building_id}'");
		else{
			tep_db_perform($this->table_name,$sqlarray);
			$this->building_id=tep_db_insert_id();
		}
	}
	
	function delete($id){
		$query = "delete from {$this->table_name} where building_id='$id';";
		tep_db_query($query);
	}
	
	
	function load($id){
		$sql 		= "select * from {$this->table_name} where building_id='$id'";
		$sqlresult 	= tep_db_query($sql);
		$sqlarray 	= tep_db_fetch_array($sqlresult);
		
		if($sqlarray){
			$this->building_id 					= isset($sqlarray['building_id'])		?	$sqlarray['building_id']:0;
			$this->building_address 			= isset($sqlarray['building_address'])	?	$sqlarray['building_address']:'';
			$this->building_password			= isset($sqlarray['building_password'])	?	$sqlarray['building_password']:'';
		}
	}
	

	function getlist(){
		$query			=	"select count(d.document_id) as total, b.* from {$this->table_name} b left join {$this->table_documents} d ";
		$query		   .=	"on d.building_id = b.building_id group by b.building_id order by 
        
        SUBSTRING(document_url, LOCATE(' ', document_url),200) ASC";
        
        
        
         //b.building_id DESC";
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
	
	
	
	function verifyBuildingPassword($password,$building_id){ 
		$sql = "select building_address from {$this->table_name}  where building_id = '$building_id' and building_password = '$password'";
		$row = tep_db_result_row($sql);
		if($row){
			return 1;
		}
		return 0;
	}

/////////////////////////////////end of class definition////////////////	
}
?>