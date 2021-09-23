<?php
 header("Location: http://localhost/prescriptionfiller/home.php");
die;
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
<meta name=\"language\" content=\"English\" />";
     $head.="
    <style>
html, body{
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  /*font-family: 'Saira Semi Condensed', sans-serif;*/
  font-family: 'Open Sans', sans-serif;
}
h1, h2, h3, h4, h5 ,h6{
  font-weight: 600 !important;
}
.homePage{
    font-weight:800;
    font-size:48px !important;
    }
    .homePage-mobile{
    font-weight:800;
    font-size:24px !important;
    line-height: 24px; 
    }
a{
  text-decoration: none;
}
p, li, a{
  font-size: 14px;
}
.container{
    padding-left:0px !important;
}
.works{
    margin-bottom:20px;
    margin-top:30px;
    width:50%;
    }
#pageForm.fieldset{
  margin: 0;
  padding: 0;
}
";
if($is_mobile){ 
$head.="
fieldset{
    max-width: 400px !important;
  /* margin-left: -10px !important;*/ 
  max-width:95vw;
   padding-block-start:0px;
   padding-left:0px !important;
   margin-left:0px !important;
   margin-top:-20px !important;
  }
  ";
}else{
    $head.="
fieldset{
     max-width: 400px !important; 
  /*margin-left:-30px !important;*/
  max-width:95vw;
  padding-block-start:0px;
  padding-left:0px !important;
  margin-left:0px !important;
  }
  ";
    }
 $head.=" 
/* GRID */
.twelve { width: 100%; }
.eleven { width: 91.53%; }
.ten { width: 83.06%; }
.nine { width: 74.6%; }
.eight { width: 66.13%; }
.seven { width: 57.66%; }
.six { width: 49.2%; }
.five { width: 40.73%; }
.four { width: 32.26%; }
.three { width: 23.8%; }
.two { width: 15.33%; }
.one { width: 6.866%; }
/* COLUMNS */
.col {
	display: block;
	float:left;
	margin: 0 0 0 1.6%;
}
.col:first-of-type {
  margin-left: 0;
}
#pageForm.container{
  width: 100%;
  max-width: 100%;
  margin: 0 auto;
  position: relative;
text-align:center;
}
#pageForm.row{
  padding: 20px 0;
}
/* CLEARFIX */
.cf:before,
.cf:after {
    content: \" \";
    display: table;
}
.cf:after {
    clear: both;
}
.cf {
    *zoom: 1;
}
#pageForm.wrapper{
  width: 100%;
  margin: 30px 0;
}
/* STEPS */
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
  padding: 10px 10px 30px 10px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
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
 /* width: 100%;*/
  /*min-height: 400px;*/
}
.form-wrapper .section h3{
  margin-bottom: 10px;
}
.form-wrapper .section.is-active{
  opacity: 1;
  -webkit-transform: scale(1, 1);
  -ms-transform: scale(1, 1);
  -o-transform: scale(1, 1);
  transform: scale(1, 1);
  /*border:1px solid #ccc;*/
}
.form-wrapper .button, .form-wrapper .submit{
  background-color: #3498db;
  display: inline-block;
  padding: 8px 30px;
  color: #fff;
  cursor: pointer;
  font-size: 16px !important;
  font-family: 'Open Sans', sans-serif !important;
  /*position: absolute;
  right: 20px;
  bottom: 20px;*/
  margin-top:20px;
  border-radius:5px;
  /*z-index: 999999;*/
}
.form-wrapper .backbutton {
  background-color: #3498db;
  display: inline-block;
  padding: 8px 30px;
  color: #fff;
  cursor: pointer;
  font-size: 16px !important;
  font-family: 'Open Sans', sans-serif !important;
  /*position: absolute;
  right: 20px;
  bottom: 20px;*/
  margin-top:5px;
  border-radius:5px;
  /*z-index: 999999;*/
}
.form-wrapper .submit{
  border: none;
  outline: none;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  cursor:pointer;
  z-index: 999999;
}
.form-wrapper input[type=\"text\"],
.form-wrapper input[type=\"password\"]{
  display: block;
  padding: 10px;
  margin: 2px auto;
  background-color: #fff !important;
  border: none;
  width: 50%;
  outline: none;
  font-size: 14px !important;
  font-family: 'Open Sans', sans-serif !important;
  width:330px !important;
  max-width:95vw !important;
}
.form-wrapper input[type=\"radio\"]{
  display: none;
}
.form-wrapper input[type=\"radio\"] + label{
  display: block;
  border: 1px solid #ccc;
  width: 100%;
  max-width: 100%;
  padding: 10px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  cursor: pointer;
  position: relative;
}
.form-wrapper input[type=\"radio\"] + label:before{
  content: \"?\";
  position: absolute;
  right: -10px;
  top: -10px;
  width: 30px;
  height: 30px;
  line-height: 30px;
  border-radius: 100%;
  background-color: #3498db;
  color: #fff;
  display: none;
}
.form-wrapper input[type=\"radio\"]:checked + label:before{
  display: block;
}
.form-wrapper input[type=\"radio\"] + label h4{
  margin: 15px;
  color: #ccc;
}
.form-wrapper input[type=\"radio\"]:checked + label{
  border: 1px solid #3498db;
}
.form-wrapper input[type=\"radio\"]:checked + label h4{
  color: #3498db;
}
h3{
    margin-top: 30px;
}
optgroup{
    font-size:24px;
    padding:10px 0px 10px 50px;
}";
$selectWidth=($is_iOS)? "380" : "330";
$head.="
select{
    font-size:18px !important;
    font-weight:600;
    border-color:#ccc !important;
    /*padding: 8px 25px 20px 25px !important;*/
    margin: 8px 6px -20px 0px !important;
    width:".$selectWidth."px !important;
    max-width: 95vw !important; 
   background-color: #fff;
   }
   
 select:hover{
    border-width:1px !important;
    }
   
select {
    option:focus{
    outline: 0px transparent !important;
    }
}
   option{
font-size:18px !important; 
line-height:24px !important;
padding: 5px 10px 10px 20px !important;
}
input[type='checkbox']{
    height:30px;
    width: 30px;
    color:green;
    margin-left: 20px;
    line-height: 36px; 
}
input [type='text']{
    width:330px !important;
    }
ul{
  /*  margin-right: -30px !important; */
}
.pmtMethod{
    cursor:pointer;
    z-index: 999999;
    }
.more-info-btn{
    max-width:300px;
    }
/* On screens that are 992px or less, set the background color to blue */
@media screen and (max-width: 992px) {
  .steps li {
        margin: 10px;
        }
        .container{
    padding-left:0px !important;
}
.more-info-btn{
    max-width:50vw;
    text-align:center;
    cursor:pointer;
    z-index: 999999;
    }
}
    </style>
    <script type=\"text/javascript\" src=\"modal-html5-video.js\"></script>
<link rel=\"stylesheet\"  href=\"css/modal-video.css\" />
    ";
    /*
    <script src=\"bigpicture-master/src/BigPicture.js\"></script>
     <script>
    	;(function() {
    function setClickHandler(id, fn) {
					document.getElementById(id).onclick = fn
				}
    setClickHandler('video_container', function(e) {
					var className = e.target.className
					if (~className.indexOf('htmlvid')) {
						BigPicture({
							el: e.target,
							vidSrc: e.target.getAttribute('vidSrc'),
						})
					} 
                    )}
                    )}
</script>
 "; 
   */
	include("includes/head.php");
    include("includes/header.php");
    include("includes/lib/classes/a/vehicles.php");
  require("includes/lib/classes/a/applications.php");
    $vehicles = new vehicles();
   $getMakes=$vehicles->getlistMake();
   $getClass=$vehicles->getlistClass();
   $apps = new applications();
//$request->postvalue('vehicle_make');
if($request->postvalue('vehicle_make') or $request->postvalue('vehicle_body_type')){
                $apps->application_type				    =	$request->postvalue('application_type');
                $apps->vehicle_make                     =	$request->postvalue('vehicle_make');
                $apps->vehicle_model                    =	$request->postvalue('vehicle_model');
                $apps->vehicle_max_price                =	$request->postvalue('vehicle_max_price');
                $apps->vehicle_max_miles                =	$request->postvalue('vehicle_max_miles');
                $apps->vehicle_category                 =	$request->postvalue('vehicle_category');
                $apps->payment_method                   =   $request->postvalue('payment_method');
                $apps->preferred_payment                =   $request->postvalue('preferred_payment');
                $apps->vehicle_body_type                =   $request->postvalue('vehicle_body_type');
				$app->date_submitted					=	date("Y-m-d H:i:s");
				$apps->member_id						=	$_SESSION['memberID'];
                $apps->save();
                $last_id=$apps->id;
              echo"<meta http-equiv=\"refresh\" content=\"0; url=https://carleado.com/vehicle_details.php?memberID={$apps->member_id}&id=".$last_id."\">";
              die;
}
?>
</style>
    <script type="text/javascript">
$(document).ready(function(){
    $('#make').on('change',function(){
        var make = $(this).val();
        if(make){
            $.ajax({
                type:'POST',
                url:'ajaxVehicleData.php',
                data:'make='+make,
                success:function(html){
                    $('#model').html(html);
                }
            }); 
        }else{
            $('#model').html('<option value="">Select make first</option>');
        }
    });
});
</script>
<style>
	.section5 input[type=text],.section5 input[type=password] {
		width: 47% !important;
		border-radius: 5px;
		border:2px solid #DDD;
        display:inline !important;
	}
</style>
<!--==========================
    Header
  ============================-->
  <?php
	$cbanner=($is_mobile)? '<div>' : '<div class="carleado-banner">';
    echo $cbanner;
?>
<div class="container home-banner">
<?php
$rowBG=($is_mobile AND !$is_tablet )? "" : "style=\"background-image: url(../images/Caleado-Car-Buying-Program.png);
    background-repeat: no-repeat;background-position:right; margin-top:80px;\"";
?>
		<div class="row"  <?php echo $rowBG; ?>  >
              <div class="col-md-6 carleado-col" id="pageForm" style="min-height: 550px;">
    <div class="wrapper"  >
      <form class="form-wrapper form_car" method="post"  >
      <?php
	if($is_mobile AND !$is_tablet){ ?>
    <img src="../images/Caleado-Car-Buying-Program.png" style="height: 25vh; min-height: 160px; max-width:500px;  display:block; margin:70px auto 0 auto; ">
     <div class="car-buying-exp-mobile" style="padding-left: 20px;margin-top:10px;  ">
					<div style="font-size:16px; margin-bottom: 0px; line-height:16px; text-transform:uppercase;">Compare Lowest Priced</div>
					<div class="homePage-mobile" ><span style="color: #00A1E8; margin-top:0px; font-weight:600;">OFFERS FROM</span><br /><span style="font-weight: 600;">LOCAL DEALERS</span>      
                    <style>
                    .videoButton-mobile{                        
                        background-color: #000;
                        font-size:16px;
                        color: #fff;
                        border-radius:10px;
                        padding:5px 10px;
                        display:inline;
                        line-height:16px;
                        margin-top: 0px;
						float:right;
						width:120px;                        
                    }
                    .videoIcon-mobile{
                        width:40px;
                        height:40px;
                        text-align:center;
                        border: 2px solid #fff;
                        border-radius:50%;
                        display:inline-block;
                    }
                    .fa-play{
                    margin: 5px 0 0 6px; font-size: 24px;
                    }
                    .howIt{
                        display: inline-block;
                        margin-top:10px;
                    }
                    @media screen and (orientation:portrait)and (max-width:640px) {
                        .videoButton-mobile{
                        background-color: #000;
                        font-size:12px;
                        color: #fff;
                        border-radius:10px;
                        padding:10px 5px;
                        display:inline;
                        line-height:14px;
                        word-spacing: -1px;
                        float:right;
                        margin-top: -30px;
                        border:none;
                    }
                    .videoIcon-mobile{
                        width:25px;
                        height:25px;
                        text-align:center;
                        border: 2px solid #fff;
                        border-radius:50%;
                        display:inline-block;
                    }
                    .fa-play{
                        margin: 2px 0 0 5px; 
                        font-size: 16px;
                    }
                     .howIt{
                        display: inline-block;
                        margin-top:-2px;
                        padding-right:5px;
                    }
                    table .howTable td{
                        padding-right:5px;
                    }
                        }
                    @media screen and (orientation:landscape) and (max-width:960px){
                        .videoButton-mobile{
                        background-color: #000;
                        font-size:12px;
                        color: #fff;
                        border-radius:10px;
                        padding:15px 5px;
                        display:inline;
                        line-height:14px;
                        word-spacing: -1px;
                        float:right;
                        margin-top: -40px;
                        border:none;
                    }
                    .videoIcon-mobile{
                        width:25px;
                        height:25px;
                        text-align:center;
                        border: 2px solid #fff;
                        border-radius:50%;
                        display:inline-block;
                    }
                    .fa-play{
                        margin: 2px 0 0 5px; 
                        font-size: 16px;
                    }
                     .howIt{
                        display: inline-block;
                        margin-top:-2px;
                        padding-right:5px;
                    }
					.howTable{padding-top:90px}
                    table .howTable td{
                        padding-right:5px;
                    }
                        }
                    </style>
       <button class="videoButton-mobile" data-modal="#modal-html5-video">
       <table class="howTable"><tr><td><div class="howIt" >How It Works<br />Video</div></td> <td><div class="videoIcon-mobile"><i class="fa fa-play" aria-hidden="true" ></i></div></td></tr></table></button>
<div class="modal-window modal" data-modal-window id="modal-html5-video">
<?php $videoStyle=($is_mobile)? " style=\"width:100vw !important; margin:0 0 0 -20px !important;\"" : "style=\"max-width:80vw;z-index:9999999;\""; ?>
  <video <?php echo $videoStyle; ?> controls >
    <source src="https://carleado.com/images/Carleado.mp4" type="video/mp4">
  </video>
  <button data-modal-close>Close</button>
</div>  
                    </div>
 <?php   }else{ ?>
     <style>
                    .videoButton{
                        background-color: #000;
                        font-size:16px;
                        color: #fff;
                        border-radius:10px;
                        padding:5px 20px;
                        display:inline;
                        line-height:16px;font-size:24px;
						cursor:pointer
                    }
                    .videoIcon{
                        width:40px;
                        height:40px;
                        text-align:center;
                        border: 2px solid #fff;
                        border-radius:50%;
                        display:inline-block;
                        margin-left:20px;
                    }
                    <?php if($is_tablet){ ?>
                    .car-buying-exp{
                        background-color: rgba(255,255,255,0.8); 
                        max-width:52vw;
                        }
                    fieldset{
                        background-color: rgba(255,255,255,0.8) !important;
                        width:60vw !important;
                    }
                    .videoButton{
                        width:100%;
                        }
                    <?php } ?>
                    </style>
      <div class="car-buying-exp" >
					<h3 style="margin-bottom: 0px;">Compare Lowest Priced  </h3>
					<h1 class="homePage"><span >OFFERS FROM</span><br />LOCAL DEALERS</h1>
                    <button class="videoButton" data-modal="#modal-html5-video">How It Works Video<div class="videoIcon"><i class="fa fa-play" aria-hidden="true" style="margin: 5px 0 0 6px; font-size: 24px;"></i></div></button>
<div class="modal-window modal" data-modal-window id="modal-html5-video">
  <video style="max-width:80vw;" controls >
    <source src="https://carleado.com/images/Carleado.mp4" type="video/mp4">
  </video>
  <button data-modal-close>Close</button>
</div>  
<?php
	}
?>
					<?php
	//<a href="#" class="how-work-btn">see how it works</a>
    $imgSize=($is_mobile)? " style='max-width:50vw;' " : " style='max-width:200px;' ";
?>
        <!--
<a href="choose-test.php" ><img src="images/start-button3.png" <?php echo $imgSize;?> alt="Start Button" ></a>
-->
				</div>
               <?php  if($is_mobile){ 
                $leftOffset="12px"; 
                 if($is_iOS){
                    $leftOffset="18px"; 
                 }
                //$selectLeftAdjust=" style='margin-left:10px !important;' ";
                //$selectLeftAdjust2=" margin-left:10px !important; ";
                ?>
               <fieldset class="	section is-active" style="max-width: 90vw; margin:0 auto;">
                    <?php 	}else{ 
                        $leftOffset="0";
                        ?>
        <fieldset class="	section is-active" >
        <?php }?>
          	<div style="margin: 0px 0 0 <?php echo $leftOffset; ?>;">
                        <?php
//	<h3 >Tell Us the make and model you are looking for:</h3>
?>
						<select class="car_brand range" id="make" name="vehicle_make">
                        <optgroup>
						<option value="">Select Make</option>
                        <?php
							 foreach($getMakes as $list) { 
							   	$list2	=	str_replace(" ","_",$list['make']);
								echo "<option value=\"$list2\">".$list['make']."</option>";
							}
						?>	
        				</optgroup>          
						</select><br />	
						<select class="car_brand" id="model" name="vehicle_model" >
    <option value="" >Select Model</option>
						</select><br />
                        <?php $fontSize=($is_mobile)? " style=\"font-size:18px; letter-spacing:-1px;\" " : "";  ?>                    
                      <?php
/*	<div <?php echo $fontSize;?> style="font-variant-caps: all-small-caps;"><strong></strong></div> */
?>
                     <select class="car_brand" name="vehicle_body_type" >
						<option value="">Or Choose a Body Type</option>
						<option value="Sedan">Sedan</option>
						<option value="Coupe">Coupe</option>
						<option value="Hatchback">Hatchback</option>
						<option value="Convertible">Convertible</option>
						<option value="SUV">SUV</option>
                        <option value="Crossover">Crossover</option>
						<option value="Minivan">Minivan</option>
                       	<option value="Pickup Truck">Pickup Truck</option>
                        <option value="Station Wagon">Station Wagon</option>
                        <option value="Hybrid/Electric">Hybrid/Electric</option>
						</select><br />   
          </div>
          <div class="button">Next</div><br />
          <div style="float:right;" ><a href="dealer_application.php" style="color: #00A1E8 !important;"><strong>Are You A Dealer?</strong></a></div><br />
        </fieldset>
        <fieldset class="section"  style="max-width: 90vw; margin:0 auto;">
        <div style="margin: 0px 0 0 <?php echo $leftOffset; ?>;">
          <h3>Choose Your Maximum Price</h3>
		<select id="maxPrice" class="car_brand" name="vehicle_max_price" <?php echo $selectLeftAdjust; ?> required />
			<option value="Maximum Price">Maximum Price</option>
			<?php
			for($i=1000;$i<=10000;$i+=1000){
			echo "<option value=\"$i\">$".number_format($i)."</option>";
			}
			for($i=11000;$i<=17000;$i+=2000){
			echo "<option value=\"$i\">$".number_format($i)."</option>";
			}
			for($i=20000;$i<=30000;$i+=5000){
			echo "<option value=\"$i\">$".number_format($i)."</option>";
			}
			for($i=30000;$i<=75000;$i+=10000){
			echo "<option value=\"$i\">$".number_format($i)."</option>";
			}
			for($i=80000;$i<=350000;$i+=20000){
			echo "<option value=\"$i\">$".number_format($i)."</option>";
			}
			?>
			</select>
         <br />
         <div class="backbutton">Back</div> <div class="button">Next</div><br />
         </div>
        </fieldset>
        <fieldset class="section" >
        <div style="margin: 0px 0 0 <?php echo $leftOffset; ?>;">
          <h3>Choose Maximum Kilometres</h3>
         <select id="maxMiles" class="car_brand" name="vehicle_max_miles" <?php echo $selectLeftAdjust; ?> required>
         				<optgroup>
                        <option value="Maximum Kilometres">Maximum Kilometres</option>
                        <?php
                         echo "<option value=\"1000\">".number_format("1000")."</option>";
                         echo "<option value=\"5000\">".number_format("5000")."</option>";
						 echo "<option value=\"10000\">".number_format("10000")."</option>";
						for($i=20000;$i<=450000;$i+=20000){
						   echo "<option value=\"$i\">".number_format($i)."</option>";
						}
?>						</optgroup>
						</select>
         <br />
        <div class="backbutton">Back</div>  <div class="button">Next</div><br />
         </div>
        </fieldset>
     <?php
        $iOS_offset=($is_iOS)? " margin-left:15px !important; ": "";
$iOS_offsetFull=($is_iOS)? " style='margin-left:25px !important;' ": "";         
?>
        <fieldset class="section" style="<?php echo $iOS_offset; ?>   width:<?php echo ($selectWidth); ?>px;">
        <div style="margin: -30px 0 0 <?php echo $leftOffset; ?>;">
          <h3 >Choose Your Payment Method</h3>
          	<div id="financeCheck" style="max-width: 900px; margin: 0 auto; font-size:24px; ">
            <div class="row" >
            <div class="row col-sm-12" style="width:<?php echo $selectWidth; ?>px;">
            <?php $mleft=($is_mobile)?  " float:left; text-align:left;" :" text-align:center;";
            $checkBox=($is_mobile)?  " style='margin-left: ".(($selectWidth/4)+20)."px; float:left;' " :"";
            $checkBox1=($is_mobile)?  " style='margin-left: ".(($selectWidth/4)+35)."px; float:left;' " :"";
            ?>
            	<div class="col-xs-9 col-sm-4 offset-xs-3" style="<?php echo $mleft;?> font-size:16px; margin-bottom: 10px;  padding:0px !important;" >
                <input type="checkbox" name="payment_method" value="financing" class="pmtMethod" <?php echo $checkBox1; ?>/>&nbsp;&nbsp;Financing 
            </div>
            <div class="col-xs-9 col-sm-4 offset-xs-3"  style="<?php echo $mleft;?>font-size:16px; margin-bottom: 10px; " >
            <input type="checkbox" name="payment_method" value="cash" class="pmtMethod"  <?php echo $checkBox; ?>/>&nbsp;&nbsp;&nbsp;Cash</div>
				<div class="col-xs-9 col-sm-4 offset-xs-3"  style="<?php echo $mleft;?>font-size:16px; margin-bottom: 10px;"  >
				<input type="checkbox" name="payment_method" value="Not Sure" class="pmtMethod"  <?php echo $checkBox; ?>/>&nbsp;&nbsp;Not&nbsp;Sure</div>
            </div>
           </div> 
                </div>
               <?php if($_SESSION['memberID'] == "") { ?>
               <div class="backbutton"  >Back</div>  <div class="button">Next</div><br />
               <?php } else { ?>
               <div class="backbutton" >Back</div><input class="submit  more-info-btn" type="submit" value="Submit" style="width: 75px; margin:10px;"><br />
               <?php } ?>
               </div>
        </fieldset>
        <?php if($_SESSION['memberID'] == "") { ?>
        <fieldset class="section section5">
        <div style="margin: 0px 0 0 <?php echo $leftOffset; ?>;">
          	<div style="max-width: 900px; margin: -5px auto 0 auto; font-size:24px; padding:0 0px; width:<?php if($is_mobile){echo $selectWidth;}else{echo "330";} ?>px;">
          		<div class="logindiv">
          			<h3 style="margin-top: 0px; padding-top: 0px;"> Login to your Account</h3>
          			<input type="text" id="login_name" name="login_name" value="" placeholder="Email" style="width:100% !important; <?php echo $selectLeftAdjust2; ?> ">
          			<input type="password" id="login_password" name="login_password" value="" placeholder="Password"  style="width:100% !important; <?php echo $selectLeftAdjust2; ?> ">
          			<img src="images/103.gif" class="loader1" style="display: none;">
          			<div class="backbutton">Back</div> <div class="button loginsubmit">Login & Submit </div>
					<a href="javascript:;" class="regLogin" style="color: #00A1E8;"><h5 style="margin-top: 10px;"> Don't have an account? Click&nbsp;here</h5></a>
          		</div>
          		<div class="signupdiv" style="display: none; margin-top: 0px; " >
          			<h3 style="margin-top: 0px; padding-top: 0px;"> Sign Up Now!</h3>
          			<input type="text"  id="signup_fname" name="signup_fname" value="" placeholder="First Name"<?php echo $selectLeftAdjust; ?> required>
          			<input type="text"    id="signup_lname" name="signup_lname" value="" placeholder="Last Name"  required/>
          			<input type="text"  id="signup_name" name="signup_name" value="" placeholder="Email" required style="width:95% !important;<?php echo $selectLeftAdjust2; ?>">
                    <input type="text"  id="signup_phone" name="signup_phone" value="" placeholder="Phone" required style="width:95% !important; <?php echo $selectLeftAdjust2; ?>">
          			<input type="password"   id="signup_password" name="signup_password" value="" placeholder="Password" <?php echo $selectLeftAdjust; ?> required>
          			<input type="password"   id="signup_password2" name="signup_password2" value="" placeholder="Confirm Password"   required >
          			<input type="hidden" name="signup_longitude" id="signup_longitude" value="">
          			<input type="hidden" name="signup_latitude" id="signup_latitude" value="">
          			 <img src="images/103.gif" class="loader" style="display: none;">	
         			 <div><div class="backbutton">Back</div> <div class="button signupsubmit">Sign Up & Submit </div>
					<a href="javascript:;" class="regSignup" style="margin-top: 10px;"><h5 style="color: #00A1E8;">Have an account? Click&nbsp;here</h5></a>
          		</div>
           		<input class="submit  more-info-btn" type="submit" value="Submit" style="display: none;">
            </div>
        </div>
		</fieldset>
     	<?php } ?>
      </form>
    </div>
  </div>
		</div>
	</div>
    		<?php
	//	<div class="col-md-6 carleado-col" >
//			&nbsp;
//			</div>
?>
	</div>
    </div>
    </div>  <?php   ///////// Won't test but terminates the $cbanner '?>
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
function showTab(n) {
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
  fixStepIndicator(n)
}
function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}
function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
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
</script>
 <!--==========================
 ============================-->
  <!--	<main class="page">
        <section class="work-stratigies">
       ================================
		 Welcome Section
	==================================-->
<?php
	/**
 * 	<div class="carleado-welcome text-center">
 * 		<h2 class="section-heading">Welcome to <span class="text-sky-blue">CarLeado</span></h2>
 * 		<p>let dealers compete for you</p>
 * 	</div>
 */
?>
   	<!--================================
		 How It Works
	==================================-->
	<main class="page">
    <?php
	$howWorks=($is_mobile)? " style='margin-top:80px;'": "";
?>
    <div style="text-align: center;">  
	<div class="how-it-works text-center">   
		<div class="container">    
			<h2 class="section-heading text-center" <?php echo $howWorks; ?> >How It Works</h2>    
			<div class="row justify-content-center features" style="padding: 10px;">                
				<div class="col-sm-4 col-md-4 col-lg-4">                    
					<div class="xxbox"><img class="works" src="../images/select-your-desired-vehicle.png" alt="select your desired vehicle" />                        
						<h3>Select Your Desired Vehicle</h3> 
						<div><span style="font-size: 18px; font-weight: normal;">Tell us the make/model, max km, max price of the vehicle you�re looking for and if you need financing. If you don't know the vehicle you're looking for, select by body type. You may also refine your choice further if you know exactly what you're looking for.</span></div>                        </div>                
                        </div>  
				<div class="col-sm-4 col-md-4 col-lg-4">                    
					<div class="xxbox"><img class="works" src="../images/compare-and-shortlist.png" alt="select your desired vehicle" />                        
						<h3>Compare and Shortlist</h3> 
						<div><span style="font-size: 18px; font-weight: normal;">Compare the best offers and shortlist the ones you like.</span></div>                        </div>                
                        </div>                
				<div class="col-sm-4 col-md-4 col-lg-4">                    
					<div class="xxbox"><img class="works" src="../images/arrange-time-to-view.png" alt="select your desired vehicle" />                        
						<h3>Arrange a time to view</h3>                        
						<div><span style="font-size: 18px; font-weight: normal;">When you have shortlisted a vehicle, your contact information will be exchanged with the dealer to arrange a time to view the vehicle. Contact information will only be exchanged if you add a vehicle to your shortlist.</span></div>   </div>   </div>            
   </div>        
   </div>    
   </div> 
    </div>
        <?php
	 /*  <div class="how-it-works text-center" <?php echo $howWorks; ?> >
		   <div class="container">
                    <h2 class="section-heading text-center">How It Works</h2>
            <div class="row justify-content-center features">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="xxbox"><span class="vehiclexxx-img"></span>
                    <img  class="works" src="../images/select-your-desired-vehicle.png" alt="select your desired vehicle">
                        <h3>Select Your Desired Vehicle</h3>
                        </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="xxbox"><span class="preferencesxxx-img"></span>
                      <img class="works" src="../images/compare-and-shortlist.png" alt="select your desired vehicle">
                        <h3 >Compare and Shortlist</h3>
                        </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="xxbox"><span class="price-quotesxxx-img"></span>
                      <img class="works"  src="../images/arrange-time-to-view.png" alt="select your desired vehicle">
                        <h3 >Arrange a time to view</h3>
                        </div>
                </div>
            </div>
        </div>
    </div> 
    */
?>
<?php
	/*		   <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="box trusted-img">
                        <h3>Trusted reviews</h3>
                        <p class="description">Honest reviews from Canada's trusted motor journalists</p></div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="box accredited-img">
                        <h3>Accredited dealers</h3>
                        <p class="description">Accredited dealers across Canada</p></div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="box concierge-img">
                        <h3>Concierge service</h3>
                        <p class="description">Dedicated experts to make your car buying journey easy</p></div>
                </div>
            </div>
    </div></section>
    */
?>
    </main>
 <?php
    require("includes/lib/classes/a/testimonials.php"); 
function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}
$test = new testimonials();
$records=$test->getlist();
?>
	<section class="page" style="background-color:#fff !important;">
		<div class="clients-reviews">
		<div class="container">
                    <h2 class="text-center">Client Reviews</h2>
		  <div class="swiper-container testimonial-slider">
			<div class="swiper-wrapper" >
          	<!-- first-slide -->
            <?php foreach($records as $record) { ?>
			  <div class="swiper-slide ">
				  <div class="row">
					  <div class="slider-text">
							<span><?php echo cleanit(truncate($record['contents'],200)); ?></span>
							<strong class="text-center"><?php echo cleanit($record['name']); ?></strong>
							<strong class="ceo text-center"><?php echo cleanit($record['contact']); ?></strong>
						</div>
					</div>
			</div>
<?php	}
?>
			</div>
			<!-- Add Arrows -->
<?php /*
				<div class="next-prev-btn">
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			</div>
            */            
?>
		  </div>
		</div>
		</section>
  <!--======== Accredited Dealers Slider=====-->
		<?php
/*	<main class="page">
		<div class="dealers-sliders">
		<div class="container">
		<h3>Accredited Dealers </h3>
		  <div class="swiper-container dealers-slider ">
			<div class="swiper-wrapper" 
			<!-- first-slide -->
			  <div class="swiper-slide">
				  <div class="row"> 
					  <div class="slider-img">
							 <img src="images/dealer-logo1.png" alt=""/>
							</div>
					</div>
			  </div>
			   <!-- first-slide -->
			 <div class="swiper-slide">
				  <div class="row"> 
					  <div class="slider-img">
							 <img src="images/dealer-logo2.png" alt=""/>
							</div>
					</div>
			  </div>
			  <div class="swiper-slide">
				  <div class="row"> 
					  <div class="slider-img">
							 <img src="images/dealer-logo3.png" alt=""/>
							</div>
					</div>
			  </div>
			<div class="swiper-slide">
				  <div class="row"> 
					  <div class="slider-img">
							 <img src="images/dealer-logo4.png" alt=""/>
							</div>
					</div>
			  </div>
			  <div class="swiper-slide">
				  <div class="row"> 
					  <div class="slider-img">
							 <img src="images/dealer_logo_5.png" alt=""/>
							</div>
					</div>
			  </div>
			</div>
			<div class="swiper-pagination"></div>
			<!-- Add Arrows -->
				<div class="next-prev-btn">
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div></div>
		  </div>
		</div>
		</main>
<!--==========================
		Our Commitment
  ============================-->
  <div class="commitment-section">
	<h2 class="section-heading text-center">Our Commitment</h2>
	 <div class="container">
		<div class="row">
			<div class="col-md-6">`
			<div class="reputed-dealer text-center">
			<img src="images/no-fees.png" alt=""/>
				<h3>Carleado charges you no fees or commissions. </h3>
			</div>
			</div>
			<div class="col-md-6">
			<div class="reputed-dealer text-center">
				<img src="images/reputed-dealer.png" alt=""/>
				<h3>Only the most reputable dealers are listed</h3>
			</div>
			</div>
		</div>
	 </div>
  </div>
  */
?>
  <!--==========================
    Need Help
  ============================-->
  <?php
  /*
	<div class="need-help-section">
	<div class="container">
		<div class="need-help-inner">
			<h2 class="section-heading">Need Help?</h2>
			<p>Have a question about CarLeado?</p> 
			<p>The best way to reach us is to <a href="contact">send us a message</a>.</p>
			<p>Or feel free to give us a call on </p>
			<strong class="section-heading">800-555-5555</strong>
			<p>Tell us how we can help. and our Customer Service team will help you find you the best deals.</p>
		</div>
	</div>
  </div>
  */
  $pageName="home";
	include("includes/footer.php");
?>
<script src="js/app.js"></script>
<script>
    $(document).ready(function(e) {
        $("#propVal,#mortAmt").on("focus",function(){
                $(this).val('');
        });
    });
</script>
<script>
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
  });
  $(".form-wrapper .button").click(function(){
    var button = $(this);
    var currentSection = button.parents(".section");
    var currentSectionIndex = currentSection.index();
    var headerSection = $('.steps li').eq(currentSectionIndex);
	var is_mobile = '<?php echo $is_mobile;?>';
	currentSectionIndex = currentSectionIndex - 1;  
	if(is_mobile)  {
		//currentSectionIndex = currentSectionIndex - 1;
	}
	//alert(currentSectionIndex); return false;
	// don't do anything for buttons on step 5  
	if(currentSectionIndex === 5 || currentSectionIndex === 6) {
		return false;
	}
	if(currentSectionIndex === 1)   {
		var make = $("#make").val();
		var model = $("#model").val();
		var body_type = $("select[name=vehicle_body_type]").val();
		if(make != "" && model == "") {
			alert("Please choose Make & Model");
			return false;
		}
		if(make == "" && body_type == "" ) {
			alert("Please select either the Make and Model, or the Body Type");
			return false;
		}
	}
    if(currentSectionIndex === 2){
		var xxx = $('#maxPrice').val();
		//alert("maxPrice is  " + xxx);
		if(xxx == 'Maximum Price'){
			 alert("You must enter a Maximum Price ");
			return false;
		}
    }
	if(currentSectionIndex === 3)  {
		var xxx = $('#maxMiles').val();
		if(xxx == 'Maximum Kilometres')	{
			alert("You must enter a Maximum Kilometres");
			return false;
		}
	} 
    currentSection.removeClass("is-active").next().addClass("is-active");
    headerSection.removeClass("is-active").next().addClass("is-active");
    //$(".form-wrapper").submit(function(e) {
      //e.preventDefault();
    //});
    if(currentSectionIndex === 5){
      $(document).find(".form-wrapper .section").first().addClass("is-active");
      $(document).find(".steps li").first().addClass("is-active");
    }
  });
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
	$(document).ready(function(){
		$(".signupsubmit").on("click",function(){ 
			var signup_fname 	= $("#signup_fname").val();
			var signup_lname 	= $("#signup_lname").val();
			var signup_name 	= $("#signup_name").val();
            var signup_phone 	= $("#signup_phone").val();
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
				$("#signup_phone").focus();
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
                'signup_phone'		:	signup_phone,
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
				  	} else if(result > 2) {
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
		// changes behavior of the checkboxes to theat of a radio button.     
		$("input:checkbox").on('click', function() {
		  var $box = $(this);
		  if ($box.is(":checked")) {
			var group = "input:checkbox[name='" + $box.attr("name") + "']";
			$(group).prop("checked", false);
			$box.prop("checked", true);
		  } else {
			$box.prop("checked", false);
		  }
		});
		$("#make,#model").on("change",function() {
			var selected = $(this).val();
			if(selected!="") {
				$("select[name=vehicle_body_type]").val("");
			}
		});
		$("select[name=vehicle_body_type]").on("change",function() {
			var selected = $(this).val();
			if(selected!="") {
				$("#make,#model").val("");
			}
		})
	}); // jQuery Ready !
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
</script>
<?php
	//include("includes/footer.php");
	echo "<script type=\"text/javascript\" src=\"modal-html5-video.js\"></script>";
?>