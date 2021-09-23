<?php
$head.="
<title>".SITE_TITLE."</title>
<meta name=\"description\" content=\"PrescriptionFiller.com is the easy way to fill your prescriptions.\" />
<meta name=\"robots\" content=\"index,follow\" />
<meta name=\"googlebot\" content=\"index,follow\" />
<meta content=\"General\" name=\"Rating\" />
<meta name=\"language\" content=\"English\" />
";

function isMobile() {
    return preg_match("/\b(?:a(?:ndroid|vantgo)|b(?:lackberry|olt|o?ost)|cricket|do‌​como|hiptop|i(?:emob‌​ile|p[ao]d|phone)|kitkat|m‌​(?:ini|obi)|palm|(?:‌​i|smart|windows )phone|symbian|up\.(?:browser|link)|tablet(?: browser| pc)|(?:hp-|rim |sony )tablet|w(?:ebos|indows ce|os))/i", $_SERVER["HTTP_USER_AGENT"]);
}
 $a=isMobile();


	include("includes/head.php");
    include("includes/header.php");
   ?> 
    <!-- Start Page Banner -->
    <div class="page-banner" style="border-bottom: 2px solid #f36525;">
      <div class="container">
           <div class="row">
          <div class="col-md-6">
            <h2>Application</h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="index.php">Home</a></li>
              <li>Application</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- End Page Banner -->

    		 <div class="content-part-top"  style="border-bottom: 2px solid #f36525;">
			 <div class="container">
				  <div class="row" style="position: relative;">
					  <div class="col-md-9 col-sm-12 col-xs-12">

	<div class="pl_cwrap cf slideInLeft" data-wow-duration="3s" data-wow-delay="1s">

<?php
/*
	<form name="mortgage_form"  id="mortgage_form" method="post" action="<?php echo HTTP_HOME_URL;?>mailer.php">
*/
?>
<form name="mortgage_form"  id="ajax-contact"  method="post" action="<?php echo HTTP_HOME_URL;?>mailer.php">
<div class="plb02 cf" data-toggle="collapse" data-target="#form-collapsep">
<?php
	/*
<div class="pl_step">
Step
<span>1</span>
</div>
*/
?>
<section class="step_form_top">
<div class="step_form_top_first">
<p>
Property Value
</p>
<ul>
<li>
<div id="slider1" style="display:<?php echo (!$a)?'':'none';?>"></div>
</li>
<li>
<input id="propVal" name="propVal" type="text" class="keyupclass">
</li>
</ul>
</div>
<div id="step_form_top_second">
<div id="current_mortgage" style="display:none" >
<p>Current Mortgage</p>
<ul>
<li>
<div id="slider3" style="display:<?php echo (!$a)?'':'none';?>"></div>

</li>
<li>
<input id="curmortAmt" name="curmortAmt" type="text" class="keyupclass">
</li>
</ul>
</div>
   </div>
<div class="step_form_top_end">
<p>
Mortgage Request
</p>
<ul>
<li>
<div id="slider2" style="display:<?php echo (!$a)?'':'none';?>"></div>

</li>
<li>
<input id="mortAmt" name="mortAmt" type="text" class="keyupclass">
</li>
</ul>
</div>

</section>
</div>
<div id="form-collapsepxxxx" class="collapsexxxx">
<div class="plb01 cf">
<div class="pl_step">
Step
<span>2</span>
</div>
<section class="li-box">
<ul>
<li>
Type of Loan
</li>
<li>
<label class="pl_check">
<input type="radio" name="loan" id="purchase" value="Purchase" <?php if($_GET['type']=="purchase"){echo "checked";}?> />
<span>Purchase</span>
</label>
</li>
<li>
<label class="pl_check">
<input type="radio" name="loan" id="refinance" value="Refinance" <?php if($_GET['type']=="refinance"){echo "checked";}?>>
<span>Refinance</span>
</label>
</li>
</ul> 
                                     
<ul style="display: none;">
	<li>
Mortgage Request
</li>
<li>
<label class="pl_check">
<input type="radio" class="mortgage_select" id="fmortgage" name="mortgage" value="fmortgage" checked>
<span>1st Mortgage</span>
</label>
</li>


<li>
<label class="pl_check">
<input type="radio"  class="mortgage_select" id="smortgage" name="mortgage" value="smortgage">
<span>2nd Mortgage</span>
</label>
</li>
</ul>



</section>
</div>
<div class="plb03 cf">
<div class="pl_step">
Step
<span>3</span>
</div>
<section>
<ul>
<li>
<div class="input-holder">
<input name="first_name" id="mfname" type="text" placeholder="First Name*" title="First Name" class="form-control required">
</div>	
</li>
<li>
<div class="input-holder">
<input name="last_name" id="mlname" type="text" placeholder="Last Name*" title="Last Name" class="form-control required">
</div>	
</li>
<li>
<div class="input-holder">
<input type="tel" name="phone" id="mphone" placeholder="Phone*" title="Phone" class="tel form-control required">
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
<select class="form-control required" name="province" title="Province" id="mprovince">
<option value="">Province*</option>
	<option value="" selected="selected"> - Province - </option>
	<option value="AB">Alberta</option>
	<option value="BC">British Columbia</option>
	<option value="MB">Manitoba</option>
	<option value="NB">New Brunswick</option>
	<option value="NL">Newfoundland and Labrador</option>
	<option value="NS">Nova Scotia</option>
	<option value="NT">Northwest Territories</option>
	<option value="NU">Nunavut</option>
	<option value="ON">Ontario</option>
	<option value="PE">Prince Edward Island</option>
	<option value="QC">Quebec</option>
	<option value="SK">Saskatchewan</option>
	<option value="YT">Yukon</option>

</select>
</div>	
</div>
</li>
<li>
<div class="swrapXXX">
<div class="input-holder">
<?php
//<select class="form-control required" name="city" title="City" id="mcity">
//<option value="">City*</option>
//</select>
?>
<input name="mlcity" id="xmlcity" type="text" placeholder="City*" title="City" class="form-control required">
</div>	
</div>
</li>
</ul>
</section>
</div>
<div class="plb04">
<div class="text-box">
<span>Your Estimated Monthly Payment*</span>
<input type="text"  name="mnthly_pymnt" id="mnthly_pymnt1" value="$0">
</div>





<br class="clear" /> 
<span style="font-size:10px; display:inline-block; text-align:justify; line-height: 10px; color: #4EBB64;"><table><tr><td><input  name="CASL" type="checkbox" value="I agree to receive emails, texts and other electronic communications containing promotions, news updates and other material regarding the Go Auto / Yes Plan Financial family of companies' products and services." style="display:inline-block; width:24px; height:24px; line-height: 10px; margin:10px 15px 0 0; color:#fff; border:thin solid #4EBB64; background-color: rgba(255,255,255,.5);"/>&nbsp;&nbsp;&nbsp;</td><td>I agree to receive emails, texts and other electronic communications containing promotions, news updates and other material regarding the Go Auto / Yes Plan Financial family of companies' products and services. You can withdraw your consent at any time. To learn more, view our <a href=" privacy-statement">Privacy Statement</a></td></tr></table></span>











<div id="form-messages"></div>
<input type="submit" id="mortgage_submit" value="" onclick="ga('send', 'pageview', '/virtual/consultation_form.pdf');">
<div class="plz">     
<div id="wait-mortgage" class="wait-mortgage" style="display:none;">
<div class="pls-wait-img-contact"><img src="<?php echo HTTP_HOME_URL;?>images/wait.gif" align="left" border="0" class="loader-img" style="margin-right:5px; margin-left:5px;"/></div>
<div  class="pls-wait-text-contact" >Please&nbsp;wait...</div>
</div>
<span  class="text-box">*First Mortgage Estimated Monthly Payment based on 5 YR Fixed.  OAC</span>
</div>
<br clear="all" />
<!-- <span class="payment_style">(* Payments are estimates only)</span> -->
</div>
</div>
</form><br /><br /><br /><br /><br />

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

$(".ui-slider-handle").on("mouseup",function(){		
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
var mnth_pymnt = (mortAmt*(2.49/100))/12;					
}else if(ltv>=66 && ltv<=80){				
var mnth_pymnt = (mortAmt*(2.59/100))/12;					
}else if(ltv>=81 && ltv<=95){				
var mnth_pymnt = (mortAmt*(4.64/100))/12;					
}else{
var mnth_pymnt = 0;
//alert('The selected values are not valid.');
}


}else if(mortgage_value=='smortgage'){
var ltv = Math.round(((+mortAmt + +curmortAmt)*100)/propVal);				
if(ltv<=70){				
var mnth_pymnt = (mortAmt*(12.95/100))/12;					
}else if(ltv>=71 && ltv<=80){				
var mnth_pymnt = (mortAmt*(13.95/100))/12;					
}else if(ltv>=81 && ltv<=90){				
var mnth_pymnt = (mortAmt*(15.95/100))/12;					
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
var mnth_pymnt = (mortAmt*(2.49/100))/12;					
}else if(ltv>=66 && ltv<=80){				
var mnth_pymnt = (mortAmt*(2.59/100))/12;					
}else if(ltv>=81 && ltv<=95){				
var mnth_pymnt = (mortAmt*(4.64/100))/12;					
}else{
var mnth_pymnt = 0;
//alert('The selected values are not valid.');
}









}else if(mortgage_value=='smortgage'){
var ltv = Math.round(((+mortAmt + +curmortAmt)*100)/propVal);				



if(ltv<=70){				
var mnth_pymnt = (mortAmt*(12.95/100))/12;					
}else if(ltv>=71 && ltv<=80){				
var mnth_pymnt = (mortAmt*(13.95/100))/12;					
}else if(ltv>=81 && ltv<=90){				
var mnth_pymnt = (mortAmt*(15.95/100))/12;					
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
var mnth_pymnt = (mortAmt*(2.49/100))/12;					
}else if(ltv>=66 && ltv<=80){				
var mnth_pymnt = (mortAmt*(2.59/100))/12;					
}else if(ltv>=81 && ltv<=95){				
var mnth_pymnt = (mortAmt*(4.64/100))/12;					
}else{
var mnth_pymnt = 0;
//alert('The selected values are not valid.');
}





}else if(mortgage_value=='smortgage'){
var ltv = Math.round(((+mortAmt + +curmortAmt)*100)/propVal);				




if(ltv<=70){				
var mnth_pymnt = (mortAmt*(12.95/100))/12;					
}else if(ltv>=71 && ltv<=80){				
var mnth_pymnt = (mortAmt*(13.95/100))/12;					
}else if(ltv>=81 && ltv<=90){				
var mnth_pymnt = (mortAmt*(15.95/100))/12;					
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
var mnth_pymnt = (mortAmt*(2.49/100))/12;					
}else if(ltv>=66 && ltv<=80){				
var mnth_pymnt = (mortAmt*(2.59/100))/12;					
}else if(ltv>=81 && ltv<=95){				
var mnth_pymnt = (mortAmt*(4.64/100))/12;					
}else{
var mnth_pymnt = 0;
//alert('The selected values are not valid.');
}





}else if(mortgage_value=='smortgage'){
$('#current_mortgage').show();
var ltv = Math.round(((+mortAmt + +curmortAmt)*100)/propVal);				





if(ltv<=70){				
var mnth_pymnt = (mortAmt*(12.95/100))/12;					
}else if(ltv>=71 && ltv<=80){				
var mnth_pymnt = (mortAmt*(13.95/100))/12;					
}else if(ltv>=81 && ltv<=90){				
var mnth_pymnt = (mortAmt*(15.95/100))/12;					
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
var mnth_pymnt = (mortAmt*(2.49/100))/12;					
}else if(ltv>=66 && ltv<=80){				
var mnth_pymnt = (mortAmt*(2.59/100))/12;					
}else if(ltv>=81 && ltv<=95){				
var mnth_pymnt = (mortAmt*(4.64/100))/12;					
}else{
    
    
   
var mnth_pymnt = 0;
//alert('Mortgage Amount not greater than Property Value');
alert('The selected values are not valid.');
return false;
}
}else if(mortgage_value=='smortgage'){
$('#current_mortgage').show();
var ltv = Math.round(((+mortAmt + +curmortAmt)*100)/propVal);				



if(ltv<=70){				
var mnth_pymnt = (mortAmt*(12.95/100))/12;					
}else if(ltv>=71 && ltv<=80){				
var mnth_pymnt = (mortAmt*(13.95/100))/12;					
}else if(ltv>=81 && ltv<=90){				
var mnth_pymnt = (mortAmt*(15.95/100))/12;					
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
    
    return true;
//$formId.submit();
//document.mortgage_form.submit();
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


$(".ui-slider-handle").on("click",function() { 
   $("#form-collapsep").slideToggle(); 
});
////////////////////////////////////FORM VALIDATION ends here////////////////////////////////////////////////////////

</script>
	  </div>
					 
				  </div>
			  </div>
			  <?php
              /*
	<span class="down-sign-navigate" data-toggle="collapse" data-target="#form-collapsep"></span>
			
			  <!--<div id="id2"> <img src="images/up-arrow-nav.png" style="display:none" class="down-sign-navigate"></div>-->
              */
?>

		  </div>
          
          
<script src="js/app.js"></script>

<script>
    $(document).ready(function(e) {
        $("#propVal,#mortAmt").on("focus",function(){
                $(this).val('');
        });
    });
</script>

<?php
	include("includes/footer.php");
?>
          