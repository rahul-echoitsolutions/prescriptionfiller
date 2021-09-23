<?php
class blogcategory{
	var $blogcategory_id 	= 0;
	var $category_name		= '';
	var $image_name			= '';
	var $agent_id			= '';
	var $create_date		= '';
	var $status				= '';
	var $table_name	 		= 'blog_categories';
	var $table_blog		 	= 'blogs';

	
	function save(){
		$sqlarray = array(
							"category_name"		=>	$this->category_name,
							"image_name"		=>	$this->image_name,
							"agent_id"			=>	$this->agent_id,
							"create_date"		=>	$this->create_date,
							"status"			=>	$this->status
						  );
							
		if($this->blogcategory_id>0)	tep_db_perform($this->table_name,$sqlarray,'update',' blogcategory_id="' . $this->blogcategory_id . '"');
		else{
			tep_db_perform($this->table_name,$sqlarray);
			$this->blogcategory_id=tep_db_insert_id();
		}
	}
	
	 
	function delete($blogcategory_id){
		tep_db_query("delete from {$this->table_name} where blogcategory_id='" . $blogcategory_id . "';");
	}
	
	function load($blogcategory_id){
		$sql 						= "select * from {$this->table_name} where blogcategory_id=$blogcategory_id";
		$sql 						= tep_db_query($sql);
		$sqlarray 					= tep_db_fetch_array($sql);
		if($sqlarray){
			$this->blogcategory_id 	= isset($sqlarray['blogcategory_id'])	?$sqlarray['blogcategory_id']:0;
			$this->category_name 	= isset($sqlarray['category_name'])		?stripslashes($sqlarray['category_name']):'';
			$this->image_name 		= isset($sqlarray['image_name'])		?$sqlarray['image_name']:'';
			$this->agent_id 		= isset($sqlarray['agent_id'])			?$sqlarray['agent_id']:'';
			$this->create_date 		= isset($sqlarray['create_date'])		?$sqlarray['create_date']:'';
			$this->status 			= isset($sqlarray['status'])			?$sqlarray['status']:'';
		}
	}
	
	
	function getlist($options=''){
		
		$sort_by 			=	(isset($options['sort_by']))		? $options['sort_by']:'blogcategory_id';
		$sort_direction 	=	(isset($options['sort_direction']))	? $options['sort_direction']:'DESC';
		$agent_id 			=	(isset($options['agent_id']))		? $options['agent_id']:'';
		$status 			=	(isset($options['status']))			? $options['status']:'';
		$page				=	(isset($options['page']))			? $options['page']:'1';
		$rows_per_page		=	(isset($options['rows_per_page']))	? $options['rows_per_page']:'';
		$end 				=	($page-1)*$rows_per_page;
		$limit				=	($rows_per_page>0)					? "limit $end,$rows_per_page":'';
		
		$where_statement	=	($agent_id=='')						? '':$where[]="c.agent_id = $agent_id";
		$where_statement	=	($status!='')						? $where[]="c.status = '$status'":'';
		$where_statement	=	(sizeof($where)>0)					? "where ".implode(" and ", $where):'';
		
		$order_by			=	"order by c.$sort_by $sort_direction ";
		$sql				=	"select c.*, count(b.blog_id) as total from {$this->table_name} ";
		$sql			   .=	"c left join {$this->table_blog} b on b.blogcategory_id = c.blogcategory_id ";
		$sql			   .=	"$where_statement group by c.blogcategory_id $order_by $limit ";
		

		$query_sql			=	tep_db_query($sql);
		$result 			= 	array();
		
		
		while($query_result = tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}
	
	
			### END OF CLASS DEFINITION ###
}
?>