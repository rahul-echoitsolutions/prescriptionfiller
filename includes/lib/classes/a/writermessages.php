<?php
class writermessages{
	var $message_id			=	0;
	var $sender_first_name	=	'';
	var $sender_last_name	=	'';
	var $sender_email		=	'';
	var $sender_phone		=	'';
	var $writer_id			=	'';
	var $blog_id			=	'';
	var $date_sent			=	'';
	var $message_contents	=	'';
	var $table_name			=	TABLE_WRITER_MESSAGES;

function save(){
		$sqlarray 			=	 array(
								"sender_first_name"	=>	$this->sender_first_name,
								"sender_last_name"	=>	$this->sender_last_name,
								"sender_email"		=>	$this->sender_email,
								"sender_phone"		=>	$this->sender_phone,
								"writer_id"			=>	$this->writer_id,
								"blog_id"			=>	$this->blog_id,
								"message_contents"	=>	$this->message_contents,
								"date_sent"			=>	$this->date_sent);
								
						
		$check_result = tep_db_fetch_array(tep_db_query("select count(*) as count from  {$this->table_name} where message_id='{$this->message_id}'"));
		if($check_result['count']>0) 	tep_db_perform($this->table_name,$sqlarray,'update',' message_id="' . $this->message_id . '"');
		else 							tep_db_perform($this->table_name,$sqlarray);
		
}
	
function delete($message_id){
		tep_db_query("delete from {$this->table_name} where message_id=$message_id");
}



function getlist(){
		$sql		=	"select concat(wm.sender_first_name, ' ',wm.sender_last_name) as sender_name, wm.message_id, wm.sender_email, wm.date_sent, b.blog_name, b.blog_id, ";
		$sql	   .=	" concat(w.first_name,' ',w.last_name) as writer_name, w.writer_id, wm.message_contents from {$this->table_name} wm ";
		$sql	   .=	" left join ".TABLE_BLOGWRITERS." w on w.writer_id = wm.writer_id left join ". TABLE_BLOGS ." b on b.blog_id = wm.blog_id ";
		$sql	   .=	" order by wm.message_id DESC";
		
		$query_sql	=	tep_db_query($sql);
		$result 	= 	array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
}



function load($userid){
		
			$sql 		= "select * from {$this->table_name} where message_id=".$userid;
			$sqlresult 	= tep_db_query($sql);
			$sqlarray 	= tep_db_fetch_array($sqlresult);
			
			if($sqlarray){
			$this->blog_id	 			= isset($sqlarray['blog_id'])			?	$sqlarray['blog_id']:'';
			$this->date_sent 			= isset($sqlarray['date_sent'])			?	$sqlarray['date_sent']:'';
			$this->writer_id 			= isset($sqlarray['writer_id'])			?	$sqlarray['writer_id']:'';
			$this->message_id 			= isset($sqlarray['message_id'])		?	$sqlarray['message_id']:0;
			$this->sender_email 		= isset($sqlarray['sender_email'])		?	$sqlarray['sender_email']:'';
			$this->sender_phone 		= isset($sqlarray['sender_phone'])		?	$sqlarray['sender_phone']:'';
			$this->message_contents 	= isset($sqlarray['message_contents'])	?	$sqlarray['message_contents']:'';
			$this->sender_last_name 	= isset($sqlarray['sender_last_name'])	?	$sqlarray['sender_last_name']:'';			
			$this->sender_first_name 	= isset($sqlarray['sender_first_name'])	?	$sqlarray['sender_first_name']:'';
			}
}
	
/////////// ********** end of class ////////////////////
}
?>