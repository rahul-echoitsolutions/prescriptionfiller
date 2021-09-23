<?php
class applications	{
	
	var $id						    =	'';
    var $member_id				    =	'';
	var $application_type			=	'';

    
    var	$completed                          =	'';
    var	$dealclosed                         =	'';
    var $vehicle_color                      =   '';
    var $vehicle_year_min                   =   '';
    var $vehicle_year_max                   =   '';
    var $vehicle_transmission               =   '';
    var $vehicle_make                       = '';
    var $vehicle_model                      = '';
    var $vehicle_max_price                  = '';
    var $vehicle_max_miles                  = '';
    var $vehicle_category                   = '';
    var $vehicle_body_type                  = '';
    var $payment_method                     = '';
    var $date_submitted                     = '';
    var $preferred_contact_method           = '';
    var $radius                             = '';
    var $fuel_type                          = '';
    var $engine_type                        = '';
    var $dealer_id                          = '';
    




	var $table_name					        =	'applications';
	var $table_name_exclusions		        =	'dealer_quote_exclusions';	

function save(){
    
                   
				$sqlarray = array(
				"id"							    =>	$this->id,
                "member_id"						    =>	$this->member_id,
				"application_type"				    =>	$this->application_type,
				"best_time"			                =>	$this->best_time,
                "customer_comments"			        =>	$this->customer_comments,
                "completed"			                =>	$this->completed,
                "dealclosed"			            =>	$this->dealclosed,
                "vehicle_color"                     =>  $this->vehicle_color,
                "vehicle_year_min"                  =>  $this->vehicle_year_min,
                "vehicle_year_max"                  =>  $this->vehicle_year_max,
                "vehicle_transmission"              =>  $this->vehicle_transmission,
                "vehicle_make"                      => $this->vehicle_make,
                "vehicle_model"                     => $this->vehicle_model,
                "vehicle_max_price"                 => $this->vehicle_max_price,
                "vehicle_max_miles"                 => $this->vehicle_max_miles,
                "vehicle_category "                 => $this->vehicle_category ,
                "vehicle_body_type"                 => $this->vehicle_body_type,
                "payment_method"                    => $this->payment_method,
                "date_submitted"                    => $this->date_submitted,
                "preferred_contact_method"          => $this->preferred_contact_method,
                "radius"                            => $this->radius,
                "fuel_type"                         => $this->fuel_type,
                "engine_type"                       => $this->engine_type,




                
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
            $this->member_id					    = isset($sqlarray['member_id'])					        ?$sqlarray['member_id']:'';
			$this->application_type 				= isset($sqlarray['application_type'])				    ?$sqlarray['application_type']:'';
            $this->best_time 				        = isset($sqlarray['best_time'])		                    ?$sqlarray['best_time']:'';
            $this->customer_comments 				= isset($sqlarray['customer_comments'])		            ?$sqlarray['customer_comments']:'';
            $this->completed 				        = isset($sqlarray['completed'])		                    ?$sqlarray['completed']:'';
            $this->dealclosed 				        = isset($sqlarray['dealclosed'])		                ?$sqlarray['dealclosed']:'';
			$this->vehicle_color                    = isset($sqlarray['vehicle_color'])                     ?$sqlarray['vehicle_color']:'';
            $this->vehicle_year_min                 = isset($sqlarray['vehicle_year_min'])                  ?$sqlarray['vehicle_year_min']:'';
            $this->vehicle_year_max                 = isset($sqlarray['vehicle_year_max'])                  ?$sqlarray['vehicle_year_max']:'';
            $this->vehicle_transmission             = isset($sqlarray['vehicle_transmission'])              ?$sqlarray['vehicle_transmission']:'';
            $this->vehicle_make                     = isset($sqlarray['vehicle_make'])                      ?$sqlarray['vehicle_make']:'';
            $this->vehicle_model                    = isset($sqlarray['vehicle_model'])                     ?$sqlarray['vehicle_model']:'';
            $this->vehicle_max_price                = isset($sqlarray['vehicle_max_price'])                 ?$sqlarray['vehicle_max_price']:'';
            $this->vehicle_max_miles                = isset($sqlarray['vehicle_max_miles'])                 ?$sqlarray['vehicle_max_miles']:'';
            $this->vehicle_category                 = isset($sqlarray['vehicle_category '])                 ?$sqlarray['vehicle_category ']:'';
            $this->vehicle_body_type                = isset($sqlarray['vehicle_body_type'])                 ?$sqlarray['vehicle_body_type']:'';
            $this->payment_method                   = isset($sqlarray['payment_method'])                    ?$sqlarray['payment_method']:'';
            $this->date_submitted                   = isset($sqlarray['date_submitted'])                    ?$sqlarray['date_submitted']:'';
            $this->password                         = isset($sqlarray['password'])                          ?$sqlarray['password']:'';
            $this->preferred_contact_method         = isset($sqlarray['preferred_contact_method'])          ?$sqlarray['preferred_contact_method']:'';
            $this->radius                           = isset($sqlarray['radius'])                            ?$sqlarray['radius']:'';
            $this->fuel_type                        = isset($sqlarray['fuel_type'])                         ?$sqlarray['fuel_type']:'';
            $this->engine_type                      = isset($sqlarray['engine_type'])                       ?$sqlarray['engine_type']:'';
            


		}
}


function getlist($options=''){
    
    
            $payment_method =       (!empty($options['payment_method']))? " where payment_method='".$options['payment_method']."' "	: '';
            
			$page			=		(!empty($options['page']))			? $options['page'] 				: '1';
			$rows			=		(!empty($options['rows_per_page']))	? $options['rows_per_page'] 	: '10';
			$order_by		=		(!empty($options['order_by']))		? $options['order_by'] 			: 'date_submitted';
			$sort_direction	=		(!empty($options['sort_direction']))? $options['sort_direction'] 	: 'desc';
			$end 			= 		$rows*($page-1);
        	$limit 			= 		" limit $end,$rows";
			$query			=		" select * from {$this->table_name} $payment_method order by $order_by $sort_direction";
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
	
function getlistByMember($options,$memberID){
    
      
    $sqlsetting="select value  from c_settings where unique_name='days_before_expiry'";
    
    $row = tep_db_result_row($sqlsetting);
		$days_before_expiry=$row[0];
	
			$page			=		(!empty($options['page']))			? $options['page'] 				: '1';
			$rows			=		(!empty($options['rows_per_page']))	? $options['rows_per_page'] 	: '10';
			$order_by		=		(!empty($options['order_by']))		? $options['order_by'] 			: 'id';
			$sort_direction	=		(!empty($options['sort_direction']))? $options['sort_direction'] 	: 'desc';
			$end 			= 		$rows*($page-1);
        	$limit 			= 		" limit $end,$rows";
			$query			=		" select * from {$this->table_name} where member_id='$memberID' AND DATEDIFF(CURDATE(),date_submitted)<'$days_before_expiry' order by $order_by $sort_direction";
            
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
    
    
}

function appHasCreditInfo($member_id,$vehicle_id){
    
    $query="select member_id from broker_quotes where member_id = '$member_id' AND vehicle_id = '$vehicle_id'";
  		$query_sql				=	tep_db_query($query);
		$num_rows 				=	tep_db_num_rows($query_sql);
		if($num_rows>0){
				return true;
		}else{  
		return false;
        }
}

function getlistDealer($options='',$dealer_id){
    
    
    $sqlDealer="select * from dealers where id='$dealer_id' ";
    $queryDealer_sql		=		tep_db_query($sqlDealer);
			$num_rows 		= 		tep_db_num_rows($queryDealer_sql);
		    
		if($num_rows>0)	{
			    
				$result = array();
				$resultDealer=tep_db_fetch_array($queryDealer_sql);
                $lat=$resultDealer['latitude'];
                $long=$resultDealer['longitude'];
    }else{
        return "empty";
    }    
    

            $payment_method =       (!empty($options['payment_method']))? " where payment_method='".$options['payment_method']."' "	: '';
            
			$page			=		(!empty($options['page']))			? $options['page'] 				: '1';
			$rows			=		(!empty($options['rows_per_page']))	? $options['rows_per_page'] 	: '10';
			$order_by		=		(!empty($options['order_by']))		? $options['order_by'] 			: 'date_submitted';
			$sort_direction	=		(!empty($options['sort_direction']))? $options['sort_direction'] 	: 'desc';
			$end 			= 		$rows*($page-1);
        	$limit 			= 		" limit $end,$rows";
			//$query			=		" select a.* from {$this->table_name} as a, m WHERE NOT EXISTS(SELECT * from {$this->table_name_exclusions} as e where e.dealer_id=$dealer_id AND e.vehicle_id = a.id) $payment_method order by $order_by $sort_direction";
          
          /*  $query			=		" select a.*, m.latitude, m.longitude from {$this->table_name} as a, members as m WHERE a.member_id = m.id AND NOT EXISTS(SELECT * from {$this->table_name_exclusions} as e where e.dealer_id=$dealer_id AND e.vehicle_id = a.id) $payment_method order by $order_by $sort_direction";
          */
            
            
                 $query			=		" select a.*, m.latitude, m.longitude from {$this->table_name} as a, members as m WHERE a.member_id = m.id AND NOT EXISTS(SELECT * from {$this->table_name_exclusions} as e where e.dealer_id=$dealer_id AND e.vehicle_id = a.id) $payment_method  order by a.$order_by $sort_direction ";  


/*
           AND (
6371 * acos (
cos ( radians($lat) )
* cos( radians( m.latitude ) )
* cos( radians( m.longitude ) - radians($long) )
+ sin ( radians($lat) )
* sin( radians( m.latitude ) )
))<= radius
          
   */         
            
          
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

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 function sendNewAppEmail($options){
	 
        $apps 		= $options['apps'];
		$member 	= $options['member'];
	 	$mail		= $options['mail']; // phpMailer Object;
        
        
        $bad=array("$",",","_");
          $apps->vehicle_max_price=str_replace($bad,"",$apps->vehicle_max_price);
          $apps->vehicle_make==str_replace($bad,"",$apps->vehicle_make);
          $apps->vehicle_model==str_replace($bad,"",$apps->vehicle_model);
          
          
          
        
$email_to_dealer="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html>
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
    <title>Carleado Lead</title>
    <style>
        /* A simple css reset */
        body,table,thead,tbody,tr,td,img {
            padding: 0;
            margin: 0;
            border: none;
            border-spacing: 0px;
            border-collapse: collapse;
            vertical-align: top;
        }
        /* Add some padding for small screens */
        .wrapper {
            padding-left: 10px;
            padding-right: 10px;
        }
        h1,h2,h3,h4,h5,h6,p {
            margin: 0;
            padding: 0;
            padding-bottom: 20px;
            line-height: 1.6;
            font-family: 'Helvetica', 'Arial', sans-serif;
        }
        .lowerImage{
            border:1px solid #ccc;
        }
        p,a,li {
            font-family: 'Helvetica', 'Arial', sans-serif;
        }
        img {
            display: block;
        }
        .fullwidth{
            width:100%;
        }
        @media only screen and (max-width: 620px) {
            .wrapper .section {
                width: 100%;
            }
            .wrapper .column {
                width: 100%;
                display: block;
            }
        }
    </style>
</head>
<body>
    <table width=\"100%\">
        <tbody>
            <tr>
                <td class=\"wrapper\" width=\"640\" align=\"center\">
                    <!-- Header image -->
                    <table class=\"section header\" cellpadding=\"0\" cellspacing=\"0\" width=\"640\">
                        <tr>
                            <td class=\"column\">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td align=\"left\">
                                                <img src=\"https://www.carleado.com/images/logo-carleado.png\" alt=\"carleado\"  /><br />
                                                <h2>We Have Received A New Quote Request</h2>
                                                <p>A Carleado buyer has requested quotes for a vehicle.</p><p>They are looking for a <br /><strong>";
                                                
                  if($apps->vehicle_make) {
                    
                    $email_to_dealer.=no_($apps->vehicle_make)." ".no_($apps->vehicle_model)." </strong>"; 
                    
                  }else{
                    
                    $email_to_dealer.=no_($apps->vehicle_body_type)."</strong> and didn't specify a brand preference. "; 
                    
                  }                             
                                                
       
                                                
                             $email_to_dealer.="<br />They have requested quotes up to <strong>$".number_format($apps->vehicle_max_price,2)."</strong> for a vehicle with less than <strong>".number_format($apps->vehicle_max_miles,0)." km.</strong></p>
                             
                             <p>You can quote on this request by logging into our website at <a href='https://carleado.com/admin/login_dealer.php'>https://carleado.com/admin/login_dealer.php</a> and choosing Available Leads -> Vehicle Quote Requests from the menu.   </p>
		 
		
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- Two columns -->
                    <table class=\"section\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                            <td class=\"column\" width=\"290\" valign=\"top\">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td align=\"left\">
                                                <img src=\"https://carleado.com/images/arrange-time-to-view.png\" style=\"border:1px solid #ccc;\" />
                                                <h2>What's Next?</h2>
                                                <p>This buyer is very interested in obtaining this vehicle, or an equivalent vehicle.<br /> We recommend that you issue a quote as soon as possible. Often the first quotes received get the most attention. Remember you are not charged to quote. You are only charged if the buyer shortlists your offer. Good&nbsp;Luck!</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class=\"column\" width=\"20\" valign=\"top\">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td> &nbsp; </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class=\"column\" width=\"290\" valign=\"top\">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td align=\"left\">
                                                <img src=\"https://carleado.com/images/Send-your-offer.png\" class=\"lowerImage\"  style=\"border:1px solid #ccc;\" />
                                                <h2>Credit Information</h2>
                                                <p>Many Carleado buyers leave credit details. You can visit our dealer admin website at <a href=\"https://carleado.com/admin/login_dealer.php\" rel=\"nofollow\">https://carleado.com</a> to see if this customer has entered credit information. Once the buyer has shortlisted your offer, we show you any credit information available.</p><p></p>
                                            </td>
                                        </tr>
                                        
                                       
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        
                         
                    </table>
                </td>
            </tr>
            <tr><td colspan='2'><br />
            
            <p>
            To ensure that you receive emails in your inbox, add info@carleado.com to your contact list. If our email is found in your spam folder, please mark it as \"Not Spam\". This email account is not monitored. Please do not reply to this email.
            </p>
                                       <p> In accordance with CASL rules this email was sent to you by Carleado.com, #200 - 10388 Whalley Boulevard, Surrey, BC V3T 4H4 with your consent. You may unsubscribe by replying to this email with the word UNSUBSCRIBE as the subject. </p>                                        </td></tr>
        </tbody>
    </table>
</body>
</html>";
         
         
         
         
		$subject_for_dealer	=	"New Quote Request from Carleado";
		$to		=	$dealers->email;
		$from	=	"info@carleado.com";
		$headers = "From: " . strip_tags($from) . "\r\n";
		$headers .= "Reply-To: $from\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	 
	 
	 
	  try { 
		  
            $mail->setFrom("info@carleado.com", 'Carleado.com');     
            $mail->isHTML(true);
		   	$mail->Subject = 'New Quote Request from Carleado';
            $mail->Body    = $email_to_dealer;
            $mail->AltBody = strip_tags($email_to_dealer);
		  
		  	// don't process email if Latitude / Longitude OR Radius is EMPTY 
		  	if( empty($member->latitude) ||  empty($member->longitude) || empty($apps->radius) ) {
				return false;
			}
	
		  
		  	$query			=	" select email,first_name,last_name from dealers where (
								6371 * acos (
								cos ( radians(latitude) )
								* cos( radians( $member->latitude ) )
								* cos( radians( $member->longitude ) - radians(longitude) )
								+ sin ( radians(latitude) )
								* sin( radians( $member->latitude ) )
								))<= $apps->radius  ";  
	 
	 

           	$query_sql		=		tep_db_query($query);
			$num_rows 		= 		tep_db_num_rows($query_sql);
		    
			if($num_rows>0)	{


				while($row=tep_db_fetch_array($query_sql)){

					// $to		=	$row['email'];
					
					// $mail->addAddress($row['email'], "{$row['first_name']} {$row['last_name']}"); 
					
					$mail->AddBCC($row['email'], "{$row['first_name']} {$row['last_name']}"); 
					
					///mail($to, $subject_for_dealer, $email_to_dealer, $headers);    

				} 

			}
		  
		  	
          
            $mail->send();

          	return true;
           
        } catch (Exception $e) {
            //echo 'Message could not be sent.';
           // echo 'Mailer Error: ' . $mail->ErrorInfo;
		  
		  	return false;
        }
	 
        
    }
	
	
	
	function getActiveMakes($list) {
		
		$data = array();
		
		foreach($list as $make) {
			
			if($make == "") continue;
			
			$data[] = $make['vehicle_make'];
		}
		
		$data = array_unique($data);
		
		return $data;
		
	} 




############### END OF CLASS DEFINITION #######################################
}
?>