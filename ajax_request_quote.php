<?php


     $head.="
    <style>

.container{
   /* padding-left:0px !important;*/
}
#pageForm.fieldset{
  margin: 0;
  padding: 0;
  border: none;
}
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
  max-width: 98vw;
  margin: 0 auto;
  position: block;
  /*border:1px solid #ccc;*/
  opacity:90%;
}
#pageForm.row{
  padding: 11px 0;
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
  max-width:98vw;
  margin: 0px 0;
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
  margin: 10px;
  color: #ccc;
  padding-bottom: 5px;
}
.steps li.is-active{
  border-bottom: 1px solid #3498db;
  color: #3498db;
}
/* FORM */
.form-wrapper .section{
  padding: 0px 20px 30px 0px;/*left was 20px*/
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
  max-width:98vw;
  min-height: 400px;
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
}
.form-wrapper .button, .form-wrapper .submit{
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
  margin-top:10px;
  
}
</style>
";

$head.="
<style>
.form-wrapper .backbutton {
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
  margin-top:50px;
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
}
.form-wrapper input[type=\"text\"],
.form-wrapper input[type=\"password\"]{
  display: block;
  padding: 10px;
  margin: 10px auto;
  background-color: #f1f1f1;
  border: none;
  width: 50%;
  outline: none;
  font-size: 14px !important;
  font-family: 'Open Sans', sans-serif !important;
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
</style>";



$head.="
<style>
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
</style>";



$head.="
<style>

h3{
    margin-top: 30px;
}
optgroup{
    font-size:24px;
    padding:10px 0px 10px 50px;
}
select{
    font-size:18px !important;
    font-weight:300;
    padding:10px;
    background-color: #fff;
        width: 500px;
    max-width: 90vw;
    margin-top:0px !important;
    margin-bottom:0px !important;
}
input[type='checkbox']{
    height:30px;
    width: 30px;
    color:green;
    margin-left: 20px;
    line-height: 36px; 
}
</style>
";

$head.="
<style>




ul{
 /* margin-right: -30px !important; */
}
.more-info-btn{
    max-width:300px;
    }
/* On screens that are 992px or less, set the background color to blue */
@media screen and (max-width: 992px) {
  .steps lixx {
        margin: 10px 10px 10px 0px;
        }
        /*.containerxxx{
    padding-left:0px !important;*/
}
.more-info-btn{
    max-width:50vw;
    text-align:center;
    }
}


    </style>
 ";
//include("includes/head.php");	
require_once("includes/lib/common.php");
include("includes/lib/classes/a/vehicles.php");
require("includes/lib/classes/a/applications.php");
require_once("Mobile-Detect-2.8.34/Mobile_Detect.php");

$is_mobile = 0;
$detect = new Mobile_Detect;
if($detect->isMobile()){
    $a=1;
    $is_mobile=1;
}


    $vehicles = new vehicles();
   $getMakes=$vehicles->getlistMake();
   $getClass=$vehicles->getlistClass();
   $apps = new applications();


echo $head;
?>
    
    <?php if($is_mobile == 1) { 
        $selectWidth=($is_iOS)? "370" : "330";
        ?>
    
    <style>
		select { 
		  min-width:<?php echo $selectWidth; ?>px !important; margin-top:10px;
          }
		#span_pm_checkbox { 
		  display: inline-block; 
          min-width: 200px !important;
          margin-bottom: 10px !important;
          float:left; 
        }
		#span_pm_checkbox_container { 
		  text-align: left !important; 
          padding-left: 30% !important;
          }
	</style>
    <?php }else{ 
        
        $selectWidth=330;?>
    
    <style>
		select { 
		  min-width:<?php echo $selectWidth; ?>px !important; margin-top:10px;
          }
		#span_pm_checkbox { 
		  display: block; 
          min-width: 200px !important;
          margin-bottom: 10px !important;
          float:left; 
        }
		#span_pm_checkbox_container { 
		  text-align: left !important; 
          padding-left: 40% !important;
          }
	</style>
    
    
    
    
    
    
    
    <?php } ?>
    
    
    

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
		width: 90% !important;
        max-width:98vw;
		border-radius: 5px;
		border:2px solid #DDD;
	}
</style>
<!--==========================
    Header
  ============================-->
  
  
  <div class="row" style="min-height: 600px; margin-bottom: 50px; max-width:1140px !important;">
	<div class="container col-md-8" id="pageForm"  style="padding-top: 0px; max-width: 600px; margin-top: 0px; max-width:1140px !important;">
    <div class="wrapper">
      <ul class="steps" style="display: none;">
        <li class="is-active">Step 1</li>
        <li>Step 2</li>
        <li>Step 3</li>
        <li>Step 4</li>
        
      </ul>
      <form class="form-wrapper form_car" method="post" >
        <fieldset class="section is-active" style="max-width:95vw !important; ">
          	<div style="max-width: 700px; margin: 20px auto 0 auto; ">
                        <h3 <?php if($is_mobile){echo " style='margin-top:-20px !important;' ";} ?>>Tell us the make and model you are looking for:</h3>
						<select class="car_brand range" id="make" name="vehicle_make">
                        <optgroup>
						<option value="">Select Make</option>
                        <?php
	 foreach($getMakes as $list) { 
       $list2=str_replace(" ","_",$list['make']);
    	echo "<option value='$list2'>".$list['make']."</option>";
    }
     ?>    </optgroup>          
						</select>	
						<select class="car_brand" id="model" name="vehicle_model">
    <option value="">Select Make First</option>
						</select><br />
                        
                     
                     <select class="car_brand" name="vehicle_body_type">
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
						</select>   
          </div>
          <div class="button">Next</div>
        </fieldset>
        <fieldset class="section" style="padding-top: 100px;">
          <h3>Choose Your Maximum Price</h3>
          	<div style="max-width: 900px; margin: 0 auto;">
						<select id="maxPrice" class="car_brand" name="vehicle_max_price"  required>
                        
						<option>Maximum Price</option>
                                               <?php
	for($i=1000;$i<=17000;$i+=2000){
	   echo "<option value='$i'>$".number_format($i)."</option>";
	}
    for($i=20000;$i<=30000;$i+=5000){
	   echo "<option value='$i'>$".number_format($i)."</option>";
	}
    	for($i=30000;$i<=75000;$i+=10000){
	   echo "<option value='$i'>$".number_format($i)."</option>";
	}
       	for($i=80000;$i<=350000;$i+=20000){
	   echo "<option value='$i'>$".number_format($i)."</option>";
	}
?>

						</select>
                        </div>
          <div class="backbutton">Back</div> <div class="button">Next</div>
        </fieldset>
        <fieldset class="section" style="padding-top: 100px;">
          <h3>Choose a Maximum Kilometres</h3>
          	<div style="max-width: 900px; margin: 0 auto;">
         <select id="maxMiles" class="car_brand" name="vehicle_max_miles"  required >
         <optgroup>
                        <option>Maximum Kilometres</option>
                        <?php
                         echo "<option value='10000'>".number_format("1000")."</option>";
                       echo "<option value='10000'>".number_format("5000")."</option>";
						echo "<option value='10000'>".number_format("10000")."</option>";
	for($i=20000;$i<=450000;$i+=20000){
	   echo "<option value='$i'>".number_format($i)."</option>";
	}
?></optgroup>
						</select>
          </div>
          <div class="backbutton">Back</div> <div class="button">Next</div>
        </fieldset>
        
        
        
        
        
      
        <fieldset class="section" style="padding-top: 80px;">
          <h3>Choose Your Payment Method</h3>
          	<div style="max-width: 900px; margin: 0 auto; font-size:24px; padding:20px;" id="span_pm_checkbox_container">
           
            <div id="span_pm_checkbox"><input type="checkbox" name="payment_method" value="financing">&nbsp;Financing</div><br /><br />
           
             <div id="span_pm_checkbox"> <input type="checkbox" name="payment_method" value="cash">&nbsp;Cash</div><br /><br />
			
					<div id="span_pm_checkbox">	
              <input type="checkbox" name="payment_method" value="Not Sure">&nbsp;Not&nbsp;Sure </div><br /><br />
               
                             
                </div>
                <div style="clear: both;"></div>
                
                 <div class="backbutton  more-info-btn " style="max-width: 120px !important">Back</div> <button class="submit button" name="manage_service_button" value="manage_service_button">Submit</button>
        </fieldset>
        
        
        
      </form>
      	

    </div>
  </div>
    
		</div>
		
		
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
	
	
    

<script src="js/app.js"></script>

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
   // alert(currentSectionIndex);
  <?php
	 if($is_mobile) {
?>
    // this forces the form to the top of the page on the next step
	  if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
}
// This is needed if the user scrolls down during page load and you want to make sure the page is scrolled to the top once it's fully loaded. This has Cross-browser support.
window.scrollTo(0,200);

<?php 	}?>
   
	// don't do anything for buttons on step 5 
	  
	  
	if(currentSectionIndex === 0)   {
		
		var make = $("#make").val();
		var model = $("#model").val();
		var body_type = $("select[name=vehicle_body_type]").val();
		
		if(make != "" && model == "") {
			
			alert("Please choose Make & Model");

			return false;
		}
		
		if(make == "" && body_type == "" ) {
			
			alert("Please select atleast Make or Body-Type of the vehicle");
			return false;
		}
		
	}  
	
    if(currentSectionIndex === 1){

		var xxx = $('#maxPrice').val();
		//alert("maxPrice is  " + xxx);

		if(xxx == 'Maximum Price'){

			 alert("You must enter a Maximum Price");

			return false;

		}

    }
	  
	  
	if(currentSectionIndex === 2)  {
		
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
    if(currentSectionIndex === 4){
      $(document).find(".form-wrapper .section").first().addClass("is-active");
      $(document).find(".steps li").first().addClass("is-active");
    }
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
  
});

</script>