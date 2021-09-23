<?php
class settings{
	var $setting_id = 0;
	var $caption='';
	var $value = '';
	var $unique_name='';


	function save(){
								$sqlarray = array(
								"caption"=>$this->caption,
								"value"=>$this->value,
								"unique_name"=>$this->unique_name,
								);
		if($this->setting_id>0){
			tep_db_perform(TABLE_SETTINGS,$sqlarray,'update',' setting_id="' . $this->setting_id . '"');
		}else{
			tep_db_perform(TABLE_SETTINGS,$sqlarray);
			$this->setting_id=tep_db_insert_id();
		}
	}
	
	function delete($id){
		$query = "delete from " . TABLE_SETTINGS . " where setting_id='" . $id . "';";
		tep_db_query($query);
	}
	
	function check_value($unique_value,$setting_id){
		$query	= "select * from " . TABLE_SETTINGS . " where unique_value='$unique_value' and setting_id='$setting_id'";
		$result	=	tep_db_query($query);
		if(tep_db_num_rows($result)>0)
		{
			return "exist";	
			
		}
		else
		return "not_found";
	}



	function get_value($unique_name){
		$query	= "select * from " . TABLE_SETTINGS . " where unique_name='$unique_name'";
		$result	=	tep_db_query($query);
		if(tep_db_num_rows($result)>0)
		{
			$arr = tep_db_fetch_array($result);
			return $arr['value'];
			
		}
		else
		return "empty";
	}
	
	function get_title($unique_name){
		$query	= "select * from " . TABLE_SETTINGS . " where unique_name='$unique_name'";
		$result	=	tep_db_query($query);
		if(tep_db_num_rows($result)>0)
		{
			$arr = tep_db_fetch_array($result);
			return $arr['caption'];
			
		}
		else
		return "empty";
	}
	
	
	
	
	function load($id){
		$sql = "select * from " . TABLE_SETTINGS . " where setting_id=" . $id;
		$sqlresult = tep_db_query($sql);
		$sqlarray = tep_db_fetch_array($sqlresult);
		if($sqlarray){
			$this->setting_id 		= isset($sqlarray['setting_id'])?$sqlarray['setting_id']:0;
			$this->caption 			= isset($sqlarray['caption'])?$sqlarray['caption']:'';
			$this->value			= isset($sqlarray['value'])?$sqlarray['value']:'';
			$this->unique_name 			= isset($sqlarray['unique_name'])?$sqlarray['unique_name']:'';
		}
	}
	

	function getlist(){
		$query = "select * from " . TABLE_SETTINGS;
		$query_sql=tep_db_query($query);
		$rowscount = tep_db_num_rows($query_sql);
		
		if($rowscount>0)
		{
				$result = array();
				while($query_result=tep_db_fetch_array($query_sql)){
				array_push($result, $query_result);
				}
				return $result;
		}
		else { return "empty"; }
	}

/////////////////////////////////end of class definition////////////////	
}
?>