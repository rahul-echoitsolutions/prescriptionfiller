<?php
class phprequest{
	var $VARS;
	
	function phprequest(){
		if (version_compare(phpversion(), "4.1.0", "<") === true) {
			$this->VARS["GET"]=&$GLOBALS["HTTP_GET_VARS"];
			$this->VARS["POST"]=&$GLOBALS["HTTP_POST_VARS"];
			$this->VARS["COOKIE"]=&$GLOBALS["HTTP_COOKIE_VARS"];
			$this->VARS["SERVER"]=&$GLOBALS["HTTP_SERVER_VARS"];
		} else {
			$this->VARS["GET"]=&$_GET;
			$this->VARS["POST"]=&$_POST;
			$this->VARS["COOKIE"]=&$_COOKIE;
			$this->VARS["SERVER"]=&$_SERVER;
		}
	}
	function getvalue($name,$type='string',$default=''){
		return $this->_value($name,$type,"GET",$default);
	}
	function postvalue($name,$type='string',$default=''){
    
		return $this->_value($name,$type,"POST",$default);
	}
	function cookievalue($name,$type='string',$default=''){
		return $this->_value($name,$type,"COOKIE",$default);
	}
	function servervalue($name,$type='string',$default=''){
		if (!isset($this->VARS["SERVER"][$name])) return $default;
		return $this->VARS["SERVER"][$name];
	}
	function setvalue($name,$value,$var){
		if (!isset($this->VARS[$var])) return;
		$this->VARS[$var][$name]=$value;
	}
	function unsetvalue($name,$var){
		if (!isset($this->VARS[$var])) return;
		unset($this->VARS[$var][$name]);
	}
	function setcookie($name, $value = '', $expire = 0, $path = '/', $domain = '', $secure = 0){
		setcookie($name, $value, $expire, $path, (tep_not_null($domain) ? $domain : ''), $secure);
	}
	function _value($name,$type,$var,$default=''){
		if (!isset($this->VARS[$var][$name])) return $default;
		switch($type){
			case 'int':
				return ((int) $this->VARS[$var][$name]);
			case 'float':
				return ((float) $this->VARS[$var][$name]);
			case 'date':
			default:
				return tep_db_prepare_input($this->VARS[$var][$name]);
			
		}
	}
	function searchvalue($name,$type='string',$default='',$searches=array()){
		for ($icnt=0,$n=count($searches);$icnt<$n;$icnt++){
			$temp=&$this->VARS[$searches[$icnt]];
			if (isset($temp[$name])) return $this->_value($name,$type,$searches[$icnt]);
		}
		return $default;
		
	}

	function geturl(){
		return $_SERVER['REQUEST_URI'];
	}
}
?>