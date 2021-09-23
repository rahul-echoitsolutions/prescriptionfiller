<?php
class transactions {
	var $transaction_id     = 0;
    var $cc_cvc             = '';
	var $cc_expiry			= '';
	var $cc_last_4digits  	= '';
	var $created			= '';
	var $status				= '';
  	var $amount				= '';
	var $dealer_id			= '';
	var $vehicle_id			= '';
	var $shortlist_id		= '';
	var $member_id			= '';
	var $jsonResponse		= '';
	var $stripeStatusCode	= '';
	var $stripeTransactionID= '';
	var $table_name 		= 'transactions';

	function save(){
		$sqlarray = array(
                "cc_expiry"		   		 =>	$this->cc_expiry,
                "cc_cvc"                 => $this->cc_cvc,
                "created"	        	 =>	$this->created,
                "status"		       	 =>	$this->status,
                "cc_last_4digits"	     =>	$this->cc_last_4digits,
                "shortlist_id"		     =>	$this->shortlist_id,
                "dealer_id"		         =>	$this->dealer_id,
                "amount"			     =>	$this->amount,
				"vehicle_id"			 => $this->vehicle_id,
				"member_id"			 	 => $this->member_id,
				"jsonResponse"			 =>	$this->jsonResponse,
				"stripeStatusCode"		 =>	$this->stripeStatusCode,
				"stripeTransactionID"	 =>	$this->stripeTransactionID,
		);
		if($this->transaction_id>0) { 
			tep_db_perform($this->table_name,$sqlarray,'update',' transaction_id="' . $this->transaction_id . '"'); 
		}
		else {
			tep_db_perform($this->table_name,$sqlarray);
			$this->transaction_id = tep_db_insert_id();
		}
	}
	function delete($transaction_id){
		$query = "delete from {$this->table_name}  where transaction_id='$transaction_id';";
		tep_db_query($query);
	}
	function load($transaction_id){
		$sql 			= "select * from {$this->table_name}  where transaction_id='$transaction_id'";
		$sqlresult 		= tep_db_query($sql);
		$sqlarray 		= tep_db_fetch_array($sqlresult);
		if($sqlarray){
			$stid							= "stripeTransactionID";
			$this->transaction_id			= isset($sqlarray['transaction_id'])?$sqlarray['transaction_id']:0;
            $this->cc_cvc                 	= isset($sqlarray['cc_cvc'])?$sqlarray['cc_cvc']:0;
			$this->cc_expiry 	    		= isset($sqlarray['cc_expiry'])?$sqlarray['cc_expiry']:'';
			$this->created 	    			= isset($sqlarray['created'])?$sqlarray['created']:'';
			$this->status 		    		= isset($sqlarray['status'])?$sqlarray['status']:'';
			$this->cc_last_4digits    		= isset($sqlarray['cc_last_4digits'])?$sqlarray['cc_last_4digits']:'';
			$this->amount 	    			= isset($sqlarray['amount'])?$sqlarray['amount']:'';
			$this->dealer_id 	    		= isset($sqlarray['dealer_id'])?$sqlarray['dealer_id']:'';
			$this->shortlist_id      		= isset($sqlarray['shortlist_id'])?$sqlarray['shortlist_id']:'';
			$this->jsonResponse      		= isset($sqlarray['jsonResponse'])?$sqlarray['jsonResponse']:'';
			$this->stripeStatusCode			= isset($sqlarray['stripeStatusCode'])?$sqlarray['stripeStatusCode']:'';
			$this->stripeTransactionID 		= isset($sqlarray[$stid])?$sqlarray[$stid]:'';
			$this->vehicle_id 				= isset($sqlarray['vehicle_id'])?$sqlarray['vehicle_id']:'';
			$this->member_id 				= isset($sqlarray['member_id'])?$sqlarray['member_id']:'';
		}
	}
	function getlist($options){
		
		$subquery 		= array();
		$substatement 	= "";
		
		if(isset($options['dealer_id'])) {
			$subquery[] = " dealer_id = {$options['dealer_id']}";
		}
		
		if(isset($options['member_id'])) {
			$subquery[] = " member_id = {$options['member_id']}";
		}
		
		if(isset($options['vehicle_id'])) {
			$subquery[] = " vehicle_id = {$options['vehicle_id']}";
		}
		
		if(count($subquery) >0 ) {
			$substatement = " where ".implode(" and ",$subquery);
		}
        
		
	   	$query 		=	"select * from {$this->table_name}  $substatement order by transaction_id desc";
       
		$query_sql	=	tep_db_query($query);
		$rowscount	=	tep_db_num_rows($query_sql);
		$result = array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}
	
	function sendNewFreePointsLeadEmail($options) {
	
		$quote 		= $options['quote'];
		$member 	= $options['member'];
		$settings 	= $options['settings'];
		$dealers 	= $options['dealers'];
		$pointscost = $options['pointscost'];
		$pointsleft = $options['pointsleft']>0?$options['pointsleft']:0;
        
        $bad=array("$",",");
          $quote->vehicle_price=str_replace($bad,"",$quote->vehicle_price);
        
$email_to_dealer="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html>
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
    <title>".SITE_TITLE." Lead</title>
    <style>
       
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
                                                <img src=\"https://".SITE_URL."/images/logo-carleado.png\" alt=\"carleado\"  /><br />
                                                <h2>Your Offer Has Been Shortlisted</h2>
                                                <p>A Carleado customer has Shortlisted your quote.</p><p><strong>$member->first_name $member->last_name</strong> has Shortlisted your quote for your vehicle:<br /><strong> $quote->vehicle_color $quote->vehicle_year $quote->vehicle_make ".no_($quote->vehicle_model)." </strong><br />which you quoted on ".date("F j, Y",strtotime($quote->date_submitted))." at <strong>$".number_format($quote->vehicle_price,2)."</strong></p><p>You can reach <strong>$member->first_name $member->last_name </strong>at <strong>$member->home_phone</strong> or by email at <a href=\"mailto:$member->email\"><strong>$member->email</strong></a></p>";
		
         if($quote->preferred_contact_method){
            $email_to_dealer.="<p>The buyer prefers to be contacted by $quote->preferred_contact_method and stated that the preferred time to contact them was $quote->best_time.";
 }
         
          if($quote->coupon){
			$email_to_dealer.="<p>You offered this customer a coupon with the description or value of: $quote->coupon</p>";
		 } 
         
         
         
		 $email_to_dealer.="The Free Lead cost of {$pointscost} points was deducted from your \"Carleado Coins\" account and your account now has {$pointsleft} points remaining. Your credit card was not charged for this lead.<p>The Carleado Team
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
                                                <p><strong>$member->first_name $member->last_name</strong>  has seen your offer and shortlisted it. $member->first_name is very interested.<br /> We recommend that you make contact as soon as possible. We include both their phone and email contact information. Good&nbsp;Luck!</p>
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
                                                <p>Many Carleado buyers leave credit details. You can visit our dealer admin website at <a href=\"https://carleado.com/admin/login_dealer.php\" rel=\"nofollow\">https://carleado.com</a> to see if this customer has entered credit information. Click on the green \"YES\" link to see any credit information available.</p><p></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>";
         
         
		$subject_for_dealer	=	"New Free Lead from Carleado";
		$to		=	$dealers->email;
		$from	=	"info@carleado.com";
		$headers = "From: " . strip_tags($from) . "\r\n";
		$headers .= "Reply-To: $from\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		mail($to, $subject_for_dealer, $email_to_dealer, $headers);    
		
	}
	
	
	function sendNewLeadEmail($options) {
		$quote 		= $options['quote'];
		$member 	= $options['member'];
		$settings 	= $options['settings'];
		$dealers 	= $options['dealers'];
        
        $bad=array("$",",");
          $quote->vehicle_price=str_replace($bad,"",$quote->vehicle_price);
        
$email_to_dealer="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html>
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
    <title>Carleado New Lead</title>

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
                                                <h2>Your Offer Has Been Shortlisted</h2>
                                                <p>A Carleado customer has Shortlisted your quote.</p><p><strong>$member->first_name $member->last_name</strong> has Shortlisted your quote for your vehicle:<br /><strong> $quote->vehicle_color $quote->vehicle_year $quote->vehicle_make ".no_($quote->vehicle_model)." </strong><br />which you quoted on ".date("F j, Y",strtotime($quote->date_submitted))." at <strong>$".number_format($quote->vehicle_price,2)."</strong></p><p>You can reach <strong>$member->first_name $member->last_name </strong>at <strong>$member->home_phone</strong> or by email at <a href=\"mailto:$member->email\"><strong>$member->email</strong></a></p>";
		 if($quote->coupon){
			$email_to_dealer.="<p>You offered this customer a coupon with the description or value of: $quote->coupon</p>";
		 } 
		 $email_to_dealer.="Your account has been charged $".number_format($settings->get_value("cost_per_lead"),2)." for this lead<p>The Carleado Team
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
                                                <p><strong>$member->first_name $member->last_name</strong>  has seen your offer and shortlisted it. $member->first_name is very interested.<br /> We recommend that you make contact as soon as possible. We include both their phone and email contact information. Good&nbsp;Luck!</p>
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
                                                <p>Many Carleado buyers leave credit details. You can visit our dealer admin website at <a href=\"https://carleado.com/admin/login_dealer.php\" rel=\"nofollow\">https://carleado.com</a> to see if this customer has entered credit information. Click on the green \"YES\" link to see any credit information available.</p><p></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>";
         
         
		$subject_for_dealer	=	"New Lead from Carleado";
		$to		=	$dealers->email;
		$from	=	"info@carleado.com";
		$headers = "From: " . strip_tags($from) . "\r\n";
		$headers .= "Reply-To: $from\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		mail($to, $subject_for_dealer, $email_to_dealer, $headers);    
	}
	######################### EOCD #########################################################
}
?>