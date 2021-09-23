<?php require("../includes/lib/common.php"); ?>
<?php require("../includes/lib/classes/a/applications.php"); 
require("../includes/lib/classes/a/users.php"); 
$users = new users();
$apps = new applications();
$users->require_logged_in("login.php");
?>
<?php
////////// deleteing a record /////////
if($request->getvalue('request')!=''){
	$apps->delete($request->getvalue('request'));
	header("Location:applications.php");
}
////////////////// end of deletion ////////////

$appsList = $apps->getlist();

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Applicationts</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/applications.php">Manage Submissions</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>Applications</h1>
			<p></p>
		</div>	
        		<?php if($appsList!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>App Type </th><th>Loan Type</th><th>Name </th><th>Phone </th><th>Loan Amount</th><th>Date </th> <th>Action</th>
                        
					</tr>
				</thead>
				<tbody>
                <?php foreach($appsList as $list) { ?>
					<tr class="gradeX">
						<td><?php echo $list['application_type'];?></td>
                        <td><?php echo $list['application_type'];?></td>
		
                        <td><?php echo $list['first_name'];?> <?php echo $list['last_name'];?></td>
                        <td><?php echo $list['work_phone'];?></td>
                        <td><?php if($list['maxPrice']){ echo "$".number_format(($list['loan_amount']*1),2);}?></td>
                        <td><?php echo $list['dateentered'];?></td>
                      <td class="c"><a href="manage_applications.php?request=<?php echo $list['id'];?>">Update</a> | 
                        <a href="applications.php?request=<?php echo $list['id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>