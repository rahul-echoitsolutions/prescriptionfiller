<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/health.php"); 
require("../includes/lib/classes/a/health_issues.php"); 
require("../includes/lib/classes/a/members.php"); 

$users              = new users();$users->require_logged_in("login.php");
$health             = new health();
$health_issues      = new health_issues();
$members            = new members();
$id  = $request->getvalue('request');
##################### deleting a record #####
if($id!=''){
	$health->delete($id);
    header("Location:health.php");
    exit;
}
#############################################

$itemList = $health->getlist();
  
?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Health</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/health.php">List Health</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>List Health</h1>
			<p></p>
		</div>	
        		<?php if($itemList!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>User ID</th><th>Health ID</th><th>Date</th><th>Notes</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($itemList as $list) { ?>
					<tr class="gradeX">
						<td><?php 
                        
                        $members->load($list['user_id']);
                        
                        
                        echo $members->first_name." ".$members->last_name;?></td>
                        
                        <td><?php 
                        
                        $health_issues->load($list['health_id']);
                        
                        
                        echo $health_issues->health_issue_title;?></td>
                        
                        
                        <td><?php echo $list['date'];?></td>
                        <td><?php echo truncate($list['notes'],50);?></td>
                        
                        <td class="c"><a href="manage_health.php?request=<?php echo $list['id'];?>">Update</a> | 
                        <a href="health.php?request=<?php echo $list['id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>