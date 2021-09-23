<?php
class contents{
	var $content_id = 0;
	var $title='';
    var $wysiwyg_meta='';
	var $description = '';
    var $menupos = '';
    var $menuorder = '';
	var $status='';
	var $image='';
    var $image_name = '';
    var $image_alt = '';
    var $rightColumn_key = '';
    var $nofollow = 0;
    var $rightColumn = '';
    var $set301 = '';
    var $sitemap = '';
    var $submenupos = '';

function save(){
								$sqlarray = array(
								"title"=>$this->title,
                                "wysiwyg_meta"=>$this->wysiwyg_meta,
								"description"=>$this->description,
                                "menupos"=>$this->menupos,
                                "menuorder"=>$this->menuorder,
								"status"=>$this->status,
								"image"=>$this->image,
                                "image_name"=>$this->image_name,
                                "image_alt"=>$this->image_alt,
                                "url_key"=>$this->url_key,
                                "nofollow"=>$this->nofollow,
                                "rightColumn"=>$this->rightColumn,
                                "set301"=>$this->set301,
                                "sitemap"=>$this->sitemap,
                                "submenupos"=>$this->submenupos
								);
		if($this->content_id>0){
			tep_db_perform(TABLE_CONTENTS,$sqlarray,'update',' content_id="' . $this->content_id . '"');
		}else{
			tep_db_perform(TABLE_CONTENTS,$sqlarray);
			$this->content_id=tep_db_insert_id();
		}
	}
	
function delete($id){
		$query = "delete from " . TABLE_CONTENTS . " where content_id='" . $id . "';";
		tep_db_query($query);
	}
	
	
function load($id,$type='id'){
    
        if($type == 'id' )	$sql = "select * from " . TABLE_CONTENTS . " where content_id=$id";
        if($type == 'key')  $sql = "select * from " . TABLE_CONTENTS . " where url_key='$id'";
        
		$sqlresult = tep_db_query($sql);
		$sqlarray = tep_db_fetch_array($sqlresult);
		if($sqlarray){
			$this->content_id 		= isset($sqlarray['content_id'])?$sqlarray['content_id']:0;
			$this->title 			= isset($sqlarray['title'])?$sqlarray['title']:'';
            $this->wysiwyg_meta		= isset($sqlarray['wysiwyg_meta'])?$sqlarray['wysiwyg_meta']:'';            
			$this->description		= isset($sqlarray['description'])?$sqlarray['description']:'';
            $this->menupos	     	= isset($sqlarray['menupos'])?$sqlarray['menupos']:'';
            $this->menuorder        = isset($sqlarray['menuorder'])?$sqlarray['menuorder']:'';
			$this->status 			= isset($sqlarray['status'])?$sqlarray['status']:'';
			$this->image 			= isset($sqlarray['image'])?$sqlarray['image']:'';
            $this->image_name 		= isset($sqlarray['image_name'])?$sqlarray['image_name']:'';
            $this->image_alt 		= isset($sqlarray['image_alt'])?$sqlarray['image_alt']:'';
            $this->url_key 			= isset($sqlarray['url_key'])?$sqlarray['url_key']:'';
            $this->nofollow 		= isset($sqlarray['nofollow'])?$sqlarray['nofollow']:'';
            $this->rightColumn 		= isset($sqlarray['rightColumn'])?$sqlarray['rightColumn']:'';
            $this->set301 		= isset($sqlarray['set301'])?$sqlarray['set301']:'';
            $this->sitemap 		= isset($sqlarray['sitemap'])?$sqlarray['sitemap']:'';
            $this->submenupos   = isset($sqlarray['submenupos'])?$sqlarray['submenupos']:'';
		}
	}
	
function getlist2($usertype, $showallusers, $showactiveusers, &$total_page, $page, $selrows, $sort){
		$query = "select * from " . TABLE_CONTENTS . " where ";
		
		if(!empty($usertype)) $query.="user_type='".$usertype."'";
		else $query.="user_type<>''";
		if(!empty($showactiveusers)) $query.=" and is_active='".$showactiveusers."'";
		if(!$showallusers) $query.=" and (is_deleted='' or is_deleted is null)";
	
		if(empty($sort)) $sort="content_id asc";
		$query.=" order by ".$sort;
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
		$result = array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}


    function getlist($menupos=''){
        
        $subquery = ($menupos!='')?" where menupos ='$menupos'":'';
		$query = "select * from " . TABLE_CONTENTS. " $subquery ";
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
    
    
    function checkUrlKey($url_key,$content_id){ 
    
        $sub = ($content_id > 0 ) ? " and content_id<>$content_id":'';
		$sql = "select count(*) as count from ". TABLE_CONTENTS." where url_key='$url_key' $sub limit 0,1";
		$row = tep_db_result_row($sql);
		if($row){
			if($row[0]>0) return 'exists';
		}
		return '';
	}
    
    
    
    function checkImageNameExists($image_name,$content_id){ 
    
        $sub = ($content_id > 0 ) ? " and content_id<>$content_id":'';
		$sql = "select count(*) as count from ". TABLE_CONTENTS." where image_name='$image_name' and image_name>'' $sub limit 0,1";
		$row = tep_db_result_row($sql);
		if($row){
			if($row[0]>0) return 'exists';
		}
		return '';
	}
   
   

/////////////////////////////////end of class definition////////////////	
}
?>