<?php
/*
	sessions.php
*/
  class phpsession {
    var $name;
    var $save_path;
    var $lifetime;
    var $cookie_path;
    var $cookie_domain;
	var $started;
	var $ID;
	var $VARS;
	var $request_type;
    function phpsession() {

		/*$this->lifetime=1440;
		$this->name='phpsid';
		$this->save_path="/tmp";
		$this->cookie_path="/";
		$this->cookie_domain="";
		$this->request_type='NONSSL';
		
		$this->started=false;
		ini_set('register_globals','0');
		*/
    }

        
        
        function start(){

  $request=&$GLOBALS["request"];
  
  if(session_name() != '' && $this->name == ''){
   $this->name = session_name();
  } else if($this->name == ''){
   $this->name = 'EXAMPLE';
  }
        
        

		session_save_path($this->save_path);

		if (function_exists('session_set_cookie_params')) {
			session_set_cookie_params(0, $this->cookie_path,$this->cookie_domain);
		} elseif (function_exists('ini_set')) {
			ini_set('session.cookie_lifetime', '0');
			ini_set('session.cookie_path', $this->cookie_path);
			ini_set('session.cookie_domain', $this->cookie_domain);
		}
		
		//check if session id present in query or post string
		$searches=array('POST');

		if ($this->request_type=='SSL') $searches[]='GET';
		$searches[]='COOKIE';
				//print_r($searches); exit();
		$session_id=$request->searchvalue($this->name,'string','',$searches);
        
        
        
        
        
        
        
        
        
        

		if ($session_id!=''){
			if (preg_match('/^[a-zA-Z0-9]+$/',$session_id)==false){
				$request->unsetvalue($this->name,'GET');
				$request->setcookie($this->name, '', time()-42000, $this->cookie_path, $this->cookie_domain);
			} else {
				session_id($session_id);
			}
		}
		
		$this->started=true;
		$this->ID=session_id();

		if (version_compare(phpversion(), "4.1.0", "<") === true) {
			$this->VARS=&$GLOBALS["HTTP_SESSION_VARS"];
		} else {
			$this->VARS=&$_SESSION;
		}

		
		if (count($this->VARS)>0){
			reset($this->VARS);
			foreach($this->VARS as $key=>$value){
				if (!is_object($value)) $this->$key=$value;
			}
		}
	}
	function getSessionName($name = '') { 
		if (!empty($name)) {
			return session_name($name);
		} else {
			return session_name();
		}
	}
	
	function close(){
		session_write_close();
	}
	function destroy(){
		session_destroy();
	}
	function _OPEN($save_path, $session_name) {
		return true;
	}

	function _CLOSE() {
		return true;
	}

	function set($name,$value){
		
		$this->VARS[$name]=$value;
		if (!is_object($value)) $this->$name=$value;
	}
	function get($name,$default=''){

		if (isset($this->VARS[$name])){
			return $this->VARS[$name];
		} else {
			return $default;
		}
	}
	function remove($name){
		unset($this->VARS[$name]);
	}
	function &getobject($name,$default=false){
		if (isset($this->VARS[$name])){
			return $this->VARS[$name];
		} else {
			return $default;
		}
	}
	function is_registered($name){
		if (isset($this->VARS[$name])){
			return true;
		} else {
			return false;
		}
	}
  }
?>