<?php
class testimonials{
	var $testimonial_id = 0;
	var $name			= '';
	var $contents 		= '';
	var $status			= '';
	var $add_date		= '';
	var $contact		= '';
	var $image 			= '';
	var $table_name		= TABLE_TESTIMONIALS;

	function save(){
								$sqlarray = array(
								"name"			=>	$this->name,
								"contents"		=>	$this->contents,
								"status"		=>	$this->status,
								"contact"		=>	$this->contact,
								"add_date"		=>	$this->add_date,
								"image"			=>	$this->image,
								);
		if($this->testimonial_id>0){
			tep_db_perform($this->table_name,$sqlarray,'update',' testimonial_id="' . $this->testimonial_id . '"');
		}else{
			tep_db_perform($this->table_name,$sqlarray);
			$this->testimonial_id=tep_db_insert_id();
		}
	}
	
	function delete($id){
		$query = "delete from {$this->table_name} where testimonial_id='" . $id . "';";
		tep_db_query($query);
	}
	
	
	function load($id){
		$sql = "select * from {$this->table_name} where testimonial_id=" . $id;
		$sqlresult = tep_db_query($sql);
		$sqlarray = tep_db_fetch_array($sqlresult);
		if($sqlarray){
			$this->testimonial_id 	= isset($sqlarray['testimonial_id'])?$sqlarray['testimonial_id']:0;
			$this->name 			= isset($sqlarray['name'])?$sqlarray['name']:'';
			$this->contents 		= isset($sqlarray['contents'])?$sqlarray['contents']:'';
			$this->status 			= isset($sqlarray['status'])?$sqlarray['status']:'';
			$this->add_date 		= isset($sqlarray['add_date'])?$sqlarray['add_date']:'';
			$this->contact 			= isset($sqlarray['contact'])?$sqlarray['contact']:'';
			$this->image 			= isset($sqlarray['image'])?$sqlarray['image']:'';
			
		}
	}
	
	

	function getlist($type='',&$total_page='', $page='', $selrows=''){
		
		
		if($type=='user') {
			$status = " where s.status='active'";
		}
		else
			$status ='';	
		
		$query = "select * from {$this->table_name} s  $status order by s.testimonial_id DESC";
		$query_sql=tep_db_query($query);
		$rowscount = tep_db_num_rows($query_sql);
				if($selrows>0){
			$total_page = ceil($rowscount / $selrows);
			if (empty($page) || !is_numeric($page)) $page = 1;
			if((int)$page<=0) $page=1;
			$offset = ($selrows * ($page - 1));
			$query.= " limit " . max($offset,0) . ", " . $selrows;
		}
		if($total_page<=0) $total_page=1;

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
	
	
		function getTestimonials($options=''){
			
			$order_by		=  isset($options['order_by'])		?	$options['order_by']:'';
			$page			=  isset($options['page'])			?	$options['page']:'1';
			$rows			=  isset($options['rows'])			?	$options['rows']:'10';
			$admin			=  isset($options['admin'])			?	$options['admin']:'';
			$end 			=  ($rows*($page-1));
			$limit 			=  "limit $end,$rows";
			
			
			$subquery 		 = '';
			$subquery		.= ($admin == '')		?" where status = 'active'":'';
			$subquery		.= ($order_by != '')	?" order by $order_by ASC" : ' order by testimonial_id DESC';

			$query 			 = "Select * from {$this->table_name} $subquery $limit";
			$query_sql		 = tep_db_query($query);
			$num_rows		 = tep_db_num_rows($query_sql);
			
			if($num_rows>0) {
				$result 	 = array();
				while($query_result=tep_db_fetch_array($query_sql)){ 		
					array_push($result, $query_result); 	
				}
				return $result;
		}
		else
		return "empty";
		
	}
	
	
	function getTestimonialsTotal($options=''){
			
			$admin			=  isset($options['admin'])			?	$options['admin']:'';
			$subquery 		 = '';
			$subquery		.= ($admin == '')		?" where status = 'active'":'';


			$query 			 = "Select * from {$this->table_name} $subquery $limit";
			$query_sql		 = tep_db_query($query);
			$num_rows		 = tep_db_num_rows($query_sql);
			
			if($num_rows>0) 		return $num_rows;
			else					return "empty";
	}
################################ Please write code above this line ##############################
}
?>