<?php
class rental_buildings	{
	
	var $city						=	'';
	var $title						=	'';
	var $address					=	'';
	var $user_id					=	0;
	var	$floor_no					=	'';
	var $package1					=	'';
	var $package2					=	'';
	var $package3					=	'';
	var $bedrooms					=	'';
	var $rental_id 					=	0;
	var $facilities					=	'';
	var $max_guests					=	'';
	var $description 				=	'';
	var $neighbourhood				=	'';
	var $specifications				=	'';
	var $taxes_percentage			=	'';
	var $accommodation_type			=	'';
	var $building_image_description	=	'';
	var $building_image_thumbnail 	= 	'';
	var $building_image_big_image 	= 	'';
	var $building_image_title		=	'';
	var $nightly_parking_fee		=	'';
	var $monthly_rental_fee			=	'';
	var $weekly_rental_fee			=	'';
	var $daily_rental_fee			=	'';
	var $building_image_id			=	'';
	var	$floorplan					=	'';
	var $table_images				=	TABLE_RENTAL_BUILDING_IMAGES;
	var $table_name					=	TABLE_RENTAL_BUILDING;
	var $table_records				=	TABLE_RENTAL_RECORDS;
	var $table_rental_users			=	TABLE_RENTAL_USERS;
	var $bathrooms					=	'';
	

function save(){
				$sqlarray = array(
				"city"							=>	$this->city,
				"title"							=>	$this->title,
				"user_id"						=>	$this->user_id,
				"address"						=>	$this->address,
				"bedrooms"						=>	$this->bedrooms,
				"floorplan"						=>	$this->floorplan,
				"package1"						=>	$this->package1,
				"package2"						=>	$this->package2,
				"package3"						=>	$this->package3,
				"floor_no"						=>	$this->floor_no,
				"bathrooms"						=>	$this->bathrooms,
				"facilities"					=>	$this->facilities,
				"max_guests"					=>	$this->max_guests,
				"description"					=>	$this->description,
				"specifications"				=>	$this->specifications,
				"neighbourhood"					=>	$this->neighbourhood,
				"daily_rental_fee"				=>	$this->daily_rental_fee,
				"taxes_percentage"				=>	$this->taxes_percentage,
				"weekly_rental_fee"				=>	$this->weekly_rental_fee,
				"monthly_rental_fee"			=>	$this->monthly_rental_fee,
				"accommodation_type"			=>	$this->accommodation_type,
				"nightly_parking_fee"			=>	$this->nightly_parking_fee,
				);
		if($this->rental_id>0)	tep_db_perform($this->table_name,$sqlarray,'update',' rental_id="' . $this->rental_id . '"');
		else {
			tep_db_perform($this->table_name,$sqlarray);
			$this->rental_id=tep_db_insert_id();
		}
}
	
function delete($id){
		$query = "delete from {$this->table_name}  where rental_id='$id';";
		tep_db_query($query);
}
	
	
function load($id){
		
		$sql 			= 	"select * from {$this->table_name}  where rental_id=$id";
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);
		
		if($sqlarray){
			$this->city 							= isset($sqlarray['city'])						?$sqlarray['city']:'';
			$this->title 							= isset($sqlarray['title'])						?$sqlarray['title']:'';
			$this->user_id 							= isset($sqlarray['user_id'])					?$sqlarray['user_id']:'';
			$this->address 							= isset($sqlarray['address'])					?$sqlarray['address']:'';
			$this->floor_no			 				= isset($sqlarray['floor_no'])					?$sqlarray['floor_no']:'';
			$this->package1			 				= isset($sqlarray['package1'])					?$sqlarray['package1']:'';
			$this->package2			 				= isset($sqlarray['package2'])					?$sqlarray['package2']:'';
			$this->package3			 				= isset($sqlarray['package3'])					?$sqlarray['package3']:'';
			$this->bedrooms 						= isset($sqlarray['bedrooms'])					?$sqlarray['bedrooms']:0;
			$this->floorplan 						= isset($sqlarray['floorplan'])					?$sqlarray['floorplan']:'';
			$this->bathrooms 						= isset($sqlarray['bathrooms'])					?$sqlarray['bathrooms']:0;
			$this->rental_id 						= isset($sqlarray['rental_id'])					?$sqlarray['rental_id']:0;			
			$this->max_guests 						= isset($sqlarray['max_guests'])				?$sqlarray['max_guests']:'';
			$this->facilities 						= isset($sqlarray['facilities'])				?$sqlarray['facilities']:'';
			$this->description 						= isset($sqlarray['description'])				?$sqlarray['description']:'';
			$this->neighbourhood 					= isset($sqlarray['neighbourhood'])				?$sqlarray['neighbourhood']:'';
			$this->specifications			 		= isset($sqlarray['specifications'])			?$sqlarray['specifications']:'';
			$this->taxes_percentage 				= isset($sqlarray['taxes_percentage'])			?$sqlarray['taxes_percentage']:'';
			$this->daily_rental_fee 				= isset($sqlarray['daily_rental_fee'])			?$sqlarray['daily_rental_fee']:'';
			$this->weekly_rental_fee 				= isset($sqlarray['weekly_rental_fee'])			?$sqlarray['weekly_rental_fee']:'';
			$this->monthly_rental_fee 				= isset($sqlarray['monthly_rental_fee'])		?$sqlarray['monthly_rental_fee']:'';
			$this->accommodation_type 				= isset($sqlarray['accommodation_type'])		?$sqlarray['accommodation_type']:'';
			$this->nightly_parking_fee 				= isset($sqlarray['nightly_parking_fee'])		?$sqlarray['nightly_parking_fee']:'';
			
		}
}


function getlist($options=''){
	
	
		
		if($options=='') {
			$query 			= 		"select concat(u.first_name,' ',u.last_name) as full_name,  b.* from {$this->table_name} b left join {$this->table_rental_users} u";
			$query		   .=		" on b.user_id = u.rental_user_id  order by rental_id DESC";
			
			
		}
		else 
		{

			$page			=		(!empty($options['page']))			? $options['page'] 				: '1';
			$rows			=		(!empty($options['rows_per_page']))	? $options['rows_per_page'] 	: '10';
			$order_by		=		(!empty($options['order_by']))		? $options['order_by'] 			: '';
			$total_pages	=		(!empty($options['total_pages']))	? $options['total_pages'] 		: '1';
			$sort_direction	=		(!empty($options['sort_direction']))? $options['sort_direction'] 	: 'desc';
			$parking		=		(!empty($options['parking']))		? $options['parking'] 			: '';
			$guests			=		(!empty($options['guests']))		? $options['guests'] 			: '';
			$city			=		(!empty($options['city']))			? $options['city'] 				: '';
			$admin			=		(!empty($options['admin']))			? $options['admin'] 			: '';
			$user_id		=		(!empty($options['user_id']))		? $options['user_id'] 			: '';
			$neighbourhood	=		(!empty($options['neighbourhood']))	? $options['neighbourhood'] 	: '';
			$checkin_date	=		(!empty($options['checkin_date']))	? date('Y-m-d H:i:s', strtotime($options['checkin_date'])) 		: '';
			$checkout_date	=		(!empty($options['checkout_date']))	? date('Y-m-d H:i:s', strtotime($options['checkout_date'])) 	: '';
            $bedrooms		=		(!empty($options['bedrooms']))		? $options['bedrooms']-1		: ''; 
			$is_admin		=		(isset($options['admin']))			? $options['admin']				: '0'; 
			
	       

			
			$subquery		=		 array();
			$subquery[]	   	=		($checkin_date!='')					? " (r.checkout_date is null OR r.checkout_date<'$checkin_date')":'';
			$subquery[]	   	=		($guests>0)							? " b.max_guests>='$guests'" :'';
			$subquery[]	   	=		($city!='')							? " b.city='$city'" :'';
			$subquery[]	   	=		($user_id>0)						? " b.user_id='$user_id'" :'';
			$subquery[]	   	=		($neighbourhood!='')				? " b.neighbourhood='$neighbourhood'" :'';
			$subquery[]	   	=		($bedrooms>="0" && $admin=='')		? " b.bedrooms='$bedrooms'":'';
			
			$order_by  		=		($order_by!='')						? "	order by b.$order_by $sort_direction":'';	
			$sub 			= 		array_filter($subquery);
			
			if(count($sub)>0) 		$subquery = " where ".implode(' and ',$sub);
			else			  		$subquery = '';

			$subquery		=		str_replace(" and b.bedrooms=''",'',$subquery);
			
			$end 			= 		$rows*($page-1);
			$limit 			= 		" limit $end,$rows";
			$limit			=		($is_admin==1)?'':$limit;
			$query			=		" select b.*,concat(u.first_name,' ',u.last_name) as full_name from {$this->table_name} b left join {$this->table_records} r ";
			$query		   .=		" on r.rental_id = b.rental_id left join {$this->table_rental_users} u on u.rental_user_id = b.user_id  $subquery";
			$query		   .=		" group by b.rental_id $order_by $limit";
		}

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
	
	
function getTotalRecords($options=''){
	    
		
		
		
			
		  /*$query 			=	"select count(*) as total from {$this->table_name} ";
		
		   $query_sql		=	tep_db_query($query);
		   $num_rows 		=	tep_db_num_rows($query_sql);
		
		   if($num_rows>0) {
				$query_result	=	tep_db_fetch_array($query_sql);
				
				return $query_result['total'];
		}
		else
		return 0;*/
		if($options=='') {
			$query 			= 		"select concat(u.first_name,' ',u.last_name) as full_name,  b.* from {$this->table_name} b left join {$this->table_rental_users} u";
			$query		   .=		" on b.user_id = u.rental_user_id  order by rental_id DESC";
			
			
		}
		else 
		{
           
			$page			=		(isset($options['page']))			? $options['page'] 				: '1';
			$rows			=		(isset($options['rows_per_page']))	? $options['rows_per_page'] 	: '10';
			$order_by		=		(isset($options['order_by']))		? $options['order_by'] 			: '';
			$total_pages	=		(isset($options['total_pages']))	? $options['total_pages'] 		: '1';
			$sort_direction	=		(isset($options['sort_direction']))	? $options['sort_direction'] 	: 'desc';
			$parking		=		(isset($options['parking']))		? $options['parking'] 			: '';
			$guests			=		(isset($options['guests']))			? $options['guests'] 			: '';			
			$city			=		(isset($options['city']))			? $options['city'] 				: '';
			$user_id		=		(isset($options['user_id']))		? $options['user_id'] 			: '';
			$neighbourhood	=		(isset($options['neighbourhood']))	? $options['neighbourhood'] 	: '';
			$checkin_date	=		(isset($options['checkin_date']))	? date('Y-m-d H:i:s', strtotime($options['checkin_date'])) 		: '';
			$checkout_date	=		(isset($options['checkout_date']))	? date('Y-m-d H:i:s', strtotime($options['checkout_date'])) 	: '';
            $bedrooms		=		(isset($options['bedrooms']))		? $options['bedrooms']-1		: '';
			$subquery		=		 array();
			$subquery[]	   	=		($checkin_date!='')					? " (r.checkout_date is null OR r.checkout_date<'$checkin_date')":'';
			$subquery[]	   	=		($guests>0)							? " b.max_guests>='$guests'" :'';
			$subquery[]	   	=		($city!='')							? " b.city='$city'" :'';
			$subquery[]	   	=		($user_id>0)						? " b.user_id='$user_id'" :'';
			$subquery[]	   	=		($neighbourhood!='')				? " b.neighbourhood='$neighbourhood'" :'';
			$subquery[]	   	=		($bedrooms>=0)						? " b.bedrooms='$bedrooms'" :'';
			$order_by  		=		($order_by!='')						? "	order by b.$order_by $sort_direction":'';	
			$sub 			= 		array_filter($subquery);
			
			if(count($sub)>0) $subquery = " where ".implode(' and ',$sub);
			else			  $subquery = '';

			
			
			$end 			= 		$rows*($page-1);
			$query			=		" select b.*,concat(u.first_name,' ',u.last_name) as full_name from {$this->table_name} b left join {$this->table_records} r ";
			$query		   .=		" on r.rental_id = b.rental_id left join {$this->table_rental_users} u on u.rental_user_id = b.user_id  $subquery";
			$query		   .=		" group by b.rental_id $order_by";
			        

		}

			$query_sql		=		tep_db_query($query);
			$num_rows 		= 		tep_db_num_rows($query_sql);
		    
			
		if($num_rows>0) {
				return $num_rows;
		}
		else
		return 0;

}

function getBuildingImagesList($rental_id) {
	
		$query 					=	"select * from {$this->table_images} where rental_id = $rental_id";
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
								"rental_id"				=>	$this->rental_id,
								"thumbnail"				=>	$this->building_image_thumbnail,
								"big_image"				=>	$this->building_image_big_image,
								"title"					=>	$this->building_image_title,
								"description"			=>	$this->building_image_description
								);
				
				if($this->building_image_id>0)
						tep_db_perform($this->table_images,$sqlarray,'update',' image_id="' . $this->building_image_id . '"');
				else {
						tep_db_perform($this->table_images,$sqlarray);
						$this->building_image_id=tep_db_insert_id();
				}					
}


function update_building_images(){
			
			$table = $this->table_images;
			$query = "update $table set title = '{$this->building_image_title}, description = '{$this->building_image_description}' where rental_id = {$this->rental_id}";
			tep_db_query($query);

}


function load_building_image($id){
	
		$sql 			= "select * from {$this->table_images} where image_id=$id"; 
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
							$query = "delete from {$this->table_images} where image_id = $image_id"; 
							tep_db_query($query);
}

function getPropertyImage($rental_id) { 

		$query 					=	"select * from {$this->table_images} where rental_id = $rental_id limit 0,1";
		$query_sql				=	tep_db_query($query);
		$num_rows 				=	tep_db_num_rows($query_sql);
		
		if($num_rows>0){
			
				
				$query_result=tep_db_fetch_array($query_sql);
				return $query_result['big_image'];
		}
		else  
		return "empty"; 


}



function getAvailableCities() { 

		$query 					=	"select city from {$this->table_name}  group by city order by city asc";
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


function getAvailableNeighbourhood($city) { 

		$query 					=	"select neighbourhood from {$this->table_name}  where city = '$city' group by neighbourhood order by neighbourhood asc"; 
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



/////////////////////////////////end of class definition////////////////	
}
?>