<?php 
// do not remove those leading spaces. For some inexplicable reason, the page blows up if they aren't there when using delete
require("../includes/lib/common.php");
require("../includes/lib/classes/a/applications.php"); 
require("../includes/lib/classes/a/users.php"); 

$users = new users();

$apps = new applications();

$users->require_logged_in("login.php");

$requestID = $request->getvalue('request');


////////// deleteing a record /////////
if($requestID!=''){
	$apps->delete($request->getvalue('request'));
	header("Location:vehicle-submissions.php");
}
////////////////// end of deletion ////////////

$appsList = $apps->getlist();

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Submissions</title>
	<meta name="description" content="">
	
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="css/style.css">
    <?php require("includes/main.php");?>
	
</head>
<body>
<?php //include("admin_header.php"); ?>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/applications.php">Manage Submissions</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>Submissions</h1>
			<p></p>
		</div>	
        		<?php if($appsList!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Request Type </th><th>Vehicle</th><th>Model</th><th>Name </th><th>Phone </th><th>Max Price</th><th>Date </th> <th>Action</th>
                        
					</tr>
				</thead>
				<tbody>
                
                <?php    
                
                      
                foreach($appsList as $list) { ?>
					<tr class="gradeX">
						<td><?php echo $list['application_type'];?></td>
                        <td><?php echo $list['vehicle_make'];?></td>
			<td><?php echo $list['vehicle_model'];?></td>
                        <td><?php echo $list['first_name'];?> <?php echo $list['last_name'];?></td>
                        <td><?php echo $list['home_phone'];?></td>
                        <td><?php if($list['vehicle_max_price']){ echo "$".number_format(($list['vehicle_max_price']*1),2);}?></td>
                        <td><?php echo date("M d, Y", strtotime($list['date_submitted']));?></td>
                      <td class="c"><a href="manage_submissions.php?request=<?php echo $list['id'];?>">Update</a> | 
                        <a href="<?php echo $_SERVER[PHP_SELF];?>?request=<?php echo $list['id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>