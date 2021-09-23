<?php

require("includes/lib/common.php");

$_SESSION['memberID'] = "";
$_SESSION['user_id'] = "";
	
//header("Location: https://".SITE_URL."/index.php?r={$_SESSION['memberID']}");
//header("Location: https://".SITE_URL."/index.php");
// This js is used since location will open the home page in the AJAX container, while this opens it to the full home page.
 echo '<script>window.location = https://'.SITE_URL.'/'.INDEX_PAGE.';</script>
 <body style="background-color:#CCFFFF; background-image: url(https://prescriptionfiller.com/images/doctor-with-tablet-pc-and-prescription-at-clinic-1920-modified2.jpg); background-size:contain; ">
 <div style="text-align:center; margin-top: 200px; font-family: Arial, Verdana, sans-serif">
 <h1>You have been logged out</h1>
 <a href="https://'.SITE_URL.'/'.INDEX_PAGE.'">If not immediately redirected,<br />Click Here and sign in again.</a>
 </div>
 ';


?>
</body>