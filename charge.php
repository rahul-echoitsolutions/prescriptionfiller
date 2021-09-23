<?php 

use \PhpPot\Service\StripePayment;
require_once "stripe-php/StripeConfig.php";
require_once "stripe-php/StripePayment.php";


$head.="
<title>".SITE_TITLE."</title>
<meta name=\"description\" content=\"".SITE_DESCRIPTION."\" />
<meta name=\"robots\" content=\"index,follow\" />
<meta name=\"googlebot\" content=\"index,follow\" />
<meta content=\"General\" name=\"Rating\" />
<meta name=\"language\" content=\"English\" />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.2/bootstrap-slider.min.js'>
<style>
form input{
    border:thin solid #ccc;
    border-radius:5px;
    padding:2px 10px 2px 15px !important;
    }
form  select{
    border:thin solid #ccc;
    border-radius:5px;
    padding:5px 5px 5px 5px !important;
	min-width:80px;
    }
form select option span{
    font-size:50%;
    }
label{
    font-weight:800;
    font-size:11px;
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
<style>
/* monthly payment radio boxes */
@import url(\"https://fonts.googleapis.com/css?family=Dax:400,900\");
.middle {
  width: 100%;
  /*text-align: center;*/
}
.middle h1 {
  font-family: \"xxDax\", sans-serif;
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
  font-family: \"xxDax\", sans-serif;
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
  font-size: 1.5em;
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
}
/* This is for the credit rating radio boxes*/
@import url(\"https://fonts.googleapis.com/css?family=Dax:400,900\");
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
  width: 160px;
  height: 60px;
  background-color: #fff;
  transition: all 250ms ease;
  will-change: transition;
  display: inline-block;
  text-align: center;
  cursor: pointer;
  position: relative;
  font-family: \"Dax\", sans-serif;
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
  font-size: 1.2em;
  user-select: none;
  color: #00A1E8;
}
.middle2 .box2 span:before {
  font-size: 1.2em;
  font-family: FontAwesome;
  display: block;
  transform: translateY(-80px);
  opacity: 0;
  transition: all 300ms ease-in-out;
  font-weight: normal;
  color: white;
}
</style>
";


include("includes/head.php");
include("includes/header.php");
require("includes/lib/classes/a/applications.php"); 
require("includes/lib/classes/a/members.php"); 
require("includes/lib/classes/a/broker_quotes.php");
require("includes/lib/classes/a/transactions.php");

enableErrors();

$apps 			= new applications(); 
$memb 			= new members();
$financial 		= new financial();
$transactions	= new transactions();

//$_SESSION['memberID'] = 181;
$memberID	= ($_SESSION['memberID']);

/*$memb->checkLogin($_SESSION['memberID']);

$memb->load($memberID);
*/
$successMessage = "";

if (!empty($_POST["token"])) {
  	
	$stripePayment 	= new StripePayment();
	
	try { 
    $stripeResponse = $stripePayment->chargeAmountFromCard($_POST);
	
	
	$amount 		= $stripeResponse["amount"] /100;
	
	$status 		= $stripeResponse["status"];
	
	$jsonResponse	= json_encode($stripeResponse);
	
	
	$transactions->amount 				= $amount;
	$transactions->jsonResponse 		= $jsonResponse;
	$transactions->dealer_id			= $memberID;
	$transactions->stripeStatusCode 	= $stripeResponse['status'];
	$transactions->stripeTransactionID 	= $stripeResponse['balance_transaction'];
	$transactions->created				= date("Y-m-d H:i:s");
		

	$successMessage = "";
	
	
	if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {
		
	   $transactions->status = "success";
       $successMessage = "Yes";
		
    } else {
		
		$successMessage = "No";
		$transactions->status = "failed";
	}
	
	$transactions->save();
	
	
		
	} catch (Exception $e) {
		
		$error = $e->getMessage();
	}
	
	//die();
		
}

?>
   
   <style>

	   .form-wrapper input[type=text]{
		  display: block;
		  padding: 10px;
		  margin: 0px auto;
		  background-color: #f1f1f1;
		  border: none;
		  width: 100%;
		  outline: none;
		  font-size: 14px !important;
		  font-family: 'Open Sans', sans-serif !important;
		  line-height: 30px;
		}
	   
	   select{
			font-size:18px !important;
			font-weight:300;
			padding:10px;
		}
	   
	   input[type=submit] {
		  background-color: #3498db;
		  display: inline-block;
		  padding: 8px 30px;
		  color: #fff;
		  cursor: pointer;
		  font-size: 14px !important;
		  font-family: 'Open Sans', sans-serif !important;
		  /*position: absolute;
		  right: 20px;
		  bottom: 20px;*/
		  margin-top:20px;
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

<div class="clear"></div>
    <div id="content" style="min-height:800px; ">
      <div class="container" style="background-color:rgba(255,255,255,0.8); ">
          <div class="row">
            <div class="col-md-12">
               <!-- Toggle -->
            <div class="panel-group" style="padding-top:60px">

        <div class="row">
        			<div class="col-md-12" style="max-width: 500px !important;" >	
       
                    <h2>Make PAYMENT VIA Stripe </h2>
                    
                    <?php if($successMessage == "Yes") { ?>
					<div id="success-message">Thank you - Your payment was successful</div>
					<?php  } ?>
					
					<?php if($successMessage == "No") { ?>
						<div id="error-message" style="color: red;">Sorry - Your payment failed</div>
					<?php } ?>
					
					<?php if(!empty($error)) { ?>
						<div id="error-message" style="color: red;"><?php echo $error;?></div>
					<?php } ?>
					
					<div id="error-message" style="color: red;"></div>

					<form id="frmStripePayment" action=""  class="form-wrapper method="post" <?php if($successMessage!="") { ?> style="display: none"; <?PHP } ?>>
						<div class="field-row">
							<label>Card Holder Name</label> <span id="card-holder-name-info"
								class="info"></span><br> <input type="text" id="name"
								name="name" class="demoInputBox">
						</div>
						<!--<div class="field-row" >
							<label>Email</label> <span id="email-info" class="info"></span><br>
							<input type="text" id="email" name="email" class="demoInputBox">
						</div> -->
						<div class="field-row">
							<label>Card Number</label> <span id="card-number-info"
								class="info"></span><br> <input type="text" id="card-number"
								name="card-number" class="demoInputBox">
						</div>
						<div class="field-row">
							<div class="contact-row column-right">
								<label>Expiry Month / Year</label> <span id="userEmail-info"
									class="info"></span><br> <select name="month" id="month"
									class="demoSelectBox">
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
								</select> <select name="year" id="year"
									class="demoSelectBox">
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
							<div class="contact-row cvv-box">
								<label>CVC</label> <span id="cvv-info" class="info"></span><br>
								<input type="text" name="cvc" id="cvc"
									class="demoInputBox cvv-input">
							</div>
						</div>
						<div>
							<input type="submit" name="pay_now" value="Process Payment"
								id="submit-btn" class="btnAction"
								onClick="stripePay(event);">

							<div id="loader" style="display: none;">
								<img alt="loader" src="images/loading.gif" >
							</div>
						</div>
						<input type='hidden' name='amount' value='5.00'> <input type='hidden'
							name='currency_code' value='CAD'> <input type='hidden'
							name='item_name' value='DealerPAYMENT'> <input type='hidden'
							name='item_number' value='DealerPAYMENT<?php echo $memberID;?>'>
					</form>
                   
                   
                   
                    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
				    <script src="vendor/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
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
							$("#loader").css("display", "none");
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
                    
                 	</div>

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
        

	include("includes/footer.php");
?>