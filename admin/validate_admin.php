<?php
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php");

$user	= new users();
$mode	= $request->postvalue('mode'); // to check if a user is admin / writer ///
if($mode=='') {
    echo "<h2>NOT AUTHORIZED></h2>";
    }

 
	$user->login_name 	= $request->postvalue('username');
	$user->password   	= md5($request->postvalue('password'));
	$result 			= $user->validate_user();
    //$result = 'active';
	if($result=='active'){	
		$session->set('user_id',$user->user_id);
		$session->set('login_name',$user->login_name);
		$session->set('mode','admin');
	}
   if($result<>"invalid"){
	echo $result;
    }

?>