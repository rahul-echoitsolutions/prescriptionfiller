<?php
class insurers{
                var $id = '';
                var $company_name = '';
                var $company_address = '';
                var $company_city = '';
                var $company_province = '';
                var $company_postal_code = '';
                var $carrier_number = '';
                var $company_phone = '';
                var $company_fax = '';
                var $company_email = '';



                var $table_name					        =	'insurers';

function save(){
				$sqlarray = array(
				"id" => $this->id,
                "company_name" => $this->company_name,
                "company_address" => $this->company_address,
                "company_city" => $this->company_city,
                "company_province" => $this->company_province,
                "company_postal_code" => $this->company_postal_code,
                "carrier_number" => $this->carrier_number,
                "company_phone" => $this->company_phone,
                "company_fax" => $this->company_fax,
                "company_email" => $this->company_email,



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
$this->company_name = isset($sqlarray['company_name']) ?$sqlarray['company_name']:'';
$this->company_address = isset($sqlarray['company_address']) ?$sqlarray['company_address']:'';
$this->company_city = isset($sqlarray['company_city']) ?$sqlarray['company_city']:'';
$this->company_province = isset($sqlarray['company_province']) ?$sqlarray['company_province']:'';
$this->company_postal_code = isset($sqlarray['company_postal_code']) ?$sqlarray['company_postal_code']:'';
$this->carrier_number = isset($sqlarray['carrier_number']) ?$sqlarray['carrier_number']:'';
$this->company_phone = isset($sqlarray['company_phone']) ?$sqlarray['company_phone']:'';
$this->company_fax = isset($sqlarray['company_fax']) ?$sqlarray['company_fax']:'';
$this->company_email = isset($sqlarray['company_email']) ?$sqlarray['company_email']:'';

                                  
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