<?php 
require("includes/lib/common.php");
require("includes/lib/classes/a/members.php"); 
require("includes/lib/functions/submenuBuilder.php");
require("Mobile-Detect-2.8.34/Mobile_Detect.php");
$detect = new Mobile_Detect;
if($detect->isMobile()){
    $a=1;
    $is_mobile=1;
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}







$members    = new members();
if($_SESSION['memberID']>0)	$members->load($_SESSION['memberID']);




/* This section is now in buyers_daahboard.php

$action     = $request->postvalue('action');
if($_POST['action']=="saveDetailsProfile"){
    
    if(!$request->postvalue('last_name')){ 
         header("Location:buyers_dashboard.php?id=".$_SESSION['memberID']."");
        die;
        
        }
       
          $country=($request->postvalue('country')=="")? "Canada" : $request->postvalue('country');
    $full_address=str_replace(" ", "+",$request->postvalue('address')." ".$request->postvalue('city')." ".$request->postvalue('province')." ".$request->postvalue('postalcode')." ".$country);

                $latlong=get_lat_long($full_address);
                $map        =   explode(',' ,$latlong);
                $mapLat     =   $map[0];
                $mapLong    =   $map[1];  
                $mapCity    =   $map[2];
                $mapProv    =   $map[3];
                
    
 
                $pass  = $request->postvalue('password'); 
           

                
				$members->first_name					    =	$request->postvalue('first_name');
				$members->last_name 			        	=	$request->postvalue('last_name');
				$members->address				            =	$request->postvalue('address');
				$members->email 					        =	$request->postvalue('email');
                $members->city                              =   ($request->postvalue('city'))? $request->postvalue('city'): $mapCity;
           $members->province                               =   ($request->postvalue('province'))? $request->postvalue('province') : $mapProv;
                $members->country			                =	$request->postvalue('country');
                $members->province			                =	$request->postvalue('province');
                $members->phone_number                      =   $request->postvalue('phone_number');
                $members->latitude                          =   $mapLat;
                $members->longitude                         =   $mapLong;         
                $members->mobile_phone                      =   $request->postvalue('mobile_phone');
                $members->home_phone                        =   $request->postvalue('home_phone');
                $members->postal_code                        =   $request->postvalue('postal_code');
                
                 if($pass!='' ) {$members->password       = md5($pass);}
                 
                $members->save();
               //  header("Location:buyers_dashboard.php?id=".$_SESSION['memberID']."");
               
               die;
           }
           
           */
?>

	<style>
    <?php if(!$is_mobile){?>
    fieldset{
        margin-left: 30px !important;
    }
    <?php }else{?>
    
    fieldset{
        margin-left: 0px !important;
    }
    <?php } ?>
    
    
    fieldset input{
       /* width:300px;*/
        width:90%;
    box-sizing:border-box;
        padding:5px 10px !important;
        font-size:18px !important;
        margin-bottom: 10px;
        
    }
    fieldset select{
       /* width:300px;*/
         width:90%;
    box-sizing:border-box;;
        padding:2px 10px !important;
        font-size:18px !important;
        margin-bottom: 10px;
    }
    
    <?php if($is_mobile){ ?>
         form{
        margin-left: 0px !important;
        }
    <?php 	}else{ ?>
    
        form{
        margin-left: 40px;
        }
        
        
    <?php } ?>

    label{
        font-size: 16px;
        margin-bottom:0px;
    }
    .ourBlue{
        color:#2681db !important;
    }
    .submit{
        background-color:#2681db;
        border:none;
        border-radius:5px;
        padding:10px 60px;
        color:#fff;
        margin-bottom:50px;
    }
    #form span{
        font-size:70%;
        line-height: 10px;
    }
    </style>
</head>
<body>
		</nav>
        <?php
	$profileSection=($is_mobile)? 'style="margin-left: 0px;"' : 'style="margin-left: 40px;"'
?>
        
        
		<section id="content" accesskey="<?php echo $profileSection; ?>">
	
                
                
              <div class="page-content col-lg-12 col-md-12" id="dealerApp"> 
          <div class="page-content">
         
            <div class="col-md-12">  
            
             <div style="margin:20px 0 20px 0; text-align:center; font-size:24pt; line-height:26pt; "><strong>Your Profile </strong></div>
             </div>
                 
                
                
                
                
                
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>
		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data" style="margin-left:  40px;;">
		<input type="hidden" id="action" name="action" value="saveDetailsProfile">
					<fieldset>
						<label>* Please check that your information is correct.<br /></label>
                       
                       
                        <section><label for="first_name">First Name<br><span></span></label>
							<div><input type="text" id="first_name" name="first_name" value="<?php echo $members->first_name;?>" required>
							</div>
						</section>
                        <section><label for="last_name">Last Name<br><span></span></label>
							<div><input type="text" id="last_name" name="last_name" value="<?php echo $members->last_name;?>" required>
							</div>
						</section>
                        <section><label for="email">Email<br><span></span></label>
							<div><input type="text" id="email" name="email" value="<?php echo $members->email;?>" required>
							</div>
						</section>
                        <section><label for="position">Phone<br><span></span></label>
							<div><input type="text" id="phone" name="phone_number" value="<?php echo $members->phone_number;?>" required>
							</div>
						</section>
                        <?php $passRequired=($memb->password)?  "selected" : "";?>
                        <section>
                        <label for="email">Password - <span><?php echo "Leave blank to keep your existing password.";?></span> </label>
                        <div><input  type="password" class="" name="password" id="password"  /></div>
                        </section>
                        <section id="conf" style="display: none;">
                        <label for="email">Confirm Password - <?php if($passRequired){echo "Leave blank to keep your existing password.";}?></label>
                        <div><input  type="password" class="" name="confirm_password" id="confirm_password" <?php echo $passRequired;?> /></div>
                        </section>    
                        <section><label for="street">Address</label>
							<div><input type="text" id="address" name="address" value="<?php echo $members->address;?>"></div>
						</section>
                        <section><label for="street">City</label>
							<div><input type="text" id="city" name="city" value="<?php echo $members->city;?>"></div>
						</section>
                        <section><label for="street">Province</label>
							<div><?php 
                        $extra  = ' class="form-control-select"  ';
                                                    echo loadProvinces('province','form-province',$extra,$members->province);?></div>
						</section>
                        <section><label for="street">Postal code</label>
							<div><input type="text" id="postal_code" name="postal_code" value="<?php echo $members->postal_code;?>"></div>
						</section>
                         <section><label for="street">Country</label>
							<div><select type="text" name="country" class="form-control-select"id="form-country"  >
														
														<option value="CA" <?php echo ($members->country=="CA")? "selected" :"";?>>Canada</option>
														<option value="US" <?php echo ($members->country=="US")? "selected" :"";?>>United States</option>
                                                    </select></div>
						</section>
                        <section>
							<div><input type="hidden" name="mobile_phone" value="999999">
                                    <button class="submit" name="manage_service_button" value="manage_service_button">Submit</button>
                            </div>
						</section>
                     </fieldset>
          </form>  
          
          </div>
          </div>            
			</section>
		<?php //include("includes/footer.php");?>
         <script>
         $(document).ready(function(){
     $('#password').on('keyup', function () {
if($('#password').val()){ $('#conf').css('display', 'inline');}
}    
  );
 $('#confirm_password').on('keyup', function () {   
    if ($('#password').val() == $('#confirm_password').val()) {
        $('#confirm_password').css('border-color', 'green').css('border-width','3px');
    } else 
        $('#confirm_password').css('border-color', 'red').css('border-width','3px');
});   
    });     
</script>        
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