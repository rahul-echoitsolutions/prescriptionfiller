<?php
class allergy_descriptions{
                var $id = '';
                var $allergy_name = '';
                var $allergy_description = '';


                var $table_name					        =	'allergy_descriptions';

function save(){
				$sqlarray = array(
				"id" => $this->id,
                "allergy_name" => $this->allergy_name,
                "allergy_description" => $this->allergy_description,


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
$this->allergy_name = isset($sqlarray['allergy_name']) ?$sqlarray['allergy_name']:'';
$this->allergy_description = isset($sqlarray['allergy_description']) ?$sqlarray['allergy_description']:'';

                                  
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