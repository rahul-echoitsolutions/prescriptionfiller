<?php 

include("includes/lib/configure.php");


$head.="
<title>".SITE_TITLE."</title>
<meta name=\"description\" content=\"".SITE_DESCRIPTION."\" />
<meta name=\"robots\" content=\"index,follow\" />
<meta name=\"googlebot\" content=\"index,follow\" />
<meta content=\"General\" name=\"Rating\" />
<meta name=\"language\" content=\"English\" />
<style>
img{
    max-width:100vw;
    }
form input{
    border:thin solid #ccc;
    border-radius:5px;
    padding:5px 10px 5px 15px !important;
    width:90%;
    }
form  select{
    border:thin solid #ccc;
    border-radius:5px;
    padding:3px 10px 3px 15px !important;
   min-width: 500px;
   background-color: #fff;
    }
label{
    margin-top: 20px;
    }
.stateProv{
    border:thin solid #ccc;
    border-radius:5px;
    padding:5px 10px 5px 15px !important;
   min-width: 200px;
   max-width: 200px;
   font-size: 14px !important;
    }
form select option span{
    font-size:50%;
    }
    
.works{margin-bottom:20px;}
label{
    /*font-weight:800;*/
    font-size:16px;
    }
#form span{
    font-size:70%;
    line-height:10px;
    }
.btn{
   /* margin-left:20px;*/
    background-color: #4D94FE;
    border-radius: 10px;
    min-width:20vw;
    color:#fff;
    border:3px solid #33CCCC;                    
    }
    .submit{
        background-color:#2681db;
        border:none;
        border-radius:5px;
        padding:10px 60px;
        color:#fff;
        margin-bottom:50px;
        margin-top: 20px;
    }

.error{
    padding: 50px !important;
    background-color:red;
    color:#fff;
    border: thin solid green;
    border-radius:10px;
    text-align:center;
    margin: 0 auto;
    
    }
    #hideMe {
    -moz-animation: cssAnimation 0s ease-in 5s forwards;
    /* Firefox */
    -webkit-animation: cssAnimation 0s ease-in 8s forwards;
    /* Safari and Chrome */
    -o-animation: cssAnimation 0s ease-in 8s forwards;
    /* Opera */
    animation: cssAnimation 0s ease-in 8s forwards;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
}
@keyframes cssAnimation {
    to {
        width:0;
        height:0;
        overflow:hidden;
        padding:0px;
    }
}
@-webkit-keyframes cssAnimation {
    to {
        width:0;
        height:0;
        visibility:hidden;
        padding:0px;
    }
}
 @media (min-width: 768px) {
    #form .radio input[type=\"radio\"], 
    #form .checkbox input[type=\"checkbox\"] {
        float: left;
        margin-right: 5px;
        margin-left: 5px;
    }
} 


    
.xxbox{
    margin-top:20px;
    }
</style>
";
require("Mobile-Detect-2.8.34/Mobile_Detect.php");
$detect = new Mobile_Detect;

if($detect->isMobile()){
    $a=1;
}

/*
	function isMobile() {
  return preg_match("/\b(?:a(?:ndroid|vantgo)|b(?:lackberry|olt|o?ost)|cricket|do??como|hiptop|i(?:emob??ile|p[ao]d|phone)|kitkat|m??(?:ini|obi)|palm|(?:??i|smart|windows )phone|symbian|up\.(?:browser|link)|tablet(?: browser| pc)|(?:hp-|rim |sony )tablet|w(?:ebos|indows ce|os))/i", $_SERVER["HTTP_USER_AGENT"]);
}
$a=isMobile();
*/

	include("includes/head.php");
    
    include("includes/header.php");
    
// require("includes/lib/common.php"); 
require("includes/lib/classes/a/physicians.php");
require("includes/lib/functions/statesProv.php");
require("includes/lib/classes/a/settings.php");
require("includes/lib/classes/a/doctor_additional.php");
//      bv require("includes/lib/functions/submenuBuilder.php");



$physicians    = new physicians();
$settings   = new settings();
$doctor_additional = new doctor_additional();
$user_id    = $request->getvalue('request');
$action     = $request->postvalue('action');
$success    = $request->getValue('success');
if($user_id>0)	$physicians->load($user_id);



if($action!='') {

  $testArray=$_POST['clinic'];
    
    $doctor_additional_id=$testArray[0].",".$testArray[1].",".$testArray[2].",".$testArray[3];
    
    
    
    $doctor_additional_id=trim($doctor_additional_id,",");
    
      
        $physicians->license_number = $request->postvalue('license_number');
        $physicians->doctor_additional_id = $doctor_additional_id;
        $physicians->first_name = $request->postvalue('first_name');
        $physicians->last_name = $request->postvalue('last_name');
        $physicians->address = $request->postvalue('address');
        $physicians->city = $request->postvalue('city');
        $physicians->province = $request->postvalue('province');
        $physicians->postal_code = $request->postvalue('postal_code');
        $physicians->phone1 = $request->postvalue('phone1');
        $physicians->phone2 = $request->postvalue('phone2');
        $physicians->fax = $request->postvalue('fax');
        $physicians->specialty = $request->postvalue('specialty');
        $physicians->email = $request->postvalue('email');
        
        if(strlen($request->postvalue('password')>4)){
        $physicians->password = password_hash($request->postvalue('password'));
        }

           
           
           if($error== '') {
            $physicians->save();
            header("Location:physicians.php");
           }
           
	
}
?>
function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}
?>
   <?php
/*	<div class="page-banner" >
  
         
      <div class="container">
           <div class="row">
          <div class="col-md-6">
            <h2>Sub Menu Page Demo</h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="index.php">Home</a></li>
              <li>Sub Menu Page Demo</li>
            </ul>
          </div>
        </div>
        </div>
      </div>
      */
?>
    <!-- End Page Banner -->
    <!-- Start Content -->








  <?php
	/**
 *   <div id="content">
 */
?>
     <img src="../images/physician_application.jpg" alt="Physicians Application">
    
		   <div class="container" style="margin: 0 auto; text-align:center;">
            
          <div class="col-sm-12 col-md-12 col-lg-12 how-it-works" style="margin: 16px 0 0 0;   ">
          
          
        
          
          
          
          
          
          
          
          
          
    <?php
	      /*
          
          
                    <h2 class="section-heading text-center"><br /><br />Physician Application</h2>
            <div class="row justify-content-center features">
                
                
                
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="xxbox"><span class="vehiclexxx-img"></span>
                    <img  class="works" src="../images/Sign-Up.png" alt="Sign Up">
                        <h3>Sign Up</h3>
                        </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="xxbox"><span class="preferencesxxx-img"></span>
                      <img class="works" src="../images/Send-your-offer.png" alt="Send your offer">
                        <h3 >Send Your Offer</h3>
                        </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="xxbox"><span class="price-quotesxxx-img"></span>
                      <img class="works"  src="../images/Contact-buyer.png" alt="select your desired vehicle">
                        <h3 >Contact Buyer</h3>
                        </div>
                </div>
            </div>
            */
?>
        </div>
    </div> 
    
  <!--
  </div>
   <div class="clear"></div>
-->
    
    
    
    
    
    
   
    
    
    
    
      <div class="container" style="background-color:rgba(255,255,255,0.8); ">
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12 col-md-12" >
               <!-- Toggle -->
            


<div><span style="font-size:24pt; font-weight: bold; line-height:26px;">Sign Up Now!</span>
	</div><br />



<div>Sign up and get the convenience of dealing with a single source for your prescription filling requirements.. 
	</div>
<br />



<br />
    
   
    </div>
    
            <div class="page-content col-lg-12 col-md-12"  id="dealerApp"> 
          <div class="page-content">
         
            <div class="col-md-12" >  
            
             <div style="margin:20px 0 20px 0; text-align:center; font-size:24pt; line-height:26pt; "><strong>Physician Application </strong></div>
             </div>










     
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
					

<section><label  class="formLabel" for="license_number">License Number</label><div><input type="text" class="text" name="license_number" value="<?php echo $physicians->license_number; ?>"/></div></section>
<section><label  class="formLabel" for="doctor_additional_id">Clinics<span><br />Choose Multiple Clinics if Applicable</span></label><div>


<select name="clinic" multiple="">
<?php
$clinicList=$doctor_additional->getlist();
    
foreach($clinicList as $list){
    // note - dash is deliberate to prevent the first id number from returning position 0 
    $testit="-,".$physicians->doctor_additional_id.",";
    $testID=",".$list['id'].",";
    $selected=(strpos($testit,$testID ))? "selected" :"";
   
   echo "<option value='".$list['id']."' $selected>".$list['office_name'].", ".$list['office_street'].", ".$list['office_city'].", ".$list['office_province']."</option> ";
}
?>
 </select>



</div></section>
<section><label  class="formLabel" for="first_name">First Name</label><div><input type="text" class="text" name="first_name" value="<?php echo $physicians->first_name; ?>"/></div></section>
<section><label  class="formLabel" for="last_name">Last Name</label><div><input type="text" class="text" name="last_name" value="<?php echo $physicians->last_name; ?>"/></div></section>
<section><label  class="formLabel" for="address">Address</label><div><input type="text" class="text" name="address" value="<?php echo $physicians->address; ?>"/></div></section>
<section><label  class="formLabel" for="city">City</label><div><input type="text" class="text" name="city" value="<?php echo $physicians->city; ?>"/></div></section>
<section><label  class="formLabel" for="province">Province</label><div>
<?php
echo state_prov("prov_state", $physicians->province,"province","","");
?>
</div></section>
<section><label  class="formLabel" for="postal_code">Postal Code</label><div><input type="text" class="text" name="postal_code" value="<?php echo $physicians->postal_code; ?>"/></div></section>
<section><label  class="formLabel" for="phone1">Phone1</label><div><input type="text" class="text" name="phone1" value="<?php echo $physicians->phone1; ?>"/></div></section>
<section><label  class="formLabel" for="phone2">Phone2</label><div><input type="text" class="text" name="phone2" value="<?php echo $physicians->phone2; ?>"/></div></section>
<section><label  class="formLabel" for="fax">Fax</label><div><input type="text" class="text" name="fax" value="<?php echo $physicians->fax; ?>"/></div></section>
<section><label  class="formLabel" for="specialty">Specialty</label><div><input type="text" class="text" name="specialty" value="<?php echo $physicians->specialty; ?>"/></div></section>
<section><label  class="formLabel" for="email">Email</label><div><input type="text" class="text" name="email" value="<?php echo $physicians->email; ?>"/></div></section>
<section><label  class="formLabel" for="password">Password<br /><span>Leave blank if no change</span></label><div><input type="text" class="text" name="password" value=""/></div></section>
<input type="hidden" name="id" value="<?php echo $id;?>">

							<div>

                                    <button class="submit" name="manage_service_button" value="manage_service_button">Submit</button>
                            </div>
						</section>
                     </fieldset>
          </form>              























          
            </div>

</div>
</div>




</div>
</div>
</div>
		<?php include("footer.php");?>
        <script>
		$('form').wl_Form({
			ajax:false
		});
		</script>
<?php
	include("includes/footer.php");
?>
        <script>
		$('form').wl_Form({
			ajax:false
		});
        $(document).ready(function(e) {
            var country = '<?php echo $dealers->country;?>';
            if(country != '')  $("#form-country").val(country);
        });
            $("input[name=baddress_option]").on("click",function() {
                var val= $(this).val();
                if(val == 'o') { 
                        /*$(".baddress").show();
                        $("textarea[name=address]").attr('required','required').val('');
                        */
                }
                else      {
                         $("select[name=billing_country]").val($("select[name=country]").val());
                         $("select[name=billing_province]").val($("select[name=province]").val());
                         $("input[name=billing_city]").val($("input[name=city]").val());
                         $("input[name=billing_street]").val($("input[name=street]").val());
                         $("input[name=billing_postcode]").val($("input[name=postcode]").val());
                }
            });
		</script>
        <script>
        function SetBilling(checked) {
	if (checked) {
        document.getElementById('billingaddress').style.display="none";
	} else {
        document.getElementById('billingaddress').style.display="block";
		/*document.getElementById('deliver_firstname').value = document.getElementById('firstname').value; */
	}
}
        </script>
        
        
        
        
           <?php/*
	  <div class="col-md-12">
               <!-- Toggle -->
            <div class="zzzzpanel-group">
            <?php if($contents->image!='') { 
                    $image_url = HTTP_HOME_URL.'images/cms/'.$contents->image;
                   //echo "<span><img src='$image_url' width=\"100%\" class=\"topImage\" alt=\"$contents->image_alt\" /><BR></span>"; 
                   } ?><p>&nbsp;</p>
            <?php 
            
            //	echo nl2br($contents->description); 
                echo $contents->description;
                ?>
     
            </div>
          </div>
          */
?> 
        
        
        
        
        
        
        
        
        
        
        
        