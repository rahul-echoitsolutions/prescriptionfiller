<?php
	class blogs{
	  var $blog_id 			= 0;
	  var $blog_name		= '';
	  var $thumb_image		= '';
	  var $description		= '';
	  var $created_date		= '';
	  var $is_archive		= '';
	  var $main_image		= '';
	  var $agent_id			= 0;
	  var $blogcategory_id	= 0;
	  var $is_featured		= ''; 
	  var $short_desc		= '';
	  var $no_of_visits		= 0;
	  var $release_date 	= '';
	  var $status 			= '';	   
	  var $expire_date		= '';
	  var $metro_area		= '';
	  var $tags				= '';
	  var $update_date		= '';
	  var $table_name 		= 'blogs';
	  var $table_agents		= 'tbl_agents';
	  var $table_comments	= 'blog_comments';

	function save(){
		
				$sqlarray = array(
					  "blog_name"		=>	$this->blog_name,
					  "thumb_image"		=>	$this->thumb_image,
                      "description"		=>	$this->description, 
                      "created_date"	=>	$this->created_date,
					  "update_date"		=>	$this->update_date,
                      "is_archive"		=>	$this->is_archive,
                      "expire_date"		=>	$this->expire_date,
					  "main_image"		=>	$this->main_image,
                      "agent_id"		=>	$this->agent_id,
                      "blogcategory_id"	=>	$this->blogcategory_id,
					  "is_featured"		=>	$this->is_featured,
					  "short_desc"		=>	$this->short_desc,
					  "no_of_visits"	=>	$this->no_of_visits,
					  "release_date"	=>	$this->release_date,
					  "metro_area"		=>	$this->metro_area,
					  "tags"			=>	$this->tags,
					  "status"			=>	$this->status);
					  
		if($this->blog_id>0)	tep_db_perform($this->table_name,$sqlarray,'update',' blog_id="' . $this->blog_id . '"');
		else	{
								tep_db_perform($this->table_name,$sqlarray); 
								$this->blog_id=tep_db_insert_id();
				}
	}

	
	function load($blog_id){
		    
		
				$sql 		= "select * from {$this->table_name} where blog_id=$blog_id";
				$sql 		= tep_db_query($sql);
				$sqlarray 	= tep_db_fetch_array($sql);
			  
			  if($sqlarray){
				  $this->blog_id 			= isset($sqlarray['blog_id'])			?$sqlarray['blog_id']:0;
				  $this->blog_name 			= isset($sqlarray['blog_name'])			?stripslashes($sqlarray['blog_name']):'';
				  $this->thumb_image 		= isset($sqlarray['thumb_image'])		?$sqlarray['thumb_image']:'';
				  $this->description 		= isset($sqlarray['description'])		?stripslashes($sqlarray['description']):'';
				  $this->created_date 		= isset($sqlarray['created_date'])		?$sqlarray['created_date']:'';
				  $this->update_date 		= isset($sqlarray['update_date'])		?$sqlarray['update_date']:'';
				  $this->is_archive 		= isset($sqlarray['is_archive'])		?$sqlarray['is_archive']:'';
				  $this->main_image 		= isset($sqlarray['main_image'])		?$sqlarray['main_image']:'';
				  $this->agent_id 			= isset($sqlarray['agent_id'])			?$sqlarray['agent_id']:0;
				  $this->blogcategory_id 	= isset($sqlarray['blogcategory_id'])	?$sqlarray['blogcategory_id']:0;
				  $this->is_featured 		= isset($sqlarray['is_featured'])		?$sqlarray['is_featured']:'';
				  $this->short_desc 		= isset($sqlarray['short_desc'])		?stripslashes($sqlarray['short_desc']):'';
				  $this->no_of_visits 		= isset($sqlarray['no_of_visits'])		?$sqlarray['no_of_visits']:0;
				  $this->release_date 		= isset($sqlarray['release_date'])		?$sqlarray['release_date']:'1900-1-1';
				  $this->status 			= isset($sqlarray['status'])			?$sqlarray['status']:'';
				  $this->expire_date 		= isset($sqlarray['expire_date'])		?$sqlarray['expire_date']:'';
				  $this->metro_area 		= isset($sqlarray['metro_area'])		?stripslashes($sqlarray['metro_area']):'';
				  $this->tags 				= isset($sqlarray['tags'])				?stripslashes($sqlarray['tags']):'';
			 }
			 
	}
	
	
	function getlist($options=''){

		$where				=	array();
		$sort_by 			=	(isset($options['sort_by']))		? $options['sort_by']:'blog_id';
		$sort_direction 	=	(isset($options['sort_direction']))	? $options['sort_direction']:'DESC';
		$agent_id 			=	(isset($options['agent_id']))		? $options['agent_id']:'0';
		$tag	 			=	(isset($options['tag']))			? $options['tag']:'';
		$search				=   (isset($options['search']))			? $options['search']:'';		
		$live				=	(isset($options['live']))			? $options['live']:0; ### 0 || 1
		$is_admin			=	(isset($options['is_admin']))		? $options['is_admin']:0; ### 0 || 1
		$page				=	(isset($options['page']))			? $options['page']:'1';
		$rows_per_page		=	(isset($options['rows_per_page']))	? $options['rows_per_page']:'';
		$topic				=   (isset($options['topic']))			? $options['topic']:'';
		$archive			=   isset($options['archive'])			? $options['archive']:'';
		$start_date			=   ($archive=='')						? '':date('Y-m-d',strtotime("01-$archive"));		
		$end_date			=   ($archive=='')						? '':date('Y-m-d',strtotime("31-$archive"));		
		$end 				=	($page-1)*$rows_per_page;
		$limit				=	($rows_per_page>0)					? "limit $end,$rows_per_page":'';
		$where_statement	=   ($topic!='')						? $where[]="b.blogcategory_id = $topic" : '';
		
		if($is_admin==0) 
		$where_statement	=	 ($is_admin==0)						? $where[]="b.agent_id = $agent_id":''; 
		
		
		$where_statement	=	($tag!='')							? $where[]="b.tags like '%$tag%'":'';
		$where_statement	=	($live>0)							? $where[]="( b.status = 'active' and b.release_date < now() and (b.expire_date > now() OR b.expire_date = '0000-00-00 00:00:00')  )":'';
		$where_statement	=	($search!='')						? $where[]="(b.tags like '%$search%' OR b.description like '%$search%' or b.blog_name like '%$search%' or b.short_desc like '%$search%')":'';
		$where_statement	=	($start_date!='')					? $where[]="b.release_date between '$start_date' and '$end_date'":''; 
		$where_statement	=	(sizeof($where)>0)					? "where ".implode(" and ", $where):'';
		$order_by			=	"order by b.$sort_by $sort_direction";
		$sql				=	"select  count(c.comment_id) as total, ";
		$sql			   .=	"b.* from {$this->table_name} b left join {$this->table_comments} c on  ";
		$sql			   .=	"(c.agent_id = b.agent_id and c.blog_id=b.blog_id) ";
		$sql			   .=	"$where_statement group by b.blog_id $order_by $limit "; 
	
		$query_sql			=	tep_db_query($sql);
        $num_rows		 	=	tep_db_num_rows($query_sql);
		if($num_rows>0) {
			$result 			= 	array();
			while($query_result = tep_db_fetch_array($query_sql)){
				array_push($result, $query_result);
			}
			return $result;
		}
		else
		return 'empty';
	}
	


	function getBlogListLive($options=''){
				
		$order_by		=  isset($options['order_by'])			?	$options['order_by']:'blog_id';
		$sort_direction =	(isset($options['sort_direction']))	?	$options['sort_direction']:'DESC';		
		$agent_id		=  isset($options['agent_id'])			?	$options['agent_id']:'';
		$tag_name		=  isset($options['tag_name'])			?	$options['tag_name']:'';
		$cat_id			=  isset($options['topic'])				?	$options['topic']:'';
		$search			=  isset($options['search'])			?	$options['search']:'';		
		$page			=  isset($options['page'])				?	$options['page']:'1';
		$rows			=  isset($options['rows'])				?	$options['rows']:'10';
		$archive		=  isset($options['archive'])			?	$options['archive']:'';
		$start_date		=  ($archive=='')						?	'':date('Y-m-d',strtotime("01-$archive"));		
		$end_date		=  ($archive=='')						?	'':date('Y-m-d',strtotime("31-$archive"));		
		
		$end 			= ($rows*($page-1));
		$limit 			= " limit $end,$rows";
		
		
		$subquery 		 = '';
		$subquery		.= ($agent_id>0)	?" and w.agent_id=$agent_id":'';
		$subquery		.= ($cat_id>0)		?" and b.blogcategory_id = $cat_id" : '';
		$subquery		.= ($tag_name!='')	?" and b.tags like '%$tag_name%'" : '';
		$subquery		.= ($search!='')	?" and (b.tags like '%$search%' OR b.description like '%$search%' or b.blog_name like '%$search%' or b.short_desc like '%$search%')":'';
		$subquery		.= ($start_date!='')?" and b.release_date between '$start_date' and '$end_date'":''; // for archives
		$subquery		.= ($order_by!='')	?" group by b.blog_id order by b.$order_by $sort_direction" : ' order by b.blog_id $sort_direction';
		
		$query 			 = "Select count(c.comment_id) as total, concat(w.agent_fname,' ',w.agent_lname) as agent_name, w.agent_id,b.* from {$this->table_name} ";
		$query			.= "b left outer join {$this->table_agents} w  on b.agent_id=w.agent_id left join {$this->table_comments} c on  ";
		$query			.= "(c.agent_id = b.agent_id and c.blog_id=b.blog_id) ";
		$query			.= "where (b.status = 'active' and b.release_date < now() and (b.expire_date > now() OR b.expire_date ='0000-00-00 00:00:00')) $subquery  $limit"; 
		

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


	function getTotalBlogsLive($options=''){ 
		
		$order_by		=  isset($options['order_by'])		?	$options['order_by']:'';
		$agent_id		=  isset($options['agent_id'])		?	$options['agent_id']:'';
		$cat_id			=  isset($options['cat_id'])		?	$options['cat_id']:'';
		$tag_name		=  isset($options['tag_name'])		?	$options['tag_name']:'';
		$topic			=  isset($options['topic'])			?	$options['topic']:'';
		$search			=  isset($options['search'])		?	$options['search']:'';		
		$page			=  isset($options['page'])			?	$options['page']:'1';
		$archive		=  isset($options['archive'])		?	$options['archive']:'';
		$start_date		=  ($archive=='')					?	'':date('Y-m-d',strtotime("01-$archive"));		
		$end_date		=  ($archive=='')					?	'':date('Y-m-d',strtotime("31-$archive"));		

		
		$subquery 		 = '';
		$subquery		.= ($agent_id>0)		?" and b.agent_id=$agent_id":'and b.agent_id=0';
		$subquery		.= ($cat_id>0)			?" and b.blogcategory_id = $cat_id" : '';
		$subquery		.= ($tag_name)			?" and b.tags like '%$tag_name%'" : '';
		$subquery		.= ($topic)				?" and b.tags like '%$topic%' " :'';
		$subquery		.= ($search)			?" and (b.tags like '%$search%' OR b.description like '%$search%' or b.blog_name like '%$search%' or b.short_desc like '%$search%')":'';
		
		$subquery		.= ($start_date!='')	?" and b.release_date between '$start_date' and '$end_date'":''; // for archives
		
		$query 			 = "Select count(b.blog_id) as total from {$this->table_name} b ";
		$query			.= " where (b.status = 'active' and b.release_date < now() and (b.expire_date > now() OR b.expire_date ='0000-00-00 00:00:00')) $subquery ";

		$query_sql		 = tep_db_query($query);
		$num_rows		 = tep_db_num_rows($query_sql);
		
			if($num_rows>0) {	$result	 =	tep_db_fetch_array($query_sql);	return 	$result['total'];	}
			else				return '0';	
			
	}

	
	function get_blog_list_by_cats($cat_id){
		
		$sql 		=	"select * from {$this->table_name}  WHERE blogcategory_id=$cat_id order by created_date desc";
		$query_sql	=	tep_db_query($sql);
		$result 	=	array();
		while($query_result=tep_db_fetch_array($query_sql)){
		array_push($result, $query_result);
		}
		return $result;
		
	}
	
	
	function getTotalBlogsByCategoryID($cat_id) {
		
		$sql 			=	"select count(*) as total from {$this->table_name}  WHERE blogcategory_id=$cat_id and ";
		$sql		   .=	"(status='active' and release_date < now() and expire_date > now())";
		$query_sql		=	tep_db_query($sql);
		$query_result	=	tep_db_fetch_array($query_sql);
		return 				$query_result['total'];
		
	}

	
	function delete($blogid){
		
		$sql 		= "delete from {$this->table_name} where blog_id=$blogid";
		$blog_query = tep_db_query($sql);
		
	}
	
	
	function getArchiveList() {
		
			$query 			 = "SELECT distinct(concat(MONTH(release_date),'-' ,YEAR(release_date))) as `datemonth` FROM {$this->table_name} order by blog_id DESC";
			$query_sql		 = tep_db_query($query);
			$num_rows		 = tep_db_num_rows($query_sql);
		
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
	
	


### end of class definition ### 
}
?>