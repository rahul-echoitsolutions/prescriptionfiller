<?php $rooturl="https://prescriptionfiller.com/";
require_once("Mobile-Detect-2.8.34/Mobile_Detect.php");
$detect = new Mobile_Detect;
if($detect->isMobile()){
    $a=1;
    $is_mobile=1;
}
if($detect->isTablet()){
    $is_tablet=1;
}
if($detect->isiOS() ){
    $is_iOS=1;
    }
if(strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')){
    $browser="Firefox";
}
   ?>
   
   
   
   
   </head>
    <body>
<div class="body-overlay" style="display:none"></div>
      <nav class="navbar navbar-light bg-white  navbar-expand-md ">
<?php	
 if(!$_SESSION['memberID']){	  
?>
		<button type="button" class="sign-in-mobile" data-toggle="modal" data-target="#myModal" <?php //echo $si; ?>>Sign In</button>
<?php
	}else{	   
     if($_SESSION['memberID'] ) {
        $si=($is_mobile)?"style=\"margin-right:0px !important; padding: 4px 10px !important;  font-size:12px;\"" : "";
        ?>
        <button type="button" class="sign-in-mobile" onclick="location.href='https://prescriptionfiller.com/buyers_dashboard.php?action=dealer-offers&id=<?php echo $_SESSION['memberID']; ?>';"  <?php  echo $si; ?>>
    Dashboard
  </button>        
  <?php      
     } 	}			
    if($_SESSION['memberID'] <=1){	
        ?>                                                                                
		<div class="sign-in-popup"><a href="javascript:void(0)" >      
  			<!-- The Modal -->
			  <div class="modal" id="myModal">
				<div class="modal-dialog">
				  <div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
					<h2>Sign In</h2>
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
					 <form action="ajax_check_login.php" method="post" id="loginForm">
						<div class="form-group">
						  <label for="email">Email</label>
						  <input type="email" class="form-control" id="email" placeholder="" name="email">
						</div>
						<div class="form-group">
						  <label for="pswd">Password</label>
						  <input type="password" class="form-control" id="pswd"  name="pswd">
						</div>
						<div class="form-group form-check">
						</div>
				 <input type="hidden" name="action" value="verifyLogin">
				<button type="submit" id="submit" class="btn btn-primary" style="display:inline; margin-bottom: 20px;">Submit</button>
				<?php
				$mobileSizing=($is_mobile)? " font-size:10px; margin-right: 10px;" : " margin-right:  30px; ";
			?>
				<div style="float: right;  display:inline; <?php echo $mobileSizing; ?>"><a href="forgotten_password">Forgotten Password?</a></div>
                <div>Don't Have an Account? <a href="https://prescriptionfiller.com/new_user.php#formLink" class="btn btn-primary shadow-lg btn-round mt-2 mr-2 mb-2 ml-0  btn-lg  " target="_self">Get started now </a></div>
			  </form>
					</div>
					<div id="ack" ></div>
					<!-- Modal footer -->
				  </div>
				</div>
			  </div>
		</a></div>
	<?php }else{ 
	   if($is_mobile){
  $logoutFlag=1;  
	   }else{            
       if($is_mobile){?>       
               <ul style="float:right; display:inline-block; position: absolute; top:28px; right:0px !important;">
       <li>
                               	<div class="sign-in-popup dropdown">
  <div class="menuBuilder "><img src="https://prescriptionfiller.com/images/user-icon.png" alt="My Account"  ><br />My&nbsp;Account</div>
 <div class="dropdown-content">
       <ul>
       <?php $id = $_SESSION['memberID'];?>
       <li><a href="https://prescriptionfiller.com/buyers_dashboard.php?id=<?php echo $id;?>&action=dealer-offers">My Prescriptions</a>   </li>
       <li><a href="https://prescriptionfiller.com/buyers_dashboard.php?id=<?php echo $id;?>&action=shortlist">My Profile</a>   </li>
       <li><a href="https://prescriptionfiller.com/logout.php">Log Out</a></li>
       </ul>
       </div> 
 </li>
      </ul> 
       <?php }
        }
        } ?> 
        <div class="container">
          <div class="col-2 pl-md-0 text-left">
            <a href="<?php echo INDEX_PAGE;?>">
              <img src="images/logo1-200.png" style="height: 50px !important;" alt="logo">
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse-1" aria-controls="navbarNav6" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-center col-md-8 navbar-collapse-1">
            <ul class="menu-bar">
                          <li><div class="dropdown">
                <a class="nav-link" href="<?php echo INDEX_PAGE;?>"><div class="menuBuilder menuText">Home</div></a>
						<?php
                        $url = HTTP_HOME_URL;
          	            $subHome=getSubmenu("Home");
                          if(is_array($subHome)){
                          echo"<div class=\"dropdown-content\">
                          <ul>";
                          foreach ($subHome as $key=>$value){
                              $submenulinks = generate2ndTierLinks("Home",$value['content_id']);
                              $isdropdown   = ($submenulinks == '')?'':'class="dropdown-submenu" ';
                              $isCarret     = ($isdropdown == '')?'':'<span class="caret"></span>';
                              $nofollow = ($value['nofollow']==1)?'rel = "nofollow"':'';
                              echo"<li  $isdropdown><a href=\"{$url}{$value['url_key']}\" $nofollow >{$value['title']} $isCarret</a>  $submenulinks </li>";
                          }
						echo"<li  $isdropdown><a href=\"application-form-go-mortgage\" $nofollow target=\"_blank\">FULL APPLICATION</a></li>";
                          echo("</ul></div>");
                          unset($key, $value);
                        }        
						?>  
               </div>
              </li>
                          <li><div class="dropdown">
                <a class="nav-link" href="how-it-works"><div class="menuBuilder menuText">How It Works</div></a>
                <?php
                                  $manualMenuItem="<li  $isdropdown  ><a href='doctor_application.php'>Doctor Sign Up</a></li><li  $isdropdown><a href='testimonials.php'>Testimonials</a></li>";
                          $url = HTTP_HOME_URL;
          	              $subHIW=getSubmenu("How it Works");
                          if(is_array($subHIW)){
                          echo"<div class=\"dropdown-content\" >
                          <ul >";
                          foreach ($subHIW as $key=>$value){
                              $submenulinks = generate2ndTierLinks("How it Works",$value['content_id']);
                              $isdropdown   = ($submenulinks == '')?'':'class="dropdown-submenu"';
                              $isCarret     = ($isdropdown == '')?'':'<span class="caret"></span>';
                              $nofollow = ($value['nofollow']==1)?'rel = "nofollow"':'';
                              echo"<li  $isdropdown><a href=\"{$url}{$value['url_key']}\" $nofollow >{$value['title']} $isCarret</a>  $submenulinks </li>";
                          }
                          echo("$manualMenuItem</ul></div>");
                          unset($key, $value);
                                   }        
						?> 
              </div>
              </li>
<li><div class="dropdown">
						<a class="nav-link" href="/faq"><div class="menuBuilder menuText">FAQs</div></a>
                                          <?php
                          $url = HTTP_HOME_URL;
          	              $subFAQs=getSubmenu("FAQs");
                          if(is_array($subFAQs)){
                          echo"<div class=\"dropdown-content\">
                          <ul >";
                          foreach ($subFAQs as $key=>$value){
                              $submenulinks = generate2ndTierLinks("FAQs",$value['content_id']);
                              $isdropdown   = ($submenulinks == '')?'':'class="dropdown-submenu"';
                              $isCarret     = ($isdropdown == '')?'':'<span class="caret"></span>';
                              $nofollow = ($value['nofollow']==1)?'rel = "nofollow"':'';
                              echo"<li  $isdropdown><a href=\"{$url}{$value['url_key']}\" $nofollow >{$value['title']} $isCarret</a>  $submenulinks </li>";
                          }
                          echo("</ul></div>");
                          unset($key, $value);
                                   }        
						?>
                        </div>
                           </li>
              <li><div class="dropdown">
                <a class="nav-link" href="about-us"><div class="menuBuilder menuText">About Us</div></a>
                <?php
                  $url = HTTP_HOME_URL;
          	              $subHIW=getSubmenu("About");
                          if(is_array($subHIW)){
                          echo"<div class=\"dropdown-content\" >
                          <ul >";
                          foreach ($subHIW as $key=>$value){
                              $submenulinks = generate2ndTierLinks("About",$value['content_id']);
                              $isdropdown   = ($submenulinks == '')?'':'class="dropdown-submenu"';
                              $isCarret     = ($isdropdown == '')?'':'<span class="caret"></span>';
                              $nofollow = ($value['nofollow']==1)?'rel = "nofollow"':'';
                              echo"<li  $isdropdown><a href=\"{$url}{$value['url_key']}\" $nofollow >{$value['title']} $isCarret</a>  $submenulinks </li>";
                          }
                          echo("</ul></div>");
                          unset($key, $value);
                                   }        
						?> 
                       </div>
              </li>
                <li><div class="dropdown">
						<a href="/blog"><div class="menuBuilder menuText">Blog</div></a>
                                          <?php
                          $url = HTTP_HOME_URL;
          	              $subBlog=getSubmenu("Blog");
                          if(is_array($subBlog)){
                          echo"<div class=\"dropdown-content\">
                          <ul >";
                          foreach ($subBlog as $key=>$value){
                              $submenulinks = generate2ndTierLinks("Blog",$value['content_id']);
                              $isdropdown   = ($submenulinks == '')?'':'class="dropdown-submenu"';
                              $isCarret     = ($isdropdown == '')?'':'<span class="caret"></span>';
                              $nofollow = ($value['nofollow']==1)?'rel = "nofollow"':'';
                              echo"<li  $isdropdown><a href=\"{$url}{$value['url_key']}\" $nofollow >{$value['title']} $isCarret</a>  $submenulinks </li>";
                          }
                          echo("</ul></div>");
                          unset($key, $value);
                                   }        
						?>
                        </div>
                           </li>
              <li class="nav-item">
                <a class="nav-link" href="contact"><div class="menuBuilder menuText">Contact Us</div></a>
              </li>
            </ul>
          </div>
          <?php 
          	   if($_SESSION['memberID']){    
?>           
       <li>
                               	<div class="sign-in-popup dropdown">
  <div class="menuBuilder menuText"><img src="https://prescriptionfiller.com/images/user-icon.png" alt="My Account" >&nbsp;My&nbsp;Account</div>
 <div class="dropdown-content">
       <ul>
       <?php $id =$_SESSION['memberID'];?>
       <li><a href="https://prescriptionfiller.com/buyers_dashboard.php?id=<?php echo $id;?>&action=prescriptions">Prescriptions</a>   </li>
              <li><a href="https://prescriptionfiller.com/buyers_dashboard.php?id=<?php echo $id;?>&action=pharmacies">Your Pharmacies</a>   </li>
                            <li><a href="https://prescriptionfiller.com/buyers_dashboard.php?id=<?php echo $id;?>&action=physicians">Your Physicians</a>   </li>
              
              
              
       <li><a href="https://prescriptionfiller.com/buyers_dashboard.php?id=<?php echo $id;?>&action=profile">Your Profile</a></li>
       <li><a href="https://prescriptionfiller.com/logout.php">Log Out</a></li>
       </ul>
       </div> 
 </li>
            <?php
	}else{ ?>
       <li>
      <?php 
	$si=(!$is_mobile)?"style=\"padding:5px 20px !important;\"" : "";
?>
		<button type="button" class="sign-in-PC" data-toggle="modal" data-target="#myModal" <?php echo $si; ?>>
    Sign In
  </button>
       </li>
    <?php   
	}
         ?> 
        </div>
      </nav>
    