<?php require("../includes/lib/common.php"); ?>
<?php require("../includes/lib/classes/a/settings.php"); ?>
<?php require("../includes/lib/classes/a/users.php"); 
$users = new users();
$users->require_logged_in("login.php");
?>

<?php
$settings = new settings();
$setting_id = $request->getvalue('request');

if($setting_id>0)
	$settings->load($setting_id);

$unique_name = $request->postvalue('unique_name');
if($unique_name!='')
{

	$settings->unique_name = $request->postvalue('unique_name');
	$settings->caption = $request->postvalue('caption');
	$settings->value = $request->postvalue('value');
	$settings->save();
			  echo'
		  <meta http-equiv="refresh" content="1; url=settings.php">
<script>
  window.location.href = "settings.php"
</script>
If you are not redirected automatically, follow the <a href="settings.php">link</a>';
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Setting</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/settings.php">Manage Settings</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_settings.php">Edit/Add Setting</a></li>
						</ul>
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage settings</h1>
			<p></p>
		</div>	

		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" onSubmit="return validate_settings();" enctype="multipart/form-data">
					<fieldset>
						<label>Manage Settings</label>
						<section><label for="text_field">Unique Name</label>
							<div><input type="text" id="unique_name" name="unique_name"  value="<?php echo $settings->unique_name;?>" <?php if($setting_id>0) echo "readonly";?>></div>
						</section>
                        
                        <section><label for="textarea_auto">Caption/Title<br><span></span></label>
							<div><input type="text" id="caption" name="caption" value="<?php echo $settings->caption;?>">
							</div>
						</section>
                        
                        <section><label for="main_image">Value<br><span></span></label>
						<div><input type="text" id="value" name="value" value="<?php echo $settings->value;?>">
							</div>
						</section>
<!--                        <section>
							<label for="status">Status</label>
							<div>					
								<select name="status" id="status">
									<optgroup label="Status">
										<option value="active" <?php if($settings->status=='active') 		echo "selected";?>>Active</option>
										<option value="inactive" <?php if($settings->status=='inactive') 	echo "selected";?>>Inactive</option>
									</optgroup>
								</select>

							</div>
						</section>
-->                        
                        
                        <section>
							<div><button class="reset">Reset</button><button class="submit" name="manage_service_button" value="manage_service_button">Submit</button></div>
						</section>
                     </fieldset>
          </form>              
			</section>
		<?php include("footer.php");?>
        
        
        <script>
		$('form').wl_Form({
			ajax:false
		});
		</script>
</body>
</html>