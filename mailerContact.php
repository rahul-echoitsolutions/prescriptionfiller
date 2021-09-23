<?php
	require_once("includes/lib/common.php");
	require("includes/lib/classes/a/forms.php");
	$forms = new forms();
	if($_REQUEST['captcha'] == "") {
            http_response_code(400);
            echo "Please fill captcha first..";
            exit;
    }
 if($_REQUEST['captcha']!=$_SESSION['captcha']) {
            http_response_code(400);
            echo "Sorry - You 've entered an invalid captcha. Please try again..";
            exit;
    }
    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $subject = trim($_POST["subject"]);
        $message = trim($_POST["message"]);
        $application_type = trim($_POST["application_type"]);
        $CASL = trim($_POST["CASL"]);
        $nameArray=explode(" ",$name);
        $first_name=$nameArray[0];
        $last_name=$nameArray[(count($nameArray)-1)];
        if ( empty($name)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Error: Please enter name!";
            exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Error: Please provide valid email address!";
            exit;
        }
        /*if (empty($subject)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Error: Please enter Subject!";
            exit;
        }*/
        if (empty($message) ) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Error: Please enter message! ";
            exit;
        }
        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($subject) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }
       /**
 *  
 *         if ( empty($CASL) ) {
 *             // Set a 400 (bad request) response code and exit.
 *             http_response_code(400);
 *             echo "Oops! You did not check the box allowing us to communicate with you. Please check the approval box and try again.";
 *             exit;
 *         }
 */
        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
       $forms->email        = $email;
       $forms->name         = $name;
       $forms->phone        = $subject;
       $forms->comments     = $message;
       $forms->date         = date('Y-m-d H:i:s');
       $forms->request_type = 'Contact Us - '.$application_type;
       $forms->save();
        $recipient = TO.", ".CC;
        
        
        // Set the email subject.
        $subject = "New contact from $name";
        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Subject: $subject\n";
        $email_content .= "\nMessage:\n$message\n";
        $email_content .= "\nCASL: $CASL\n";
        
        
        
        // Build the email headers.
        $email_headers = "From: $name <$email>". "\r\n" .
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();;
        
    
       
        //$email_headers .= "Cc: ".CC."\n";
        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent...";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }
    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }