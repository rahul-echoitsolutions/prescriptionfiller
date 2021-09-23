<?php
class credit	{
	
	var $id						    =	'';
    var $member_id					=	'';
	var $application_type			=	'';
	var $loan_type					=	'';
    var $loan_amount    			=	'';
	var $employer_name				=	'';
	var	$job_title					=	'';
	var $job_time					=	'';
	var $amount_primary_income		=	'';
	var $frequency_primary_income	=	'';
	var $work_phone					=	'';
	var $amount_secondary_income 	=	0;
	var $frequency_secondary_income	=	'';
	var $their_employer_name 	    = 	'';
	var $their_job_title		    =	'';
	var $their_job_time		        =	'';
    var $their_amount_primary_income		=	'';
	var $their_frequency_primary_income		=	'';
	var $their_work_phone			        =	'';
	var $their_amount_secondary_income		=	'';
	var	$their_frequency_secondary_income   =	'';
    var	$their_sin                          =	'';
    var	$their_birthdate                    =	'';
    var	$their_first_name                   =	'';
    var	$their_last_name                    =	'';
    var	$their_address                      =	'';
    var	$their_email                        =	'';
    var	$their_city                         =	'';
    var	$their_province                     =	'';
    var	$their_home_phone                   =	'';
    var	$their_mobile_phone                 =	'';
    var	$vehicle_make_model                 =	'';
    var	$sin                                =	'';
    var	$birthdate                          =	'';
    var	$best_time                          =	'';
    var	$customer_comments                  =	'';
    var	$dateentered                        =	'';
    var	$lastupdated                        =	'';
    var	$completed                          =	'';
    var	$dealclosed                         =	'';
    var $preferred_payment                  =	'';
    




	var $table_name					        =	'applications';
	

function save(){
				$sqlarray = array(
				"id"							    =>	$this->id,
                "member_id"	        			    =>	$this->member_id,
				"application_type"				    =>	$this->application_type,
				"employer_name"					    =>	$this->employer_name,
				"loan_type"						    =>	$this->loan_type,
                "loan_amount"					    =>	$this->loan_amount,
				"job_time"						    =>	$this->job_time,
                "job_title"						    =>	$this->job_title,
				"amount_primary_income"				=>	$this->amount_primary_income,
				"frequency_primary_income"			=>	$this->frequency_primary_income,
				"work_phone"						=>	$this->work_phone,
                "amount_secondary_income"		    =>	$this->amount_secondary_income,
                "frequency_secondary_income"		=>	$this->frequency_secondary_income,
				"their_employer_name"			    =>	$this->their_employer_name,
                "their_job_time"			        =>	$this->their_job_time,
                "their_job_title"			        =>	$this->their_job_title,
                "their_amount_primary_income"		=>	$this->their_amount_primary_income,
                "their_frequency_primary_income"	=>	$this->their_frequency_primary_income,
                "their_work_phone"				    =>	$this->their_work_phone,
                "their_frequency_secondary_income"	=>	$this->their_frequency_secondary_income,
                "their_amount_secondary_income"		=>	$this->their_amount_secondary_income,
                "their_sin"			                =>	$this->their_sin,
                "their_birthdate"			        =>	$this->their_birthdate,
                "their_first_name"			        =>	$this->their_first_name,
                "their_last_name"			        =>	$this->their_last_name,
                "their_email"			            =>	$this->their_email,
                "their_address"			            =>	$this->their_address,
                "their_city"			            =>	$this->their_city,
                "their_province"			        =>	$this->their_province,
                "their_home_phone"			        =>	$this->their_home_phone,
                "their_mobile_phone"			    =>	$this->their_mobile_phone,
                "vehicle_make_model"			    =>	$this->vehicle_make_model,
                "sin"			                    =>	$this->sin,
                "birthdate"			                =>	$this->birthdate,
                "dateentered"			            =>	$this->dateentered,
                "lastupdated"			            =>	$this->lastupdated,
                "preferred_payment"                 => $this->preferred_payment,
                



                
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
		
		$sql 			= 	"select * from {$this->table_name}  where id=$id";
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);
		
		if($sqlarray){
			$this->id 							    = isset($sqlarray['id'])						        ?$sqlarray['id']:'';
            $this->member_id 					    = isset($sqlarray['member_id'])					        ?$sqlarray['member_id']:'';
			$this->application_type 				= isset($sqlarray['application_type'])				    ?$sqlarray['application_type']:'';
			$this->employer_name 					= isset($sqlarray['employer_name'])					    ?$sqlarray['employer_name']:'';
			$this->loan_type 						= isset($sqlarray['loan_type'])					        ?$sqlarray['loan_type']:'';
            $this->loan_amount 						= isset($sqlarray['loan_amount'])				        ?$sqlarray['loan_amount']:'';
			$this->job_title			 			= isset($sqlarray['job_title'])					        ?$sqlarray['job_title']:'';
			$this->job_time			 				= isset($sqlarray['job_time'])					        ?$sqlarray['job_time']:'';
			$this->amount_primary_income			= isset($sqlarray['amount_primary_income'])			    ?$sqlarray['amount_primary_income']:'';
			$this->frequency_primary_income			= isset($sqlarray['frequency_primary_income'])		    ?$sqlarray['frequency_primary_income']:'';
			$this->work_phone 						= isset($sqlarray['work_phone'])					    ?$sqlarray['work_phone']:0;
	        $this->amount_secondary_income 			= isset($sqlarray['amount_secondary_income'])			?$sqlarray['amount_secondary_income']:0;			            
            $this->frequency_secondary_income 		= isset($sqlarray['frequency_secondary_income'])		?$sqlarray['frequency_secondary_income']:'';
            $this->their_employer_name 				= isset($sqlarray['their_employer_name'])			    ?$sqlarray['their_employer_name']:'';
            $this->their_job_title 				    = isset($sqlarray['their_job_title'])			        ?$sqlarray['their_job_title']:'';
            $this->their_job_time 				    = isset($sqlarray['their_job_time'])			        ?$sqlarray['their_job_time']:'';
            $this->their_amount_primary_income 		= isset($sqlarray['their_amount_primary_income'])		?$sqlarray['their_amount_primary_income']:'';
            $this->their_frequency_primary_income 	= isset($sqlarray['their_frequency_primary_income'])	?$sqlarray['their_frequency_primary_income']:'';
    		$this->their_work_phone 				= isset($sqlarray['their_work_phone'])			        ?$sqlarray['their_work_phone']:'';
			$this->their_amount_secondary_income    = isset($sqlarray['their_amount_secondary_income'])		?$sqlarray['their_amount_secondary_income']:'';
            $this->their_frequency_secondary_income = isset($sqlarray['their_frequency_secondary_income'])	?$sqlarray['their_frequency_secondary_income']:'';
            $this->their_sin 				        = isset($sqlarray['their_sin'])		                    ?$sqlarray['their_sin']:'';
            $this->their_birthdate 				    = isset($sqlarray['their_birthdate'])		            ?$sqlarray['their_birthdate']:'';
            $this->their_first_name 				= isset($sqlarray['their_first_name'])		            ?$sqlarray['their_first_name']:'';
            $this->their_last_name 				    = isset($sqlarray['their_last_name'])		            ?$sqlarray['their_last_name']:'';
            $this->their_email 				        = isset($sqlarray['their_email'])		                ?$sqlarray['their_email']:'';
            $this->their_address 				    = isset($sqlarray['their_address'])		                ?$sqlarray['their_address']:'';
            $this->their_city 				        = isset($sqlarray['their_city'])		                ?$sqlarray['their_city']:'';
            $this->their_province 				    = isset($sqlarray['their_province'])		            ?$sqlarray['their_province']:'';
            $this->their_home_phone 				= isset($sqlarray['their_job_time'])		            ?$sqlarray['their_job_time']:'';
            $this->their_mobile_phone 				= isset($sqlarray['their_mobile_phone'])		        ?$sqlarray['their_mobile_phone']:'';
            $this->sin 				                = isset($sqlarray['sin'])		                        ?$sqlarray['sin']:'';
            $this->vehicle_make_model 				= isset($sqlarray['vehicle_make_model'])		        ?$sqlarray['vehicle_make_model']:'';
            $this->birthdate 				        = isset($sqlarray['birthdate'])		                    ?$sqlarray['birthdate']:'';
            $this->dateentered 				        = isset($sqlarray['dateentered'])		                ?$sqlarray['dateentered']:'';
            $this->lastupdated 				        = isset($sqlarray['lastupdated'])		                ?$sqlarray['lastupdated']:'';
            $this->preferred_payment                = isset($sqlarray['preferred_payment'])                 ?$sqlarray['preferred_payment']:'';
            


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