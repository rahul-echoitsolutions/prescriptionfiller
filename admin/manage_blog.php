<?php
	require("../includes/lib/common.php");
	require("../includes/lib/classes/a/users.php"); 
	require("../includes/lib/classes/a/blogcategory.php"); 
	require("../includes/lib/classes/a/blogs.php"); 

	
	$users 			= 	new users();
	$blogs			=	new blogs();
	$category		=	new blogcategory();

	$blog_id		= 	$request->getvalue('request');
	$action 		= 	$request->postvalue('action');	


	if($blog_id>0)	$blogs->load($blog_id);
	$users->require_logged_in("index.php");

	if($action=='dp_small'){ 
	
		if($blogs->thumb_image!=''){
		if(file_exists('../images/blogs/small/' . $blogs->thumb_image)) unlink('../images/blogs/small/' . $blogs->thumb_image);
		}
		
		$blogs->thumb_image='';
		$blogs->save();	
	}


	if($action=='dp_large'){ 

	if($blogs->main_image!=''){
	if(file_exists('../images/blogs/large/' . $blogs->main_image)) unlink('../images/blogs/large/' . $blogs->main_image);
	}
	
	$blogs->main_image='';
	$blogs->save();	
	}
	


if($action=='save')
{
	
	
	if($_FILES['thumb_image']['name']!='') {
		$upload				=	"../images/blogs/small/";	
		if($blogs->thumb_image!='')	unlink($upload.$blogs->thumb_image);
		$file_name			= 	resize_image($upload,$upload,300,$_FILES['thumb_image']);
		$newName1			= 	resize_size_step_2($upload,$upload,$file_name,$newName1="",200,$_FILES['thumb_image']);
		$blogs->thumb_image	=	$newName1;
		unlink($upload.$file_name);
		
	}
	
	if($_FILES['main_image']['name']!='') {
		$upload				=	"../images/blogs/large/";	
		if($blogs->main_image!='')	unlink($upload.$blogs->main_image);
		$file_name			= 	resize_image($upload,$upload,500,$_FILES['main_image']);
		$newName1			= 	resize_size_step_2($upload,$upload,$file_name,$newName1="",300,$_FILES['main_image']);
		$blogs->main_image 	=	$newName1;
		unlink($upload.$file_name);
		
	}

	
	$blogs->agent_id 			= $request->postvalue('agent_id'); # id = 0 means it's ABL-WEB.com
	$blogs->blogcategory_id 	= $request->postvalue('cat_id');
	$blogs->blog_name 			= $request->postvalue('blog_name');
	$blogs->short_desc 			= $request->postvalue('short_desc');
	$blogs->description 		= $request->postvalue('textarea_wysiwyg');
	$blogs->tags		 		= $request->postvalue('tags');
	$blogs->metro_area	 		= $request->postvalue('metro_area');
	$blogs->release_date 		= $request->postvalue('release_date');
	$blogs->expire_date 		= $request->postvalue('expire_date');
	$blogs->is_featured 		= $request->postvalue('is_featured');
	$blogs->status 				= $request->postvalue('status');
	
	if($blogs->blog_id>0)
	$blogs->update_date			= date('Y-m-d H:i:s');
	else
	$blogs->created_date		= date('Y-m-d H:i:s');
	
	$blogs->active_date			= $request->postvalue('active_date');
	$blogs->save();
	header("Location:blogs.php");
	
}
?>
<!doctype html>
<html lang="en-us">
	<head>
	<meta charset="utf-8">
		<title><?PHP echo SITE_TITLE;?> - Manage Blog</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/blogs.php">Manage Blogs</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_blog.php">Edit/Add Blog</a></li>
							</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Blog</h1>
			<p></p>
		</div>	

		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" 
        onSubmit="return validate_blog();" enctype="multipart/form-data">
					<fieldset>
						<label>Manage Blog</label>
                        
                        <section>
                        	<label for="first_name">Author Name<br><span>Select Author & Category</span></label>
							<div>
                  
                            	<select id="agent_id" name="agent_id">
                                <option value="">Select Blog Writer</option>
                                <option value="0" selected>Admin</option>
                                </select>
                                
                                <select id="cat_id" name="cat_id">
                                <option value="">Select Blog Category</option>
                                <?php 
								$options['sort_by']	=	'category_name';
								$options['agent_id']=	$blogs->agent_id;
								$categories =  $category->getlist($options);
								foreach($categories as $list) {
									$cat_id 		= $list['blogcategory_id'];
									
									$cat_name 		= $list['category_name'];
								?>
                                <option value="<?php echo $cat_id;?>" <?php if($cat_id==$blogs->blogcategory_id) echo 'selected="selected"';?>><?php echo $cat_name;?></option>
                                <?php } ?>
                                </select>
							</div>
						</section>
                      
                        <section>
                        	<label for="first_name">Blog Name<br><span></span></label>
							<div>
                            	<input type="text" id="blog_name" name="blog_name" value="<?php echo cleanit($blogs->blog_name);?>">
							</div>
						</section>

                        <section>
                        		<label for="bio">Short Description<br><span></span></label>
									<div>
                            			<textarea id="short_desc" name="short_desc" <?php /*class="html"*/?> rows="12"><?php echo cleanit($blogs->short_desc);?></textarea>
                                        <?php
	// removed "YoutubeDialog", "ImageDialog", 
?>
										<script>
                                        var oEdit1 = new InnovaEditor("oEdit1");
                                        oEdit1.width = 900;
                                        oEdit1.height = 300;
                                        oEdit1.groups = [
															["group1", "", ["Bold", "Italic", "Underline", "FontDialog", "ForeColor", "TextDialog", "RemoveFormat"]],
															["group2", "", ["Bullets", "Numbering", "JustifyLeft", "JustifyCenter", "JustifyRight"]],
															["group3", "", ["LinkDialog", "ImageDialog", "YoutubeDialog", "TableDialog", "Emoticons"]],
															["group4", "", ["Undo", "Redo", "FullScreen", "SourceDialog"]]
															];

										oEdit1.enableFlickr = false;
										oEdit1.disableFocusOnLoad = true; 
										oEdit1.css = "../LiveEditor/LiveEditor/styles/default.css";
										oEdit1.fileBrowser = "../assetmanager/asset.php";
                                        oEdit1.REPLACE("short_desc");
                                        </script>

                            		</div>
						</section>
                        
                        <section>
                        		<label for="bio">Long Description<br><span></span></label>
									<div>
                            			<textarea id="textarea_wysiwyg" name="textarea_wysiwyg" <? /*class="html" */?> rows="12">
										<?php echo cleanit($blogs->description);?></textarea>
                                        
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
								 
			oEdit2.enableFlickr = false;
 		    oEdit2.disableFocusOnLoad = true; 
            oEdit2.css = "../LiveEditor/LiveEditor/styles/default.css";
			oEdit2.fileBrowser = "../assetmanager/asset.php";
            oEdit2.REPLACE("textarea_wysiwyg");
        	</script>
                            		</div>
						</section>
                        
                        
                        
                        <section>
                        	<label for="active_date">Post Tags :<br><span>'comma' seperated tags</span></label>
							<div>
                            	<input type="text" name="tags" id="tags" value="<?php echo cleanit($blogs->tags);?>" >
 							</div>
						</section>
                        
                        
                        <section>
                        	<label for="active_date">Associate a Metro Area :<br><span></span></label>
							<div>
                            	<input type="text" name="metro_area" id="metro_area" value="<?php echo cleanit($blogs->metro_area);?>" >
 							</div>
						</section>
                        

                        <section>
                        	<label for="thumb_image">Thumb Image<br><span></span></label>
							<div>
                            	<input type="file" id="thumb_image" name="thumb_image" value="<?php echo $blogs->thumb_image;?>">
                                
                                  <?php if($blogs->thumb_image!=''){ ?> 
                                <br clear="all">
                                <img src="../images/blogs/small/<?php echo $blogs->thumb_image;?>" width="70"><br>
                                <a href="javascript:delete_pic_small();" onClick="return confirm('Are you sure you want to delete Thumbnail?')">Delete</a>
                                
                                <?php } ?>
							</div>
						</section>

                        <section>
                        	<label for="main_image">Main Image<br><span></span></label>
							<div>
                            	<input type="file" id="main_image" name="main_image" value="<?php echo $blogs->main_image;?>">
                                  <?php if($blogs->main_image!=''){ ?> 
                                <br clear="all">
                                <img src="../images/blogs/large/<?php echo $blogs->main_image;?>" width="70"><br>
                                <a href="javascript:delete_pic_large();" onClick="return confirm('Are you sure you want to delete Main Image?')">Delete</a>
                                
                                <?php } ?>
							</div>
						</section>


                        <section>
                        	<label for="active_date">Release Date<br><span></span></label>
							<div>
                            	<input type="text" id="release_date" name="release_date" value="<?php echo $blogs->release_date;?>" class="date">
							</div>
						</section>
                        

                        <section>
                        	<label for="active_date">Expire Date<br><span></span></label>
							<div>
                            	<input type="text" id="expire_date" name="expire_date" value="<?php echo $blogs->expire_date;?>" class="date">
							</div>
						</section>
                        
                        <section>
                        	<label for="active_date">Blog Status<br><span></span></label>
							<div>
                            <?php if($session->get('mode')!='writer') { ?>
                            	<select name="status" id="status">
                                    <option value=""> Select Post Status </option>
                                    <option value="active"  <?php if($blogs->status=='active') echo 'selected="selected"';?>>Approved</option>
                                    <option value="pending" <?php if($blogs->status=='pending') echo 'selected="selected"';?>>Pending Approval</option>
                                    <option value="draft"   <?php if($blogs->status=='draft') echo 'selected="selected"';?>>Draft</option>
                                    <option value="rejected"<?php if($blogs->status=='rejected') echo 'selected="selected"';?>>Rejected</option>
                                    <option value="expired" <?php if($blogs->status=='expired') echo 'selected="selected"';?>>Expired</option>
                                </select>
                             <?php } ?>
                             
                             <?php if($session->get('mode')=='writer') { ?>
                            	<select name="status" id="status">
                                    <option value=""> Select Post Status </option>
                                    <?php if($blogs->status=='active') { ?>
                                    <option value="active"  <?php if($blogs->status=='active') echo 'selected="selected"';?>>Approved</option>
                                    <?php }	?>
                                    <option value="pending" <?php if($blogs->status=='pending') echo 'selected="selected"';?>><?php echo ($blogs->blog_id>0)?'Update':'Publish';?></option>
                                    <option value="draft"   <?php if($blogs->status=='draft') echo 'selected="selected"';?>>Saved as Draft</option>
                                </select>
                             <?php } ?>      
                                
							</div>
						</section>
                        
                        <?php if($session->get('mode')!='writer'){ ?>
                        <section>
                        	<label for="active_date">Is Featured ?<br><span></span></label>
							<div>
                            	<input type="checkbox" name="is_featured" id="is_featured" value="1" <?php if($blogs->is_featured==1) echo 'checked';?>>
 							</div>
						</section>
                        <?php } ?>
                        

                        <section>
							<div>
                            	<button class="reset">Reset</button>
                            	<button class="submit" name="manage_blog_button" value="manage_blog_button">Submit</button>
                            </div>
						</section>
                     </fieldset>
                     <input type="hidden" name="action" id="action" value="">
                     <input type="hidden" id="blog_id" name="blog_id" value="<?php echo $blogs->blog_id;?>">
          </form>              
			</section>
		<?php include("footer.php");?>
        
        
        <script>
		$('form').wl_Form({
			ajax:false
		});
		</script>
        
        <script>
		
function validate_blog()
{
	var agent_id 		= 	$("#agent_id").val();
	var description		= 	$("#textarea_wysiwyg").val();
	var short_desc 		= 	$("#short_desc").val();
	var release_date	= 	$("#release_date").val();
	var expire_date 	= 	$("#expire_date").val();
	var blog_name 		= 	$("#blog_name").val();
	var cat_id			=	$("#cat_id").val();
	var tags			=	$("#tags").val();
	var metro_area		=	$("#metro_area").val();
	var status			=	$("#status").val();
	
	
	if(agent_id==''){
		alert("Please Select Writer Name");
		$("#agent_id").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	
	
	if(cat_id==''){
		alert("Please Select Blog Category");
		$("#agent_id").focus();
		$(".wl_formstatus").hide();
		return false;
	}

	if(blog_name==''){
		alert("Please Enter Blog Name / Title");
		$("#blog_name").focus();
		$(".wl_formstatus").hide();
		return false;
	}

	if(short_desc==''){
		alert("Please Enter Short Description");
		$("#short_desc").focus();
		$(".wl_formstatus").hide();
		return false;
	}

	if(description==''){
		alert("Please Enter Blog Details");
		$("#textarea_wysiwyg").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	
	if(tags==''){
		alert("Please Enter 'Comma' Seperated Tags for Post");
		$("#tags").focus();
		$(".wl_formstatus").hide();
		return false;
	}

	if(metro_area==''){
		alert("Please Enter Metro Area");
		$("#metro_area").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	
	
	/*else if(release_date==''){
		alert("Please Select Post Release Date");
		$("#release_date").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	
	

	else if(expire_date==''){
		alert("Please Select Expire Date");
		$("#expire_date").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	*/
	else if(status==''){
		alert("Please Select Blog Status");
		$("#status").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	
	else {
		
		$("#action").val('save');
		$("form").submit();
	}
	
	
		
}

		function delete_pic_small(){ 
			$("#action").val('dp_small');
			document.forms.item(0).submit();
		}
		
		function delete_pic_large(){ 
			$("#action").val('dp_large');
			document.forms.item(0).submit();
		}
		
</script>
</body>
</html>