<?php
$head.="
<title>Carleado</title>
<meta name=\"description\" content=\"Carleado - The new way to buy a car\" />
<meta name=\"robots\" content=\"index,follow\" />
<meta name=\"googlebot\" content=\"index,follow\" />
<meta content=\"General\" name=\"Rating\" />
<meta name=\"language\" content=\"English\" />";
require("Mobile-Detect-2.8.34/Mobile_Detect.php");
$detect = new Mobile_Detect;

if($detect->isMobile()){
    $a=1;
}

    
	include("includes/head.php");
    include("includes/header.php");
    include("includes/lib/classes/a/vehicles.php");
  require("includes/lib/classes/a/applications.php");
  
 
    $vehicles = new vehicles();
   $getMakes=$vehicles->getlistMake();
   $getClass=$vehicles->getlistClass();
   
   $apps = new applications();

$request->postvalue('vehicle_make');

if($request->postvalue('vehicle_make')or $request->postvalue('vehicle_body_type')){
    
    
                $apps->application_type				    =	$request->postvalue('application_type');
                $apps->vehicle_make                     =	$request->postvalue('vehicle_make');
                $apps->vehicle_model                    =	$request->postvalue('vehicle_model');
                $apps->vehicle_max_price                =	$request->postvalue('vehicle_max_price');
                $apps->vehicle_max_miles                =	$request->postvalue('vehicle_max_miles');
                $apps->vehicle_category                 =	$request->postvalue('vehicle_category');
                $apps->payment_method                   =   $request->postvalue('payment_method');
                $apps->preferred_payment                =   $request->postvalue('preferred_payment');
                $apps->vehicle_body_type                =   $request->postvalue('vehicle_body_type');
                
                $apps->save();
                
                $last_id=$apps->id;
                
              echo"<meta http-equiv=\"refresh\" content=\"0; url=https://".SITE_URL."/vehicle_details.php?id=".$last_id."\">";

}


?>
<style>



a{
  text-decoration: none;
}



fieldset{
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

.container{
  width: 100%;
  max-width: 100%;
  margin: 0 auto;
  position: relative;
}

.row{
  padding: 20px 0;
}

/* CLEARFIX */

.cf:before,
.cf:after {
    content: " ";
    display: table;
}

.cf:after {
    clear: both;
}

.cf {
    *zoom: 1;
}

.wrapper{
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
  padding: 0px 20px 30px 20px;
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
  -webkit-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  text-align: center;
  position: absolute;
  width: 100%;
  min-height: 500px;
}

.form-wrapper .section h3{
  margin-bottom: 30px;
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
  position: absolute;
  right: 20px;
  bottom: 20px;
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

.form-wrapper input[type="text"],
.form-wrapper input[type="password"]{
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

.form-wrapper input[type="radio"]{
  display: none;
}

.form-wrapper input[type="radio"] + label{
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

.form-wrapper input[type="radio"] + label:before{
  content: "✔";
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

.form-wrapper input[type="radio"]:checked + label:before{
  display: block;
}

.form-wrapper input[type="radio"] + label h4{
  margin: 15px;
  color: #ccc;
}

.form-wrapper input[type="radio"]:checked + label{
  border: 1px solid #3498db;
}

.form-wrapper input[type="radio"]:checked + label h4{
  color: #3498db;
}

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

<?php ///// start multi-page form ////////// ?>




  <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Step 1</li>
        <li>Step 2</li>
        <li>Step 3</li>
      </ul>
      <form class="form-wrapper">
        <fieldset class="section is-active">
          <h3>Your Details</h3>
          <input type="text" name="name" id="name" placeholder="Name">
          <input type="text" name="email" id="email" placeholder="Email">
          <div class="button">Next</div>
        </fieldset>
        <fieldset class="section">
          <h3>Account Type</h3>
          <div class="row cf">
            <div class="four col">
              <input type="radio" name="r1" id="r1" checked>
              <label for="r1">
                <h4>Designer</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="r1" id="r2"><label for="r2">
                <h4>Developer</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="r1" id="r3"><label for="r3">
                <h4>Project Manager</h4>
              </label>
            </div>
          </div>
          <div class="button">Next</div>
        </fieldset>
        <fieldset class="section">
          <h3>Choose a Password</h3>
          <input type="password" name="password" id="password" placeholder="Password">
          <input type="password" name="password2" id="password2" placeholder="Re-enter Password">
          <input class="submit button" type="submit" value="Sign Up">
        </fieldset>
        <fieldset class="section">
          <h3>Account Created!</h3>
          <p>Your account has now been created.</p>
          <div class="button">Reset Form</div>
        </fieldset>
      </form>
    </div>
 








<?php ///// end multi-page form ////////// ?>

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

<script>


$(document).ready(function(){
  $(".form-wrapper .button").click(function(){
    var button = $(this);
    var currentSection = button.parents(".section");
    var currentSectionIndex = currentSection.index();
    var headerSection = $('.steps li').eq(currentSectionIndex);
    currentSection.removeClass("is-active").next().addClass("is-active");
    headerSection.removeClass("is-active").next().addClass("is-active");

    $(".form-wrapper").submit(function(e) {
      e.preventDefault();
    });

    if(currentSectionIndex === 3){
      $(document).find(".form-wrapper .section").first().addClass("is-active");
      $(document).find(".steps li").first().addClass("is-active");
    }
  });
});



</script>