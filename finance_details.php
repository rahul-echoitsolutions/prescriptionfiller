<?php 

require_once("Mobile-Detect-2.8.34/Mobile_Detect.php");
$detect = new Mobile_Detect;
if($detect->isMobile()){
    $a=1;
    $is_mobile=1;
}
if($detect->isTablet()){
    $is_tablet=1;
}
if($detect->isiOS() ){
    $is_iOS=1;
    }


$head.="
<title>Carleado</title>
<meta name=\"description\" content=\"Carleado - The new way to buy a car\" />
<meta name=\"robots\" content=\"index,follow\" />
<meta name=\"googlebot\" content=\"index,follow\" />
<meta content=\"General\" name=\"Rating\" />
<meta name=\"language\" content=\"English\" />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.2/bootstrap-slider.min.js'>
<style>
form input{
    border:thin solid #ccc;
    border-radius:5px;
    padding:8px 10px 8px 15px !important;
    width: 330px !important;
    max-width: 95vw;
    }
form  select{
    border:thin solid #ccc;
    border-radius:5px;
    padding:10px 10px 10px 15px !important;
    background-color: #fff;
    width: 330px !important;
    max-width: 95vw;
    font-size: 80%;
    }
form select option span{
    font-size:50%;
    }
label{
    font-weight:800;
    font-size:18px;
    margin-top:3px;
    }
.opt{
    font-size:50%;
    }
    .fill {
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden
}
.fill img {
    flex-shrink: 0;
    min-width: 100%;
    min-height: 100%
}
#carImageText p{
    { 
    opacity:0;
    transition: opacity 10s;
    -webkit-transition: opacity 10s; /* Safari */
}
}
</style>
<style>
*, *:before, *:after {
  box-sizing: border-box;
}
.range-slider {
  margin: 10px 0 20px 0%;
}
.range-slider {
  width: 90%;
}
.range-slider__range {
  -webkit-appearance: none;
  width: calc(100% - (120px));
  height: 10px;
  border-radius: 5px;
  background: #d7dcdf;
  outline: none;
  padding: 0;
  margin: 0;
}
.range-slider__range::-webkit-slider-thumb {
  -webkit-appearance: none;
          appearance: none;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #2c3e50;
  cursor: pointer;
  transition: background .15s ease-in-out;
}
.range-slider__range::-webkit-slider-thumb:hover {
  background: #1abc9c;
}
.range-slider__range:active::-webkit-slider-thumb {
  background: #1abc9c;
}
.range-slider__range::-moz-range-thumb {
  width: 20px;
  height: 20px;
  border: 0;
  border-radius: 50%;
  background: #2c3e50;
  cursor: pointer;
  transition: background .15s ease-in-out;
}
.range-slider__range::-moz-range-thumb:hover {
  background: #1abc9c;
}
.range-slider__range:active::-moz-range-thumb {
  background: #1abc9c;
}
.range-slider__range:focus::-webkit-slider-thumb {
  box-shadow: 0 0 0 3px #fff, 0 0 0 6px #1abc9c;
}
.range-slider__value {
  display: inline-block;
  position: relative;
  width: 60px;
  color: #fff;
  line-height: 20px;
  text-align: center;
  border-radius: 3px;
  background: #2c3e50;
  padding: 5px 10px;
  margin-left: 8px;
}
.range-slider__value:after {
  position: absolute;
  top: 8px;
  left: -7px;
  width: 0;
  height: 0;
  border-top: 7px solid transparent;
  border-right: 7px solid #2c3e50;
  border-bottom: 7px solid transparent;
  content: '';
}
::-moz-range-track {
  background: #d7dcdf;
  border: 0;
}
input::-moz-focus-inner,
input::-moz-focus-outer {
  border: 0;
}
</style>
<style>";

if($is_mobile){ 
/* monthly payment radio boxes */
$head.="
.middle {
  width: 100%;
  font-weight: 500;
  /*text-align: center;*/
}
.middle h1 {
  font-family: 'Open Sans', sans-serif;
  color: #fff;
}
.middle input[type=\"radio\"] {
  display: none;
}
.middle input[type=\"radio\"]:checked + .box {
  background-color: #00A1E8;
}
.middle input[type=\"radio\"]:checked + .box span {
  color: white;
  transform: translateY(20px);
}
.middle input[type=\"radio\"]:checked + .box span:before {
  transform: translateY(0px);
  opacity: 1;
}
.middle .box {
  width: 245px;
  height: 60px;
  background-color: #fff;
  transition: all 250ms ease;
  will-change: transition;
  display: inline-block;
  text-align: center;
  cursor: pointer;
  position: relative;
  font-family: 'Open Sans', sans-serif;
  font-weight: 300;
  border: 1px solid #00A1E8;
}
.middle .box:active {
  transform: translateY(10px);
}
.middle .box span {
  position: absolute;
  transform: translate(0, 20px);
  left: 0;
  right: 0;
  transition: all 300ms ease;
  font-size: 1.0em;
  user-select: none;
  color: #00A1E8;
}
.middle .box span:before {
  font-size: 1.2em;
  font-family: FontAwesome;
  display: block;
  transform: translateY(-80px);
  opacity: 0;
  transition: all 300ms ease-in-out;
  font-weight: normal;
  color: white;
} ";
}else{ 
/* monthly payment radio boxes */
$head.="
.middle {
  width: 100%;
  /*text-align: center;*/
}
.middle h1 {
  font-family: 'Open Sans', sans-serif;
  color: #fff;
}
.middle input[type=\"radio\"] {
  display: none;
}
.middle input[type=\"radio\"]:checked + .box {
  background-color: #00A1E8;
}
.middle input[type=\"radio\"]:checked + .box span {
  color: white;
  transform: translateY(40px);
}
.middle input[type=\"radio\"]:checked + .box span:before {
  transform: translateY(0px);
  opacity: 1;
}
.middle .box {
  width: 245px;
  height: 100px;
  background-color: #fff;
  transition: all 250ms ease;
  will-change: transition;
  display: inline-block;
  text-align: center;
  cursor: pointer;
  position: relative;
  font-family: 'Open Sans', sans-serif;
  font-weight: 300;
  border: 1px solid #00A1E8;
}
.middle .box:active {
  transform: translateY(10px);
}
.middle .box span {
  position: absolute;
  transform: translate(0, 40px);
  left: 0;
  right: 0;
  transition: all 300ms ease;
  font-size: 1.0em;
  user-select: none;
  color: #00A1E8;
}
.middle .box span:before {
  font-size: 1.2em;
  font-family: FontAwesome;
  display: block;
  transform: translateY(-80px);
  opacity: 0;
  transition: all 300ms ease-in-out;
  font-weight: normal;
  color: white;
} ";


 } 

if($is_mobile){ 
$head.="
/* This is for the credit rating radio boxes*/

.middle2 {
  width: 100%;
 /* text-align: center;*/
}
.middle2 div{
    font-weight: 400 !important;
    }
.middle2 input[type=\"radio\"] {
  display: none;
}
.middle2 input[type=\"radio\"]:checked + .box2 {
  background-color: #00A1E8;
}
.middle2 input[type=\"radio\"]:checked + .box2 span {
  color: white;
  transform: translateY(6px);
}
.middle2 input[type=\"radio\"]:checked + .box2 span:before {
  transform: translateY(0px);
  opacity: 1;
}
.middle2 .box2 {
  width: 180px;
  height: 40px;
  background-color: #fff;
  transition: all 250ms ease;
  will-change: transition;
  display: inline-block;
  text-align: center;
  cursor: pointer;
  position: relative;
   font-weight: 300;
  border: 1px solid #00A1E8;
}
.middle2 .box2:active {
  transform: translateY(8px);
}
.middle2 .box2 span {
  position: absolute;
  transform: translate(0, 6px);
  left: 0;
  right: 0;
  transition: all 300ms ease;
  font-size: 1.0em;
  user-select: none;
  color: #00A1E8;
}
.middle2 .box2 span:before {
  font-size: 1.0em;
  font-family: FontAwesome;
  display: block;
  transform: translateY(-80px);
  opacity: 0;
  transition: all 300ms ease-in-out;
  font-weight: normal;
  color: white;
}";

}else{

   
    $head.="/* This is for the credit rating radio boxes*/

.middle2 {
  width: 100%;
 /* text-align: center;*/
}
.middle2 input[type=\"radio\"] {
  display: none;
}
.middle2 input[type=\"radio\"]:checked + .box2 {
  background-color: #00A1E8;
}
.middle2 input[type=\"radio\"]:checked + .box2 span {
  color: white;
  transform: translateY(20px);
}
.middle2 input[type=\"radio\"]:checked + .box2 span:before {
  transform: translateY(0px);
  opacity: 1;
}
.middle2 .box2 {
  width: 180px;
  height: 60px;
  background-color: #fff;
  transition: all 250ms ease;
  will-change: transition;
  display: inline-block;
  text-align: center;
  cursor: pointer;
  position: relative;
   font-weight: 300;
  border: 1px solid #00A1E8;
}
.middle2 .box2:active {
  transform: translateY(10px);
}
.middle2 .box2 span {
  position: absolute;
  transform: translate(0, 20px);
  left: 0;
  right: 0;
  transition: all 300ms ease;
  font-size: 1.0em;
  user-select: none;
  color: #00A1E8;
}
.middle2 .box2 span:before {
  font-size: 1.0em;
  font-family: FontAwesome;
  display: block;
  transform: translateY(-80px);
  opacity: 0;
  transition: all 300ms ease-in-out;
  font-weight: normal;
  color: white;
}";
}














$head.="

option:disabled {
    display: none;
}
</style>
";

include("includes/head.php");
include("includes/header.php");
require("includes/lib/classes/a/applications.php"); 
require("includes/lib/classes/a/members.php"); 
require("includes/lib/classes/a/broker_quotes.php");
function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}


$apps = new applications();
$memb = new members();
$financial = new financial();

$direct = $request->getvalue('direct');


$memberID= $request->getvalue('memberID');

$_SESSION['memberID'] = ($_SESSION['memberID']>0)? $_SESSION['memberID'] :$memberID;	


if(!$direct ){


	$apps_id = $request->getvalue('id');


	$memberID= $request->getvalue('memberID');
	$_SESSION['memberID'] = ( $_SESSION['memberID'])?  $_SESSION['memberID'] :$memberID;	

	if($_SESSION['memberID']){
	$memb->checkLogin($_SESSION['memberID']);
	}


	if($apps_id>0){
		
		$apps->load($apps_id);
		$memload=($_SESSION['memberID'])? $_SESSION['memberID'] : $apps->member_id;
		//echo "Got to line ".__LINE__." in ".__FILE__." and apps_id is $apps_id and memlaod is $memload<br />";
		$memb->load($memload);

	} else {
		
		$memload=($_SESSION['memberID']);
		$memb->load($memload);
		
	}

} // if direct



require("includes/lib/functions/statesProv.php"); 
    //$apps=str_replace("_", " ",$apps);
//$fn = $request->postvalue('vehicle_make');

if($_POST['action']=="saveDetails"){
    
		
				$memload	=	($_SESSION['memberID']);
	
				if($memload>0)	$memb->load($memload);
	
				if($request->postvalue('first_name')!='') {
    
					$pass  									= 	$request->postvalue('password'); 
					$memb->first_name					    =	$request->postvalue('first_name');
					$memb->last_name			        	=	$request->postvalue('last_name');
					$memb->address				            =	$request->postvalue('address');
					$memb->email					        =	$request->postvalue('email');
					$memb->city				                =	$request->postvalue('city');
					$memb->province			                =	$request->postvalue('province');
					$memb->mobile_phone                     =   $request->postvalue('mobile_phone');
					$memb->home_phone                       =   $request->postvalue('home_phone');
					$memb->postalcode                       =   $request->postvalue('postalcode');
					$memb->country                          =   $request->postvalue('country');          

					$memb->save();
				}
	
                if(!$apps->member_id){
                $last_id=$memb->id; 
                }else{
                    $last_id=$apps->member_id;
                }
 
				$financial->application_type				    =	$request->postvalue('application_type');
                $financial->member_id       				    =	($apps->member_id>0)?$apps->member_id:$_SESSION['memberID'];
                $financial->vehicle_id				            =	$apps_id;
                $financial->dealer_id       				    =	$dealer_id;
                //$financial->vehicle_make                     =	$request->postvalue('vehicle_make');
                //$financial->vehicle_model                     =	$request->postvalue('vehicle_model');
                //$financial->vehicle_max_price                =	$request->postvalue('vehicle_max_price');
                //$financial->vehicle_max_miles                =	$request->postvalue('vehicle_max_miles');
                //$financial->vehicle_category                 =	$request->postvalue('vehicle_category');
                //$financial->vehicle_body_type                =	$request->postvalue('vehicle_body_type');
                //$financial->vehicle_color                    =   $request->postvalue('vehicle_color');
                //$financial->vehicle_year_min                 =   $request->postvalue('vehicle_year_min');
                //$financial->vehicle_year_max                 =   $request->postvalue('vehicle_year_max');
                //$financial->vehicle_transmission             =   $request->postvalue('vehicle_transmission');
                //$financial->payment_method                   =   $request->postvalue('payment_method');
                $financial->preferred_payment                   =   $request->postvalue('preferred_payment');
                $financial->down_payment                   =   $request->postvalue('down_payment');
                $financial->date_submitted                      =   $request->postvalue('date_submitted');
                //$financial->password                         =   $request->postvalue('password');
                //$financial->preferred_contact_method         =   $request->postvalue('preferred_contact_method');
                //$financial->preferred_contact_time           =   $request->postvalue('preferred_contact_time');
                //$financial->radius                           =   $request->postvalue('radius');
                //$financial->fuel_type                        =   $request->postvalue('fuel_type');   
                //$financial->engine_type                      =   $request->postvalue('engine_type');
				$financial->employer_name					=	$request->postvalue('employer_name');
				$financial->loan_type						=	$request->postvalue('loan_type');
                $financial->loan_amount					    =	$request->postvalue('loan_amount');
				$financial->job_time						    =	$request->postvalue('job_time');
                $financial->job_title						=	$request->postvalue('job_title');
				$financial->amount_primary_income			=	$request->postvalue('amount_primary_income');
				$financial->frequency_primary_income			=	$request->postvalue('frequency_primary_income');
				$financial->work_phone						=	$request->postvalue('work_phone');
                $financial->amount_secondary_income		    =	$request->postvalue('amount_secondary_income');
                $financial->frequency_secondary_income		=	$request->postvalue('frequency_secondary_income');
				//$financial->first_name					    =	$request->postvalue('first_name');
				//$financial->last_name			        	=	$request->postvalue('last_name');
				//$financial->address				            =	$request->postvalue('address');
				//$financial->email					        =	$request->postvalue('email');
                //$financial->city				                =	$request->postvalue('city');
                //$financial->province			                =	$request->postvalue('province');
                //$financial->mobile_phone                     =   $request->postvalue('mobile_phone');
                $financial->home_phone                       =   $request->postvalue('home_phone');
				$financial->their_employer_name			    =	$request->postvalue('their_employer_name');
                $financial->their_job_time			        =	$request->postvalue('their_job_time');
                $financial->their_job_title			        =	$request->postvalue('their_job_title');
                $financial->their_amount_primary_income		=	$request->postvalue('their_amount_primary_income');
                $financial->their_frequency_primary_income	=	$request->postvalue('their_frequency_primary_income');
                $financial->their_work_phone				    =	$request->postvalue('their_work_phone');
                $financial->their_frequency_secondary_income	=	$request->postvalue('their_frequency_secondary_income');
                $financial->their_amount_secondary_income	=	$request->postvalue('their_amount_secondary_income');
                $financial->their_sin			            =	$request->postvalue('their_sin');
                $financial->their_birthdate			        =	$request->postvalue('their_birthdate');
                $financial->their_first_name			        =	$request->postvalue('their_first_name');
                $financial->their_last_name			        =	$request->postvalue('their_last_name');
                $financial->their_email			            =	$request->postvalue('their_email');
                $financial->their_address			        =	$request->postvalue('their_address');
                $financial->their_city			            =	$request->postvalue('their_city');
                $financial->their_province			        =	$request->postvalue('their_province');
                $financial->their_home_phone		        =	$request->postvalue('their_home_phone');
                $financial->their_mobile_phone			    =	$request->postvalue('their_mobile_phone');
                $financial->vehicle_make_model			    =	$request->postvalue('vehicle_make_model');
                $financial->sin			                    =	$request->postvalue('sin');
                $financial->birthdate			            =	$request->postvalue('birthdate');
                //$financial->best_time			            =	$request->postvalue('best_time');
                $financial->customer_comments			    =	$request->postvalue('customer_comments');
                //$financial->dateentered			            =	$request->postvalue('dateentered');
                $financial->lastupdated			            =	date("Y-m-d H:i:s");
                $financial->completed			            =	$request->postvalue('completed');
                $financial->dealclosed			            =	$request->postvalue('dealclosed');
  //mail("birwin@suddensales.com", "Error Message ", "At line ".__LINE__." in ".__FILE__." ");
$financial->save();
$success="Thank you for completing this request for quotes on financing.";
$success.=($apps->vehicle_body_type OR $apps->vehicle_make)? " your $apps->vehicle_body_type $apps->vehicle_make $apps->vehicle_model $apps->vehicle_category"."$apps->vehicle_body_type." : "."; 
//$success.="One of our fiancial specialists will be contacting you soon.";
$success=no_($success);

echo "<meta http-equiv = \"refresh\" content = \"2; url = https://www.carleado.com/buyers_dashboard.php?id=$memload&success=$success\">";
die;
}
/*
$curl = curl_init();
curl_setopt_array($curl, [
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'https://www.carimagery.com/api.asmx/GetImageUrl?searchTerm='.$apps->vehicle_make.'+'.$apps->vehicle_model.' ',
CURLOPT_USERAGENT => 'Codular Sample cURL Request'
]);
$resp = curl_exec($curl);
curl_close($curl);
$xml=simplexml_load_string($resp);
*/
?>
<style>
	.steps{
  list-style-type: none;
  margin: 0;
  padding: 0;
  background-color: #fff;
  text-align: center;
}
.steps li{
  display: inline-block;
  margin: 20px;
  color: #ccc;
  padding-bottom: 5px;
}
.steps li.is-active{
  border-bottom: 1px solid #3498db;
  color: #3498db;
}
/* FORM */
.form-wrapper .section{
  padding: 0px 20px 30px 20px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  background-color: #fff;
  opacity: 0;
  -webkit-transform: scale(1, 0);
  -ms-transform: scale(1, 0);
  -o-transform: scale(1, 0);
  transform: scale(1, 0);
  -webkit-transform-origin: top center;
  -moz-transform-origin: top center;
  -ms-transform-origin: top center;
  -o-transform-origin: top center;
  transform-origin: top center;
   -webkit-transition: all 1s ease-in;
  -o-transition: all 1s ease-in;
  transition: all 1s ease-in;
  text-align: center;
  position: absolute; 
  width: 100%;
  min-height: 400px;
}
.form-wrapper .section h3{
  margin-bottom: 30px;
}
.form-wrapper .section.is-active{
  opacity: 1;
  -webkit-transform: scale(1, 1);
  -ms-transform: scale(1, 1);
  -o-transform: scale(1, 1);
  transform: scale(1, 1);
}
.form-wrapper .button, .form-wrapper .submit{
  background-color: #3498db;
  display: inline-block;
  padding: 8px 30px;
  color: #fff;
  cursor: pointer;
  z-index: 999999;
  font-size: 14px !important;
  font-family: 'Open Sans', sans-serif !important;
  /*position: absolute;
  right: 20px;
  bottom: 20px;*/
  margin-top:50px;
  border:none;
}
.form-wrapper .backbutton {
  background-color: #3498db;
  display: inline-block;
  padding: 8px 30px;
  color: #fff;
  cursor: pointer;
  z-index: 999999;
  font-size: 14px !important;
  font-family: 'Open Sans', sans-serif !important;
  /*position: absolute;
  right: 20px;
  bottom: 20px;*/
  margin-top:50px;
}
fieldset{
    /*border:1px solid #000;*/
    
    <?php if($is_mobile){ ?>
    padding:0px !important;
    <?php }else{ ?>
    padding:30px !important;
    <?php } ?>
    text-align:center;
    min-height:600px;
    margin: 30px auto;
    max-width:90vw;
    
}
fieldset input{
    text-align:center;
}
</style>
  
 <style>
	.section5 input[type=text],.section5 input[type=password] {
		width: 90% !important;
		border-radius: 5px;
		margin:5px;
		border:thin solid #CCC;
	}
</style> 
   <div class="page-banner" style="display:none">
      <div class="container">
           <div class="row">
          <div class="col-md-6">
            <h2>Sub Menu Page Demo</h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="index.php">Home</a></li>
              <li></li>
            </ul>
          </div>
        </div>
        </div>
      </div>
    <!-- End Page Banner -->
    <!-- Start Content -->


    <div id="content" style="min-height:800px; ">
      <div class="container" style="background-color:rgba(255,255,255,0.8); ">
          <div class="row">
            <div class="col-md-12">
               <!-- Toggle -->
               
               <?php   
               $pgPad=($is_mobile)? " style='padding-top:20px;'":" style='padding-top:60px;'";
               ?>
               
            <div class="panel-group" <?php echo $pgPad; ?>">

        <div class="row">
        <div class="col-sm-12" >	
        <?php 
         $brtest=(strlen($apps->vehicle_make)>20)? "<br />" : "";
         		?>
                    <h2>Let's find financing for your <?php echo ($apps->vehicle_make)? no_($apps->vehicle_make)." ".$brtest." ".no_($apps->vehicle_model)." ".$apps->vehicle_body_type : " vehicle."?> </h2>
                   <?php
	//<h3>We work hard to find you the best rates and lowest payments</h3>
//                    <p>We'll have lenders competing for your business. Just fill out the simple form below.  No lender will pull a "hard" credit report (the kind that can affect your credit rating) without your explicit permission. </p>
//                    <p> Filling Out this form will shorten the time spent at the dealership and speed your application.</p>
?>
                  <?php /* if($apps->vehicle_make OR $apps->vehicle_model){?>
                    <img src='<?php echo $xml[0];?>' style="max-height: 400px; max-width: 90vw;">
                    <?php
                     }  */ ?>
               </div>

			</div>
     			<div class="wrapper" >
     		
		<form id="form" class="form-wrapper" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off"  enctype="multipart/form-data">			
		<input type="hidden" name="application_type" id="application_type" value="finance"/>    
		<div class="row"> 
        <div class="col-sm-12">		  							
        <h5 style="text-align: center;">Your Information</h5>
<fieldset class="section is-active">        	        
<section>
<label for="loan_amount">Vehicle Price
</label>

<div ><input  type="text" style="font-size: 18px;" class="car_brand" name="loan_amount"  id="loan_amount" value="<?php echo $loanAmount=($apps->loan_amount>100)? $apps->loan_amount : $apps->vehicle_max_price;?>"/></div>



<?php
//	if($apps->loan_amount){
?>
<label for="vehicle_model"><br />What Is Your Down Payment Amount</label><br />


<?php if($is_mobile) { ?>

<div>
	<select class="down_payment" name="down_payment">
		<option value="">Select</option>
		<?php for($i=500; $i<=50000; $i+=500) { ?>
		<option value="<?php echo $i;?>">$<?php echo number_format($i);?></option>
		<?php } ?>
	</select>
</div>	
	
<?php } else { ?>

<div style="margin-left:50px; background-color:#fff; border: 1px solid #ccc;  height:100px; width:90% !important;">
<div class="range-slider">
<input class="range-slider__range" type="range" name="down_payment" id="down_payment" style="margin-top:45px; margin-left:50px; width: 80% !important;" value="<?php echo ($pmt)? no_($financial->preferred_payment): "0";?>" min="0" max="<?php

$dp=($apps->vehicle_max_price>100)? $apps->vehicle_max_price: 50000;

 echo $loanAmount=($apps->loan_amount>100)? $apps->loan_amount : $dp;?>" step="100">
  <span class="range-slider__value" style="display: inline;">0</span>
</div>

</div>
<input type="hidden" id="car_price" value="<?php echo $loanAmount=($apps->loan_amount>100)? $apps->loan_amount : $apps->vehicle_max_price;?>">


<script>
$(document).ready(function(){

$('#down_payment').on('input', function(){
	
	if($('#loan_amount').val() <= 0) return false;
	
    $('#loan_amount').val($("#car_price").val()-$('#down_payment').val());
});

});
</script>


<?php	} ?>


 <div class="button">Next</div>
</section>
</fieldset>
<fieldset class="section">
<section>
<label for="vehicle_model">Your Preferred Monthly Payment Amount</label>
<div class="middle">
  <label>
  <input type="radio" name="preferred_payment" value="under $250" checked/>
  <div class="front-end box">
    <span>Under $250 / month</span>
  </div>
</label>
  <label>
  <input type="radio" name="preferred_payment" value="250 - 374"/>
  <div class="back-end box">
    <span>$250 - 374 / month</span>
  </div>
</label>
  <br>
  <label>
  <input type="radio" name="preferred_payment" value="375 - 500"/>
  <div class="test box">
    <span>$375 - 500 / month</span>
  </div>
</label>
    <label>
  <input type="radio" name="preferred_payment" value="500+"/>
  <div class="test2 box">
    <span>Over $500 / month</span>
  </div>
</label>
</div>
<div class="backbutton">Back</div> <div class="button">Next</div>
</section>
</fieldset>

<fieldset class="section">
<section>
<br /><label for="vehicle_model">What Is Your Estimated Credit Rating?</label>
<div class="middle2">
  <label>
  <input type="radio" name="creditRating" checked/>
  <div class="front-end box2">
    <span>Good (Over 650)</span>
  </div>
</label>
  <label>
  <input type="radio" name="creditRating"/>
  <div class="back-end box2">
    <span>Fair (550 - 650)</span>
  </div>
</label>
  <label>
  <input type="radio" name="creditRating"/>
  <div class="test box2">
    <span>Poor (under 550)</span>
  </div>
</label>
  <br>
  
  
  <?php
	$financeOffset=($is_mobile)? "": " style=\"margin-left: 80px;\"";
?>
  
  
  
  
  
  <div <?php echo $financeOffset; ?>>
    <label>
  <input type="radio" name="creditRating"/>
  <div class="test2 box2">
    <span>Current Bankruptcy</span>
  </div>
</label>
  <label>
  <input type="radio" name="creditRating"/>
  <div class="test2 box2">
    <span>No Credit / Unsure</span>
  </div>
</label>
  </div>
</div>
<div class="backbutton">Back</div> <div class="button">Next</div>
</section>
</fieldset>
<fieldset class="section">
<section>
<br /><label for="vehicle_model">What Is Your Annual Salary?</label>


<?php if($is_mobile) { ?>

<div>
	<select class="car_brand"  name="amount_primary_income">
		<option value="">Select</option>
		<?php for($i=5000; $i<=20000; $i+=1000) { ?>
		<option value="<?php echo $i;?>">$<?php echo number_format($i);?></option>
		<?php } ?>
        <?php for($i=25000; $i<=100000; $i+=5000) { ?>
		<option value="<?php echo $i;?>">$<?php echo number_format($i);?></option>
		<?php } ?>
        <?php for($i=110000; $i<=300000; $i+=10000) { ?>
		<option value="<?php echo $i;?>">$<?php echo number_format($i);?></option>
		<?php } ?>
        
        
        
	</select>
</div>	
	
<?php } else { ?>
<div style="background-color:#fff; border: 1px solid #ccc;  height:100px; width:90%">
	<div class="range-slider" >
	<input class="range-slider__range" type="range" name="amount_primary_income" id="amount_primary_income" style="margin-top:45px; margin-left:50px; width:80%  !important;" value="<?php echo ($pmt)? no_($financial->amount_primary_income): "50000";?>" min="1000" max="200000" step="1000">
	  <span class="range-slider__value" style="display: inline;">0</span>
	</div>

</div>
<?php } ?>


<div class="backbutton">Back</div> <div class="button">Next</div>
</section>
</fieldset>
<fieldset class="section">
<section>
<br /><label for="vehicle_max_price">Your Job Title</label>
<div ><input  type="text" class="car_brand" name="job_title" id="job_title" value="<?php echo $financial->job_title;?>"/></div>
</section>
<section>
<label for="vehicle_max_miles"><br />How Long Have You Worked There? (Years/Months)</label>
<div ><input  type="text" class="car_brand" name="job_time" id="job_time" value="<?php echo $financial->job_time;?>"/></div>
<div class="backbutton">Back</div> <div class="button">Next</div>
</section>
</fieldset>
<fieldset class="section">
<section>
<label for="vehicle_category">Employer's Company Name</label>
<div><input  type="text" class="car_brand" name="employer_name" id="employer_name" value="<?php echo $financial->employer_name;?>"/></div>
</section>
<section>
<label for="vehicle_body_type"><br />Employer's Phone Number</label>
<div><input  type="text" class="car_brand" name="work_phone" id="work_phone" value="<?php echo $financial->work_phone;?>"/></div>
</section>
<div class="backbutton">Back</div> <div class="button">Next</div>
</fieldset>
<fieldset class="section">
<section>
<label for="vehicle_body_type">How Often Are You Paid? <span style="font-weight: 300;">(Weekly/BiWeekly/Monthly)</span></label>
<div><input  type="text" class="car_brand" name="frequency_primary_income" id="frequency_primary_income" value="<?php echo $financial->frequency_primary_income;?>"/></div>
</section>
<section>
<label for="vehicle_body_type"><br />Your Pay Each Period?</label>
<div><input  type="text" class="car_brand" name="amount_primary_income" id="amount_primary_income" value="<?php echo $financial->amount_primary_income;?>"/></div>
</section>
<section>
<label for="vehicle_body_type"><br />Amount of Secondary Income?</label>
<div><input  type="text" class="car_brand" name="amount_secondary_income" id="amount_secondary_income" value="<?php echo $financial->amount_secondary_income;?>"/></div>
</section>
<section>
<label for="vehicle_body_type"><br />Frequently of Secondary Income?</label>
<div><input  type="text" class="car_brand" name="frequency_secondary_income" id="frequency_secondary_income" value="<?php echo $financial->frequency_secondary_income;?>"/></div>
</section>
<div class="backbutton">Back</div> <div class="button">Next</div>
</fieldset>
<fieldset class="section">


<label for="best_time">Preferred Contact Method</label>
<div><select class="car_brand" name="preferred_contact_method"><option value="">Please Choose a Contact Method</option><option value="Email" <?php echo ($memb->preferred_contact_method=="Email")?"selected" : "";?> >Email</option><option value="Phone" <?php echo ($memb->preferred_contact_method=="Phone")?"selected" : "";?> >Phone</option><option value="Text" <?php echo ($memb->preferred_contact_method=="Text")?"selected" : "";?> >Text</option></select></div>

<label for="best_time"><br />Preferred Contact Time</label>
<div><select class="car_brand" name="best_time"><option value="">Please Choose a Preferred Contact Time</option><option value="Early Morning (7-9)" <?php echo ($memb->best_time=="Early Morning (7-9)")?"selected" : "";?> >Early Morning (7-9)</option><option value="Morning (9-12)" <?php echo ($memb->best_time=="Morning (9-12)")?"selected" : "";?> >Morning (9-12)</option><option value="Early Afternoon (12-3)" <?php echo ($memb->best_time=="Early Afternoon (12-3)")?"selected" : "";?> >Early Afternoon (12-3)</option><option value="Late Afternoon (3-6)" <?php echo ($memb->best_time=="Late Afternoon (3-6)")?"selected" : "";?> >Late Afternoon (3-6)</option><option value="Early Evening (6-8)" <?php echo ($memb->best_time=="Early Evening (6-8)")?"selected" : "";?> >Early Evening (6-8)</option><option value="Late Evening (8-10)" <?php echo ($memb->best_time=="Late Evening (8-10)")?"selected" : "";?> >Late Evening (8-10)</option></select></div>

<label for="customer_comments"><br />Your Comments or Specifications</label>
<div><textarea name="customer_comments" id="customer_comments" cols="57" rows="5" style="max-width: 100%;"> <?php echo $memb->customer_comments;?></textarea></div>

<?php 
if(($memload or $memberID) and $memb->postalcode){ ?>
 <input type="hidden" name="action" value="saveDetails" />
		<div><div class="backbutton">Back</div> <button class="submit button" name="manage_service_button" value="manage_service_button">Submit</button></div>
        <div style="text-align: justify; width:70%; margin: 20px auto; padding:20px 20px 15px 20px; border: 1px solid #ccc;text-align:center;" ><p>Carleado will not perform any credit checks with information provided. </p></div>
        </section>       
</fieldset>
        <?php }else{?>
            
            <div class="backbutton">Back</div> <div class="button">Next</div>

        </section>       
</fieldset>        
            
          <?php
          } ?>

<?php /*
<fieldset class="section">
<section>
<label for="vehicle_body_type">Your Birthdate? (YYYY-MM-DD)</label>
<div><input  type="text" class="car_brand date" name="birthdate" id="birthdate" value="<?php echo $financial->birthdate;?>"/></div>
</section>
<section>
<label for="vehicle_body_type">Your Social Insurance Number</label>
<div><input  type="text" class="car_brand" name="sin" id="sin" value="<?php echo $financial->sin;?>"/></div>
</section>
<input type="hidden" name="dateentered" value="<?php echo ($apps->dateentered)?$apps->dateentered : date("Y-m-d H:i:s");?>" /><input type="hidden" name="action" value="saveDetails" />
<section>
<label for="customer_comments"></label>
*/

          
          
          
	  if((!$_SESSION['memberID'])){ ?>

  <fieldset class="section section5">
<section>          
            
            <div style="max-width: 900px; margin: 0 auto; font-size:24px; padding:20px;">
				
          		<div class="logindiv">
          			
          			<h3> Login to your Account</h3>
          			
          			<input type="text" id="login_name" name="login_name" value="" placeholder="Email"><br />
          			<input type="password" id="login_password" name="login_password" value="" placeholder="Password"><br />
          			<img src="images/103.gif" class="loader1" style="display: none;"><br />
          			<div class="backbutton">Back</div> <div class="button loginsubmit">Login & Submit </div>
          			
          			      			
					<h5 style="color: #00A1E8; font-weight:bold; margin-top:10px;">Don't have an account? <a href="javascript:;" class="regLogin" style="color: #00A1E8; font-weight:bold;">Click&nbsp;here</a></h5>
          		</div>
          		
          		<div class="signupdiv" style="display: none;">
          			
          			<h3> Signup Now !</h3>
          			
          			<input type="text" id="signup_fname" name="signup_fname" value="" placeholder="First Name">
          			<input type="text" id="signup_lname" name="signup_lname" value="" placeholder="Last Nme">
          			<input type="text" id="signup_name" name="signup_name" value="" placeholder="Email">
                   <input type="text" id="home_phone" name="home_phone" value="" placeholder="Phone">
          			<input type="password" id="signup_password" name="signup_password" value="" placeholder="Password">
          			<input type="password" id="signup_password2" name="signup_password2" value="" placeholder="Confirm Password">
          			
          			<input type="hidden" name="signup_longitude" id="signup_longitude" value="">
          			<input type="hidden" name="signup_latitude" id="signup_latitude" value="">
          			
          			 <img src="images/103.gif" class="loader" style="display: none;">	
         			 <div><div class="backbutton">Back</div> <div class="button signupsubmit">Signup & Submit </div>
          			      			
					<h5 style="color: #00A1E8; font-weight:bold; margin-top:10px;">Already have an account? <a href="javascript:;" class="regSignup" style="color: #00A1E8; font-weight:bold;">Click&nbsp;here</a></h5>
          		</div>
          
           <input type="hidden" name="action" value="saveDetails" />
           		<input class="submit  more-info-btn" type="submit" value="Submit" style="display: none;">
            </div>
          		
        </section>       
</fieldset>
    
            
            
            
            
            
    <?php
	    }?>
        
<?php

if(($memload or $memberID) AND !$memb->postalcode){ ?>


<fieldset class="section">
<section>


<h5>Enter Your Missing Contact Information</h5>
<p>This is required to process your request.</p>
<input  type="hidden" class="car_brand" name="first_name" id="first_name" value="<?php echo $memb->first_name;?>"/>
<input  type="hidden" class="car_brand" name="last_name" id="last_name" value="<?php echo $memb->last_name;?>" required/>
<input  type="hidden" class="car_brand" name="email" id="email" value="<?php echo $memb->email;?>" required/>

<section>
<label for="address">Address</label>
<div><input  type="text" class="car_brand" name="address" id="address" value="<?php echo $memb->address;?>"/></div>
</section>
<section>
<label for="city">City</label>
<div><input  type="text" class="car_brand" name="city" id="city" value="<?php echo $memb->city;?>"/></div>
</section>
<section>
<label for="province">Province</label>
<div >
<?php echo state_prov("prov", $memb->province,"province","","car_brand !important;");?>
</div>
</section>
<section>
<label for="address">Postal Code / Zip</label>
<div><input  type="text" class="car_brand" name="postalcode" id="postalcode" value="<?php echo $memb->postalcode;?>"/></div>
</section>
                        <section><label for="street">Country</label>
							<div><select  name="country" class="form-control-select"id="form-country"  >
														<option value="">Country</option>
														<option value="CA" <?php echo ($memb->country=="CA")? "selected" :"";?>>Canada</option>
														<option value="US" <?php echo ($memb->country=="US")? "selected" :"";?>>United States</option>
                                                    </select></div>
</section>
<section>
<label for="best_time">Phone Number</label>
<div><input  type="text" class="car_brand" name="home_phone" id="home_phone" value="<?php echo $memb->home_phone;?>"/></div>
</section>
<?php //} ?>
	<div><div class="backbutton">Back</div> <!--<button class="submit button" name="manage_service_button" value="manage_service_button">Submit</button>-->
    
     <input type="hidden" name="action" value="saveDetails" />
       <input class="submit  " type="submit" value="Submit" style="max-width: 100px;height: 37px;border-radius: 0px; curson:pointer; z-index: 999999;">
       </div>
        <div style="text-align: justify; width:70%; margin: 20px auto; padding:20px 20px 15px 20px; border: 1px solid #ccc;text-align:center;" ><p>Carleado will not perform any credit checks with information provided. </p></div>



          </fieldset>
          
          <?php } ?>
          
          
          
                             </div>
                             
                             
                            
                     </form>
                     
    </div> <!-- End col-sm-12-->                 
                     
				</div>   
		</div>
            </div>
            </div>
           </div>
</div>
</div>
		<?php 
        $footer.="<script src=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.2/bootstrap-slider.min.js\"></script>
        <script type=\"text/javascript\">
    $(document).ready(function(){
$(\"#ex8\").slider({
	tooltip: 'always'
});
});
</script>
<script>
var rangeSlider = function(){
  var slider = $('.range-slider'),
      range = $('.range-slider__range'),
      value = $('.range-slider__value');
  slider.each(function(){
    value.each(function(){
      var value = $(this).prev().attr('value');
      $(this).html(value);
    });
    range.on('input', function(){
      $(this).next(value).html(this.value);
    });
  });
};
rangeSlider();
</script>
";
        include("footer.php");?>
        <script>
		</script>
		<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
function showTab(n) {
  /* 
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "More Info";
  }
  //... and run a function that will display the correct step indicator:
  //fixStepIndicator(n) */
}
function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
$(document).ready(function(){
  $(".submit").click(function(){
	$(".form_car").submit();
  });
  $(".form-wrapper .backbutton").click(function(){
    var button = $(this);
    var currentSection = button.parents(".section");
    var currentSectionIndex = currentSection.index();
    var headerSection = $('.steps li').eq(currentSectionIndex);
    currentSection.removeClass("is-active").prev().addClass("is-active");
    headerSection.removeClass("is-active").prev().addClass("is-active");
	  updateHeight();
  });
	
	
  $(".form-wrapper .button").click(function(){ 
	  
	 
    var button = $(this);
    var currentSection = button.parents(".section");
    var currentSectionIndex = currentSection.index();
    var headerSection = $('.steps li').eq(currentSectionIndex);
	  
	// alert(currentSectionIndex);
    
    <?php
	 if($is_mobile) {
?>
	  if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
}
// This is needed if the user scrolls down during page load and you want to make sure the page is scrolled to the top once it's fully loaded. This has Cross-browser support.
window.scrollTo(0,150);
	 <?php 	 }?>
	console.log(currentSectionIndex);
	  
	<?php if($_SESSION['memberID']=="")  { ?>
	
	if(currentSectionIndex === 9) {
		return false;
	}
	  
	<?php } ?>  
	    
	  
	
    if(currentSectionIndex === 1){
		var xxx = $('#loan_amount').val();
		//alert("maxPrice is  " + xxx);
		if(xxx == ''){
			  $('#loan_amount').focus();
			 alert("You must enter Loan Amount");
			return false;
		}
    }
	if(currentSectionIndex === 5)  {
		var xxx = $('#job_title').val();
		if(xxx == '')	{
			$('#job_title').focus()	
			alert("Please Enter Job Title");
			return false;
		}
		
		var xxx = $('#job_time').val();
		if(xxx == '')	{
			$('#job_time').focus()	
			alert("Please Enter Job Time");
			return false;
		}
	} 
	  
	if(currentSectionIndex === 6)  {
		var xxx = $('#employer_name').val();
		if(xxx == '')	{
			$('#employer_name').focus()	
			alert("Please Enter Employer Name");
			return false;
		}
		
		var xxx = $('#work_phone').val();
		if(xxx == '')	{
			$('#work_phone').focus()	
			alert("Please Enter Employer's Phone Number");
			return false;
		}
	}
	  
	  
	if(currentSectionIndex === 8)  {
		var xxx = $('select[name=preferred_contact_method]').val();
		if(xxx == '')	{
			
			alert("Please Enter Preferred Contact Method");
			return false;
		}
		
		var xxx = $('select[name=best_time]').val();
		if(xxx == '')	{
			
			alert("Please Enter Preferred Contact Time");
			return false;
		}
	} 
	
    currentSection.removeClass("is-active").next().addClass("is-active");
    headerSection.removeClass("is-active").next().addClass("is-active");
    //$(".form-wrapper").submit(function(e) {
      //e.preventDefault();
    //});
    if(currentSectionIndex === 10){
	/*	
      $(document).find(".form-wrapper .section").first().addClass("is-active");
      $(document).find(".steps li").first().addClass("is-active"); */
    }
	  
	  updateHeight();
  });
	
	
	$(".regLogin").on("click",function(){
		$(".signupdiv").show();
		$(".logindiv").hide();
		getLongLatData();
	});
	
	$(".regSignup").on("click",function(){		
		$(".signupdiv").hide();
		$(".logindiv").show();
	});
	
	
	
		
		$(".signupsubmit").on("click",function(){ 
			
			var signup_fname 	= $("#signup_fname").val();
			var signup_lname 	= $("#signup_lname").val();
			var signup_name 	= $("#signup_name").val();
            var signup_phone 	= $("#home_phone").val();
			var signup_password = $("#signup_password").val();
			var signup_password2= $("#signup_password2").val();
			var signup_longitude= $("#signup_longitude").val();
			var signup_latitude = $("#signup_latitude").val();
			
			
						
			if(signup_fname == '') {
				
				
				alert("Please enter first name!");
				$("#signup_fname").focus();
				return false;
			}
						
			if(signup_lname == '') {
				
				alert("Please enter last name!");
				$("#signup_lname").focus();
				return false;
			}
						
			if(signup_name == '') {
				
				alert("Please enter Email address!");
				$("#signup_name").focus();
				return false;
			}
            
            if(signup_phone == '') {
				
				alert("Please enter Phone Number!");
				$("#home_phone").focus();
				return false;
			}
						
			if(signup_password == '') {
				
				alert("Please Choose a Password!");
				$("#signup_password").focus();
				return false;
			}
						
			if(signup_password2 == '') {
				
				alert("Please Re-enter Password!");
				$("#signup_password2").focus();
				return false;
			}				
			
						
			if(signup_password != signup_password2) {
				
				alert("Both the Passwords don't match - Please retry");
				//$("#signup_password2").focus();
				return false;
			}
			
			
			$(this).hide();
			$(".loader").show();
		
			var data = {
				'signup_fname' 		:	signup_fname,
				'signup_lname'		:	signup_lname,
				'signup_name'		:	signup_name,
				'signup_password'	:	signup_password,
				'signup_request'	:	"1",
				'signup_latitude'	:	signup_latitude,
				'signup_longitude'	:	signup_longitude
			};
			
			
			 $.ajax({ url:'ajax_check_login.php',

				data:data,

				type:"POST",

				success: function(result) {
					
					if(result == 'error_email_exists' ) {
						$(".signupsubmit").show();
						$(".loader").hide();
						alert("Email is already associated with another account - Please choose another");
						return false;
				  	} else if(result > 5) {
						$(".more-info-btn").click();
					}
					
				}
					 
			});

		});
		
		$(".loginsubmit").on("click",function(){ 
			
			var email = $("#login_name").val();
			var pass = $("#login_password").val();
			
			$(this).hide();
			$(".loader1").show();
			
			if(email =='' || pass == '') {
				
				$(this).show();
				$(".loader1").hide();
				alert("Please enter Email & Password to login");
				if(email == '') $("#login_name").focus();
				if(email!='' && pass=='') $("#login_password").focus();
				return false;
			}
			
			
			$(this).hide();
			$(".loader1").show();
			
			var data = {
				'email' 		:	email,
				'pswd'			:	pass,
				'ajax_request'	:	"1",
			};
			
			
			$.ajax({ url:'ajax_check_login.php',

				data:data,

				type:"POST",

				success: function(result) {
					
				
					if(result < 5 ) {
						
						$(".loginsubmit").show();
						$(".loader1").hide();
						alert("Invalid Username / Password ");
						return false;
				  	} else {
						$(".more-info-btn").click();
					}
					
				}
					 
					
			});
	
			
		});
	
	
	function getLongLatData() {
		
		if (navigator.geolocation) { 

			navigator.geolocation.getCurrentPosition(showLocation); 

		} else { 

			//$('#location').html('Geolocation is not supported by this browser.'); 

		} 
	}
	
	function showLocation(position) { 

    	var latitude = position.coords.latitude; 

		var longitude = position.coords.longitude; 
		
		$("#signup_longitude").val(longitude);
		$("#signup_latitude").val(latitude);
	}
    	
	updateHeight();
});
			
	
 function updateHeight() {
	 
	 $('#content').css({
		'min-height': $('fieldset.is-active').height()+600,
		margin: 'auto'
	  });
 }
			
			
 $(document).ready(function() {
	
	 var direct = "<?php echo $direct;?>";
	 var is_mobile = "<?php echo $is_mobile;?>";
	
	 
	 if(is_mobile) {
		 $("select[name=down_payment]").on("click",function() { 
			var loan_amount = parseFloat($("#loan_amount").val());
			
			
			 if(loan_amount < 100) {
				 alert("Please enter car price first. ");
				 $("#loan_amount").fucus();
				 return false;
			 }
			  
			  $("select[name=down_payment]").children("option").removeAttr('disabled');
			 
			  $("select[name=down_payment] option").each(function(){
				
				  
				  var sval = parseFloat($(this).attr('value'));
				
				 
				  if(sval != "" &&  sval > loan_amount) {
					   $("select[name=down_payment]").children("option[value=" + sval + "]").attr('disabled','');
				  }
				  
			  });
			 
			 
			 
			 
			 
		 });
	 }
	 
	 if(direct == "") return false;
	 
	 /*$("#loan_amount").val("10000");
	 $("#car_price").val("10000");
	 $("#down_payment").attr("max","10000");
	 
	 rangeSlider();
	 */
	 
	 
	 $("#loan_amount").on("blur",function(){
		 
		
		 var loan_amount = $(this).val();
		 
		 //|| isNaN(loan_amount) == true
		 loan_amount = parseFloat(loan_amount);
		 if( loan_amount <100  ) {
			 alert("Please enter Vehicle Price larger than $100.");
			 $("#loan_amount").val("").focus();
			 return false;
		 }
		  $("#car_price").val(loan_amount);
	 	  $("#down_payment").attr("max",loan_amount);	
		  $("#down_payment").val("0");
	 	  rangeSlider();
		 
	 });
 });
			
 			
			
		
</script>
<div style="margin-top: 140px;">&nbsp;</div>
<?php
	include("includes/footer.php");
?>