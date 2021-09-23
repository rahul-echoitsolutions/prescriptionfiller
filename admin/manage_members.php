<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/members.php"); 
require("../includes/lib/functions/submenuBuilder.php");
require("../includes/lib/functions/statesProv.php");
$users      = new users();   
$users->require_logged_in("index.php");
$members    = new members();
$id    = $request->getvalue('request');
$action     = $request->postvalue('action');


if($id>0)	$members->load($id);

if($action!='') {
    
	       $email = $request->postvalue('email'); 
           $password  = $request->postvalue('password'); 
           
           $error = '';
           
           if($members->email != $email) {
                    $exists = $members->getUserID($email);
                    if($exists > 0 ) {
                            $error = "Email is not available";
                    }
           }
           
           
           $members->id = $request->postvalue('id');
            $members->name = $request->postvalue('first_name')." ".$request->postvalue('last_name');
            $members->first_name = $request->postvalue('first_name');
            $members->last_name = $request->postvalue('last_name');
            $members->date_of_birth = $request->postvalue('date_of_birth');
            $members->sex = $request->postvalue('sex');
            $members->phone_number = $request->postvalue('phone_number');
            $members->email = $request->postvalue('email');
            $members->address = $request->postvalue('address');
            $members->city = $request->postvalue('city');
            $members->province = $request->postvalue('province');
            $members->postal_code = $request->postvalue('postal_code');
            $members->medical_insurance_provider = $request->postvalue('medical_insurance_provider');
            $members->carrier_number = $request->postvalue('carrier_number');
            $members->plan_number = $request->postvalue('plan_number');
            $members->member_id = $request->postvalue('member_id');
            $members->issue_number = $request->postvalue('issue_number');
            $members->personal_health_number = $request->postvalue('personal_health_number');
            $members->shots = $request->postvalue('shots');
            $members->drugs = $request->postvalue('drugs');
            $members->vaccinations = $request->postvalue('vaccinations');
            $members->user_type = $request->postvalue('user_type');
            $members->date_registered = $request->postvalue('date_registered');
            $members->remember_token = $request->postvalue('remember_token');
            $members->created_at = $request->postvalue('created_at');
            $members->updated_at = $request->postvalue('updated_at');
            $members->allergies = $request->postvalue('allergies');
            $members->activated = $request->postvalue('activated');

           
           if($password!='' ) { $members->password = password_hash($password);}
           
           
           
          
           
           
           
           if($error== '') {
            $members->save();
            header("Location:members.php");
           }
           
	
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Members</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/members.php">Manage Members</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_members.php">Edit/Add Members</a></li>
						</ul>
						
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Members</h1>
			<p></p>
		</div>	
        

        
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						<label>Manage Members</label>



<section><label  class="formLabel" for="first_name">First Name</label><div><input type="text" class="text" name="first_name" value="<?php echo $members->first_name; ?>"/></div></section>
<section><label  class="formLabel" for="last_name">Last Name</label><div><input type="text" class="text" name="last_name" value="<?php echo $members->last_name; ?>"/></div></section>
<section><label  class="formLabel" for="date_of_birth">Date Of Birth</label><div><input type="date" class="text" name="date_of_birth" value="<?php echo $members->date_of_birth; ?>"/></div></section>
<section><label  class="formLabel" for="sex">Sex</label><div><input type="text" class="text" name="sex" value="<?php echo $members->sex; ?>"/></div></section>
<section><label  class="formLabel" for="phone_number">Phone Number</label><div><input type="text" class="text" name="phone_number" value="<?php echo $members->phone_number; ?>"/></div></section>
<section><label  class="formLabel" for="email">Email</label><div><input type="text" class="text" name="email" value="<?php echo $members->email; ?>"/></div></section>
<section><label  class="formLabel" for="address">Address</label><div><input type="text" class="text" name="address" value="<?php echo $members->address; ?>"/></div></section>
<section><label  class="formLabel" for="city">City</label><div><input type="text" class="text" name="city" value="<?php echo $members->city; ?>"/></div></section>
<section><label  class="formLabel" for="province">Province</label><div>
<?php
echo state_prov("prov_state", $members->province,"province","","");
?>
</div></section>
<section><label  class="formLabel" for="postal_code">Postal Code</label><div><input type="text" class="text" name="postal_code" value="<?php echo $members->postal_code; ?>"/></div></section>
<section><label for="password">Password<br><span></span></label>
<div><?php echo ($members->password)?"Leave empty if you dont' want to change password":'';?><br>
            <input type="password" id="password" name="password" value="" /></div></section>
<section><label  class="formLabel" for="medical_insurance_provider">Medical Insurance Provider</label><div><input type="text" class="text" name="medical_insurance_provider" value="<?php echo $members->medical_insurance_provider; ?>"/></div></section>
<section><label  class="formLabel" for="carrier_number">Carrier Number</label><div><input type="text" class="text" name="carrier_number" value="<?php echo $members->carrier_number; ?>"/></div></section>
<section><label  class="formLabel" for="plan_number">Plan Number</label><div><input type="text" class="text" name="plan_number" value="<?php echo $members->plan_number; ?>"/></div></section>
<section><label  class="formLabel" for="member_id">Member Id</label><div><input type="text" class="text" name="member_id" value="<?php echo $members->member_id; ?>"/></div></section>
<section><label  class="formLabel" for="issue_number">Issue Number</label><div><input type="text" class="text" name="issue_number" value="<?php echo $members->issue_number; ?>"/></div></section>
<section><label  class="formLabel" for="personal_health_number">Personal Health Number</label><div><input type="text" class="text" name="personal_health_number" value="<?php echo $members->personal_health_number; ?>"/></div></section>
<section><label  class="formLabel" for="shots">Shots</label><div><input type="text" class="text" name="shots" value="<?php echo $members->shots; ?>"/></div></section>
<section><label  class="formLabel" for="drugs">Drugs</label><div><input type="text" class="text" name="drugs" value="<?php echo $members->drugs; ?>"/></div></section>
<section><label  class="formLabel" for="vaccinations">Vaccinations</label><div><input type="text" class="text" name="vaccinations" value="<?php echo $members->vaccinations; ?>"/></div></section>
<section><label  class="formLabel" for="user_type">User Type</label><div><input type="text" class="20text" name="user_type" value="<?php echo $members->user_type; ?>"/></div></section>
<section><label  class="formLabel" for="date_registered">Date Registered</label><div><input type="date" class="text" name="date_registered" value="<?php echo $members->date_registered; ?>"/></div></section>
<section><label  class="formLabel" for="remember_token">Remember Token</label><div><input type="text" class="text" name="remember_token" value="<?php echo $members->remember_token; ?>"/></div></section>
<section><label  class="formLabel" for="created_at">Crated At</label><div><input type="text" class="text" name="created_at" value="<?php echo $members->created_at; ?>"/></div></section>
<section><label  class="formLabel" for="updated_at">Udated At</label><div><input type="text" class="text" name="updated_at" value="<?php echo $members->updated_at; ?>"/></div></section>
<section><label  class="formLabel" for="allergies">allergies</label><div><input type="text" class="text" name="allergies" value="<?php echo $members->allergies; ?>"/></div></section>
<section><label  class="formLabel" for="activated">Activated</label><div><input type="text" class="text" name="activated" value="<?php echo $members->activated; ?>"/></div></section>

       <input type="hidden" name="id" value="<?php echo $id;?>">                 
                        
                        
                        <section>
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