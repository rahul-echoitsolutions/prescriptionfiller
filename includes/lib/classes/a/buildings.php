<?php
class buildings	{
	var $building_id 				=	0;
	var $building_name				=	'';
	var $building_address			=	'';
	var $building_description 		=	'';
	var $building_image_thumbnail 	= 	'';
	var $building_image_big_image 	= 	'';
	var $building_image_title		=	'';
	var $building_image_description	=	'';
	var $building_image_id			=	'';
	var $table_name					=	TABLE_BUILDING;

function save(){
				$sqlarray = array(
				"building_name"			=>	$this->building_name,
				"building_description"	=>	$this->building_description,
				"building_address"		=>	$this->building_address,
				);
		if($this->building_id>0)
			tep_db_perform($this->table_name,$sqlarray,'update',' building_id="' . $this->building_id . '"');
		else{
			tep_db_perform($this->table_name,$sqlarray);
			$this->building_id=tep_db_insert_id();
		}
}
	
function delete($id){
		$query = "delete from {$this->table_name}  where building_id='" . $id . "';";
		tep_db_query($query);
}
	
	
function load($id){
		
		$sql 			= 	"select * from {$this->table_name}  where building_id=" . $id;
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);
		
		if($sqlarray){
			$this->building_id 						= isset($sqlarray['building_id'])			?$sqlarray['building_id']:0;
			$this->building_name 					= isset($sqlarray['building_name'])			?$sqlarray['building_name']:'';
			$this->building_description 			= isset($sqlarray['building_description'])	?$sqlarray['building_description']:'';
			$this->building_address 				= isset($sqlarray['building_address'])		?$sqlarray['building_address']:'';
		}
}


function getlist(){
		
		$query 			= 		"select * from {$this->table_name}  order by building_id DESC";
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

function getBuildingImagesList($building_id) {
	
		$table_building_images	= TABLE_BUILDING_IMAGES;
		$query 					=	"select * from $table_building_images where building_id = $building_id";
		
		$query_sql				=	tep_db_query($query);
		$num_rows 				=	tep_db_num_rows($query_sql);
		
		if($num_rows>0){
			
				$result = array();
				while($query_result=tep_db_fetch_array($query_sql)){
				array_push($result, $query_result);
				}
				return $result;
		}
		else  
		return "empty"; 
		
}


function getBuildingImagesListFromAddress($address) {
	
		$table_building_images	= TABLE_BUILDING_IMAGES;
		$query 					=	"select b.*,i.* from {$this->table_name} b left join $table_building_images i on i.building_id = b.building_id  where b.building_address='$address'";
		$query_sql				=	tep_db_query($query);
		$num_rows 				=	tep_db_num_rows($query_sql);
		
		if($num_rows>0){
			
				$result = array();
				while($query_result=tep_db_fetch_array($query_sql)){
				array_push($result, $query_result);
				}
				return $result;
		}
		else  
		return "empty"; 
		
}




function add_building_images(){
		
								$sqlarray = array(
								"building_id"			=>	$this->building_id,
								"thumbnail"				=>	$this->building_image_thumbnail,
								"big_image"				=>	$this->building_image_big_image,
								"title"					=>	$this->building_image_title,
								"description"			=>	$this->building_image_description
								);
				
				if($this->building_image_id>0)
						tep_db_perform(TABLE_BUILDING_IMAGES,$sqlarray,'update',' image_id="' . $this->building_image_id . '"');
				else {
						tep_db_perform(TABLE_BUILDING_IMAGES,$sqlarray);
						$this->building_image_id=tep_db_insert_id();
				}					
}


function update_building_images(){
			
			$table = TABLE_BUILDING_IMAGES;
			$query = "update $table set title = '{$this->building_image_title}, description = '{$this->building_image_description}' where building_id = {$this->building_id}";
			tep_db_query($query);

}


function load_building_image($id){
	
		$sql 			= "select * from " . TABLE_BUILDING_IMAGES. " where image_id=$id"; 
		$sqlresult 		= tep_db_query($sql);
		$sqlarray 		= tep_db_fetch_array($sqlresult);
		
		if($sqlarray){
			$this->building_image_thumbnail 	= isset($sqlarray['thumbnail'])		?	$sqlarray['thumbnail']		:	0;
			$this->building_image_big_image 	= isset($sqlarray['big_image'])		?	$sqlarray['big_image']		:	'';
			$this->building_image_title 		= isset($sqlarray['title'])			?	$sqlarray['title']			:	'';
			$this->building_image_description 	= isset($sqlarray['description'])	?	$sqlarray['description']	:	'';
		}
}

function delete_building_image($image_id) {
	
							$this->load_building_image($image_id);
							if($this->building_image_thumbnail!='')					unlink("../images/buildings/".$this->building_image_thumbnail);
							if($this->building_image_big_image!='') 				unlink("../images/buildings/larger/".$this->building_image_big_image);
							$query = "delete from ". TABLE_BUILDING_IMAGES." where image_id = $image_id"; 
							tep_db_query($query);
}

function getBuildingAddresses(){

		$query 			=	"select DISTINCT(substring_index(hist_add1,' ',-3)) as address  from " . TABLE_HISTORICAL_IMPORTED_DATA;
		$query_sql		=	tep_db_query($query);
		$num_rows 		= 	tep_db_num_rows($query_sql);
		
		if($num_rows>0) {
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