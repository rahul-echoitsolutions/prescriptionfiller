<?php
$head.="
<title>Title Loans, Mortgages, Equipment Financing, Car Loans |Edmonton Alberta </title>

<meta name=\"description\" content=\"Great rates in Edmonton and Alberta. Yes Plan good and bad credit mortgages, vehicle title loans, business loans, equipment financing, good and bad credit car loans, leasing, factoring\"/>                                                                                                                                            

<meta name=\"robots\" content=\"index,follow\" />
<meta name=\"googlebot\" content=\"index,follow\" /> 
<meta content=\"General\" name=\"Rating\" />
<meta name=\"language\" content=\"English\" />";





	include("includes/head.php");
    include("includes/header.php");
?>


<link rel="stylesheet" href="<?php echo HTTP_HOME_URL;?>css/main.css">


<script type="text/javascript">
$(document).ready(function() { 
$('.submit-bttn'+3).click(function(e){
$('.submit-bttn'+3).css({'visibility':'hidden'});
		$('.wait-contactform-contact'+3).css({'visibility':'visible'});
		// Declare the function variables:
		// Parent form, form URL, email regex and the error HTML
		
		var $formId = $(this).parents('form');
		var formAction = $formId.attr('action');
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var phoneReg = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
		var $error = $('<span class="error"></span>');
		

		// Prepare the form for validation - remove previous errors
		//$('li',$formId).removeClass('error');
		$('span.error').remove();
        $('.input-holder').removeClass('error');
		  $('#msg3').hide(); 
        $('#msg3').removeClass('newerror');
		$("#msg3").html("");
		

		// Validate all inputs with the class "required"
		//$('.required',$formId).each(function(){
		$($formId).find('input, select, textarea').each(function(){
			
			var inputVal = $.trim($(this).val());
			var $parentTag = $(this).parent();
			
			var class_name="";
			 class_name = $(this).attr('class');
			var fieldtitle = $(this).attr("title");
			
			if(typeof(class_name) != "undefined"){
				class_name=class_name.split(' ');
				class_name=class_name[0];
			}
			if(class_name=="required"){
				if(inputVal == ''){
					$parentTag.addClass('error').append($error.clone().text(fieldtitle));
					$(this).focus();
					$('.submit-bttn'+3).css({'visibility':'visible'});
					$('.wait-contactform-contact'+3).css({'visibility':'hidden'});
					return false;
				}
				
			}
			
			if($(this).attr('type')=="email"){
				if(!emailReg.test(inputVal)){
					$parentTag.addClass('error').append($error.clone().text('Sorry, you have entered an invalid Email Address.'));
					$(this).focus();
					$('.submit-bttn'+3).css({'visibility':'visible'});
					$('.wait-contactform-contact'+3).css({'visibility':'hidden'});
					return false;
				}
			}
			
			if($(this).val()!=""){
				if($(this).attr('type')=="tel"){
					if(!phoneReg.test(inputVal)){
						$parentTag.addClass('error').append($error.clone().text('Phone number seems invalid.'));
						$(this).focus();
					$('.submit-bttn'+3).css({'visibility':'visible'});
					$('.wait-contactform-contact'+3).css({'visibility':'hidden'});
					return false;
					}
				}
			}
		});
		

		
		
		// All validation complete - Check if any errors exist
		// If has errors
		if ($('span.error').length > 0) {
			
			$('span.error').each(function(){
				
				// Set the distance for the error animation
				var distance = 5;
				
				// Get the error dimensions
				var width = $(this).outerWidth();
				
				// Calculate starting position
				var start = width + distance;
				
				// Set the initial CSS
				$(this).show().css({
					display: 'block',
					opacity: 0
				})
				// Animate the error message
				.animate({
					opacity: 1
				}, 'slow');
				
			});

		}else {
			//$formId.submit();
			//alert("success form going to be submit.");
			validateCaptchaContact(3, $('#captcha_hid_contact_3').val());
			
		}
		// Prevent form submission
			e.preventDefault();
	});
	
	// Fade out error message when input field gains focus
	$('.required').keypress(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	}); 
	
	
		$('.required').change(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	}); 
	
	$('.captcha-image-contact').focus(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	}); 

	jQuery('#captcha_div_contact_3').on('click','a.captcha-image-contact',function(){
			var $parent = $(this).parent();
			$parent.removeClass('error');
			$('span.error',$parent).fadeOut();
	});
	
	
	
});

</script>

<div class="section inner-page">
	<div class="container">
		
		<div class="row">
			<div class="col-md-12 form-container">
			
				<div class="video-section" id="rateChart">
				  <div class="chart_inner_sec">
					<div class="chart-box">
						<div class="card3" id="outside2">
							<div class="photo"></div>
							<div class="head36">Mortgage Rates</div>
							<p>THIS WEEK</p>
							<div class="chart">
								<div class="bar bar1"><span>Royal Bank</span></div>
								<div class="bar bar2"><span>CIBC</span></div>
								<div class="bar bar3"><span>TD Bank</span></div>
								<div class="bar bar4"><span>&nbsp;&nbsp;&nbsp;Montreal</span></div>
								<div class="bar bar5"><span>Nova Scotia</span></div>
								<div class="bar bar6"><span>&nbsp;&nbsp;&nbsp;HSBC</span></div>
								<div class="bar bar7"><span>&nbsp;&nbsp;&nbsp;Tangerine</span></div>
							</div>
							<div class="head36">May 3, 2017</div><p>Click for Details</p>
						</div>
					</div>

					<div class="video-heading">
						<div class="background">									
							<div class="card" id="outside">
								<div class="photo" style="background-image: url(images/rateChart-car.jpg) !important;"></div>
								<div class="head36">Car Loans Rates</div>
								<p>THIS WEEK</p>
								<div class="chart">
									<div class="bar bar1"><span>Royal Bank</span></div>
									<div class="bar bar2"><span>CIBC</span></div>
									<div class="bar bar3"><span>TD Bank</span></div>
									<div class="bar bar4"><span>&nbsp;&nbsp;&nbsp;Montreal</span></div>
									<div class="bar bar5"><span>Nova Scotia</span></div>
									<div class="bar bar6"><span>&nbsp;&nbsp;&nbsp;HSBC</span></div>
									<div class="bar bar7"><span>&nbsp;&nbsp;&nbsp;Tangerine</span></div>
								</div>
								<div class="head36">May 3, 2017</div><p>Click for Details</p>
							</div>									
						</div>
					</div>
				  </div>
				</div>
				
				<div class="section content_sec">
					<h2>Mortgages - Car Loans - Title Loans</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce mollis nisi sem, in volutpat erat euismod at. Etiam scelerisque enim ac ex dictum, in cursus urna imperdiet. Praesent facilisis mi eros, sit amet ornare ante euismod id. Vestibulum est leo, rhoncus vel lacinia sollicitudin, tincidunt sed mauris. Morbi eget erat ut erat laoreet faucibus vitae et dolor. Nullam vitae blandit mauris. Duis sagittis purus eu sagittis maximus. Fusce et neque laoreet ligula dignissim rutrum. Maecenas pulvinar sapien a sagittis ultrices. Cras eget suscipit tellus. Ut vitae augue sollicitudin, bibendum arcu id, pulvinar ex. Quisque orci magna, tincidunt in molestie sed, rutrum id urna. Nullam facilisis orci a urna posuere ultricies. Ut a rhoncus magna. Aenean laoreet nibh et luctus accumsan. Vivamus molestie a eros sit amet mollis.</p>
				</div>
				
				<div class="section form_tabs_sec">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#mortgages">Mortgages</a></li>
						<li><a data-toggle="tab" href="#car-loans">Car Loans</a></li>
						<li><a data-toggle="tab" href="#title-loans">Title Loans</a></li>
					</ul>

					<div class="tab-content">
						<div id="mortgages" class="tab-pane fade in active">
						<div class="pl_cwrap cf slideInLeft" data-wow-duration="3s" data-wow-delay="1s">

							<div class="plct">Just Three Easy Steps</div>

							<form name="mortgage_form" id="mortgage_form" method="post" action="<?php echo HTTP_HOME_URL;?>mails/mail.php">
								<div class="plb01 cf">
								  <div class="pl_step">Step <span>1</span></div>
								  <section class="li-box">

									<ul>
										<li>Type of Loan</li>
										<li>
											<label class="pl_check">
												<input type="radio" name="loan" value="Purchase" checked>
												<span>Purchase</span>
											</label>
										</li>
										<li>
											<label class="pl_check">
												<input type="radio" name="loan" value="Refinance">					
												<span>Refinance</span>
											</label>
										</li>
									</ul>                                      

									<ul>
										<li>Mortgage Request</li>
										<li>
											<label class="pl_check">
												<input type="radio" class="mortgage_select" name="mortgage" value="fmortgage" checked>
												<span>1st Mortgage</span>
											</label>
										</li>
										<li>
											<label class="pl_check">
												<input type="radio"  class="mortgage_select"  name="mortgage" value="smortgage">
												<span>2nd Mortgage</span>
											</label>
										</li>
									</ul>
								  </section>
								</div>

								<div class="plb02 cf">
								  <div class="pl_step"> Step <span>2</span> </div>
								  <section>
									<ul>
										<li>Property Value</li>
										<li>
											<div id="slider1"></div>
											<div class="pl_val">$ 50,000</div>
										</li>
										<li>
											<input id="propVal" name="propVal" type="text" class="keyupclass">
										</li>
									</ul>

									<ul id="current_mortgage" style="display:none">
										<li>Current Mortgage</li>
										<li>
											<div id="slider3"></div>
											<div class="pl_val">$ 50,000</div>
										</li>
										<li>
											<input id="curmortAmt" name="curmortAmt" type="text" class="keyupclass">
										</li>
									</ul>   

									<ul>
										<li>Mortgage Request</li>
										<li>
											<div id="slider2"></div>
											<div class="pl_val">$ 50,000</div>
										</li>
										<li>
											<input id="mortAmt" name="mortAmt" type="text" class="keyupclass">
										</li>
									</ul>
								  </section>
								</div>

								<div class="plb03 cf">
								  <div class="pl_step">Step <span>3</span></div>
								  <section>
									<ul>
										<li>
										  <div class="input-holder">
											<input name="mfname" id="mfname" type="text" placeholder="First Name*" title="First Name" class="form-control required">
										  </div>	
										</li>
										<li>
										  <div class="input-holder">
											<input name="mlname" id="mlname" type="text" placeholder="Last Name*" title="Last Name" class="form-control required">
										  </div>	
										</li>
										<li>
										  <div class="input-holder">
											<input type="tel" name="mphone" id="mphone" placeholder="Phone*" title="Phone" class="tel form-control required">
										  </div>	
										</li>
										<li>
										  <div class="input-holder">
											<input type="email" placeholder="Email*" name="memail" id="memail" title="Email" class="email form-control required">
										  </div>	
										</li>
										<li>
										  <div class="swrap">
											<div class="input-holder">
												<select class="form-control required" name="mprovince" title="Province" id="mprovince">
													<option value="">Province*</option>
													<option value="British Columbia">British Columbia</option>
													<option value="Ontario">Ontario</option>
												</select>
											</div>	
										  </div>
										</li>
										<li>
										  <div class="swrap">
											<div class="input-holder">
											  <select class="form-control required" name="mcity" title="City" id="mcity">
												<option value="">City*</option>
												<!--<option value="Toronto">Toronto</option>
												<option value="GTA">GTA</option>
												<option value="Windsor">Windsor</option>
												<option value="Woodbridge">Woodbridge</option>-->
											  </select>
											</div>
										  </div>
										</li>
									</ul>
								  </section>
								</div>
							
								<div class="plb04">
									<div class="text-box">
										<span>Your Estimated Monthly Payment *</span>
										<input type="text" readonly name="mnthly_pymnt" id="mnthly_pymnt" value="$0">
									</div>
									<input type="submit" id="mortgage_submit" value="Approve Me!">
									<div class="plz"> 
										<div id="wait-mortgage" class="wait-mortgage" style="display:none;">
											<div class="pls-wait-img-contact"><img src="<?php echo HTTP_HOME_URL;?>img/wait.gif" align="left" border="0" class="loader-img" style="margin-right:5px; margin-left:5px;"/></div>
											<div  class="pls-wait-text-contact" >Please&nbsp;wait...</div>
										</div>
									</div>

									<br clear="all" />
									<!-- <span class="payment_style">(* Payments are estimates only)</span> -->
								</div>
							</form>
						</div>
						</div>
						
						<div id="car-loans" class="tab-pane fade">
						  <h2>Car Loans</h2>
						  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						</div>
						
						<div id="title-loans" class="tab-pane fade">
						  <h2>Title Loans</h2>
						  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
						</div>
						
						<div class="constant_content">						
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="image_wrapper">
										<img src="images/couple-getting-mortgage.jpg" alt=""/>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<h2>Get the money you need NOW</h2>
								</div>
								<div class="clearfix"></div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce mollis nisi sem, in volutpat erat euismod at. Etiam scelerisque enim ac ex dictum, in cursus urna imperdiet. Praesent facilisis mi eros, sit amet ornare ante euismod id. Vestibulum est leo, rhoncus vel lacinia sollicitudin, tincidunt sed mauris. Morbi eget erat ut erat laoreet faucibus vitae et dolor. Nullam vitae blandit mauris. Duis sagittis purus eu sagittis maximus. Fusce et neque laoreet ligula dignissim rutrum. Maecenas pulvinar sapien a sagittis ultrices. Cras eget suscipit tellus. Ut vitae augue sollicitudin, bibendum arcu id, pulvinar ex. Quisque orci magna, tincidunt in molestie sed, rutrum id urna. Nullam facilisis orci a urna posuere ultricies. Ut a rhoncus magna. Aenean laoreet nibh et luctus accumsan. Vivamus molestie a eros sit amet mollis.</p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce mollis nisi sem, in volutpat erat euismod at. Etiam scelerisque enim ac ex dictum, in cursus urna imperdiet. Praesent facilisis mi eros, sit amet ornare ante euismod id. Vestibulum est leo, rhoncus vel lacinia sollicitudin, tincidunt sed mauris. Morbi eget erat ut erat laoreet faucibus vitae et dolor. Nullam vitae blandit mauris. Duis sagittis purus eu sagittis maximus. Fusce et neque laoreet ligula dignissim rutrum. Maecenas pulvinar sapien a sagittis ultrices. Cras eget suscipit tellus. Ut vitae augue sollicitudin, bibendum arcu id, pulvinar ex. Quisque orci magna, tincidunt in molestie sed, rutrum id urna. Nullam facilisis orci a urna posuere ultricies. Ut a rhoncus magna. Aenean laoreet nibh et luctus accumsan. Vivamus molestie a eros sit amet mollis.</p>
								</div>
							</div>						
						</div>
						
					</div>

				</div>
				
			</div>
		</div>
		
	</div>	
</div>






<script type="text/javascript">
function trimChar(string, charToRemove) {
	while(string.charAt(0)==charToRemove) {
		string = string.substring(1);
	}
	while(string.charAt(string.length-1)==charToRemove) {
		string = string.substring(0,string.length-1);
	}
	return string;
}

$(document).ready(function(){

//alert("hai");

var p = parseInt($("#propVal").val().replace(/\D/g,''),10);

$("#propVal").val( "$" + p.toLocaleString());



var c = parseInt($("#curmortAmt").val().replace(/\D/g,''),10);

$("#curmortAmt").val( "$" + c.toLocaleString());



var m = parseInt($("#mortAmt").val().replace(/\D/g,''),10);

$("#mortAmt").val( "$" + m.toLocaleString());


///////////////// Mouse move/scroll Event starts here ////////////////////////

$(".ui-slider-handle").mouseup(function(){		



var propVal = trimChar($("#propVal").val(),"$");

var curmortAmt = trimChar($("#curmortAmt").val(),"$");

var mortAmt = trimChar($("#mortAmt").val(),"$");



propVal = propVal.replace(/,/g , "");

curmortAmt = curmortAmt.replace(/,/g , "");

mortAmt = mortAmt.replace(/,/g , "");


var mortgage_value = $("input[name=mortgage]:checked").val();

if(mortgage_value=='fmortgage'){			

var ltv = Math.round((mortAmt/propVal)*100);

if(ltv<=65){				

var mnth_pymnt = (mortAmt*(4.99/100))/12;					

}else if(ltv>=66 && ltv<=80){				

var mnth_pymnt = (mortAmt*(5.99/100))/12;					

}else if(ltv>=81 && ltv<=85){				

var mnth_pymnt = (mortAmt*(6.99/100))/12;					

}else{

var mnth_pymnt = 0;

//alert('The selected values are not valid.');

}

}else if(mortgage_value=='smortgage'){

var ltv = Math.round(((+mortAmt + +curmortAmt)*100)/propVal);				

if(ltv<=65){				

var mnth_pymnt = (mortAmt*(7.99/100))/12;					

}else if(ltv>=66 && ltv<=75){				

var mnth_pymnt = (mortAmt*(9.99/100))/12;					

}else if(ltv>=76 && ltv<=85){				

var mnth_pymnt = (mortAmt*(10.99/100))/12;					

}else{

var mnth_pymnt = 0;

//alert('The selected values are not valid.');

}

}

mnth_pymnt = '$' + Math.round(mnth_pymnt * 100) / 100;

$("#mnthly_pymnt").val(mnth_pymnt);



//var n = parseInt($("#mnthly_pymnt").val().replace(/\D/g,''),10);

//$("#mnthly_pymnt").val( "$" + n.toLocaleString());

});

///////////////// Mouse move/scroll Event ends here ////////////////////////



///////////////// Key up Event starts here ////////////////////////

$(".keyupclass").keyup(function(){	

var p = parseInt($("#propVal").val().replace(/\D/g,''),10);

$("#propVal").val( "$" + p.toLocaleString());

if(($("#propVal").val())=='$NaN'){

$("#propVal").val( "$"+"0" );

}



var c = parseInt($("#curmortAmt").val().replace(/\D/g,''),10);

$("#curmortAmt").val( "$" + c.toLocaleString());

if(($("#curmortAmt").val())=='$NaN'){

$("#curmortAmt").val( "$"+"0" );

}



var m = parseInt($("#mortAmt").val().replace(/\D/g,''),10);

$("#mortAmt").val( "$" + m.toLocaleString());

if(($("#mortAmt").val())=='$NaN'){

$("#mortAmt").val( "$"+"0" );

}

var propVal = trimChar($("#propVal").val(),"$");

var curmortAmt = trimChar($("#curmortAmt").val(),"$");

var mortAmt = trimChar($("#mortAmt").val(),"$");

var mortgage_value = $("input[name=mortgage]:checked").val();

propVal = propVal.replace(/,/g , "");

curmortAmt = curmortAmt.replace(/,/g , "");

mortAmt = mortAmt.replace(/,/g , "");


if(mortgage_value=='fmortgage'){			

var ltv = Math.round((mortAmt/propVal)*100);

if(ltv<=65){				

var mnth_pymnt = (mortAmt*(4.99/100))/12;					

}else if(ltv>=66 && ltv<=80){				

var mnth_pymnt = (mortAmt*(5.99/100))/12;					

}else if(ltv>=81 && ltv<=85){				

var mnth_pymnt = (mortAmt*(6.99/100))/12;					

}else{

var mnth_pymnt = 0;

//alert('The selected values are not valid.');

}

}else if(mortgage_value=='smortgage'){

var ltv = Math.round(((+mortAmt + +curmortAmt)*100)/propVal);				

if(ltv<=65){				

var mnth_pymnt = (mortAmt*(7.99/100))/12;					

}else if(ltv>=66 && ltv<=75){				

var mnth_pymnt = (mortAmt*(9.99/100))/12;					

}else if(ltv>=76 && ltv<=85){				

var mnth_pymnt = (mortAmt*(10.99/100))/12;					

}else{

var mnth_pymnt = 0;

//alert('The selected values are not valid.');

}

}

mnth_pymnt = '$' + Math.round(mnth_pymnt * 100) / 100;

$("#mnthly_pymnt").val(mnth_pymnt);

//var n = parseInt($("#mnthly_pymnt").val().replace(/\D/g,''),10);

//$("#mnthly_pymnt").val( "$" + n.toLocaleString());

});

///////////////// Key up Event ends here ////////////////////////


///////////////// Arrow keys Press Event starts here ////////////////////////

$(document).keydown(function(e){

if (e.keyCode > 36 && e.keyCode < 41){ 

var propVal = trimChar($("#propVal").val(),"$");

var curmortAmt = trimChar($("#curmortAmt").val(),"$");

var mortAmt = trimChar($("#mortAmt").val(),"$");

var mortgage_value = $("input[name=mortgage]:checked").val();

propVal = propVal.replace(/,/g , "");

curmortAmt = curmortAmt.replace(/,/g , "");

mortAmt = mortAmt.replace(/,/g , "");



if(mortgage_value=='fmortgage'){			

var ltv = Math.round((mortAmt/propVal)*100);

if(ltv<=65){				

var mnth_pymnt = (mortAmt*(4.99/100))/12;					

}else if(ltv>=66 && ltv<=80){				

var mnth_pymnt = (mortAmt*(5.99/100))/12;					

}else if(ltv>=81 && ltv<=85){				

var mnth_pymnt = (mortAmt*(6.99/100))/12;					

}else{

var mnth_pymnt = 0;

//alert('The selected values are not valid.');

}

}else if(mortgage_value=='smortgage'){

var ltv = Math.round(((+mortAmt + +curmortAmt)*100)/propVal);				

if(ltv<=65){				

var mnth_pymnt = (mortAmt*(7.99/100))/12;					

}else if(ltv>=66 && ltv<=75){				

var mnth_pymnt = (mortAmt*(9.99/100))/12;					

}else if(ltv>=76 && ltv<=85){				

var mnth_pymnt = (mortAmt*(10.99/100))/12;					

}else{

var mnth_pymnt = 0;

//alert('The selected values are not valid.');

}

}

mnth_pymnt = '$' + Math.round(mnth_pymnt * 100) / 100;

$("#mnthly_pymnt").val(mnth_pymnt);

//	var n = parseInt($("#mnthly_pymnt").val().replace(/\D/g,''),10);

//	$("#mnthly_pymnt").val( "$" + n.toLocaleString());

}

});

///////////////// Arrow keys Press Event ends here ////////////////////////

///////////////// Mortgage Selects Event starts here ////////////////////////

$(".mortgage_select").click(function(){

var propVal = trimChar($("#propVal").val(),"$");

var curmortAmt = trimChar($("#curmortAmt").val(),"$");

var mortAmt = trimChar($("#mortAmt").val(),"$");

var mortgage_value = $("input[name=mortgage]:checked").val();

propVal = propVal.replace(/,/g , "");

curmortAmt = curmortAmt.replace(/,/g , "");

mortAmt = mortAmt.replace(/,/g , "");

if(mortgage_value=='fmortgage'){	

$('#current_mortgage').hide();

var ltv = Math.round((mortAmt/propVal)*100);

if(ltv<=65){				

var mnth_pymnt = (mortAmt*(4.99/100))/12;					

}else if(ltv>=66 && ltv<=80){				

var mnth_pymnt = (mortAmt*(5.99/100))/12;					

}else if(ltv>=81 && ltv<=85){				

var mnth_pymnt = (mortAmt*(6.99/100))/12;					

}else{

var mnth_pymnt = 0;

//alert('Mortgage Amount not greater than Property Value');

//alert('The selected values are not valid.');
}

}else if(mortgage_value=='smortgage'){
	$('#current_mortgage').show();
	var ltv = Math.round(((+mortAmt + +curmortAmt)*100)/propVal);				

	if(ltv<=65){
	var mnth_pymnt = (mortAmt*(7.99/100))/12;
	}else if(ltv>=66 && ltv<=75){	
	var mnth_pymnt = (mortAmt*(9.99/100))/12;	
	}else if(ltv>=76 && ltv<=85){				
	var mnth_pymnt = (mortAmt*(10.99/100))/12;	
	}else{
	var mnth_pymnt = 0;
	//alert('The selected values are not valid.');
	}
}

mnth_pymnt = '$' + Math.round(mnth_pymnt * 100) / 100;

$("#mnthly_pymnt").val(mnth_pymnt);

//	var n = parseInt($("#mnthly_pymnt").val().replace(/\D/g,''),10);

//	$("#mnthly_pymnt").val( "$" + n.toLocaleString());

});
///////////////// Mortgage Selects Event ends here ////////////////////////

});
////////////////////////////////////FORM VALIDATION starts here////////////////////////////////////////////////////////

$(document).ready(function() {

//alert("hai1");

$('#mortgage_submit').click(function(e){

// alert("hi");

//###########################

var propVal = trimChar($("#propVal").val(),"$");

var curmortAmt = trimChar($("#curmortAmt").val(),"$");

var mortAmt = trimChar($("#mortAmt").val(),"$");

var mortgage_value = $("input[name=mortgage]:checked").val();



propVal = propVal.replace(/,/g , "");

curmortAmt = curmortAmt.replace(/,/g , "");

mortAmt = mortAmt.replace(/,/g , "");



if(mortgage_value=='fmortgage'){	

$('#current_mortgage').hide();

var ltv = Math.round((mortAmt/propVal)*100);

if(ltv<=65){				

var mnth_pymnt = (mortAmt*(4.99/100))/12;					

}else if(ltv>=66 && ltv<=80){				

var mnth_pymnt = (mortAmt*(5.99/100))/12;					

}else if(ltv>=81 && ltv<=85){				

var mnth_pymnt = (mortAmt*(6.99/100))/12;					

}else{

var mnth_pymnt = 0;

//alert('Mortgage Amount not greater than Property Value');

alert('The selected values are not valid.');

return false;





}

}else if(mortgage_value=='smortgage'){

$('#current_mortgage').show();

var ltv = Math.round(((+mortAmt + +curmortAmt)*100)/propVal);				

if(ltv<=65){				

var mnth_pymnt = (mortAmt*(7.99/100))/12;					

}else if(ltv>=66 && ltv<=75){				

var mnth_pymnt = (mortAmt*(9.99/100))/12;					

}else if(ltv>=76 && ltv<=85){				

var mnth_pymnt = (mortAmt*(10.99/100))/12;					

}else{

var mnth_pymnt = 0;

alert('The selected values are not valid.');

return false;

}



}

///#########################################			

$('#mortgage_submit').hide();

$('.wait-mortgage').show();



// Declare the function variables:

// Parent form, form URL, email regex and the error HTML

var $formId = $(this).parents('form');

var formAction = $formId.attr('action');

var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

var phoneReg = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;

var $error = $('<span class="error"></span>');



// Prepare the form for validation - remove previous errors

//$('li',$formId).removeClass('error');

$('span.error').remove();

$('.input-holder').removeClass('error');

$('#msghome7').hide();

$('#msghome7').removeClass('newerror');

$("#msghome7").html("");

// Validate all inputs with the class "required"

//alert("test");

$('.required',$formId).each(function(){

//alert("hi1");



var inputVal = $.trim($(this).val());

var fieldtitle = $(this).attr("title");

var fieldname=$(this).attr("name");

var $parentTag = $(this).parent();

if(inputVal == '' || inputVal=='-1'){

if(fieldname=="mprovince"){

$parentTag.addClass('error').append($error.clone().text('Please select your '+fieldtitle+'.'));

}else if(fieldname=="mcity"){

$parentTag.addClass('error').append($error.clone().text('Please select your '+fieldtitle+'.'));

}else{

$parentTag.addClass('error').append($error.clone().text('Please enter your '+fieldtitle+'.'));

}

$(this).focus();

$('#mortgage_submit').show();

$('.wait-mortgage').hide();
return false;

}
if($(this).hasClass('email') == true){

if(!emailReg.test(inputVal)){

$parentTag.addClass('error').append($error.clone().text('Sorry, you have entered an invalid Email Address.'));

$(this).focus();

$('#mortgage_submit').show();

$('.wait-mortgage').hide();

return false;

}

} 
if($(this).hasClass('tel') == true){

if(!phoneReg.test(inputVal)){

$parentTag.addClass('error').append($error.clone().text('Phone number seems invalid.'));

$(this).focus();

$('#mortgage_submit').show();

$('.wait-mortgage').hide();

return false;
}
} 
});
// All validation complete - Check if any errors exist
// If has errors
if ($('span.error').length > 0) {
$('span.error').each(function(){
// Set the distance for the error animation
var distance = 5;
// Get the error dimensions
var width = $(this).outerWidth();
// Calculate starting position
var start = width + distance;
// Set the initial CSS
$(this).show().css({

display: 'block',

opacity: 0

})

// Animate the error message

.animate({

opacity: 1

}, 'slow');



});
}else {

//$formId.submit();

document.mortgage_form.submit();

}

// Prevent form submission

e.preventDefault();

});
// Fade out error message when input field gains focus

	$('.required').keypress(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	});

	$("#mprovince").change(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	});

	$("#mcity").change(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	});

}); 
////////////////////////////////////FORM VALIDATION ends here////////////////////////////////////////////////////////

</script>




  
<script type="text/javascript" src="<?php echo HTTP_HOME_URL;?>js/index.js"></script>
<script src="<?php echo HTTP_HOME_URL;?>js/jquery.responsiveTabs.min.js"></script>
<script src="<?php echo HTTP_HOME_URL;?>js/jquery-ui.min.js"></script>
<script src="<?php echo HTTP_HOME_URL;?>js/slick.min.js"></script>
<script src="<?php echo HTTP_HOME_URL;?>js/wow.min.js"></script>
<script src="<?php echo HTTP_HOME_URL;?>js/main.js"></script>
<script src="js/app.js"></script>
<?php
	include("includes/footer.php");
?>