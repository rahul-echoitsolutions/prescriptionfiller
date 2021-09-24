<?php
session_start();

if (!isset($head)) {
    $head = '';
}


$head .= "
    <style>
    .contactText p{
        font-size:24px;
        }
    .contactText li,a{
        font-size: 24px;
        }
     .form-group input{
        font-size: 18px;
        }
        #message{
        font-size: 18px !important;
        }
        #privacy{
            font-size:18px;
            }
        </style>
        ";



include("includes/head.php");


require("includes/lib/classes/a/prescriptions.php");
require("includes/lib/classes/a/members.php");
require("includes/lib/classes/a/physicians.php");
require("includes/lib/classes/a/pharmacies.php");
//require("includes/lib/functions/submenuBuilder.php");

$physicians = new physicians();
$prescriptions = new prescriptions();
$physicians_id = $request->getvalue('id');
$members = new members();
$pharmacies = new pharmacies();
$id = $request->getvalue('request');
$action = $request->postvalue('action');


$members->load($_SESSION['user_id']);


$rooturl = "https://prescriptionfiller.com/";
require_once("Mobile-Detect-2.8.34/Mobile_Detect.php");
$detect = new Mobile_Detect;
if ($detect->isMobile()) {
    $a = 1;
    $is_mobile = 1;
}
if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
    $browser = "Firefox";
}


$prescriptions->load($request->getvalue('presID'));
?>
<style>

    .page-banner{
        margin-top: 100px !important;

    }
    .prescriptionImg{
        width: 100%;
    }
</style>


<?php
include("includes/header.php");
?>
<!-- Start Page Banner -->

<!-- End Page Banner -->
<img src="images/review-your-prescriptions.jpg" style="width: 100%;">
<!-- Start Content -->
<div id="content" >




    <div class="container">
        <div class="row">

            <div class="col-md-6 top50 form-col">
                <!-- Classic Heading -->
                <h2 class="classic-title"><span>Review Your Prescription</span></h2>
<?php
$pres_image = ($prescriptions->image_binary) ? "<img class=prescriptionImg src=\"data:image/jpeg;base64, {$prescriptions->image_binary}\"; >" : '';


echo $pres_image;
?>


            </div>

            <div class="col-md-6 top50 form-col">

                Date Entered: <?php echo date("F j, Y", strtotime($prescriptions->created_at)); ?><br /><br />

                Doctor's Name: <?php
                $physicians->load($prescriptions->physician_id);



                echo $physicians->first_name . " " . $physicians->last_name;
?><br /><br />

                Pharmacy: <?php
                $pharmacies->load($prescriptions->pharmacy_id);


                echo $pharmacies->name;
                ?><br />

                <?php echo $pharmacies->address; ?><br />
                <?php echo $pharmacies->city . ", " . $pharmacies->province . " " . $pharmacies->zip_code ?><br />
                <?php echo $pharmacies->phone_number; ?><br /><br />




                Description:  <?php echo $prescriptions->description; ?><br />





            </div>


        </div>
    </div>
</div>
<!-- End content -->

<?php
include("includes/footer.php");
?>


<script>


</script>