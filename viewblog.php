<?php
	 include("includes/head.php");
	require("includes/lib/classes/a/blogs.php");
	require("includes/lib/classes/a/blogcategory.php");
        
//	require("includes/lib/classes/a/blogwriters.php");
	//require("includes/lib/classes/a/writermessages.php"); 
//	include('slim-contact-form/conf.php' );
//	include('slim-contact-form/lib/class.phpmailer.php' );

    $blogs 				= 	new blogs();
    $category			=	new blogcategory();
    //$writer				=	new blogwriters();
	//$msgs				=	new writermessages();
	$blog_id			=	$request->getvalue('blog_id');
    
	if($blog_id>0) {
		$blogs->load($blog_id); 
		//$writer->load($blogs->user_id);
		
	}else{ 
	   exit();
       }
	
/*	$message = $request->postvalue('message');
	
	if((($_SESSION['security_code'] != $_POST['security_code']) OR empty($_SESSION['security_code'])) && $message!='') {
		$invalid_code	=	1;
	}
	
	if($message!='' && $invalid_code!='1'){
	
		$msgs->sender_first_name 		= $request->postvalue('first_name');
		$msgs->sender_last_name 		= $request->postvalue('last_name');
		$msgs->sender_email 			= $request->postvalue('email');
		$msgs->sender_phone 			= $request->postvalue('sender_phone');
		$msgs->message_contents 		= $request->postvalue('message');
		$msgs->writer_id 				= $blogs->user_id;
		$msgs->blog_id 					= $blogs->blog_id;
		$msgs->date_sent				= date("Y-m-d H:i:s");
		$msgs->save();		
		$msgsent	=	1;
		unset($_POST);
		
		$emailmsg	= '<table width="899" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color:#EEE;">
  <tr>
    <td><img src="http://plana.pro/images/logo.png" /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="20">
      <tr>';
      
        //<td>Dear '.$writer->first_name.' '.$writer->last_name.'</td>
       $emailmsg	.=  '<td>Hi PlanA:</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>'.$msgs->sender_first_name.' '.$msgs->sender_last_name.' has sent you following message from your <a href="http://www.plana.pro/blog.php?blog_id='.$blogs->blog_id.'">blog</a> on Plana.Pro. Here are the details</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><p> Name : '.$msgs->sender_first_name.' '.$msgs->sender_last_name.'<br />
          Email : '.$msgs->sender_email.'<br />
          Contact : '.$msgs->sender_phone.'<br />
          Message : '.$msgs->message_contents .' <br />
        </p></td>
        </tr>
      <tr>
        <td>Thank You,<br />
          Plana.Pro Team</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>';
		
		$mail 			  = new PHPMailer();
		$mail->From       = $conf['email_sent_from'];
		$mail->FromName   = $conf['email_sent_from_name'];
		$mail->Subject    = "You've got new message from a blog visitor";
		$mail->WordWrap   = 50; // some nice default value
		$mail->MsgHTML( $emailmsg );
		$mail->AddReplyTo( $msgs->sender_email );
		$mail->AddAddress( 'info@plana.pro' );
	$mail->Send();
		
	//	$mail2 			   = new PHPMailer();
//		$mail2->From       = $conf['email_sent_from'];
//		$mail2->FromName   = $conf['email_sent_from_name'];
//		$mail2->Subject    = "You've got new message from blog visitor";
//		$mail2->WordWrap   = 50; // some nice default value
//		$mail2->MsgHTML($emailmsg);
//		$mail2->AddReplyTo( $msgs->email );
//		$mail2->AddAddress('info@plana.pro');
	//	$mail2->Send();	
	}
    */
?>
<?php //include("includes/head.php");?>
<body>
<style>
.blogtitle {
	color: #646464;
    font-family: 'Oswald';
    font-size: 14px;
    font-weight: 500;
    line-height: 1.2em;
    text-decoration: none;
    text-transform: uppercase;
    transition: all 0.2s ease-in-out 0s;
	}
.tags {
	display:inline-block;
	padding:4px 10px 4px 10px;
	background-color:#EEE;
	font-size:12px;
	margin-bottom:4px;
	font-family: 'Oswald';
}
.dropCap:first-letter { float: left; color: #6E6E6E; font-size: 75px; line-height: 60px; padding-top: 4px; padding-right: 8px; padding-left: 3px; font-family: Georgia; }
#writer_contact label { display: inline-block; width:150px; float:left; font-family:Tahoma, Geneva, sans-serif;}
#writer_contact input { display: inline-block; font-family:Tahoma, Geneva, sans-serif; }
textarea 			  { width:400px; height:100px;}
input[type=text] 	  {	width:150px;}
.blog_entry li { color:inherit; }
</style>
    <div id="wrapper">
<?php include("includes/header.php"); ?>

        <?php
/*	<section id="content">
            <div class="inner">
                <div class="container_24">
                   
<div class="wrap" style="height: auto !important;" id="about">
    <div class="indent">
    <?php
	//style="cursor:pointer;" onClick="bloghome();"
?>
        <h2 class="top_h2" ><?php echo REAL_ESTATE_101 ?></h2>
        <div class="scroll">
            <div class="clearfix pos-rel">
                <!--
<div class="divider pos2"></div>
-->
         <div class="grid_8 suffix_1">
         <?php include("blog_left_panel.php");?>
         </div>
         */
?>
              

    <div class="page-banner">
      <div class="container">
           <div class="row">
          <div class="col-md-6"   style="margin-top: 20px;">
            <h2>Blogs </h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="index.php">Home</a></li>
              <li>Blog<? if($topic!='') echo '/'.$blocategory->category_name;?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    
         <!-- Start Content -->
        <div id="content">
          <div class="container" style="margin-top:15px; margin-bottom:10px;">
            <div class="page-content">
              <div class="row">  
                
             <div class="grid_14">
                <?php
/*	<h5><span style="cursor:pointer;" onClick="bloghome();"><?php echo REAL_ESTATE_101_HOME ?></span> >> <?php echo cleanit($blogs->blog_name);?></h5>
*/
?>
                
               <?php if($msgsent==1) { ?> <span style="color:#390; font-size:14px;"><?php echo MESSAGE_SENT ?></span><?php } ?>
               <?php if($invalid_code==1) { ?> <span style="color:#F00; font-size:14px;"><?php echo CAPTCHA_NOT_MATCH ?></span><?php } ?>
                  <p>
                 	 <ul>
                              <li style="min-height:150px; overflow:hidden;" class="blog_entry">
            
                                      <h2 class="blogtitlexx"><?php echo cleanit($blogs->blog_name);?></h2>
                                      
                                      <span style="display:block;">AUTHOR:
                                    
	 <a href="blog.php?writer=<?php echo $writer->writer_id;?>"><?php echo $writer->first_name.' '.$writer->last_name;?></a> 

                                      </span>
                                      <span style="display:block;"><?php echo DATE ?>: <?=date('F j, Y',strtotime($blogs->release_date));?></a></span>
                                      
                                      <?php 
                                        if($blogs->main_image!='')
                                        echo '<img src="images/blogs/large/'.$blogs->main_image.'" width="250" style="float:LEFT; padding:4px 13px 4px 4px;">';
                                      $blogs->description=preg_replace('/<p>/', '<p class=\"dropCap\">', $blogs->description, 1);
                                        echo cleanit($blogs->description);
                                        if($blogs->tags!='') { 
                                                $tags	= explode(',',$blogs->tags);
												$tmp	= array_unique($tags);
                                                for($i=0;$i<sizeof($tmp); $i++) {
                                                   // echo '<span class="tags" style="margin-left:4px;"><a href="blog.php?topic='.trim($tmp[$i]).'">'.$tmp[$i].'</a></span>';
                                                }
                                        }
                                        ?>
                              </li>
                  		</ul>
				  </p>
                  
                  <?php /*
                 <div style="width:600px; padding:4px; margin:15px; " id="message_div">  
                              <h2> <?php echo QUESTION_CONTACT_AUTHOR ?> </h2>
                              <form method="post" action="" id="writer_contact" onSubmit="return validate_writer_message();">
                              <p>	
                              		<label><?php echo FIRST_NAME ?> : </label>
                                  	<input  type="text" id="first_name" name="first_name" value="<?php 
								  	echo ($_POST['first_name'])?$_POST['first_name']:'';?>">
                              </p>
                              
                              <p>	
                              		<label><?php echo LAST_NAME ?> : </label>
                                  	<input  type="text" id="last_name" name="last_name" value="<?php 
								  	echo ($_POST['last_name'])?$_POST['last_name']:'';?>">
                              </p>
                              
                              <p>	
                              		<label><?php echo EMAIL ?> : </label>
                                  	<input  type="text" id="email" name="email" value="<?php echo ($_POST['email'])?$_POST['email']:'';?>">
                              </p>
                              
                              <p>	
                              		<label><?php echo PHONE_NO ?>Phone No : </label>
                                  	<input  type="text" id="sender_phone" name="sender_phone" value="<?php 
									echo ($_POST['sender_phone'])?$_POST['sender_phone']:'';?>">
                              </p>
                              
                              <p>	
                              		<label><?php echo YOUR_MESSAGE ?> : </label>
                                  	<textarea  id="message" name="message"><?php echo ($_POST['message'])?$_POST['message']:'';?></textarea>
                              </p>
                              <p>
                              		<label><?php echo CAPTCHA_CODE ?> :</label>
                              		<img src="captcha/CaptchaSecurityImages.php?width=100&amp;height=30&amp;characters=5" alt="captcha" />
                              </p>
                              <p>
                              		<label> <?php echo ENTER_ABOVE_CODE ?> : </label>
                                    <input name="security_code" type="text" id="security_code" size="20" maxlength="6"/>
                              </p>      
                              
                              <p>	
                              		<label></label>
                                  	<input type="submit" name="submit_button" value="Send Message">
                              </p>
                              </form>  
                              </div>
 

        <?php
        */
/*<a href="javascript:contact();" style="cursor:pointer;"><h3 style="margin-left:9px;">Click Here to Contact the Author</h3></a>

                  				<div style="width:600px; padding:4px; background-color:#EEE; margin:10px; display:inline-block">
										<?php if($writer->image!=''){ ?>
                                        <div style="float:left; margin:10px 10px 10px 10px;"><img src="images/blogs/writers/<?php echo $writer->image;?>" width="100"></div>
                                        <?php } ?>
                                <div style="float:left; margin:10px 10px 10px 10px; width:400px;">
  	                                Author : <?php echo $writer->first_name.' '.$writer->last_name;?><br>
									<?php echo cleanit($writer->bio);?>
                                </div>
                                 	
                                </div>
                            */    ?>
                  </div>
             </div>
                
            </div>
        </div>
    </div>
    <div class="divider pos_top"></div>

    <!--
<div class="divider pos1"></div>
-->


 <?php
	include("includes/footer.php");
?>

                </div>
                   
            </div>
        </section>
    </div>

   <!--
 <div class="welcome act">
        <div id="slidecaption"></div>
        <div class="clear"></div>
        <div id="descript"></div>
        <div class="clear"></div>
    </div>
-->
    <!--Arrow Navigation-->
<!--
	<a id="prevslide" class="load-item"></a>
	<a id="nextslide" class="load-item"></a>
-->




<script>
$(document).ready(function()
{
  //for table row
  $("tr:even").css("background-color", "#E4F8FD");
  $("tr:odd").css("background-color", "#D1E6F4");
  
  });
  
 function bloghome() {
	 window.location = 'blog.php';
 }
 
 function validate_writer_message(){
 	var first_name		= $("#first_name").val();
	var last_name		= $("#last_name").val();
	var email			= $("#email").val();
	var message			= $("#message").val();
	var security_code	= $("#security_code").val();
	
	if(first_name==''){
		alert("Please enter first name");
		$("#first_name").focus();
		return false;
	}
	
	if(last_name==''){
		alert("Please enter last name");
		$("#last_name").focus();
		return false;
	}
	
	if(email==''){
		alert("Please enter email ");
		$("#email").focus();
		return false;
	}
	
	if(!isEmail(email)){
		alert("Please enter valid email ");
		$("#email").focus();
		return false;
	}
	
	if(message==''){
		alert("Please enter message");
		$("#message").focus();
		return false;
	}
	
	if(security_code==''){
		alert("Please enter captcha code");
		$("#security_code").focus();
		return false;
	}
	
 }
 
 
 function isEmail(email) {
  var rExp = new RegExp("^[\\w-_\.]*[\\w-_\.]\@[\\w]\.+[\\w]+[\\w]$");
  return rExp.test(email);
}

//function contact(){
//	$("#message_div").toggle();
//	$("#first_name").focus();
//}
</script>
</body>
</html>