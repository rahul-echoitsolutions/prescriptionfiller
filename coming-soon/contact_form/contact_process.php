<?php

include dirname(dirname(__FILE__)).'/mail.php';

error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
include 'email_validation.php';

$name = stripslashes($_POST['name']);
$email = trim($_POST['email']);

$error = '';

// Check name

if(!$name)
{
$error .= 'Please enter your name.<br />';
}

// Check email

if(!$email)
{
$error .= 'Please enter an e-mail address.<br />';
}

if($email && !ValidateEmail($email))
{
$error .= 'Please enter a valid e-mail address.<br />';
}

if(!$error)
{
$mail = mail(CONTACT_FORM, $subject,
     "From: ".$name." <".$email.">\r\n");
 
if($mail)
{
echo 'OK';
}

}
else
{
echo '<div class="notification_error">'.$error.'</div>';
}

}
?>