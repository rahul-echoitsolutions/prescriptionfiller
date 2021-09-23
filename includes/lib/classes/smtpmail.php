<?php
class smtpmail{
	var $fromaddress = '';
	var $fromname = '';
	var $toaddress = '';
	var $toname = '';
	var $subject = '';
	var $message = '';
	var $smtpsetting;
	
	function sendEmail() {
		$smtpServer = $this->smtpsetting->server_information;
		$port = $this->smtpsetting->server_port_number==''?'25':$this->smtpsetting->server_port_number;
		$timeout = "45";				 
		$username = $this->smtpsetting->username;
		$password = $this->smtpsetting->password;
		$localhost = "127.0.0.1";	   
		$newLine = "\r\n";			 
		$secure = 0;				  
		
		//connect to the host and port
		/*$smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);
		$smtpResponse = fgets($smtpConnect, 4096);
		
		if(empty($smtpConnect)) {
		   $output = "Failed to connect: $smtpResponse";
		   return $output;
		}
		
		//you have to say HELO again after TLS is started
		fputs($smtpConnect, "HELO $smtpServer". $newLine);
		echo $smtpResponse = fgets($smtpConnect, 4096);

		//request for auth login
		fputs($smtpConnect,"AUTH LOGIN" . $newLine);
		echo $smtpResponse = fgets($smtpConnect, 4096);
		
		//send the username
		fputs($smtpConnect, base64_encode($username) . $newLine);
		echo $smtpResponse = fgets($smtpConnect, 4096);
		
		//send the password
		fputs($smtpConnect, base64_encode($password) . $newLine);
		echo $smtpResponse = fgets($smtpConnect, 4096);
		
		//email from
		fputs($smtpConnect, "MAIL FROM: <$this->fromaddress>" . $newLine);
		echo $smtpResponse = fgets($smtpConnect, 4096);
		
		//email to
		fputs($smtpConnect, "RCPT TO: <$this->toaddress>" . $newLine);
		echo $smtpResponse = fgets($smtpConnect, 4096);
		
		//the email
		fputs($smtpConnect, "DATA" . $newLine);
		echo $smtpResponse = fgets($smtpConnect, 4096);
		
		//construct headers
		$headers = "MIME-Version: 1.0" . $newLine;
		$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;
		$headers .= "To: $this->toname<$this->toaddress>" . $newLine;
		$headers .= "From: $this->fromname<$this->fromaddress>" . $newLine;

		//observe the . after the newline, it signals the end of message
		fputs($smtpConnect, "To: $this->toaddress\r\nFrom: $this->fromaddress\r\nSubject: $this->subject\r\n$headers\r\n\r\n$this->message\r\n.\r\n");
		$smtpResponse = fgets($smtpConnect, 4096);

		
		// say goodbye
		fputs($smtpConnect,"QUIT" . $newLine);
		$smtpResponse = fgets($smtpConnect, 4096);
		fclose($smtpConnect);
		
		//a return value of 221 in $retVal["quitcode"] is a success
		return "Success";
		*/
		

		$smtp_server = $smtpServer;
		$mydomain = "lullaboom.com";


		//get the following info from your mail server eg. au.yahoo.com

		$port = 25; //SMTP PORT of mail.mymailserver.com
		//$username = "username"; $password = "mymail_password";


		$sender = $this->fromaddress;

		/*
		Most respectable mail servers will reject outgoing mail
		if $sender e-mail address does not belong to $username
		*/

		$sender_name = $this->fromname; //Any name you fancy
		$recipient = $this->toaddress;
		$subject = $this->subject;
		$content = $this->message;

// SMTP connection

		$handle = fsockopen($smtp_server,$port);
		fputs($handle, "EHLO $mydomain\r\n");

// SMTP authorization
		fputs($handle, "AUTH LOGIN\r\n");
		fputs($handle, base64_encode($username)."\r\n");
		fputs($handle, base64_encode($password)."\r\n");

// Send out the e-mail
		fputs($handle, "MAIL FROM:$sender\r\n");
		fputs($handle, "RCPT TO:$recipient\r\n");
		fputs($handle, "DATA\r\n");
		fputs($handle, "From: $sender_name<$sender>\r\n");
		
		
		$headers = "MIME-Version: 1.0" . $newLine;
		$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;
		$headers .= "To: $this->toname<$this->toaddress>" . $newLine;
		$headers .= "From: $this->fromname<$this->fromaddress>" . $newLine;

		

//you can use different e-maill address in above line, but most spam blockers will suspect this

		fputs($handle, "To: $recipient\r\n");
		fputs($handle, "Subject: $subject\r\n");
		fputs($handle, "$content\r\n");
		
		fputs($handle, ".\r\n"); 

//Don't ignore the period "." in line above. This indicates the end of your mail

// Close connection to SMTP server
		fputs($handle, "QUIT\r\n");

	}
	
	function coverHeaderFooter($message){
		$html = "<table border=0 width=800px cellpadding=0px cellspacing=0px>";
		$html .= "<tr><td><img src='".HTTP_HOME_URL."files/emailtemplateimages/header.jpg' border=0 /></td></tr>";
		$html .= "<tr><td style='padding:10px;border: solid 1px #c0c0c0;'>".$message."</td></tr>";
		$html .= "</table>";
		return $html;
	}
}
?>