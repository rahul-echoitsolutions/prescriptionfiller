<?php	
		require("../includes/lib/common.php");
		require("../includes/lib/classes/a/users.php"); 
		require("../includes/lib/classes/a/blogcategory.php");


		$users			= new users();	$users->require_logged_in("index.php");

		$blogcategory	= new blogcategory();
		
		
		$category_id 	= $request->getvalue('request');
		
		if($category_id>0)	$blogcategory->load($category_id);
			
		$action 		= $request->getvalue('action');	
		if($action=='dp'){ 
		
			if($blogcategory->image_name!=''){
				if (file_exists('../images/blogs/cats/' . $blogcategory->image_name)) 
					unlink('../images/blogs/cats/' . $blogcategory->image_name);
			}
			$blogcategory->image_name='';
			$blogcategory->save();	
		}
			
		
		$category_name = $request->postvalue('category_name');
		if($category_name!='')
		{
			
			if($_FILES['files']['name']!='') {
		
					$upload="../images/blogs/cats/";	
					if($blogcategory->image_name!='')
					unlink($upload.$blogcategory->image_name);
		
					$file_name	= resize_image($upload,$upload,300,$_FILES['files']);
					$newName1	= resize_size_step_2($upload,$upload,$file_name,$newName1="",300,$_FILES['files']);
					$blogcategory->image_name = $newName1;
					unlink($upload.$file_name);
			}
			$blogcategory->category_name 	= $request->postvalue('category_name');
			$blogcategory->status 			= $request->postvalue('status');
			$blogcategory->agent_id			= $request->postvalue('agent_id');
			$blogcategory->create_date		= date("Y-m-d H:i:s");
			$blogcategory->save();
			header("Location:blog_cats.php");
			
		}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Blog Category</title>
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
		<div class="widget" id="widget_breadcrumb">
					<h3 class="handle">Sections</h3>
					<div>
						<ul class="breadcrumb" data-numbers="true">
							
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php">Admin Dashboard</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/blog_cats.php">Manage blogcategory</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_blogcategory.php">Edit/Add Blog Category</a></li>
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Blog Category</h1>
			<p></p>
		</div>	

		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" onSubmit="return validate_blogcategory();" enctype="multipart/form-data">
					<fieldset>
						<label>Manage Blog Category</label>
                        
                        

                        <section><label for="category_name">Category Name<br><span></span></label>
							<div><input type="text" id="category_name" name="category_name" value="<?php echo $blogcategory->category_name;?>">
							</div>
						</section>

                        <section><label for="building_description">Category Image<br><span></span></label>
							<div>
                            <input type="file" id="files" name="files"/>
							<?php if($blogcategory->image_name!=''){ ?> 
                            <br clear="all">
                            <img src="../images/blogs/cats/<?php echo $blogcategory->image_name;?>" width="70"><br>
                            <a href="manage_blog_cats.php?action=dp&request=<?php echo $request->getvalue('request');?>">Delete</a>
                            
                            <?php } ?>
							</div>
						</section>
                        
                        
                         <section>
							<label for="status">Status</label>
							<div>					
								<select name="status" id="status" required>
									<optgroup label="Status">
										<option value="active" <?php 	if($blogcategory->status=='active') echo "selected";?>>Active</option>
										<option value="inactive" <?php 	if($blogcategory->status=='inactive') echo "selected";?>>Inactive</option>
									</optgroup>
								</select>

							</div>
						</section>

                        <section>
							<div>
                            <button class="reset">Reset</button>
                            <button class="submit" name="manage_building_button" value="manage_building_button">Submit</button></div>
						</section>
                     </fieldset>
          </form>              
			</section>
		<?php include("footer.php");?>
        
        
        <script>
		$('form').wl_Form({
			ajax:false
		});
		</script>
</body>
</html>