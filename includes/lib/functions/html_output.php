<?php
/*
	html_output.php
*/
////

	function tep_server_url(){
		global $request_type;
		if ($request_type=="SSL")
			return HTTPS_SERVER . DIR_WS_HTTP_CATALOG;
		else
			return HTTP_SERVER . DIR_WS_HTTP_CATALOG;
		
	};
// The HTML href link wrapper function
  function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
    global $request_type, $session_started, $SID,$request;

	if($request->servervalue('HTTP_HOST')=='localhost:81' && $connection=='SSL'){
		$connection = 'NONSSL';
	}

	$link=DIR_WS_HTTP_CATALOG . $page;
    if (tep_not_null($parameters)) {
    	if(strpos($link,'?')>0){
    		$link .= '&' . tep_output_string(str_replace("&","&",$parameters));	
    	}else{
    		$link .= '?' . tep_output_string(str_replace("&","&",$parameters));
    	}
      
    } 
	//return $link;
    if (!tep_not_null($page)) {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>');
    }
    if ($parameters!='') $parameters=trim($parameters,"/");
    if ($connection == 'NONSSL') {
      $link = HTTP_HOME_URL;
	  
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == 'true') {
        $link = HTTP_HOME_URL;
      } else {
        $link = HTTP_HOME_URL;
      }
    } else {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL</b><br><br>');
    }

    if (tep_not_null($parameters)) {
    	if(strpos($page,'?')>0){
    		$link .= $page . '&' . tep_output_string($parameters);	
    	}else{
    		$link .= $page . '?' . tep_output_string($parameters);
    	}
      
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False') ) {
      if (tep_not_null($SID)) {
        $_sid = $SID;
      } elseif ( ( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true) ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') ) ) {
        if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
          $_sid = tep_session_name() . '=' . tep_session_id();
        }
      }
    }
  
	if ($GLOBALS["SEO_URL"]->enabled && $search_engine_safe == true){
      while (strstr($link, '&&')) $link = str_replace('&&', '&', $link);

      $link = str_replace('?', '/', $link);
      $link = str_replace('&', '/', $link);
      $link = str_replace('=', '/', $link);

      $separator = '?';
      $link = $GLOBALS["SEO_URL"]->convert_seo_url($link);
	}
	//echo $link . "<br>";
    if (isset($_sid)) {
	  $link .= $separator . tep_output_string($_sid);
    }
    return $link;
  }

////
// The HTML image wrapper function
  function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '',$sizes=true,$resize=false) {
    //if ((!file_exists($src)) || (strpos($src,".")<=0) ||  (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
    //  return false;
    //}

    $image = '<img border="none" src="' . tep_output_string($src) . '" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) {
      $image .= ' title=" ' . tep_output_string($alt) . ' "';
    }

    if ($sizes && !($resize) && tep_not_null($width) && tep_not_null($height)) {
      $image .= ' width="' . tep_output_string($width) . '" height="' . tep_output_string($height) . '"';
    }
	if($resize){
		$image_size = array();
		if(file_exists($src) && $src!='')$image_size = @getimagesize($src);
		if($image_size[0]>$image_size[1])$image .= ' width="' . $width . '"';
		else if($image_size[1]>$image_size[0])$image .= ' height="' . $height . '"';
		else if($image_size[1]==$image_size[0])$image .= ' width="' . $width . '" height="' . $width . '"';
	}

    if (tep_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= '/>';

    return $image;
  }
	function tep_background_image($img){
		return "background-image: url(" . $img . ");";
	}

////
// The HTML form submit button wrapper function
// Outputs a button in the selected language
  function tep_image_submit($image, $alt = '', $parameters = '') {
    
    global $language;
    $image_submit = '<input style="border:none;" type="image" src="' . tep_output_string(DIR_WS_IMAGES . '/buttons/' . $image) . '" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';

    if (tep_not_null($parameters)) $image_submit .= ' ' . $parameters;
     $image_submit .= '/>';

    
    return $image_submit;
  }

////
// Output a function button in the selected language
  function tep_image_button($image, $alt = '', $parameters = '') {
    global $language;

    return tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
  }

////
// Output a separator either through whitespace, or with an image
  function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
    return tep_image(DIR_WS_IMAGES . $image, '', $width, $height);
  }

////
// Output a form
  function tep_draw_form($name, $action, $method = 'post', $parameters = '') {
  	global $_SESSION;
    $form = '<form name="' . tep_output_string($name) . '" action="' . tep_output_string($action) . '" method="' . tep_output_string($method) . '"';

    if (tep_not_null($parameters)) $form .= ' ' . $parameters;

    $form .= '>';
	
    return $form;
  }

////
// Output a form input field
  function tep_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
    $field = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
      $field .= ' value="' . tep_output_string(stripslashes($GLOBALS[$name])) . '"';
    } elseif (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '/>';

    return $field;
  }

////
// Output a form password field
  function tep_draw_password_field($name, $value = '', $parameters = 'maxlength="40"') {
    return tep_draw_input_field($name, $value, $parameters, 'password', false);
  }

////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
  function tep_draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '',$style='') {
    $selection = '<input style="border:none;background:none;' . $style . '" type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) $selection .= ' value="' . tep_output_string($value) . '"';

    if ( ($checked == true) || ( isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && ( ($GLOBALS[$name] == 'on') || (isset($value) && (stripslashes($GLOBALS[$name]) == $value)) ) ) ) {
      $selection .= ' CHECKED';
    }

    if (tep_not_null($parameters)) $selection .= ' ' . $parameters;

    $selection .= '/>';

    return $selection;
  }

////
// Output a form checkbox field
  function tep_draw_checkbox_field($name, $value = '', $checked = false, $parameters = '',$style='') {
    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $parameters,$style);
  }

////
// Output a form radio field
  function tep_draw_radio_field($name, $value = '', $checked = false, $parameters = '',$style='') {
    return tep_draw_selection_field($name, 'radio', $value, $checked, $parameters,$style);
  }

////
// Output a form textarea field
  function tep_draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
    $field = '<textarea name="' . tep_output_string($name) . '" wrap="' . tep_output_string($wrap) . '" cols="' . tep_output_string($width) . '" rows="' . tep_output_string($height) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
  		$field .= tep_output_string_protected(stripslashes($GLOBALS[$name]));
	  } elseif (tep_not_null($text)) {
		$field .= tep_output_string_protected($text);
      }

$field .= '</textarea>';

    return $field;
  }

////
// Output a form hidden field
  function tep_draw_hidden_field($name, $value = '', $parameters = '') {
    $field = '<input type="hidden" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    } elseif (isset($GLOBALS[$name])) {
      $field .= ' value="' . tep_output_string(stripslashes($GLOBALS[$name])) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '/>';

    return $field;
  }

////
// Hide form elements
  function tep_hide_session_id() {
    global $session_started, $SID;

    if (($session_started == true) && tep_not_null($SID)) {
      return tep_draw_hidden_field(tep_session_name(), tep_session_id());
    }
  }

////
// Output a form pull down menu
  function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {      

    $field = '<select name="' . tep_output_string($name) . '"';
    if ($required == true){ $field .= TEXT_FIELD_REQUIRED;}

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && isset($GLOBALS[$name])) $default = stripslashes($GLOBALS[$name]);
    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
      $field .= '<option value="' . tep_output_string($values[$i]['id']) . '"';
      if ($default == tep_output_string($values[$i]['id'])) {
        $field .= ' SELECTED';
      }
	  if (isset($values[$i]['style'])) $field.=' style="' . $values[$i]['style'] . '"';

      $field .= '>' . tep_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>'; 
    }
    $field .= '</select>';
    
    return $field;
  }

////
// Creates a pull-down list of countries
  function tep_get_country_list($name, $selected = '', $parameters = '') {
    $countries_array = array(array('id' => '0', 'text' => PULL_DOWN_DEFAULT));
    $countries = tep_get_countries();

    for ($i=0, $n=sizeof($countries); $i<$n; $i++) {
      $countries_array[] = array('id' => $countries[$i]['countries_id'], 'text' => $countries[$i]['countries_name']);
    }

    return tep_draw_pull_down_menu($name, $countries_array, $selected, $parameters);
  }
  function tep_load_template_content($filename){
  	 $file_path=DIR_FS_CATALOG . DIR_WS_TEMPLATES . TEMPLATE_NAME . "/content/" . $filename;
	 $require_path=DIR_WS_TEMPLATES . TEMPLATE_NAME . "/content/" . $filename;
	 if (!file_exists($file_path)) return "";
  	 $content=@file_get_contents($file_path);
	 if ($content==""){
	 	ob_start();
		require($require_path);
		$content=ob_get_contents();
		ob_end_clean();
	 }
	 return $content;
  }
?>
