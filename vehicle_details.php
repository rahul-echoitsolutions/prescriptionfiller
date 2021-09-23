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


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$head.="
<title>Carleado</title>
<meta name=\"description\" content=\"Carleado - The new way to buy a car\" />
<meta name=\"robots\" content=\"index,follow\" />
<meta name=\"googlebot\" content=\"index,follow\" />
<meta content=\"General\" name=\"Rating\" />
<meta name=\"language\" content=\"English\" />
<style>
form input{
    border:thin solid #ccc;
    border-radius:5px;
    padding:2px 10px 2px 15px !important;
   
    }";
    
 $selectWidth=($is_iOS)? "370" : "330";
    
$head.="
form  select{
    border:thin solid #ccc;
    border-radius:5px;
    padding:5px 10px 5px 15px !important;
    width:".$selectWidth."px !important;
    max-width: 95vw;
    background-color: #fff;
    }
form select option span{
    font-size:50%;
    }
form textarea{
    max-width:90vw;
    }
label{
    font-weight:800;
    font-size:14px;
    margin-bottom:1px !important;
    margin-top:15px !important;
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
.carguy{
     -webkit-transform: scaleX(-1);
  transform: scaleX(-1);
  float:left;
  }
#carImageText p{
    { 
    opacity:0;
    transition: opacity 10s;
    -webkit-transition: opacity 10s; /* Safari */
}
.carDetail div{
    font-size:150% !important;
    font-weight:bold  !important;
    }
}
</style>
";
$body=" onload=\"document.getElementById(carImageText).style.opacity='1'\" ";

include("includes/head.php");
include("includes/header.php");
require("includes/lib/classes/a/applications.php");
require("includes/lib/classes/a/members.php");
require("includes/lib/classes/a/dealers.php");
$memb = new members();
$dealers = new dealers();


  $memberID   = $request->getvalue('memberID');
  $_SESSION['memberID'] = ( $_SESSION['memberID'])?  $_SESSION['memberID'] :$memberID;


if(!$_SESSION['memberID']){
       
    echo "Got to line ".__LINE__." in ".__FILE__."  SESSION['memberID'] was lost and xxx is $xxx<br /><br />";
    die;
}
$memb->checkLogin($_SESSION['memberID']);
$apps = new applications();
$apps_id = $request->getvalue('id');
if($apps_id>0){
	$apps->load($apps_id);
    $memload=($_SESSION['memberID'])? $_SESSION['memberID'] : $apps->member_id;
$memb->load($memload);
       }
require("includes/lib/functions/statesProv.php"); 
function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}     
    //$apps=str_replace("_", " ",$apps);
//$fn = $request->postvalue('vehicle_make');
if($_POST['action']=="saveDetails"){
    
    echo "<div style='position:absolute; top:300px; left: 400px;'><img src='images/3.gif' style='height:150px; alt='loading'></div>";
    
    
    $country=($request->postvalue('country')=="")? "Canada" : $request->postvalue('country');
	
	
    //$full_address=str_replace(" ", "+",$request->postvalue('address')." ".$request->postvalue('city')." ".$request->postvalue('province')." ".$request->postvalue('postalcode')." ".$country);
	
	$full_address=($request->postvalue('postalcode')." ".$country);
	

               if($full_address){
                $latlong    =   get_lat_long($full_address); 
				  
                $map        =   explode(',' ,$latlong);
                $mapLat     =   $map[0];
                $mapLong    =   $map[1];  
                }
                $pass  = $request->postvalue('password'); 
                 
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
                $memb->latitude                         =   $mapLat;
                $memb->longitude                        =   $mapLong;  
	
				
                 if($pass!='' ) { $memb->password       = md5($pass);}
                $memb->save();
                if(!$apps->member_id){
                $last_id=$memb->id; 
                }else{
                    $last_id=$apps->member_id;
                }
                $apps->id							   	=	$request->getvalue('id');
                $apps->member_id					   	=	($_SESSION['memberID']>0)? $_SESSION['memberID'] : $last_id;
				$apps->application_type				    =	$request->postvalue('application_type');
                $apps->vehicle_make                     =	$request->postvalue('vehicle_make');
                $apps->vehicle_model                     =	$request->postvalue('vehicle_model');
                $apps->vehicle_max_price                =	$request->postvalue('vehicle_max_price');
                $apps->vehicle_max_miles                =	$request->postvalue('vehicle_max_miles');
                $apps->vehicle_category                 =	$request->postvalue('vehicle_category');
                $apps->vehicle_body_type                =	$request->postvalue('vehicle_body_type');
                $apps->vehicle_color                    =   $request->postvalue('vehicle_color');
                $apps->vehicle_year_min                 =   $request->postvalue('vehicle_year_min');
                $apps->vehicle_year_max                 =   $request->postvalue('vehicle_year_max');
                $apps->vehicle_transmission             =   $request->postvalue('vehicle_transmission');
                $apps->payment_method                   =   $request->postvalue('payment_method');
                $apps->date_submitted                   =  	date("Y-m-d H:i:s");
                $apps->preferred_contact_method         =   $request->postvalue('preferred_contact_method');
                $apps->preferred_contact_time           =   $request->postvalue('preferred_contact_time');
                $apps->radius                           =   $request->postvalue('radius');
                $apps->fuel_type                        =   $request->postvalue('fuel_type');   
                $apps->engine_type                      =   $request->postvalue('engine_type');
				$apps->best_time			            =	$request->postvalue('best_time');
                $apps->customer_comments			    =	$request->postvalue('customer_comments');
                $apps->save();
   
                
$success="Thank you for completing this request for quotes on your $apps->vehicle_body_type  $apps->vehicle_category $apps->vehicle_make $apps->vehicle_model. Our dealer partners will be contacting you soon.";
	
	

////////////////////////////////////
	
								
	$mail = new PHPMailer(true);

	$options 			= array();

	$options['apps'] 	= $apps;

	$options['member'] 	= $memb;

	$options['mail']	= $mail;

	/// send New lead EMAIL !!!
	$apps->sendNewAppEmail($options);

	

//////////////////////////////////////////


if($apps->payment_method=="financing"){
	
		echo '<script type="text/javascript">
           window.location = "https://www.carleado.com/finance_details.php?memberID='.$_SESSION['memberID'].'&id='.$apps->id.'";
      </script>';
		die();
	
   echo "<meta http-equiv = \"refresh\" content = \"2; url = https://www.carleado.com/finance_details.php?id=".$apps->id." \">";
    die;
}else{
    if($_SESSION['memberID']>5){
		
		
		
		echo '<script type="text/javascript">
           window.location = "https://www.carleado.com/buyers_dashboard.php?id='.$_SESSION['memberID'].'&success='.$success.'";
      </script>';
		die();
		
        echo "<meta http-equiv = \"refresh\" content = \"2; url = https://www.carleado.com/buyers_dashboard.php?id={$_SESSION['memberID']}&success=$success\">
        <div style='height:100%; width:100%; background-color:lightblue; margin-top:100px; text-align:center; color:#000;><h3>If you are not immediately redirected, please click <a href='https://www.carleado.com/buyers_dashboard.php?id={$_SESSION['memberID']}&success=$success'> HERE </a></div>
        ";
       die; 
    }else{
        echo "Got to line ".__LINE__." in ".__FILE__." in ERROR. Contact the webmaster. <br /><br />";
//echo "<meta http-equiv = \"refresh\" content = \"2; url = https://www.carleado.com/buyers_dashboard.php?success=$success\">";
die;
}
}
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
   <div class="page-banner" style="display:none">
      <div class="container">
           <div class="row">
          <div class="col-md-6">
            <h2>Sub Menu Page Demo</h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="index.php">Home</a></li>
              <li>Sub Menu Page Demo</li>
            </ul>
          </div>
        </div>
        </div>
      </div>
    <!-- End Page Banner -->
    <!-- Start Content -->
    <div id="content"   >
      <div class="container">
          <div class="row">
            <div class="col-md-12">
               <!-- Toggle -->
            <div class="panel-group" style="padding-top:30px">
				<div class="col-md-12 nodrop"> 
					<?php if(@$image_name_exist!='') { ?><div class="alert warning">ERROR : Image with the same name already exists</div>
 <?php } ?>
					<?php if(@$urlkey_status!='') { ?><div class="alert warning">ERROR : Another page with same URL KEY already exists.</div>
 <?php } ?>				</div>
        <div class="row">
        <div class="col-md-12" style="; margin-top: 20px; " >	
        <?php 
         $brtest=(strlen($apps->vehicle_make)>20)? "<br />" : "";
         		?>
                    <h2>Let's find your <?php echo no_($apps->vehicle_make)." ".$brtest." ".no_($apps->vehicle_model)." ".$apps->vehicle_body_type;?> </h2>
                 <?php /*   
                    
                    <h3>You are one step closer to your dream vehicle finding you!</h3> */
                    ?>
                    
                    <p>You have the option of selecting preferred colors, transmission type, year range etc. below.<br /><br />Then click SUBMIT and we'll start your search. </p>
                    
                    <?php /*
                   if($apps->vehicle_make OR $apps->vehicle_model){
                   <img src='<?php echo $xml[0];?>' style="max-height: 400px; max-width: 90vw;">
                   
                    
                    <p style="font-size: 70%; line-height:120%; margin-top:10px; text-align:justify;" id="carImageText">This image is a representation of the type of vehicle you selected. It does not represent any vehicle actually available for sale. Our partners will send you images of the actual vehicles avaialable.</p>
                    			</div>
                      */ ?>          
                  </div>
			</div>
     <form id="form" action="" method="post" enctype="multipart/form-data">						
        <input type="hidden" name="application_type" id="application_type" value="webform"/> 
         <input type="hidden" name="payment_method" id="payment_method" value="<?php echo $apps->payment_method;?>"/>   
       <div class="row">
        <div class="col-md-6">
        <h5>Your Vehicle Request</h5>
      <div class="carDetail" style="font-size:24px !important; line-height:30px;
     color:#00A1E8;" >
      <span>
        <?php if($apps->vehicle_make){ ?>	        
<?php echo no_($apps->vehicle_make);?> 
<input type="hidden" name="vehicle_make" value="<?php echo $apps->vehicle_make;?>">
<?php 	} if($apps->vehicle_model){ ?>	
<input type="hidden" name="vehicle_model" value="<?php echo $apps->vehicle_model;?>">
<?php echo no_($apps->vehicle_model);?><br />
<?php 	} 
if($apps->vehicle_body_type){ ?>	
<input type="hidden" name="vehicle_body_type" value="<?php echo $apps->vehicle_body_type;?>">
<?php echo no_($apps->vehicle_body_type);?><br />
<?php 	} ?>

Max Price: $<?php echo $apps->vehicle_max_price;?><br />
<input type="hidden" name="vehicle_max_price" value="<?php echo $apps->vehicle_max_price;?>">
Max Kilometres: <?php echo $apps->vehicle_max_miles;?>
<input type="hidden" name="vehicle_max_miles" value="<?php echo $apps->vehicle_max_miles;?>">


<?php if($apps->vehicle_category){ ?>
Vehicle Cagegory: 
<?php echo $apps->vehicle_category;?><br />
<input type="hidden" name="vehicle_category" value="<?php echo $apps->vehicle_category;?>">
<?php 	} ?>


</span></div>
<br />
<h6>Refine Your Choice <span style="font-size: 50%;">(Optional)</span></h6>
 <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo" style="background-color: #00A1E8;">Show More Options</button>
  <div id="demo" class="collapse">
<section>
<br />
<div style="max-width: 80%; text-align:left;">
Click the button again to close this section. The program will remember your choices even if you close this section.</div><br />
<label for="vehicle_max_price">Vehicle Colour </label>
<div ><select class="car_brand" name="vehicle_color" ><option value="">Choose a Colour</option><option value="Any" <?php echo ($apps->vehicle_color=="Any")?"selected" : "";?> >Any Color</option><option value="Beige" <?php echo ($apps->vehicle_color=="Beige")? "selected" : "";?> >Beige</option><option value="Black" <?php echo ($apps->vehicle_color=="Black")? "selected" : "";?> >Black</option><option value="Blue" <?php echo ($apps->vehicle_color=="Blue")? "selected" : "";?> >Blue</option><option value="Brown" <?php echo ($apps->vehicle_color=="Brown")? "selected" : "";?> >Brown</option><option value="Bronze" <?php echo ($apps->vehicle_color=="Bronze")? "selected" : "";?> >Bronze</option><option value="Claret" <?php echo ($apps->vehicle_color=="Claret")? "selected" : "";?> >Claret</option><option value="Copper" <?php echo ($apps->vehicle_color=="Copper")? "selected" : "";?> >Copper</option><option value="Cream" <?php echo ($apps->vehicle_color=="Cream")? "selected" : "";?> >Cream</option><option value="Gold" <?php echo ($apps->vehicle_color=="Gold")? "selected" : "";?> >Gold</option><option value="Gray" <?php echo ($apps->vehicle_color=="Gray")? "selected" : "";?> >Gray</option><option value="Green" <?php echo ($apps->vehicle_color=="Green")? "selected" : "";?> >Green</option><option value="Maroon" <?php echo ($apps->vehicle_color=="Maroon")? "selected" : "";?> >Maroon</option><option value="Metallic" <?php echo ($apps->vehicle_color=="Metallic")? "selected" : "";?> >Metallic</option><option value="Navy" <?php echo ($apps->vehicle_color=="Navy")? "selected" : "";?> >Navy</option><option value="Orange" <?php echo ($apps->vehicle_color=="Orange")? "selected" : "";?> >Orange</option><option value="Pink" <?php echo ($apps->vehicle_color=="Pink")? "selected" : "";?> >Pink</option><option value="Purple" <?php echo ($apps->vehicle_color=="Purple")? "selected" : "";?> >Purple</option><option value="Red" <?php echo ($apps->vehicle_color=="Red")? "selected" : "";?> >Red</option><option value="Rose" <?php echo ($apps->vehicle_color=="Rose")? "selected" : "";?> >Rose</option><option value="Rust" <?php echo ($apps->vehicle_color=="Rust")? "selected" : "";?> >Rust</option><option value="Silver" <?php echo ($apps->vehicle_color=="Silver")? "selected" : "";?> >Silver</option><option value="Tan" <?php echo ($apps->vehicle_color=="Tan")? "selected" : "";?> >Tan</option><option value="Turquoise" <?php echo ($apps->vehicle_color=="Turquoise")? "selected" : "";?> >Turquoise</option><option value="White" <?php echo ($apps->vehicle_color=="White")? "selected" : "";?> >White</option><option value="Yellow" <?php echo ($apps->vehicle_color=="Yellow")? "selected" : "";?> >Yellow</option></select></div>
</section>
<section>
<label for="vehicle_max_price">Vehicle Transmission</label>
<div ><select class="car_brand" name="vehicle_transmission" ><option value="">Choose a Transmission Type</option><option value="Automatic" <?php echo ($apps->vehicle_transmission=="Automatic")?"selected" : "";?> >Automatic</option><option value="Manual" <?php echo ($apps->vehicle_transmission=="Manual")?"selected" : "";?> >Manual</option></select></div>
</section>
<section>
<label for="vehicle_max_price">Vehicle Min Year</label>
<div ><select id="from" placeholder="From" class="car_brand" name="vehicle_year_min" ><option value="">Choose a Minimum Year</option><?php for($i=date("Y")+1;$i>=1985;$i--){     $syear= ($apps->vehicle_year_min==$i)?"selected" : "";    echo"<option value='$i' $syear >$i</option>";}?></select></div>
</section>
<section>
<label for="vehicle_max_price">Vehicle Max Year</label>
<div ><select id="from" placeholder="From" class="car_brand" name="vehicle_year_max" ><option value="">Choose a Maximum Year</option><?php for($i=date("Y")+1;$i>=1985;$i--){     $syear= ($apps->vehicle_year_max==$i)?"selected" : "";    echo"<option value='$i' $syear >$i</option>";}?></select></div>
</section>
<section>
<label for="vehicle_max_price">Vehicle Fuel Type</label>
<div ><select class="car_brand" name="fuel_type" ><option value="">Choose a Vehicle Fuel Type</option><option value="Any" <?php echo ($apps->fuel_type=="Any")?"selected" : "";?> >Any Fuel Type</option><option value="Gasoline" <?php echo ($apps->fuel_type=="Gasoline")?"selected" : "";?> >Gasoline</option><option value="Diesel" <?php echo ($apps->fuel_type=="Diesel")?"selected" : "";?> >Diesel</option><option value="Electric Plug In" <?php echo ($apps->fuel_type=="Electric Plug In")?"selected" : "";?> >Electric Plug In</option><option value="Hybrid" <?php echo ($apps->fuel_type=="Hybrid")?"selected" : "";?> >Hybrid</option><option value="Propane" <?php echo ($apps->fuel_type=="Propane")?"selected" : "";?> >Propane</option><option value="Natural Gas" <?php echo ($apps->fuel_type=="Natural Gas")?"selected" : "";?> >Natural Gas</option></select></div>
</section>
<section>
<label for="vehicle_max_price">Vehicle Engine Type</label>
<div ><select class="car_brand" name="engine_type" ><option value="">Choose an Engine Type</option><option value="Any" <?php echo ($apps->engine_type=="Any")?"selected" : "";?> >Any Engine Type</option><option value="4 Cylinder" <?php echo ($apps->engine_type=="4 Cylinder")?"selected" : "";?> >4 Cylinder</option><option value="V6 Cylinder" <?php echo ($apps->engine_type=="V6 Cylinder")?"selected" : "";?> >V6 Cylinder</option><option value="Straight 6 Cylinder" <?php echo ($apps->engine_type=="Straight 6 Cylinder")?"selected" : "";?> >Straight 6 Cylinder</option><option value="V8 Cylinder" <?php echo ($apps->engine_type=="V8 Cylinder")?"selected" : "";?> >V8 Cylinder</option><option value="Electric" <?php echo ($apps->engine_type=="Electric")?"selected" : "";?> >Electric</option></select></div>
</section>
</div>
<section>
<label for="best_time" style="margin-top: -10px !important;"><br />Search Radius</label>
<div><select class="car_brand" name="radius" >
<option value="100">100 Km</option>
<?php for($i=5;$i<=45;$i+=5){
$sradius= ($apps->radius==$i)?"selected" : "";    
echo"<option value='$i' $sradius  >$i Km</option>";
}
for($i=50;$i<=175;$i+=25){     
$sradius= ($apps->radius==$i)?"selected" : "";    
echo"<option value='$i' $sradius  >$i Km</option>";
}
for($i=200;$i<=500;$i+=100){     
$sradius= ($apps->radius==$i)?"selected" : "";    
echo"<option value='$i' $sradius  >$i Km</option>";
}?>
</select>
</div>
</section>
<section>
<label for="postalcode">Postal Code (Required)</label>
<div><input  type="text" class="car_brand" name="postalcode" id="postalcode" value="<?php echo $memb->postalcode;?>" required/></div>
</section>
<section>
<label for="best_time">Preferred Contact Method</label>
<div><select class="car_brand" name="preferred_contact_method"  onchange="yesnoCheck(this);">
<option value="Email" <?php echo ($apps->preferred_contact_method=="Email")?"selected" : "";?> >Email</option>
<option id="phoneSelected" value="Phone" <?php echo ($apps->preferred_contact_method=="Phone")?"selected" : "";?> >Phone</option>
<option value="Text" <?php echo ($apps->preferred_contact_method=="Text")?"selected" : "";?> >Text</option>
</select></div>
</section>
<section id="besttime" style="display: none;">
<label for="best_time">Preferred Contact Time</label>
<div><select class="car_brand" name="best_time"  ><option value="">Choose a Preferred Contact Time</option><option value="Early Morning (7-9)" <?php echo ($apps->best_time=="Early Morning (7-9)")?"selected" : "";?> >Early Morning (7-9)</option><option value="Morning (9-12)" <?php echo ($apps->best_time=="Morning (9-12)")?"selected" : "";?> >Morning (9-12)</option><option value="Early Afternoon (12-3)" <?php echo ($apps->best_time=="Early Afternoon (12-3)")?"selected" : "";?> >Early Afternoon (12-3)</option><option value="Late Afternoon (3-6)" <?php echo ($apps->best_time=="Late Afternoon (3-6)")?"selected" : "";?> >Late Afternoon (3-6)</option><option value="Early Evening (6-8)" <?php echo ($apps->best_time=="Early Evening (6-8)")?"selected" : "";?> >Early Evening (6-8)</option><option value="Late Evening (8-10)" <?php echo ($apps->best_time=="Late Evening (8-10)")?"selected" : "";?> >Late Evening (8-10)</option></select></div>
</section>
<section>
<label for="customer_comments">Your Comments or Specifications</label>
<div><textarea name="customer_comments" id="customer_comments" cols="57" rows="5"> <?php echo $apps->customer_comments;?></textarea></div>
</section>        
</fieldset>          		<!-- End col-md-6-->			</div>
            <div class="col-md-6">
            <fieldset style="display: none;">	
<?php
	$contactMessage=($_SESSION['memberID']>5)? "Please Verify Your Contact Information" :"How can we contact you?";
?>
                     <h5><?php echo $contactMessage;?></h5>
We show your contact information as:<br /><br />
<?php echo $memb->first_name;?> <?php echo $memb->last_name;?><br />
Email: <?php echo $memb->email;?><br />
Address: <?php echo $memb->address;?>, <?php echo $memb->city;?>, <?php echo $memb->province; ?>, <?php echo $memb->postalcode;?><br />
Phone: <?php echo $memb->home_phone;?> <br /><br />
If this is not correct, click below to update your information.<br /><br />
 <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo2" style="background-color: #00A1E8;">Update Contact Information</button>
  <div id="demo2" class="collapse">
  <div style="max-width: 80%; text-align:left;"><br />
Click the button again to close this section. The program will remember your choices even if you close this section.</div><br />
<section>
<label for="first_name">First Name</label>
<div><input  type="text" class="car_brand" name="first_name" id="first_name" value="<?php echo $memb->first_name;?>"/></div>
</section>
<section>
<label for="last_name">Last Name</label>
<div><input  type="text" class="car_brand" name="last_name" id="last_name" value="<?php echo $memb->last_name;?>" required/></div>
</section>
<section>
<label for="email">Email</label>
<div><input  type="text" class="car_brand" name="email" id="email" value="<?php echo $memb->email;?>" required/></div>
</section>
<?php $passRequired=($memb->password)?  "selected" : "";?>
<section>
<label for="email">Password - <?php if($passRequired){echo "Leave blank to keep your existing password.";}?> </label>
<div><input  type="password" class="car_brand" name="password" id="password" <?php echo $passRequired;?> /></div>
</section>
<section id="conf" style="display: none;">
<label for="email">Confirm Password - <?php if($passRequired){echo "Leave blank to keep your existing password.";}?></label>
<div><input  type="password" class="car_brand" name="confirm_password" id="confirm_password" <?php echo $passRequired;?> /></div>
</section>

<?php /*
<section>
<label for="address">Address</label>
<div><input  type="text" class="car_brand" name="address" id="address" value="<?php echo $memb->address;?>"/></div>
</section>
<section>
<label for="city">City</label>
<div><input  type="text" class="car_brand" name="city" id="city" value="<?php echo $memb->city;?>" /></div>
</section>
<section>
<label for="province">Province</label>
<div >
<?php echo state_prov("prov", $memb->province,"province","","car_brand !important;");?>
</div>
</section>

// NOTE: Postal code here is duplicated under Proximity request.
<section>
<label for="postalcode">Postal Code</label>
<div><input  type="text" class="car_brand" name="postalcode" id="postalcode" value="<?php echo $memb->postalcode;?>"/></div>
</section>

*/
?>
                      <?php /*  <section><label for="street">Country</label>
							<div><select type="text" name="country" class="form-control-select"id="form-country" style="width:100%;" >
														<option value="CA" <?php echo ($memb->country=="CA")? "selected" :"";?>>Canada</option>
														<option value="US" <?php echo ($memb->country=="US")? "selected" :"";?>>United States</option>
                                                    </select></div>
</section>
*/
?>
<section>
<label for="best_time">Phone Number</label>
<div><input  type="text" class="car_brand" name="home_phone" id="home_phone" value="<?php echo $memb->home_phone;?>"/></div>
</section>
</div>
                       </fieldset>      
                             </div>
<div class="col-sm-12">
               <input type="hidden" name="dateentered" value="<?php echo ($apps->dateentered)?$apps->dateentered : date("Y-m-d H:i:s");?>" /><input type="hidden" name="action" value="saveDetails" />
              <input type="hidden" name="memberID" value="<?php echo $_SESSION['memberID'];?>"/> 
<section>
<label for="customer_comments"></label>
		<div id="submit_button"><button class="submit" class="btn btn-info btn-info2 " name="manage_service_button" value="manage_service_button"  style="background-color: #00A1E8; padding: 10px 40px; border-radius:  5px;color:#fff; border:none; margin-bottom: 30px;cursor: pointer; z-index: 999999;">Submit</button></div>
</section>   
</div>      
                     </form>           
		</div>
            </div>
            </div>
           </div>
</div>
</div>
		<?php include("footer.php");?>
        
         <script>
         $(document).ready(function(){
     $('#password').on('keyup', function () {
if($('#password').val()){ $('#conf').css('display', 'inline');}
}    
  );
 $('#confirm_password').on('keyup', function () {   
    if ($('#password').val() == $('#confirm_password').val()) {
        $('#confirm_password').css('border-color', 'green').css('border-width','3px');
    } else 
        $('#confirm_password').css('border-color', 'red').css('border-width','3px');
});   
    });     
</script>        
<script>
	function yesnoCheck(that) {
		if (that.value == "Phone") {
		document.getElementById("besttime").style.display = "block";
		} else {
		document.getElementById("besttime").style.display = "none";
		}
	}
	
	
	$(".btn-info2").on("click",function() {
	
		$("#submit_button").html("<img src='images/3.gif' style='height:150px; alt='loading'>")
	});
	
	$("#form").on("submit",function() {
		
		var postalCode = $("#postalcode").val().trim();
		 if(!validatePostalCode(postalCode)) {
			 alert("You have entered an invalid Postal Code");
			 return false;
		 }
	})
	
	function validatePostalCode(postalCode) {
		
		// if PostalCode is Blank , return false;

		if (! postalCode) {
			return null;
		}

		postalCode = postalCode.toString().trim();

		var us = new RegExp("^\\d{5}(-{0,1}\\d{4})?$");
		var ca = new RegExp(/([ABCEGHJKLMNPRSTVXY]\d)([ABCEGHJKLMNPRSTVWXYZ]\d){2}/i);

		if (us.test(postalCode.toString())) {
			return postalCode;
		}

		if (ca.test(postalCode.toString().replace(/\W+/g, ''))) {
			return postalCode;
		}
		return null;
	}

</script>





<?php
	include("includes/footer.php");
?>