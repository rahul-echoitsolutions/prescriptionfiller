<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/health_issues.php"); 

$users      = new users();$users->require_logged_in("login.php");
$health_issues    = new health_issues();
$id  = $request->getvalue('request');
##################### deleting a record #####
if($id!=''){
	$health_issues->delete($id);
    header("Location:health_issues.php");
    exit;
}
#############################################

$itemList = $health_issues->getlist();
  
?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Health Issues</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/health_issues.php">List Health Issues</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>List Health Issues</h1>
			<p></p>
		</div>	
        		<?php if($itemList!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Title</th><th>Description</th><th>Date</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($itemList as $list) { ?>
					<tr class="gradeX">
						<td><?php echo $list['health_issue_title'];?> </td>
                        
                        <td><?php echo truncate($list['health_issue_description']);?></td>
                        
                        <td><?php echo $list['date'];?></td>
                        
                        <td class="c"><a href="manage_health_issues.php?request=<?php echo $list['id'];?>">Update</a> | 
                        <a href="health_issues.php?request=<?php echo $list['id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>