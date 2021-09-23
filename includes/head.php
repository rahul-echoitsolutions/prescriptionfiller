<?php 
/*if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);*/
require("includes/lib/common.php");
require("includes/lib/classes/a/contents.php"); 
require("includes/lib/functions/submenuBuilder.php"); 

$contents = new contents();
$content_id = $request->getvalue('page');
require("includes/lib/classes/a/faq.php"); 

$FAQList   =   new FAQS(); 
$catList= $FAQList->getcategories();
?> <!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]--><!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang='en'>
<head>
<meta charset='utf-8'/>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"/> 
<link rel="canonical" href="https://prescriptionfiller.com"/>
<?php
  if($content_id != '') {
    if($content_id > 0){
        $contents->load($content_id);
    }else{ 
        $contents->load($content_id,'key');
        }
    if(strlen($contents->wysiwyg_meta)>10){  
        echo $contents->wysiwyg_meta; 
    }else{
      echo "<title>Prescription Filler - the best way to fill your prescriptions\" content=\"Prescription Filler - The new, easy way to fill your prescriptions.\" />
<meta content=\"General\" name=\"Rating\" />
<meta name=\"language\" content=\"English\" />
";
    }   
    if($contents->nofollow == 1){ 
    echo '<meta name="robots" content="nofollow" />';}
}else{
    echo '<meta name=\"googlebot\" content=\"index,follow\" />';
}


?> 


<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.1.3/cosmo/bootstrap.min.css ">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_HOME_URL;?>css/style.css" media="screen">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>



<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">


<link href="<?php echo HTTP_HOME_URL;?>css/style1.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo HTTP_HOME_URL;?>css/swiper.min.css" type="text/css">

<?php
	
//<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css ">

?>
<link rel="stylesheet" href="<?php echo HTTP_HOME_URL;?>admin/css/light/jquery.datatables.css">

<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
<link rel="manifest" href="images/favicon/site.webmanifest">
<link rel="mask-icon" href="images/favicon/safari-pinned-tab.svg" color="#ff0000">
<link rel="shortcut icon" href="images/favicon/favicon.ico">
<meta name="msapplication-TileColor" content="#00aba9">
<meta name="msapplication-config" content="images/favicon/browserconfig.xml">
<meta name="theme-color" content="#ffffff">




 <?php
 
 
$head.="<style>
.nav-link{
    padding: 0.5rem 0rem;
    }
</style>";
 
echo $head;
	// note </head> in header.php
?>