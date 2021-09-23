<?php
class addresses	{
	var $hist_id 				=	0;
	var $hist_add1				=	'';
	var $hist_add2 				=	'';
	var $hist_sold_date 		= 	'';
	var $hist_SP 				= 	'';
	var $hist_bdrm				=	'';
	var $hist_sqft				=	'';


function save(){
				$sqlarray = array(
				"hist_add1"			=>	$this->hist_add1,
				"hist_add2"			=>	$this->hist_add2,
				"hist_add2"			=>	$this->hist_add2,
				"hist_sold_date"	=>	$this->hist_sold_date,
				"hist_SP"			=>	$this->hist_SP,
				"hist_bdrm"			=>	$this->hist_bdrm,
				"hist_sqft"			=>	$this->hist_sqft
				);
		if($this->hist_id>0)
			tep_db_perform(TABLE_HISTORICAL_IMPORTED_DATA,$sqlarray,'update',' hist_id="' . $this->hist_id . '"');
		else{
			tep_db_perform(TABLE_HISTORICAL_IMPORTED_DATA,$sqlarray);
			$this->hist_id=tep_db_insert_id();
		}
}
	
function delete($id){
		$query = "delete from " . TABLE_HISTORICAL_IMPORTED_DATA . " where hist_id='" . $id . "';";
		tep_db_query($query);
}
	
	
function load($id){
		
		$sql 			= 	"select * from " . TABLE_HISTORICAL_IMPORTED_DATA . " where hist_id=" . $id;
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);
		
		if($sqlarray){
			$this->hist_id 					= isset($sqlarray['hist_id'])		?	$sqlarray['hist_id']:0;
			$this->hist_add1 				= isset($sqlarray['hist_add1'])		?	$sqlarray['hist_add1']:'';
			$this->hist_add2 				= isset($sqlarray['hist_add2'])		?	$sqlarray['hist_add2']:'';
			$this->hist_sold_date 			= isset($sqlarray['hist_sold_date'])?	$sqlarray['hist_sold_date']:'';
			$this->hist_SP 					= isset($sqlarray['hist_SP'])		?	$sqlarray['hist_SP']:'';
			$this->hist_bdrm 				= isset($sqlarray['hist_bdrm'])		?	$sqlarray['hist_bdrm']:'';
			$this->hist_sqft 				= isset($sqlarray['hist_sqft'])		?	$sqlarray['hist_sqft']:'';
		}
}

/////////////////////////////////end of class definition////////////////	
}
?>