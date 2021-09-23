<?php
require("../includes/lib/common.php");
require("../includes/lib/classes/a/applications.php"); 
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/broker_quotes.php");
require("../includes/lib/classes/a/members.php"); 
require("../includes/lib/functions/submenuBuilder.php");
function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}

$users          = new users();
$financial      = new financial();
$memb           = new members();
$apps           = new applications();



 if($_SESSION['mode']=="admin"){
 $users->require_logged_in("login.php");   
 }else{
    $users->require_logged_in("login_dealer.php");
 }



$member_id   = $request->getvalue('request');
$vehicle_id   = $request->getvalue('vehicle_id');


if(!$dealer_id AND $_SESSION['user_id']){
    $dealer_id=$_SESSION['user_id'];
}
if($_SESSION['mode']=="dealer" OR $_SESSION['mode']=="broker"){
    if($dealer_id>"" AND $dealer_id <>$_SESSION['user_id'] ){
        header("Location: https://carleado.com/admin/dashboard.php");
        die;
    }
}


if($member_id>0){
	$financial->loadByMemberVehicle($member_id,$vehicle_id);
    
    $memb->load($member_id);
       }
       
       


 
 if($_POST['action']=="saveDetails"){   

                $financial->id 							     =	$financial->id;
                $financial->member_id  					     =	$cars['member_id'];
                $financial->dealer_id      				     =	$dealer_id;
				$financial->vehicle_id     			         =	$vehicle_id;
                $financial->payment_offer                    = $request->postvalue('payment_offer');
                $financial->rate_offer                       = $request->postvalue('rate_offer');
                $financial->term_offer                       = $request->postvalue('term_offer');
                $financial->vehicle_make                     =	$request->postvalue('vehicle_make');
                $financial->vehicle_model                    =	$request->postvalue('vehicle_model');
                $financial->vehicle_price                    =	$request->postvalue('vehicle_price');
                $financial->vehicle_extra_fees               =	$request->postvalue('vehicle_extra_fees');
                $financial->vehicle_miles                    =	$request->postvalue('vehicle_miles');
                $financial->vehicle_category                 =	$request->postvalue('vehicle_category');
                $financial->vehicle_body_type                =	$request->postvalue('vehicle_body_type');
                $financial->vehicle_color                    = $request->postvalue('vehicle_color');
                $financial->vehicle_year                     = $request->postvalue('vehicle_year');
                $financial->vehicle_year_max                 = $request->postvalue('vehicle_year_max');
                $financial->vehicle_transmission             = $request->postvalue('vehicle_transmission');
                $financial->payment_method                   = $request->postvalue('payment_method');
                $financial->date_submitted                   = $request->postvalue('date_submitted');
                $financial->coupon                           = $request->postvalue('coupon');
                $financial->preferred_contact_time           = $request->postvalue('preferred_contact_time');
                $financial->radius                           = $request->postvalue('radius');
                $financial->fuel_type                        = $request->postvalue('fuel_type');   
                $financial->engine_type                      = $request->postvalue('engine_type');
				$financial->dealer_comments      			 = $request->postvalue('dealer_comments');
                
                $quotes->save();
$success="<h2>Entered Successfully</h2>Thank you for completing this request for quotes for the $apps->vehicle_make  $apps->vehicle_model $apps->vehicle_category $apps->vehicle_body_type. We'll present your quote to the buyer and let you know if they are interested.<br /><br />If you are not immediately redirected to the quote list, Please <a href='https://carleado.com/admin/dealer_quote_requests.php' >CLICK HERE</a> ";
?>



<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Buyer Credit Information</title>
	<meta name="description" content="">
	
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="css/style.css">
   
    
    
    
    <?php 
    
    
    
    
    $head="
     <style>
    input{
        font-size: 18px !important;
        disabled: disabled !important;
    }
    
    
    </style>
    "; 
    
    if($is_mobile){
         $head="
     <style>
    input{
        color:#000 !important;
        font-weight: 600;
    }
    
    
    </style>
    "; 
    }
    
    
    
    
    require("includes/main.php");
	


include("admin_header.php"); ?>
				<nav>
			<?php include("left_navigation.php");?>
		</nav>
        <section id="content">
		<div class="widget" id="widget_breadcrumb">
					<h3 class="handle">Sections</h3>
					<div>
						<ul class="breadcrumb" data-numbers="true">
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php"> Dashboard</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/buyer_credit_info.php">Dealer Quote Requests</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/buyer_credit_info.php">Buyer Credit Information</a></li>
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



   <?php     echo "<meta http-equiv = \"refresh\" content = \"5; url = https://carleado.com/admin/dealer_quote_requests.php\">";
        die;
}
   

?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Buyer Credit Information</title>
	<meta disabled='disabled' name="description" content="">
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="css/style.css">
    <?php 
    
     
    $head="
     <style>
    input{
        font-size: 18px !important;
        padding-left: 20px !important;
        disabled: disabled !important;
        color:#000;
        font-weight: bold !important;
    }
        select{
        font-size: 18px !important;
        padding-left: 20px !important;
        disabled: disabled !important;
        font-weight: bold !important;
    }
    form fieldset > section > div > div.selector span {
    
    font-size: 18px !important;
    }
    
    
    
    </style>
    "; 

    require("includes/main.php");?>

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
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php">Dashboard</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/buyer_credit_info.php">Buyer Information</a></li>
                            
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Information about <?php echo $memb->first_name." ".$memb->last_name;?></h1>
			<p></p>
            <?php if(@$image_name_exist!='') { ?><div class="alert warning">ERROR : Image with the same name already exists</div> <?php } ?>
            <?php if(@$urlkey_status!='') { ?><div class="alert warning">ERROR : Another page with same URL KEY already exists.</div> <?php } ?>
		</div>	
		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" onSubmit="return validate_contents();" enctype="multipart/form-data">
					<fieldset>
        









 <section><label for="first_name">First Name<br><span></span></label>
							<div><input type="text" id="first_name" disabled='disabled' name="first_name" value="<?php echo $memb->first_name;?>" required>
							</div>
						</section>
                        
                        <section><label for="last_name">Last Name<br><span></span></label>
							<div><input type="text" id="last_name" disabled='disabled' name="last_name" value="<?php echo $memb->last_name;?>" required>
							</div>
						</section>

                        <section><label for="email">Email<br><span></span></label>
							<div><input type="text" id="email" disabled='disabled' name="email" value="<?php echo $memb->email;?>" required>
							</div>
						</section>
                        
                        
                        <section><label for="position">Phone<br></label>
							<div><input type="text" id="phone" disabled='disabled' name="home_phone" value="<?php echo $memb->home_phone;?>">
							</div>
						</section>
                        
   
                        <section><label for="street">Address</label>
							<div><input type="text" id="address" disabled='disabled' name="address" value="<?php echo $memb->address;?>"></div>
						</section>
                        
                        <section><label for="street">City</label>
							<div><input type="text" id="city" disabled='disabled' name="city" value="<?php echo $memb->city;?>"></div>
						</section>
                        
                        <section><label for="street">Province</label>
							<div><?php 
                                                    $extra  = 'class="form-control-select" style="width:100%;" ';
                                                    echo loadProvinces('province','form-province',$extra,$memb->province);?></div>
						</section>
                        
                        <section><label for="street">Postal code</label>
							<div><input type="text" id="postalcode" disabled='disabled' name="postalcode" value="<?php echo strtoupper($memb->postalcode);?>"></div>
						</section>
                        
                        <section><label for="street">Country</label>
							<div><select type="text" disabled='disabled' name="country" class="form-control-select"id="form-country" style="width:100%;" >
														<option value="">Country *</option>
														<option value="CA" <?php echo ($memb->country=="CA")? "selected" :"";?>>Canada</option>
														<option value="US" <?php echo ($memb->country=="US")? "selected" :"";?>>United States</option>
                                                       
                                                    </select></div>
</section>


<section>
<label for="loan Amount">Loan Amount Requested</label>
<div ><input  type="text" class="car_brand" disabled='disabled' name="loan_amount" id="loan_amount" value="<?php echo "$".number_format(no_($financial->loan_amount),2);?>"/></div>




</section>









<section>
<label for="vehicle_model">Buyer's Preferred Monthly Payment Amount</label>
<div ><input  type="text" class="car_brand" disabled='disabled' name="preferred_payment" id="preferred_payment" value="<?php echo no_($financial->preferred_payment);?>"/></div>




</section>


<section>
<label for="vehicle_max_price">Buyer's Job Title</label>
<div ><input  type="text" class="car_brand" disabled='disabled' name="job_title" id="job_title" value="<?php echo $financial->job_title;?>"/></div>
</section>


<section>
<label for="vehicle_category">Buyer's Employer's Company Name</label>
<div><input  type="text" class="car_brand" disabled='disabled' name="employer_name" id="employer_name" value="<?php echo $financial->employer_name;?>"/></div>
</section>

<section>
<label for="vehicle_max_miles">How Long Buyer Has Worked There (Years/Months)</label>
<div ><input  type="text" class="car_brand" disabled='disabled' name="job_time" id="job_time" value="<?php echo $financial->job_time;?>"/></div>
</section>





<section>
<label for="vehicle_body_type">Buyer's Employer's Phone Number</label>
<div><input  type="text" class="car_brand" disabled='disabled' name="work_phone" id="work_phone" value="<?php echo $financial->work_phone;?>"/></div>
</section>

<section>
<label for="vehicle_body_type">Buyer's Annual Income</label>
<div><input  type="text" class="car_brand" disabled='disabled' name="amount_primary_income" id="primary_income" value="<?php echo $financial->amount_primary_income;?>"/></div>
</section>

<section>
<label for="vehicle_body_type">How Often is the Buyer Paid? (Weekly/BiWeekly/Monthly)</label>
<div><input  type="text" class="car_brand" disabled='disabled' name="frequency_primary_income" id="frequency_primary_income" value="<?php echo $financial->frequency_primary_income;?>"/></div>
</section>

<section>
<label for="vehicle_body_type">How Much Are They Paid Each Period?</label>
<div><input  type="text" class="car_brand" disabled='disabled' name="amount_primary_income" id="amount_primary_income" value="<?php echo $financial->amount_primary_income;?>"/></div>
</section>

<section>
<label for="vehicle_body_type">Amount of Any Secondary Income</label>
<div><input  type="text" class="car_brand" disabled='disabled' name="amount_secondary_income" id="amount_secondary_income" value="<?php echo $financial->amount_secondary_income;?>"/></div>
</section>
<section>
<label for="vehicle_body_type">How Frequently They Get Secondary Income</label>
<div><input  type="text" class="car_brand" disabled='disabled' name="frequency_secondary_income" id="frequency_secondary_income" value="<?php echo $financial->frequency_secondary_income;?>"/></div>
</section>
<?php
/*	
<section>
<label for="vehicle_body_type">Buyer's Birthdate? (YYYY-MM-DD)</label>
<div><input  type="text" class="car_brand" disabled='disabled' name="birthdate" id="birthdate" value="<?php echo date("F j, Y",strtotime($financial->birthdate));?>"/></div>
</section>

<section>
<label for="vehicle_body_type">Buyer's Social Insurance Number</label>
<div><input  type="text" class="car_brand" disabled='disabled' name="sin" id="sin" value="<?php echo $financial->sin;?>"/></div>
</section>
*/
?>
<section>
<label for="vehicle_body_type">Buyer's Comments</label>
<div><textarea type="text" class="car_brand" disabled='disabled' name="customer_comments" id="customer_comments"/><?php echo $financial->customer_comments;?></textarea></div>
</section>
               



























      
<input type="hidden" disabled='disabled' name="action" value="saveDetails" />
              <input type="hidden" disabled='disabled' name="memberID" value="<?php echo $cars['member_id'];?>"/> 
            <?php  if(!$quoteFlag){?>
              <input type="hidden" disabled='disabled' name="vehicle_id" value="<?php echo $vehicle_id;?>"/>
              <?php }else{?>
                <input type="hidden" disabled='disabled' name="id" value="<?php echo $cars['id'];?>"/>
           <?php   } ?>
           <input type="hidden" disabled='disabled' name="request" value="<?php echo  $vehicle_id;?>"/>
<section>
<?php
/*
	<label for="submit"></label>
		<div><button class="submit" disabled='disabled' name="manage_service_button" value="submit">Submit</button></div>
</section>   
*/
?>           
                     </form>            

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
        
        $('input').prop('disabled', true); 
		</script> 