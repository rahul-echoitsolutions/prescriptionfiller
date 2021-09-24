<?php
		include("includes/head.php"); 
require("includes/lib/classes/a/members.php");
require("includes/lib/classes/a/physicians.php");
require("includes/lib/classes/a/doctor_additional.php");
require("includes/lib/functions/statesProv.php");



$physicians 		= new physicians();
$physicians	= new physicians();
$physicians_id = $request->getvalue('id');
$members            = new members();
$doctor_additional         = new doctor_additional();
$id    = $request->getvalue('request');
$action     = $request->postvalue('action');


$members->load($_SESSION['user_id']);

 
$rooturl="https://prescriptionfiller.com/";
require_once("Mobile-Detect-2.8.34/Mobile_Detect.php");
$detect = new Mobile_Detect;
if($detect->isMobile()){
    $a=1;
    $is_mobile=1;
}
if(strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')){
    $browser="Firefox";
}


       $options=array();
       $options['order_by']="";
$doclist= $physicians->getlist();

function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}

if($action!='') {
    
    
    
   
    

//  $testArray=$_POST['clinic'];
    $doctor_additional_id = '';
//    $doctor_additional_id=$testArray[0].",".$testArray[1].",".$testArray[2].",".$testArray[3];
//    
//    
//    
//    $doctor_additional_id=trim($doctor_additional_id,",");
    
      
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
        if(strlen($request->postvalue('password'))>4){
        $physicians->password = password_hash($request->postvalue('password'),PASSWORD_DEFAULT);} ;
      
      
      

 $error=$physicians->verifyName($request->postvalue('first_name'),$request->postvalue('last_name'), $request->postvalue('city'));
           
           
          
           
           if($error== '') {
             $message="success";
            
            
            $physicians->save();
           
           }else{
            
             $message="error";
           }
             }
	echo "<script>
    document.getElementById(\"form\").reset();
    
    
    $(\"#form\")[0].reset();
    
    </script>";



echo "<section class=\"ff_faqs\">
<div id=\"accordion\">";
$xxi=0;
?>
<style>
.inline{
   display:inline-block;
}
.outline{
    border:1px solid #ccc;
    padding: 20px;
}
input{
    width:80%;
    margin-bottom: 20px;
    padding: 10px;
}
label{
    margin-top: 20px;
}
.sm{
    font-size:70%;
}
select{
    width: 500px;
}
.success{
    width: 100%;
    height: 120px;
    padding: 30px;
    text-align:center;
    background-color: #CCFFCC;
    border-radius:20px; 
    margin-top: 40px !important; 
}
.success a{
    color:#fff !important;
    
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
    width: 100%;
    height: 120px;
    padding: 30px;
    text-align:center;
    background-color: #FF6600;
    border-radius:20px; 
    margin-top: 40px !important;
     color:#fff !important; 
}
.error a{
    color:#fff !important;
    
}
#form span{
    font-size:70%;
    line-height: 10px;
}





</style>


<?php

    include("includes/header.php");
?>
    <!-- End Page Banner -->
<img src="images/enter-your-physician.jpg" style="width: 100%;">
    <!-- Start Content -->
    <div id="content" >
<section>
<div class="container">

<?php 
if($message=="success"){?>
<div class="success"><h3>Success</h3><p>Your Physician was successfully entered.<br />Click <a href="add_prescription.php"> Here to return to Enter a Prescription.</a></p></div>
<?php } ?>
	
 <?php if($message=="error"){?>
<div class="error"><h3>Duplicate</h3><p>Your Physician was previously entered.<br />Click <a href="add_prescription.php"> Here to return to Enter a Prescription.</a></p></div>
<?php } ?>  
    
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="css/style.css">
  		
        
<div class="page-content col-lg-12 col-md-12 top50" id="dealerApp" > 
          <div class="page-content">
         
            <div class="col-md-12">  


<div class="g12 nodrop">
			<h1>Enter A New Physician</h1>
			<p>Enter as little or as much information as you want. The minimum is first name, last name, city and province.</p>
		</div>	

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						
<?php
	/*
<section><label  class="formLabel" for="license_number">License Number</label><div><input type="text" class="text" name="license_number" value="<?php echo $physicians->license_number; ?>"/></div></section>
*/
?>


<section>
<!--    <label  class="formLabel" for="doctor_additional_id">Clinics<span><br />Click on multiple clinics if applicable</span></label>
    <div>


<select name="clinic" multiple="">-->
<?php
//$clinicList=$doctor_additional->getlist();
//   
//foreach($clinicList as $list){
//    // note - dash is deliberate to prevent the first id number from returning position 0 
//    $testit="-,".$physicians->doctor_additional_id.",";
//    $testID=",".$list['id'].",";
//    $selected=(strpos($testit,$testID ))? "selected" :"";
//   
//   echo "<option value='".$list['id']."' $selected>".$list['office_name']." - ".$list['office_street']." - ".$list['office_city']."</option> ";
//}
?>
 <!--</select>-->


<!--
</div></section>-->
<section><label  class="formLabel" for="first_name">First Name *</label><div><input type="text" class="text" name="first_name" value="<?php echo $physicians->first_name; ?>" required/></div></section>
<section><label  class="formLabel" for="last_name">Last Name *</label><div><input type="text" class="text" name="last_name" value="<?php echo $physicians->last_name; ?>" required/></div></section>
<section><label  class="formLabel" for="address">Address</label><div><input type="text" class="text" name="address" value="<?php echo $physicians->address; ?>"/></div></section>


<section><label  class="formLabel" for="city">City *</label><div><input type="text" class="text" name="city" value="<?php echo $physicians->city; ?>" required /></div></section>


<section><label  class="formLabel" for="province">Province *</label><div>
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

<input type="hidden" name="id" value="<?php echo $id;?>">

							<div>
                                    
                                    <button class="submit" name="manage_service_button" value="manage_service_button">Submit</button>
                            </div>
						</section>
                     </fieldset>
          </form>              
			</section>






</div>
</div>



























  <?php
	include("includes/footer.php");
?>