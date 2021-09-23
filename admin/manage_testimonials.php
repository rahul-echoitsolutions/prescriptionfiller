<?php require("../includes/lib/common.php"); ?>
<?php require("../includes/lib/classes/a/testimonials.php"); ?>
<?php require("../includes/lib/classes/a/users.php"); 
	$users = new users();
	$users->require_logged_in("login.php");
?>
<?php
	$testimonials 	= new testimonials();
	$testimonial_id = $request->getvalue('request');

	if($testimonial_id>0)	$testimonials->load($testimonial_id);

	
	############### delete photo #############################
	$name 			= $request->postvalue('name');
	$delete_photo 	= $request->getvalue('delete_photo');
	if($delete_photo == 1 ) {
		
		if (file_exists('../images/testimonials' . $testimonials->image)) unlink('../images/testimonials' . $testimonials->image);
		$testimonials->image = '';
		$testimonials->save();
		header("Location:manage_testimonials.php?request={$testimonials->testimonial_id}");
		exit();
	}
	##########################################################
	

if($name!='')
{
	$testimonials->name 		= $request->postvalue('name');
	$testimonials->contents 	= cleanit($request->postvalue('textarea_wysiwyg'));
	$testimonials->status 		= $request->postvalue('status');
	$testimonials->contact 		= $request->postvalue('contact');
	$testimonials->add_date 	= ($request->postvalue('add_date'))?$request->postvalue('add_date'):date('Y-m-d H:i:s');

	############################################################################
			if($_FILES['main_image']['tmp_name'])
			{
				if($testimonials->image!=''){
					if (file_exists('../images/testimonials' . $testimonials->image)) unlink('../images/testimonials' . $testimonials->image);
				}
			
			
			$upload="../images/testimonials";
			$file_name = resize_image($upload,$upload,200,$_FILES['main_image']);
			#echo $file_name;
			#die();
			$newName1 = resize_size_step_2($upload,$upload,$file_name,$newName1="",200,$_FILES['main_image']);
			//$newName12 = resize_size_step_2("../../files/spotlight","../../files/spotlight",$file_name,$newName1,200,$_FILES['logo_image']);
			unlink("$upload/$file_name");
			
			$testimonials->image = $newName1;
			}
			
	############################################################################

	
	$testimonials->save();
	header("Location:testimonials.php");
}

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Testimonials</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/testimonials.php">Manage testimonials</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_testimonials.php">Add Testimonial</a></li>
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Testimonial</h1>
			<p></p>
		</div>	

		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" onSubmit="return validate_testimonials();" enctype="multipart/form-data">
					<fieldset>
						<label>Manage Testimonial</label>
						<section><label for="text_field">Name</label>
							<div><input type="text" id="name" name="name" value="<?php echo $testimonials->name;?>"></div>
						</section>
                        
						<section><label for="text_field">About<br /><span style="font-size: 80%;">e.g. "Bought Ford Explorer in Kelowna"</span></label>
							<div><input type="text" id="contact" name="contact" value="<?php echo $testimonials->contact;?>"></div>
						</section>

                        
                        <section><label for="textarea_auto">Description<br><span></span></label>
							<div><textarea id="textarea_wysiwyg" name="textarea_wysiwyg" rows="12"><?php 
							echo cleanit($testimonials->contents);?></textarea>
                            <script language="javascript" type="text/javascript">
							var oEdit2 = new InnovaEditor("oEdit2");
							oEdit2.width = 900;
							oEdit2.height = 400;
							oEdit2.groups = [
								["group1", "", ["Bold", "Italic", "Underline", "FontDialog", "ForeColor", "TextDialog", "RemoveFormat"]],
								["group2", "", ["Bullets", "Numbering", "JustifyLeft", "JustifyCenter", "JustifyRight"]],
								["group3", "", ["LinkDialog", "ImageDialog", "YoutubeDialog", "TableDialog", "Emoticons"]],
								["group4", "", ["Undo", "Redo", "FullScreen", "SourceDialog"]]
								];
							oEdit2.css = "styles/default.css";
							oEdit2.fileBrowser = "/LiveEditor/assetmanager/asset.php";
							oEdit2.REPLACE("textarea_wysiwyg");
							</script>
                            
							</div>
						</section>
                        
                        <section><label for="main_image">Image<br><span>Main Title Image</span></label>
						<div><input type="file" id="main_image" name="main_image">
                        <?php if($testimonials->image!='') {?>
                        <img src="../images/testimonials/<?php echo $testimonials->image;?>" width="60"> <br>
                        <a href="javascript:;" onClick="delete_photo(<?php echo $testimonials->testimonial_id;?>);">Delete</a>
                         <?php }?>
							</div>
						</section>

                        
					<section><label for="text_field">Date</label>
					<div><input type="text" id="add_date" name="add_date" value="<?php echo $testimonials->add_date;?>" class="date"></div>
						</section>
                        
                        <section>
							<label for="status">Status</label>
							<div>					
								<select name="status" id="status">
									<optgroup label="Status">
										<option value="active" <?php if($testimonials->status=='active') echo "selected";?>>Active</option>
										<option value="inactive" <?php if($testimonials->status=='inactive') echo "selected";?>>Inactive</option>
									</optgroup>
								</select>

							</div>
						</section>
                        
                        <section>
							<div><button class="reset">Reset</button><button class="submit" name="manage_service_button" value="manage_service_button">Submit</button></div>
						</section>
                     </fieldset>
          </form>              
			</section>
		<?php include("footer.php");?>
        
        
        <script>
		$('form').wl_Form({
			ajax:false
		});
		
		function delete_photo(id) {
			
			if(confirm("Are you sure you want to delete this photo? ")==false) 
			return false;
			
			window.location = 'manage_testimonials.php?delete_photo=1&request=<?php echo $testimonial_id;?>';
		}
		</script>
</body>
</html>