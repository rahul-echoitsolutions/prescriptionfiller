<?php
class rental_payments	{
	var $payment_id 		= 0;
	var $suite_id			= '';
	var $tenant_id 			= '';
	var $rent_amount_paid	= '';
	var $date_paid			= '';
	var $payment_reason		= '';
	var $payment_method		= '';
	var $paid_by_name		= '';
	var $currency			= '';
	var $month_applies_to	= '';
	var $files				= '';
	var $notes				= '';
	var $invoice_number		= '';
	var $late_rent_charges	= '';
	var $table_name 		= TABLE_RENTAL_PAYMENTS;
	var $table_tenants		= TABLE_TENANTS;
	var $table_suites		= TABLE_RENTAL_BUILDING;
	var $table_buildings	= TABLE_PROPERTY_BUILDING;
	var $table_files		= 'rental_payment_files';


	function save(){
		$sqlarray = array(
								"suite_id"			=>	$this->suite_id,
								"rent_amount_paid"	=>	$this->rent_amount_paid,
								"tenant_id"			=>	$this->tenant_id,
								"date_paid"			=>	$this->date_paid,
								"payment_reason"	=>	$this->payment_reason,
								"payment_method"	=>	$this->payment_method,
								"paid_by_name"		=>	$this->paid_by_name,
								"currency"			=>	$this->currency,
								"month_applies_to"	=>	$this->month_applies_to,
								"notes"				=>	$this->notes,
								"files"				=>	$this->files,
								"invoice_number"	=>	$this->invoice_number,
								"late_rent_charges"	=>	$this->late_rent_charges
								);
		if($this->payment_id>0){ tep_db_perform($this->table_name,$sqlarray,'update',' payment_id="' . $this->payment_id . '"'); }
		else
		{
			tep_db_perform($this->table_name,$sqlarray);
			$this->payment_id=tep_db_insert_id();
		}
	}
	
	function delete($payment_id){
		$query = "delete from {$this->table_name}  where payment_id='$payment_id';";
		tep_db_query($query);
	}
	
	
	function load($payment_id){
		$sql 			= "select * from {$this->table_name} where payment_id='$payment_id'"; 
		$sqlresult 		= tep_db_query($sql);
		$sqlarray 		= tep_db_fetch_array($sqlresult);
		if($sqlarray){
			$this->payment_id 			= isset($sqlarray['payment_id'])			?$sqlarray['payment_id']:0;
			$this->suite_id 			= isset($sqlarray['suite_id'])				?$sqlarray['suite_id']:'';
			$this->rent_amount_paid		= isset($sqlarray['rent_amount_paid'])		?$sqlarray['rent_amount_paid']:'';
			$this->tenant_id 			= isset($sqlarray['tenant_id'])				?$sqlarray['tenant_id']:'';
			$this->payment_method 		= isset($sqlarray['payment_method'])		?$sqlarray['payment_method']:'';
			$this->payment_reason 		= isset($sqlarray['payment_reason'])		?$sqlarray['payment_reason']:'';
			$this->date_paid 			= isset($sqlarray['date_paid'])				?$sqlarray['date_paid']:'';
			$this->paid_by_name 		= isset($sqlarray['paid_by_name'])			?$sqlarray['paid_by_name']:'';
			$this->month_applies_to		= isset($sqlarray['month_applies_to'])		?$sqlarray['month_applies_to']:'';
			$this->files				= isset($sqlarray['files'])					?$sqlarray['files']:'';
			$this->invoice_number		= isset($sqlarray['invoice_number'])		?$sqlarray['invoice_number']:'';
			$this->notes				= isset($sqlarray['notes'])					?$sqlarray['notes']:'';
			$this->late_rent_charges	= isset($sqlarray['late_rent_charges'])		?$sqlarray['late_rent_charges']:'';
			
		}
	}
	
	function getlist($options=''){
		
		$where 	= array();

		if(!isset($options['financial_history'])) {

		if(isset($options['negative_payment']) && $options['negative_payment']==1)	$where[] =  " p.rent_amount_paid < 0";
		else 																		$where[] =  " p.rent_amount_paid >= 0";
		
		}
		
		

		if(isset($options['tenant_id']) && $options['tenant_id']>=0) 				$where[] =  " p.tenant_id = {$options['tenant_id']}";
		if(isset($options['owner_id']) && $options['owner_id']>=0) 					$where[] =  " o.rental_user_id = {$options['owner_id']}";
		if(isset($options['month_name']) && $options['month_name']!='') 			$where[] =  " (p.month_applies_to like '{$options['month_name']}%' or  p.date_paid like '{$options['month_name']}%')";
		

		$where_statement = " where ".implode(" and ",$where);
		
		$query 		=	"select p.*,count(f.file_id) as totalfiles, b.Building_Name, b.Building_Address, b.Building_Id, concat(t.Tenant_First_Name,' ',Tenant_Last_Name) as full_name, s.title, ";
		$query	   .=	"o.rental_user_id, concat(o.first_name,' ',o.last_name) as owner ";
		$query	   .=	"from {$this->table_name} p left join {$this->table_tenants} t on t.tenant_id = p.tenant_id left join {$this->table_suites} s ";
		$query	   .=	"on (s.rental_id = p.suite_id) left join {$this->table_buildings} b on s.building_id = b.building_id left join rental_users o on ";
		$query	   .=	"o.rental_user_id = s.user_id left join {$this->table_files} f on (f.payment_id = p.payment_id) $where_statement group by p.payment_id order by p.date_paid, p.rent_amount_paid";  //echo $query; exit();
		$query_sql	=	tep_db_query($query); 
		$rowscount	=	tep_db_num_rows($query_sql);
		
		$result = array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}
	
	
	function getPaymentReasons() { 
	
		$query 		=	"select payment_reason from {$this->table_name} group by payment_reason order by payment_reason";
		$query_sql	=	tep_db_query($query);
		$rowscount	=	tep_db_num_rows($query_sql);
		
		$result = array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result['payment_reason']);
		}
		return $result;
		
	}
	
	function getTotalRentCollected() {
		

		$query 			=	"select sum(rent_amount_paid) as total from {$this->table_name} where  rent_amount_paid > 0"; 
		$query_sql		=	tep_db_query($query);
		$num_rows 		=	tep_db_num_rows($query_sql);
		
		if($num_rows>0){
				
				$query_result=tep_db_fetch_array($query_sql);
				return $query_result['total'];
				
		}
		else  
		return "0"; 

		
	}
	
	
	function getLastMonthRentCollected() {
			
		$query 			= 	"SELECT sum(rent_amount_paid) as total FROM `{$this->table_name}` where `date_paid` BETWEEN "; 
		$query 		   .=	"DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y-%m-01') AND LAST_DAY(CURRENT_DATE - INTERVAL 1 MONTH) and rent_amount_paid > '0'  "; 
		$query_sql		=	tep_db_query($query);
		$num_rows 		=	tep_db_num_rows($query_sql);
		
		if($num_rows>0){
			
				
				$query_result=tep_db_fetch_array($query_sql);
				return $query_result['total'];
				
		}
		else  
		return "0"; 

		
	}
    
    
    	function getTotalAmountDue($suite_id) {
			
		$query 			= 	"SELECT sum(rent_amount_paid) as totalDue FROM `{$this->table_name}` where suite_id='$suite_id' "; 
		$query_sql		=	tep_db_query($query);
		$num_rows 		=	tep_db_num_rows($query_sql);
		
		if($num_rows>0){
			
				
				$query_result=tep_db_fetch_array($query_sql);
				return round($query_result['totalDue'],2);
				
		}
		else  
		return "0"; 

		
	}
    
    
    
    
   function getTotalRentCollectedMTD() {
		

		$query 			=	"select sum(rent_amount_paid) as total from {$this->table_name} where  rent_amount_paid > '0' AND year(date(date_paid)) = year(CURDATE()) and month(date(date_paid)) = month(CURDATE())"; 
		$query_sql		=	tep_db_query($query);
		$num_rows 		=	tep_db_num_rows($query_sql);
		
		if($num_rows>0){
			
				
				$query_result=tep_db_fetch_array($query_sql);
				return $query_result['total'];
				
		}
		else  
		return "0"; 

		
	}
	
	
	
	function getThisMonthExpectedRent() {
			
		$query 			= 	"SELECT sum(Rent) as total FROM `{$this->table_tenants}` where "; 
		$query 		   .=	"Date_Tenancy_Ends>= now() "; 
		$query_sql		=	tep_db_query($query);
		$num_rows 		=	tep_db_num_rows($query_sql);
		
		if($num_rows>0){
			
				
				$query_result=tep_db_fetch_array($query_sql);
				return $query_result['total'];
				
		}
		else  
		return "0"; 

		
	}
	
	function getMonthList() {
		
			$first  = strtotime('first day this month');
			$months = array();
			
			for ($i = 6; $i >= 0; $i--) {
				array_push($months, date('Y-m', strtotime("+$i month", $first)));
			}
			$future_months = array_reverse($months);		
			
			$first  = strtotime('first day last month');
			$months = array();
			for ($i = 3; $i >= 0; $i--) {
				array_push($months, date('Y-m', strtotime("-$i month", $first)));
			}
			
			
			$temp 			= array_merge($months,$future_months);
		
		return $temp;
							
	}
    
    
    
    
    
    
    
    
    function BankAccountFinancialHistory($bank_account){
		
		$where_statement = " where o.bank_account_number = '$bank_account' and p.rent_amount_paid > 0";
		$query 		=	"select p.*,count(f.file_id) as totalfiles, b.Building_Name, b.Building_Address, b.Building_Id, concat(t.Tenant_First_Name,' ',Tenant_Last_Name) as full_name, s.title, ";
		$query	   .=	"o.rental_user_id, concat(o.first_name,' ',o.last_name) as owner ";
		$query	   .=	"from {$this->table_name} p left join {$this->table_tenants} t on t.tenant_id = p.tenant_id left join {$this->table_suites} s ";
		$query	   .=	"on (s.rental_id = p.suite_id) left join {$this->table_buildings} b on s.building_id = b.building_id left join rental_users o on ";
		$query	   .=	"o.rental_user_id = s.user_id left join {$this->table_files} f on (f.payment_id = p.payment_id) $where_statement group by p.payment_id order by p.date_paid, p.rent_amount_paid";  //echo $query; exit();
		$query_sql	=	tep_db_query($query); 
		$rowscount	=	tep_db_num_rows($query_sql);
		
		if($rowscount > 0 ) {
			$result = array();
			while($query_result=tep_db_fetch_array($query_sql)){
				array_push($result, $query_result);
			}
		return $result;
		}
		
		return 'empty';
	}
	
    
    
    
    
	
	################################################################ end of class ############################################33	
}
?>