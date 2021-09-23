<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/insurers.php"); 
require("../includes/lib/functions/submenuBuilder.php");
require("../includes/lib/functions/statesProv.php");
$users      = new users();   
$users->require_logged_in("index.php");
$insurers    = new insurers();
$id    = $request->getvalue('request');
$action     = $request->postvalue('action');


if($id>0)	$insurers->load($id);

if($action!='') {
    
        $insurers->id = $request->postvalue('id');
        $insurers->company_name = $request->postvalue('company_name');
        $insurers->company_address = $request->postvalue('company_address');
        $insurers->company_city = $request->postvalue('company_city');
        $insurers->company_province = $request->postvalue('company_province');
        $insurers->company_postal_code = $request->postvalue('company_postal_code');
        $insurers->carrier_number = $request->postvalue('carrier_number');
        $insurers->company_phone = $request->postvalue('company_phone');
        $insurers->company_fax = $request->postvalue('company_fax');
        $insurers->company_email = $request->postvalue('company_email');
    
           
           
           if($error== '') {
            $insurers->save();
            header("Location:insurers.php");
           }
           
	
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Alllergies</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/members.php">Manage Insurers</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_members.php">Edit/Add Insurers</a></li>
						</ul>
						
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Insurers</h1>
			<p></p>
		</div>	
        

        
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						<label>Manage Insurers</label>


<section><label  class="formLabel" for="company_name">Company Name</label><div><input type="text" class="text" name="company_name" value="<?php echo $insurers->company_name; ?>"/></div></section>
<section><label  class="formLabel" for="company_address">Company Address</label><div><input type="text" class="text" name="company_address" value="<?php echo $insurers->company_address; ?>"/></div></section>
<section><label  class="formLabel" for="company_city">Company City</label><div><input type="text" class="text" name="company_city" value="<?php echo $insurers->company_city; ?>"/></div></section>
<section><label  class="formLabel" for="province">Province</label><div>
<?php
echo state_prov("prov_state", $insurers->company_province,"company_province","","");
?>

</div></section>
<section><label  class="formLabel" for="company_postal_code">Company Postal Code</label><div><input type="text" class="text" name="company_postal_code" value="<?php echo $insurers->company_postal_code; ?>"/></div></section>
<section><label  class="formLabel" for="carrier_number">Carrier Number</label><div><input type="text" class="text" name="carrier_number" value="<?php echo $insurers->carrier_number; ?>"/></div></section>
<section><label  class="formLabel" for="company_phone">Company Phone</label><div><input type="text" class="text" name="company_phone" value="<?php echo $insurers->company_phone; ?>"/></div></section>
<section><label  class="formLabel" for="company_fax">Company Fax</label><div><input type="text" class="text" name="company_fax" value="<?php echo $insurers->company_fax; ?>"/></div></section>
<section><label  class="formLabel" for="company_email">Company Email</label><div><input type="text" class="text" name="company_email" value="<?php echo $insurers->company_email; ?>"/></div></section>

<input type="hidden" name="id" value="<?php echo $insurers->id; ?>"/>



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