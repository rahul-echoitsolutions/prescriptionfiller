<?php
    session_start();
    
    
    $head.="
    <style>
    .contactText p{
        font-size:24px;
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
        </style>
        ";
    
    
    
	include("includes/head.php");
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
<img src="images/contact-us.jpg" style="width: 100%;">
    <!-- Start Content -->
    <div id="content" >
    



      <div class="container">
        <div class="row">
                  <div class="contactText col-md-6 top20"><br /><br />
            <!-- Classic Heading -->
            <h1 class="classic-title"><span><strong>Contact Us</strong></span></h1>

<br /><br /><br /><ul>

<?php
	$emailFont=($is_mobile)?"24":"36";
?>
              <li>Email:<br /><br /> <a href="mailto:<?php 	echo TO;?>" style="font-size: <?php echo $emailFont; ?>px; color: #00A2E8;"><?php 	echo TO;?></a></li>
              </ul>

           </div>
          <div class="col-md-6 top150 form-col">
            <!-- Classic Heading -->
            <h2 class="classic-title"><span>Have a Question?</span></h2>
			   <form id="ajax-contact" class="contact-form" method="post" action="mailerContact.php">
            <!-- Start Contact Form -->
          
	           <div class="form-group">
                <div class="controls">
                  <input id="name" type="text" placeholder="Name" name="name">
                </div>
              </div>
              <div class="form-group">
                <div class="controls">
                  <input id="email" type="email" class="email" placeholder="Email" name="email">
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
              <div class="form-group">
                <div class="controls">
                  <textarea id="message" rows="7" placeholder="Message" name="message" style="width: 100%;border: 1px solid #eee;font-size:13px;padding: 7px 14px;"></textarea>
                </div>
              </div>

	              <div class="form-group">
                <div class="controls">
                <img src="<?php $_SESSION['captcha'] = generateCode(6); echo 'scripts/captcha.php';?>" >
                </div>
              </div>
              <div class="form-group">
                <div class="controls">
                  <input type="text" placeholder="Enter the characters above" name="captcha">
                </div>
              </div>
             <input type="hidden" name="subject" value="A Message from the<?php echo SITE_TITLE; ?> Website">
             
              <div class="form-group" id="loader" style="display: none;">
              	<img src="<?php echo HTTP_HOME_URL;?>images/loading.gif" >
              </div>
              
              
              <div id="form-messages" class="form-group"></div><br /><br />
             
              <button type="submit" id="submit2" class="btn-systemxxx btn-largexxx" style="padding: 20px 80px; color:#fff; background-color: #00A2E8; border: none !important; cursor: pointer">Send</button><br />
               
    
             <br /> 
              <input class="cbox" name="CASL" type="checkbox" value="I authorize <?php echo SITE_TITLE; ?> to send me a response and future messages, in compliance with CASL consent in our privacy-statement" style="display:inline-block; width:15px; height:15px; line-height: 10px; margin:0px; font-size: 9px;" >&nbsp;&nbsp;&nbsp;I authorize <?php echo SITE_TITLE; ?> to send me a response and future messages, in compliance with CASL consent in our <a id="privacy" href='privacy-statement'>Privacy Statement</a><br /><br />
            </form>
            <!-- End Contact Form -->
          </div>

        </div>
      </div>
    </div>
    <!-- End content -->
<script src="js/app.js"></script>
<?php
	include("includes/footer.php");
?>


<script>


</script>