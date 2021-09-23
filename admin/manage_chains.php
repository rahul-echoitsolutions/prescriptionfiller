<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/chains.php"); 
require("../includes/lib/functions/submenuBuilder.php");

$users      = new users();   
$users->require_logged_in("index.php");
$chains    = new chains();
$id    = $request->getvalue('request');
$action     = $request->postvalue('action');


if($id>0)	$chains->load($id);

if($action!='') {
    
       $chains->id = $request->postvalue('id');
        $chains->chain_name = $request->postvalue('chain_name');
        $chains->address = $request->postvalue('address');
        $chains->city = $request->postvalue('city');
        $chains->province = $request->postvalue('province');
        $chains->postal_code = $request->postvalue('postal_code');
        $chains->email = $request->postvalue('email');
        $chains->phone = $request->postvalue('phone');
        $chains->fax = $request->postvalue('fax');
        $chains->contact_first_name = $request->postvalue('contact_first_name');
        $chains->contact_last_name = $request->postvalue('contact_last_name');


           
           
           if($error== '') {
            $chains->save();
            header("Location:chains.php");
           }
           
	
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage chains</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/members.php">Manage Chains</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_members.php">Edit/Add Chains</a></li>
						</ul>
						
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Chains</h1>
			<p></p>
		</div>	
        

        
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						<label>Manage Chains</label>


<section><label  class="formLabel" for="chain_name">Chain Name</label><div><input type="text" class="text" name="chain_name" value="<?php echo $chains->chain_name; ?>"/></div></section>
<section><label  class="formLabel" for="address">Address</label><div><input type="text" class="text" name="address" value="<?php echo $chains->address; ?>"/></div></section>
<section><label  class="formLabel" for="city">City</label><div><input type="text" class="text" name="city" value="<?php echo $chains->city; ?>"/></div></section>
<section><label  class="formLabel" for="province">Province</label><div><input type="text" class="text" name="province" value="<?php echo $chains->province; ?>"/></div></section>
<section><label  class="formLabel" for="postal_code">Postal Code</label><div><input type="text" class="text" name="postal_code" value="<?php echo $chains->postal_code; ?>"/></div></section>
<section><label  class="formLabel" for="email">Email</label><div><input type="text" class="text" name="email" value="<?php echo $chains->email; ?>"/></div></section>
<section><label  class="formLabel" for="phone">Phone</label><div><input type="text" class="text" name="phone" value="<?php echo $chains->phone; ?>"/></div></section>
<section><label  class="formLabel" for="fax">Fax</label><div><input type="text" class="text" name="fax" value="<?php echo $chains->fax; ?>"/></div></section>
<section><label  class="formLabel" for="contact_first_name">Contact First Name</label><div><input type="text" class="text" name="contact_first_name" value="<?php echo $chains->contact_first_name; ?>"/></div></section>
<section><label  class="formLabel" for="contact_last_name">Contact Last Name</label><div><input type="text" class="text" name="contact_last_name" value="<?php echo $chains->contact_last_name; ?>"/></div></section>



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