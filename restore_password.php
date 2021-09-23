<?php 
if(session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if($_GET['pwdid']){
$_SESSION['pwdid']=$_GET['pwdid'];
}
$head="
<style>
p {
	margin-bottom:20px;
}

</style>";
$pageTitle="Forgotten Password";
include("includes/head.php");
include("includes/header.php");;
require_once("includes/lib/classes/a/members.php");
include("includes/lib/classes/a/encryption.php");
$memb= new members();
$enc = new encryption();



if($_POST['request']){

$request=urldecode($_GET['request']);

$password=$_POST['password'];


$password_confirm=$_POST['password_confirm'];

if($password!=$password_confirm){
	$error_message.="Your passwords do not match. Please reenter your password.";
}





$code=$enc->safe_b64decode($_SESSION['pwdid']);



$enc->loadTest($code);


if($enc->member_id>0 AND $enc->expiry>=date("Y-m-d") AND !$error_message){
	

	
	$memb->savePassword($enc->member_id,$password);
		
		
		
		
	
	
	
	
	
	
	
	
	$message = '<html><body>';
	
	$message.="Your password was updated at ".SITE_TITLE."<br><br>
	
	If you did not make this change, please go to our site and change your password and notify our management by sending a note from our Contact Us page.<br><br>
	
		The ".SITE_TITLE." Team.";
	$message .= '</body></html>';
	
	$to = $enc->email;
$subject = 'Restored Password';
$from = TO;
 
	// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
if(mail($to, $subject, $message, $headers)){
    $success= '<h2>Success</h2>Your password was successfully updated.';
}else{
    $error_message.= 'Unable to update your password. Please try again.';
}


}else{
	$error_message .="<h2>Error</h2>Our system was not able to update your password. You must update your password within 24 hours of receiving your notice.";

}

}
?>


<section class="well cover bgp-cc ov-80 padding-bottom-60" style="display: block; color: rgb(0, 0, 0);" id="templates">
	<div class="container">
		<div class="row">
			<div class=" col-md-offset-1 col-md-10 mode-elements-column-hover2 sortableChildren" style="margin-top:  200px;">
			<?php 
			if($error_message){
				$style=" style=\"padding:30px; min-height:300; text-align:center; font-size:24px; background-color:red; color:#fff; border-radius:20px; margin-bottom:30px;\"";
			}
			
			if($success){
				$style=" style=\"padding:30px; min-height:300; text-align:center; font-size:24px; background-color:#92D78A; color:#000; border-radius:20px; margin-bottom:30px;\"";
			}
				if($success OR $error_message){
					
					echo "<div $style>$success $error_message</div>";
					
				}
				
			
			
			?>
			
					<div >
				<h2 id="readiness" class="page-section margin-top-100 hero-title-xl text-color-primary margin-bottom-50 headline-sm hoveredSortable" style="display: block; font-size:3em;">Restore Password?</h2><br /><br />
				<p>Enter Your New Password</p><br />
				<div class''>
                    <form method="post" class="login_form" id="NewPasswordForm" >
                        <div class="form-group">
                            
                            <input pattern=".{8,20}" title="8 characters minimum. 20 characters maximum" type="password" class="form-control" id="password" placeholder="" name="password" required>
							<p>Please confirm Your New Password</p><br />
							
							
							
								<input pattern=".{8,20}" title="8 characters minimum. 20 characters maximum" type="password" class="form-control" id="password_confirm" placeholder="" data-match="#password" data-match-error="Whoops, these don't match" name="password_confirm" required>   
								   
								   <input type="hidden" name="request" value="newPassword">
                      <br /><br />  <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                        </div> 

						

				<div class="col-md-12 text-align-center tie-to-modal">
				</div>
			</div>
		</div>
	</div>
	
</section>

<?php include("includes/footer.php");?>
