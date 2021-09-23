<?php 
if (!isset($head)){
    $head = '';
}

if (!isset($transform)){
    $transform = '';
}

  /*  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
*/

require_once("Mobile-Detect-2.8.34/Mobile_Detect.php");
$detect = new Mobile_Detect;
if($detect->isMobile()){
    $a=1;
    $is_mobile=1;
}

/*
session_start();

	// if($_GET['id'] AND $_SESSION['memberID']<5){
   // $_SESSION['memberID']=$_GET['id']; }
 if($_GET['id']!="" && $_SERVER['REMOTE_ADDR']!="111.119.187.20"){
    $_SESSION['memberID']=$_GET['id'];
  }
  
  */
  
 


$head.="	
<script src=\"Galleria/src/galleria.js\"></script>
<style>
form input{
    border:thin solid #ccc;
    border-radius:5px;
    padding:2px 10px 2px 15px !important;
     width: 90%;
  
    box-sizing:border-box;
    }
form  select{
    border:thin solid #ccc;
    border-radius:5px;
    padding:15px 10px 15px 15px !important;
    width: 90%;
    box-sizing:border-box;
    }
form select option span{
    font-size:50%;
    }
#form-province, #form-country{
    width: 300px;
    padding:5px 10px 5px 15px !important;
    width: 90%;
    box-sizing:border-box;
    }
    
label{
    font-weight:300;
    font-size:11px;
    }
.opt{
    font-size:50%;
    }
    .fill {
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden
}
.fill img {
    flex-shrink: 0;
    min-width: 100%;
    min-height: 100%
}
.buyerList{
    padding:10px;
    background-color:#ccc;
    border:thin solid black;
    border-radius: 10px;
    margin-bottom:10px;
    min-width:90%;
    }
.dashtab{
    padding-bottom:7px !important; 
    }
.dashtab:hover{
    background-color:#2681db;
    color: #fff;
    -o-transition:.5s ease-in-out;
-ms-transition:.5s ease-in-out;
-moz-transition:.5s ease-in-out;
-webkit-transition:.5s ease-in-out;
transition:.5s  ease-in-out;
padding-bottom:6px !important; ";

 if(isset($is_mobile) && $is_mobile){ 
    /*$head.=" width:85vw !important;
    margin-bottom: -10px !important; 
    border-bottom: 1px solid #ccc;
    ";
    */
 } 

  $head.="  }";
  
  if(isset($is_mobile) && $is_mobile){
    /*$head.="
    .dashtab{
        width:85vw;
        margin-bottom: -10px !important;
        border-bottom: 1px solid #ccc;
        
        }
        ";
   */
   
   $head.="
    .dashtab{
        
        border-bottom: 1px solid #ccc;
        
        }
        ";
   
   
   
   
  }
  
$head.="
 
 .tab_active {
  
  	background-color:#2681db !important;
    color: #fff !important;
   height:45px !important;
   overflow:hidden;
   
  }
    
    
/* start tabs */
/**
 * Responsive Bootstrap Tabs by @hayatbiralem
 * 15 May 2015
 */
@mixin ellipsis(){
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    word-wrap: normal;
    width: 100%;
}
@mixin icon-styles(){
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: 300;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
@mixin transform($transform){
  -webkit-transform: $transform;
  -moz-transform: $transform;
  -ms-transform: $transform;
  -o-transform: $transform;
  transform: $transform;
}
@media screen and (max-width: 479px) {
  .nav-tabs-responsive {
    > li {
      display: none;
      width: 23%;
      > a {
        @include ellipsis();
        width: 100%;
        text-align: center;
        vertical-align: top;
      }
      &.active {
        width: 54%;
        &:first-child {
          margin-left: 23%;
        }
      }
      &.active,
      &.prev,
      &.next {
        display: block;
      }
      &.prev,
      &.next {
        -webkit-transform: scale(0.9);
        transform: scale(0.9);
      }
      &.next > a,
      &.prev > a {
        -webkit-transition: none;
        transition: none;
        .text {
          display: none;
        }
        &:after,
        &:after {
          @include icon-styles();
        }
      }
      &.prev > a:after {
        content: \"\e079\";
      }
      &.next > a:after {
        content: \"\e080\";
      }
      &.dropdown {
        > a > .caret {
          display: none;
        }
        > a:after {
          content: \"\e114\";
        }
        &.active > a {
          &:after {
            display: none;
          }
          > .caret {
            display: inline-block;
          }
        }
        .dropdown-menu {
          &.pull-xs-left {
            left: 0;
            right: auto;
            color: #333;            
          }
          &.pull-xs-center {
            right: auto;
            left: 50%;
            @include transform(translateX(-50%));
          }
          &.pull-xs-right {
            left: auto;
            right: 0;
          }
        }
      }
    }
  }
}
.text{
      padding:10px 10px;
      font-size:1em;
  border-top:thin solid #ccc;
  border-left:thin solid #ccc;
  border-right: thin solid #ccc; 
  border-radius:5px;
  margin: 10px 2px -3px 2px;
  font-weight:300;
  color:#333;
  height:45px !important;
  }
  
  
  
  
  
#dropdown1-tab{
    color:#333 !important;
    }
#dropdown2-tab{
    color:#333 !important;
    }        
/**
 * Demo Styles
 */
.wrapper {
  /*padding: 15px 0;*/
}
.bs-example-tabs .nav-tabs {
  margin-bottom: 15px;
}
@media (max-width: 479px) {
  #narrow-browser-alert {
    display: none;
  }
}
/* end tabs */
#carImageText p{
    { 
    opacity:0;
    transition: opacity 10s;
    -webkit-transition: opacity 10s; /* Safari */
}
}
</style>

<style>
    .galleria { width: 90%; height: 300px; } 
	.galleria-container{
    height:471px !important;
	}


	
	/*.galleria-theme-classic,.galleria-theme-classic .galleria-thumbnails .galleria-image { background : #f7f7f7 !important; } */
	


</style>

<style>

#hideMe {
     -webkit-animation: seconds 1.0s forwards;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-delay: 5s;
  animation: seconds 1.0s forwards;
  animation-iteration-count: 1;
  animation-delay: 5s;
  position: relative;
  
}
@-webkit-keyframes seconds {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    left: -9999px; 
  }
}
@keyframes seconds {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    left: -9999px; 
  }
}

.offer_counter { display:inline-block; text-align:center;  border: 2px solid #2A96D0; width:25px; border-radius: 50%;color: #2A96D0 ;
}

.offer_counter_hover {

	display:inline-block; text-align:center;  border: 2px solid #FFF; width:25px; border-radius: 50%;color: #FFF ;
	
	 -o-transition:.5s ease-in-out;
-ms-transition:.5s ease-in-out;
-moz-transition:.5s ease-in-out;
-webkit-transition:.5s ease-in-out;
transition:.5s  ease-in-out;
	
}

.tab_active div {

	display:inline-block; text-align:center;  border: 2px solid #FFF; width:25px; border-radius: 50%;color: #FFF ; 
}

#load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url(https://prescriptionfiller.com/images/Spinning arrows.gif) no-repeat center center rgba(0,0,0,0.25)
}

</style>";



$footer="
<script src=\"https://unpkg.com/jquery.appendgrid@2.0.0/dist/AppendGrid.js\"></script>
";


include("includes/head.php");
include("includes/header.php");

require("includes/lib/classes/a/members.php");
require("includes/lib/classes/a/prescriptions.php"); 

$prescriptions 		= new prescriptions();

function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}
$members = new members();



$members->checkLogin($_SESSION['memberID']);


if($_SESSION['memberID']>5){
	$members->load($_SESSION['memberID']);
       }


if($request->getvalue('subaction') == 'delete') {
	
	$prescription_id = $request->getvalue('pid');
	$prescriptions->delete($prescription_id);
	echo '<script>window.location = "buyers_dashboard.php?action=prescriptions"; </script>';
	die();
}


    //$apps=str_replace("_", " ",$apps);
//$fn = $request->postvalue('vehicle_make');
if($_POST['action']=="saveDetails" OR $_POST['action']=="saveDetailsProfile"){
    
    echo "<div id=\"load\"></div>";
      $country=($request->postvalue('country')=="")? "Canada" : "";
     $full_address=str_replace(" ", "+",$request->postvalue('address')." ".$request->postvalue('city')." ".$request->postvalue('province')." ".$request->postvalue('postalcode')." ".$country);


                $pass  = $request->postvalue('password'); 

                $latlong=get_lat_long($full_address);
                $map        =   explode(',' ,$latlong);
                $mapLat     =   $map[0];
                $mapLong    =   $map[1];
                $mapCity    =   $map[2];
                $mapProv    =   $map[3];
   
                $members->id       					    =	$_SESSION['memberID'];
                $members->first_name				    =	$request->postvalue('first_name');
				$members->last_name			        	=	$request->postvalue('last_name');
				$members->address			            =	$request->postvalue('address');
				$members->email					        =	$request->postvalue('email');
                $members->city                          =   ($request->postvalue('city'))? $request->postvalue('city'): $mapCity;
                $members->province                      =   ($request->postvalue('province'))? $request->postvalue('province') : $mapProv;	                
                $members->postal_code	                =	$request->postvalue('postal_code');
                $members->country		                =	$request->postvalue('country');
                $members->phone_number                 =   $request->postvalue('phone_number');
                $members->home_phone                    =   $request->postvalue('home_phone');
                $members->latitude                      =   $mapLat;
                $members->longitude                     =   $mapLong;         

                
                 if($pass!='' ) {$members->password       = password_hash($password,PASSWORD_DEFAULT);}
                
                
                
                
                
$members->save();

if($_POST['action']=="saveDetailsProfile"){
  $success="Thank you for updating your profile";  
}else{
$success="Thank you for completing this request for quotes on your $apps->vehicle_body_type $apps->vehicle_model $apps->vehicle_category"."$apps->vehicle_body_type. Our dealer partners will be contacting you soon.";
}
echo "<meta http-equiv = \"refresh\" content = \"2; url = https://".SITE_URL."/buyers_dashboard.php?action=profile&id=".$_SESSION['memberID']."&success=$success\">";

die;
}
?>
    <!-- End Page Banner -->
    
    <img src="images/control-panel-logo.jpg" style="width: 100%;">
    
    <!-- Start Content -->


<div class="clear"></div><br />

<?php
	$dashTop=($is_mobile)? "top50": " ' style='margin-top:40px;";
?>



<div class='container <?php echo $dashTop; ?>'><h1 class='banner-heading'>My Dashboard</h1></div>





    <div id="content" >
      <div class="container" style="min-height: 500px; background-color:rgba(255,255,255,0.8); ">
          <div class="row">
          
          <?php if($_GET['success']){ ?>
          <div id="hideMe" class="container col-sm-12 top20 success" style="margin-left:20px; padding: 20px !important; max-width:90vw !important;">
          
        <?echo $_GET['success'];?>
          
          </div>
          
          <?php } ?>
          
  <div class="container col-sm-12 " >
    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs" >
    <?php
	
    $bottomBar=($is_mobile)? 'style="border-bottom:none !important; max-width: 98vw; margin-bottom: 20px;"' : 'style="border-bottom:2px solid #ccc !important;padding-bottom:3px;"';
    
?>
    
    
      <ul id="nav2" class="nav nav-tabs nav-tabs-responsive" role="tablist"  <?php echo $bottomBar; ?>>
        
       <?php
/*	 <li role="presentation" <?php  if($_GET['action']=='') echo 'class="active"';?>>
          <a href="ajax_buyers_cars.php?userid=<?php echo $_SESSION['memberID'];?>" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
            <div class="text dashtab">Your Cars</div>
          </a>
        </li>
        */        
?>
        
        <li role="presentation" <?php  if($_GET['action']=='') echo 'class="active"';?>>
                  <a href="ajax_prescriptions.php?id=<?php echo $_SESSION['memberID'];?>" role="tab" id="prescriptions" data-toggle="tab" aria-controls="samsa">

           <div class="text dashtab <?php  if($_GET['action']=='prescriptions') echo 'tab_active';?>" >Your&nbsp;Prescriptions &nbsp;&nbsp;
           
           </div> 
          </a>
        </li>
        
        
        
        
        
        
		<li role="presentation" <?php  if($_GET['action']=='pharmacies') echo 'class="active"';?>>
          <a href="ajax_pharmacies.php?ver=sl&id=<?php echo $_SESSION['memberID'];?>" role="tab" id="pharmacies" data-toggle="tab" aria-controls="samsa">
            <div class="text dashtab">Your Pharmacies</div>
          </a>
        </li>
        
        
        
         <li role="presentation" <?php  if($_GET['action']=='') echo 'class="active"';?>>
          <a href="ajax_doctors.php?id=<?php echo $_SESSION['memberID'];?>" role="tab" id="physicians" data-toggle="tab" aria-controls="doctors">
            <div class="text dashtab">Your Physicians
            </div>
          </a>
        </li>
        
        
        
        <li role="presentation"   <?php  if($_GET['action']=='') echo 'class="active"';?>>
          <a href="ajax_buyers_profile.php?id=<?php echo $_SESSION['memberID'];?>" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">
           <div class="text dashtab <?php  if($_GET['action']=='profile') echo 'tab_active';?>">Your Profile</div>
          </a>
        </li>
      </ul>
      <div id="myTabContent" class="tab-content" style="max-width: 1140px !important;">
<div id="ajax-content"  ><?php echo SITE_TITLE; ?></div>
    </div>
  </div>
</div>  
            </div>
            </div>
           </div>
</div>
</div>
		<?php include("footer.php");?>
<script type="text/javascript">
            $(document).ready(function() {
    $("#nav2 li a").click(function() {
        $("#ajax-content").empty().append("<div id='loading'><img src='images/loading.gif' alt='Loading' /></div>");
        $("#nav2 li a").removeClass('current');
        $(this).addClass('current');
        $.ajax({ url: this.href, success: function(html) {
            $("#ajax-content").empty().append(html);
            }
    });
    return false;
    });
				
	<?php  if($_GET['action'] == "") { ?>
    $("#ajax-content").empty().append("<div id='loading'><img src='images/loading.gif' alt='Loading' /></div>");
    $.ajax({ url: 'ajax_prescriptions.php?id=<?php echo $_SESSION['memberID'];?>', success: function(html) {
            $("#ajax-content").empty().append(html);
    }
    });
	<?php } ?>
});
       </script>
		<script>
			$(document).ready(function() {
				
				
				$("#samsa-tab div.dashtab").on("mouseout",function(){
					
					$("#samsa-tab div.dashtab div").removeClass('offer_counter_hover').addClass("offer_counter");
				});
				
				$("#samsa-tab div.dashtab").on("mouseover",function(){
					
					$("#samsa-tab div.dashtab div").removeClass('offer_counter').addClass("offer_counter_hover");
				});
				
				$(".dashtab").on("click",function(){ 
					$(".dashtab").removeClass("tab_active");
					$(this).addClass("tab_active");
					
				});
				
				
				var page = '<?php echo $_GET['action'];?>';
				
				//if(page == '') page = 'dealer-offers';
				if(page != '') {
					loadPage(page);
				}
	
				
			});
			function loadPage(page) {
				var prescriptions = $("#prescriptions");
				var profile	= $("#profile-tab");
				var physicians = $("#physicians");
				if(page == 'prescriptions') prescriptions.click();
				else if(page == 'profile') profile.click();
				else if(page == 'physicians') physicians.click();
                else if(page == 'pharmacies') pharmacies.click();
			}
		</script>
<?php	include("includes/footer.php");?>

<script>
document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'complete') {
         document.getElementById('interactive');
         document.getElementById('load').style.visibility="hidden";
  }
}


$(document).ready(function(){
	
	$("body").on("click",'.delete',function() {
		var con = confirm("Are you sure?");
		
		if(con == false) return false;
		else return true;
	})
});
</script>
