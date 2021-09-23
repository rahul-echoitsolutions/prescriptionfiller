<?php require("../includes/lib/common.php"); ?>
<?php require("../includes/lib/classes/a/contents.php"); ?>
<?php require("../includes/lib/classes/a/users.php"); 
$users = new users();
$users->require_logged_in("login.php");

$contents = new contents();

////////// deleteing a record /////////
if($request->getvalue('request')!=''){
	$contents->delete($request->getvalue('request'));
    header("Location:contents.php");
    exit();
}
////////////////// end of deletion ////////////

$contentslist = $contents->getlist();

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Contents</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/contents.php">Manage contents</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>Manage Contents</h1>
			<p></p>
		</div>	
        		<?php if($contentslist!='empty')
				{
					$i=0;
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>#</th><th>Title </th><th>Description</th><th>Status</th><th>Top Image</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($contentslist as $list) { $i++; ?>
					<tr class="gradeX">
                    	<td><?php echo $i; ?></td>
						<td><?php echo $list['title'];?></td>
                        <td><?php echo strip_tags(substr($list['description'],0,100));?></td>
                        <td><?php echo $list['status'];?></td>
                        <td><?php if($list['image']!='') {?><img src="../images/cms/<?php echo $list['image'];?>" width="40"><?PHP } ?></td>
                        <td class="c"><a href="manage_contents.php?request=<?php echo $list['content_id'];?>">Update</a> 
                        <a href="contents.php?request=<?php echo $list['content_id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>