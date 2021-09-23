<?php
class dealers{
	var $id 	            = 0;
    var $type               = '';
	var $password			= '';
	var $email 				= '';
	var $first_name			= '';
	var $last_name			= '';
    var $address			= '';
	var $city				= '';
	var $postcode			= '';
	var $province			= '';
	var $register_date		= '';
    var $status             = 'active';
    var $phone1             = '';
    var $phone2             = '';
    var $phone              = '';
    var $company            = '';
    var $company_trade_name = '';
    var $ip                 = '';
    var $payment_method     = '';
    var $subscription       = '';
    var $sub_start_date     = '';
    var $sub_end_date       = '';
    var $first_name1        = '';
    var $last_name1         = '';
    var $email1             = '';
    var $position           = '';
    var $position1          = '';
    var $street             = '';
    var $billing_street     = '';
    var $billing_postcode   = '';
    var $billing_city       = '';
    var $billing_country    = '';
    var $billing_province   = '';
    var $country            = '';
    var $billing_address    = '';
    var $hear_abt_us        = '';
    var $latitude           = '';
    var $longitude          = '';
	var $stripe_custID		= '';
	var $stripe_pmID		= '';
	var $stripe_status		= '';
	var $stripe_date		= '';
	var $table_name 		= 'doctors';
	function save(){
		$sqlarray = array(
                "password"		        =>	$this->password,
                "type"                  =>  $this->type,
                "first_name"	        =>	$this->first_name,
                "last_name"		        =>	$this->last_name,
                "email"			        =>	$this->email,
                "province"		        =>	$this->province,
                "postcode"		        =>	$this->postcode,
                "city"			        =>	$this->city,
                "street"                =>  $this->street,
                "country"               =>  $this->country,
                "billing_street"        =>  $this->billing_street,
                "billing_province"      =>	$this->billing_province,
                "billing_postcode"      =>	$this->billing_postcode,
                "billing_city"		    =>	$this->billing_city,
                "billing_country"       =>  $this->billing_country,
                "billing_address"       =>  $this->billing_address,
                "address"		        =>	$this->address,
                "register_date"	        =>	$this->register_date,
                "phone"	                =>	$this->phone,
                "phone1"        	    =>	$this->phone1,
                "phone2"        	    =>	$this->phone2,
                "company"	            =>	$this->company,
                "status"    	        =>	$this->status,
                "ip"                    =>  $this->ip,
                "payment_method"        =>  $this->payment_method,
                "subscription"          =>  $this->subscription,
                "sub_start_date"        =>  $this->sub_start_date,
                "sub_end_date"          =>  $this->sub_end_date,
                "first_name1"           =>  $this->first_name1,
                "last_name1"            =>  $this->last_name1,
                "email1"                =>  $this->email1,
                "hear_abt_us"           =>  $this->hear_abt_us,
                "position"              =>  $this->position,
                "position1"             =>  $this->position1,
                "company_trade_name"    =>  $this->company_trade_name,
                "latitude"              => $this->latitude,
                "longitude"             => $this->longitude,
				"stripe_custID"         => $this->stripe_custID,
				"stripe_pmID"           => $this->stripe_pmID,
				"stripe_status"         => $this->stripe_status,
				"stripe_date"           => $this->stripe_date,
			);
		if($this->id>0){ tep_db_perform($this->table_name,$sqlarray,'update',' id="' . $this->id . '"'); }
		else
		{
			tep_db_perform($this->table_name,$sqlarray);
			$this->id=tep_db_insert_id();
		}
	}
	function delete($userid){
		$query = "delete from {$this->table_name}  where id='$userid';";
		tep_db_query($query);
	}
	function load($userid){
		$sql 			= "select * from {$this->table_name}  where id=$userid";
		$sqlresult 		= tep_db_query($sql);
		$sqlarray 		= tep_db_fetch_array($sqlresult);
		if($sqlarray){
			$this->id 	                = isset($sqlarray['id'])?$sqlarray['id']:0;
            $this->type                 = isset($sqlarray['type'])?$sqlarray['type']:0;
			$this->password 	    	= isset($sqlarray['password'])?$sqlarray['password']:'';
			$this->first_name 	    	= isset($sqlarray['first_name'])?$sqlarray['first_name']:'';
			$this->last_name 		    = isset($sqlarray['last_name'])?$sqlarray['last_name']:'';
			$this->email    			= isset($sqlarray['email'])?$sqlarray['email']:'';
			$this->city 	    		= isset($sqlarray['city'])?$sqlarray['city']:'';
			$this->postcode 	    	= isset($sqlarray['postcode'])?$sqlarray['postcode']:'';
			$this->province      		= isset($sqlarray['province'])?$sqlarray['province']:'';
            $this->street	            = isset($sqlarray['street'])?$sqlarray['street']:'';
            $this->country	            = isset($sqlarray['country'])?$sqlarray['country']:'';
            $this->billing_city 	    = isset($sqlarray['billing_city'])?$sqlarray['billing_city']:'';
			$this->billing_postcode 	= isset($sqlarray['billing_postcode'])?$sqlarray['billing_postcode']:'';
			$this->billing_province     = isset($sqlarray['billing_province'])?$sqlarray['billing_province']:'';
            $this->billing_street	    = isset($sqlarray['billing_street'])?$sqlarray['billing_street']:'';
            $this->billing_country	    = isset($sqlarray['billing_country'])?$sqlarray['billing_country']:'';
			$this->address 		    	= isset($sqlarray['address'])?$sqlarray['address']:'';
			$this->register_date	    = isset($sqlarray['register_date'])?$sqlarray['register_date']:'';
            $this->company  	        = isset($sqlarray['company'])?$sqlarray['company']:'';
            $this->phone        	    = isset($sqlarray['phone'])?$sqlarray['phone']:'';
            $this->phone1	            = isset($sqlarray['phone1'])?$sqlarray['phone1']:'';
            $this->phone2	            = isset($sqlarray['phone2'])?$sqlarray['phone2']:'';
            $this->ip	                = isset($sqlarray['ip'])?$sqlarray['ip']:'';
            $this->status	            = isset($sqlarray['status'])?$sqlarray['status']:'';
            $this->payment_method       = isset($sqlarray['payment_method'])?$sqlarray['payment_method']:'';
            $this->subscription	        = isset($sqlarray['subscription'])?$sqlarray['subscription']:'';
            $this->sub_start_date	    = isset($sqlarray['sub_start_date'])?$sqlarray['sub_start_date']:'';
            $this->sub_end_date	        = isset($sqlarray['sub_end_date'])?$sqlarray['sub_end_date']:'';
            $this->position1	        = isset($sqlarray['position1'])?$sqlarray['position1']:'';
            $this->position	            = isset($sqlarray['position'])?$sqlarray['position']:'';
            $this->first_name1	        = isset($sqlarray['first_name1'])?$sqlarray['first_name1']:'';
            $this->last_name1	        = isset($sqlarray['last_name1'])?$sqlarray['last_name1']:'';
            $this->email1	            = isset($sqlarray['email1'])?$sqlarray['email1']:'';
            $this->hear_abt_us	        = isset($sqlarray['hear_abt_us'])?$sqlarray['hear_abt_us']:'';
            $this->billing_address      = isset($sqlarray['billing_address'])?$sqlarray['billing_address']:'';
            $this->company_trade_name   = isset($sqlarray['company_trade_name'])?$sqlarray['company_trade_name']:'';
            $this->latitude             = isset($sqlarray['latitude'])?$sqlarray['latitude']:'';
            $this->longitude            = isset($sqlarray['longitude'])?$sqlarray['longitude']:''; 
			$this->stripe_custID        = isset($sqlarray['stripe_custID'])?$sqlarray['stripe_custID']:'';   
			$this->stripe_pmID          = isset($sqlarray['stripe_pmID'])?$sqlarray['stripe_pmID']:'';   
			$this->stripe_status        = isset($sqlarray['stripe_status'])?$sqlarray['stripe_status']:'';   
			$this->stripe_date          = isset($sqlarray['stripe_date'])?$sqlarray['stripe_date']:'';   
		}
	}
	function getlist($type){
		$query 		=	"select * from {$this->table_name} where type='$type' order by id desc";
		$query_sql	=	tep_db_query($query);
		$rowscount	=	tep_db_num_rows($query_sql);
		$result = array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}
	function getUserID($email){ 
		$sql = "select id from {$this->table_name}  where email='$email'";
		$row = tep_db_result_row($sql);
		if($row){
			return $row[0];
		}
		return '';
	}
	function validate_dealer(){
	$sql = "select id from {$this->table_name}  where email='" . tep_db_input($this->email) . "' and password='" . tep_db_input($this->password) . "'";
		$row = tep_db_result_row($sql);
		if($row){
			if($row[0]>0){
				$this->load($row[0]);
				if($this->address=='inactive')
				return 'inactive';
				else
				{
					return 'active';
				}
			}
		}
		return "invalid";
	}
    function hasFilledProfileCompletely() {
        if($this->company == '')    return 0;
        if($this->first_name == '') return 0;   
        if($this->last_name == '')  return 0;   
        if($this->email == '')      return 0;   
        if($this->phone= '')        return 0;   
        if($this->position= '')     return 0;   
        if($this->street == '')     return 0;   
        if($this->country == '')    return 0;   
        if($this->city == '')       return 0;   
        if($this->postcode == '')   return 0;   
        if($this->province == '')   return 0;   
        return 1;
    }
	function checkIfEmailExists($email) { 
    	$sql 		= "select * from {$this->table_name}  where email='{$this->email}'";
        $sqlresult 	= tep_db_query($sql);
        $rows 		= tep_db_num_rows($sqlresult);
        if($rows>0){
            return "1";
        }
        else return "0";
	}
		function emailexists($email,$userid){ 
		$sql = "select count(*) as count from {$this->table_name}  where id<>$userid and email='$email'";
		$row = tep_db_result_row($sql);
		if($row){
			if($row[0]>0) return true;
		}
		return false;
	}
}
?>