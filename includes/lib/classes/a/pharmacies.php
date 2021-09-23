<?php
class pharmacies{
                var $id = '';
                var $chain_id = '';
                var $branch_no = '';
                var $name = '';
                var $address = '';
                var $city = '';
                var $province = '';
                var $fax_number = '';
                var $zip_code = '';
                var $phone_number = '';
                var $phone_number2 = '';
                var $phone_number3 = '';
                var $fax_number2 = '';
                var $contact1_name = '';
                var $contact2_name = '';
                var $contact3_name = '';
                var $chain = '';
                var $email = '';
                var $password = '';
                var $approved = '';
                var $bus_license_no = '';
                var $cra_number = '';
                var $owner_name = '';
                var $manager_name = '';
                var $latitude = '';
                var $longitude = '';



                var $table_name					        =	'pharmacy';

function save(){

				$sqlarray = array(
				"id" => $this->id,
                "chain_id" => $this->chain_id,
                "branch_no" => $this->branch_no,
                "name" => $this->name,
                "address" => $this->address,
                "city" => $this->city,
                "province" => $this->province,
                "fax_number" => $this->fax_number,
                "zip_code" => $this->zip_code,
                "phone_number" => $this->phone_number,
                "phone_number2" => $this->phone_number2,
                "phone_number3" => $this->phone_number3,
                "fax_number2" => $this->fax_number2,
                "contact1_name" => $this->contact1_name,
                "contact2_name" => $this->contact2_name,
                "contact3_name" => $this->contact3_name,
                "chain" => $this->chain,
                "email" => $this->email,
                "password" => $this->password,
                "approved" => $this->approved,
                "bus_license_no" => $this->bus_license_no,
                "cra_number" => $this->cra_number,
                "owner_name" => $this->owner_name,
                "manager_name" => $this->manager_name,
                "latitude" => $this->latitude,
                "longitude" => $this->longitude,



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
            $this->chain_id = isset($sqlarray['chain_id']) ?$sqlarray['chain_id']:'';
            $this->branch_no = isset($sqlarray['branch_no']) ?$sqlarray['branch_no']:'';
            $this->name = isset($sqlarray['name']) ?$sqlarray['name']:'';
            $this->address = isset($sqlarray['address']) ?$sqlarray['address']:'';
            $this->city = isset($sqlarray['city']) ?$sqlarray['city']:'';
            $this->province = isset($sqlarray['province']) ?$sqlarray['province']:'';
            $this->fax_number = isset($sqlarray['fax_number']) ?$sqlarray['fax_number']:'';
            $this->zip_code = isset($sqlarray['zip_code']) ?$sqlarray['zip_code']:'';
            $this->phone_number = isset($sqlarray['phone_number']) ?$sqlarray['phone_number']:'';
            $this->phone_number2 = isset($sqlarray['phone_number2']) ?$sqlarray['phone_number2']:'';
            $this->phone_number3 = isset($sqlarray['phone_number3']) ?$sqlarray['phone_number3']:'';
            $this->fax_number2 = isset($sqlarray['fax_number2']) ?$sqlarray['fax_number2']:'';
            $this->contact1_name = isset($sqlarray['contact1_name']) ?$sqlarray['contact1_name']:'';
            $this->contact2_name = isset($sqlarray['contact2_name']) ?$sqlarray['contact2_name']:'';
            $this->contact3_name = isset($sqlarray['contact3_name']) ?$sqlarray['contact3_name']:'';
            $this->chain = isset($sqlarray['chain']) ?$sqlarray['chain']:'';
            $this->email = isset($sqlarray['email']) ?$sqlarray['email']:'';
            $this->password = isset($sqlarray['password']) ?$sqlarray['password']:'';
            $this->approved = isset($sqlarray['approved']) ?$sqlarray['approved']:'';
            $this->bus_license_no = isset($sqlarray['bus_license_no']) ?$sqlarray['bus_license_no']:'';
            $this->cra_number = isset($sqlarray['cra_number']) ?$sqlarray['cra_number']:'';
            $this->owner_name = isset($sqlarray['owner_name']) ?$sqlarray['owner_name']:'';
            $this->manager_name = isset($sqlarray['manager_name']) ?$sqlarray['manager_name']:'';
            $this->latitude = isset($sqlarray['latitude']) ?$sqlarray['latitude']:'';
            $this->longitude = isset($sqlarray['longitude']) ?$sqlarray['longitude']:'';

                                  
		}
}
function getlist($options='',$province='British Columbia'){
			$page			=		(!empty($options['page']))			? $options['page'] 				: '1';
			$rows			=		(!empty($options['rows_per_page']))	? $options['rows_per_page'] 	: '10';
			$order_by		=		(!empty($options['order_by']))		? $options['order_by'] 			: 'id';
			$sort_direction	=		(!empty($options['sort_direction']))? $options['sort_direction'] 	: 'desc';
			$end 			= 		$rows*($page-1);
        	$limit 			= 		" limit $end,$rows";
			$query			=		" select * from {$this->table_name} where province='$province' order by $order_by $sort_direction";
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
function getlistMember($options='',$member_id){
			$page			=		(!empty($options['page']))			? $options['page'] 				: '1';
			$rows			=		(!empty($options['rows_per_page']))	? $options['rows_per_page'] 	: '10';
			$order_by		=		(!empty($options['order_by']))		? $options['order_by'] 			: 'id';
			$sort_direction	=		(!empty($options['sort_direction']))? $options['sort_direction'] 	: 'desc';
			$end 			= 		$rows*($page-1);
        	$limit 			= 		" limit $end,$rows";
			$query			=		" select distinct pharmacy_id from prescription where user_id='$member_id' order by $order_by $sort_direction";
			$query_sql		=		tep_db_query($query);
			$num_rows 		= 		tep_db_num_rows($query_sql);
		if($num_rows>0)	{
				$result = array();
				while($query_result=tep_db_fetch_assoc($query_sql)){
				array_push($result, $query_result);
				}
				return $result;
		}
		else 
		return "empty";
}

function getProvinces(){
		
			$query			=		" select distinct province from {$this->table_name} where province > '' order by province";
            
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

function getPharmacy($id){
		
			$query			=		" select * from {$this->table_name} where id='$id' order by name";
            
            echo "Got to line ".__LINE__." in ".__FILE__." query is $query <br /><br />";
            
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