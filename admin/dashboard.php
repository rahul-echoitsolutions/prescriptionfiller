<?php require("../includes/lib/common.php"); ?>
<?php require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/dealers.php");
require("../includes/lib/classes/a/dealer_quotes.php");
require("../includes/lib/classes/a/points.php");
require("../includes/lib/classes/a/settings.php");
$dealers = new dealers();
$users = new users();
$quotes = new quotes();
$points = new points();
$settings = new settings();


if($_SESSION['mode']=="admin"){
$users->require_logged_in("login.php");
}elseif($_SESSION['mode']=="dealer"){
$users->require_logged_in("login_dealer.php");
}else{
    header("Location:http://".THIS_DOMAIN);
}
$dealers->load($_SESSION['user_id']);

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	
	<title><?PHP echo SITE_TITLE;?> - Dashboard</title>
	
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
						
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php">Dashboard</a></li>
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1 style="display: inline;">Dashboard</h1><br />
            <?php if($session->get('mode')!='admin') { ?>
             <div style="display:inline; float: left; padding:10px; width:220px; height:110px; border:thin solid #ccc; text-align: center; margin-bottom:20px;"><h3>YOUR CARCOINS</h3>
              <div style="font-size: 60px; color: green; margin-top:-15px; letter-spacing: -6px; font-family:'PT Sans', sans-serif !important; "><?php  //echo $points->getGrandTotal($dealers->id, $settings->get_value('points_for_quote'));
				
					echo $points->getDealerFreePoints($dealers->id);
				  ?>
            </div><div style=" font-size: 10px; line-spacing:6px;margin-top: -10px; margin-bottom:0px;">Based on <?echo ($points->quoteCoinCount($dealers->id));?> unique <?php echo ($points->quoteCoinCount($dealers->id)==1)? "quote" : "quotes";?>  less your redemptions plus your signing bonus or other awarded points.</div>
            
            
            </div> <?php } ?>
			
		</div>	

		
		<div class="g6 widgets">
		
			<div class="widget number-widget" id="widget_number">
				<h3 class="handle">Welcome <?php echo $dealers->company;?> - <?php echo $dealers->company_trade_name;?></h3>
				<?php
                /*
	<!--<div>
                <p> Please use left side menu to perform different tasks.
					<ul>
						<li><a href="users.php"><span>Users</span> </a></li>
						<li><a href="services.php"><span>Services</span> </a></li>
						<li><a href="brands.php"><span>Brands</span> </a></li>
						<li><a href="sliders.php"><span>Sliders</span></a></li>
						<li><a href="contents.php"><span>Content Pages</span> </a></li>
                        <li><a href="settings.php"><span>Settings</span> </a></li>
                        <li><a href="offers.php"><span>Offers/Coupons</span> </a></li>
					</ul>
				</div>-->
                */
?>
			</div>
		</div>
		
		
			</section>
		<?php include("footer.php");?>
</body>
</html>