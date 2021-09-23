<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/testimonials.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/blogComments.php");

$users              = new users();$users->require_logged_in("login.php");
$blogcomments 		= new blogComments();
$blogcomments_id	= $request->getvalue('request');

if($blogcomments_id>0)
	$blogcomments->load($blogcomments_id);

$name = $request->postvalue('name');
if($name!='')
{
	$blogcomments->name 		= $request->postvalue('name');
	$blogcomments->email 		= $request->postvalue('email');	
	$blogcomments->message 		= $request->postvalue('textarea_wysiwyg');    
	$blogcomments->status		= $request->postvalue('status');
	$blogcomments->save();
	header("Location:blogComments.php");
	
}

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?>- Manage Message</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/blogcomments.php">Manage blogcomments</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_blogcomments.php">Add Message</a></li>
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Message</h1>
			<p></p>
		</div>	

		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" enctype="multipart/form-data">
					<fieldset>
						<label>Manage Message</label>
                        
                       
						<section><label for="text_field">Sender Name</label>
							<div><input type="text" id="sender_name" name="name" value="<?php echo $blogcomments->name;?>" required></div>
						</section>
                        
						<section><label for="text_field">Sender Email</label>
							<div><input type="text" id="sender_email" name="email" value="<?php echo $blogcomments->email;?>" required></div>
						</section>
                        
                        
                        
                        <section><label for="textarea_auto">Description<br><span></span></label>
							<div><textarea id="textarea_wysiwyg" name="textarea_wysiwyg"  rows="12" required><?php echo $blogcomments->message;?>
                            
                           </textarea>
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
                        
                        

                        
					<section><label for="text_field">Date</label>
					<div><input type="text"  id="add_date" name="add_date" value="<?php echo $blogcomments->date;?>" class="date" required></div>
						</section>
                        <input  type="hidden" name="action" value="save" id="action">
                        
                     <section>
							<label for="status">Status</label>
							<div>					
								<select name="status" id="status" required>
									<optgroup label="Status">
                                    <option value="">Select</option>
										<option value="1" <?php if($blogcomments->status==1) echo "selected";?>>Active</option>
										<option value="0" <?php if($blogcomments->status==0) echo "selected";?>>Inactive</option>
									</optgroup>
								</select>

							</div>
						</section>
                        
                        <section>
							<div><button class="reset">Reset</button><button class="submit" name="manage_service_button" 
                            value="manage_service_button">Submit</button></div>
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