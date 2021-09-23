<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/dealers.php"); 
require("../includes/lib/functions/submenuBuilder.php");

$users      = new users();   $users->require_logged_in("index.php");
$dealers    = new dealers();
$user_id    = $request->getvalue('request');
$action     = $request->postvalue('action');

if($user_id>0)	$dealers->load($user_id);


if($action!='') {
    
	       $email = $request->postvalue('email'); 
           $pass  = $request->postvalue('password'); 
           
           $error = '';
           
           if($dealers->email != $email) {
                    $exists = $dealers->getUserID($email);
                    if($exists > 0 ) {
                            $error = "Email is not available";
                    }
           }
           $dealers->type       = $request->postvalue('type');
           $dealers->first_name = $request->postvalue('first_name');
           $dealers->last_name  = $request->postvalue('last_name');
           $dealers->phone      = $request->postvalue('phone');
           $dealers->position   = $request->postvalue('position');
           $dealers->email      = $email;
           $dealers->first_name1= $request->postvalue('fname1');
           $dealers->last_name1 = $request->postvalue('lname1');
           $dealers->phone1     = $request->postvalue('phone1');
           $dealers->position1  = $request->postvalue('position1');
           $dealers->email1     = $email;
           
           if($pass!='' ) { $dealers->password = md5($pass);}
           
           
           
           $dealers->street             = $request->postvalue('street');
           $dealers->address            = $request->postvalue('address');
           $dealers->city               = $request->postvalue('city');
           $dealers->province           = $request->postvalue('province');
           $dealers->postcode           = $request->postvalue('postcode');
           $dealers->country            = $request->postvalue('country');
           
           $dealers->billing_street     = $request->postvalue('billing_street');
           $dealers->billing_city       = $request->postvalue('billing_city');
           $dealers->billing_province   = $request->postvalue('billing_province');
           $dealers->billing_postcode   = $request->postvalue('billing_postcode');
           $dealers->billing_country    = $request->postvalue('billing_country');
           
           $dealers->company            = $request->postvalue('company');
           $dealers->company_trade_name = $request->postvalue('company_trade_name');
           
           if($error== '') {
            $dealers->save();
            header("Location:brokers.php");
           }
           
	
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Brokers</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/brokers.php">Manage Brokers</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_brokers.php">Edit/Add Brokers</a></li>
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Add / Manage Brokers</h1>
			<p></p>
		</div>	
        

        
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						<label>Manage Brokers</label>
                        

                        <section><label for="first_name">First Name<br><span></span></label>
							<div><input type="text" id="first_name" name="first_name" value="<?php echo $dealers->first_name;?>" required>
							</div>
						</section>
                        
                        <section><label for="last_name">Last Name<br><span></span></label>
							<div><input type="text" id="last_name" name="last_name" value="<?php echo $dealers->last_name;?>" required>
							</div>
						</section>

                        <section><label for="email">Email<br><span></span></label>
							<div><input type="text" id="email" name="email" value="<?php echo $dealers->email;?>" required>
							</div>
						</section>
                        
                        
                        <section><label for="position">Position with Company<br><span></span></label>
							<div><input type="text" id="position" name="position" value="<?php echo $dealers->position;?>" required>
							</div>
						</section>
                        
                        
                        <section><label for="position">Phone<br><span></span></label>
							<div><input type="text" id="phone" name="phone" value="<?php echo $dealers->phone;?>" required>
							</div>
						</section>
                        
                        
                        <section><label for="password">Password<br><span></span></label>
							<div><?php echo ($dealers->password)?"Leave empty if you dont' want to change password":'';?><br>
                            <input type="password" id="password" name="password" value="" style="width:781px;">
							</div>
						</section>
                        
                        
                        <h2 style="padding:20px;"> Secondary Contact </h2>
                        <section><label for="first_name">Secondary First Name<br><span></span></label>
							<div><input type="text" id="first_name1" name="first_name1" value="<?php echo $dealers->first_name1;?>">
							</div>
						</section>
                        
                        <section><label for="last_name">Secondary Last Name<br><span></span></label>
							<div><input type="text" id="last_name1" name="last_name1" value="<?php echo $dealers->last_name1;?>">
							</div>
						</section>

                        <section><label for="email">Secondary Email<br><span></span></label>
							<div><input type="text" id="email1" name="email1" value="<?php echo $dealers->email1;?>">
							</div>
						</section>
                        
                        
                        <section><label for="position">Position with Company<br><span></span></label>
							<div><input type="text" id="position1" name="position1" value="<?php echo $dealers->position1;?>">
							</div>
						</section>
                        
                        
                        <section><label for="position">Phone<br><span></span></label>
							<div><input type="text" id="phone1" name="phone1" value="<?php echo $dealers->phone1;?>">
							</div>
						</section>
                        
                        <h2 style="margin:20px;"> Company Information </h2>
                        
                        <section><label for="company">Company Name</label>
							<div><input type="text" id="company" name="company" value="<?php echo $dealers->company;?>" required></div>
						</section>
                        
                        <section><label for="company_trade_name">Company Trade Name</label>
							<div><input type="text" id="company_trade_name" name="company_trade_name" value="<?php echo $dealers->company_trade_name;?>"></div>
						</section>
                        
                        
                        <h2 style="margin:20px;"> Company Address </h2>
                        <section><label for="street">Company Street</label>
							<div><input type="text" id="street" name="street" value="<?php echo $dealers->street;?>"></div>
						</section>
                        
                        <section><label for="street">Company City</label>
							<div><input type="text" id="city" name="city" value="<?php echo $dealers->city;?>"></div>
						</section>
                        
                        <section><label for="street">Company Province</label>
							<div><?php 
                                                    $extra  = 'class="form-control-select" style="width:100%;" required';
                  echo loadProvinces('province','form-province',$extra,$dealers->province);?></div>
						</section>
                        
                        <section><label for="street">Company Postal code</label>
							<div><input type="text" id="postcode" name="postcode" value="<?php echo $dealers->postcode;?>"></div>
						</section>
                        
                        <section><label for="street">Company Country</label>
							<div><select type="text" name="country" class="form-control-select"id="form-country" style="width:100%;" >
                                                        <option value="">Country *</option>
													
                                                        <option value="CA">Canada</option>
                                           
                                                        <option value="US">United States</option>
                                            
                                                    </select></div>
						</section>
                        
                        <h2 style="margin:20px">Billing Address </h2>
                        
                        <section><label for="street">Billing Address</label>
							<div>     <input type="radio" name="baddress_option" id="baddress_option0" value="s" <?php 
                                                     echo ($dealers->address=='')?'checked':'';?>> Same as Billing
                                                    <input type="radio" name="baddress_option" id="baddress_option1" value="o" <?php 
                                                     echo ($dealers->address!='')?'checked':'';?>> Other</div>
						</section>
                        <!--
                        <section class="baddress" style="display:<?php echo ($dealers->address!='')?'':'none';?>"><label for="street">Billing Address</label>
							<div><textarea id="billing_address" name="billing_address"><?php echo $dealers->address;?></textarea></div>
						</section> -->
                        
                        
                        <section><label for="street">Billing Street</label>
							<div><input type="text" id="billing_street" name="billing_street" value="<?php echo $dealers->billing_street;?>"></div>
						</section>
                        
                        <section><label for="street">Billing City</label>
							<div><input type="text" id="billing_city" name="billing_city" value="<?php echo $dealers->billing_city;?>"></div>
						</section>
                        
                        <section><label for="street">Billing Province</label>
							<div><?php 
              $extra  = 'class="form-control-select" style="width:100%;" ';
             echo loadProvinces('billing_province','form-province',$extra,$dealers->billing_province);?>
                                                  
                                                  </div>
						</section>
                        
                        <section><label for="street">Billing Postal code</label>
							<div><input type="text" id="billing_postcode" name="billing_postcode" value="<?php echo $dealers->billing_postcode;?>"></div>
						</section>
                        
                        <section><label for="street">Billing Country</label>
							<div><select type="text" name="billing_country" class="form-control-select"id="form-billing_country" style="width:100%;" >
														<option value="">Country *</option>
												
                                                        <option value="CA">Canada</option>
                                                     
                                                        <option value="US">United States</option>

                                                    </select></div>
						</section>
                        
                        
                        
                        <section><input type="hidden" name="type" value="broker"/>
							<div>
                                    <button class="reset">Reset</button>
                                    <button class="submit" name="manage_service_button" value="manage_service_button">Submit</button>
                            </div>
						</section>
                     </fieldset>
          </form>              
			</section>
		<?php include("footer.php");?>
        
        
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
</body>
</html>