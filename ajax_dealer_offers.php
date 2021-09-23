<?php
require_once("includes/lib/common.php");
require("includes/lib/classes/a/dealers.php");
require("includes/lib/classes/a/dealer_quotes.php");
require("includes/lib/classes/a/shortlist.php");
require("includes/lib/classes/a/applications.php"); 
$apps 		= new applications();
$quotes 	= new quotes();
$shortlist 	= new shortlist();
$dealers	= new dealers();
$apps_id = $request->getvalue('id');
$action = $request->postvalue('action'); 
$rooturl="https://carleado.com/";
require_once("Mobile-Detect-2.8.34/Mobile_Detect.php");
$detect = new Mobile_Detect;
if($detect->isMobile()){
    $a=1;
    $is_mobile=1;
}
if(strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')){
    $browser="Firefox";
}
/// Update Quote View Status 
if($action == "update_quote_view") {
	$quote_id = $request->postvalue('quote_id');
	if($quote_id > 0 ) {
		$quotes->load($quote_id);
		$quotes->updateViewStatus($quotes);
		//$quotes->view_status = 1;
		//$quotes->view_date = date("Y-m-d H:i:s");
		//$quotes->save();
		echo "SUCCESS";
	} else {
		echo "ERROR";
	}
	die();
}
if($apps_id>0){
	$apps->load($apps_id);
       }
       $options=array();
       $options['order_by']=" vehicle_body_type, vehicle_make,vehicle_model, date_submitted ";
$applist= $apps->getlistByMember($options,$_SESSION['memberID']);
function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}
$quotes_id 	= $request->getvalue('id');
$version 	= $request->getvalue('ver');
if($quotes_id>0){
	$quotes->load($quotes_id);
       }
       $options['order_by']="vehicle_make, vehicle_model, vehicle_body_type, vehicle_price";
        $options['sort_direction']=" ASC ";
if($version=="sl"){
    $carlist= $quotes->getShortlistByMember($options,$_SESSION['memberID']);
}else{
$carlist= $quotes->getlistByMember($options,$_SESSION['memberID']);
}
if($carlist!='empty') {
if($version!="sl"){
	echo "<br /><br />If dealer offers are available, they will appear first. Click on the vehicle name to view available offers. Please Shortlist the offers that you like best.<br /><br />";
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
.vprice{
    color:#00A1E8;
    font-size: 36px;
    font-weight:bold;
    float:right;
}
.headRow{
    height:50px;
}
.makeModel{
    font-size: 24px;
    font-weight:bold;
    color:#000;
}
.incentive{
    font-size: 24px;
    font-weight:bold;
    text-align:right;
}
    .main-content{
		min-height: 230px;
       font-size:24px;
       font-weight:bold;
    }
    .sidebar-content{
        margin-bottom: 30px;
    }
    .tf{
        color:#000;
        font-size:12px;
        font-weight:bold;
    }
.vprice{
    color:#00A1E8;
    font-size: 36px;
    font-weight:bold;
    float:right;
}
.shtlst{
    color:#00A1E8;
    font-size: 24px;
    font-weight:bold;
    float:right;
}
.shtlst span{
    color:#000;
    font-size: 14px;
    font-weight:bold;
}	
.featureBox h3{
    margin-top:0px !important;
	font-size: 15px;
}
.galleria-errors{
    display:none !important;
}
<?php if($is_mobile){ ?>
.galleria-fullscreen{
    display: none !important;
}
<?php } ?>
.new_quote_title {
	background-color: #93CDEC !important;
}
.new_quote_body {
   background-color: #D4EBF8 !important;	
}
#featureList strong{
    color: #00A1E8;  
}	
#featureList div{
    margin-top:10px;
    max-width:40vw;
}	
 .galleria{width:400px; height: 250px;}
.galleria-container{
    max-height:300px !important;
}
.messageHeight{
    margin-top:50px;
}
@media screen and (orientation:portrait)and (max-width:640px) {
  .galleria{width:90vw; margin-left:-20px; height: 250px;}
  .vprice{
    float:none;
    text-align:center;
  }
  .sidebar-content{
    margin-bottom: 10px;
    text-align: center;
  }
  .galleria-container{
    max-height:250px !important;
}
.messageHeight{
    margin-top:0px;
}
}
@media screen and (orientation:landscape) and (max-width:960px){
    .galleria{width:35vw; margin-left:-20px;}
    .vprice{
    float:none;
    text-align:center;
  }
   .sidebar-content{
    margin-bottom: 10px;
    text-align: center;
  }
  .galleria-container{
    max-height:250px !important;
}
  .messageHeight{
    margin-top:0px;
}  
}
</style>
<?php
if($version=="sl"){
  echo"<h2>Your Shortlisted Vehicles</h2>";  
}else{
echo"<h2>Vehicles With Offers</h2>";
}
foreach((array)$carlist as $cars){
	$randid = rand(10,999);
	$bg1 = $cars['view_status']==0?"new_quote_title":"";
	$bg2 = $cars['view_status']==0?"new_quote_body":"";
	$badge_image = "";
	if($quotes->getViewStatusMakeModelBodyType($cars['id']) > 0) {
		$badge_image = "<img src='images/new_badge.png' style='height:34px;position:absolute;top:-4px;right:-3px;'>";
		$bg1 = "new_quote_title";
	}
  //$count = array_count_values(call_user_func_array('array_merge', $carlist));
  //echo"this is count ";
 //print_r($count);
  //$noOfOffers=$count[$cars['vehicle_model']];
  //echo("<br />noOfOffers is $noOfOffers<br />");
    $xxi++; 
    ?> 
      <?php  
      $compareVehicle=($cars['vehicle_body_type'])? $cars['vehicle_body_type'] :$cars['vehicle_make']." ".$cars['vehicle_model'];
      if(trim($compareVehicle)<>trim($holdCar)){
        echo ($xyz==0)? "" : "</div></div>";
        $xyz++;
      $holdFlag=1;
        echo"<button data-rand-id='$randid' data-quote-id='{$cars['id']}' class=\"ff_faq_header {$bg1}  btn btn-link collapsed\" data-toggle=\"collapse\" data-target=\"#ff_item_$xxi\" aria-expanded=\"false\" aria-controls=\"ff_item_".$xxi."\" >";
      //echo" <div style='width:150px; display:inline; '> <select class='rating' name='deal_rating' style='display:inline;'>";
      //echo"<option value=''>Rate Offers</option>";
      //$selectedRating=$quotes->isSelectedRating($_SESSION['memberID'],$cars['vehicle_id'],$cars['dealer_id']);
  //for($ix=1; $ix<=5; $ix++){
   // $selected=($selectedRating==$ix)?"selected":"";
    //echo"<option value='$ix".":|:".$cars['vehicle_id'].":|:".$_SESSION['memberID'].":|:".$cars['dealer_id']."'$selected>$ix</option>";
   // }
   // echo "</select></div>";           
 if($cars['vehicle_body_type']){
     echo "&nbsp;&nbsp;<div style='width:150px; display:inline;'>".$cars['vehicle_body_type']."</div> $badge_image ";
 }else{  echo "&nbsp;&nbsp;<div style='width:150px; display:inline;'>".$cars['vehicle_make']." ".$cars['vehicle_model']."</div> $badge_image ";
   }
   //<div style='width:150px; display:inline; text-align:right; float:right;'>$".number_format(tofloat($cars['vehicle_price']),2)." </div><div style='width:150px; display:inline; float:right;'>".$cars['vehicle_miles']." &nbsp;&nbsp;&nbsp;&nbsp;</div><div style='width:150px; display:inline; float:right;'>".$cars['vehicle_year']." &nbsp;&nbsp;</div>
     echo "</button>";
      echo "<div id=\"ff_item_$xxi\" class=\"collapse\" data-parent=\"#accordion\">
            <div class=\"ff_faq_itemxxxx\">"; 
     };
       $holdCar= ($cars['vehicle_body_type'])? $cars['vehicle_body_type'] : $cars['vehicle_make']." ".$cars['vehicle_model'];
            ?>
              <div class="container mt-3 outline <?php echo $bg2;?>">
    <div class="row ">
        <div class="col-sm-5">
            <?php 
			//$vehicle_id 		= $cars['vehicle_id'];
			$vehicle_id 		= $cars['id'];
            $dealer_id          = $cars['dealer_id'];
			$vehicle_images 	= $quotes->getVehicleImagesList($vehicle_id,$dealer_id);
			if($vehicle_images !='empty')	{ 	?>
          	<input type="hidden" class="is_gallery_active" data-rand-id="<?php echo $randid;?>" name="gallery_<?php echo $randid;?>" id="gallery_<?php echo $randid;?>" value="1">
  			<script>
            (function() {
                Galleria.loadTheme('Galleria/src/themes/twelve/galleria.twelve.js');
                //Galleria.run('#galleria<?php echo $randid;?>');
            }());
        	</script>        					 						 	
            <div class="main-content galleria" style="background-color: #f7f7f7 !important;" id="galleria<?php echo $randid;?>">
            <?php foreach ($vehicle_images as $image) {	if($image['big_image']=="") continue;?>
                       <img src="images/vehicles/larger/<?php echo $image['big_image'];?>" alt="<?php echo $image['title'];?>" />
            <?php } ?>
            </div>
          <div class="messageHeight">  <p style="color: #000; font-size:12px;">Click <img src="images/popout-icon.png" alt="popup icon" style="display: inline; max-height:20px;"/> above to view a popup slideshow.</p></div>
            <?php } else { ?>
            <img src="images/nocarimage.png" alt="Image not available">
            <input type="hidden" name="gallery_<?php echo $randid;?>" id="gallery_<?php echo $randid;?>" value="0">
            <?php } ?>
        </div>
        <div class="col-sm-7">
            <!--Nested rows within a column-->
        <div class="row">
                <div class="col-sm-12 col-md-6" >
                    <div class="sidebar-content makeModel"><?php echo no_($cars['vehicle_make']);?> <?php echo no_($cars['vehicle_model']);?></div>
                </div>
                <div class="col-sm-12 col-md-6" >
                <div class="sidebar-content2 vprice">$<?php echo number_format(tofloat($cars['vehicle_price']),2);?><br /><span class="tf">+ Taxes and Fees</span></div>
                </div>
            </div>
            <div class="container-fluidxxx">
            <div class="row" id="featureList">
                <div class="col-md-4 col-sm-6">
                    <strong>Kilometers</strong><h3><?php echo $cars['vehicle_miles'];?></h3></div>
                    <div class="col-md-4 col-sm-6">
                    <strong>Year</strong><h3><?php echo $cars['vehicle_year'];?></h3></div>
                     <div class="col-md-4 col-sm-6">
                    <strong>Transmission</strong><h3><?php echo $cars['vehicle_transmission'];?></h3></div>
                <div class="col-md-4 col-sm-6">
                    <strong>Engine Type</strong><h3><?php echo $cars['engine_type']!=""?$cars['engine_type']:'N/A';?></h3></div>
                     <div class="col-md-4 col-sm-6">
                    <strong>Fuel Type</strong><h3><?php echo $cars['fuel_type'];?></h3></div>
                    <div class="col-md-4 col-sm-6">
                    <strong>Extra&nbsp;Fees</strong><br /><?php echo nl2br($cars['vehicle_extra_fees']);?></div>
                <div class="col-md-4 col-sm-6">
                  <strong>Engine Size</strong><h3><?php echo $cars['engine_size']!=""?$cars['engine_size']:"N/A";?></h3></div>
                  <div class="col-md-4 col-sm-6">
                 <strong>Vehicle Status</strong><h3><?php echo $cars['vehicle_status']!=""?$cars['vehicle_status']:"N/A";?></h3></div>
                 <?php
   					$distance=distanceBetweenPC($dealer_id,$_SESSION['memberID']);
                    // note the 1.4 is to compensate for the difference between road distance and as the crow flies distance. It seems reasonably accurate for the <100 KM distances we are using.
                    $distance = intval(round($distance*1.4)/10)*10;
    				$distance= $distance." - ".($distance+10)."KM";
			    ?>
                     <div class="col-md-4 col-sm-6">
                    <strong>Distance from you</strong><h3><?php echo $distance;?></h3></div>
                  <?php if($cars['coupon']){?>
                  <div class="col-xs-12">
                 <strong>Incentive</strong><h3 style="color: red;"><?php echo $cars['coupon'];?></h3></div>
                    <?php
	                   }
                    ?>
            </div>
            </div>
           <?php
	 /*
            <div class="row">
                <div class="col-sm-12">
            <p style="display: inline;"><strong>Dealer Comments:</strong></p>
            <p style="display: inline;"><?php echo nl2br($cars['dealer_comments']);?></p>
            </div>
            </div>
            */
?>
            <div class="row">
                <div class="col-sm-12">
                <div id="result"></div>
                    <div class="sidebar-content shtlst" id="content_<?php echo $randid;?>"><br />
                    <?php 
						$check_shortlist_status	 = $shortlist->isInShortlist($_SESSION['memberID'],$cars['id']);
						$check_shortlist_status  = ($check_shortlist_status == 'yes')?"checked":'';
						$disabled  = ($check_shortlist_status == 'checked')? "disabled":'';
	                   if($disabled){
						   $dealers->load($dealer_id);
	                       echo "Shortlisted <BR>";
						   echo "<span>$dealers->company_trade_name <BR> <a href=\"tel:$dealers->phone\" style='color:#00A2E8;'>".cleanPhone($dealers->phone)."</a></span>";
	                   }else{
					?>
                    <input name="shortlist" style="transform: scale(2); margin:10px;" id="checkbox_<?php echo $randid;?>"  type="checkbox" value="1" onclick="save_checkbox('to_print','<?php echo $cars['vehicle_id']."::".$_SESSION['memberID']."::".$dealer_id."::".$cars['id']; ?>','<?php echo $randid;?>')" <?php echo $check_shortlist_status;?> > Add to My Shortlist
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php /*
<div class="carSpecs"  >          
        <?php if($cars['vehicle_make']){ ?>	        
<section>
<label for="loan_amount">Vehicle Make</label>
<div ><input  type="text" class="car_brand" name="vehicle_make" class="car_brand" id="loan_amount" value="<?php echo no_($cars['vehicle_make']);?>"/></div>
</section>
<?php 	} if($cars['vehicle_model']){ ?>	
<section>
<label for="vehicle_model">Vehicle Model</label>
<div ><input  type="text" class="car_brand" name="vehicle_model" id="loan_amount" value="<?php echo no_($cars['vehicle_model']);?>"/></div>
</section>
<?php 	} ?>
<section>
<label for="vehicle_max_price">Dealer Quote</label>
<div ><input  type="text" class="car_brand" name="vehicle_price" id="vehicle_price" value="<?php echo $cars['vehicle_price'];?>"/></div>
</section>
<?php if($cars['vehicle_extra_fees']>""){ ?>
<section>
<label for="vehicle_max_price">Extra Fees</label>
<div ><textarea class="car_brand" name="vehicle_extra_fees" id="vehicle_extra_fees"><?php echo $cars['vehicle_extra_fees'];?></textarea></div>
</section>
<?php } ?>
<?php if($cars['coupon']>""){ ?>
<section>
<label for="vehicle_max_price">Coupon - This dealer is offering this extra bonus.</label>
<div ><input  type="text" class="car_brand" name="vehicle_coupon" id="vehicle_coupon" value="<?php echo $cars['coupon'];?>"/></div>
</section>
<?php } ?>
<section>
<label for="vehicle_max_miles">Vehicle Miles</label>
<div ><input  type="text" class="car_brand" name="vehicle_max_miles" id="vehicle_max_miles" value="<?php echo $cars['vehicle_miles'];?>"/></div>
</section>
<?php if($cars['vehicle_category']){ ?>
<section>
<label for="vehicle_category">Vehicle Category</label>
<div><input  type="text" class="car_brand" name="vehicle_category" id="vehicle_category" value="<?php echo $cars['vehicle_category'];?>"/></div>
</section>
<?php 	} ?><?php if($cars['vehicle_body_type']){ ?>
<section>
<label for="vehicle_body_type">Vehicle Body Type</label>
<div><input  type="text" class="car_brand" name="vehicle_body_type" id="vehicle_body_type" value="<?php echo $cars['vehicle_body_type'];?>"/></div>
</section>
               <?php 	} ?>
<section>
<h6>Specifications</h6>
<label for="vehicle_max_price">Vehicle Colour </label>
<div ><select class="car_brand" name="vehicle_color" ><option value="">Please Choose a Colour</option><option value="Any" <?php echo ($cars['vehicle_color']=="Any")?"selected" : "";?> >Any Color</option><option value="Beige" <?php echo ($cars['vehicle_color']=="Beige")? "selected" : "";?> >Beige</option><option value="Black" <?php echo ($cars['vehicle_color']=="Black")? "selected" : "";?> >Black</option><option value="Blue" <?php echo ($cars['vehicle_color']=="Blue")? "selected" : "";?> >Blue</option><option value="Brown" <?php echo ($cars['vehicle_color']=="Brown")? "selected" : "";?> >Brown</option><option value="Bronze" <?php echo ($cars['vehicle_color']=="Bronze")? "selected" : "";?> >Bronze</option><option value="Claret" <?php echo ($cars['vehicle_color']=="Claret")? "selected" : "";?> >Claret</option><option value="Copper" <?php echo ($cars['vehicle_color']=="Copper")? "selected" : "";?> >Copper</option><option value="Cream" <?php echo ($cars['vehicle_color']=="Cream")? "selected" : "";?> >Cream</option>
<option value="Gold" <?php echo ($cars['vehicle_color']=="Gold")? "selected" : "";?> >Gold</option>
<option value="Gray" <?php echo ($cars['vehicle_color']=="Gray")? "selected" : "";?> >Gray</option>
<option value="Green" <?php echo ($cars['vehicle_color']=="Green")? "selected" : "";?> >Green</option>
<option value="Maroon" <?php echo ($cars['vehicle_color']=="Maroon")? "selected" : "";?> >Maroon</option>
<option value="Metallic" <?php echo ($cars['vehicle_color']=="Metallic")? "selected" : "";?> >Metallic</option>
<option value="Navy" <?php echo ($cars['vehicle_color']=="Navy")? "selected" : "";?> >Navy</option><option value="Orange" <?php echo ($cars['vehicle_color']=="Orange")? "selected" : "";?> >Orange</option><option value="Pink" <?php echo ($cars['vehicle_color']=="Pink")? "selected" : "";?> >Pink</option>
<option value="Purple" <?php echo ($cars['vehicle_color']=="Purple")? "selected" : "";?> >Purple</option>
<option value="Red" <?php echo ($cars['vehicle_color']=="Red")? "selected" : "";?> >Red</option>
<option value="Rose" <?php echo ($cars['vehicle_color']=="Rose")? "selected" : "";?> >Rose</option><option value="Rust" <?php echo ($cars['vehicle_color']=="Rust")? "selected" : "";?> >Rust</option><option value="Silver" <?php echo ($cars['vehicle_color']=="Silver")? "selected" : "";?> >Silver</option><option value="Tan" <?php echo ($cars['vehicle_color']=="Tan")? "selected" : "";?> >Tan</option><option value="Turquoise" <?php echo ($cars['vehicle_color']=="Turquoise")? "selected" : "";?> >Turquoise</option><option value="White" <?php echo ($cars['vehicle_color']=="White")? "selected" : "";?> >White</option><option value="Yellow" <?php echo ($cars['vehicle_color']=="Yellow")? "selected" : "";?> >Yellow</option></select></div>
</section>
<section>
<label for="vehicle_max_price">Vehicle Transmission</label>
<div ><select class="car_brand" name="vehicle_transmission" ><option value="">Please Choose a Transmission Type</option><option value="Automatic" <?php echo ($cars['vehicle_transmission']=="Automatic")?"selected" : "";?> >Automatic</option><option value="Manual" <?php echo ($cars['vehicle_transmission']=="Manual")?"selected" : "";?> >Manual</option></select></div>
</section>
<section>
<label for="vehicle_max_price">Vehicle Year</label>
<div ><input type="text" placeholder="From" class="car_brand" name="vehicle_year" value="<?php echo $cars['vehicle_year'];?>"></div>
</section>
<section>
<label for="vehicle_max_price">Vehicle Fuel Type</label>
<div ><select class="car_brand" name="fuel_type" ><option value="">Please Choose a Vehicle Fuel Type</option>
<option value="Any" <?php echo ($cars['fuel_type']=="Any")?"selected" : "";?> >Any Fuel Type</option><option value="Gasoline" <?php echo ($cars['fuel_type']=="Gasoline")?"selected" : "";?> >Gasoline</option>
<option value="Diesel" <?php echo ($cars['fuel_type']=="Diesel")?"selected" : "";?> >Diesel</option><option value="Electric Plug In" <?php echo ($cars['fuel_type']=="Electric Plug In")?"selected" : "";?> >Electric Plug In</option><option value="Hybrid" <?php echo ($cars['fuel_type']=="Hybrid")?"selected" : "";?> >Hybrid</option><option value="Propane" <?php echo ($cars['fuel_type']=="Propane")?"selected" : "";?> >Propane</option><option value="Natural Gas" <?php echo ($cars['fuel_type']=="Natural Gas")?"selected" : "";?> >Natural Gas</option></select></div>
</section>
<section>
<label for="vehicle_max_price">Vehicle Engine_Type</label>
<div ><select class="car_brand" name="engine_type" ><option value="">Please Choose an Engine Type</option>
<option value="Any" <?php echo ($cars['engine_type']=="Any")?"selected" : "";?> >Any Engine Type</option>
<option value="4 Cylinder" <?php echo ($cars['engine_type']=="4 Cylinder")?"selected" : "";?> >4 Cylinder</option>
<option value="V6 Cylinder" <?php echo ($cars['engine_type']=="V6 Cylinder")?"selected" : "";?> >V6 Cylinder</option>
<option value="Straight 6 Cylinder" <?php echo ($cars['engine_type']=="Straight 6 Cylinder")?"selected" : "";?> >Straight 6 Cylinder</option><option value="V8 Cylinder" <?php echo ($cars['engine_type']=="V8 Cylinder")?"selected" : "";?> >V8 Cylinder</option><option value="Electric" <?php echo ($cars['engine_type']=="Electric")?"selected" : "";?> >Electric</option></select></div>
</section>
<section>
<label for="dealer_comments">Dealer Comments or Specifications</label>
<div><textarea name="dealer_comments" id="dealer_comments" cols="57" rows="5"> <?php echo $cars['dealer_comments'];?></textarea></div>
</section>        
</div>
*/?>
<?php //unset($cars); ?>
  <?php echo "            
            </div>";
       // </div>";
      if($holdFlag){echo  "<div>";}
} // while $carlist
} // if $carlist != 'empty'
else {
    if($version=="sl"){
        echo "<h3>Sorry - There are no active items in your shortlist.<h3>";
    }else{
        echo"<h2>Vehicles With Offers</h2>";
	echo "<h3>Sorry - There are no offers available yet.<h3>";
    }
}
echo "</section>
";
echo "</div></div>";
if($version!="sl"){
echo"<h2 style='letter-spacing:-2px;'>Vehicles Awaiting Offers</h2>";
///////////////////////////////// START OF BUYERS CARS CODE 
echo "
<section class=\"ff_faqs\">
<div id=\"accordion\">";
//$xxi=0;
	$i0000 = -1;
$next_make_model = "";
$previous_make_model = "";
$current_make_model = "";	
foreach($applist as $app){
  $i0000++;
 $next_make_model = $applist[$i0000+1]['vehicle_make'].$applist[$i0000+1]['vehicle_model'].$applist[$i0000+1]['vehicle_body_type'];
 $current_make_model = 	$applist[$i0000]['vehicle_make'].$applist[$i0000]['vehicle_model'].$applist[$i0000]['vehicle_body_type'];
  if($quotes->hasQuotes($app['id'])){
    continue;
  }
    $xxi++; 
                  if($quotes->hasQuotes($app['id'])){
                    $quoteFlag="<a href='https://www.carleado.com/buyers_dashboard.php?id=".$_SESSION['memberID']."&action=dealer-offers'  style='color:#fff;'> - - Quotes Received</a>";
                    $vehicleBG= " style=\"background-color:#007bff; color:#fff;\"";
                  }else{
                    $quoteFlag="";
                    $vehicleBG="";
                  }
	if($current_make_model <> $previous_make_model) {
        echo"<button class=\"ff_faq_header btn btn-link collapsed\" data-toggle=\"collapse\" data-target=\"#ff_item_$xxi\" aria-expanded=\"false\" aria-controls=\"ff_item_".$xxi."\" $vehicleBG>";
    echo no_($app['vehicle_make'])." ".no_($app['vehicle_model'])." ";
    if(!$app['vehicle_make'] AND !$app['vehicle_model']){ echo $app['vehicle_body_type'];}
    echo $quoteFlag."
     </button>";
    echo "<div id=\"ff_item_$xxi\" class=\"collapse\" data-parent=\"#accordion\">
            "; 
	}
	$previous_make_model = $current_make_model;
            ?>
<div class="ff_faq_item">             
<div class="carSpecs"  >          
        <?php if($app['vehicle_make']){ ?>	        
<section>
<label for="loan_amount">Vehicle Make</label>
<div ><input  type="text" class="car_brand" name="vehicle_make" class="car_brand" id="loan_amount" value="<?php echo no_($app['vehicle_make']);?>"/></div>
</section>
        <?php } if($app['vehicle_body_type']){ ?>	        
<section>
<label for="loan_amount">Vehicle Body Type</label>
<div ><input  type="text" class="car_brand" name="vehicle_body_type" id="loan_amount" value="<?php echo no_($app['vehicle_body_type']);?>"/></div>
</section>
<?php 	} if($app['vehicle_model']){ ?>	
<section>
<label for="vehicle_model">Vehicle Model</label>
<div ><input  type="text" class="car_brand" name="vehicle_model" id="loan_amount" value="<?php echo no_($app['vehicle_model']);?>"/></div>
</section>
<?php 	} ?>
<section>
<label for="vehicle_max_price">Vehicle Max Price</label>
<div ><input disabled="" type="text" class="car_brand" name="vehicle_max_price" id="vehicle_max_price" value="<?php echo $app['vehicle_max_price'];?>"/></div>
</section>
<section>
<label for="vehicle_max_miles">Vehicle Max Miles</label>
<div ><input  type="text" class="car_brand" name="vehicle_max_miles" id="vehicle_max_miles" value="<?php echo $app['vehicle_max_miles'];?>"/></div>
</section>
<?php if($app['vehicle_category']){ ?>
<section>
<label for="vehicle_category">Vehicle Category</label>
<div><input  type="text" class="car_brand" name="vehicle_category" id="vehicle_category" value="<?php echo $app['vehicle_category'];?>"/></div>
</section>
<?php 	} ?><?php if($app['vehicle_body_type']){ ?>
<section>
<label for="vehicle_body_type">Vehicle Body Type</label>
<div><input  type="text" class="car_brand" name="vehicle_body_type" id="vehicle_body_type" value="<?php echo $app['vehicle_body_type'];?>"/></div>
</section>
               <?php 	} ?>
<?php if($app['vehicle_color']){?>
<section>
<label for="vehicle_max_price">Vehicle Colour </label>
<div ><select class="car_brand" name="vehicle_color" ><option value="">Please Choose a Colour</option><option value="Any" <?php echo ($app['vehicle_color']=="Any")?"selected" : "";?> >Any Color</option><option value="Beige" <?php echo ($app['vehicle_color']=="Beige")? "selected" : "";?> >Beige</option><option value="Black" <?php echo ($app['vehicle_color']=="Black")? "selected" : "";?> >Black</option><option value="Blue" <?php echo ($app['vehicle_color']=="Blue")? "selected" : "";?> >Blue</option><option value="Brown" <?php echo ($app['vehicle_color']=="Brown")? "selected" : "";?> >Brown</option><option value="Bronze" <?php echo ($app['vehicle_color']=="Bronze")? "selected" : "";?> >Bronze</option><option value="Claret" <?php echo ($app['vehicle_color']=="Claret")? "selected" : "";?> >Claret</option><option value="Copper" <?php echo ($app['vehicle_color']=="Copper")? "selected" : "";?> >Copper</option><option value="Cream" <?php echo ($app['vehicle_color']=="Cream")? "selected" : "";?> >Cream</option>
<option value="Gold" <?php echo ($app['vehicle_color']=="Gold")? "selected" : "";?> >Gold</option>
<option value="Gray" <?php echo ($app['vehicle_color']=="Gray")? "selected" : "";?> >Gray</option>
<option value="Green" <?php echo ($app['vehicle_color']=="Green")? "selected" : "";?> >Green</option>
<option value="Maroon" <?php echo ($app['vehicle_color']=="Maroon")? "selected" : "";?> >Maroon</option>
<option value="Metallic" <?php echo ($app['vehicle_color']=="Metallic")? "selected" : "";?> >Metallic</option>
<option value="Navy" <?php echo ($app['vehicle_color']=="Navy")? "selected" : "";?> >Navy</option><option value="Orange" <?php echo ($app['vehicle_color']=="Orange")? "selected" : "";?> >Orange</option><option value="Pink" <?php echo ($app['vehicle_color']=="Pink")? "selected" : "";?> >Pink</option>
<option value="Purple" <?php echo ($app['vehicle_color']=="Purple")? "selected" : "";?> >Purple</option>
<option value="Red" <?php echo ($app['vehicle_color']=="Red")? "selected" : "";?> >Red</option>
<option value="Rose" <?php echo ($app['vehicle_color']=="Rose")? "selected" : "";?> >Rose</option><option value="Rust" <?php echo ($app['vehicle_color']=="Rust")? "selected" : "";?> >Rust</option><option value="Silver" <?php echo ($app['vehicle_color']=="Silver")? "selected" : "";?> >Silver</option><option value="Tan" <?php echo ($app['vehicle_color']=="Tan")? "selected" : "";?> >Tan</option><option value="Turquoise" <?php echo ($app['vehicle_color']=="Turquoise")? "selected" : "";?> >Turquoise</option><option value="White" <?php echo ($app['vehicle_color']=="White")? "selected" : "";?> >White</option><option value="Yellow" <?php echo ($app['vehicle_color']=="Yellow")? "selected" : "";?> >Yellow</option></select></div>
</section>
<?php } ?>
<?php if($app['vehicle_transmission']){?>
<section>
<label for="vehicle_max_price">Vehicle Transmission</label>
<div ><select class="car_brand" name="vehicle_transmission" ><option value="">Please Choose a Transmission Type</option><option value="Automatic" <?php echo ($app['vehicle_transmission']=="Automatic")?"selected" : "";?> >Automatic</option><option value="Manual" <?php echo ($app['vehicle_transmission']=="Manual")?"selected" : "";?> >Manual</option></select></div>
</section>
<?php } ?>
<?php if($app['vehicle_year_min']){?>
<section>
<label for="vehicle_max_price">Vehicle Min Year</label>
<div ><select id="from" placeholder="From" class="car_brand" name="vehicle_year_min" ><option value="">Please Choose a Minimum Year</option>
<?php for($i=date("Y")+1;$i>=1985;$i--){     $syear= ($app['vehicle_year_min']==$i)?"selected" : "";    echo"<option value='$i' $syear >$i</option>";}?></select></div>
</section>
<?php } ?>
<?php if($app['vehicle_year_max']){?>
<section>
<label for="vehicle_max_price">Vehicle Max Year</label>
<div ><select id="from" placeholder="From" class="car_brand" name="vehicle_year_max" ><option value="">Please Choose a Maximum Year</option><?php for($i=date("Y")+1;$i>=1985;$i--){     $syear= ($app['vehicle_year_max']==$i)?"selected" : "";    echo"<option value='$i' $syear >$i</option>";}?></select></div>
</section>
<?php } ?>
<?php if($app['fuel_type']){?>
<section>
<label for="vehicle_max_price">Vehicle Fuel Type</label>
<div ><select class="car_brand" name="fuel_type" ><option value="">Please Choose a Vehicle Fuel Type</option>
<option value="Any" <?php echo ($app['fuel_type']=="Any")?"selected" : "";?> >Any Fuel Type</option><option value="Gasoline" <?php echo ($app['fuel_type']=="Gasoline")?"selected" : "";?> >Gasoline</option>
<option value="Diesel" <?php echo ($app['fuel_type']=="Diesel")?"selected" : "";?> >Diesel</option><option value="Electric Plug In" <?php echo ($app['fuel_type']=="Electric Plug In")?"selected" : "";?> >Electric Plug In</option><option value="Hybrid" <?php echo ($app['fuel_type']=="Hybrid")?"selected" : "";?> >Hybrid</option><option value="Propane" <?php echo ($app['fuel_type']=="Propane")?"selected" : "";?> >Propane</option><option value="Natural Gas" <?php echo ($app['fuel_type']=="Natural Gas")?"selected" : "";?> >Natural Gas</option></select></div>
</section>
<?php } ?>
<?php if($app['engine_type']){?>
<section>
<label for="vehicle_max_price">Vehicle Engine_Type</label>
<div ><select class="car_brand" name="engine_type" ><option value="">Please Choose an Engine Type</option>
<option value="Any" <?php echo ($app['engine_type']=="Any")?"selected" : "";?> >Any Engine Type</option>
<option value="4 Cylinder" <?php echo ($app['engine_type']=="4 Cylinder")?"selected" : "";?> >4 Cylinder</option>
<option value="V6 Cylinder" <?php echo ($app['engine_type']=="V6 Cylinder")?"selected" : "";?> >V6 Cylinder</option>
<option value="Straight 6 Cylinder" <?php echo ($app['engine_type']=="Straight 6 Cylinder")?"selected" : "";?> >Straight 6 Cylinder</option><option value="V8 Cylinder" <?php echo ($app['engine_type']=="V8 Cylinder")?"selected" : "";?> >V8 Cylinder</option><option value="Electric" <?php echo ($app['engine_type']=="Electric")?"selected" : "";?> >Electric</option></select></div>
</section>
<?php } ?>
<?php if($app['radius']){?>
<section>
<label for="best_time">Search Radius</label>
<div><select class="car_brand" name="radius" >
<option value="">Please Choose a Search Radius</option>
<?php for($i=5;$i<=45;$i+=5){
$sradius= ($app['radius']==$i)?"selected" : "";    
echo"<option value='$i' $sradius  >$i Km</option>";
}
for($i=50;$i<=175;$i+=25){     
$sradius= ($app['radius']==$i)?"selected" : "";    
echo"<option value='$i' $sradius  >$i Km</option>";
}
for($i=200;$i<=500;$i+=100){     
$sradius= ($app['radius']==$i)?"selected" : "";    
echo"<option value='$i' $sradius  >$i Km</option>";
}?>
</select>
</div>
</section>
<?php } ?>
<?php if($app['preferred_contact_method']){?>
<section>
<label for="best_time">Preferred Contact Method</label>
<div><select class="car_brand" name="preferred_contact_method"  onchange="yesnoCheck(this);">
<option value="">Please Choose a Contact Method</option>
<option value="Email" <?php echo ($app['preferred_contact_method']=="Email")?"selected" : "";?> >Email</option>
<option id="phoneSelected" value="Phone" <?php echo ($app['preferred_contact_method']=="Phone")?"selected" : "";?> >Phone</option>
<option value="Text" <?php echo ($app['preferred_contact_method']=="Text")?"selected" : "";?> >Text</option>
</select></div>
</section>
<?php } ?>
<?php if($app['best_time']){?>
<section id="besttime" style="display: none;">
<label for="best_time">Preferred Contact Time</label>
<div><select class="car_brand" name="best_time"  >
<option value="">Please Choose a Preferred Contact Time</option><option value="Early Morning (7-9)" <?php echo ($app['best_time']=="Early Morning (7-9)")?"selected" : "";?> >Early Morning (7-9)</option>
<option value="Morning (9-12)" <?php echo ($app['best_time']=="Morning (9-12)")?"selected" : "";?> >Morning (9-12)</option>
<option value="Early Afternoon (12-3)" <?php echo ($app['best_time']=="Early Afternoon (12-3)")?"selected" : "";?> >Early Afternoon (12-3)</option>
<option value="Late Afternoon (3-6)" <?php echo ($app['best_time']=="Late Afternoon (3-6)")?"selected" : "";?> >Late Afternoon (3-6)</option><option value="Early Evening (6-8)" <?php echo ($app['best_time']=="Early Evening (6-8)")?"selected" : "";?> >Early Evening (6-8)</option><option value="Late Evening (8-10)" <?php echo ($app['best_time']=="Late Evening (8-10)")?"selected" : "";?> >Late Evening (8-10)</option></select></div>
</section>
<?php } ?>
<?php if($app['customer_comments']){?>
<section>
<label for="customer_comments">Your Comments or Specifications</label>
<div><textarea name="customer_comments" id="customer_comments" cols="57" rows="5"> <?php echo $app['customer_comments'];?></textarea></div>
</section>        
    <?php } ?>        
</div>
 <input type="hidden" id="gallery_loaded"   value="0">       
 </div>       
  <?php
	if($current_make_model<> $next_make_model) {
	echo "            
        </div>
        ";
	} else echo "<HR>";
} // foreach
echo "</section>";
} // if($version!=SL)
            ?>
         <script>
         $(document).ready(function(){
     $( ".carSpecs :input" ).prop( "disabled", true ); //Disable
         $( ".carSpecs :select" ).prop( "disabled", true ); //Disable
          $( ".carSpecs :textarea" ).prop( "disabled", true ); //Disable
    });     
</script>        
<?php
/////////////////////////////////  END OF BUYERS CARS CODE 
            ?>
         <script>
         $(document).ready(function(){
     $( ".carSpecs :input" ).prop( "disabled", true ); //Disable
         $( ".carSpecs :select" ).prop( "disabled", true ); //Disable
          $( ".carSpecs :textarea" ).prop( "disabled", true ); //Disable
    }); 
     $( ".rating" ).change(function() { //can use #id here too
         $.ajax({
         type: 'post',
         url: 'ajax_save_rating.php',
         data: {
             get_option:this.value
         },
         success: function (response) {
             document.getElementById("result").innerHTML=response; 
         }
         });
   });
  $(document).ready(function(){
	  $(".ff_faq_header").on("click",function(){ 
		  /*var id = $(this).attr('data-rand-id');
		  var gallery = $("#gallery_"+id).val();
		  if(id > 0 && gallery>0) {
			  Galleria.run('#galleria'+id);
		  } */
		  var accordian_id = $(this).attr('aria-controls');
		  $("div#"+accordian_id+" .is_gallery_active").each(function(){
			  id = $(this).attr('data-rand-id');
			  var gallery = $("#gallery_"+id).val();
			  if(id > 0 && gallery>0) {
				  Galleria.run('#galleria'+id);
			  } 
		  })
	  });
	  $(document).on("click",".ff_faq_header",function(){ 
		  var id = $(this).attr('data-quote-id');
		  if($(this).hasClass('new_quote_title') == false) return false;
		  if(id > 0) {
			  $(this).removeClass('new_quote_title');
			  $(this).children('img').hide();
			  var offer_counter = parseInt($(".offer_counter").html());
			  if ( offer_counter <=1) $(".offer_counter").hide();
			  else {
				  $(".offer_counter").html(parseInt(offer_counter-1));
			  }
			  $.post( 'ajax_dealer_offers.php' , { quote_id : id, action:"update_quote_view" }, 
				   function( response ) {
					 console.log(response);
			 });
		  }
	  });
  });
 function save_checkbox(checkbox_id, record_id,id) {
	var checked = $("#checkbox_"+id).is(":checked")?1:0;
	var action = (checked == 1)?'add':'remove';
	 var loader = '<img src="images/loading.gif" alt="please wait">';
	$("#content_"+id).html(loader);
	//alert('checkbox_id is '+checkbox_id+' record_id is '+record_id+' and id is '+id);
    $.post( 'ajax_update_shortlist.php' , { checked : checkbox_id, r_id : record_id,action:action }, 
       function( response ) {
        // alert(response+record_id)
        	$("#content_"+id).html(response);
       }
    );
 }
</script>        