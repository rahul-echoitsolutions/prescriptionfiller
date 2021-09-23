<?php
require_once("includes/lib/common.php");
require("includes/lib/classes/a/dealers.php");
require("includes/lib/classes/a/pharmacies.php");
$pharmacies = new pharmacies();
$dealers = new dealers();
$pharmacy_id = $request->getvalue('id');
$action = $request->postvalue('action');
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


$options = array();
$options['order_by'] = "";
$pharmlist = $pharmacies->getlistMember($options, $_SESSION['memberID']);

function no_($var = "") {
    $xxx = str_replace("_", " ", $var);
    return $xxx;
}

echo "<section class=\"ff_faqs\">
<div id=\"accordion\">";
$xxi = 0;
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
        min-width: 20%;
        padding:10px; 
    }
</style>

<div class="page-content col-lg-12 col-md-12" id="dealerApp"> 
    <div class="page-content">

        <div class="col-md-12">  



            <section>
                <div class="container">
                    <h2>Your Pharmacies</h2>

                    <table class="table">
                        <tr>
                            <th>Pharmacy Name</th><th>Address</th><th>City</th><th>phone_number</th>

                        </tr>

<?php
foreach ($pharmlist[0] as $key => $pharm) {

    $pharmacies->load($pharm);
    echo "<tr><td>" . $pharmacies->name . "</td><td>" . $pharmacies->address . "</td><td>" . $pharmacies->city . "</td><td>" . $pharmacies->phone_number . "</td></tr>";
}
?>
                    </table>

                </div>

            </section>
        </div>
    </div>