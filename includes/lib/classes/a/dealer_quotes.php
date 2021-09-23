<?php
class quotes	{
	var $id        						    =	'';
    var $member_id      				    =	'';
	var $dealer_id                 			=	'';
    var $vehicle_id                         =   '';
    var	$completed                          =	'';
    var	$dealclosed                         =	'';
    var $vehicle_color                      =   '';
    var $vehicle_year                       =   '';
    var $vehicle_year_max                   =   '';
    var $vehicle_transmission               =   '';
    var $vehicle_make                       =   '';
    var $vehicle_model                      =   '';
    var $vehicle_price                      =   '';
    var $vehicle_extra_fees                 =   '';
    var $vehicle_miles                      =   '';
    var $vehicle_category                   =   '';
    var $vehicle_body_type                  =   '';
    var $payment_method                     =   '';
    var $date_submitted                     =   '';
    var $coupon                             =   '';
    var $radius                             =   '';
    var $fuel_type                          =   '';
    var $engine_type                        =   '';
	var $engine_size						=	'';
	var $vehicle_status						=	'';
    var $dealer_comments                    =   '';
	var $view_status						=	0;	
	var $view_date							=	'';
	var $vehicle_image_thumbnail			=	'';
	var $vehicle_image_big_image			=	'';
	var $vehicle_image_title				=	'';
	var $vehicle_image_description			=	'';
	
    var $table_name_ratings                 =   'ratings';
	var $table_name					        =	'dealer_quotes';
    var $table_name_exclude                 =   'dealer_quote_exclusions';
    
function save(){
                $this->date_submitted		=	date("Y-m-d");
				$sqlarray = array(
				"id"							    =>	$this->id,
                "member_id"						    =>	$this->member_id,
				"dealer_id"     				    =>	$this->dealer_id,
				"vehicle_id"		                =>	$this->vehicle_id,
                "dealer_comments"			        =>	$this->dealer_comments,
                "completed"			                =>	$this->completed,
                "dealclosed"			            =>	$this->dealclosed,
                "vehicle_color"                     =>  $this->vehicle_color,
                "vehicle_year"                      =>  $this->vehicle_year,
                "vehicle_year_max"                  =>  $this->vehicle_year_max,
                "vehicle_transmission"              =>  $this->vehicle_transmission,
                "vehicle_make"                      => $this->vehicle_make,
                "vehicle_model"                     => $this->vehicle_model,
                "vehicle_price"                     => $this->vehicle_price,
                "vehicle_extra_fees"                => $this->vehicle_extra_fees,
                "vehicle_miles"                     => $this->vehicle_miles,
                "vehicle_category "                 => $this->vehicle_category ,
                "vehicle_body_type"                 => $this->vehicle_body_type,
                "payment_method"                    => $this->payment_method,
                "date_submitted"                    => $this->date_submitted,
                "coupon"                            => $this->coupon,
                "radius"                            => $this->radius,
                "fuel_type"                         => $this->fuel_type,
                "engine_type"                       => $this->engine_type,
				"engine_size"                       => $this->engine_size,
				"vehicle_status"                    => $this->vehicle_status,
				"view_status"			            =>	$this->view_status,
				"view_date"			            	=>	$this->view_date,		
				);
		if($this->id>0)	tep_db_perform($this->table_name,$sqlarray,'update',' id="' . $this->id . '"');
		else {
			tep_db_perform($this->table_name,$sqlarray);
			$this->id=tep_db_insert_id();
            
            
            
		}
}



function saveExclude(){
               
				$sqlarray = array(
				"id"							    =>	$this->id,
                "dealer_id"						    =>	$this->dealer_id,
				"vehicle_id"    				    =>	$this->vehicle_id,
                );
               

			tep_db_perform($this->table_name_exclude,$sqlarray);
			$this->id=tep_db_insert_id();
		}









function saveRating(){
                $this->date_submitted=date("Y-m-d H:i:s");
				$sqlarray = array(
				"id"							    =>	$this->id,
                "member_id"						    =>	$this->member_id,
				"vehicle_id"    				    =>	$this->vehicle_id,
                "dealer_id"     				    =>	$this->dealer_id,
				"rating"			                =>	$this->rating,
                "date_entered"                      =>	$this->date_submitted,
				);
                // find if this rating is already in the database.
                $sql2="select id from $this->table_name_ratings where member_id=$this->member_id AND  vehicle_id=$this->vehicle_id AND dealer_id=$this->dealer_id";
                	$result2 		= 	tep_db_query($sql2);
                    $array2 		= 	tep_db_fetch_array($result2);
		if($array2['id']>0){	
		  $sql4="update $this->table_name_ratings set rating=$this->rating where id=".$array2['id'];
          	$result4 		= 	tep_db_query($sql4);
		}else {
			tep_db_perform($this->table_name_ratings,$sqlarray);
			$this->id=tep_db_insert_id();
		}
}
function isSelectedRating($member_id, $vehicle_id, $dealer_id){
$sql2="select * from $this->table_name_ratings where member_id=$member_id AND  vehicle_id=$vehicle_id AND dealer_id=$dealer_id";
                	$sqlresult2 		= 	tep_db_query($sql2);
                    $sqlarray2 		= 	tep_db_fetch_array($sqlresult2);
return $sqlarray2['rating'];
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
			$this->dealer_id          				= isset($sqlarray['dealer_id'])        				    ?$sqlarray['dealer_id']:'';
            $this->vehicle_id 				        = isset($sqlarray['vehicle_id'])		                ?$sqlarray['vehicle_id']:'';
            $this->dealer_comments   				= isset($sqlarray['dealer_comments'])		            ?$sqlarray['dealer_comments']:'';
            $this->completed 				        = isset($sqlarray['completed'])		                    ?$sqlarray['completed']:'';
            $this->dealclosed 				        = isset($sqlarray['dealclosed'])		                ?$sqlarray['dealclosed']:'';
			$this->vehicle_color                    = isset($sqlarray['vehicle_color'])                     ?$sqlarray['vehicle_color']:'';
            $this->vehicle_year                     = isset($sqlarray['vehicle_year'])                      ?$sqlarray['vehicle_year']:'';
            $this->vehicle_year_max                 = isset($sqlarray['vehicle_year_max'])                  ?$sqlarray['vehicle_year_max']:'';
            $this->vehicle_transmission             = isset($sqlarray['vehicle_transmission'])              ?$sqlarray['vehicle_transmission']:'';
            $this->vehicle_make                     = isset($sqlarray['vehicle_make'])                      ?$sqlarray['vehicle_make']:'';
            $this->vehicle_model                    = isset($sqlarray['vehicle_model'])                     ?$sqlarray['vehicle_model']:'';
            $this->vehicle_price                    = isset($sqlarray['vehicle_price'])                     ?$sqlarray['vehicle_price']:'';
            $this->vehicle_extra_fees               = isset($sqlarray['vehicle_extra_fees'])                ?$sqlarray['vehicle_extra_fees']:'';
            $this->vehicle_miles                    = isset($sqlarray['vehicle_miles'])                     ?$sqlarray['vehicle_miles']:'';
            $this->vehicle_category                 = isset($sqlarray['vehicle_category '])                 ?$sqlarray['vehicle_category ']:'';
            $this->vehicle_body_type                = isset($sqlarray['vehicle_body_type'])                 ?$sqlarray['vehicle_body_type']:'';
            $this->payment_method                   = isset($sqlarray['payment_method'])                    ?$sqlarray['payment_method']:'';
            $this->date_submitted                   = isset($sqlarray['date_submitted'])                    ?$sqlarray['date_submitted']:'';
            $this->password                         = isset($sqlarray['password'])                          ?$sqlarray['password']:'';
            $this->coupon                           = isset($sqlarray['coupon'])                            ?$sqlarray['coupon']:'';
            $this->radius                           = isset($sqlarray['radius'])                            ?$sqlarray['radius']:'';
            $this->fuel_type                        = isset($sqlarray['fuel_type'])                         ?$sqlarray['fuel_type']:'';
            $this->engine_type                      = isset($sqlarray['engine_type'])                       ?$sqlarray['engine_type']:'';
			$this->engine_size                      = isset($sqlarray['engine_size'])                      	?$sqlarray['engine_size']:'';
			$this->vehicle_status                   = isset($sqlarray['vehicle_status'])              		?
			$sqlarray['vehicle_status']:'';
			$this->view_status 				        = isset($sqlarray['view_status'])		                ?$sqlarray['view_status']:'';
            $this->view_date 				        = isset($sqlarray['view_date'])		                	?$sqlarray['view_date']:'';
		}
}
function loadDealer($vehicle_id,$dealer_id){
		$sql 			= 	"select * from {$this->table_name}  where vehicle_id='$vehicle_id' AND dealer_id='$dealer_id' ";
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);
		if($sqlarray){
			$this->id 							    = isset($sqlarray['id'])						        ?$sqlarray['id']:'';
            $this->member_id					    = isset($sqlarray['member_id'])					        ?$sqlarray['member_id']:'';
			$this->dealer_id          				= isset($sqlarray['dealer_id'])        				    ?$sqlarray['dealer_id']:'';
            $this->vehicle_id 				        = isset($sqlarray['vehicle_id'])		                ?$sqlarray['vehicle_id']:'';
            $this->dealer_comments   				= isset($sqlarray['dealer_comments'])		            ?$sqlarray['dealer_comments']:'';
            $this->completed 				        = isset($sqlarray['completed'])		                    ?$sqlarray['completed']:'';
            $this->dealclosed 				        = isset($sqlarray['dealclosed'])		                ?$sqlarray['dealclosed']:'';
			$this->vehicle_color                    = isset($sqlarray['vehicle_color'])                     ?$sqlarray['vehicle_color']:'';
            $this->vehicle_year                     = isset($sqlarray['vehicle_year'])                      ?$sqlarray['vehicle_year']:'';
            $this->vehicle_year_max                 = isset($sqlarray['vehicle_year_max'])                  ?$sqlarray['vehicle_year_max']:'';
            $this->vehicle_transmission             = isset($sqlarray['vehicle_transmission'])              ?$sqlarray['vehicle_transmission']:'';
            $this->vehicle_make                     = isset($sqlarray['vehicle_make'])                      ?$sqlarray['vehicle_make']:'';
            $this->vehicle_model                    = isset($sqlarray['vehicle_model'])                     ?$sqlarray['vehicle_model']:'';
            $this->vehicle_price                    = isset($sqlarray['vehicle_price'])                     ?$sqlarray['vehicle_price']:'';
            $this->vehicle_extra_fees               = isset($sqlarray['vehicle_extra_fees'])                ?$sqlarray['vehicle_extra_fees']:'';
            $this->vehicle_miles                    = isset($sqlarray['vehicle_miles'])                     ?$sqlarray['vehicle_miles']:'';
            $this->vehicle_category                 = isset($sqlarray['vehicle_category '])                 ?$sqlarray['vehicle_category ']:'';
            $this->vehicle_body_type                = isset($sqlarray['vehicle_body_type'])                 ?$sqlarray['vehicle_body_type']:'';
            $this->payment_method                   = isset($sqlarray['payment_method'])                    ?$sqlarray['payment_method']:'';
            $this->date_submitted                   = isset($sqlarray['date_submitted'])                    ?$sqlarray['date_submitted']:'';
            $this->password                         = isset($sqlarray['password'])                          ?$sqlarray['password']:'';
            $this->coupon                           = isset($sqlarray['coupon'])                            ?$sqlarray['coupon']:'';
            $this->radius                           = isset($sqlarray['radius'])                            ?$sqlarray['radius']:'';
            $this->fuel_type                        = isset($sqlarray['fuel_type'])                         ?$sqlarray['fuel_type']:'';
            $this->engine_type                      = isset($sqlarray['engine_type'])                       ?$sqlarray['engine_type']:'';
		}
}
function loadByVehicleID($vehicle_id,$dealer_id){
		$sql 			= 	"select id from {$this->table_name}  where vehicle_id=$vehicle_id AND dealer_id=$dealer_id";
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);
	
		if($sqlarray['id'] > 0) $this->load($sqlarray['id']);
		return;
		
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
function getlistByMember($options,$memberID){
			$page			=		(!empty($options['page']))			? $options['page'] 				: '1';
			$rows			=		(!empty($options['rows_per_page']))	? $options['rows_per_page'] 	: '10';
			$order_by		=		(!empty($options['order_by']))		? $options['order_by'] 			: 'id';
			$sort_direction	=		(!empty($options['sort_direction']))? $options['sort_direction'] 	: 'desc';
			$end 			= 		$rows*($page-1);
        	$limit 			= 		" limit $end,$rows";
			$query			=		" select * from {$this->table_name} where member_id='$memberID' order by $order_by $sort_direction";
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

function getCountByMember($memberID){
			
		$query			=		"select count(id) as total from {$this->table_name} where member_id='$memberID'";
		$query_sql		=		tep_db_query($query);
		$sqlarray 		= 		tep_db_fetch_array($query_sql);
	
		return $sqlarray['total'];
		
}
	
function getUnreadCountByMember($memberID){
			
		$query			=		"select count(id) as total from {$this->table_name} where member_id='$memberID' and view_status=0";  

		$query_sql		=		tep_db_query($query); 
		
		$sqlarray 		= 		tep_db_fetch_array($query_sql);
	

		return $sqlarray[0];
		
		
}	
function getShortlistByMember($options,$memberID){
    
    
     
    
			$page			=		(!empty($options['page']))			? $options['page'] 				: '1';
			$rows			=		(!empty($options['rows_per_page']))	? $options['rows_per_page'] 	: '10';
			$order_by		=		(!empty($options['order_by']))		? $options['order_by'] 			: 'id';
			$sort_direction	=		(!empty($options['sort_direction']))? $options['sort_direction'] 	: 'desc';
			$end 			= 		$rows*($page-1);
        	$limit 			= 		" limit $end,$rows";
			$query			=		" select * from {$this->table_name} as q, shortlist as s where q.member_id=s.member_id AND q.id = s.quote_id AND q.member_id='$memberID' order by $order_by $sort_direction";
           
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




function getQuoteByAppid($vehicle_id,$dealer_id){
    $sql 			= 	"select vehicle_price from {$this->table_name}  where vehicle_id=$vehicle_id AND dealer_id=$dealer_id";
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);
    return $sqlarray['vehicle_price'];
}
//////////////////  Dealer Images
function getVehicleImagesList($vehicle_id,$dealer_id) {
		$table_vehicle_images	= TABLE_VEHICLE_IMAGES;
		$query 					=	"select * from $table_vehicle_images where vehicle_id = '$vehicle_id' and dealer_id = '$dealer_id' "; 
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
function add_vehicle_images(){
								$sqlarray = array(
								"vehicle_id"			=>	$this->id,
                                "dealer_id" 			=>	$this->dealer_id,
								"thumbnail"				=>	$this->vehicle_image_thumbnail,
								"big_image"				=>	$this->vehicle_image_big_image,
								"title"					=>	$this->vehicle_image_title,
								"description"			=>	$this->vehicle_image_description
								);
				if($this->vehicle_image_id>0)
						tep_db_perform(TABLE_VEHICLE_IMAGES,$sqlarray,'update',' image_id="' . $this->vehicle_image_id . '"');
				else {
						tep_db_perform(TABLE_VEHICLE_IMAGES,$sqlarray);
						$this->vehicle_image_id=tep_db_insert_id();
				}					
}


function update_vehicle_images(){
			$table = TABLE_VEHICLE_IMAGES;
			$query = "update $table set title = '{$this->vehicle_image_title}, description = '{$this->vehicle_image_description}' where vehicle_id = {$this->id}, AND dealer_id = {$this->dealer_id}";
			tep_db_query($query);
}
function load_vehicle_image($id){
		$sql 			= "select * from " . TABLE_VEHICLE_IMAGES. " where image_id=$id"; 
		$sqlresult 		= tep_db_query($sql);
		$sqlarray 		= tep_db_fetch_array($sqlresult);
		if($sqlarray){
			$this->vehicle_image_thumbnail 	= isset($sqlarray['thumbnail'])		?	$sqlarray['thumbnail']		:	0;
			$this->vehicle_image_big_image 	= isset($sqlarray['big_image'])		?	$sqlarray['big_image']		:	'';
			$this->vehicle_image_title 		= isset($sqlarray['title'])			?	$sqlarray['title']			:	'';
			$this->vehicle_image_description 	= isset($sqlarray['description'])	?	$sqlarray['description']	:	'';
		}
}
function delete_vehicle_image($image_id) {
	
	$this->load_vehicle_image($image_id);
	if($this->vehicle_image_thumbnail!='')				unlink("../images/vehicles/".$this->vehicle_image_thumbnail);
	if($this->vehicle_image_big_image!='') 				unlink("../images/vehicles/larger/".$this->vehicle_image_big_image);
	$query = "delete from ". TABLE_VEHICLE_IMAGES." where image_id = $image_id"; 
	tep_db_query($query);
	
}

function quoteCoinCount($dealer_id){
	
    $sql 			= 	"select member_id, dealer_id, vehicle_id from {$this->table_name} where 
   						dealer_id = '$dealer_id' group by member_id, dealer_id, vehicle_id";
	$sqlresult 		= 	tep_db_query($sql);
	$num_rows		=	tep_db_num_rows($sqlresult);
    return $num_rows;
}

function hasQuotes($vehicle_id){
	
	$sql 		= 	"select * from {$this->table_name} where vehicle_id = '$vehicle_id' ";

	$sqlresult 	= 	tep_db_query($sql);
	$num_rows 	=	tep_db_num_rows($sqlresult);
    return $num_rows;
}
	

function updateViewStatus($quoteObj){
			
		$query			=	"update {$this->table_name} set view_status = 1, view_date = now() 
							where  member_id='{$quoteObj->member_id}' and view_status=0 and  
							vehicle_make='{$quoteObj->vehicle_make}' and vehicle_model ='{$quoteObj->vehicle_model}' 
							and vehicle_body_type='{$quoteObj->vehicle_body_type}'"; 
	   

		tep_db_query($query); 		
		
}
	
function getViewStatusMakeModelBodyType($quote_id)	 {

		$this->load($quote_id);
	
		$query			=	"select count(id) as total from {$this->table_name} where view_status = 0 
							and  member_id='{$this->member_id}'  and vehicle_make='{$this->vehicle_make}' and vehicle_model ='{$this->vehicle_model}' and 
							vehicle_body_type='{$this->vehicle_body_type}'"; 
	   
		$query_sql		=		tep_db_query($query);
		$sqlarray 		= 		tep_db_fetch_array($query_sql);
	
		return $sqlarray['total'];
		

}
    
function sendBuyerQuoteNotice($options){
    
    	$dealer_id         =   $options['dealer_id']; 
        $member_id         =   $options['member_id']; 
        $vehicle_make      =   $options['vehicle_make'];
        $vehicle_model     =   $options['vehicle_model']; 
        
        $query = "select * from members where id='$member_id'";
        
        $query_sql		    =		tep_db_query($query);
		$member		        = 		tep_db_fetch_array($query_sql);
	
        $first_name         =  $member['first_name'];
        $last_name          =  $member['last_name'];
        $member_email       =  $member['email'];
        
        $email_to_member="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html>
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
    <title>".SITE_TITLE." Quote Notice</title>
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
                                                <img src=\"https://".SITE_URL."/images/logo-carleado.png\" alt=\"".SITE_TITLE."\"  /><br />
                                                <h2>You Have Received a Quote</h2>
                       <p>Hi $first_name,</p>
                       <p>A dealer has quoted on your request for a $vehicle_make $vehicle_model</p>";
         
		 $email_to_member.="<p>We encourage you to visit your <a href='https://".SITE_URL."' target='_blank'>".SITE_TITLE." Dashboard</a> and sign in to view your new quote. </p>Popular vehicles can sell quickly, and your quote is subject to prior sale.</p><p>&nbsp;</p>
         <p>The ".SITE_TITLE." Team</p><p>&nbsp;</p>
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
                                                <img src=\"https://".SITE_URL."/images/arrange-time-to-view.png\" style=\"border:1px solid #ccc;\" />
                                                <h2>What's Next?</h2>
                                                <p><strong>We recommend that you view this offer as soon as possible. If you like the offer, and shortlist it, you will see the dealer's name and phone number on the quote form. Good&nbsp;Luck!</strong></p><p>&nbsp;</p>
                                            
                                           
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
                            <td class=\"column\" width=\"290\" valign=\"top\"><p>&nbsp;</p>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td align=\"left\">
                                                <img src=\"https://".SITE_URL."/images/Send-your-offer.png\" class=\"lowerImage\"  style=\"border:1px solid #ccc;\" />
                                                <h2>Vehicle Loans</h2>
                                                <p><strong>Most dealers who use ".SITE_TITLE." also offer attractive financing packages, regardless of your credit rating. You can jumpstart the credit approval process. If you haven't already done so, fill out the form from the FINANCING menu item on our website. Filling out that form does NOT affect your credit rating.</strong></p><p>&nbsp;</p>
                                            </td>
                                    
                                        </tr>
                                  <tr> 
                                  <td>
                                  <p>You are receiving this email because you signed up on the https://".SITE_URL." website to receive notice of quotes on the vehicles you entered.</p><p>To unsubscribe from this email, please reply to this message with UNSUBSCRIBE as the subject.</p>
                                  
                                  
                                  </td>
                                      </td>     
                                        
                                        
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
         
         
		$subject_for_member	=	"New Quote for your $vehicle_make $vehicle_model";
		$to		=	$member_email;
		$from	=	TO;
		$headers = "From: " . strip_tags($from) . "\r\n";
		$headers .= "Reply-To: $from\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		mail($to, $subject_for_member, $email_to_member, $headers);    
    
    
    
    
    
    
    
    
}

############### END OF CLASS DEFINITION #######################################
}
?>