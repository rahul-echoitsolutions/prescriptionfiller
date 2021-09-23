<?php
	//manage_contents.php
require("../includes/lib/common.php"); 
require("../includes/lib/classes/a/contents.php"); 
require("../includes/lib/classes/a/users.php"); 
$users          = new users();   $users->require_logged_in("login.php");
$contents       = new contents();
$content_id     = $request->getvalue('request');
$loadSubMenu    = $request->getvalue('loadSubMenu');

if($content_id>0)	$contents->load($content_id);
 
############# LOAD Sub Menu Links AJAX REQ ##############
if($loadSubMenu != '') {
    $mainMenu     = $request->getvalue('mainmenu');
    $contentslist = $contents->getlist($mainMenu);
    echo "<option value=\"\">NONE</option>";
    foreach($contentslist as $list) {
        $selected = ($contents->submenupos == $list['content_id'])?'selected="selected"':'';
        echo "<option value=\"{$list['content_id']}\" $selected>{$list['title']}</option>";
    }
    
    exit;
}
############# Get Sub Menu Links ##############

$title = $request->postvalue('title');
if($title!='')
{
	$contents->title = $request->postvalue('title');
	$contents->description = $request->postvalue('textarea_wysiwyg');
	$contents->status = $request->postvalue('status');
    $contents->wysiwyg_meta	 = $request->postvalue('wysiwyg_meta');
    $contents->menupos = $request->postvalue('menupos');
    $contents->submenupos = $request->postvalue('submenupos');
    $contents->menuorder = $request->postvalue('menuorder');
    $contents->robots = $request->postvalue('robots');
    $contents->url_key = $request->postvalue('url_key');
    $image_name = $request->postvalue('image_name');
    $contents->image_alt = $request->postvalue('image_alt');
    $contents->set301 = $request->postvalue('set301');
    $contents->rightColumn = $request->postvalue('rightColumn');
    $contents->sitemap = $request->postvalue('sitemap');
	
    $urlkey_status = $contents->checkUrlKey($contents->url_key,$content_id);        
    $image_name_exist  = '';
    
    // clean $contents->description
	
	
	function cleanWord($copy){
	$badWordCodes=array("<o:p></o:p>","<o:p>&nbsp;</o:p>","<p class=\"MsoNormal\">&nbsp;</p>","class=\"MsoNormal\"","<o:p>&nbsp;</o:p>");
	$copy=str_replace($badWordCodes,"",$copy);
	$badWordCodes2=array("<p></p>","<p>&nbsp;</p>","&nbsp;","<p ><br />
	</p>");
	$copy=str_replace($badWordCodes2,"",$copy);
	
	return $copy;
	}
	
	$contents->description=cleanWord($contents->description);
    
    if($urlkey_status == '') { 

        //if($contents->image != '' && $image_name != $contents->image_name && $_FILES['main_image']['name']=='') {
         if($contents->image != '' && $_FILES['main_image']['name']=='') {   
            
            $image_name_exist   = $contents->checkImageNameExists($image_name,$content_id);
            $getext             = explode('.',$contents->image);
            $ext                = end($getext);
            $new_name           = str_replace(' ','_',$image_name).".{$ext}";
            
            if($image_name_exist == '') {
                rename("../images/cms/$contents->image","../images/cms/$new_name");
                $contents->image = $new_name;
                $contents->save();
            }
            
        }
        
            ///////////// uploading main  image ///////////////////////
                if($_FILES['main_image']['tmp_name']!='')
                {
                    
                  $image_name_exist   = $contents->checkImageNameExists($image_name,$content_id);
                  
                  if($image_name_exist == '') {  
                    
                    if($contents->image!=''){
                        if (file_exists('../images/cms' . $contents->image)) unlink('../images/cms' . $contents->image);
                    }
                
                    $getext     = explode('.',$_FILES['main_image']['name']);
                    $ext        = end($getext);
                    
                    
                    
                    $upload="../images/cms";
                    $file_name = resize_image($upload,$upload,1920,$_FILES['main_image']);
                    $newName1  = ($image_name!='')?str_replace(' ','_',$image_name).".{$ext}":'';
                    $newName1 = resize_size_step_2($upload,$upload,$file_name,$newName1,1920,$_FILES['main_image']);
                    unlink("$upload/$file_name");
                    $contents->image = $newName1;
                    
                  }
                    
                }
        /////////// end of adding maing image //////////////////////////////		
        if($image_name_exist == '') {
            $contents->image_name = $image_name;
            $contents->save();
        header("Location:contents.php");
        }
    }
}

?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Contents</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/contents.php">Manage Contents</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_contents.php">Manage Contents</a></li>
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Contents</h1>
			<p></p>
            
            <?php if(@$image_name_exist!='') { ?><div class="alert warning">ERROR : Image with the same name already exists</div> <?php } ?>
            <?php if(@$urlkey_status!='') { ?><div class="alert warning">ERROR : Another page with same URL KEY already exists.</div> <?php } ?>

            
		</div>	

		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" onSubmit="return validate_contents();" enctype="multipart/form-data">
					<fieldset>
						<label>Manage Contents</label>
						<section><label for="text_field">Title</label>
							<div><input type="text" id="title" name="title" value="<?php echo $contents->title;?>"></div>
						</section>
                        
                        
                        <section><label for="text_field">URL KEY <BR><small> all amall characters, seperated by '-' e.g demo-web-url </small></label>
							<div><input type="text" id="url_key" name="url_key" value="<?php echo $contents->url_key;?>" required></div>
						</section>
                        
                        
                          <section><label for="textarea_auto">Metatags<br><span></span></label>
							<div><textarea id="wysiwyg_meta" name="wysiwyg_meta" <?php /*class="html" */?> rows="12" required><?php echo cleanit($contents->wysiwyg_meta);?></textarea>
                            <?php
	/**

 *                              <script language="javascript" type="text/javascript">
 * 							var oEdit3 = new InnovaEditor("oEdit3");
 * 							oEdit3.width = 900;
 * 							oEdit3.height = 200;
 * 							oEdit3.groups = [
 * 								["group1", "", ["Bold", "Italic", "Underline", "FontDialog", "ForeColor", "TextDialog", "RemoveFormat"]],
 * 								["group2", "", ["Bullets", "Numbering", "JustifyLeft", "JustifyCenter", "JustifyRight"]],
 * 								["group3", "", ["LinkDialog", "ImageDialog", "YoutubeDialog", "TableDialog", "Emoticons"]],
 * 								["group4", "", ["Undo", "Redo", "FullScreen", "SourceDialog"]]
 * 								];
 * 							oEdit3.css = "styles/default.css";
 * 							oEdit3.fileBrowser = "LiveEditor/assetmanager/asset.php";
 * 							oEdit3.REPLACE("wysiwyg_meta");
 * 							</script>
 */
?>
							</div>
						</section>

                        
                        <section><label for="textarea_auto">Description<br><span></span></label>
							<div><textarea id="textarea_wysiwyg" name="textarea_wysiwyg" <?php /*class="html" */?> rows="12"><?php echo $contents->description;?></textarea>
                             <script language="javascript" type="text/javascript">
                             <?php
	// removed "YoutubeDialog", "ImageDialog", 
?>
							var oEdit2 = new InnovaEditor("oEdit2");
							oEdit2.width = 900;
							oEdit2.height = 400;
							oEdit2.groups = [
								["group1", "", ["Bold", "Italic", "Underline", "FontDialog", "ForeColor", "TextDialog", "RemoveFormat"]],
								["group2", "", ["Bullets", "Numbering", "JustifyLeft", "JustifyCenter", "JustifyRight"]],
								["group3", "", ["LinkDialog", "TableDialog", "Emoticons"]],
								["group4", "", ["Undo", "Redo", "FullScreen", "SourceDialog"]]
								];
							oEdit2.css = "../LiveEditor/styles/default.css";
                            oEdit2.returnKeyMode = 3;
							oEdit2.fileBrowser = "/LiveEditor/assetmanager/asset.php";
							oEdit2.REPLACE("textarea_wysiwyg");
							</script>
							</div>
						</section>
                        
                       
                        
                                                <section><label for="textarea_auto">Right Column<br><span></span></label>
							<div><textarea id="rightColumnxx" name="rightColumn" <?php /*class="html" */?> rows="12"><?php echo $contents->rightColumn;?></textarea>
                            <?php
	/**
 *  <script language="javascript" type="text/javascript">
 * 							var oEdit5 = new InnovaEditor("oEdit5");
 * 							oEdit5.width = 900;
 * 							oEdit5.height = 400;
 * 							oEdit5.groups = [
 * 								["group1", "", ["Bold", "Italic", "Underline", "FontDialog", "ForeColor", "TextDialog", "RemoveFormat"]],
 * 								["group2", "", ["Bullets", "Numbering", "JustifyLeft", "JustifyCenter", "JustifyRight"]],
 * 								["group3", "", ["LinkDialog", "ImageDialog", "YoutubeDialog", "TableDialog", "Emoticons"]],
 * 								["group4", "", ["Undo", "Redo", "FullScreen", "SourceDialog"]]
 * 								];
 * 							oEdit5.css = "styles/default.css";
 *                           oEdit5.returnKeyMode = 3;
 * 							oEdit5.fileBrowser = "/LiveEditor/assetmanager/asset.php";
 * 							oEdit5.REPLACE("rightColumn");
 * 							</script>
 */
?>
							</div>
						</section>

                        
                                            <section><label for="textarea_auto">301s<br><span></span></label>
							<div><textarea id="textarea_wysiwyg" name="set301" <?php /*class="html" */?> rows="12"><?php echo cleanit($contents->set301);?></textarea>
                             <script language="javascript" type="text/javascript">
							var oEdit4 = new InnovaEditor("oEdit4");
							oEdit4.width = 900;
							oEdit4.height = 200;
							oEdit4.groups = [
								["group1", "", ["Bold", "Italic", "Underline", "FontDialog", "ForeColor", "TextDialog", "RemoveFormat"]],
								["group2", "", ["Bullets", "Numbering", "JustifyLeft", "JustifyCenter", "JustifyRight"]],
								["group3", "", ["LinkDialog", "ImageDialog", "YoutubeDialog", "TableDialog", "Emoticons"]],
								["group4", "", ["Undo", "Redo", "FullScreen", "SourceDialog"]]
								];
							oEdit4.css = "styles/default.css";
							oEdit4.fileBrowser = "/LiveEditor/assetmanager/asset.php";
							oEdit4.REPLACE("set301");
							</script>
							</div>
						</section>

                        
			<label>Menu Position</label>
<section><label for="text_field">Menu</label>
	<div><select id="menupos" name="menupos">
            <option value="" <?php if($contents->menupos=='') echo "selected";?> >None</option>
            <option value="Home" <?php if($contents->menupos=='Home') echo "selected";?>>Home</option>
            <option value="How It Works" <?php if($contents->menupos=='How It Works') echo "selected";?> >How It Works</option>
            <option value="About" <?php if($contents->menupos=='About') echo "selected";?>>About</option>
            <option value="FAQs" <?php if($contents->menupos=='FAQs') echo "selected";?>>FAQs</option>
            
            <option value="Contact Us" <?php if($contents->menupos=='Contact Us') echo "selected";?>>Contact Us</option>
              <option value="Blog" <?php if($contents->menupos=='Blog') echo "selected";?>>Blog</option>
              <option value="Doctors" <?php if($contents->menupos=='Doctors') echo "selected";?>>Doctors</option>
              <option value="Pharmacists" <?php if($contents->menupos=='Pharmacists') echo "Pharmacists";?>>Doctors</option>
             
           
            
            </select>
    </div>
    
    
                            
                            
                            <div  style="display: inline-block; margin-left:100px;margin-top: -20px;"> Menu Order: 
                            	<input type="text" id="menuorder" name="menuorder" value="<?php echo $contents->menuorder;?>" > Can be decimal.
                            </div>
                            
                            
						</section>
                        
                        
                        
                        
                        <section><label for="text_field">Sub Menu</label>
							<div>
                                <select id="submenupos" name="submenupos">
                                    <option value="" >None</option>
                                </select>
                           </div>
						</section>
                        
                        
                        <section><label for="main_image">Header Image<br><span>Main Title Image</span></label>
						<div><input type="file" id="main_image" name="main_image">
                        <?php if($contents->image!='') {?><p style="float:right; margin-right:200px;"><img src="../images/cms/<?php echo $contents->image;?>" width="100"></p><?PHP } ?>
							</div>
						</section>
                        
                          
                        <section><label for="text_field">Image Name</label>
							<div><input type="text" id="image_name" name="image_name" value="<?php echo $contents->image_name;?>" ></div>
						</section>
                        
                        
                        <section><label for="text_field">Image Alt</label>
							<div><input type="text" id="image_alt" name="image_alt" value="<?php echo $contents->image_alt;?>" ></div>
						</section>


                        <section>
							<label for="status">Status</label>
							<div>					
								<select name="status" id="status">
									<optgroup label="Status">
										<option value="active" <?php if($contents->status=='active') echo "selected";?>>Active</option>
										<option value="inactive" <?php if($contents->status=='inactive') echo "selected";?>>Inactive</option>
									</optgroup>
								</select>

							</div>
						</section>
             

    
                          <section>
  							<label for="status">Sitemap</label>
  							<div style="display:inline-block;">					
  								<select name="sitemap" id="sitemap">
  									<optgroup label="Sitemap">
  										<option value="yes" <?php if($contents->sitemap=='yes') echo "selected";?>>Yes</option>
  										<option value="no" <?php if($contents->sitemap=='no') echo "selected";?>>No</option>
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
        
            $(document).ready(function(e) {
                
                $("#menupos").on("change",function(){
                    loadSubMenuLinks($(this).val());
                });
                
                var title = '<?php echo $contents->menupos;?>';
                if(title != '') loadSubMenuLinks(title); 
            });
            
            function loadSubMenuLinks(title) {
                
                var targetUrl = '<?php echo HTTP_HOME_URL."admin/manage_contents.php?request=$content_id&loadSubMenu=1&mainmenu=";?>'+title;
                $.get(targetUrl, function(data){
                    $("#submenupos").empty();
                    $(data).appendTo($("#submenupos"));
                    $("#uniform-submenupos span").html($("#submenupos option:selected").html());
                });
            }
		</script>
</body>
</html>