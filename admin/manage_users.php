<?php require("../includes/lib/common.php"); ?>
<?php require("../includes/lib/classes/a/users.php"); 
$users = new users();
$users->require_logged_in("index.php");
/*if($session->get('user_id')=='')
header("Location:login.php"); */
?>
<?php
$user_id = $request->getvalue('request');

if($user_id>0)
	$users->load($user_id);

$email = $request->postvalue('email');
if($email!='')
{
	
	$users->email = $request->postvalue('email');
	$users->login_name = $request->postvalue('login_name');
    $users->first_name = $request->postvalue('first_name');
    $users->last_name = $request->postvalue('last_name');
    $users->full_name = $request->postvalue('first_name')." ".$request->postvalue('last_name');
    if(!$request->postvalue('date_entered')){
    $users->date_entered = date("Y-m-d");
    }
	if($request->postvalue('password')!=''){
	$users->password = md5($request->postvalue('password'));}
	
    $users->status = $request->postvalue('status');
	$users->save();
	header("Location:users.php");
	
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage User</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/users.php">Manage users</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_users.php">Edit/Add User</a></li>
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage users</h1>
			<p></p>
		</div>	

		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" onSubmit="return validate_users();" enctype="multipart/form-data">
					<fieldset>
						<label>Manage users</label>
                        
<section><label  class="formLabel" for="first_name">First Name</label><div><input type="text" class="text" name="first_name" value="<?php echo $users->first_name; ?>"/></div></section>
<section><label  class="formLabel" for="last_name">Last Name</label><div><input type="text" class="text" name="last_name" value="<?php echo $users->last_name; ?>"/></div></section>

                        <section><label for="full_name">Full Name<br><span>Automatically Entered</span></label>
							<div><input type="text" id="full_name" name="full_name" value="<?php echo $users->full_name;?>">
							</div>
						</section>

                        <section><label for="email">Email<br><span></span></label>
							<div><input type="text" id="email" name="email" value="<?php echo $users->email;?>">
							</div>
						</section>
                        
                        <section><label for="login_name">Login Name</label>
							<div><input type="text" id="login_name" name="login_name" value="<?php echo $users->login_name;?>"></div>
						</section>
                        
                        <section><label for="password">Password<br><span></span></label>
							<div><?php echo ($users->password)?"Leave empty if you dont' want to change password":'';?><br>
                            <input type="password" id="password" name="password" value="" >
							</div>
						</section>

                        <section>
							<label for="status">Status</label>
							<div>					
								<select name="status" id="status">
									<optgroup label="Status">
										<option value="active" <?php if($users->status=='active') echo "selected";?>>Active</option>
										<option value="inactive" <?php if($users->status=='inactive') echo "selected";?>>Inactive</option>
									</optgroup>
								</select>

							</div>
						</section>
                        
                        
                        
                      

<section><label  class="formLabel" for="date_entered">Date Entered<br /><span>Automatically Entered</span></label><div><input type="text" class="text" name="date_entered" value="<?php echo $users->date_entered; ?>"/></div></section>

  
                        
                        
                        
                        
                        
                        
                        
                        
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