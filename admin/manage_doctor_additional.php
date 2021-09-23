<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/doctor_additional.php"); 
require("../includes/lib/functions/submenuBuilder.php");
require("../includes/lib/functions/statesProv.php");

$users      = new users();   
$users->require_logged_in("index.php");
$doctor_additional    = new doctor_additional();
$id    = $request->getvalue('request');
$action     = $request->postvalue('action');


if($id>0)	$doctor_additional->load($id);

if($action!='') {
    
       $doctor_additional->id = $request->postvalue('id');
        $doctor_additional->user_id = $request->postvalue('user_id');
        $doctor_additional->office_name = $request->postvalue('office_name');
        $doctor_additional->office_street = $request->postvalue('office_street');
        $doctor_additional->office_city = $request->postvalue('office_city');
        $doctor_additional->office_province = $request->postvalue('office_province');
        $doctor_additional->office_postal_code = $request->postvalue('office_postal_code');
        $doctor_additional->office_phone = $request->postvalue('office_phone');
        $doctor_additional->office_fax = $request->postvalue('office_fax');
        $doctor_additional->contact_first_name = $request->postvalue('contact_first_name');
        $doctor_additional->contact_last_name = $request->postvalue('contact_last_name');
 
           
           if($error== '') {
            $doctor_additional->save();
            header("Location:doctor_additional.php");
           }
           
	
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Clinics and Offices</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/members.php">Manage Clinics and Offices</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_members.php">Edit/Add Clinics and Offices</a></li>
						</ul>
						
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Clinics and Offices</h1>
			<p></p>
		</div>	
        

        
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						<label>Manage Clinics and Offices</label>

<input type="hidden" class="text" name="id" value="<?php echo $doctor_additional->id; ?>"/>
<section><label  class="formLabel" for="office_name">Office Name</label><div><input type="text" class="text" name="office_name" value="<?php echo $doctor_additional->office_name; ?>"/></div></section>
<section><label  class="formLabel" for="office_street">Office Street</label><div><input type="text" class="text" name="office_street" value="<?php echo $doctor_additional->office_street; ?>"/></div></section>
<section><label  class="formLabel" for="office_city">Office City</label><div><input type="text" class="text" name="office_city" value="<?php echo $doctor_additional->office_city; ?>"/></div></section>
<section><label  class="formLabel" for="office_province">Office Province</label><div>
<?php
echo state_prov("prov_state", $physicians->office_province,"office_province","","");
?>
</div></section>
<section><label  class="formLabel" for="office_postal_code">Office Postal Code</label><div><input type="text" class="text" name="office_postal_code" value="<?php echo $doctor_additional->office_postal_code; ?>"/></div></section>
<section><label  class="formLabel" for="office_phone">Office Phone</label><div><input type="text" class="text" name="office_phone" value="<?php echo $doctor_additional->office_phone; ?>"/></div></section>
<section><label  class="formLabel" for="office_fax">Office Fax</label><div><input type="text" class="text" name="office_fax" value="<?php echo $doctor_additional->office_fax; ?>"/></div></section>
<section><label  class="formLabel" for="contact_first_name">Contact First Name</label><div><input type="text" class="text" name="contact_first_name" value="<?php echo $doctor_additional->contact_first_name; ?>"/></div></section>
<section><label  class="formLabel" for="contact_last_name">Contact Last Name</label><div><input type="text" class="text" name="contact_last_name" value="<?php echo $doctor_additional->contact_last_name; ?>"/></div></section>


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