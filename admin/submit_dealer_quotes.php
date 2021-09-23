<?php
require("../includes/lib/common.php");
require("../includes/lib/classes/a/applications.php"); 
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/dealer_quotes.php"); 
require("../includes/lib/classes/a/points.php"); 
require("../includes/lib/classes/a/settings.php");

function no_($var="") {  
	return str_replace("_"," ",$var); 
}

$users 		= new users(); $users->require_logged_in("login.php");
$quotes		= new quotes();
$apps 		= new applications();
$points		= new points();
$settings	= new settings();

$apps_id 	= $request->getvalue('request');
$dealer_id  = $request->getvalue('dealer_id');


if(!$dealer_id AND $session->get('user_id')!=''){
    $dealer_id=$_SESSION['user_id'];
}


if($apps_id>0) {
	$apps->load($apps_id);
}

$vehicle_id=$apps_id;

$quotes->loadByVehicleID($vehicle_id,$dealer_id);

 $quoteFlag=0;
if($quotes->vehicle_id>1){ 
    $cars = (array) $quotes;
    $quoteFlag=1;
}else{
       $cars = (array) $apps;
 }   
		$image_id = $request->getvalue('image');
		if($image_id > 0 ) {
			$quotes->delete_vehicle_image($image_id);
			header("Location:submit_dealer_quotes.php?request={$vehicle_id}");
			die();
		}
        if($request->postvalue('action')=="saveDetails"){  
			
				if($quotes->id <= 0) {
					
					$points->dealer_id = $dealer_id;
					$points->points_description = "New Quote Reward";
					$points->points = $settings->get_value('points_for_quote');
					$points->points_date = date("Y-m-d H:i:s");
					$points->save();
				}
			
			
                $quotes->id							   	=	$quotes->id;
                $quotes->member_id					   	=	$cars['member_id'];
                $quotes->dealer_id    				    =	$dealer_id;
				$quotes->vehicle_id    				      =	$vehicle_id;
                $quotes->vehicle_make                     =	$request->postvalue('vehicle_make');
                $quotes->vehicle_model                    =	$request->postvalue('vehicle_model');
                $quotes->vehicle_price                    =	$request->postvalue('vehicle_price');
                $quotes->vehicle_extra_fees               =	$request->postvalue('vehicle_extra_fees');
                $quotes->vehicle_miles                    =	$request->postvalue('vehicle_miles');
                $quotes->vehicle_category                 =	$request->postvalue('vehicle_category');
                $quotes->vehicle_body_type                =	$request->postvalue('vehicle_body_type');
                $quotes->vehicle_color                    = $request->postvalue('vehicle_color');
                $quotes->vehicle_year                     = $request->postvalue('vehicle_year');
                $quotes->vehicle_year_max                 = $request->postvalue('vehicle_year_max');
                $quotes->vehicle_transmission             = $request->postvalue('vehicle_transmission');
                $quotes->payment_method                   = $request->postvalue('payment_method');
                $quotes->date_submitted                   = $request->postvalue('date_submitted');
                $quotes->coupon                           = $request->postvalue('coupon');
                $quotes->preferred_contact_time           = $request->postvalue('preferred_contact_time');
                $quotes->radius                           = $request->postvalue('radius');
                $quotes->fuel_type                        = $request->postvalue('fuel_type');   
                $quotes->engine_type                      = $request->postvalue('engine_type');
			    $quotes->engine_size                      = $request->postvalue('engine_size');
			    $quotes->vehicle_status                   = $request->postvalue('vehicle_status');
				$quotes->dealer_comments      			  = $request->postvalue('dealer_comments');
                $quotes->save();
$success="<h2>Entered Successfully</h2>Thank you for completing this request for quotes for the $apps->vehicle_make  $apps->vehicle_model $apps->vehicle_category $apps->vehicle_body_type. We'll present your quote to the buyer and let you know if they are interested.<br /><br />If you are not immediately redirected to the quote list, Please <a href='https://carleado.com/admin/dealer_quote_requests.php' >CLICK HERE</a> ";



            $options=array();
            $options['dealer_id'] = $quotes->dealer_id;
            $options['member_id'] = $quotes->member_id;
            $options['vehicle_id'] = $quotes->vehicle_id;
            $options['vehicle_make'] = $quotes->vehicle_make;
            $options['vehicle_model'] = $quotes->vehicle_model;
            
            $quotes->sendBuyerQuoteNotice($options);













//////////  IMAGES
   
	for($i=0; $i<sizeof($_FILES['gmain_image']['name']); $i++){
		if($_FILES['gmain_image']['name'][$i]!=''){
				$key = $i;
				$file_name 	= 	$_FILES['gmain_image']['name'][$key];
				$file_size 	=	$_FILES['gmain_image']['size'][$key];
				$file_tmp 	=	$_FILES['gmain_image']['tmp_name'][$key];
				$file_type	=	$_FILES['gmain_image']['type'][$key];
				$file_error	=	$_FILES['gmain_image']['error'][$key];
				$file = array(
				"name"		=>	$file_name,
				"type"		=>	$file_type,
				"tmp_name"	=>	$file_tmp,
				"error"		=>  $file_error,
				"size"		=>	$file_size
				);
					$upload="../images/vehicles";
					$file_name = resize_image($upload,$upload,200,$file);
					#echo $file_name;
					#die();
					$newName1 = resize_size_step_2($upload,$upload,$file_name,$newName1="",200,$file);
					$newName12 = resize_size_step_2("../images/vehicles","../images/vehicles/larger",$file_name,$newName12="",650,$file);
					$quotes->vehicle_image_thumbnail 	= $newName1;
					$quotes->vehicle_image_big_image	= $newName12;
					//$quotes->vehicle_image_title		= $gtitle[$i];
					//$quotes->vehicle_image_description	= $gdesc[$i];
					$quotes->vehicle_image_id			= 0;
					$quotes->add_vehicle_images();
					unlink("$upload/$file_name");
		}
		
	}

?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Quote Requests</title>
	<meta name="description" content="">
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="css/style.css">
    <style> 
    .selector.selectPad{
        height: 40px;
        width: 160px; 
        
        }
    </style>
   
 <?php   require("includes/main.php");?>
    
 
    
<?php include("admin_header.php"); ?>
				<nav>
			<?php include("left_navigation.php");?>
		</nav>
        <section id="content">
		<div class="widget" id="widget_breadcrumb">
					<h3 class="handle">Sections</h3>
					<div>
						<ul class="breadcrumb" data-numbers="true">
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php">Admin Dashboard</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/dealer_quote_requests.php">Dealer Quote Requests</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/submit_dealer_quotes.php">Submit Quotes</a></li>
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Vehicle Quote</h1>
			<p></p>
<div style="background-color: #CCFFCC; padding: 20px; border-radius:20px; text-align:center;"><?php echo $success;?></div>
   <?php     echo "<meta http-equiv = \"refresh\" content = \"5; url = https://carleado.com/admin/dealer_quote_requests.php?\">";
        die;
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Dealer Quotes </title>
	<meta name="description" content="">
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="css/style.css">
    
    <style> 
    .selector.selectPad{
        height: 40px;
        width: 160px; 
        
        }
        
        input{
            color:#000 !important;
            font-weight: bold;
        }
    span{
        font-weight: bold;
    }

    </style>
    
    <?php require("includes/main.php");?>
	<?php
?>
</head>
<body>
<?php include("admin_header.php"); ?>
				<nav>
			<?php include("left_navigation.php");?>
		</nav>
        <section id="content">
		<div class="widget" id="widget_breadcrumb">
					<h3 class="handle">Sections</h3>
					<div>
						<ul class="breadcrumb" data-numbers="true">
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php">Admin Dashboard</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/dealer_quote_requests.php">Dealer Quote Requests</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/submit_dealer_quotes.php">Submit Quotes</a></li>
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Vehicle Quote</h1>
			<p></p>
            <?php if(@$image_name_exist!='') { ?><div class="alert warning">ERROR : Image with the same name already exists</div> <?php } ?>
            <?php if(@$urlkey_status!='') { ?><div class="alert warning">ERROR : Another page with same URL KEY already exists.</div> <?php } ?>
		</div>	
		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" onSubmit="return validate_contents();" enctype="multipart/form-data">
				
				
					<fieldset>
					
					<?php if($quoteFlag == 1) { ?>
				
					<div class="alert warning">You have already submitted the Quote For this vehicle. Now You can only view the submitted Quote.</div>

				<?php } ?>
					
<?php
echo "Please quote on the vehicle below. Change any fields below to show the correct description for your vehicle.<br />Fields marked  <span class=\"required\">&nbsp;</span> are required<br />";
   ?>         
<div class="carSpecs"  >  
<?php if($cars['vehicle_category']){ ?>
<section>
<label for="vehicle_category">Vehicle Category</label>
<div><input  type="text" class="car_brand" name="vehicle_category" id="vehicle_category" value="<?php echo $cars['vehicle_category'];?>"/></div>
</section>
<?php 	} ?><?php if($cars['vehicle_body_type']){ ?>
<section>
<label for="vehicle_body_type">Vehicle Body Type <span style="font-size: 70%;">This buyer didn't specify a make or model preferrence. Please quote on your best value <?php echo $cars['vehicle_body_type'];?></label>
<div><input  type="text" class="car_brand" name="vehicle_body_type" id="vehicle_body_type" value="<?php echo $cars['vehicle_body_type'];?>"/></div>
</section>
               <?php 	} ?>
                
<section>
<label for="loan_amount">Vehicle Make <span class="required">&nbsp;</span></label>
<div ><input  type="text" class="car_brand" name="vehicle_make" class="car_brand" id="loan_amount" value="<?php echo no_($cars['vehicle_make']);?>" required /></div>
</section>
	
<section>
<label for="vehicle_model">Vehicle Model <span class="required">&nbsp;</span></label>
<div ><input  type="text" class="car_brand" name="vehicle_model" id="loan_amount" value="<?php echo no_($cars['vehicle_model']);?>" required /></div>
</section>
<?php //	} ?>
<section>
<label for="vehicle_max_price">Your Quote -  <span class="required">&nbsp;</span><?php if(!$quoteFlag){?> <span style="font-size: 70%;">Note: Buyers Max - $<?php echo number_format(tofloat($cars['vehicle_max_price']),2);?></span> <?php } ?></label>
<div ><input  type="text" class="car_brand" name="vehicle_price" id="vehicle_price" value="<?php echo $cars['vehicle_price'];?>" required /></div>
</section>
<section>
<label for="dealer_comments">Extra Fees -  <span class="required">&nbsp;</span><span style="font-size: 70%;"> &nbsp;Itemize any additional fees such as Documentation fees, Delivery fees, Vehicle Preparation fees etc.</span><br />Enter "None" if there are no extra fees. </label>
<div><textarea name="vehicle_extra_fees" id="vehicle_extra_fees" cols="57" rows="5"  required > <?php echo $cars['vehicle_extra_fees'];?></textarea></div>
</section>        
<section>
<label for="vehicle_max_price">Coupon - <span style="font-size: 70%;">Optional - Give the buyer an incentive. Dollars or Percentage</span></label>
<div ><input  type="text" class="car_brand" name="coupon" id="coupon" value="<?php echo $cars['coupon'];?>"/></div>
</section>
<section>
<label for="vehicle_max_miles">Vehicle Miles -  <span class="required">&nbsp;</span><?php if(!$quoteFlag){?> <span style="font-size: 70%;">Note: Buyers Max - <?php echo number_format(tofloat($cars['vehicle_max_miles']),0);?></span><?php }?></label>
<div ><input  type="text" class="car_brand" name="vehicle_miles" id="vehicle_max_miles" value="<?php echo $cars['vehicle_miles'];?>"  required /></div>
</section>

<section>
<label for="vehicle_max_price">Vehicle Colour </label>
<div ><select class="car_brand" style="width:160px; height:40px;" name="vehicle_color" ><option value="">Colour</option><option value="Any" <?php echo ($cars['vehicle_color']=="Any")?"selected" : "";?> >Any Color</option><option value="Beige" <?php echo ($cars['vehicle_color']=="Beige")? "selected" : "";?> >Beige</option><option value="Black" <?php echo ($cars['vehicle_color']=="Black")? "selected" : "";?> >Black</option><option value="Blue" <?php echo ($cars['vehicle_color']=="Blue")? "selected" : "";?> >Blue</option><option value="Brown" <?php echo ($cars['vehicle_color']=="Brown")? "selected" : "";?> >Brown</option><option value="Bronze" <?php echo ($cars['vehicle_color']=="Bronze")? "selected" : "";?> >Bronze</option><option value="Claret" <?php echo ($cars['vehicle_color']=="Claret")? "selected" : "";?> >Claret</option><option value="Copper" <?php echo ($cars['vehicle_color']=="Copper")? "selected" : "";?> >Copper</option><option value="Cream" <?php echo ($cars['vehicle_color']=="Cream")? "selected" : "";?> >Cream</option>
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
<label for="vehicle_transmission">Vehicle Transmission<span class="required">&nbsp;</span> </label>
<div ><select class="car_brand" style="width:160px; height:40px;" name="vehicle_transmission" required /><option value="">Transmission Type</option><option value="Automatic" <?php echo ($cars['vehicle_transmission']=="Automatic")?"selected" : "";?> >Automatic</option><option value="Manual" <?php echo ($cars['vehicle_transmission']=="Manual")?"selected" : "";?> >Manual</option></select></div>
</section>
<section>
<label for="vehicle_year_min">Vehicle Year  <span class="required">&nbsp;</span> <?php if($cars['vehicle_year_min']){ ?>
    <span style="font-size: 70%;">Note: Buyers Range - <?php echo " - ".$cars['vehicle_year_min']." to ".$cars['vehicle_year_max'];?></span>
    <?php } ?>
    </label>
<div ><select id="from" placeholder="From" style="width:160px; height:40px;"  class="car_brand" name="vehicle_year"  required /><option value="">Vehicle Year <span class="required">&nbsp;</span></option>
<?php for($i=date("Y")+1;$i>=1985;$i--){     $syear= ($cars['vehicle_year']==$i)?"selected" : "";    echo"<option value='$i' $syear >$i</option>";}?></select></div>
</section>
<section>
<label for="vehicle_max_price">Vehicle Fuel Type</label>
<div ><select class="car_brand"  style="width:160px; height:40px;" name="fuel_type" ><option value="">Vehicle Fuel Type</option>
<option value="Any" <?php echo ($cars['fuel_type']=="Any")?"selected" : "";?> >Any Fuel Type</option><option value="Gasoline" <?php echo ($cars['fuel_type']=="Gasoline")?"selected" : "";?> >Gasoline</option>
<option value="Diesel" <?php echo ($cars['fuel_type']=="Diesel")?"selected" : "";?> >Diesel</option><option value="Electric Plug In" <?php echo ($cars['fuel_type']=="Electric Plug In")?"selected" : "";?> >Electric Plug In</option><option value="Hybrid" <?php echo ($cars['fuel_type']=="Hybrid")?"selected" : "";?> >Hybrid</option><option value="Propane" <?php echo ($cars['fuel_type']=="Propane")?"selected" : "";?> >Propane</option><option value="Natural Gas" <?php echo ($cars['fuel_type']=="Natural Gas")?"selected" : "";?> >Natural Gas</option></select></div>
</section>
<section>
<label for="vehicle_max_price">Vehicle Engine Type</label>
<div ><select class="car_brand"  style="width:160px; height:40px;" name="engine_type" ><option value="">Engine Type</option>
<option value="Any" <?php echo ($cars['engine_type']=="Any")?"selected" : "";?> >Any Engine Type</option>
<option value="4 Cylinder" <?php echo ($cars['engine_type']=="4 Cylinder")?"selected" : "";?> >4 Cylinder</option>
<option value="V6 Cylinder" <?php echo ($cars['engine_type']=="V6 Cylinder")?"selected" : "";?> >V6 Cylinder</option>
<option value="Straight 6 Cylinder" <?php echo ($cars['engine_type']=="Straight 6 Cylinder")?"selected" : "";?> >Straight 6 Cylinder</option><option value="V8 Cylinder" <?php echo ($cars['engine_type']=="V8 Cylinder")?"selected" : "";?> >V8 Cylinder</option><option value="Electric" <?php echo ($cars['engine_type']=="Electric")?"selected" : "";?> >Electric</option></select></div>
</section>

<section>
<label for="engine_size">Engine Size <span style="font-size: 70%;"></span></label>
<div ><input  type="text" class="car_brand" name="engine_size" id="engine_size" value="<?php echo $cars['engine_size'];?>"/></div>
</section>



<section>
<label for="vehicle_max_price">Vehicle Status</label>
<div ><select class="car_brand"  style="width:160px; height:40px;" name="vehicle_status" required ><option value="">Vehicle Status</option>
<option value="Rebuilt" <?php echo ($cars['vehicle_status']=="Rebuilt")?"selected" : "";?> >Rebuilt</option>
<option value="Clean" <?php echo ($cars['vehicle_status']=="Clean")?"selected" : "";?> >Clean</option>
<option value="Salvage" <?php echo ($cars['vehicle_status']=="Salvage")?"selected" : "";?> >Salvage</option>
</select></div>
</section>




<section><label for="main_image">Upload Image(s)<br><span></span></label>
	<div style="min-height: 40px !important;"><input type="file" accept="image/png, image/jpeg" multiple style="width:200px; height:40px;" id="gmain_image" name="gmain_image[]">
	</div>
</section>
<?php
	//////////////// START OF IMAGES
?>
 <?php 
	$vehicle_images 	= $quotes->getVehicleImagesList($vehicle_id,$dealer_id);
	if($vehicle_images !='empty')	{

	?>
	<section><label for="main_image">Vehicle Image(s)<br><span></span></label>
	<div>
	<?php foreach($vehicle_images as $image) { ?>
	<span style="display:inline-block;margin-top:10px;float:left;"><img src="../images/vehicles/<?php echo $image['thumbnail'];?>" width="60" style="border:1px solid #000; padding:2px;">
	<br><a href="submit_dealer_quotes.php?request=<?php echo $request->getvalue('request');?>&image=<?php echo $image['image_id'];?>" 
	onClick="return confirm('Are you sure you want to delete?')" style="padding-left:3px;font-size: 12px;">Delete image</a></span>
	<?php } ?>
	</div>
	</section>

  <?php } ?>
		
        <section><br />
<label for="buyer_comments" style="text-align:left !important;">Buyer Comments </label>
<div><textarea name="xxx" id="buyer_comments"  rows="5" disabled style="background: #DDD; max-width:85vw;" > <?php echo $cars['customer_comments'];?></textarea></div>
</section>        
<section>
        
        
        

<section style="clear:left; display: none;">
<label for="dealer_comments">Your Comments or Specifications</label>
<div><textarea name="dealer_comments" id="dealer_comments" cols="57" rows="5"> <?php echo $cars['dealer_comments'];?></textarea></div>
</section>        
<input type="hidden" name="action" value="saveDetails" />
              <input type="hidden" name="memberID" value="<?php echo $cars['member_id'];?>"/> 
            <?php  if(!$quoteFlag){?>
              <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id;?>"/>
              <?php }else{?>
                <input type="hidden" name="id" value="<?php echo $cars['id'];?>"/>
           <?php   } ?>
           <input type="hidden" name="request" value="<?php echo  $vehicle_id;?>"/>
           <input type="hidden" name="dealer_id" value="<?php echo  $dealer_id;?>"/>
<section>
<label for="submit"></label>
		<div>
		
		<?php if($quoteFlag == 0)	{ ?>
		<button class="submit" name="manage_service_button" value="submit">Submit</button>
		
		<?php } ?>
		</div>
</section>              
                     </form>            
</div>
<?php unset($cars); ?>
  <?php echo "            
            </div>
        </div>
        <div>";
         include("footer.php");?>
        <script>
			
			
		$('form').wl_Form({
			ajax:false
		});
			
			
		$(document).ready(function(){ 
			
			var quote = '<?php echo $quoteFlag;?>';
			
			if(quote == 1) {
				
				$("input,textarea").attr("readonly","1");
				$('select').prop('disabled', 'disabled');
				
			}
		});
			
		</script> 
        