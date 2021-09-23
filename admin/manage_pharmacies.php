<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/pharmacies.php"); 
require("../includes/lib/classes/a/chains.php"); 
require("../includes/lib/functions/submenuBuilder.php");

$users      = new users();   
$users->require_logged_in("index.php");
$pharmacies    = new pharmacies();
$chains         = new chains();
$id    = $request->getvalue('request');
$action     = $request->postvalue('action');


if($id>0)	$pharmacies->load($id);

if($action!='') {
    
       $pharmacies->id = $request->postvalue('id');
        $pharmacies->chain_id = $request->postvalue('chain_id');
        $pharmacies->branch_no = $request->postvalue('branch_no');
        $pharmacies->name = $request->postvalue('name');
        $pharmacies->address = $request->postvalue('address');
        $pharmacies->city = $request->postvalue('city');
        $pharmacies->province = $request->postvalue('province');
        $pharmacies->fax_number = $request->postvalue('fax_number');
        $pharmacies->zip_code = $request->postvalue('zip_code');
        $pharmacies->phone_number = $request->postvalue('phone_number');
        $pharmacies->phone_number2 = $request->postvalue('phone_number2');
        $pharmacies->phone_number3 = $request->postvalue('phone_number3');
        $pharmacies->fax_number2 = $request->postvalue('fax_number2');
        $pharmacies->contact1_name = $request->postvalue('contact1_name');
        $pharmacies->contact2_name = $request->postvalue('contact2_name');
        $pharmacies->contact3_name = $request->postvalue('contact3_name');
        $pharmacies->chain = $request->postvalue('chain');
        $pharmacies->email = $request->postvalue('email');
        $pharmacies->password = $request->postvalue('password');
        $pharmacies->approved = $request->postvalue('approved');
        $pharmacies->bus_license_no = $request->postvalue('bus_license_no');
        $pharmacies->cra_number = $request->postvalue('cra_number');
        $pharmacies->owner_name = $request->postvalue('owner_name');
        $pharmacies->manager_name = $request->postvalue('manager_name');
        $pharmacies->latitude = $request->postvalue('latitude');
        $pharmacies->longitude = $request->postvalue('longitude');

           
           
           if($error== '') {
            $pharmacies->save();
            header("Location:pharmacies.php");
           }
           
	
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Pharmacies</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/members.php">Manage pharmacies</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_members.php">Edit/Add pharmacies</a></li>
						</ul>
						
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Pharmacies</h1>
			<p></p>
		</div>	
        

        
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						<label>Manage Pharmacies</label>



<section><label  class="formLabel" for="chain_id">Chain Id</label><div>
<select name="chain_id">
<?php
$chainList=$chains->getlist();
    echo "<option value=''>Choose Chain</option> ";
foreach($chainList as $list){
    
    $selected=($pharmacies->chain_id==$list['id'])? "selected" :"";
   
   echo "<option value='".$list['id']."' $selected>".$list['chain_name']."</option> ";
}
?>
 </select></div></section>
<section><label  class="formLabel" for="branch_no">Branch No</label><div><input type="text" class="text" name="branch_no" value="<?php echo $pharmacies->branch_no; ?>"/></div></section>
<section><label  class="formLabel" for="name">Name</label><div><input type="text" class="text" name="name" value="<?php echo $pharmacies->name; ?>"/></div></section>
<section><label  class="formLabel" for="address">Address</label><div><input type="text" class="text" name="address" value="<?php echo $pharmacies->address; ?>"/></div></section>
<section><label  class="formLabel" for="city">City</label><div><input type="text" class="text" name="city" value="<?php echo $pharmacies->city; ?>"/></div></section>
<section><label  class="formLabel" for="province">Province</label><div><input type="text" class="text" name="province" value="<?php echo $pharmacies->province; ?>"/></div></section>
<section><label  class="formLabel" for="fax_number">Fax Number</label><div><input type="text" class="text" name="fax_number" value="<?php echo $pharmacies->fax_number; ?>"/></div></section>
<section><label  class="formLabel" for="zip_code">Zip Code</label><div><input type="text" class="text" name="zip_code" value="<?php echo $pharmacies->zip_code; ?>"/></div></section>
<section><label  class="formLabel" for="phone_number">Phone Number</label><div><input type="text" class="text" name="phone_number" value="<?php echo $pharmacies->phone_number; ?>"/></div></section>
<section><label  class="formLabel" for="phone_number2">Phone Number2</label><div><input type="text" class="text" name="phone_number2" value="<?php echo $pharmacies->phone_number2; ?>"/></div></section>
<section><label  class="formLabel" for="phone_number3">Phone Number3</label><div><input type="text" class="text" name="phone_number3" value="<?php echo $pharmacies->phone_number3; ?>"/></div></section>
<section><label  class="formLabel" for="fax_number2">Fax Number2</label><div><input type="text" class="text" name="fax_number2" value="<?php echo $pharmacies->fax_number2; ?>"/></div></section>
<section><label  class="formLabel" for="contact1_name">Contact1 Name</label><div><input type="text" class="text" name="contact1_name" value="<?php echo $pharmacies->contact1_name; ?>"/></div></section>
<section><label  class="formLabel" for="contact2_name">Contact2 Name</label><div><input type="text" class="text" name="contact2_name" value="<?php echo $pharmacies->contact2_name; ?>"/></div></section>
<section><label  class="formLabel" for="contact3_name">Contact3 Name</label><div><input type="text" class="text" name="contact3_name" value="<?php echo $pharmacies->contact3_name; ?>"/></div></section>
<section><label  class="formLabel" for="chain">Chain</label><div><input type="text" class="text" name="chain" value="<?php echo $pharmacies->chain; ?>"/></div></section>
<section><label  class="formLabel" for="email">Email</label><div><input type="text" class="text" name="email" value="<?php echo $pharmacies->email; ?>"/></div></section>
<section><label  class="formLabel" for="password">Password</label><div><input type="text" class="text" name="password" value="<?php echo $pharmacies->password; ?>"/></div></section>
<section><label  class="formLabel" for="approved">Approved</label><div><input type="text" class="text" name="approved" value="<?php echo $pharmacies->approved; ?>"/></div></section>
<section><label  class="formLabel" for="bus_license_no">Bus License No</label><div><input type="text" class="text" name="bus_license_no" value="<?php echo $pharmacies->bus_license_no; ?>"/></div></section>
<section><label  class="formLabel" for="cra_number">Cra Number</label><div><input type="text" class="text" name="cra_number" value="<?php echo $pharmacies->cra_number; ?>"/></div></section>
<section><label  class="formLabel" for="owner_name">Owner Name</label><div><input type="text" class="text" name="owner_name" value="<?php echo $pharmacies->owner_name; ?>"/></div></section>
<section><label  class="formLabel" for="manager_name">Manager Name</label><div><input type="text" class="text" name="manager_name" value="<?php echo $pharmacies->manager_name; ?>"/></div></section>
<section><label  class="formLabel" for="latitude">Latitude</label><div><input type="text" class="text" name="latitude" value="<?php echo $pharmacies->latitude; ?>"/></div></section>
<section><label  class="formLabel" for="longitude">Longitude</label><div><input type="text" class="text" name="longitude" value="<?php echo $pharmacies->longitude; ?>"/></div></section>
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