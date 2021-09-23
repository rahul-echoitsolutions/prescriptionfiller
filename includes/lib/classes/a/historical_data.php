<?php
class historical_data{
	var $data_id 					=	'0';
	var $upload_date				=	'';
	var $import_status 				=	'0';
	var $uploaded_files_count		=	'0';


function save(){
		
		$sqlarray = array(
		"upload_date"			=>	$this->upload_date,
		"import_status"			=>	$this->import_status,
		"uploaded_files_count"	=>	$this->uploaded_files_count );

		if($this->data_id>0)	tep_db_perform(TABLE_HISTORICAL_DATA,$sqlarray,'update',' data_id="' . $this->data_id . '"');
		else {					tep_db_perform(TABLE_HISTORICAL_DATA,$sqlarray);	$this->data_id=tep_db_insert_id();	}
}
	
function delete($id){
	
		$query = "delete from " . TABLE_HISTORICAL_DATA . " where data_id='" . $id . "';";
		tep_db_query($query);
}
	
	
function load($id){
	
		$sql 		= 	"select * from " . TABLE_HISTORICAL_DATA . " where data_id=" . $id;
		$sqlresult 	= 	tep_db_query($sql);
		$sqlarray 	= 	tep_db_fetch_array($sqlresult);
		
		if($sqlarray){
			
			$this->data_id 					= isset($sqlarray['data_id'])?$sqlarray['data_id']:0;
			$this->upload_date 				= isset($sqlarray['upload_date'])?$sqlarray['upload_date']:'';
			$this->import_status			= isset($sqlarray['import_status'])?$sqlarray['import_status']:'';
			$this->uploaded_files_count 	= isset($sqlarray['uploaded_files_count'])?$sqlarray['uploaded_files_count']:'';
		}
}
	

function getlist($rows){
	
		$query 		= 	"select * from " . TABLE_HISTORICAL_IMPORTED_DATA. " limit 0,$rows";
		$query_sql	=	tep_db_query($query);
		$num_rows 	= 	tep_db_num_rows($query_sql);
		
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
	
	
function getTotalRecords(){

		$query 			=	"select count(*) as total from " . TABLE_HISTORICAL_IMPORTED_DATA;
		$query_sql		=	tep_db_query($query);
		$num_rows 		= 	tep_db_num_rows($query_sql);
		
		if($num_rows>0) {
				$query_result=tep_db_fetch_array($query_sql);
				return $query_result['total'];
		}
		
		else
		return "empty";

}

function getTotalBuildingRecords(){

		$query 			=	"select DISTINCT(substring_index(hist_add1,' ',-3))  from " . TABLE_HISTORICAL_IMPORTED_DATA;
		$query_sql		=	tep_db_query($query);
		$num_rows 		= 	tep_db_num_rows($query_sql);
		
		if($num_rows>0) {
				return $num_rows;
		}
		
		else
		return "empty";

}

function getlistBuildings($rows){
	
		$query 		= 	"select  DISTINCT(substring_index(hist_add1,' ',-3)) as hist_add1,hist_id from " . TABLE_HISTORICAL_IMPORTED_DATA. " limit 0,$rows"; 
		$query_sql	=	tep_db_query($query);
		$num_rows 	= 	tep_db_num_rows($query_sql);
		
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


function getTotalRecordsSales($address_id,$building_address=''){
	
		$data_table  	= TABLE_HISTORICAL_IMPORTED_DATA;
		
		if($building_address!='')
			$query 		= "select count(*) as total from $data_table where hist_add1 like '%$building_address%'";
		else
			$query 		= "select count(*) as total from $data_table where hist_add1 = (select hist_add1 from $data_table where hist_id = '$address_id')";

		$query_sql		=	tep_db_query($query);
		$num_rows 		= 	tep_db_num_rows($query_sql);
		
		if($num_rows>0){
			
				$query_result	=	tep_db_fetch_array($query_sql);
				return $query_result['total'];
		}
		
		else
		return "empty";
}




function GetRecordsSales($address_id,$building_address='',$start_date='',$end_date=''){
		
		$data_table  = TABLE_HISTORICAL_IMPORTED_DATA;
		
		if($building_address=='') {
		$query 	= 	"select hist_id,CAST(replace(hist_SP,',','') as SIGNED INTEGER) as hist_SP, hist_add1,hist_add2,hist_sold_date,hist_bdrm from $data_table ";
		$query .= 	"where hist_add1 = (select hist_add1 from $data_table where hist_id = '$address_id') group by hist_sold_date,hist_SP ";
		$query .=	"order by str_to_date(hist_sold_date,'%m/%d/%Y') ASC";
		}
		else if($start_date=='') {
			$five_yr=	"  and (str_to_date(hist_sold_date,'%m/%d/%Y') BETWEEN DATE_SUB(CURDATE() ,INTERVAL 10 YEAR ) AND CURDATE())";
			$query 	= 	"select hist_id,CAST(replace(hist_SP,',','') as SIGNED INTEGER) as hist_SP, hist_add1,hist_add2,hist_sold_date,hist_bdrm from $data_table ";
			$query .= 	"where hist_add1 like '%$building_address%' $five_yr group by hist_sold_date,hist_SP order by str_to_date(hist_sold_date,'%m/%d/%Y') ASC";
		}
		else {
			$start_date = date('Y-m-d',strtotime($start_date));
			$end_date = date('Y-m-d',strtotime($end_date));		
			$five_yr=	"  and (str_to_date(hist_sold_date,'%m/%d/%Y') BETWEEN '$start_date' and '$end_date' )";
			$query 	= 	"select hist_id,CAST(replace(hist_SP,',','') as SIGNED INTEGER) as hist_SP, hist_add1,hist_add2,hist_sold_date,hist_bdrm from $data_table ";
			$query .= 	"where hist_add1 like '%$building_address%' $five_yr group by hist_sold_date,hist_SP order by str_to_date(hist_sold_date,'%m/%d/%Y') ASC";	
		}
		
		$query_sql		=	tep_db_query($query);
		$num_rows 		= 	tep_db_num_rows($query_sql);
		
		if($num_rows>0) {
				
				$rs = array();
				while($query_result=tep_db_fetch_array($query_sql)){
				array_push($rs, $query_result);
				}
				return $rs;

		}
		else
		return "empty";
}
	
function getLastSale($building_address) {
	
		$data_table		= 	TABLE_HISTORICAL_IMPORTED_DATA;
		$query			= 	"select * from $data_table where hist_add1 like '%$building_address%' order by  str_to_date(hist_sold_date,'%m/%d/%Y') DESC limit 0,1"; 
		$query_sql		=	tep_db_query($query);
		$num_rows 		= 	tep_db_num_rows($query_sql);

		if($num_rows>0) {
		$query_result=tep_db_fetch_array($query_sql);
		return $query_result;
		}
		else
		return 'empty';

}

function getlistAjax($options){
			
			$sort_by			= $options['sort_by'];
			$sort_direction 	= $options['sort_direction'];
			$rows_per_page 		= $options['rows_per_page'];	 
			$page				= $options['page'];
			$total_pages		= $options['total_pages'];
			$search_keyword 	= $options['search_keyword'];
			$distinct_address	= $options['distinct_address'];
			$subquery 			= '';
			$limit 				= '';
			$group_by			= '';
			

			if($distinct_address==1)
				$group_by 		= " group by hist_add1";
				
			if($search_keyword!='')
				$subquery 		.= " where hist_add1 like '%$search_keyword%'";
				
			if($sort_by	!='' && $sort_by !='hist_sold_date' && $sort_by !='hist_SP')
				$subquery 		.= " $group_by order by $sort_by $sort_direction";
				
			if($sort_by=='hist_sold_date')
				$subquery 		.= "$group_by order by str_to_date(hist_sold_date,'%m/%d/%Y') $sort_direction";	
				
			if($sort_by=='hist_SP')
				$subquery 		.= " order by CAST(replace(hist_SP,',','') as signed integer) $sort_direction ";	
				
				
			if($total_pages>0) {
									$end 	= ($rows_per_page*($page-1));
				if($page>1)			$limit 	= " limit $end,$rows_per_page";
				if ($page==1)		$limit 	= " limit 0,$rows_per_page";
			}
			
			$query 		= 	"select * from " . TABLE_HISTORICAL_IMPORTED_DATA . " $subquery  $limit "; 
			$result		=	tep_db_query($query);
			$num_rows 	= 	tep_db_num_rows($result);
		
			if($num_rows>0)
			{
					$rs = array();
					while($query_result=tep_db_fetch_array($result)){
					array_push($rs, $query_result);
					}
					return $rs;
			}
			else
			return "empty";
}

function getlistAjaxBuildings($options){
			
			$sort_by			= $options['sort_by'];
			$sort_direction 	= $options['sort_direction'];
			$rows_per_page 		= $options['rows_per_page'];	 
			$page				= $options['page'];
			$total_pages		= $options['total_pages'];
			$search_keyword 	= $options['search_keyword'];
			$distinct_address	= $options['distinct_address'];
			$subquery 			= '';
			$limit 				= '';
			$group_by			= " group by hist_add";
			

	
			if($search_keyword!='')
				$subquery .= " where hist_add1 like '%$search_keyword%'";
				
			if($sort_by	!='' && $sort_by !='hist_sold_date' && $sort_by !='hist_SP' && $sort_by!='hist_add1')
				$subquery .= " $group_by order by $sort_by $sort_direction";
				
			if($sort_by=='hist_sold_date')
				$subquery .= "$group_by order by str_to_date(hist_sold_date,'%m/%d/%Y') $sort_direction";	
				
			if($sort_by=='hist_SP')
				$subquery .= " $group_by order by CAST(replace(hist_SP,',','') as signed integer) $sort_direction ";
			
			if($sort_by=='hist_add1' && $search_keyword=='')
				$subquery .= " $group_by order by cast(substring_index(hist_add1,' ',-2) as char),cast(substring_index(hist_add1,' ',-3) as unsigned) $sort_direction ";	
			
			if($sort_by=='hist_add1' && $search_keyword!='')
				$subquery .= " $group_by order by cast(substring_index(hist_add1,' ',-3) as unsigned) $sort_direction ";	
	
								
				
			
			if($total_pages>0) {
				
											$end 	= ($rows_per_page*($page-1));
						if($page>1)			$limit 	= " limit $end,$rows_per_page";
						if ($page==1)		$limit 	= " limit 0,$rows_per_page";
			}
			
			$query 		= 	"select substring_index(hist_add1,' ',-3) as hist_add,hist_add1  from " . TABLE_HISTORICAL_IMPORTED_DATA . " $subquery $limit";
			$result		=	tep_db_query($query);
			$num_rows 	= 	tep_db_num_rows($result);
		
			if($num_rows>0)
			{
					$rs = array();
					while($query_result=tep_db_fetch_array($result)){
					array_push($rs, $query_result);
					}
					return $rs;
			}
			else
			return "empty";
}

	
function getListAjaxTotalRecords($options){
			
			$sort_by			= 	$options['sort_by'];
			$sort_direction 	= 	$options['sort_direction'];
			$rows_per_page 		= 	$options['rows_per_page'];	 
			$page				= 	$options['page'];
			$total_pages		= 	$options['total_pages'];
			$search_keyword 	= 	$options['search_keyword'];
			$distinct_address	= 	$options['distinct_address'];
			$subquery 			=	'';
			$limit 				=	'';
			$group_by 			= 	'';
			

			if($distinct_address==1)
				$group_by = " group by hist_add1";
	
			if($search_keyword!='')
				$subquery .= " where hist_add1 like '%$search_keyword%'";
				
			$query 			= 	"select  * from " . TABLE_HISTORICAL_IMPORTED_DATA . " $subquery $group_by"; 
			$result			=	tep_db_query($query);
			$num_rows 		= 	tep_db_num_rows($result);
			
			if($num_rows>0) return $num_rows;
			else 			return "empty"; 
}



function getListAjaxBuildingsTotalRecords($options){
			
			$sort_by			= 	$options['sort_by'];
			$sort_direction 	= 	$options['sort_direction'];
			$rows_per_page 		= 	$options['rows_per_page'];	 
			$page				= 	$options['page'];
			$total_pages		= 	$options['total_pages'];
			$search_keyword 	= 	$options['search_keyword'];
			$distinct_address	= 	$options['distinct_address'];
			$subquery 			=	'';
			$limit 				=	'';
			$group_by 			= 	'';
			

	
			if($search_keyword!='')
				$subquery .= " where hist_add1 like '%$search_keyword%'"; 
				
				
			$query 			= 	"select DISTINCT(substring_index(hist_add1,' ',-3))   from " . TABLE_HISTORICAL_IMPORTED_DATA . " $subquery $group_by"; 
			$result			=	tep_db_query($query);
			$num_rows 		= 	tep_db_num_rows($result);
			
			if($num_rows>0) return $num_rows;
			else 			return "empty"; 
}


	
function add_uploaded_file($source) {
		
		$sqlarray = array (
						'path' 		=> $source,
						'data_id'	=> $this->data_id
					  );
		
		tep_db_perform(TABLE_HISTORICAL_DATA_FILES,$sqlarray);		
}


function import_data($source) {
		
	$table  = TABLE_HISTORICAL_IMPORTED_DATA;
	$query  = "LOAD DATA LOCAL INFILE  '$source' INTO TABLE  `$table` FIELDS TERMINATED BY  '\t' LINES TERMINATED BY  '\n'";
	$query .= " IGNORE 1 LINES (`hist_add1` ,  `hist_add2` ,  `hist_sold_date` ,  `hist_SP` ,  `hist_bdrm` ,  `hist_sqft`)";
	tep_db_query($query);


}

function cleandata() {
		
	$table = TABLE_HISTORICAL_IMPORTED_DATA;
	$query = "delete FROM `$table` WHERE  `hist_sold_date`=''";
	tep_db_query($query);
	$query = "UPDATE $table SET `hist_add1` = trim(REPLACE(`hist_add1`, '# ', ''))";
	tep_db_query($query);

}


function getSalesListAjax($options){
			
			$sort_by			= $options['sort_by'];
			$sort_direction 	= $options['sort_direction'];
			$rows_per_page 		= $options['rows_per_page'];	 
			$page				= $options['page'];
			$total_pages		= $options['total_pages'];
			$search_keyword 	= $options['search_keyword'];
			$address_id			= $options['address_id'];
			$start_date			= $options['start_date'];
			$end_date			= $options['end_date'];
			$sql_start_date 	= date('Y-m-d',strtotime($start_date)); // convert  to mysql date format
			$sql_end_date 		= date('Y-m-d',strtotime($end_date)); // convert to mysql date format
			$subquery 			= '';
			$limit 				= '';
			$data_table 		= TABLE_HISTORICAL_IMPORTED_DATA;
		
			
			if($search_keyword!='')					$subquery .= " and hist_add1 like '%$search_keyword%'";
			if($start_date!='' && $end_date!='')	$subquery .= " and str_to_date(hist_sold_date,'%m/%d/%Y') between '$sql_start_date' and '$sql_end_date'";	
			if($sort_by='hist_add1')				$subquery .= "  order by $sort_by $sort_direction";
			if($sort_by=='hist_sold_date') 			$subquery .= " order by str_to_date(hist_sold_date,'%m/%d/%Y') $sort_direction";	
			if($sort_by=='hist_SP')					$subquery .= " order by CAST(replace(hist_SP,',','') as signed integer) $sort_direction ";	
				
			if($total_pages>0) {
										$end   =	($rows_per_page*($page-1));
						if($page>1) 	$limit =	" limit $end,$rows_per_page";
						if ($page==1)	$limit =	" limit 0,$rows_per_page";
			}
		
			$query 			= 	"select * from $data_table  where hist_add1 = (select hist_add1 from $data_table where hist_id = '$address_id')  $subquery  $limit ";
			$result			=	tep_db_query($query);
			$num_rows 		=	tep_db_num_rows($result);
		
			if($num_rows>0)	{
				$rs = array();
				while($query_result=tep_db_fetch_array($result)){
				array_push($rs, $query_result);
				}
				return $rs;
			}
			else	return "empty";
}

function getSalesListAjaxTotalRecords($options){
			
			$sort_by			= $options['sort_by'];
			$sort_direction 	= $options['sort_direction'];
			$rows_per_page 		= $options['rows_per_page'];	 
			$page				= $options['page'];
			$total_pages		= $options['total_pages'];
			$search_keyword 	= $options['search_keyword'];
			$address_id			= $options['address_id'];
			$start_date			= $options['start_date'];
			$end_date			= $options['end_date'];
			$sql_start_date 	= date('Y-m-d',strtotime($start_date)); // convert  to mysql date format
			$sql_end_date 		= date('Y-m-d',strtotime($end_date)); // convert to mysql date format
			$subquery 			= '';
			$limit 				= '';
			$data_table 		= TABLE_HISTORICAL_IMPORTED_DATA;
			
			if($search_keyword!='')					$subquery 		.= " and hist_add1 like '%$search_keyword%'";
			if($start_date!='' && $end_date!='')	$subquery 		.= " and str_to_date(hist_sold_date,'%m/%d/%Y') between '$sql_start_date' and '$sql_end_date'";	

			$query 		= 	"select * from $data_table  where hist_add1 = (select hist_add1 from $data_table where hist_id = '$address_id')  $subquery  $limit ";
			$result		=	tep_db_query($query);
			$num_rows 	= 	tep_db_num_rows($result);
		
			if($num_rows>0) return $num_rows;
			else 			return "empty"; 
}
	
function remove_duplicate_records() {
		
	
		$data_table  = TABLE_HISTORICAL_IMPORTED_DATA;
		$query 		 = "CREATE TABLE bad_temp(hist_id INT,hist_add1 VARCHAR(50), hist_add2 varchar(50), ";
		$query 		.= "hist_sold_date varchar(50), hist_SP varchar(50), hist_bdrm varchar(2), hist_sqft varchar(10)); ";
		$query		.= "INSERT INTO bad_temp(hist_id,hist_add1,hist_add2,hist_sold_date,hist_SP,hist_bdrm,hist_sqft) ";
		$query 		.= "SELECT  hist_id,hist_add1,hist_add2,hist_sold_date,hist_SP,hist_bdrm,hist_sqft FROM $data_table group by hist_add1,hist_sold_date; ";
		$query 		.= "truncate table $data_table; ";
		$query 		.= "INSERT INTO $data_table(hist_id,hist_add1,hist_add2,hist_sold_date,hist_SP,hist_bdrm,hist_sqft) ";
		$query		.= "SELECT  hist_id,hist_add1,hist_add2,hist_sold_date,hist_SP,hist_bdrm,hist_sqft FROM bad_temp; ";
		$query		.= "drop table bad_temp;";
		mysql_query($query);

}


function load_address($id){
	
			$sql 				= "select * from " . TABLE_HISTORICAL_IMPORTED_DATA . " where hist_id=" . $id;
			$sqlresult 			= tep_db_query($sql);
			$sqlarray 			= tep_db_fetch_array($sqlresult);
			return 	$sqlarray;
}



function getBuildingSalesListAjax($options){
			
			$sort_by			= $options['sort_by'];
			$sort_direction 	= $options['sort_direction'];
			$rows_per_page 		= $options['rows_per_page'];	 
			$page				= $options['page'];
			$total_pages		= $options['total_pages'];
			$search_keyword 	= $options['search_keyword'];
			$address_id			= $options['address_id'];
			$start_date			= $options['start_date'];
			$end_date			= $options['end_date'];
			$street_address		= $options['street_address'];
			$bedrooms			= $options['bedrooms'];
			$sql_start_date 	= date('Y-m-d',strtotime($start_date)); // convert  to mysql date format
			$sql_end_date 		= date('Y-m-d',strtotime($end_date)); // convert to mysql date format
			$subquery 			= '';
			$limit 				= '';
			$bedroom_filter		= '';
			$group_by			= ' group by hist_sold_date,hist_SP';
			$data_table 		= TABLE_HISTORICAL_IMPORTED_DATA;
			
			if($search_keyword!='')					$subquery 		.= " and  substring_index( hist_add1, ' ', 1 ) like '$search_keyword'";
			if($start_date!='' && $end_date!='')	$subquery 		.= " and str_to_date(hist_sold_date,'%m/%d/%Y') between '$sql_start_date' and '$sql_end_date'";	
			if($sort_by == 'hist_add1')				$subquery 		.= " $group_by order by CAST(hist_add1 as signed integer) $sort_direction ";		
			if($sort_by == 'hist_sold_date')		$subquery 		.= " $group_by order by str_to_date(hist_sold_date,'%m/%d/%Y') $sort_direction";
			if($sort_by == 'hist_SP') 				$subquery 		.= " $group_by order by CAST(replace(hist_SP,',','') as signed integer) $sort_direction ";	
			if($sort_by == 'hist_sqft') 			$subquery 		.= " $group_by order by CAST(hist_sqft as signed integer) $sort_direction ";	
			if($bedrooms!='')						$bedroom_filter  = " and hist_bdrm=$bedrooms ";
			
			
			if($total_pages>0) {
				
										$end 	= ($rows_per_page*($page-1));
						if($page>1) 	$limit 	= " limit $end,$rows_per_page";
						if ($page==1)	$limit 	= " limit 0,$rows_per_page";
			}
			
			$query 			= 	"select * from $data_table  where hist_add1 like '%$street_address%' $bedroom_filter  $subquery  $limit "; 
			$result			=	tep_db_query($query);
			$num_rows 		=	tep_db_num_rows($result);
			if($num_rows>0)	{
					$rs = array();
					while($query_result=tep_db_fetch_array($result)){
					array_push($rs, $query_result);
					}
					return $rs;
			}
			else 
			return "empty";
}

function getLastUpdateDate(){
			
			$data_table 		= TABLE_HISTORICAL_IMPORTED_DATA;
			$query 				= 	"select hist_sold_date from $data_table order by str_to_date(hist_sold_date,'%m/%d/%Y') DESC limit 0,1";
			$result				= 	tep_db_query($query);
			$rs					=	tep_db_fetch_array($result);
			return $rs['hist_sold_date'];
			
}


function getBuildingSalesListAjaxTotalRecords($options){
			
			$sort_by			= $options['sort_by'];
			$sort_direction 	= $options['sort_direction'];
			$rows_per_page 		= $options['rows_per_page'];	 
			$page				= $options['page'];
			$total_pages		= $options['total_pages'];
			$search_keyword 	= $options['search_keyword'];
			$address_id			= $options['address_id'];
			$start_date			= $options['start_date'];
			$end_date			= $options['end_date'];
			$street_address		= $options['street_address'];
			$bedrooms			= $options['bedrooms'];
			$sql_start_date 	= date('Y-m-d',strtotime($start_date)); // convert  to mysql date format
			$sql_end_date 		= date('Y-m-d',strtotime($end_date)); // convert to mysql date format
			$subquery 			= '';
			$limit 				= '';
			$bedroom_filter		= '';
			$group_by			= ' group by hist_sold_date,hist_SP';
			$data_table 		= TABLE_HISTORICAL_IMPORTED_DATA;
			
			if($search_keyword!='')					$subquery .= " and  substring_index( hist_add1, ' ', 1 ) like '$search_keyword'";
			if($start_date!='' && $end_date!='')	$subquery .= " and str_to_date(hist_sold_date,'%m/%d/%Y') between '$sql_start_date' and '$sql_end_date'";	
			if($sort_by='hist_add1')				$subquery .= " $group_by order by $sort_by $sort_direction";
			if($sort_by=='hist_sold_date')			$subquery .= " $group_by order by str_to_date(hist_sold_date,'%m/%d/%Y') $sort_direction";
			if($sort_by=='hist_SP')					$subquery .= " $group_by order by CAST(replace(hist_SP,',','') as signed integer) $sort_direction ";	
			if($bedrooms!='')						$bedroom_filter = " and hist_bdrm=$bedrooms ";
			
			$query 				= 	"select * from $data_table  where hist_add1 like '%$street_address%' $bedroom_filter  $subquery  $limit ";
			$result				= 	tep_db_query($query);
			$num_rows 			= 	tep_db_num_rows($result);
			if($num_rows>0) 		return $num_rows;
			else 					return "empty";
}


function get_street_address($address) { 

			$temp_array 	= 	explode(' ',$address);
			if(sizeof($temp_array)>3) {
			$appartno 		=	$temp_array[0];
			$street_address	=	str_replace($appartno,'',$address);
			return $street_address;
			}
			else
			return $address;
}


function get_appartment_no($address) { 

			$temp_array 	= 	explode(' ',$address);
			$appartno 		=	$temp_array[0];
			return $appartno;
}

/////////////////////////////////end of class definition////////////////	
}
?>