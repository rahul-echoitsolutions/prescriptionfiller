<?php
class encryption {

var $id 			= '';
var $member_id 		= '';
var $email 			= '';
var $code 			= '';
var $expiry 		= '';
var $table_name 	= 'forgotten_password';


function save(){
	
	
	// removes any previous entries for this email address
	$sqld="delete from $this->table_name where email = '$this->email'";
    
    echo "Got to line ".__LINE__." in ".__FILE__." sqld is $sqld<br /><br />";
	$sqldresult 		= 	tep_db_query($sqld);
		
				$sqlarray = array(
					"id" 			=> $this->id,
					"member_id" 	=> $this->member_id,
					"email" 		=> $this->email,
					"code" 			=> $this->code,
					"expiry" 		=> $this->expiry,

);
		if($this->id>0)	tep_db_perform($this->table_name,$sqlarray,'update',' id="' . $this->id . '"');
		else {
			tep_db_perform($this->table_name,$sqlarray);
			$this->id=tep_db_insert_id();
		}
}


function load($id){
		
		$sql 			= 	"select * from {$this->table_name}  where id=$id";
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);

	if($sqlarray){
					$this->id = isset($sqlarray['id']) ?$sqlarray['id']:'';
					$this->member_id = isset($sqlarray['member_id']) ?$sqlarray['member_id']:'';
					$this->email = isset($sqlarray['email']) ?$sqlarray['email']:'';
					$this->code = isset($sqlarray['code']) ?$sqlarray['code']:'';
					$this->expiry = isset($sqlarray['expiry']) ?$sqlarray['expiry']:'';

	}
}


function loadTest($code){
		
		$sql 			= 	"select * from {$this->table_name}  where code=$code";
		$sqlresult 		= 	tep_db_query($sql);
		$sqlarray 		= 	tep_db_fetch_array($sqlresult);

	if($sqlarray){
					$this->id = isset($sqlarray['id']) ?$sqlarray['id']:'';
					$this->member_id = isset($sqlarray['member_id']) ?$sqlarray['member_id']:'';
					$this->email = isset($sqlarray['email']) ?$sqlarray['email']:'';
					$this->code = isset($sqlarray['code']) ?$sqlarray['code']:'';
					$this->expiry = isset($sqlarray['expiry']) ?$sqlarray['expiry']:'';

	}
}



	var $skey 	= "EveryDog2020"; // you can change it
	
    public  function safe_b64encode($string) {
	
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
	public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
	
    public  function encode($value){ 
		
	    if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }
    
    public function decode($value){
		
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
}