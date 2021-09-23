<?php 

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

$email=$_POST['email'];




$emailTest=$memb->checkIfEmailExists($_POST['email']);



$code=rand(1111111,9999999);
$url= $enc->safe_b64encode($code);


if($emailTest>0){

	$email=$_POST['email'];
	
	//$enc->id 				= $request->postvalue('id');
	$enc->member_id 		= $memb->getUserID($email);
	$enc->email 			= $email;

	$enc->code 				= $code;
	$enc->expiry 			= date("Y-m-d", strtotime(date("Y-m-d")." + 1 day"));

	$enc->save();
	
	$message = '<html><body>';
	
	$message.="You requested a new password at ".SITE_TITLE."<br><br>
	
	Click on the link below to enter a new password.<br><br>
	
	<a href=\"https://".SITE_URL."/restore_password.php?pwdid=$url\" >https://".SITE_URL."/restore_password.php?pwdid=$url</a><br><br>
	
	The ".SITE_TITLE." Team.";
	$message .= '</body></html>';
	$to = $email;
$subject = 'Forgotten Password';
$from = TO;
 
	// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
if(mail($to, $subject, $message, $headers)){
    $success= '<h2>Success</h2>Your request has been sent successfully. You will receive an email. <br><br>
	Please click on the link in the email to renew your password';
}else{
    $error_message.= 'Unable to send email. Please try again.';
}


}else{
	$error_message .="<h2>Error</h2>The email address that you entered was not found in our database.";

}

}
?>

<br /><br /><br /><br /><br /><br /><br /><br /><br />
<section class="well cover bgp-cc ov-80 padding-bottom-60"  id="templates">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 mode-elements-column-hover2 sortableChildren">
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
			
					<div 
				<h2 id="readiness" class="page-section margin-top-60 hero-title-xl text-color-primary margin-bottom-50 headline-sm hoveredSortable" style="display: block; font-size:48px; line-height:48px; color: #119AFF;">Fogotten Password?</h2><br /><br />
				<p style="font-size:18px; color: #119AFF;" class="margin-top-60">Enter Your Email Address</p>
				<div class''>
                    <form method="post" class="login_form" id="NewPasswordForm" >
                        <div class="form-group">
                            
                            <input type="email" class="form-control" id="email_login" style="border: 1px solid #333;" placeholder="" name="email" required>
								   
								   
								   <input type="hidden" name="request" value="verifyEmail">
                     <br />   <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                        </div> 

						

				<div class="col-md-12 text-align-center tie-to-modal">
				</div>
			</div>
		</div>
	</div>
	
</section>

<?php include("includes/footer.php");?>
