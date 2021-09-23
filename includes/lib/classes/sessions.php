<?php 

class phpsession {

	protected $sessionID;

	public function __construct(){
		if( !isset($_SESSION) ){
			$this->init_session();
		}
		//session_start();
		//$this->sessionID = session_id();
	}
	
	public function start() {
	
		if( !isset($_SESSION) ){
			$this->init_session();
		}
	}

	public function init_session(){
		session_start();
	}

	public function set_session_id(){
		//$this->start_session();
		$this->sessionID = session_id();
	}

	public function get_session_id(){
		return $this->sessionID;
	}
	
	public function get($name) {
		if(isset($_SESSION[$name])) return $_SESSION[$name];
		else return false;
	}
	
	public function set($name,$value) {
		$_SESSION[$name] = $value;
	}

	public function session_exist( $session_name ){
		
		if( isset($_SESSION[$session_name]) ){
			return true;
		}
		else{
			return false;
		
		}
	}
}