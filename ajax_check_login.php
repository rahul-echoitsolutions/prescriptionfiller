<?php
require("includes/lib/common.php");
require("includes/lib/classes/a/members.php");
$members2= new members(); 
	/// For login on home page 5th step section
	if($request->postvalue('ajax_request') == 1) {
		$memberID	=	$members2->verifyLogin($_POST['email'],$_POST['pswd']);
		if($memberID > 1) $_SESSION['memberID']=$memberID;
		echo $memberID; die();
	}
	// signup request from home page ####  Section 5
	if($request->postvalue('signup_request') == 1) {
		 if(!$request->postvalue('signup_lname')){ 
        die;
        }
		$email    = $request->postvalue('signup_name');
		$fname    = $request->postvalue('signup_fname');
		$lname    = $request->postvalue('signup_lname');
        $phone    = $request->postvalue('signup_phone');
		$pass 	  = $request->postvalue('signup_password');
		$long 	  = $request->postvalue('signup_longitude');
		$lat 	  = $request->postvalue('signup_latitude');
		$members2->first_name         = $fname;
		$members2->last_name          = $lname;
		$members2->email              = $email;
        $members2->home_phone         = $phone;
		$members2->password           = md5($pass);
		$members2->latitude	          = $lat;
		$members2->longitude          = $long;
		if($members2->emailExists($email) == 1) {
			echo "error_email_exists"; die();
		}
		$members2->save();
		$_SESSION['memberID']=$members2->id;
		echo $members2->id; die();
	}
	if($request->postvalue('action') == 'verifyLogin') {
        // Login Request from Header Popup !
		$memberID=$members2->verifyLogin($_POST['email'],$_POST['pswd']);
		if($memberID>=3){
			$_SESSION['memberID'] = $memberID;
			$_SESSION['user_id']  = $memberID;
			echo "<div style='margin:10px; padding:10px; background-color:#CCFFCC; border:thin solid green; border-radius: 10px; text-align:center;'>Logged In Successfully.</div>";
		echo"<div style=\"height:130px !important; width:100%;  background-color:lightblue;text-align:center; color:#000;\"><br /> <h3><a href=\"buyers_dashboard.php?id=".$_SESSION['memberID']."&action=dealer-offers&success=$success\" style=\"font-family: Arial; color: #000; \">If you are not immediately redirected, please click HERE </a></h3></div>";
			echo "<script>   
					window.location.href = 'buyers_dashboard.php?action=prescriptions&id={$_SESSION['memberID']}';
				</script>";
			die();
		}else{
			echo "<div style='margin:10px; padding:10px; background-color:#FEA6A6; border:thin solid red; border-radius: 10px;'>Your login was not successful</div>";
			?>
			<div style="height:100% !important; width:100%; padding-bottom: 1500px; background-color:lightblue;text-align:center; color:#000;"><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /> <a href="https://<?php echo THIS_DOMAIN;?>/index.php" style=" margin-top:100px !important; font-family: Arial; color: #000; "><h3>Click HERE to return to the home page. </a></h3></div>
	<?php }
	}
?>