<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/prescriptions.php"); 
require("../includes/lib/classes/a/physicians.php"); 
require("../includes/lib/classes/a/pharmacies.php"); 

$users      = new users();$users->require_logged_in("login.php");
$prescriptions    = new prescriptions();
$physicians       = new physicians();
$pharmacies       = new pharmacies();
$id  = $request->getvalue('request');
##################### deleting a record #####
if($id!=''){
	$prescriptions->delete($id);
    header("Location:prescriptions.php");
    exit;
}
#############################################

$itemList = $prescriptions->getlist();
  
?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Prescriptions</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/prescriptions.php">List Prescriptions</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>List Prescriptions</h1>
			<p></p>
		</div>	
        		<?php if($userslist!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Physician ID</th><th>Pharmacy ID</th><th>Description</th><th>Date Processed</th><th>Status</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($itemList as $list) { ?>
					<tr class="gradeX">
                       
                        <td><?php echo $list['physician_id']." - ".$prescriptions->getPhysician($list['physician_id']);?></td>
                        <td><?php 
                        $pharmacies->load($list['pharmacy_id']);
                        
                        
                        echo $list['pharmacy_id']." - ".$pharmacies->name;?></td>
                        <td><?php echo $list['description'];?></td>
                        <td><?php echo $list['date_processed'];?></td>
                        <td><?php echo $list['status'];?></td>
                        <td class="c"><a href="manage_prescriptions.php?request=<?php echo $list['id'];?>">Update</a> | 
                        <a href="prescriptions.php?request=<?php echo $list['id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>