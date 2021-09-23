<?php
if(session_id() == ''){
        session_start();
}
    
    
     $head.="
    <style>
    .contactText p{
        font-size:24px;
        line-height: 30px;
        margin-bottom:30px;
        padding-right: 50px;
        }
    .contactText li,a{
        font-size: 24px;
        }
     .form-group input{
        font-size: 18px;
        }
        #message{
        font-size: 18px !important;
        }
        #privacy{
            font-size:18px;
            }

    .error{
        font-size:24px;
        color:#fff;
        padding:50px;
        border-radius: 20px;
    }
    .success{
        font-size:24px;
        color:#fff;
        padding:50px !important;
        border-radius: 20px;
        text-align:center;
        
    }
    .sign-in-PC{
        text-align:center;
        margin: 0 auto;
        }
    </style>
    ";   
	include("includes/head.php");
        require("includes/lib/classes/a/members.php"); 
   

    if($_POST['action']=="submitPassword"){
        
        
       // echo "Got to line ".__LINE__." in ".__FILE__." query is $query <br /><br />";
        
        $members= new members();
        $error="";
        $success="";
          $email = $request->postvalue('email'); 
           $password  = $request->postvalue('password'); 
           
 
           
           if($_SESSION['captcha']<>$request->postvalue('captcha')){
            $error.="Captcha not correct ";
           }

           
           $confirm_password  = $request->postvalue('confirm_password'); 
          
           if($members->email != $email) {
                    $exists = $members->getUserID($email);
                    if($exists > 0 ) {
                            $error = "Email is not available";
                    }
           }
            $members->name = $request->postvalue('first_name')." ".$request->postvalue('last_name');
            $members->first_name = $request->postvalue('first_name');
            $members->last_name = $request->postvalue('last_name');
            $members->email = $request->postvalue('email');
            $members->medical_insurance_provider = $request->postvalue('medical_insurance_provider');
            $members->personal_health_number = $request->postvalue('personal_health_number');
            $members->user_type = $request->postvalue('user_type');
            $members->date_registered = $request->postvalue('date_registered');
            $members->allergies = $request->postvalue('allergies');
            $members->activated = $request->postvalue('activated');
            
            

            
            
           if($password!='' ) { 
            if($confirm_password==$password){
                
            
                
                
            $members->password = password_hash($password,PASSWORD_DEFAULT);
            

            
            
           }else{
            if($error){
                $error.=" and the passwords do not match";
                }else{
            $error.="The passwords do not match";
                    }
           }
           }
           
        
           if($error== '') {
            $members->save();
            $success="Your registration was successful.<br /><br /><button type=\"button\" class=\"sign-in-PC\" data-toggle=\"modal\" data-target=\"#myModal\" style=\"padding:5px 20px !important;\">
    Sign In
  </button>";
  $resetFlag=1;
  $_POST = array();
           }

    }
    ?>
   <style>
   .page-banner{
    margin-top: 100px !important;
   }
    </style>
    <?php
    include("includes/header.php");
?>
    <!-- Start Page Banner -->
   <?php
   /*
	 <div class="page-banner">
      <div class="container">
           <div class="row">
          <div class="col-md-8">
            <h2>Contact Us<?php //echo ($b)? " For ".$category : "";?></h2>
          </div>
          <div class="col-md-4">
            <ul class="breadcrumbs">
              <li><a href="#">Home</a></li>
              <li>Contact Us</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    */
?>
    <!-- End Page Banner -->
<img src="images/fill-out-form.jpg" style="width: 100%;">
    <!-- Start Content -->
    <div id="content" >
      <div class="container">
        <div class="row">
                  <div class="contactText col-md-6 top20"><br /><br />
            <!-- Classic Heading -->
            <h1 class="classic-title"><span><strong>Welcome to: PrescriptionFiller.com</strong></span></h1>
            <p>&nbsp;</p>
            <p>Please choose a password for you account.</p>
            <p>You can also fill in some additional information if you wish, but you are under no obligation to do so. You can add any information you wish at any time from the My Profile section of our website.</p>
            <p>If you haven't already, you can download our PrescriptionFiller app from the Google Play Store or the Apple App Store. Your username and password will work both here and on your app.</p>
            <p>If you have a prescription to enter, you can take a picture of it from our app, or if you are using a browser on your phone, just click HERE, or on the Enter Prescription option under "My Account"</p>
           <?php
	/**
 *  <!-- Some Info -->
 *             <p>Let us help you find your perfect vehicle.</p>
 *             <!-- Divider -->
 *             <div class="hr1" style="margin-bottom:10px;"></div>
 *             <!-- Info - Icons List -->
 *             <ul class="icons-list">
 *               <li><i class="fa fa-globe">  </i> <strong>Address:</strong> 123 Main Street</li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vancouver, BC V5N 2L9</li>
 */
?>
<br /><br /><br /><ul>
             <?php
	/**
 *  
 *               <br /><div class="head3">Call Us</div>
 *             <ul class="icons-list">
 *              <?php
 * //	 <li><i class="fa fa-mobile"></i> <strong>Toll Free:</strong><a href="tel:18885556666">1-888-555-5555</a></li>
 * ?>
 * <li><i class="fa fa-phone"></i> <strong>Toll Free:</strong> <a href="tel:18885555555">888-555-5555</a></li>
 *               <li><i class="fa fa-phone"></i> <strong>Local:</strong> <a href="tel:6045555555">604-555-5555</a></li>
 *               
 *               <?php
 * 	
 *            
 *    ?>         </ul>
 *             
 *             
 *             
 *             
 *             <!-- Divider -->
 *             <div class="hr1" style="margin-bottom:15px;"></div>
 *             
 *             <!-- Info - List -->
 *             <ul class="list-unstyled">
 *             <h2>Business Hours</h2>
 *              <table id="hoursTable">
 *             <tr><td style="width:160px;">Monday - Friday</td><td>  9am to</td><td>5pm<tr></td></tr>
 *             <tr><td>Saturday:</td><td>  10am to  </td><td> &nbsp;2pm</td></tr>
 *             <tr><td> Sunday:</td><td colspan="2"> Closed</td></tr>
 *            </table><br /><br />
 * </ul>
 */
?>
           </div>
          <div class="col-md-6 top50 form-col">
          
          <?php if($error){?>
          <div class="error"><?php echo $error;?></div><br />
          <?php } ?>
          
           <?php if($success){?>
          <div class="success"><?php echo $success;?></div><br />
          <?php } ?>
          
           <?php if(!$error AND strlen($_POST['first_name'])>1){?>
            <!-- Classic Heading -->
            <h2 class="classic-title"><span>Please complete your registration</span></h2>
			   <form id="newUser" class="password-form" method="post" action="new_user.php">
                <input type="hidden" name="action" value="submitPassword" />
            <!-- Start Contact Form -->
	         <div class="form-group">
                <div class="controls">
               <input type="text" name="first_name" value="<?php echo $_POST['first_name'];?>" />
                       </div>
              </div>
               <div class="form-group">
                <div class="controls">
               <input type="text" name="last_name" value="<?php echo $_POST['last_name'];?>" />
                       </div>
              </div>
               <div class="form-group">
                <div class="controls">
               <input type="text" name="email" value="<?php echo $_POST['email'];?>" />
                       </div>
              </div>
              
               <?php }else{?>
                      <div class="form-group">
                <div class="controls">
                 <!-- Classic Heading -->
            <h2 class="classic-title"><span>Please Register</span></h2>
			   <form id="newUser" class="password-form" method="post" action="new_user.php">
                <input type="hidden" name="action" value="submitPassword" />
                  <input id="first_name" type="text" placeholder="First Name" name="first_name" value="<?php echo $_POST['first_name'];?>" required>
                </div>
              </div>
                <div class="form-group">
                <div class="controls">
                  <input id="last_name" type="text" placeholder="Last Name" name="last_name" value="<?php echo $_POST['last_name'];?>" required>
                </div>
              </div>
               <div class="form-group">
                          <div class="controls">
                  <input id="email" type="text" placeholder="Email" name="email" value="<?php echo $_POST['email'];?>" required>
                </div>
              </div>
                
                
                <?php } ?>
                
                
               
                <div class="form-group">
                <div class="controls">
                  <input id="password" type="password" placeholder="Password" name="password" required>
                </div>
              </div>
                <div class="form-group">
                <div class="controls">
                  <input id="confirm" type="password" placeholder="Confirm Password" name="confirm_password" required >
                </div>
              </div>
                <div class="form-group">
                <div class="controls">
                <img src="<?php $_SESSION['captcha'] = generateCode(6); echo 'scripts/captcha.php';?>" >
                </div>
              </div>
              <div class="form-group">
                <div class="controls">
                  <input type="text" placeholder="Please enter the characters above" name="captcha">
                </div>
              </div>
              <br />
              <p><strong>The following are optional:</strong></p>
              <div class="form-group">
                <div class="controls">
                  <input id="allergies" type="text" class="allergies" placeholder="Allergies (comma separated)" name="allergies" value="<?php echo $_POST['allergies'];?>">
                </div>
              </div>
               <div class="form-group">
                <div class="controls">
                  <input id="medical_insurance_provider" type="text" class="medical_insurance_provider" placeholder="Extended Health Provider (if any)" name="medical_insurance_provider" value="<?php echo $_POST['medical_insurance_provider'];?>">
                </div>
              </div>
                            <div class="form-group">
                <div class="controls">
                  <input id="personal_health_number" type="text" class="personal_health_number" placeholder="Government Personal Heath Number" name="personal_health_number" value="<?php echo $_POST['personal_health_number'];?>">
                </div>
              </div>
             <?php /*
	 <div class="form-group">
                <div class="controls">
                  <input id="subject" type="text" class="requiredField" placeholder="Subject" name="subject">
                </div>
              </div>
              */
?>
              <div class="form-group" id="loader" style="display: none;">
              	<img src="<?php echo HTTP_HOME_URL;?>images/loading.gif" >
              </div>
              <div id="form-messages" class="form-group"></div><br /><br />
              <button type="submit" id="submit2" class="btn-systemxxx btn-largexxx" style="padding: 20px 80px; color:#fff; background-color: #00A2E8; border: none !important; cursor: pointer">Submit</button><br />
             <br /> 
            </form>
            <?php
	if($resetFlag){?>
    <script>document.getElementById("newUser").reset();</script>
	   
       
       
<?php 	}?>
            <!-- End Contact Form -->
          </div>
        </div>
      </div>
    </div>
    <!-- End content -->
<?php
	include("includes/footer.php");
?>
