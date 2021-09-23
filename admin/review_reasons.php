<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/review_reasons.php"); 

$users      = new users();
$users->require_logged_in("login.php");
$review_reasons    = new review_reasons();
$id  = $request->getvalue('request');
##################### deleting a record #####
if($id!=''){
	$review_reasons->delete($id);
    header("Location:review_reasons.php");
    exit;
}
#############################################

$allergylist = $review_reasons->getlist();
  
?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Review Reasons</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/review_reasons.php">List Review Reasons</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>List Review Reasons</h1>
			<p></p>
		</div>	
        		<?php if($userslist!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Reason</th><th>Notes</th><th>Date</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($allergylist as $list) { ?>
					<tr class="gradeX">
					
<td><?php echo $list['reason'];?></td>
<td><?php echo $list['notes'];?></td>
<td><?php echo $list['date_entered'];?></td>

                        
                        <td class="c"><a href="manage_review_reasons.php?request=<?php echo $list['id'];?>">Update</a> | 
                        <a href="review_reasons.php?request=<?php echo $list['id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>