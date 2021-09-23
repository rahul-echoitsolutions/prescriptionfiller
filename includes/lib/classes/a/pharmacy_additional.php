<?php
class pharmacy_additional{
            var $id = '';
            var $user_id = '';
            var $pharmacy_name = '';
            var $pharmacy_store_number = '';
            var $contact_email = '';
            var $contact_first_name = '';
            var $contact_last_name = '';
            var $document_name = '';




                var $table_name					        =	'pharmacy_additional';

function save(){
				$sqlarray = array(
				"id" => $this->id,
"user_id" => $this->user_id,
"pharmacy_name" => $this->pharmacy_name,
"pharmacy_store_number" => $this->pharmacy_store_number,
"contact_email" => $this->contact_email,
"contact_first_name" => $this->contact_first_name,
"contact_last_name" => $this->contact_last_name,
"document_name" => $this->document_name,




				);
		if($this->id>0)	tep_db_perform($this->table_name,$sqlarray,'update',' id="' . $this->id . '"');
		else {
			tep_db_perform($this->table_name,$sqlarray);
			$this->id=tep_db_insert_id();
		}
}
function delete($id){
		$query = "delete from {$this->table_name}  where id='$id';";
		tep_db_query($query);
}
function load($id){
		$sql 			= 	"select * from {$this->table_name}  where id='$id'";
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);
		if($sqlarray){
            $this->id = isset($sqlarray['id']) ?$sqlarray['id']:'';
            $this->user_id = isset($sqlarray['user_id']) ?$sqlarray['user_id']:'';
            $this->pharmacy_name = isset($sqlarray['pharmacy_name']) ?$sqlarray['pharmacy_name']:'';
            $this->pharmacy_store_number = isset($sqlarray['pharmacy_store_number']) ?$sqlarray['pharmacy_store_number']:'';
            $this->contact_email = isset($sqlarray['contact_email']) ?$sqlarray['contact_email']:'';
            $this->contact_first_name = isset($sqlarray['contact_first_name']) ?$sqlarray['contact_first_name']:'';
            $this->contact_last_name = isset($sqlarray['contact_last_name']) ?$sqlarray['contact_last_name']:'';
            $this->document_name = isset($sqlarray['document_name']) ?$sqlarray['document_name']:'';

                                  
		}
}
function getlist($options=''){
			$page			=		(!empty($options['page']))			? $options['page'] 				: '1';
			$rows			=		(!empty($options['rows_per_page']))	? $options['rows_per_page'] 	: '10';
			$order_by		=		(!empty($options['order_by']))		? $options['order_by'] 			: 'id';
			$sort_direction	=		(!empty($options['sort_direction']))? $options['sort_direction'] 	: 'desc';
			$end 			= 		$rows*($page-1);
        	$limit 			= 		" limit $end,$rows";
			$query			=		" select * from {$this->table_name} order by $order_by $sort_direction";
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





	
############### END OF CLASS DEFINITION #######################################
}
?>