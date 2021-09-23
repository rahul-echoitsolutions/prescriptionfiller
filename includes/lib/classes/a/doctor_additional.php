<?php
class doctor_additional{
               var $id = '';
                var $user_id = '';
                var $office_name = '';
                var $office_street = '';
                var $office_city = '';
                var $office_province = '';
                var $office_postal_code = '';
                var $office_phone = '';
                var $office_fax = '';
                var $contact_first_name = '';
                var $contact_last_name = '';




                var $table_name					        =	'doctor_additional';

function save(){
				$sqlarray = array(
				"id" => $this->id,
                "user_id" => $this->user_id,
                "office_name" => $this->office_name,
                "office_street" => $this->office_street,
                "office_city" => $this->office_city,
                "office_province" => $this->office_province,
                "office_postal_code" => $this->office_postal_code,
                "office_phone" => $this->office_phone,
                "office_fax" => $this->office_fax,
                "contact_first_name" => $this->contact_first_name,
                "contact_last_name" => $this->contact_last_name,




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
                $this->office_name = isset($sqlarray['office_name']) ?$sqlarray['office_name']:'';
                $this->office_street = isset($sqlarray['office_street']) ?$sqlarray['office_street']:'';
                $this->office_city = isset($sqlarray['office_city']) ?$sqlarray['office_city']:'';
                $this->office_province = isset($sqlarray['office_province']) ?$sqlarray['office_province']:'';
                $this->office_postal_code = isset($sqlarray['office_postal_code']) ?$sqlarray['office_postal_code']:'';
                $this->office_phone = isset($sqlarray['office_phone']) ?$sqlarray['office_phone']:'';
                $this->office_fax = isset($sqlarray['office_fax']) ?$sqlarray['office_fax']:'';
                $this->contact_first_name = isset($sqlarray['contact_first_name']) ?$sqlarray['contact_first_name']:'';
                $this->contact_last_name = isset($sqlarray['contact_last_name']) ?$sqlarray['contact_last_name']:'';

                                  
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