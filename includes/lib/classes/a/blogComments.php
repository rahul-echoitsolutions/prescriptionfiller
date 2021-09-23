<?php
class blogComments{
	var $comment_id			=	'0';
	var $agent_id			=	'0';
	var $blog_id			=	'0';
	var $status				=	'inactive';		
	var $name				=	'';
	var $email				=	'';	
	var $message			=	'';	
	var $date				=	'';	
	var $total				=	'';	
	var $table_name			=	'blog_comments';

	function save(){
		$date=date('Y-m-d H:i:s');
		
		$sqlarray 			=	 array(
										"name"				=>	ucwords(strtolower($this->name)),
										"email"				=>	ucwords(strtolower($this->email)),										
										"message"			=>	$this->message,
										"agent_id"		    =>	$this->agent_id,
										"blog_id"		    =>	$this->blog_id,
										"date"			    =>	$date,
										"status"			=>	$this->status,
										
										
								);
								
						
		$check_result = tep_db_fetch_array(tep_db_query("select count(*) as count from  {$this->table_name} where comment_id='{$this->comment_id}'"));
		if($check_result['count']>0) 	tep_db_perform($this->table_name,$sqlarray,'update',' comment_id="' . $this->comment_id . '"');
		else 							tep_db_perform($this->table_name,$sqlarray);
		
	}
	
	function delete($comment_id){
		tep_db_query("delete from {$this->table_name} where comment_id=$comment_id");
	}


function getlist($options=''){
		
		
		$where				=	array();
		$sort_by 			=	(isset($options['sort_by']))		? $options['sort_by']:'comment_id';
		$sort_direction 	=	(isset($options['sort_direction']))	? $options['sort_direction']:'DESC';
		$blog_id 			=	(isset($options['blog_id']))		? $options['blog_id']:'';
		$status				=	(isset($options['status']))			? $options['status']:'inactive'; ### 0 || 1
		$page				=	(isset($options['page']))			? $options['page']:'1';
		$rows_per_page		=	(isset($options['rows_per_page']))	? $options['rows_per_page']:'';
		$end 				=	($page-1)*$rows_per_page;
		$limit				=	($rows_per_page>0)					? "limit $end,$rows_per_page":'';
		
		$where_statement	=	($blog_id=='')					? '':$where[]="c.blog_id = $blog_id";		
		$where_statement	=	($status>0)						? $where[]="c.status = 1":'';
		$where_statement	=	(sizeof($where)>0)				? "where ".implode(" and ", $where):'';
		
		$order_by			=	"order by c.$sort_by $sort_direction";
		$sql				=	"select b.blog_name, b.blog_id, c.* from {$this->table_name} c ";
		$sql			   .=	"left join blogs b on b.blog_id = c.blog_id  $where_statement $order_by $limit ";
		
		
		$query_sql			=	tep_db_query($sql);
		$total				=	tep_db_num_rows($query_sql);
		$this->total		=	$total;
		$result 			= 	array();
		
		
		while($query_result = tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}
	


	function load($comment_id){
	
			$sql 								= "select * from {$this->table_name} where comment_id=$comment_id";
			$sqlresult 							= tep_db_query($sql);
			$this->total						= $this->total;
			
			$sqlarray 							= tep_db_fetch_array($sqlresult);	
			if($sqlarray){
				$this->name 					= isset($sqlarray['name'])			?	stripslashes($sqlarray['name']):'';
				$this->email 					= isset($sqlarray['email'])			?	$sqlarray['email']:'';				
				$this->message 					= isset($sqlarray['message'])		?	stripslashes($sqlarray['message']):'';
				$this->date 					= isset($sqlarray['date'])			?	$sqlarray['date']:'';
				$this->comment_id				= isset($sqlarray['comment_id'])	?	$sqlarray['comment_id']:'';
				$this->blog_id					= isset($sqlarray['blog_id'])		?	$sqlarray['blog_id']:'';
				$this->agent_id					= isset($sqlarray['agent_id'])		?	$sqlarray['agent_id']:'';
				$this->status					= isset($sqlarray['status'])		?	$sqlarray['status']:'';
				
			}
	}

### END OF CLASS #### 
}
?>