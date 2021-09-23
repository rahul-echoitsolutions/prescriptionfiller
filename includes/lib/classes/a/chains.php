<?php
class chains{
                var $id = '';
                var $chain_name = '';
                var $address = '';
                var $city = '';
                var $province = '';
                var $postal_code = '';
                var $email = '';
                var $phone = '';
                var $fax = '';
                var $contact_first_name = '';
                var $contact_last_name = '';




                var $table_name					        =	'chains';

function save(){
				$sqlarray = array(
				"id" => $this->id,
                "chain_name" => $this->chain_name,
                "address" => $this->address,
                "city" => $this->city,
                "province" => $this->province,
                "postal_code" => $this->postal_code,
                "email" => $this->email,
                "phone" => $this->phone,
                "fax" => $this->fax,
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
            $this->chain_name = isset($sqlarray['chain_name']) ?$sqlarray['chain_name']:'';
            $this->address = isset($sqlarray['address']) ?$sqlarray['address']:'';
            $this->city = isset($sqlarray['city']) ?$sqlarray['city']:'';
            $this->province = isset($sqlarray['province']) ?$sqlarray['province']:'';
            $this->postal_code = isset($sqlarray['postal_code']) ?$sqlarray['postal_code']:'';
            $this->email = isset($sqlarray['email']) ?$sqlarray['email']:'';
            $this->phone = isset($sqlarray['phone']) ?$sqlarray['phone']:'';
            $this->fax = isset($sqlarray['fax']) ?$sqlarray['fax']:'';
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