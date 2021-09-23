<?php

class tenants	{


		var  $tenant_id						= 0;
        var  $Tenant_Suite_Number           = '';
        var  $Tenant_First_Name             = '';
        var  $Tenant_Last_Name              = '';
        var  $Tenant_Phone                  = '';
        var  $Tenant_Email                  = '';
        var  $Tenant_Emergency_Number       = '';
        var  $Date_Tenancy_Commenced        = '';
		var  $Date_Tenancy_Ends        		= '';
        var  $Number_of_Adults              = '';
        var  $Number_of_Children            = '';
        var  $Term                          = '';
        var  $Rent                          = '';
		var  $Balance                       = '';
        var  $Deposit_Collected             = '';
        var  $Deposit_Returned              = '';
        var  $Notes                         = '';
		var  $Tenant2_First_Name			= '';
		var  $Tenant3_First_Name			= '';
		var  $Tenant4_First_Name			= '';
		var  $Tenant2_Last_Name				= '';
		var  $Tenant3_Last_Name				= '';
		var  $Tenant4_Last_Name				= '';
		var  $Tenant2_Phone					= '';
		var  $Tenant3_Phone					= '';
		var  $Tenant4_Phone					= '';
		var  $building_id					= '';
		var  $Move_Out_Date					= '';
		var  $Electericity_Reg_Date			= '';
        var  $table_name	                = TABLE_TENANTS;
		var  $table_suites					= TABLE_RENTAL_BUILDING;



function save(){

				$sqlarray = array(

                        "tenant_id"=> $this->tenant_id,

                        "building_id"=> $this->building_id,

                        "Tenant_Suite_Number" => $this->Tenant_Suite_Number,	

                        "Tenant_First_Name" => $this->Tenant_First_Name,

                        "Tenant_Last_Name" => $this->Tenant_Last_Name,

                        "Tenant_Phone" => $this->Tenant_Phone,

                        "Tenant_Email" => $this->Tenant_Email,

                        "Tenant_Emergency_Number" => $this->Tenant_Emergency_Number,

                        "Date_Tenancy_Commenced" => $this->Date_Tenancy_Commenced,

                        "Number_of_Adults" => $this->Number_of_Adults,

                        "Number_of_Children" => $this->Number_of_Children,

                        "Term" => $this->Term,

                        "Rent" => $this->Rent,

                        "Deposit_Collected" => $this->Deposit_Collected,

                        "Deposit_Returned" => $this->Deposit_Returned,

                        "Notes" 			=> $this->Notes,
						
						"Tenant2_First_Name" 	=> $this->Tenant2_First_Name,
						
						"Tenant3_First_Name" 	=> $this->Tenant3_First_Name,
						
						"Tenant4_First_Name" 	=> $this->Tenant4_First_Name,
						
						"Tenant2_Last_Name" 	=> $this->Tenant2_Last_Name,
						
						"Tenant3_Last_Name" 	=> $this->Tenant3_Last_Name,
						
						"Tenant4_Last_Name" 	=> $this->Tenant4_Last_Name,
						
						"Tenant2_Phone" 		=> $this->Tenant2_Phone,	
						
						"Tenant3_Phone" 		=> $this->Tenant3_Phone,	
						
						"Tenant4_Phone" 		=> $this->Tenant4_Phone,	
						
						"Date_Tenancy_Ends"		=> $this->Date_Tenancy_Ends,
						
						"Move_Out_Date"			=> $this->Move_Out_Date,
						
						"Electericity_Reg_Date" => $this->Electericity_Reg_Date,

				);
				


		if($this->tenant_id>0)

			tep_db_perform($this->table_name,$sqlarray,'update',' tenant_id="' . $this->tenant_id . '"');

		else{

			tep_db_perform($this->table_name,$sqlarray);

			$this->tenant_id=tep_db_insert_id();

		}

}

	

function delete($id){
		$query = "update  {$this->table_name} set Archive_Flag = 1  where tenant_id='$id';";
		tep_db_query($query);
}

	

	

function load($id){

		

		$sql 			= 	"select * from {$this->table_name}  where tenant_id=" . $id;

		$sqlresult 		= 	tep_db_query($sql);

		$sqlarray 		= 	tep_db_fetch_array($sqlresult);

		

		if($sqlarray){
			$this->tenant_id 							=isset($sqlarray['tenant_id'])?  $sqlarray['tenant_id']:0;
            $this->building_id 							=isset($sqlarray['building_id'])?  $sqlarray['building_id']:0;
            $this->Tenant_Suite_Number              	=isset($sqlarray['Tenant_Suite_Number'])?  $sqlarray['Tenant_Suite_Number']:'';
            $this->Tenant_First_Name                	=isset($sqlarray['Tenant_First_Name'])?  $sqlarray['Tenant_First_Name']:'';
            $this->Tenant_Last_Name                		=isset($sqlarray['Tenant_Last_Name'])?  $sqlarray['Tenant_Last_Name']:'';
            $this->Tenant_Phone                     	=isset($sqlarray['Tenant_Phone'])?  $sqlarray['Tenant_Phone']:'';
            $this->Tenant_Email                     	=isset($sqlarray['Tenant_Email'])?  $sqlarray['Tenant_Email']:'';
            $this->Tenant_Emergency_Number          	=isset($sqlarray['Tenant_Emergency_Number'])?  $sqlarray['Tenant_Emergency_Number']:'';
            $this->Date_Tenancy_Commenced           	=isset($sqlarray['Date_Tenancy_Commenced'])?  $sqlarray['Date_Tenancy_Commenced']:'';
            $this->Number_of_Adults                 	=isset($sqlarray['Number_of_Adults'])?  $sqlarray['Number_of_Adults']:'';
            $this->Number_of_Children               	=isset($sqlarray['Number_of_Children'])?  $sqlarray['Number_of_Children']:'';
            $this->Term                             	=isset($sqlarray['Term'])?  $sqlarray['Term']:'';
            $this->Rent                             	=isset($sqlarray['Rent'])?  $sqlarray['Rent']:'';
            $this->Deposit_Collected                	=isset($sqlarray['Deposit_Collected'])?  $sqlarray['Deposit_Collected']:'';
            $this->Deposit_Returned                 	=isset($sqlarray['Deposit_Returned'])?  $sqlarray['Deposit_Returned']:'';
            $this->Notes                            	=isset($sqlarray['Notes'])?  $sqlarray['Notes']:'';
			$this->Balance                            	=isset($sqlarray['Balance'])?  $sqlarray['Balance']:'';
			$this->Tenant2_First_Name                 	=isset($sqlarray['Tenant2_First_Name'])?  $sqlarray['Tenant2_First_Name']:'';
			$this->Tenant2_Last_Name                  	=isset($sqlarray['Tenant2_Last_Name'])?  $sqlarray['Tenant2_Last_Name']:'';
			$this->Tenant2_Phone                      	=isset($sqlarray['Tenant2_Phone'])?  $sqlarray['Tenant2_Phone']:'';
			$this->Tenant3_First_Name                 	=isset($sqlarray['Tenant3_First_Name'])?  $sqlarray['Tenant3_First_Name']:'';
			$this->Tenant3_Last_Name                  	=isset($sqlarray['Tenant3_Last_Name'])?  $sqlarray['Tenant3_Last_Name']:'';
			$this->Tenant3_Phone                      	=isset($sqlarray['Tenant3_Phone'])?  $sqlarray['Tenant3_Phone']:'';
			$this->Tenant4_First_Name                 	=isset($sqlarray['Tenant4_First_Name'])?  $sqlarray['Tenant4_First_Name']:'';
			$this->Tenant4_Last_Name                  	=isset($sqlarray['Tenant4_Last_Name'])?  $sqlarray['Tenant4_Last_Name']:'';
			$this->Tenant4_Phone                      	=isset($sqlarray['Tenant4_Phone'])?  $sqlarray['Tenant4_Phone']:'';
			$this->Date_Tenancy_Ends                  	=isset($sqlarray['Date_Tenancy_Ends'])?  $sqlarray['Date_Tenancy_Ends']:'';
			$this->Move_Out_Date                  		=isset($sqlarray['Move_Out_Date'])?  $sqlarray['Move_Out_Date']:'';
			$this->Electericity_Reg_Date                =isset($sqlarray['Electericity_Reg_Date'])?  $sqlarray['Electericity_Reg_Date']:'';

		}
}





function getlist($options=''){

    
		$building_id 	= isset($options['building_id'])?$options['building_id']:'';
		$owner_id 		= isset($options['owner_id'])?$options['owner_id']:'';
		$suite_no		= isset($options['suite_no'])?$options['suite_no']:'';
		$archive		= isset($options['archive'])?$options['archive']:'';
		
		$q 				= array();
		
		
		if($building_id!='' && $suite_no!='' ) 	$q[]  = "(t.building_id  = $building_id and t.Tenant_Suite_Number = '$suite_no')";
		if($building_id!='' && $suite_no=='') 	$q[]  = "(t.building_id  = $building_id)";

		
		if($owner_id!='') 		$q[]  = "(r.rental_user_id  = '$owner_id')";
		if($archive=='') 		$q[]  = "(t.Archive_Flag = '' And (t.Move_Out_Date = '0000-00-00 00:00:00' OR t.Move_Out_Date >now()))";
		if($archive==1) 		$q[]  = "(t.Archive_Flag = '1' OR (t.Move_Out_Date < now() and t.Move_Out_Date !='0000-00-00 00:00:00'))";
		
		$subquery	 	=		(sizeof($q)>0)? implode(" and ",$q):'';
		
		$query 			= 		"select s.rental_id,t.*,r.rental_user_id,r.first_name,r.last_name from {$this->table_name} t left join {$this->table_suites} s on ";
		$query		   .=		"(s.title = t.Tenant_Suite_Number and s.building_id = t.building_id) left join rental_users r on (r.rental_user_id = s.user_id) "; 
		$query		   .=		" where $subquery group by t.tenant_id order by case when t.Move_Out_Date = '0000-00-00 00:00:00' then 1 else 0 end, t.Move_Out_Date";  

        

		$query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);

		

		if($num_rows>0)	{

			

				$result = array();

				while($query_result=tep_db_fetch_array($query_sql)){

				array_push($result, $query_result);

				}

				return $result;

		}

		else {

		return "empty";

        }

}

function getActiveTenants(){

		$query 			= 		"select t.*,s.rental_id,s.move_out_flag from {$this->table_name} t left join {$this->table_suites} s on ";
		$query		   .=		"(s.title = t.Tenant_Suite_Number and s.building_id = t.building_id) where t.Archive_Flag <> 1 and (t.Move_Out_Date = '0000-00-00 00:00:00' or t.Move_Out_Date>=now()) "; 
		$query		   .=		"and t.Date_Tenancy_Commenced < now() group by t.tenant_id order by t.tenant_id DESC"; 
		
		
		
//		echo $query; exit();

		$query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);

		

		if($num_rows>0)	{

			

				$result = array();

				while($query_result=tep_db_fetch_array($query_sql)){

				array_push($result, $query_result);

				}

				return $result;

		}

		else {

		return "empty";

        }

}






function getlistBuilding($building_id){



            $query 			= 		"select * from {$this->table_name}  where building_id='$building_id' order by tenant_id DESC";

            

            

 

		$query_sql		=		tep_db_query($query);

		$num_rows 		= 		tep_db_num_rows($query_sql);

		

		if($num_rows>0)	{

			

				$result = array();

				while($query_result=tep_db_fetch_array($query_sql)){

				array_push($result, $query_result);

				}

				return $result;

		}

		else {

		return "empty";

        }

}


function getTotalRecords(){



		$query 			=	"select count(*) as total from {$this->table_name}";

		$query_sql		=	tep_db_query($query);

		$num_rows 		=	tep_db_num_rows($query_sql);

		

		if($num_rows>0) {

				$query_result	=	tep_db_fetch_array($query_sql);

				return $query_result['total'];

		}

		else

		return "empty";



}



function getBuildingImagesList($tenant_id) {

	

		$table_building_images	= TABLE_BUILDING_IMAGES;

		$query 					=	"select * from $table_building_images where tenant_id = $tenant_id";

		$query_sql				=	tep_db_query($query);

		$num_rows 				=	tep_db_num_rows($query_sql);

		

		if($num_rows>0){

		
				$result = array();

				while($query_result=tep_db_fetch_array($query_sql)){

				array_push($result, $query_result);

		}

				return $result;

		}

		else  

		return "empty"; 

		

}





function getBuildingImagesListFromAddress($address) {

	

		$table_building_images	= TABLE_BUILDING_IMAGES;

		$query 					=	"select b.*,i.* from {$this->table_name} b left join $table_building_images i on i.tenant_id = b.tenant_id  where b.building_address='$address'";

		$query_sql				=	tep_db_query($query);

		$num_rows 				=	tep_db_num_rows($query_sql);

		

		if($num_rows>0){

			

				$result = array();

				while($query_result=tep_db_fetch_array($query_sql)){

				array_push($result, $query_result);

				}

				return $result;

		}

		else  

		return "empty"; 

		

}



function add_building_images(){

		

								$sqlarray = array(

								"tenant_id"			=>	$this->tenant_id,

								"thumbnail"				=>	$this->building_image_thumbnail,

								"big_image"				=>	$this->building_image_big_image,

								"title"					=>	$this->building_image_title,

								"description"			=>	$this->building_image_description

								);

				

				if($this->building_image_id>0)

						tep_db_perform(TABLE_BUILDING_IMAGES,$sqlarray,'update',' image_id="' . $this->building_image_id . '"');

				else {

						tep_db_perform(TABLE_BUILDING_IMAGES,$sqlarray);

						$this->building_image_id=tep_db_insert_id();

				}					

}





function update_building_images(){

			

			$table = TABLE_BUILDING_IMAGES;

			$query = "update $table set title = '{$this->building_image_title}, description = '{$this->building_image_description}' where tenant_id = {$this->tenant_id}";

			tep_db_query($query);



}


function updateSuiteNumber($NewSuiteNo,$OldSuiteNo,$BuildingID ) { 

	$query = "update {$this->table_name} set Tenant_Suite_Number = '$NewSuiteNo' where builing_id = '$BuildingID' and  Tenant_Suite_Number = '$OldSuiteNo'";
	tep_db_query($query);
}



function load_building_image($id){

	

		$sql 			= "select * from " . TABLE_BUILDING_IMAGES. " where image_id=$id"; 

		$sqlresult 		= tep_db_query($sql);

		$sqlarray 		= tep_db_fetch_array($sqlresult);

		

		if($sqlarray){

			$this->building_image_thumbnail 	= isset($sqlarray['thumbnail'])		?	$sqlarray['thumbnail']		:	0;

			$this->building_image_big_image 	= isset($sqlarray['big_image'])		?	$sqlarray['big_image']		:	'';

			$this->building_image_title 		= isset($sqlarray['title'])			?	$sqlarray['title']			:	'';

			$this->building_image_description 	= isset($sqlarray['description'])	?	$sqlarray['description']	:	'';

		}

}



function delete_building_image($image_id) {

	

							$this->load_building_image($image_id);

							if($this->building_image_thumbnail!='')					unlink("../images/buildings/".$this->building_image_thumbnail);

							if($this->building_image_big_image!='') 				unlink("../images/buildings/larger/".$this->building_image_big_image);

							$query = "delete from ". TABLE_BUILDING_IMAGES." where image_id = $image_id"; 

							tep_db_query($query);

}



function getTenantIDFromBuildingAndSuite($building_id,$suite_no){



		$query 			=	"select tenant_id from {$this->table_name} where building_id = '$building_id' and Tenant_Suite_Number ='$suite_no' limit 0,1";

		$query_sql		=	tep_db_query($query);

		$num_rows 		= 	tep_db_num_rows($query_sql);

		if($num_rows>0) {

				$result = array();

				$query_result=tep_db_fetch_array($query_sql);

				

				return $query_result['tenant_id'];

		}

		

		else

		return "0";



}


	function getTenantIDFromBuildingAndSuiteMultiple($building_id,$suite_no){
			$query 			=	"select t.tenant_id from {$this->table_name} t left join {$this->table_suites} s on (t.Tenant_Suite_Number = s.title and s.building_id = t.building_id) ";
			$query		   .=	"where t.building_id = '$building_id' and t.Tenant_Suite_Number ='$suite_no'";
			$query		   .=	"AND t.Archive_Flag<>1 ";
			$query		   .=	"order by t.tenant_id";
			$query_sql		=	tep_db_query($query);
			$num_rows 		= 	tep_db_num_rows($query_sql);
			
			
			if($num_rows>0) {
					
					$result = array();
					while($query_result=tep_db_fetch_array($query_sql)){
						array_push($result, $query_result['tenant_id']);
					}
					return $result;
	
			}
			else	return "0";
	}
	
	
	function getCurrentTenantID($building_id,$suite_no){
		$query 			=	"select t.tenant_id from {$this->table_name} t left join {$this->table_suites} s on (t.Tenant_Suite_Number = s.title and s.building_id = t.building_id) ";
		$query		   .=	"where t.building_id = '$building_id' and t.Tenant_Suite_Number ='$suite_no' ";
        $query		   .=	"AND t.Archive_Flag<>1 and (t.Move_Out_Date = '0000-00-00 00:00:00' or t.Move_Out_Date > now()) and ";
		$query		   .=	"t.Date_Tenancy_Commenced <now() order by t.tenant_id DESC limit 1";
		$query_sql		=	tep_db_query($query);
		$num_rows 		= 	tep_db_num_rows($query_sql);
		
		
		if($num_rows>0) {
				
				
				while($query_result=tep_db_fetch_array($query_sql)){
					return $query_result['tenant_id'];
				}
		}
		else	return "0";
	}




	function getTenantsWithRentShort() {
		

		$datestring		=	'first day of this month';
		$dt				=	date_create($datestring);
		$start_date		=	$dt->format('Y-m-d'); 
		
		$datestring		=	'last day of this month';
		$dt				=	date_create($datestring);
		$end_date		=	$dt->format('Y-m-d'); 

		 $query 		= "select t.*,concat(o.first_name,' ',o.last_name) as owner, o.rental_user_id,s.title,s.rental_id,is_parking_spot,b.Building_Address ";
		 $query		   .= "from tenants t left join rental_buildings s on (s.title = t.Tenant_Suite_Number and s.building_id = t.building_id) ";
		 $query		   .= "left join property_building b on (b.Building_Id = t.building_id) left join rental_users o on (s.user_id = o.rental_user_id) ";
		 $query		   .= "where (t.Date_Tenancy_Commenced < now() and (t.Move_Out_Date = '0000-00-00 00:00:00' OR t.Move_Out_Date > now())) and "; 
		 $query		   .= "t.tenant_id not in (SELECT distinct(p.tenant_id) FROM rental_payments p left join {$this->table_name} t on (t.tenant_id = p.tenant_id) WHERE ";
		 $query		   .= "((p.date_paid BETWEEN '$start_date' AND '$end_date') or (p.month_applies_to between '$start_date' and '$end_date')) ";
		 $query		   .= "and p.rent_amount_paid >= t.Rent and p.payment_reason = 'Rent') group by t.tenant_id";

		 
	 	//echo $query;
 		$query_sql		=	tep_db_query($query);
		$num_rows 		= 	tep_db_num_rows($query_sql);

		if($num_rows>0) {

				$result = array();
		
				while($query_result=tep_db_fetch_array($query_sql)){
					array_push($result, $query_result);
				}
					return $result;

		}	else	return "empty";
			
	}
	
	
	
	function getPaymentStatusOfThisMonth($suite_id,$tenantsWithRentShort) {
		
			
			foreach($tenantsWithRentShort as $list ) {
				
					if($list['rental_id'] == $suite_id ) return 'NOT_PAID';
			}
			

			return 'PAID';
			
	}
	
	
	
	function getMovingOutTenants() {
		
		
		 $end_date		= date("Y-m-d H:i:s",strtotime("+30 days"));
		 $start_date	= date("Y-m-d H:i:s");
		 $query 		= "select t.*,b.rental_id from tenants t left join rental_buildings b on (t.Tenant_Suite_Number = b.title and  ";
		 $query		   .= "t.building_id = b.building_id) where (t.Move_Out_Date between '$start_date' "; 
		 $query		   .= "and '$end_date') group by t.tenant_id";

		 
		 
 		$query_sql		=	tep_db_query($query);
		$num_rows 		= 	tep_db_num_rows($query_sql);

		if($num_rows>0) {

				$result = array();
		
				while($query_result=tep_db_fetch_array($query_sql)){
					array_push($result, $query_result);
				}
					return $result;

		}	else	return "empty";
			
	}



	/*function getTotalExpectedRent() {
		
		 $tenantlist    = $this->getlist();
		 $GrandTotal	= 0;
		 foreach($tenantlist as $tenant) {
			 
			 if($tenant['Date_Tenancy_Ends']!='')
			 $months 			= (int)abs((strtotime($tenant['Date_Tenancy_Commenced']) - strtotime($tenant['Date_Tenancy_Ends']))/(60*60*24*30)); 
			 else
			 $months 			= (int)abs((strtotime($tenant['Date_Tenancy_Commenced']) - strtotime(date("Y-m-d H:i:s")))/(60*60*24*30)); 
			 $total_tenant_rent = $months*$tenant['Rent'];
			 $GrandTotal	   += $total_tenant_rent;
		 }
		 
		 return ($GrandTotal>0)?$GrandTotal:0;
			
	}
	*/
	
	
	function getCountTenantsWithRentShortParking($lists) { 
	
		$total = 0;
		foreach($lists as $list) { 
			
				if($list['is_parking_spot'] == 1) $total++;
		}
		
		return $total;
	}
	
	
	
	function getTenantsWithPendingPayments($options=''){

    
		$datestring		=	'first day of this month';
		$dt				=	date_create($datestring);
		$start_date		=	$dt->format('Y-m-d'); 
		
		$datestring		=	'last day of this month';
		$dt				=	date_create($datestring);
		$end_date		=	$dt->format('Y-m-d'); 

		
		
		$building_id 	= isset($options['building_id'])?$options['building_id']:'';
		$owner_id 		= isset($options['owner_id'])?$options['owner_id']:'';
		$suite_no		= isset($options['suite_no'])?$options['suite_no']:'';
		$archive		= isset($options['archive'])?$options['archive']:'';
		$q 				= array();
		
		
		if($building_id!='' && $suite_no!='' ) 	$q[]  = "(t.building_id  = $building_id and t.Tenant_Suite_Number = '$suite_no')";
		if($building_id!='' && $suite_no=='') 	$q[]  = "(t.building_id  = $building_id)";

		
		if($owner_id!='') 		$q[]  = "(r.rental_user_id  = '$owner_id')";
		if($archive=='') 		$q[]  = "(t.Archive_Flag = '' And (t.Move_Out_Date = '0000-00-00 00:00:00' OR t.Move_Out_Date >now()))";
		if($archive==1) 		$q[]  = "(t.Archive_Flag = '1' OR (t.Move_Out_Date < now() and t.Move_Out_Date !='0000-00-00 00:00:00'))";
								$q[]  = "((p.month_applies_to between '$start_date' and '$end_date') OR (p.date_paid between '$start_date' and '$end_date'))";
		
		$subquery	 	=		(sizeof($q)>0)? implode(" and ",$q):'';
		
		$query 			= 		"select b.Building_Address, sum(p.rent_amount_paid) as total, s.rental_id,s.is_parking_spot,t.*,r.rental_user_id,concat(r.first_name,' ',r.last_name) ";
		$query		   .=		"as owner from {$this->table_name} t left join property_building b on (b.Building_Id = t.building_id) ";
		$query		   .=		"left join rental_payments p on  (p.tenant_id = t.tenant_id) left join {$this->table_suites} s on   ";
		$query		   .=		"(s.title = t.Tenant_Suite_Number and s.building_id = t.building_id) left join rental_users r on (r.rental_user_id = s.user_id) "; 
		$query		   .=		" where $subquery group by t.tenant_id";   //echo $query; exit();

        

		$query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);

		

		if($num_rows>0)	{

			

				$result = array();

				while($query_result=tep_db_fetch_array($query_sql)){

				array_push($result, $query_result);

				}

				return $result;

		}

		else {

		return "empty";

        }

}

function sendLateFeeChargesEmail($tenant_name,$tenant_email) { 


		$message 		= "<p> Dear $tenant_name </p>";
		$message 	   .= "<p> There are late fee charges of ${$amount} have been applied to your account for this month. Please include it with the next payment </p>";
		$message 	   .= "<p> Thank You <br> PropertyPlan.com </p>";
		
		
		$to 			= $tenant_email;
		$subject 		= 'Late Fee Charges Applied';
		
		$headers 		= "From: info@propertyPlan.ca \r\n";
		$headers 	   .= "MIME-Version: 1.0\r\n";
		$headers 	   .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		
		@mail($to,$subject,$message,$headers);

}

/////////////////////////////////end of class definition////////////////	

}

?>