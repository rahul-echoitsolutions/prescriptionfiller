<?php

 
 $head.="
     
    <style>
html, body{
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  font-family: 'Open Sans', sans-serif;
  background-color: #3498db;
}

h1, h2, h3, h4, h5 ,h6{
  font-weight: 200;
}

a{
  text-decoration: none;
}

p, li, a{
  font-size: 14px;
}
.container{
    padding-left:0px !important;
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
  max-width: 100%;
  margin: 0 auto;
  position: relative;
}

#pageForm.row{
  padding: 20px 0;
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
   -webkit-transition: all 1s ease-in;
  -o-transition: all 1s ease-in;
  transition: all 1s ease-in;
  text-align: center;
  position: absolute;
  width: 100%;
  min-height: 400px;
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

h3{
    margin-top: 30px;
}

optgroup{
    font-size:24px;
    padding:10px 0px 10px 50px;
}
select{
    font-size:18px !important;
    font-weight:800;
    padding:10px;
}

input[type='checkbox']{
    height:30px;
    width: 30px;
    color:green;
    margin-left: 20px;
    line-height: 36px; 
}
ul{
    margin-right: -30px !important;
}

.more-info-btn{
    max-width:300px;
    }






/* On screens that are 992px or less, set the background color to blue */
@media screen and (max-width: 992px) {
  .steps li {
        margin: 10px;
        }
        .container{
    padding-left:0px !important;
}
.more-info-btn{
    max-width:50vw;
    text-align:center;
    }
}
    </style>
 ";
    
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
                
              echo"<meta http-equiv=\"refresh\" content=\"0; url=https://carleado.com/vehicle_details.php?id=".$last_id."\">";

}


?> 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

	<title>Choose Vehicle</title>
</head>

<body>

<?php ///// start multi-page form ////////// ?>



  <div class="container" style="margin-top: 140px;" id="pageForm">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Step 1</li>
        <li>Step 2</li>
        <li>Step 3</li>
        <li>Step 4</li>
        <li>Step 5</li>
      </ul>
      <form class="form-wrapper form_car" method="post" action="">
      
      <form class="form_car" method="post" action="">
        <fieldset class="section is-active">
        
          	<div style="max-width: 900px; margin: 20px auto 0 auto;">
                     
                        <h3>Tell us the type of vehicle you want.</h3>
                        
                        <select class="car_brand" name="vehicle_body_type">
                        
						<option value="">Body Type</option>
						<option value="Sedan">Sedan</option>
						<option value="Coupe">Coupe</option>
						<option value="Hatchback">Hatchback</option>
						<option value="Convertible">Convertible</option>
						<option value="SUV">SUV</option>
                        <option value="Crossover">Crossover</option>
						<option value="Minivan">Minivan</option>
                        <option value="">Convertible</option>
						<option value="Pickup Truck">Pickup Truck</option>
                        <option value="Convertible">Convertible</option>
						<option value="Station Wagon">Station Wagon</option>
                        <option value="Hybrid/Electric">Hybrid/Electric</option>
					
						</select>
        
        
        
         <div style="font-size: 48px; margin: 20px; font-weight:bold;">OR</div>   
                 
        
        
        
          <h3>Tell us the make and model you want.</h3>
          
          
          
        
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
						</select>	
                        
                        
                       
           
                        
                        
          </div>

          
          <div class="button">Next</div>
        </fieldset>
        
        
        
        
        
        <fieldset class="section">
          <h3>Choose Your Price Range</h3>
          
          
          
          	<div style="max-width: 900px; margin: 0 auto;">
          
						<select class="car_brand" name="vehicle_max_price">
                        <optgroup>
						<option>Price Range</option>
                        
                                               <?php
	for($i=1000;$i<=17000;$i+=2000){
	   echo "<option value='$i'>$".number_format($i)." - $".number_format($i+2000)."</option>";
	   
	}
    for($i=20000;$i<=30000;$i+=5000){
	   echo "<option value='$i'>$".number_format($i)." - $".number_format($i+5000)."</option>";
	   
	}
    
    
    
    	for($i=30000;$i<=75000;$i+=10000){
	   echo "<option value='$i'>$".number_format($i)." - $".number_format($i+10000)."</option>";
	   
	}
       	for($i=80000;$i<=350000;$i+=20000){
	   echo "<option value='$i'>$".number_format($i)." - $".number_format($i+20000)."</option>";
	   
	}
?>
</optgroup>
					
						</select>
					
                        
                        </div>
                        
                        
                        
                        
                        
						

          <div class="button">Next</div>
        </fieldset>
        
        
        
        
        
        
        <fieldset class="section">
          <h3>Choose a Mileage Range</h3>
          
          	<div style="max-width: 900px; margin: 0 auto;">
         <select class="car_brand" name="vehicle_max_miles">
         <optgroup>
                        <option>Milage</option>
                        <?php
                         echo "<option value='10000'>".number_format("1000")." - 5,000</option>";
                       echo "<option value='10000'>".number_format("5000")." - 10,000</option>";
						echo "<option value='10000'>".number_format("10000")." - 20,000</option>";
                        
                        
                        
	for($i=20000;$i<=450000;$i+=20000){
	   echo "<option value='$i'>".number_format($i)." - ".number_format($i+20000)."</option>";
	   
	}
?></optgroup>

						</select>
          
          </div>
                              
                        
						

          <div class="button">Next</div>
        </fieldset>
        
        
        
         
        <fieldset class="section">
          <h3>Choose Your Payment Method</h3>
          
          	<div style="max-width: 900px; margin: 0 auto; font-size:36px; padding:20px;">
         
				<input type="checkbox" name="payment_method" value="financing">Financing 
				<input type="checkbox" name="payment_method" value="cash">Cash   
				<input type="checkbox" name="payment_method" value="lease">Lease
				
                           
                <input class="submit button more-info-btn" type="submit" value="Submit">
                              

			 
                </div>
                        
						

        </fieldset>
        

        
        
        
        
        
        
        
        <fieldset class="section">
          <h3>Success!</h3>
          <!--
<p>If you aren't sent to our confirmation page, please click the button below.</p>
          <div class="details"><a href="vehicle_details.php">Please Confirm</a>
          
          </div>
-->
          
          
        </fieldset>
      </form>
    </div>
  </div>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
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

    if(currentSectionIndex === 5){
      $(document).find(".form-wrapper .section").first().addClass("is-active");
      $(document).find(".steps li").first().addClass("is-active");
    }
  });
});








</script>
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

</body>
</html>