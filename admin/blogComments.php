<?php
		require("../includes/lib/common.php");
		require("../includes/lib/classes/a/users.php"); 		
		require("../includes/lib/classes/a/blogComments.php");
		require("../includes/lib/classes/a/blogs.php");
		
	    $blogcomments	= new blogComments();   
		$users			= new users();		
		$blogs			= new blogs();
		$users->require_logged_in("login.php");

		if($request->getvalue('request')!=''){
			$blogcomments->delete($request->getvalue('request'));
		}

       $blog_id	= $request->getvalue('blog');
		$options 	= array();
		
		if($blog_id!=''){
		
			$options['blog_id']	=	$blog_id;	
			$blogs->load($blog_id);
			
		}
		$blogcommentslist = $blogcomments->getlist($options);

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - blogcomments</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/blogcomments.php">Manage blogcomments</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>Manage Blog Comments </h1>
             
		</div>	
        		 <?php if($blog_id!=''){ ?>
            
                <h1 align="center">
                   Comments for <?php echo substr($blogs->blog_name,0,18).'..';?>  
                    <span><a href="blogComments.php" style="color:#666">View All Result</a></span>
                </h1>
                
            <?php } ?>
		</div>	
        		<?php if($blogcommentslist!='empty')
				{
					$i=0;
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Name </th><th>Blog</th><th>Message</th><th>Email</th><th>Status</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($blogcommentslist as $list) { $i++; ?>
					<tr class="gradeX">
                    	
						<td><?php echo $list['name'];?></td>
                         <td><a href="blogComments.php?blog=<?php echo $list['blog_id'];?>"><?php echo $list['blog_name']; ?></a></td>
                        <td><?php echo strip_tags(substr($list['message'],0,50));?></td>
                        <td><?php echo strip_tags(substr($list['email'],0,50));?></td>
                         <td>
						 <?php 
						 	if($list['status']==1)
							echo 'Active';
							else
							echo 'Inactive';
						 ?>
                         </td>
                        
                        <td class="c"><a href="manage_blogcomments.php?request=<?php echo $list['comment_id'];?>">Update</a> | 
                        <a href="blogComments.php?request=<?php echo $list['comment_id'];?>"
                         onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                        
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>