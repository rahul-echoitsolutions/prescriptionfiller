<?php

require_once("includes/lib/common.php");

require("includes/lib/classes/a/dealers.php");

require("includes/lib/classes/a/prescriptions.php"); 

$prescriptions 		= new prescriptions();

$dealers	= new dealers();

$prescription_id = $request->getvalue('id');

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

$scriptlist= $prescriptions->getlistMember($options,$_SESSION['memberID']);



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

.pharmName{

    width:250px !important;

   

}

.submit{

        background-color:#2681db;

        border:none;

        border-radius:5px;

        padding:10px 60px;

        color:#fff;

       

    }

</style>





<div class="page-content col-lg-12 col-md-12" id="dealerApp"> 

          <div class="page-content">

         

            <div class="col-md-12">  

            

            







<section>

<div class="container">

<h2>Your Prescriptions</h2>



<table class="datatable">

<tr>

<th>Date Entered</th><th>Physician</th><th class="pharmName">Pharmacy</th><th>Description</th><th>Status</th><th>Delivery Status</th><th>Review Status</th><th>Image</th><th>Action</th>



</tr>

<tr>

<?php 

   



foreach($scriptlist as $presc){
	
	$pres_image = ($presc['image_binary'])?"<img src=\"data:image/jpeg;base64, {$presc['image_binary']}\"; style='max-width:70px'>":'';
	$update_btn = "<a title='Update Prescription' href='add_prescription.php?id={$presc['id']}'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\" style=\"font-size:15px;\"></i></a>";
	$delete_btn = "<a title='Delete Prescription' class='delete' href='buyers_dashboard.php?action=prescriptions&subaction=delete&pid={$presc['id']}'><i class=\"fa fa-window-close-o\" aria-hidden=\"true\" style=\"font-size:15px;color:red\"></i></a>";

 echo "<td>".date("Y-m-d", strtotime($presc['created_at']))."</td><td>".$prescriptions->getPhysician($presc['physician_id'])."</td><td>".ucwords($prescriptions->getPharmacy($presc['pharmacy_id']))."</td><td>".$presc['description']."</td><td>".$presc['status']."</td><td>".$presc['delivery_status']."</td><td>".$presc['review_status']."<br />".$presc['review_reason']."</td><td><a href='prescription_details.php?presID=".$presc['id']."'>".$pres_image."</a></td><td>$update_btn | $delete_btn</td></tr><tr>";





	                   }

                    ?>

                    </table>

          

                    </div>

                

</section>

<div style="margin-top:  20px;">

<a href="add_prescription.php" class="submit" >Add A New Prescription</a>

</div>

</div>

</div>

