<?php

error_reporting(0);
ini_set('display_errors', 0);

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

  define('HTTP_SERVER', 'http://localhost/prescriptionfiller/');
  define('HTTPS_SERVER', 'http://localhost/prescriptionfiller/');
  define('ENABLE_SSL', false); // secure webserver for checkout procedure?
  define('HTTP_HOME_URL', 'http://localhost/prescriptionfiller/'); 
  define('HTTP_ADMIN_URL', 'http://localhost/prescriptionfiller/admin/');
  define('THIS_DOMAIN', 'http://localhost/prescriptionfiller');
  define('SITE_DESCRIPTION', 'PrescriptionFiller.com. The new, better way to order your prescriptions.');
  define('DIR_WS_ADMIN', 'admin/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', 'boxes/');
  define('DIR_WS_FUNCTIONS', 'functions/');
  define('DIR_WS_CLASSES', 'classes/');
  define('DIR_WS_MODULES', 'modules/');
  define('DIR_WS_LANGUAGES', 'languages/');
  define('DIR_WS_JAVASCRIPT', 'javascript/');
  
  define('INDEX_PAGE', 'home.php');
  

  define('SITE_TITLE','PrescriptionFiller.com');
  define('SITE_URL','prescriptionfiller.com');
  define('SITE_LOGO','logo.svg');

  
  define('SENDMAIL_FROM','');
  
  $page = basename($_SERVER['PHP_SELF']);

  // define our database connection
  define('DB_SERVER', 'localhost'); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '');
  define('DB_DATABASE', 'pfill_homestead');
  
  
  
   /* define our database connection
  define('DB_SERVER', 'localhost'); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', 'pfill_data1');
  define('DB_SERVER_PASSWORD', 'Q3gNY4jyzH7V');
  define('DB_DATABASE', 'pfill_data');
  
  */
  
  
  
  
  
  
  
  define('SITE_USERNAME', 'pfill');
  
  define('TO', 'info@prescriptionfiller.com');
  
  //define('CC','');
  
  

  ini_set('date.timezone', 'America/Los_Angeles');
  


	define('ISLOCAL','true'); // false
?>