<?php 

require_once("includes/lib/common.php");

require("includes/lib/classes/a/dealers.php");

require("includes/lib/classes/a/prescriptions.php"); 

$prescriptions 		= new prescriptions();

$dealers	= new dealers();

$prescription_id = $request->getvalue('id');

$action = $request->postvalue('action'); 

$rooturl="https://prescriptionfiller.com/";

 

 

 

 

$image=$prescriptions->getImageFromID($prescription_id); 

?>


<img img src="<?php echo "data:image/jpeg;base64, {$image}";?>">