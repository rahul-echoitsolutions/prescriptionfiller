<?php 
	require("../includes/lib/common.php");
	require("../includes/lib/classes/a/blogs.php"); 
	require("../includes/lib/classes/a/users.php"); 
	
	$blogs			= new blogs();
	$users 			= new users();

	$users->require_logged_in("login.php");
	
    
	if($request->getvalue('request')!='') {
		$blog_id = $request->getvalue('request');	
		$blogs->load($blog_id);	
		
		if($blogs->thumb_image!='')
		if(file_exists('../images/blogs/small/' . $blogs->thumb_image)) unlink('../images/blogs/small/' . $blogs->thumb_image);
		
		if($blogs->main_image!='')
		if(file_exists('../images/blogs/large/' . $blogs->main_image)) unlink('../images/blogs/large/' . $blogs->main_image);
		
	
		$blogs->delete($blog_id);
	}
	
	

	$options 	= array();
	$options['is_admin']	=	1;
	
	$bloglist 	= $blogs->getlist($options);

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Blogs</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/blogs.php">Manage Blogs</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>Manage Blogs</h1>
            
			
			<p></p>
		</div>	
        		<?php if($bloglist!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th width="10%">Blog ID</th><th>Blog Name</th><th>Author</th> <th>Release Date</th><th>Status</th><th>Image</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($bloglist as $list) { ?>
					<tr class="gradeX">
						<td><?php echo $list['blog_id'];?> 								</td>
                        <td><?php echo substr(cleanit($list['blog_name']),0,15);?> 		</td>
                        <td>
						 
						<?php 
						if($list['agent_id']>0){?>
					   <a href="blogs.php?agent=<?php echo $list['agent_id'];?>"><?php echo $list['agent_name']; ?></a>
                       <?php }
                       		  
						if($list['agent_id']==0) {?>						
							<a href="blogs.php?agent=<?php echo $list['agent_id'];?>"><?php echo "Admin"; ?></a> <? } ?>
                        								
                        </td>
                        <td><?php echo date("F j, Y",strtotime($list['release_date']));?>		</td>
                        <td><?php echo $list['status'];?>										</td>
                        <td>
						<?php if($list['thumb_image']!='') { ?> 
                        		<img src="../images/blogs/small/<?php echo $list['thumb_image'];?>" width="40">
						<?php } ?>
                        </td>
                      	<td class="c">
                        	<a href="manage_blog.php?request=<?php echo $list['blog_id'];?>">Update</a> | 
                        	<a href="blogs.php?request=<?php echo $list['blog_id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                         </td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>