<?php

require_once("includes/lib/common.php");
//require("includes/lib/classes/a/applications.php");
require("includes/lib/classes/a/dealer_quotes.php");
function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}
$quotes = new quotes();

$rating=explode(":|:",$_POST['get_option']);

//mail("birwin@suddensales.com", "Error Message ", "At line ".__LINE__." in ".__FILE__." rating[1] is $rating[1] and rating[2] is $rating[2] and quotes->id is $quotes->id and rating[3] is $rating[3] and rating[0] is $rating[0]");

                $quotes->id							   	=	$quotes->id;
                $quotes->member_id					   	=	$rating[2];
                $quotes->dealer_id    				    =	$rating[3];
				$quotes->vehicle_id    				      =	$rating[1];
                $quotes->date_entered                     =	date("Y-m-d H:i:s");
                $quotes->rating                           =	$rating[0];
                
                $quotes->saveRating();