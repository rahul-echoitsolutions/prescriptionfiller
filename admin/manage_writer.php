<?php	
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/blogwriters.php"); 
$users 			= 	new users();
$blogwriter		= 	new blogwriters();
$writer_id		= 	$request->getvalue('request');
$action 		= 	$request->postvalue('action');	
if($writer_id>0)	$blogwriter->load($writer_id);

$users->require_logged_in("index.php");

if($action=='dp'){ 

	if($blogwriter->image!=''){
	if(file_exists('../images/blogs/writers/' . $blogwriter->image)) unlink('../images/blogs/writers/' . $blogwriter->image);
	}
	
	$blogwriter->image='';
	$blogwriter->save();	
}
	


if($action=='save')
{
	$blogwriter->first_name 		= $request->postvalue('first_name');
	$blogwriter->last_name 			= $request->postvalue('last_name');
	$blogwriter->email 				= $request->postvalue('email');
	$blogwriter->bio 				= $request->postvalue('textarea_wysiwyg');

	if($request->postvalue('writer_id')==0 || ($request->postvalue('writer_id')>0 && $request->postvalue('password')!=''))
	$blogwriter->password 			= md5($request->postvalue('password'));

	$blogwriter->active_date		= $request->postvalue('active_date');

		
	if($blogwriter->writer_id==0)
	$emailexists 				= 	$blogwriter->checkIfEmailExists($blogwriter->email);
	else
	$emailexists				=	0;
	
	
	if($emailexists==0) {
		if($_FILES['files']['name']!='') {
				if($blogwriter->image!='')	unlink($upload.$blogwriter->image);
				$upload				=	"../images/blogs/writers/";	
				$file_name			= 	resize_image($upload,$upload,300,$_FILES['files']);
				$newName1			= 	resize_size_step_2($upload,$upload,$file_name,$newName1="",300,$_FILES['files']);
				$blogwriter->image 	=	$newName1;
				unlink($upload.$file_name);
		}
		$blogwriter->save();
		header("Location:writers.php");
	}
}
?>
<!doctype html>
<html lang="en-us">
	<head>
	<meta charset="utf-8">
		<title>PlanA.Pro - Manage Blog Writers</title>
		<meta name="description" content="">
		
		<!-- Google Font and style definitions -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
		<link rel="stylesheet" href="css/style.css">
    	<?php require("includes/main.php");?>
	</head>
<body>
<?php include("admin_header.php"); ?>

		<nav><?php include("left_navigation.php");?></nav>
		<section id="content">
		<div class="widget" id="widget_breadcrumb">
		<h3 class="handle">Sections</h3>
		<div>
							<ul class="breadcrumb" data-numbers="true">
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php">Admin Dashboard</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/blog_writers.php">Manage blogwriter</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_writer.php">Edit/Add Blog Writer</a></li>
							</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<?php if(@$emailexists==1) {?><div class="alert warning">Email already Exists</div><?php } ?>                
		<div class="g12 nodrop">
			<h1>Manage Blog Writer</h1>
			<p></p>
		</div>	

		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" onSubmit="return validate_blogwriter();" 
        enctype="multipart/form-data">
        
					<fieldset>
						<label>Manage Blog Writers</label>

                        <section>
                        	<label for="first_name">First Name<br><span></span></label>
							<div>
                            	<input type="text" id="first_name" name="first_name" value="<?php echo $blogwriter->first_name;?>">
							</div>
						</section>

                        <section>
                        	<label for="last_name">Last Name<br><span></span></label>
							<div>
                            	<input type="text" id="last_name" name="last_name" value="<?php echo $blogwriter->last_name;?>">
							</div>
						</section>
                        
                        <section>
                        	<label for="email">Email<br><span></span></label>
							<div>
                            	<input type="email" id="email" name="email" value="<?php echo $blogwriter->email;?>">
							</div>
						</section>
                        

                        <section>
                        	<label for="password">Password<br><span><?php if($blogwriter->writer_id>0) echo "Leave empty if Don't want to Change Password";?></span></label>
							<div>
                            	<input type="text" id="password" name="password" value="<?php //echo $blogwriter->password;?>">
							</div>
						</section>

                        <?php if($session->get('mode')!='writer'){ ?>
                        <section>
                        	<label for="active_date">Active From<br><span></span></label>
							<div>
                            	<input type="text" id="active_date" name="active_date" value="<?php echo $blogwriter->active_date;?>" class="date">
							</div>
						</section>
                        <?php } else { ?>
                        <input type="hidden" name="active_date" id="active_date" value="<?php echo $blogwriter->active_date;?>">
                        <?php } ?>

                        <section>
                        		<label for="bio">Bio<br><span></span></label>
									<div>
                            			<textarea id="textarea_wysiwyg" name="textarea_wysiwyg" <? /*class="html" */?> rows="12"><?php echo cleanit($blogwriter->bio);?></textarea>
                                        
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


                        <section>
                        	<label for="image">Image<br><span></span></label>
							<div>
                                <input type="file" id="files" name="files"/>
                                <?php if($blogwriter->image!=''){ ?> 
                                <br clear="all">
                                <img src="../images/blogs/writers/<?php echo $blogwriter->image;?>" width="70"><br>
                                <a href="javascript:delete_pic();">Delete</a>
                                
                                <?php } ?>
							</div>
						</section>

                        <section>
							<div>
                            	<button class="reset">Reset</button>
                            	<button class="submit" name="manage_writer_button" value="manage_writer_button">Submit</button>
                            </div>
						</section>
                     </fieldset>
                     <input type="hidden" name="action" id="action" value="">
                     <input type="hidden" id="writer_id" name="writer_id" value="<?php echo $blogwriter->writer_id;?>">
          </form>              
			</section>
		<?php include("footer.php");?>
        
        
        <script>
		$('form').wl_Form({
			ajax:false
		});
		</script>
        
        <script>
		
function validate_blogwriter()
{
	var fname 		= 	$("#first_name").val();
	var bio 		= 	$("#textarea_wysiwyg").val();
	var lname 		= 	$("#last_name").val();
	var email 		= 	$("#email").val();
	var pass 		= 	$("#password").val();
	var active_date = 	$("#active_date").val();
	var writer_id	=	$("#writer_id").val();
	
	
	if(fname==''){
		alert("Please Enter First Name");
		$("#first_name").focus();
		$(".wl_formstatus").hide();
		return false;
	}

	if(lname==''){
		alert("Please Enter Last Name");
		$("#last_name").focus();
		$(".wl_formstatus").hide();
		return false;
	}

	if(email==''){
		alert("Please Enter Valid Email");
		$("#email").focus();
		$(".wl_formstatus").hide();
		return false;
	}

	if(password=='' && writer_id==0){
		alert("Please Enter Password");
		$("#password").focus();
		$(".wl_formstatus").hide();
		return false;
	}

	if(active_date==''){
		alert("Please Enter Active Date");
		$("#active_date").focus();
		$(".wl_formstatus").hide();
		return false;
	}

	else if(bio==''){
		alert("Please Enter Biography for Writer");
		$("#textarea_wysiwyg").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	else {
		
		$("#action").val('save');
		$("form").submit();
	}
	
	
		
}

		function delete_pic(){ 
			$("#action").val('dp');
			$("#form").submit();
		}
		
</script>
</body>
</html>