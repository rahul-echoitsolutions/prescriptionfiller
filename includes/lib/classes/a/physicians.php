<?php
class physicians{
                var $id = '';
                var $license_number = '';
                var $doctor_additional_id = '';
                var $first_name = '';
                var $last_name = '';
                var $address = '';
                var $city = '';
                var $province = '';
                var $postal_code = '';
                var $phone1 = '';
                var $phone2 = '';
                var $fax = '';
                var $specialty = '';
                var $email = '';
                var $password = '';




                var $table_name					        =	'physicians';

function save(){
				$sqlarray = array(
				"id" => $this->id,
                "license_number" => $this->license_number,
                "doctor_additional_id" => $this->doctor_additional_id,
                "first_name" => $this->first_name,
                "last_name" => $this->last_name,
                "address" => $this->address,
                "city" => $this->city,
                "province" => $this->province,
                "postal_code" => $this->postal_code,
                "phone1" => $this->phone1,
                "phone2" => $this->phone2,
                "fax" => $this->fax,
                "specialty" => $this->specialty,
                "email" => $this->email,
                "password" => $this->password,




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
            $this->license_number = isset($sqlarray['license_number']) ?$sqlarray['license_number']:'';
            $this->doctor_additional_id = isset($sqlarray['doctor_additional_id']) ?$sqlarray['doctor_additional_id']:'';
            $this->first_name = isset($sqlarray['first_name']) ?$sqlarray['first_name']:'';
            $this->last_name = isset($sqlarray['last_name']) ?$sqlarray['last_name']:'';
            $this->address = isset($sqlarray['address']) ?$sqlarray['address']:'';
            $this->city = isset($sqlarray['city']) ?$sqlarray['city']:'';
            $this->province = isset($sqlarray['province']) ?$sqlarray['province']:'';
            $this->postal_code = isset($sqlarray['postal_code']) ?$sqlarray['postal_code']:'';
            $this->phone1 = isset($sqlarray['phone1']) ?$sqlarray['phone1']:'';
            $this->phone2 = isset($sqlarray['phone2']) ?$sqlarray['phone2']:'';
            $this->fax = isset($sqlarray['fax']) ?$sqlarray['fax']:'';
            $this->specialty = isset($sqlarray['specialty']) ?$sqlarray['specialty']:'';
            $this->email = isset($sqlarray['email']) ?$sqlarray['email']:'';
            $this->password = isset($sqlarray['password']) ?$sqlarray['password']:'';


                                  
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
function getlistUser($doctorList,$options=''){
    
    if($doctorList){
			$page			=		(!empty($options['page']))			? $options['page'] 				: '1';
			$rows			=		(!empty($options['rows_per_page']))	? $options['rows_per_page'] 	: '10';
			$order_by		=		(!empty($options['order_by']))		? $options['order_by'] 			: 'id';
			$sort_direction	=		(!empty($options['sort_direction']))? $options['sort_direction'] 	: 'desc';
			$end 			= 		$rows*($page-1);
        	$limit 			= 		" limit $end,$rows";
			$query			=		" select * from {$this->table_name} where id in ($doctorList) order by $order_by $sort_direction";
			$query_sql		=		tep_db_query($query);
			$num_rows 		= 		tep_db_num_rows($query_sql);
		if($num_rows>0)	{
				$result = array();
				while($query_result=tep_db_fetch_array($query_sql)){
				array_push($result, $query_result);
				}
				return $result;
		}else{ 
		return "empty";
        }
        }else{
            return "empty";
        }
}

function verifyName($first_name,$last_name, $city){
    $query			=		" select * from {$this->table_name} where first_name='$first_name' and last_name='$last_name' and city='$city'";
    

    $sqlresult 	= tep_db_query($query);
        $rows 		= tep_db_num_rows($sqlresult);
        if($rows>0){
            return "error";
        }
        else return "";
	}
    
    



	
############### END OF CLASS DEFINITION #######################################
}
?>