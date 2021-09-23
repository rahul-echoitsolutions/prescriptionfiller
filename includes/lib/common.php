<?php
if(session_id() == ''){
        // keep session data for AT LEAST 6 hours
ini_set('session.gc_maxlifetime', 21600);
//  client cookie should remember their session id for EXACTLY 6 hours
session_set_cookie_params(21600);
    //session has not started
    session_start();


}
	// include server parameters
	require('configure.php');

/*if($_SERVER['HTTP_HOST']=='localhost')
{ 
	require($_SERVER['DOCUMENT_ROOT']."/lboom/development/includes/configure.php");
}
else
{
	require($_SERVER['DOCUMENT_ROOT']."/includes/configure.php");
}*/

if(!$_SESSION){ header('Location: logout.php'); }

	/* Error display script **/
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
	/* End of Error display script **/
	
	/*
	appplication_top.php      
	*/
	error_reporting(E_ALL ^ E_NOTICE ^E_WARNING ^E_DEPRECATED);
	
	$_SERVER['SCRIPT_FILENAME']=$_SERVER['DOCUMENT_ROOT'].((strpos($_SERVER['DOCUMENT_ROOT'],"\\")>0)?str_replace("/","\\",$_SERVER['PHP_SELF']):$_SERVER['PHP_SELF']);
	
	ini_set('default_charset','iso-8859-1'); //set charset
	
	// start the timer for the page pars	e time log
	define('PAGE_PARSE_START_TIME', microtime());
	
	// set the level of error reporting
	//error_reporting(E_ALL & ~E_NOTICE);
  //error_reporting(0);
	

	
	// define how the session functions will be used
	require(DIR_WS_CLASSES . 'request.php');
	$request=new phprequest();
	
    
    
	// set the type of request (secure or not)

	$request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';
	
	


// include the list of project filenames
  require('filenames.php');

// include the list of project database tables
  require('database_tables.php');

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');
  
// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');
  
// define general functions used application-wide
 require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');

// define how the session functions will be used
	require(DIR_WS_CLASSES . 'sessions.php');
	$session=new phpsession();
	$session->start();
	

	
	
	// include the password crypto functions
	require(DIR_WS_FUNCTIONS . 'password_funcs.php');
	require(DIR_WS_FUNCTIONS . 'pagination.php');
	require(DIR_WS_FUNCTIONS . 'sorting.php');


	    

	// include validation functions (right now only email address)
    // added provinces to arrays BI     
	require(DIR_WS_FUNCTIONS . 'validations.php');
			$state_array = array(   
                        array("id"=>"","text"=>" - Select - "),
                        array("id"=>"AB","text"=>"Alberta"),
                        array("id"=>"BC","text"=>"British Columbia"),
                        array("id"=>"SK","text"=>"Saskatchewan"),
                        array("id"=>"MB","text"=>"Manitoba"),
                        array("id"=>"ON","text"=>"Ontario"),
                        array("id"=>"PQ","text"=>"Quebec"),
                        array("id"=>"NB","text"=>"New Brunswick"),
                        array("id"=>"NS","text"=>"Nova Scotia"),
                        array("id"=>"LD","text"=>"Newfoundland"),
                        array("id"=>"EI","text"=>"Prince Edward Island"),
						array("id"=>"AK","text"=>"Alaska"),
						array("id"=>"AL","text"=>"Alabama"),
						array("id"=>"AR","text"=>"Arkansas"),
						array("id"=>"AS","text"=>"American Samoa"),
						array("id"=>"CA","text"=>"California"),
						array("id"=>"CO","text"=>"Colorado"),
						array("id"=>"CT","text"=>"Connecticut"),
						array("id"=>"DC","text"=>"District of Columbia"),
						array("id"=>"DE","text"=>"Delaware"),
						array("id"=>"FL","text"=>"Florida"),
						array("id"=>"GA","text"=>"Georgia"),
						array("id"=>"GU","text"=>"Guam"),
						array("id"=>"HI","text"=>"Hawaii"),
						array("id"=>"IA","text"=>"Iowa"),
						array("id"=>"ID","text"=>"Idaho"),
						array("id"=>"IL","text"=>"Illinois"),
						array("id"=>"IN","text"=>"Indiana"),
						array("id"=>"KS","text"=>"Kansas"),
						array("id"=>"KY","text"=>"Kentucky"),
						array("id"=>"LA","text"=>"Louisiana"),
						array("id"=>"MA","text"=>"Massachusetts"),
						array("id"=>"MD","text"=>"Maryland"),
						array("id"=>"ME","text"=>"Maine"),
						array("id"=>"MI","text"=>"Michigan"),
						array("id"=>"MN","text"=>"Minnesota"),
						array("id"=>"MO","text"=>"Missouri"),
						array("id"=>"MP","text"=>"Northern Mariana Is"),
						array("id"=>"MS","text"=>"Mississippi"),
						array("id"=>"MT","text"=>"Montana"),
						array("id"=>"NC","text"=>"North Carolina"),
						array("id"=>"ND","text"=>"North Dakota"),
						array("id"=>"NE","text"=>"Nebraska"),
						array("id"=>"NH","text"=>"New Hampshire"),
						array("id"=>"NJ","text"=>"New Jersey"),
						array("id"=>"NM","text"=>"New Mexico"),
						array("id"=>"NV","text"=>"Nevada"),
						array("id"=>"NY","text"=>"New York"),
						array("id"=>"OH","text"=>"Ohio"),
						array("id"=>"OK","text"=>"Oklahoma"),
						array("id"=>"OR","text"=>"Oregon"),
						array("id"=>"PA","text"=>"Pennsylvania"),
						array("id"=>"PR","text"=>"Puerto Rico"),
						array("id"=>"RI","text"=>"Rhode Island"),
						array("id"=>"SC","text"=>"South Carolina"),
						array("id"=>"SD","text"=>"South Dakota"),
						array("id"=>"TN","text"=>"Tennessee"),
						array("id"=>"TX","text"=>"Texas"),
						array("id"=>"UT","text"=>"Utah"),
						array("id"=>"VA","text"=>"Virginia"),
						array("id"=>"VI","text"=>"Virgin Islands"),
						array("id"=>"VT","text"=>"Vermont"),
						array("id"=>"WA","text"=>"Washington"),
						array("id"=>"WI","text"=>"Wisconsin"),
						array("id"=>"WV","text"=>"West Virginia"),
					    array("id"=>"WY","text"=>"Wyoming")
                        
                                                
                                                
	);
	$state_code_array = array(""=>" - Select - ", "AB"=>"Alberta", "BC"=>"British Columbia", "SK"=>"Saskatchewan", "MB"=>"Manitoba", "ON"=>"Ontario", "PQ"=>"Quebec", "NB"=>"New Brunswick", "NS"=>"Nova Scotia", "LD"=>"Newfoundland", "EI"=>"Prince Edward Island", "AK"=>"Alaska", "AL"=>"Alabama", "AR"=>"Arkansas", "AS"=>"American Samoa", "CA"=>"California", "CO"=>"Colorado", "CT"=>"Connecticut", "DC"=>"District of Columbia", "DE"=>"Delaware", "FL"=>"Florida", "GA"=>"Georgia", "GU"=>"Guam",	"HI"=>"Hawaii", "IA"=>"Iowa", "ID"=>"Idaho", "IL"=>"Illinois", "IN"=>"Indiana", "KS"=>"Kansas", "KY"=>"Kentucky", "LA"=>"Louisiana", "MA"=>"Massachusetts", "MD"=>"Maryland", "ME"=>"Maine", "MI"=>"Michigan", "MN"=>"Minnesota", "MO"=>"Missouri", "MP"=>"Northern Mariana Is", "MS"=>"Mississippi", "MT"=>"Montana", "NC"=>"North Carolina", "ND"=>"North Dakota", "NE"=>"Nebraska", "NH"=>"New Hampshire", "NJ"=>"New Jersey", "NM"=>"New Mexico", "NV"=>"Nevada", "NY"=>"New York", "OH"=>"Ohio", "OK"=>"Oklahoma", "OR"=>"Oregon", "PA"=>"Pennsylvania", "PR"=>"Puerto Rico", "RI"=>"Rhode Island", "SC"=>"South Carolina", "SD"=>"South Dakota", "TN"=>"Tennessee", "TX"=>"Texas", "UT"=>"Utah", "VA"=>"Virginia", "VI"=>"Virgin Islands", "VT"=>"Vermont", "WA"=>"Washington", "WI"=>"Wisconsin", "WV"=>"West Virginia",	"WY"=>"Wyoming"
	);
    
    
    
	// split-page-results
    
    
    //echo"<br /><br />at ".__LINE__." time1 is $time1 and time2 is $time2 and precision is $precision<br /><br />";

   if (!function_exists('dateDiff')) {

	function dateDiff($time1, $time2, $precision = 6) {
	   
       $time1=($time1)? $time1 : time();
       $time2=($time2)? $time2 : time()+60;
       
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
     // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Set default diff to 0
      $diffs[$interval] = 0;
      // Create temp time from time1 and interval
      $ttime = strtotime("+1 " . $interval, $time1);
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
	$time1 = $ttime;
	$diffs[$interval]++;
	// Create new temp time from time1 and interval
	$ttime = strtotime("+1 " . $interval, $time1);
      }
    }
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      }
    }

    return implode(", ", $times);
  }
  
  

  
  
  function days_in_month($month, $year){
		// calculate number of days in a month
		return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
	}

	function ago($secs){
		$minutes=60;
		$hours=$minutes*60;
		$days=$hours*60;
		$months=$days*30;
		$years=$months*12;
		
		if($secs/$years>1) return round($secs/$years,0).' years';
		if($secs/$months>1) return round($secs/$months,0).' months';
		if($secs/$days>1) return round($secs/$days,0).' days';
		if($secs/$hours>1) return round($secs/$hours,0).' hours';
		if($secs/$minutes>1) return round($secs/$minutes,0).' minutes';
		return $secs.' secs';
	}
	
	function unix_timestamp_to_human ($timestamp = "", $format = 'Y-m-d H:i:s'){
    	if (empty($timestamp) || ! is_numeric($timestamp)) $timestamp = time();
    	return ($timestamp) ? date($format, $timestamp) : date($format, $timestamp);
	}
    
    	function checkImage($img22){
	   if($img22==""){
	       $img22="no-image-found.png";
	   }
       return $img22;
	}    
	
	
	function create_url_links($text)
	{
	
					
					$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
					
					if(preg_match($reg_exUrl, $text, $url))
					$text = preg_replace($reg_exUrl, "<a href=".$url[0].">".$url[0]."</a> ", $text);
					
					return stripslashes(stripslashes($text));
					
		
	}
    
    function cleanit($escapedCopy){
    
    $eC=stripslashes(stripslashes($escapedCopy));
    
    return $eC;
}
}

function substr_custom($text,$len){
	$text = cleanit($text);
	$text = strip_tags($text);
	$text = substr($text,0,$len);
	return $text;
}

///////// function to return the live url of the current page ///////////
function getLiveUrl() {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  $url .= $_SERVER["REQUEST_URI"];
  return $url;
}
////////////// changes string number, with dollar signs and commas into a number 
function tofloat($numberString) {
    return floatval(preg_replace("/[^0-9.]/", '', $numberString));
}
?>
