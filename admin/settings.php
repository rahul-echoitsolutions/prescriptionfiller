<?php require("../includes/lib/common.php"); ?>
<?php require("../includes/lib/classes/a/settings.php"); ?>
<?php require("../includes/lib/classes/a/users.php"); 
$users = new users();
$users->require_logged_in("login.php");
?>

<?php
$settings = new settings();

////////// deleteing a record /////////
if($request->getvalue('request')!=''){
	$settings->delete($request->getvalue('request'));
}
////////////////// end of deletion ////////////

$settingslist = $settings->getlist();

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Settings</title>
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
		
        <!-- Start of Bread Crumbs --------------->
        <div class="widget" id="widget_breadcrumb">
					<h3 class="handle">Sections</h3>
					<div>
						<ul class="breadcrumb" data-numbers="true">
							
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php">Admin Dashboard</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/settings.php">Manage settings</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>Manage Website Settings</h1>
			<p></p>
		</div>	
        		<?php if($settingslist!='empty')
				{
					$i = 0;
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th># </th><th>Unique Name</th><th>Title/Heading</th><th>Value</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($settingslist as $list) {  $i++; ?>
					<tr class="gradeX">
						<td><?php echo $i;?></td>
                        <td><?php echo $list['unique_name'];?></td>
                        <td><?php echo $list['caption'];?></td>
                        <td class="c"><?php echo substr($list['value'],0,100);?></td>
                        <td class="c"><a href="manage_settings.php?request=<?php echo $list['setting_id'];?>">Update</a> | <a href="settings.php?request=<?php echo $list['setting_id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>