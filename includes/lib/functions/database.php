<?php
/*
	database.php
*/

  function tep_db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link') {
    global $$link;

    if (@USE_PCONNECT == 'true') {
      $$link = mysqli_connect($server, $username, $password,$database);
    } else {
        
      $$link = mysqli_connect($server, $username, $password,$database);

    }


        //if ($$link) mysql_select_db($database);   return $$link;
        return $$link;
  }

  function tep_db_close($link = 'db_link') {
    global $$link;

    return mysqli_close($$link);
  }

  function tep_db_error($query, $errno, $error) {
  	global $request;
	echo $error;
	$saveerror = '<font color="#000000"><b>' . $errno . ' - ' . $error . '<br><br>' . $query . '<br><br><small><font color="#ff0000">[TEP STOP]</font></small><br><br></b></font>';
	$saveerror .= '-----------------------------------------------------------<br>';
	errorLog($saveerror);
	$request2 = new phprequest();
	if($request2->servervalue('HTTP_HOST')!='localhost:81'){
		die('<center><font color="#ff0000">'.$saveerror.'</font></center>');
	}else{
		die('<font color="#000000"><b>' . $errno . ' - ' . $error . '<br><br>' . $query . '<br><br><small><font color="#ff0000">[TEP STOP]</font></small><br><br></b></font>');
	}
  }

  function tep_db_query($query, $link = 'db_link') {
    global $$link;

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
      error_log('QUERY ' . $query . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }
    
    $result = mysqli_query($$link,$query) or tep_db_error($query, mysqli_errno($$link), mysqli_error($$link));

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
       $result_error = mysqli_error($$link);
       error_log('RESULT ' . $result . ' ' . $result_error . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    return $result;
  }

  function tep_db_perform($table, $data, $action = 'insert', $parameters = '', $link = 'db_link') {
    reset($data);
   
    if ($action == 'insert') {
      $query = 'insert into ' . $table . ' (';
      while (list($columns, ) = each($data)) {
        $query .= $columns . ', ';
      }
      $query = substr($query, 0, -2) . ') values (';
      reset($data);
      while (list(, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= 'now(), ';
            break;
          case 'null':
            $query .= 'null, ';
            break;
          default:
            $query .= '\'' . tep_db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ')';
       
    } elseif ($action == 'update') {
      $query = 'update ' . $table . ' set ';
      while (list($columns, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= $columns . ' = now(), ';
            break;
          case 'null':
            $query .= $columns .= ' = null, ';
            break;
          default:
            $query .= $columns . ' = \'' . tep_db_input($value) . '\', ';
            break;
        }
      }
       
      $query = substr($query, 0, -2) . ' where ' . $parameters;
    }
    #echo $query;
	#die();
    return tep_db_query($query, $link);
  }

  function tep_db_fetch_array($db_query) {
    return mysqli_fetch_array($db_query);
  }
  function tep_db_fetch_assoc($db_query) {
    return mysqli_fetch_assoc($db_query);
  }
  function tep_db_num_rows($db_query) {
    return mysqli_num_rows($db_query);
  }

  function tep_db_data_seek($db_query, $row_number) {
    return mysqli_data_seek($db_query, $row_number);
  }

  function tep_db_insert_id($link = 'db_link') {
    global $$link;
    return mysqli_insert_id($$link);
  }

  function tep_db_free_result($db_query) {
    return mysqli_free_result($db_query);
  }

  function tep_db_fetch_fields($db_query) {
    return mysqli_fetch_field($db_query);
  }

  function tep_db_output($string) {
    return htmlspecialchars($string);
  }
  
  function tep_db_result_row($db_query,$link = 'db_link') {
    global $$link;
  	$result = mysqli_query($$link,$db_query);
	$row = NULL;
  	if($result){
  		$row = mysqli_fetch_row($result);
  	}
    return $row;
  }

 //function tep_db_input($string) {
  //  return addslashes($string);
 // }
 function tep_db_input($string, $link = 'db_link') {
  global $$link;
 
    if (function_exists('mysql_real_escape_string')) {
    return mysqli_real_escape_string($$link,$string);
    } elseif (function_exists('mysql_escape_string')) {
    return mysqli_escape_string($string);

    }
 
  return addslashes($string);
}

   function tep_db_prepare_input($string) {
    if (is_string($string)) {
	  $search_array = array('"',"'");
	  $replace_array = array('\"',"\'");
	  $string = str_replace($search_array,$replace_array,$string);
      return trim(stripslashes($string));
      //return trim(tep_sanitize_string(stripslashes($string)));
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
		$search_array = array('"',"'","(",")");
		$replace_array = array('\"',"\'","","");
		$value = str_replace($search_array,$replace_array,$value);
        $string[$key] = tep_db_prepare_input($value);
      }
      return $string;
    } else {
      return $string;
    }
  }
  function errorLog($content){
  	global $request;
	$request2 = new phprequest();
	
  	$content = "<b>Path : " . $request2->servervalue('PHP_SELF') . "<br>Date : " . date('m-d-Y h:i:s') . "<br></b>" . $content;
	if(!file_exists('admin/log.php'))$content = "<?php require('includes/common.php');?>" . $content;
	else{
		$fileContent = @file_get_contents('admin/log.php');
		if($fileContent=='')$content = "<?php require('includes/common.php');?>" . $content;
	}
  	@file_put_contents('admin/log.php',$content,FILE_APPEND);
  }
?>
