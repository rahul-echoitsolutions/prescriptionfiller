<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/doctor_additional.php"); 
require("../includes/lib/classes/a/physicians.php");
$users      = new users();$users->require_logged_in("login.php");
$doctor_additional    = new doctor_additional();
$physicians    = new physicians();
$id  = $request->getvalue('request');
##################### deleting a record #####
if($id!=''){
	$doctor_additional->delete($id);
    header("Location:doctor_additional.php");
    exit;
}
#############################################

$itemList = $doctor_additional->getlist();
  
?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Clinics</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/doctor_additional.php">List Clinics</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>List Clinics</h1>
			<p></p>
		</div>	
        		<?php if($userslist!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Office Name</th><th>Phone</th><th>Fax</th><th>Contact</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($itemList as $list) { ?>
					<tr class="gradeX">
						<td><?php echo $list['office_name'];?> </td>
                        
                        <td><?php echo $list['office_phone'];?></td>
                        
                            <td><?php echo $list['office_fax'];?></td>
                        
                        <td><?php echo $list['contact_first_name']." ".$list['contact_last_name']."";?></td>
                        
                        <td class="c"><a href="manage_doctor_additional.php?request=<?php echo $list['id'];?>">Update</a> | 
                        <a href="doctor_additional.php?request=<?php echo $list['id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>