<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/physicians.php"); 
require("../includes/lib/classes/a/doctor_additional.php"); 
require("../includes/lib/functions/submenuBuilder.php");
require("../includes/lib/functions/statesProv.php");

$users      = new users();   
$users->require_logged_in("index.php");
$physicians    = new physicians();
$doctor_additional = new doctor_additional();
$id    = $request->getvalue('request');
$action     = $request->postvalue('action');


if($id>0)	$physicians->load($id);

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
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Physicians</title>
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
							
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php">Admin Dashboard</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/members.php">Manage Physicians</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_members.php">Edit/Add Physicians</a></li>
						</ul>
						
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Physicians</h1>
			<p></p>
		</div>	
        

        
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						<label>Manage Physicians</label>

<section><label  class="formLabel" for="license_number">License Number</label><div><input type="text" class="text" name="license_number" value="<?php echo $physicians->license_number; ?>"/></div></section>
<section><label  class="formLabel" for="doctor_additional_id">Clinics</label><div>


<select name="clinic" multiple="">
<?php
$clinicList=$doctor_additional->getlist();
    echo "<option value=''>Choose Clinic</option> ";
foreach($clinicList as $list){
    // note - dash is deliberate to prevent the first id number from returning position 0 
    $testit="-,".$physicians->doctor_additional_id.",";
    $testID=",".$list['id'].",";
    $selected=(strpos($testit,$testID ))? "selected" :"";
   
   echo "<option value='".$list['id']."' $selected>".$list['office_name']."</option> ";
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
                                    <button class="reset">Reset</button>
                                    <button class="submit" name="manage_service_button" value="manage_service_button">Submit</button>
                            </div>
						</section>
                     </fieldset>
          </form>              
			</section>
		<?php //include("includes/footer.php");?>
        
        
        <script>
		$('form').wl_Form({
			ajax:false
		});
        
        $(document).ready(function(e) {
            
            var country = '<?php echo $members->country;?>';
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
</body>
</html>