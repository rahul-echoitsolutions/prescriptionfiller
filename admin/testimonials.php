<?php require("../includes/lib/common.php"); ?>
<?php require("../includes/lib/classes/a/testimonials.php"); ?>
<?php require("../includes/lib/classes/a/users.php"); 

	$users 	=	new users();	$users->require_logged_in("login.php");
	$testimonials = new testimonials();

	############################################################################
	if($request->getvalue('request')!=''){
		$testimonials->delete($request->getvalue('request'));
	}
	############################################################################

	$testimonialslist = $testimonials->getlist();

?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Testimonials</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/testimonials.php">Manage Testimonials</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>Manage Testimonials</h1>
			<p></p>
		</div>	
        		<?php if($testimonialslist!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Name </th><th>Testimonial</th><th>Date</th><th>image</th><th>Status</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($testimonialslist as $list) { ?>
					<tr class="gradeX">
						<td><?php echo cleanit($list['name']);?></td>
                        <td><?php echo cleanit(substr($list['contents'],0,100));?></td>
                        <td><?php echo $list['add_date'];?></td>
                        <td><?php if($list['image']!='') {?>
                        <img src="../images/testimonials/<?php echo $list['image'];?>" width="60">
                         <?php }?></td>
                        <td class="c"><?php echo $list['status'];?></td>
                        <td class="c"><a href="manage_testimonials.php?request=<?php echo $list['testimonial_id'];?>">Update</a> | 
                        <a href="testimonials.php?request=<?php echo $list['testimonial_id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>