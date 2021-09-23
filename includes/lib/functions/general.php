<?php
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
////
// Stop from parsing any further PHP code
  function tep_exit() {
  	global $session;
	$session->close();
   exit();
  }


include(statesProv.php);



////
// Redirect to another page or site
function tep_redirect($url) {

  if ( (strstr($url, "\n") != false) || (strstr($url, "\r") != false) ) {

    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false));

  }
	if ( (ENABLE_SSL == true) && (getenv('HTTPS') == 'on') ) { // We are loading an SSL page

    if (substr($url, 0, strlen(HTTP_SERVER)) == HTTP_SERVER) { // NONSSL url

      $url = HTTPS_SERVER . substr($url, strlen(HTTP_SERVER)); // Change it to SSL
	}
 }
	header('Location: ' . $url);
	tep_exit();
}

////



function truncate($string,$length=100,$append="&hellip;") {
$string = trim($string);

if(strlen($string) > $length) {
$string = wordwrap($string, $length);
$string = explode("\n", $string, 2);
$string = $string[0] . $append;
}

return $string;
}













// Parse the data used in the html tags to ensure the tags will not break
  function tep_parse_input_field_data($data, $parse) {
    return strtr(trim($data), $parse);
  }

  function tep_output_string($string, $translate = false, $protected = false) {
    if ($protected == true) {
      return htmlspecialchars($string);
    } else {
      if ($translate == false) {
        return tep_parse_input_field_data($string, array('"' => '&quot;'));
      } else {
        return tep_parse_input_field_data($string, $translate);
      }
    }
  }

  function tep_output_string_protected($string) {
    return tep_output_string($string, false, true);
  }

  function tep_sanitize_string($string) {
    $string = ereg_replace(' +', ' ', trim($string));

    return preg_replace("/[<>]/", '_', $string);
  }

////
// Return a random row from a database query
  function tep_random_select($query) {
    $random_product = '';
    $random_query = tep_db_query($query);
    $num_rows = tep_db_num_rows($random_query);
    if ($num_rows > 0) {
      $random_row = tep_rand(0, ($num_rows - 1));
      tep_db_data_seek($random_query, $random_row);
      $random_product = tep_db_fetch_array($random_query);
    }

    return $random_product;
  }

////
// Break a word in a string if it is longer than a specified length ($len)
  function tep_break_string($string, $len, $break_char = '-') {
    $l = 0;
    $output = '';
    for ($i=0, $n=strlen($string); $i<$n; $i++) {
      $char = substr($string, $i, 1);
      if ($char != ' ') {
        $l++;
      } else {
        $l = 0;
      }
      if ($l > $len) {
        $l = 1;
        $output .= $break_char;
      }
      $output .= $char;
    }

    return $output;
  }


  function tep_get_all_get_params($exclude_array = '') {
    global $request;
	$get_vars=$request->VARS["GET"]; 
    if (!is_array($exclude_array)) $exclude_array = array();

    $get_url = '';
    if (is_array($get_vars) && (sizeof($get_vars) > 0)) {
      reset($request);
      while (list($key, $value) = each($get_vars)) {
        if ( (strlen($value) > 0) && ($key != $session->name) && ($key != 'error') && (!in_array($key, $exclude_array)) && ($key != 'x') && ($key != 'y') ) {
          $get_url .= $key . '=' . rawurlencode(stripslashes($value)) . '&';
        }
      }
    }
    return $get_url;
  }

////
// Returns the clients browser
  function tep_browser_detect($component) {
    global $HTTP_USER_AGENT;

    return stristr($HTTP_USER_AGENT, $component);
  }

////
// Returns the zone (State/Province) name
// TABLES: zones
  function tep_get_zone_name($country_id, $zone_id, $default_zone) {
    $zone_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_id . "' and zone_id = '" . (int)$zone_id . "'");
    if (tep_db_num_rows($zone_query)) {
      $zone = tep_db_fetch_array($zone_query);
      return $zone['zone_name'];
    } else {
      return $default_zone;
    }
  }

////
// Wrapper function for round()
  function tep_round($number, $precision) {
    if (strpos($number, '.') && (strlen(substr($number, strpos($number, '.')+1)) > $precision)) {
      $number = substr($number, 0, strpos($number, '.') + 1 + $precision + 1);

      if (substr($number, -1) >= 5) {
        if ($precision > 1) {
          $number = substr($number, 0, -1) + ('0.' . str_repeat(0, $precision-1) . '1');
        } elseif ($precision == 1) {
          $number = substr($number, 0, -1) + 0.1;
        } else {
          $number = substr($number, 0, -1) + 1;
        }
      } else {
        $number = substr($number, 0, -1);
      }
    }
    return $number;
  }

////
// Returns the tax rate for a zone / class
// TABLES: tax_rates, zones_to_geo_zones
  function tep_get_tax_rate($class_id, $country_id = -1, $zone_id = -1) {
    global $customer_zone_id, $customer_country_id,$session;

    if ( ($country_id == -1) && ($zone_id == -1) ) {
      if (!$session->is_registered('customer_id')) {
        $country_id = STORE_COUNTRY;
        $zone_id = STORE_ZONE;
      } else {
        $country_id = $customer_country_id;
        $zone_id = $customer_zone_id;
      }
    }

    $tax_query = tep_db_query("select sum(tax_rate) as tax_rate from " . TABLE_TAX_RATES . " tr left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id) left join " . TABLE_GEO_ZONES . " tz on (tz.geo_zone_id = tr.tax_zone_id) where (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = '" . (int)$country_id . "') and (za.zone_id is null or za.zone_id = '0' or za.zone_id = '" . (int)$zone_id . "') and tr.tax_class_id = '" . (int)$class_id . "' group by tr.tax_priority");
    if (tep_db_num_rows($tax_query)) {
      $tax_multiplier = 1.0;
      while ($tax = tep_db_fetch_array($tax_query)) {
        $tax_multiplier *= 1.0 + ($tax['tax_rate'] / 100);
      }
      return ($tax_multiplier - 1.0) * 100;
    } else {
      return 0;
    }
  }

////
// Return the tax description for a zone / class
// TABLES: tax_rates;
  function tep_get_tax_description($class_id, $country_id, $zone_id) {
    $tax_query = tep_db_query("select tax_description from " . TABLE_TAX_RATES . " tr left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id) left join " . TABLE_GEO_ZONES . " tz on (tz.geo_zone_id = tr.tax_zone_id) where (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = '" . (int)$country_id . "') and (za.zone_id is null or za.zone_id = '0' or za.zone_id = '" . (int)$zone_id . "') and tr.tax_class_id = '" . (int)$class_id . "' order by tr.tax_priority");
    if (tep_db_num_rows($tax_query)) {
      $tax_description = '';
      while ($tax = tep_db_fetch_array($tax_query)) {
        $tax_description .= $tax['tax_description'] . ' + ';
      }
      $tax_description = substr($tax_description, 0, -3);

      return $tax_description;
    } else {
      return TEXT_UNKNOWN_TAX_RATE;
    }
  }

////
// Add tax to a products price
  function tep_add_tax($price, $tax,$deposit=100) {
    global $currencies;
    if ( (DISPLAY_PRICE_WITH_TAX == 'true') && ($tax > 0) ) {
      return tep_round($price, $currencies->currencies[DEFAULT_CURRENCY]['decimal_places']) + tep_calculate_tax($price, $tax);
    } else {
      return tep_round($price, $currencies->currencies[DEFAULT_CURRENCY]['decimal_places']);
    }
  }

// Calculates Tax rounding the result
  function tep_calculate_tax($price, $tax) {
    global $currencies;//$currencies->currencies[DEFAULT_CURRENCY]['decimal_places']

    return tep_round($price * $tax / 100, 4);
  }

// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
  function tep_date_long($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = (int)substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    return strftime(DATE_FORMAT_LONG, mktime($hour,$minute,$second,$month,$day,$year));
  }

////
// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
// NOTE: Includes a workaround for dates before 01/01/1970 that fail on windows servers
  function tep_date_short($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || empty($raw_date) ) return false;

    $year = substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    if (@date('Y', mktime($hour, $minute, $second, $month, $day, $year)) == $year) {
      return date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
    } else {
      return ereg_replace('2037' . '$', $year, date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, 2037)));
    }
  }

////
// Parse search string into indivual objects
  function tep_parse_search_string($search_str = '', &$objects) {
    $search_str = trim(strtolower($search_str));

// Break up $search_str on whitespace; quoted string will be reconstructed later
    $pieces = split('[[:space:]]+', $search_str);
    $objects = array();
    $tmpstring = '';
    $flag = '';

    for ($k=0; $k<count($pieces); $k++) {
      while (substr($pieces[$k], 0, 1) == '(') {
        $objects[] = '(';
        if (strlen($pieces[$k]) > 1) {
          $pieces[$k] = substr($pieces[$k], 1);
        } else {
          $pieces[$k] = '';
        }
      }

      $post_objects = array();

      while (substr($pieces[$k], -1) == ')')  {
        $post_objects[] = ')';
        if (strlen($pieces[$k]) > 1) {
          $pieces[$k] = substr($pieces[$k], 0, -1);
        } else {
          $pieces[$k] = '';
        }
      }

// Check individual words

      if ( (substr($pieces[$k], -1) != '"') && (substr($pieces[$k], 0, 1) != '"') ) {
        $objects[] = trim($pieces[$k]);

        for ($j=0; $j<count($post_objects); $j++) {
          $objects[] = $post_objects[$j];
        }
      } else {
/* This means that the $piece is either the beginning or the end of a string.
   So, we'll slurp up the $pieces and stick them together until we get to the
   end of the string or run out of pieces.
*/

// Add this word to the $tmpstring, starting the $tmpstring
        $tmpstring = trim(ereg_replace('"', ' ', $pieces[$k]));

// Check for one possible exception to the rule. That there is a single quoted word.
        if (substr($pieces[$k], -1 ) == '"') {
// Turn the flag off for future iterations
          $flag = 'off';

          $objects[] = trim($pieces[$k]);

          for ($j=0; $j<count($post_objects); $j++) {
            $objects[] = $post_objects[$j];
          }

          unset($tmpstring);

// Stop looking for the end of the string and move onto the next word.
          continue;
        }

// Otherwise, turn on the flag to indicate no quotes have been found attached to this word in the string.
        $flag = 'on';

// Move on to the next word
        $k++;

// Keep reading until the end of the string as long as the $flag is on

        while ( ($flag == 'on') && ($k < count($pieces)) ) {
          while (substr($pieces[$k], -1) == ')') {
            $post_objects[] = ')';
            if (strlen($pieces[$k]) > 1) {
              $pieces[$k] = substr($pieces[$k], 0, -1);
            } else {
              $pieces[$k] = '';
            }
          }

// If the word doesn't end in double quotes, append it to the $tmpstring.
          if (substr($pieces[$k], -1) != '"') {
// Tack this word onto the current string entity
            $tmpstring .= ' ' . $pieces[$k];

// Move on to the next word
            $k++;
            continue;
          } else {
/* If the $piece ends in double quotes, strip the double quotes, tack the
   $piece onto the tail of the string, push the $tmpstring onto the $haves,
   kill the $tmpstring, turn the $flag "off", and return.
*/
            $tmpstring .= ' ' . trim(ereg_replace('"', ' ', $pieces[$k]));

// Push the $tmpstring onto the array of stuff to search for
            $objects[] = trim($tmpstring);

            for ($j=0; $j<count($post_objects); $j++) {
              $objects[] = $post_objects[$j];
            }

            unset($tmpstring);

// Turn off the flag to exit the loop
            $flag = 'off';
          }
        }
      }
    }

// add default logical operators if needed
    $temp = array();
    for($i=0; $i<(count($objects)-1); $i++) {
      $temp[] = $objects[$i];
      if ( ($objects[$i] != 'and') &&
           ($objects[$i] != 'or') &&
           ($objects[$i] != '(') &&
           ($objects[$i+1] != 'and') &&
           ($objects[$i+1] != 'or') &&
           ($objects[$i+1] != ')') ) {
        $temp[] = ADVANCED_SEARCH_DEFAULT_OPERATOR;
      }
    }
    $temp[] = $objects[$i];
    $objects = $temp;

    $keyword_count = 0;
    $operator_count = 0;
    $balance = 0;
    for($i=0; $i<count($objects); $i++) {
      if ($objects[$i] == '(') $balance --;
      if ($objects[$i] == ')') $balance ++;
      if ( ($objects[$i] == 'and') || ($objects[$i] == 'or') ) {
        $operator_count ++;
      } elseif ( ($objects[$i]) && ($objects[$i] != '(') && ($objects[$i] != ')') ) {
        $keyword_count ++;
      }
    }

    if ( ($operator_count < $keyword_count) && ($balance == 0) ) {
      return true;
    } else {
      return false;
    }
  }

////
// Check date
  function tep_checkdate($date_to_check, $format_string, &$date_array) {
    $separator_idx = -1;

    $separators = array('-', ' ', '/', '.');
    $month_abbr = array('jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec');
    $no_of_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    $format_string = strtolower($format_string);

    if (strlen($date_to_check) != strlen($format_string)) {
      return false;
    }

    $size = sizeof($separators);
    for ($i=0; $i<$size; $i++) {
      $pos_separator = strpos($date_to_check, $separators[$i]);
      if ($pos_separator != false) {
        $date_separator_idx = $i;
        break;
      }
    }

    for ($i=0; $i<$size; $i++) {
      $pos_separator = strpos($format_string, $separators[$i]);
      if ($pos_separator != false) {
        $format_separator_idx = $i;
        break;
      }
    }

    if ($date_separator_idx != $format_separator_idx) {
      return false;
    }

    if ($date_separator_idx != -1) {
      $format_string_array = explode( $separators[$date_separator_idx], $format_string );
      if (sizeof($format_string_array) != 3) {
        return false;
      }

      $date_to_check_array = explode( $separators[$date_separator_idx], $date_to_check );
      if (sizeof($date_to_check_array) != 3) {
        return false;
      }

      $size = sizeof($format_string_array);
      for ($i=0; $i<$size; $i++) {
        if ($format_string_array[$i] == 'mm' || $format_string_array[$i] == 'mmm') $month = $date_to_check_array[$i];
        if ($format_string_array[$i] == 'dd') $day = $date_to_check_array[$i];
        if ( ($format_string_array[$i] == 'yyyy') || ($format_string_array[$i] == 'aaaa') ) $year = $date_to_check_array[$i];
      }
    } else {
      if (strlen($format_string) == 8 || strlen($format_string) == 9) {
        $pos_month = strpos($format_string, 'mmm');
        if ($pos_month != false) {
          $month = substr( $date_to_check, $pos_month, 3 );
          $size = sizeof($month_abbr);
          for ($i=0; $i<$size; $i++) {
            if ($month == $month_abbr[$i]) {
              $month = $i;
              break;
            }
          }
        } else {
          $month = substr($date_to_check, strpos($format_string, 'mm'), 2);
        }
      } else {
        return false;
      }

      $day = substr($date_to_check, strpos($format_string, 'dd'), 2);
      $year = substr($date_to_check, strpos($format_string, 'yyyy'), 4);
    }

    if (strlen($year) != 4) {
      return false;
    }

    if (!settype($year, 'integer') || !settype($month, 'integer') || !settype($day, 'integer')) {
      return false;
    }

    if ($month > 12 || $month < 1) {
      return false;
    }

    if ($day < 1) {
      return false;
    }

    if (tep_is_leap_year($year)) {
      $no_of_days[1] = 29;
    }

    if ($day > $no_of_days[$month - 1]) {
      return false;
    }

    $date_array = array($year, $month, $day);

    return true;
  }

////
// Check if year is a leap year
  function tep_is_leap_year($year) {
    if ($year % 100 == 0) {
      if ($year % 400 == 0) return true;
    } else {
      if (($year % 4) == 0) return true;
    }

    return false;
  }

////
// Get the number of times a word/character is present in a string
  function tep_word_count($string, $needle) {
    $temp_array = split($needle, $string);

    return sizeof($temp_array);
  }

  function tep_count_modules($modules = '') {
    $count = 0;

    if (empty($modules)) return $count;

    $modules_array = split(';', $modules);

    for ($i=0, $n=sizeof($modules_array); $i<$n; $i++) {
      $class = substr($modules_array[$i], 0, strrpos($modules_array[$i], '.'));

      if (is_object($GLOBALS[$class])) {
        if ($GLOBALS[$class]->enabled) {
          $count++;
        }
      }
    }

    return $count;
  }

  function tep_create_random_value($length, $type = 'mixed') {
    if ( ($type != 'mixed') && ($type != 'chars') && ($type != 'digits')) return false;

    $rand_value = '';
    while (strlen($rand_value) < $length) {
      if ($type == 'digits') {
        $char = tep_rand(0,9);
      } else {
        $char = chr(tep_rand(0,255));
      }
      if ($type == 'mixed') {
        if (eregi('^[a-z0-9]$', $char)) $rand_value .= $char;
      } elseif ($type == 'chars') {
        if (eregi('^[a-z]$', $char)) $rand_value .= $char;
      } elseif ($type == 'digits') {
        if (ereg('^[0-9]$', $char)) $rand_value .= $char;
      }
    }

    return $rand_value;
  }

  function tep_not_null($value) {
    if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }

////
// Return a random value
  function tep_rand($min = null, $max = null) {
    static $seeded;

    if (!isset($seeded)) {
      mt_srand((double)microtime()*1000000);
      $seeded = true;
    }

    if (isset($min) && isset($max)) {
      if ($min >= $max) {
        return $min;
      } else {
        return mt_rand($min, $max);
      }
    } else {
      return mt_rand();
    }
  }

  function tep_setcookie($name, $value = '', $expire = 0, $path = '/', $domain = '', $secure = 0) {
    setcookie($name, $value, $expire, $path, (tep_not_null($domain) ? $domain : ''), $secure);
  }

  function tep_get_ip_address() {
    if (isset($_SERVER)) {
      if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
      } else {
        $ip = $_SERVER['REMOTE_ADDR'];
      }
    } else {
      if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
      } elseif (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
      } else {
        $ip = getenv('REMOTE_ADDR');
      }
    }

    return $ip;
  }

// nl2br() prior PHP 4.2.0 did not convert linefeeds on all OSs (it only converted \n)
  function tep_convert_linefeeds($from, $to, $string) {
    if ((PHP_VERSION < "4.0.5") && is_array($from)) {     
      return ereg_replace('(' . implode('|', $from) . ')', $to, $string);
    } else {      
      return str_replace($from, $to, $string);
    }
  }

// Decode string encoded with htmlspecialchars()
  function tep_decode_specialchars($string){
    $string=str_replace('&gt;', '>', $string);
    $string=str_replace('&lt;', '<', $string);
    $string=str_replace('&#039;', "'", $string);
    $string=str_replace('&quot;', "\"", $string);
    $string=str_replace('&amp;', '&', $string);

    return $string;
  }

	
	function tep_send_email(&$details,$default=false){
		global $smtp_array;
		$result=false;
		 $message = new email(array('X-Mailer: LUB - PHP/' . phpversion()));
		
		if(count($smtp_array)>0){
			$message->set_smtp($smtp_array);
		}
		
		 if ($details['format'] != 'T') {
			 $message->add_html($details['html_text'], $details['text']);
		 } else {
			 $message->add_text($details['text']);
			 		
		 }

		$message->build_message();
		//print_r($details);
		//exit;

		 if($details['to_name']!=='' && $details['to_email']!=='' && $details['from_name']!=='' && $details['from_email']!=='' && $details['subject']!==''){
			 $result=$message->send($details['to_name'], $details['to_email'], $details['from_name'], $details['from_email'], $details['subject']);
			 unset($message);
			 return $result;
		 }	 
	}
	
	// format date according to date setting in configuration
  function format_date($raw_date,$simple=false){
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '0000-00-00') || ($raw_date == '') ) return false;
	$format=EVENTS_DATE_FORMAT;

	if ($simple) $format=strtolower($format);
    $year = substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    if (@date('Y', mktime($hour, $minute, $second, $month, $day, $year)) == $year) {
      return date($format, mktime($hour, $minute, $second, $month, $day, $year));
    } else {
      return ereg_replace('2037' . '$', $year, date($format, mktime($hour, $minute, $second, $month, $day, 2037)));
    }
  }

 function tep_check_date_raw($date,$format,$sep_char="-"){
 	$date_details=array('y'=>0,'m'=>0,'d'=>0);
	$split_arr=split($sep_char,$date);
	$split_format=split($sep_char,$format);
	if (!(sizeof($split_arr)==sizeof($split_format) && sizeof($split_arr)>0 && sizeof($split_arr)<=3)) return false;
	
	for ($icnt=0;$icnt<sizeof($split_arr);$icnt++){
		if (isset($date_details[strtolower($split_format[$icnt])]))
			$date_details[strtolower($split_format[$icnt])]=(int)$split_arr[$icnt];
	}
	return checkdate($date_details['m'],$date_details['d'],$date_details['y']);
 }
	function tep_convert_date_raw($date,$format=EVENTS_DATE_FORMAT,$sep_char="-"){
	$date_details=array('y'=>0,'m'=>0,'d'=>0);
	$split_arr=split($sep_char,$date);
	$split_format=split($sep_char,$format);
	if (!(sizeof($split_arr)==sizeof($split_format) && sizeof($split_arr)>0 && sizeof($split_arr)<=3)) return "";
	
	for ($icnt=0;$icnt<sizeof($split_arr);$icnt++){
		if (isset($date_details[strtolower($split_format[$icnt])]))
			$date_details[strtolower($split_format[$icnt])]=(int)$split_arr[$icnt];
	}
	$date_details['d']=sprintf("%02d",$date_details['d']);
	$date_details['m']=sprintf("%02d",$date_details['m']);
	return $date_details['y'] . '-' . $date_details['m'] . '-' . $date_details['d']; 
 }
 
 
  // get the current server date considering date offset settings
 function getServerDate($date=true){
	$offset=(float)EVENTS_SERVER_DATE_OFFSET;
	$offset = 0;
	if($offset>0){
		if(strpos($offset,'.')>0){
			$cur_offset_time = mktime(date('H')+abs($offset),date('i')+30,date('s'),date('m'),date('d'),date('y'));
			if($date)
				return date('Y-m-d',$cur_offset_time);
			else
				return $cur_offset_time;
		}else{
			$cur_offset_time = mktime(date('H')+abs($offset),date('i'),date('s'),date('m'),date('d'),date('y'));
			if($date)
				return date('Y-m-d',$cur_offset_time);
			else
				return $cur_offset_time;
		}
	}else{
		if(strpos($offset,'.')>0){
			$cur_offset_time = mktime(date('H')-abs($offset)+1,date('i')-30,date('s'),date('m'),date('d'),date('y'));
			if($date)
				return date('Y-m-d',$cur_offset_time);
			else
				return $cur_offset_time;
		}else{
			$cur_offset_time = mktime(date('H')-abs($offset),date('i'),date('s'),date('m'),date('d'),date('y'));
			if($date)
				return date('Y-m-d',$cur_offset_time);
			else
				return $cur_offset_time;
		}
	}
 }
 
 	// get rounded amount according to rounding factor in configuration
 function tep_get_rounded_amount($amount){
 	$result=0;
	$round_digit=0;
	$decimal=0;
 	$round_type=EVENTS_ORDER_AMOUNT_ROUND;

	$decimal=floor((($amount-floor($amount))*100)+0.5);
	switch($round_type){
		case "0.01":
			$result=$amount;
			break;
		case "0.05":
			$round_digit=$decimal%10;
			if ($round_digit>7) {
				$decimal=(floor($decimal/10)+1)*10;
			} else if ($round_digit>2) {
				$decimal=(floor($decimal/10)*10)+5;
			} else {
				$decimal=floor($decimal/10)*10;			
			}
			$result=floor($amount)+$decimal/100;
			break;
		case "0.1":
			$decimal=(floor($decimal/10))*10;
			$result=floor($amount)+$decimal/100;
			break;
		case "0":
		default:
			if ($decimal>=50)
				$result=floor($amount)+1;
			else
				$result=floor($amount);
	}
	return $result;
 }

	function tep_get_template(&$details){
		global $smtp_array;
		$details['html_text']='';
		$details['text']='';
		$mail_data_query=tep_db_query("SELECT * from " . $details["table"] . " where template_name='" . $details["type"] . "'");

		if (tep_db_num_rows($mail_data_query)>0){
			$mail_data_result=tep_db_fetch_array($mail_data_query);
			if($mail_data_result['type_id']>0){
				$smtp_sql = "select * from " . TABLE_EMAIL_SMTPS . " where id='" . $mail_data_result['smtp_id'] . "'";
				$smtp_query = tep_db_query($smtp_sql);
				if(tep_db_num_rows($smtp_query)>0){
					$smtp_result = tep_db_fetch_array($smtp_query);
					$smtp_array['user'] = $smtp_result['username'];
					$smtp_array['pass'] = $smtp_result['password'];
					$smtp_array['server_information'] = $smtp_result['server_information'];
					$smtp_array['server_port_number'] = $smtp_result['server_port_number'];
				}
			}
			$details['format']=$mail_data_result['message_format'];
			$details['html_text']=$mail_data_result['template_content'];
			$details['text']=strip_tags($mail_data_result['template_content'],'<br>');
			$details['subject']=$mail_data_result['message_subject'];
			return $details;
		}
	}

	function tep_replace_template(&$details,&$replace_array){
		reset($replace_array); 
		while(list($key,$value)=each($replace_array)){
			$details['html_text']=eregi_replace("{{" . $key . "}}"," ".$value,$details['html_text']);
			$details['text']=eregi_replace("{{" . $key . "}}"," ".$value,$details['text']);
		}
		$details['html_text']=eregi_replace("{{current_url}}",HTTP_SERVER . DIR_WS_CATALOG . "",$details['html_text']);
		$details['text']=eregi_replace("{{current_url}}",HTTP_SERVER . DIR_WS_CATALOG . "",$details['text']);
	}
	
	function tep_strip_html(&$details){
		$details['text']=strip_tags($details['html_text'],'<br>');
		$details['text']=str_replace(array('<br />','<br>','<BR>','<BR />','<br/>','<BR/>'),chr(13). chr(10),$details['text']);
	}
	function getTaxAmount($state){
		$tax_amount_sql = "select * from " . TABLE_TAX . " where tax_state='" . $state . "'";
		$tax_amount_result = tep_db_fetch_array(tep_db_query($tax_amount_sql));
		return $tax_amount_result['tax_amount'];
	}
function send_invoice_email($orders_id){
		global $session,$currencies;
		$customers_sql = "select * from " . TABLE_USERS . " where user_id='" . $session->get("user_id") . "'";
		$customers_query = tep_db_query($customers_sql);
		if(tep_db_num_rows($customers_query)<=0)return;
		$customers_result = tep_db_fetch_array($customers_query);
		$replace_array=array();
		$replace_array['APPLICANTADDRESS'] = $customers_result['Address'];
		$replace_array['APPLICANTCITY'] = $customers_result['City'];
		$replace_array['APPLICANTNAME'] = $customers_result['First_Name'] . " " . $customers_result['Middle_Name'] . " " . $customers_result['Last_Name'];
		$replace_array['APPLICANTPHONE'] = $customers_result['Phone'];
		$replace_array['APPLICANTSTATE'] = $customers_result['State'];
		$replace_array['APPLICANTZIP'] = $customers_result['Zip'];
		$replace_array['CITY'] = $customers_result['City'];
		$replace_array['MEMBERTYPE'] = "Customer";
		$replace_array['NAME'] = $customers_result['First_Name'] . " " . $customers_result['Middle_Name'] . " " . $customers_result['Last_Name'];
		$replace_array['PASSWORD'] = "--Hidden--";
		$replace_array['PHONE'] = $customers_result['Phone'];
		$replace_array['SHIPPINGADDRESS'] = $customers_result['Shipping_Address'];
		$replace_array['SHIPPINGCITY'] = $customers_result['Shipping_City'];
		$replace_array['SHIPPINGZIP'] = $customers_result['Shipping_Zip'];
		$replace_array['Zip'] = $customers_result['Zip'];
		$replace_array['ADDRESS'] = $customers_result['Address'];
		$replace_array['SHIPPINGNAME'] = $customers_result['First_Name'] . " " . $customers_result['Middle_Name'] . " " . $customers_result['Last_Name'];
		$replace_array['SHIPPINGSTATE'] = $customers_result['Shipping_State'];
		$replace_array['STATE'] = $customers_result['State'];
		$replace_array['USERID'] = $customers_result['user_id'];
		$replace_array['USERNAME'] = $customers_result['Login_Name'];
		$replace_array['APPROVAL_NO'] = "Approved";
		$replace_array['USERSTATUS'] = "Member";
		$replace_array['INVOICENO'] = $orders_id;
		$replace_array['ORDERDATE'] = date("m-d-Y");
		$order_sql = "select * from " . TABLE_ORDERS . " where orders_id='" . $orders_id . "'";
		$order_result = tep_db_fetch_array(tep_db_query($order_sql));
		$order_products_sql = "select * from " . TABLE_ORDERS_PRODUCTS . " where orders_id='" . $orders_id . "'";
		$order_products_query = tep_db_query($order_products_sql);
		$order_details = "<strong style='font-size:15px;'>Invoice Details</strong>";
		$order_details .= "<table width='100%' border='1' cellpadding='0' cellspacing='0' style=''>";
		$order_details .= "<tr>";
		$order_details .= "<td valign='top' align='center'>Product Name</td>";
		$order_details .= "<td valign='top' align='center'>Quantity</td>";
		$order_details .= "<td valign='top' align='center'>Price</td>";
		$order_details .= "<td valign='top' align='center'>Amount</td>";
		$order_details .= "</tr>";
		$subtotal_amount = 0;
		while($order_products_result=tep_db_fetch_array($order_products_query)){
			$order_details .= "<tr>";
			$order_details .= "<td valign='top' align='center'>" . $order_products_result['products_name'] . "</td>";
			$order_details .= "<td valign='top' align='center'>" . $order_products_result['products_quantity'] . "</td>";
			$order_details .= "<td valign='top' align='right'>" . $currencies->format($order_products_result['products_price']) . "</td>";
			$order_details .= "<td valign='top' align='right'>" . $currencies->format(($order_products_result['products_price']*$order_products_result['products_quantity'])) . "</td>";
			$order_details .= "</tr>";
			$subtotal_amount += $order_products_result['products_price']*$order_products_result['products_quantity'];
		}
		$order_details .= "<tr>";
		$order_details .= "<td valign='top' colspan='4' align='right'>SubTotal : " . $currencies->format($subtotal_amount) . "</td>";
		$order_details .= "</tr>";
		$order_details .= "<tr>";
		$order_details .= "<td valign='top' colspan='4' align='right'>Shipping & Tax : " . $currencies->format($order_result['shipping_amount']+$order_result['tax_amount']) . "</td>";
		$order_details .= "</tr>";
		$order_details .= "<tr>";
		$order_details .= "<td valign='top' colspan='4' align='right'>Total : " . $currencies->format(($order_result['amount'])) . "</td>";
		$order_details .= "</tr>";
		$order_details .= "</table>";
		$replace_array['INVOICEDETAILS'] = $order_details;
		$details=array();
		$details["type"]='IDT';
		$details["table"]=TABLE_EMAIL_TEMPLATES;
		tep_get_template($details); // get template of content
		$details["format"]="H";
		$details['subject']='Invoice Details';
		//tep_merge_details($replace_array,"test_default");  // get default merge data
		tep_replace_template($details,$replace_array);
		if(defined(STORE_OWNER)==false) define('STORE_OWNER','Logo Electronics');
		
		$details["to_name"]=$customers_result['First_Name'] . " " . $customers_result['Middle_Name'] . " " . $customers_result['Last_Name'];
		$details["to_email"]=$customers_result['Email'];
		$details["from_name"]=STORE_OWNER;
		$details["from_email"]=SENDMAIL_FROM;

		tep_send_email($details,true);
	}
function send_payment_email($payments_id){
		global $session,$currencies;
		$customers_sql = "select * from " . TABLE_USERS . " where user_id='" . $session->get("user_id") . "'";
		$customers_query = tep_db_query($customers_sql);
		if(tep_db_num_rows($customers_query)<=0)return;
		$customers_result = tep_db_fetch_array($customers_query);
		$replace_array=array();
		$replace_array['APPLICANTADDRESS'] = $customers_result['Address'];
		$replace_array['APPLICANTCITY'] = $customers_result['City'];
		$replace_array['APPLICANTNAME'] = $customers_result['First_Name'] . " " . $customers_result['Middle_Name'] . " " . $customers_result['Last_Name'];
		$replace_array['APPLICANTPHONE'] = $customers_result['Phone'];
		$replace_array['APPLICANTSTATE'] = $customers_result['State'];
		$replace_array['APPLICANTZIP'] = $customers_result['Zip'];
		$replace_array['CITY'] = $customers_result['City'];
		$replace_array['MEMBERTYPE'] = "Customer";
		$replace_array['NAME'] = $customers_result['First_Name'] . " " . $customers_result['Middle_Name'] . " " . $customers_result['Last_Name'];
		$replace_array['PASSWORD'] = "--Hidden--";
		$replace_array['PHONE'] = $customers_result['Phone'];
		$replace_array['SHIPPINGADDRESS'] = $customers_result['Shipping_Address'];
		$replace_array['SHIPPINGCITY'] = $customers_result['Shipping_City'];
		$replace_array['SHIPPINGZIP'] = $customers_result['Shipping_Zip'];
		$replace_array['Zip'] = $customers_result['Zip'];
		$replace_array['ADDRESS'] = $customers_result['Address'];
		$replace_array['SHIPPINGNAME'] = $customers_result['First_Name'] . " " . $customers_result['Middle_Name'] . " " . $customers_result['Last_Name'];
		$replace_array['SHIPPINGSTATE'] = $customers_result['Shipping_State'];
		$replace_array['STATE'] = $customers_result['State'];
		$replace_array['USERID'] = $customers_result['user_id'];
		$replace_array['USERNAME'] = $customers_result['Login_Name'];
		$replace_array['APPROVAL_NO'] = "Approved";
		$replace_array['USERSTATUS'] = "Member";
		$replace_array['INVOICENO'] = 0;
		$replace_array['ORDERDATE'] = date("m-d-Y");
		$payments_sql = "select * from " . TABLE_PAYMENTS . " where payment_id='" . $payments_id . "'";
		$payments_result = tep_db_fetch_array(tep_db_query($payments_sql));
		$payment_invoices_sql = "select * from " . TABLE_PAYMENT_INVOICES . " where payments_id='" . $payments_id . "'";
		$payment_invoices_query = tep_db_query($payment_invoices_sql);
		$payments_details = "<strong style='font-size:15px;'>Payment Details</strong>";
		$payments_details .= "<table width='30%' border='1' cellpadding='0' cellspacing='0' style=''>";
		$payments_details .= "<tr>";
		$payments_details .= "<td valign='top' align='center'>Invoice #</td>";
		$payments_details .= "<td valign='top' align='center'>Amount</td>";
		$payments_details .= "</tr>";
		while($payment_invoices_result=tep_db_fetch_array($payment_invoices_query)){
			$payments_details .= "<tr>";
			$payments_details .= "<td valign='top' align='center'>" . $payment_invoices_result['orders_id'] . "</td>";
			$payments_details .= "<td valign='top' align='center'>" . $currencies->format($payment_invoices_result['amount']) . "</td>";
			$payments_details .= "</tr>";
		}
		$payments_details .= "</table>";
		$replace_array['PAYMENT_ID'] = $payments_result['payment_id'];
		$replace_array['PAYMENT_DATE'] = date("m-d-Y");
		$replace_array['PAYMENT_CREDITNAME'] = $payments_result['credit_name'];
		$replace_array['PAYMENT_CREDITADDRESS'] = $payments_result['credit_address'];
		$replace_array['PAYMENT_CREDITCITY'] = $payments_result['credit_city'];
		$replace_array['PAYMENT_CREDITSTATE'] = $payments_result['credit_state'];
		$replace_array['PAYMENT_CREDITZIP'] = $payments_result['credit_zip'];
		$replace_array['PAYMENT_MEMODETAILS'] = $payments_result['memo_details'];
		$replace_array['PAYMENT_AMOUNT'] = $currencies->format($payments_result['amount']);
		$payType=array("CS"=>"Cash","CC"=>"Credit Card","CQ"=>"Cheque","OT"=>"Other");
		$replace_array['PAYMENT_TYPE'] = $payType[$payments_result['payment_type']];
		$replace_array['PAYMENT_DETAILS'] = $payments_details;
		$details=array();
		$details["type"]='PMT';
		$details["table"]=TABLE_EMAIL_TEMPLATES;
		
		tep_get_template($details); // get template of content
		$details["format"]="H";
		$details['subject']='Payment Details';
		//tep_merge_details($replace_array,"test_default");  // get default merge data
		tep_replace_template($details,$replace_array);
		if(defined(STORE_OWNER)==false) define('STORE_OWNER','Logo Electronics');
		
		$details["to_name"]=$customers_result['First_Name'] . " " . $customers_result['Middle_Name'] . " " . $customers_result['Last_Name'];
		$details["to_email"]=$customers_result['Email'];
		$details["from_name"]=STORE_OWNER;
		$details["from_email"]=SENDMAIL_FROM;

		tep_send_email($details,true);
	}

	function tep_resize_image($inputFilename,$outputFilename,$image_type,$new_mode)
	{	
		$imagedata = @getimagesize($inputFilename);
		if (!$imagedata) return false;
		$w = $imagedata[0];	
		$h = $imagedata[1];

		if ($w>$new_mode || $h>$new_mode){
			if ($h > $w) {		
				$new_w = ($new_mode / $h) * $w;		
				$new_h = $new_mode;
			} else {		
				$new_h = ($new_mode/ $w) * $h;
				$new_w = $new_mode;
			}
		} else {
			$new_w=$w;
			$new_h=$h;
		}
		//$im2 = @ImageCreateTrueColor($new_w, $new_h);
		$im2 = ImageCreateTrueColor($new_w, $new_h);
				
		if (!$im2)  return false;
		// call function according to the file type
		switch(strtolower($image_type)){
			case ".jpg":
			case ".jpeg":
				if(@ImageCreateFromJpeg($inputFilename))
					$image = ImageCreateFromJpeg($inputFilename);
				break;
			case ".gif":
				if(@ImageCreateFromGif($inputFilename))
					$image = ImageCreateFromGif($inputFilename);
				break;
			case ".png":
				if(@(ImageCreateFromPng($inputFilename)))
					$image = ImageCreateFromPng($inputFilename);
				break;
		}
		if (!$image) return;
		imagecopyResampled ($im2, $image, 0, 0, 0, 0, $new_w, $new_h, $imagedata[0], $imagedata[1]);
		switch(strtolower($image_type)){
			case ".jpg":
			case ".jpeg":
				ImageJpeg($im2,$outputFilename);
				break;
			case ".gif":
				ImageGif($im2,$outputFilename);
				break;
			case ".png":
				ImagePng($im2,$outputFilename);
				break;
		}
		imagedestroy($im2);
		return true;
	} 
	
	function hex2dec($hex){
	$color = str_replace('#', '', $hex);
	$ret = array(
	'r' => hexdec(substr($color, 0, 2)),
	'g' => hexdec(substr($color, 2, 2)),
	'b' => hexdec(substr($color, 4, 2))
	);	
	}
	//resize_image(dest_folder,height,$_FILES)
	
	// NOTE: This does NOT resize the image. It just uploads it. It is misnamed, but used so pervasively, that it isn't practical to change it. The output is the name of the file uploaded.
	function resize_image($st_imgfile,$path,$sizeLarge,$file_array)
	{		#$sizeLarge=300;
			$img_bkgd1=hex2dec("FFFFFF");
			$img_bkgd2=hex2dec("FFFFFF");
			// start processing photo upload
		#	echo $path;
			#die();
			//user defined variables
			$sizelim = "no"; //Do you want size limit, yes or no
			$size = "1000000"; //What do you want size limited to be if there is one
			// list of approved image types
			//all image types to upload
			$cert[1] = "image/pjpeg"; //Jpeg type 1
			$cert[2] = "image/jpeg"; //Jpeg type 2
			$cert[3] = "image/gif"; //Gif type
			$cert[4] = "image/ief"; //Ief type
			$cert[5] = "image/png"; //Png type
			$cert[6] = "image/tiff"; //Tiff type
			$cert[7] = "image/bmp"; //Bmp Type
			$cert[8] = "image/vnd.wap.wbmp"; //Wbmp type
			$cert[9] = "image/x-cmu-raster"; //Ras type
			$cert[10] = "image/x-x-portable-anymap"; //Pnm type
			$cert[11] = "image/x-portable-bitmap"; //Pbm type
			$cert[12] = "image/x-portable-graymap"; //Pgm type
			$cert[13] = "image/x-portable-pixmap"; //Ppm type
			$cert[14] = "image/x-rgb"; //Rgb type
			$cert[15] = "image/x-xbitmap"; //Xbm type
			$cert[16] = "image/x-xpixmap"; //Xpm type
			$cert[17] = "image/x-xwindowdump"; //Xwd type
			$cert[18] = "image/jpg";
			$cert[19 ] = "image/x-png";
			$log = "";
			#ec#ho $file_array['type'];
			##print_r($file_array);
			#die();
		#	$abpath = $_SERVER['DOCUMENT_ROOT'].$st_imgfile;
			set_time_limit(90);  // resets timeout to 90 seconds on each send
			//Checks if file is an image
			if (in_array($file_array['type'],$cert)) {
			$image_upload_1_file_name=str_replace(" ","_",$file_array['name']); // replaces blanks in the name to underscores
			copy($file_array['tmp_name'], "$path/$image_upload_1_file_name") or $log .= "Couldn't copy image 1 to server<br>";
			if (file_exists("$path/$image_upload_1_file_name")) {
			//echo " path5:  ".$path."/$image_upload_1_file_name"."<br>"  ;
				$log .= "File 1 was uploaded<br>";
			}
			#die($log);
			
			// create thumbnail and resize
			
			} else {
			# $log .= "File 1 is not an image<br>";
			}
			#echo $path.'/'.$image_upload_1_file_name ;#die();
			#print_r($OriginalImage);
			#die();
			return $image_upload_1_file_name;
			}
			
			
			// This is the program that actually resizes the image uploaded with resize_image(). $sizeLarge is the largest any dimension is allowed to be, while maintaining the aspect ratio.
            
            
            
            
            
	function resize_size_step_2($source,$path,$image_upload_1_file_name,$new_file,$sizeLarge,$file_array)
	{
			$cert[1] = "image/pjpeg"; //Jpeg type 1
			$cert[2] = "image/jpeg"; //Jpeg type 2
			$cert[3] = "image/gif"; //Gif type
			$cert[4] = "image/ief"; //Ief type
			$cert[5] = "image/png"; //Png type
			$cert[6] = "image/tiff"; //Tiff type
			$cert[7] = "image/bmp"; //Bmp Type
			$cert[8] = "image/vnd.wap.wbmp"; //Wbmp type
			$cert[9] = "image/x-cmu-raster"; //Ras type
			$cert[10] = "image/x-x-portable-anymap"; //Pnm type
			$cert[11] = "image/x-portable-bitmap"; //Pbm type
			$cert[12] = "image/x-portable-graymap"; //Pgm type
			$cert[13] = "image/x-portable-pixmap"; //Ppm type
			$cert[14] = "image/x-rgb"; //Rgb type
			$cert[15] = "image/x-xbitmap"; //Xbm type
			$cert[16] = "image/x-xpixmap"; //Xpm type
			$cert[17] = "image/x-xwindowdump"; //Xwd type
			$cert[18] = "image/jpg";
			$cert[19 ] = "image/x-png";#echo $source;
			#echo $OriginalImage;
			#die();
			$OriginalImage = null;
			if ($file_array['type']== $cert[1] OR $file_array['type']== $cert[2] OR $file_array['type']== $cert[18]  ){
			$OriginalImage = imagecreatefromjpeg("$source/$image_upload_1_file_name");
			} else if ($file_array['type']== $cert[5] OR $file_array['type']== $cert[19]  ){
			
			$OriginalImage = imagecreatefrompng("$source/$image_upload_1_file_name");
			# Only if your version of GD includes GIF support
			} else if ($file_array['type']== $cert[3] ) {
			$OriginalImage = imagecreatefromgif("$source/$image_upload_1_file_name");
			}else{
			$image_failure_flag=1;
			}
			if(!$image_failure_flag){
			
			$OriginalSize = getimagesize("$source/$image_upload_1_file_name");
			#print_r($OriginalSize);#die();
			$OriginalWidth = $OriginalSize[0];
			$OriginalHeight = $OriginalSize[1];
			$scale1 = min($sizeLarge/$OriginalWidth, $sizeLarge/$OriginalHeight);
			$new_width1= floor($scale1*$OriginalWidth);
			$new_height1= floor($scale1*$OriginalHeight);
			# Create a new temporary image
			$tmp_img1 = imagecreatetruecolor($new_width1, $new_height1); 
			// change the background to white for transparent images
			$ImgWhite1=imagecolorallocate($tmp_img1,$img_bkgd1[r],$img_bkgd1[g],$img_bkgd1[b]);
			imagefill($tmp_img1, 0,0, $ImgWhite1);// create white background
			# Copy and resize old image into new image
			imagecopyresampled($tmp_img1,  $OriginalImage, 0, 0, 0, 0, ($new_width1+1), ($new_height1+1), $OriginalWidth, $OriginalHeight);
			// NOTE: the -2 makes the holding image slightly smaller than the transferred image to eliminate black borders on the smaller image.
			$ThumbImg1 = $tmp_img1;       
			imagedestroy($OriginalImage);
			// imagedestroy($ImgWhite1);  /// added Apr 27, 2010 after memory issues
			#$tempName=explode(".",$image_upload_1_file_name);
			#print_r($tempName);
			
			if($new_file=="")
			{
			$fileName = $image_upload_1_file_name;
			$extension = strtolower(getExt($fileName));
			$randonKeys = keygen(10);
			$newName1 = $randonKeys."_".$sql_List_users."_1_".$randonKeys.".".$extension;
			}
			else
			{
				$newName1 = $new_file;
			}
			#echo $newName1;
			#die();
			$ThumbFileName1="$path/$newName1";
			imagejpeg($ThumbImg1, $ThumbFileName1,99);  
			}else
			{
			  $log.=" <br>Image Thumbnail NOT created - contact webmaster <br>";
			}
			
			#echo $log;
			#die();
			
			return $newName1;
	}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
	function getExt($path)
			{
			$fileName = explode('.',$path);
			$length = count($fileName);
			$extension = $fileName[$length - 1];
			return $extension;
			}

function keygen($length)
			{
			$key = "";
			$pattern = "1234567890BCDFGHJKLMNPQRSTVWXYZbcdfghjklmnpqrstvwxyz";
			$key  = $pattern{rand(0,62)};
			for($i=1;$i<$length;$i++)
			{
			$key .= $pattern{rand(0,62)};
			}
			return $key;
			}	
	
function getMonth($month) {	

	
	$dateOBJ   = DateTime::createFromFormat('!m', $month);
	$MonthName = $dateOBJ->format('F');
	
	return $MonthName;
	/*
	switch($month):
	case 01:
	$value = "January";
	break;
	case 02:
	$value = "February";
	break;
	case 03:
	$value = "March";
	break;
	case 04:
	$value = "April";
	break;
	case 05:
	$value = "May";
	break;
	case 06:
	$value = "June";
	break;
	
	case 07:
	$value = "July";
	break;
	
	case 08:
	$value = "August";
	break;
	case 09:
	$value = "September";
	break;
	case 10:
	$value = "October";
	break;
	case 11:
	$value = "November";
	break;
	case 12:
	$value = "December";
	break;
	return $value;
	endswitch; */
}


///////////////////// Read all "files & (flles in inner directories)" in a directory ///////////////////
function directoryToArray($directory, $recursive) {
    $array_items = array();
    if ($handle = opendir($directory)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                if (is_dir($directory. "/" . $file)) {
                    if($recursive) {
                        $array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $recursive));
                    }
                    $file = $directory . "/" . $file;
                    $array_items[] = preg_replace("/\/\//si", "/", $file);
                } else {
                    $file = $directory . "/" . $file;
                    $array_items[] = preg_replace("/\/\//si", "/", $file);
                }
            }
        }
        closedir($handle);
    }
    return $array_items;
}
//////////////////////////////////////


function ordSuffix($n) { // convert 1, 2 ,3 ,4 to 1st, 2nd, 3rd , 4th 
    $str = "$n";
    $t = $n > 9 ? substr($str,-2,1) : 0;
    $u = substr($str,-1);
    if ($t==1) return $str . 'th';
    else switch ($u) {
        case 1: return $str . 'st';
        case 2: return $str . 'nd';
        case 3: return $str . 'rd';
        default: return $str . 'th';
    }
}


function generateCode($characters) {
  /* list all possible characters, similar looking characters and vowels have been removed */
  $possible = '23456789bcdfghjkmnpqrstvwxyz';
  $code = '';
  $i = 0;
  while ($i < $characters) { 
	 $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
	 $i++;
  }
  return $code;
}


function distanceBetweenPC($dealer_id,$user_id){
    
    
    //echo "Got to line ".__LINE__." in ".__FILE__." dealer_id is $dealer_id and user_id is $user_id <br /><br />";
    
    $sql 			= "select * from dealers where id ='$dealer_id'"; 
		$sqlresult 		= tep_db_query($sql);
		$sqlarray 		= tep_db_fetch_array($sqlresult);
        
        $startPC=str_replace(" ","",$sqlarray['postcode']);
        $dealer_lat=$sqlarray['latitude'];
        $dealer_long=$sqlarray['longitude'];
        
        //echo "Got to line ".__LINE__." in ".__FILE__." dealer_lat is $dealer_lat and dealer_long is $dealer_long <br /><br />";
        
        
         $sql2 			= "select * from members where id ='$user_id'"; 
		$sqlresult2 		= tep_db_query($sql2);
		$sqlarray2 		= tep_db_fetch_array($sqlresult2);
        
        $endPC=str_replace(" ","",$sqlarray2['postalcode']);
        $buyer_lat=$sqlarray2['latitude'];
        $buyer_long=$sqlarray2['longitude'];
        
        
        
       
       $sql3="select (6371 * acos (
cos ( radians($dealer_lat) )
* cos( radians( $buyer_lat ) )
* cos( radians( $buyer_long ) - radians($dealer_long) )
+ sin ( radians($dealer_lat) )
* sin( radians( $buyer_lat ) )
)) as distance";

$sqlresult3 		= tep_db_query($sql3);
		$sqlarray3 		= tep_db_fetch_array($sqlresult3);

return $sqlarray3['distance'];
     
//$aaa=file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=$startPC&destinations=$endPC&key=AIzaSyBXPMFFiEYKAxEPe-SzRFwrwOFDwZ0vvx0");

//  $bbb=json_decode($aaa,true);
  

//return $bbb['rows'][0]['elements'][0]['distance']['text']." calculated ".$sqlarray3['distance']*1.4;


    
}

function get_lat_long($address){
    $address = str_replace(" ", "+", $address);
    $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region&key=AIzaSyBXPMFFiEYKAxEPe-SzRFwrwOFDwZ0vvx0");
    $json = json_decode($json);



    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    $city = $json->{'results'}[0]->{'address_components'}[2]->{'long_name'};
    $province = $json->{'results'}[0]->{'address_components'}[4]->{'short_name'};
    
    return $lat.','.$long.','.$city.','.$province;
}


function enableErrors() {
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
}

function disableErrors() {
	
	error_reporting(0);
	
}

function cleanPhone($phone){
  // formats a phone number into format 1-XXX-XXX-XXXX regardless of input
            $phone=preg_replace('/[^0-9,.]/', '', $phone);
            $bad=array("-","_","(",")",".","/","\\");
            $phone=str_replace($bad,"",$phone);
            $phoneLength=strlen($phone);
            if($phoneLength>10){
                $phone=substr($phone,-10);
            }
            $phone="1-".substr($phone,-10,3)."-".substr($phone,-7,3)."-".substr($phone,-4,4);
            
            return $phone;
}

?>