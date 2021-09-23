<?php require("../includes/lib/common.php"); ?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> Administration | Login</title>
	<meta name="description" content="">
<?php require("includes/header_include.php");?>	
</head>
<body id="login">
		<header>
			<div id="logo">
			</div>
		</header>
		<section id="content">
        <div class="alert warning" style="display:none;">Warning</div>
        <div class="alert success" style="display:none;">Success</div>
		<form action="" id="loginform" method="post">
        <input type="hidden" id="validate_user_url" name="validate_user_url"  value="validate_admin.php">
         	<fieldset>
				<section><label for="username">Admin User Name</label>
					<div><input type="text" id="username" name="username" autofocus></div>
				</section>
				<section><label for="password">Admin Password</label>
					<div><input type="password" id="password" name="password"></div>
				</section>
				<section>
                <input type="hidden" name="mode" value="admin"/>
                    <div><button class="fr submit" id="submit_button">Login</button></div>
				</section>
		<footer>Copyright by <?php echo SITE_URL;?> <?php echo date('Y');?></footer>
		<?php
	// Note: serialized by admin/custom.js  Validated by admin/validate_admin.php
?>
</body>
</html>