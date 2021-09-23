<?php
require_once("includes/lib/common.php");

require("includes/lib/classes/a/physicians.php"); 
require("includes/lib/classes/a/prescriptions.php");
$physicians 		= new physicians();
$prescriptions	= new prescriptions();
$physicians_id = $request->getvalue('id');
$action = $request->postvalue('action'); 
$rooturl="https://prescriptionfiller.com/";
require_once("Mobile-Detect-2.8.34/Mobile_Detect.php");
$detect = new Mobile_Detect;
if($detect->isMobile()){
    $a=1;
    $is_mobile=1;
}
if(strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')){
    $browser="Firefox";
}


       $options=array();
       $options['order_by']="";
$doctorlist= $prescriptions->getDoctorsList($_SESSION['user_id']);

$options=array();
$options['order_by']="last_name";
$options['sort_direction']="ASC";
$doclist = $physicians->getlistUser($doctorlist,$options);

function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}
   

echo "<section class=\"ff_faqs\">
<div id=\"accordion\">";
$xxi=0;
?>
<style>
.inline{
   display:inline-block;
}
.outline{
    border:1px solid #ccc;
    padding: 20px;
}
table th{
    width:160px;
    
}
.email{
    width:250px !important;
   
}
.submit{
        background-color:#2681db;
        border:none;
        border-radius:5px;
        padding:10px 60px;
        color:#fff;
        margin-bottom:50px;
        margin-top: 20px;
    }

</style>
<div class="page-content col-lg-12 col-md-12" id="dealerApp"> 
          <div class="page-content">
         
            <div class="col-md-12">  
            
            

<section>
<div class="container">
<h2>Your Physicians</h2>

<table>
<tr>
<th>Physician Name</th><th>Address</th><th>City</th><th>Phone Number</th><th class="email">Email</th><th>Specialty</th>

</tr>
<tr>
<?php 


foreach($doclist as $doc){
 echo "<td>".$doc['first_name']." ".$doc['last_name']."</td><td>".$doc['address']."</td><td>".$doc['city']."</td><td>".$doc['phone1']."</td><td>".$doc['email']."</td><td>".$doc['specialty']."</td></tr><tr>";

	                   }
                    ?>
                    </table>
          
                    </div>
                    <div style="margin-top:  20px;">
<a href="add_doctor.php" class="submit" >Add A New Doctor</a>
</div>
                
</section>

    </div>
    </div>