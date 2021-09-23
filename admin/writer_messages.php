<?php
	require("../includes/lib/common.php");
	require("../includes/lib/classes/a/blogwriters.php"); 
	require("../includes/lib/classes/a/users.php"); 
	require("../includes/lib/classes/a/blogs.php"); 
	require("../includes/lib/classes/a/writermessages.php"); 
	
		
	$blogwriters 	= new blogwriters();
	$users 			= new users();
	$blogs			= new blogs();
	$msgs			= new writermessages();
	$users->require_logged_in("login.php");
	

?>
<?php
////////// deleteing a record /////////
if($request->getvalue('request')!=''){
	$msgs->delete($request->getvalue('request'));
}
////////////////// end of deletion ////////////

$msglist = $msgs->getlist();

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title>Messages</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/writer_messages.php">Manage Messages</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>Manage Messages</h1>
			<p></p>
		</div>	
        		<?php if($msglist!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Sender Name </th><th> Sender Email</th> <th>Blog Name</th><th>Author Name</th><th>Date Sent</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($msglist as $list) { ?>
					<tr class="gradeX">
						<td>
							<?php echo $list['sender_name'];?>
                        </td>
                        <td>
							<?php echo $list['sender_email'];?>
                        </td>
                        <td>
                        	<a href="manage_blog.php?request=<?php echo $list['blog_id'];?>"><?php echo $list['blog_name'];?></a>
                        </td>
                        <td>
							<?php echo date("F j, Y, g:i a",strtotime($list['date_sent']));?>
                        </td>
                        <td>
                        	<a href="manage_writer.php?request=<?php echo $list['writer_id'];?>"><?php echo $list['writer_name'];?></a>
                       	</td>
                      	<td class="c">
                      		<a href="manage_message.php?request=<?php echo $list['message_id'];?>">Update</a> | 
                        	<a href="writer_messages.php?request=<?php echo $list['message_id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
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