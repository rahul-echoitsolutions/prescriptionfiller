<?php
		require("../includes/lib/common.php");
        $resource=$_SESSION['mode'];
		$session->set('user_id'		,'');
		$session->set('login_name'	,'');
		$session->set('mode'		,'');
        if($resource=="dealer"){
            unset($resource);
        header("Location:login_dealer.php");
        }elseif($resource=="admin"){
            unset($resource);
		header("Location:login.php");
        }else{
         header("Location:index.php");   
        }
		exit();
?>