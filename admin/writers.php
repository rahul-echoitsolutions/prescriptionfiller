<?php require("../includes/lib/common.php"); ?>
<?php require("../includes/lib/classes/a/blogwriters.php"); 
require("../includes/lib/classes/a/users.php"); 
$blogwriters 	= new blogwriters();
$users 			= new users();
$users->require_logged_in("login.php");
?>
<?php
////////// deleteing a record /////////
if($request->getvalue('request')!=''){
	$blogwriters->delete($request->getvalue('request'));
}
////////////////// end of deletion ////////////

$writer_id 	= ($session->get('mode')=='writer')?$session->get('user_id'):0;
$writerlist = $blogwriters->getlist($writer_id);

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title>Blog Writers</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/blogwriters.php">Manage Blog Writers</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>Manage Blog Writers</h1>
			<p></p>
		</div>	
        		<?php if($writerlist!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Name </th><th>Email</th> <th>Active Date</th><th>Image</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($writerlist as $list) { ?>
					<tr class="gradeX">
						<td><?php echo $list['first_name'];?> <?php echo $list['last_name'];?></td>
                        <td><?php echo $list['email'];?></td>
                        <td><?php echo date("F j, Y", strtotime($list['active_date']));?></td>
                        <td><?php if($list['image']!='') { ?> <img src="../images/blogs/writers/<?php echo $list['image'];?>" width="40"><?php } ?></td>
                      <td class="c"><a href="manage_writer.php?request=<?php echo $list['writer_id'];?>">Update</a> | 
                        <a href="writers.php?request=<?php echo $list['writer_id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>