<?php 

require("../includes/lib/common.php");

require("../includes/lib/classes/a/users.php"); 

require("../includes/lib/classes/a/dealers.php"); 

require("../includes/lib/functions/submenuBuilder.php");


$users      = new users();   $users->require_logged_in("index.php");

$dealers    = new dealers();



use \PhpPot\Service\StripePayment;
require_once "../stripe-php/StripeConfig.php";
require_once "../stripe-php/StripePayment.php";


$user_id    = $request->getvalue('request');

$action     = $request->postvalue('action');



if($_SESSION['mode']=="dealer" OR $_SESSION['mode']=="broker"){

      if($user_id <>$_SESSION['user_id'] ){

        header("Location: https://carleado.com/admin/dashboard.php");

        die;

    }

}


if($user_id>0)	$dealers->load($user_id);


$successMessage = "";

if (!empty($_POST["token"])) {
  	
	$stripePayment 	= new StripePayment();
	
	
	try { 

	
			
	if($dealers->stripe_custID == "")	{
		
		
		$customer = \Stripe\Customer::create([
			  'name' => $dealers->first_name." ".$dealers->last_name,
			  'email' => $dealers->email,
			  //'payment_method' => $dealers->stripe_pmID
		]);
	
		
		$dealers->stripe_custID = $customer->id;
		
		$dealers->save();	
	}
	
	
		
		
	$card = array(
			'object' => 'card',
			'number' => $request->postvalue('card-number'),
			'exp_month' => $request->postvalue('month'),
			'exp_year' => $request->postvalue('year'),
			'cvc' => $request->postvalue('cvc'),
			'currency' => 'cad',
			'name'=> $request->postvalue('name')
	);
/*
	 $result = 	\Stripe\Customer::createSource(
		  $dealers->stripe_custID,
		  [
			'source' => 'tok_ca',
			
		  ]
	);	
*/		
	if($result->id !="") {
		
		$dealers->stripe_status = 'active';
		$dealers->stripe_pmID  = $result->id;
		$dealers->stripe_date = date("Y-m-d H:i:s");
		
		$dealers->save();
	}	
		
		
		//die();
		
	$successMessage = "Yes";
		
  
	} catch (Exception $e) {
		
		$error = $e->getMessage();
	}
	
	//die();
		
}

?>


<!doctype html>

<html lang="en-us">

<head>

	<meta charset="utf-8">

	<title><?PHP echo SITE_TITLE;?> - Dealer Billing</title>

	<meta name="description" content="">

	

	<!-- Google Font and style definitions -->

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">

	<link rel="stylesheet" href="css/style.css">

    <?php require("includes/main.php");?>

	

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

                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_dealers.php">Billing Info</a></li>

						</ul>

						

					</div>

				</div>

		<div class="g12 nodrop">

        

                <?php

	if($session->get('mode')=='dealer'){

	   

	   $pageTitle="<h1>Dealer Billing Info</h1>";
       
       if($_GET['message']){?>
        
        <div style="margin:0 auto; padding: 20px; width:80vw; text-align:center; background-color: #FFFF00; color: #000; font-size: 18px; font-weight: bold;border-radius: 10px; "><?php echo nl2br($_GET['message']); ?></div>
        
<?php }


       echo $pageTitle;


       }else{

?>
 	<h1>Attach Credit Card</h1>

    
            <?php } ?> 

			<p></p>

		</div>
        
      	<div class="g12">
        
        
         <?php if($successMessage == "Yes") { ?>
		<div class="alert success ">Thank you - Your Credit card has been attached to your account</div>
		<?php  } ?>

		<?php if($successMessage == "No") { ?>
			<div class="alert warning ">Sorry - Your Card couldn't be processed.</div>
		<?php } ?>

		<?php if(!empty($error)) { ?>
			<div  class="alert warning "><?php echo $error;?></div>
		<?php } ?>
		
		<form id="frmStripePayment"  action="" method="post" autocomplete="off" enctype="multipart/form-data" <?php if($successMessage!="") { ?> style="display: none"; <?PHP } ?>>

		

			<input type="hidden" id="action" name="action" value="save">
			
			<div id="error-message" style="display: none; color:#FF0004" class="alert"></div>

		

					<fieldset>

				
                        <section><label for="name">Card Holder Name<br> <span id="card-holder-name-info"
								class="info"></span></label>

							<div><input type="text" id="name" name="name" value="" required>

							</div>

						</section>
                        
                        <section><label for="card-number">Card Number<br> <span id="card-number-info"
								class="info"></span></label>

							<div><input type="text" id="card-number" name="card-number" value="" required>

							</div>

						</section>

                        

                        <section><label for="month">Expiry Month<br><span id="userEmail-info"
									class="info"></span></label>

							<div>
														
								<select  name="month" class="form-control-select" id="month" required>

									<option value="">Month *</option>
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>


								</select>

							</div>

						</section>
						
						
						<section><label for="year">Expiry  Year<br><span id="userEmail-info"
									class="info"></span></label>

							<div>
														
								<select  name="year" class="form-control-select" id="year" required >

									<option value="">Year *</option>
									<option value="20">2020</option>
									<option value="21">2021</option>
									<option value="22">2022</option>
									<option value="23">2023</option>
									<option value="24">2024</option>
									<option value="25">2025</option>
									<option value="26">2026</option>
									<option value="27">2027</option>
									<option value="28">2028</option>
									<option value="29">2029</option>
									<option value="30">2030</option>


								</select>

							</div>

						</section>
						
						
						
						 <section><label for="cvc">CVC<br> <span id="cvv-info"
								class="info"></span></label>

							<div><input type="text" id="cvc" name="cvc" value="" required>

							</div>

						</section>


                        <section>

							<div>

                                    <button class="reset">Reset</button>

                                    <button class="submit" name="manage_service_button" value="manage_service_button" id="submit-btn" onClick="stripePay(event);">Process</button>
                                    
                                    <div id="loader" style="display: none;">
										<img alt="loader" src="../images/loading.gif" >
									</div>
                            
                            		<input type='hidden' name='amount' value='5.00'> 
                            		<input type='hidden' name='currency_code' value='CAD'> 
                            		<input type='hidden' name='item_name' value='DealerPAYMENT'> 
                            		

                            </div>

						</section>

                     </fieldset>

          </form>
	
		</div>

		              

			</section>

		<?php include("footer.php");?>

					<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
				    
					<script>
					function cardValidation () {
						var valid = true;
						var name = $('#name').val();
						//var email = $('#email').val();
						var cardNumber = $('#card-number').val();
						var month = $('#month').val();
						var year = $('#year').val();
						var cvc = $('#cvc').val();

						$("#error-message").html("").hide();

						if (name.trim() == "") {
							valid = false;
						}
						/*if (email.trim() == "") {
							   valid = false;
						} */
						if (cardNumber.trim() == "") {
							   valid = false;
						}

						if (month.trim() == "") {
								valid = false;
						}
						if (year.trim() == "") {
							valid = false;
						}
						if (cvc.trim() == "") {
							valid = false;
						}

						if(valid == false) {
							$("#error-message").html("All Fields are required").show();
						}

						return valid;
					}
					//set your publishable key
					Stripe.setPublishableKey("<?php echo STRIPE_PUBLISHABLE_KEY; ?>");

					//callback to handle the response from stripe
					function stripeResponseHandler(status, response) {
						if (response.error) {
							//enable the submit button
							$("#submit-btn").show();
							$( "#loader" ).css("display", "none");
							//display the errors on the form
							$("#error-message").html(response.error.message).show();
						} else {
							//get token id
							var token = response['id'];
							//insert the token into the form
							$("#frmStripePayment").append("<input type='hidden' name='token' value='" + token + "' />");
							//submit form to the server
							$("#frmStripePayment").submit();
						}
					}
					function stripePay(e) { 
						e.preventDefault();
						var valid = cardValidation();

						if(valid == true) {
							$("#submit-btn").hide();
							$( "#loader" ).css("display", "inline-block");
							Stripe.createToken({
								number: $('#card-number').val(),
								cvc: $('#cvc').val(),
								exp_month: $('#month').val(),
								exp_year: $('#year').val()
							}, stripeResponseHandler);

							//submit from callback
							return false;
						}
					}
						
						
						</script>
						
						
		<script>
			
				$(document).ready(function(){
					$("#error-message").hide();
				});
	
		</script>
						
						
						
	

</body>

</html>