<?php require("../includes/lib/common.php"); ?>
<?php require("../includes/lib/classes/a/faq.php"); ?>
<?php require("../includes/lib/classes/a/users.php"); 
$users = new users();
$users->require_logged_in("login.php");
?>

<?php
$FAQS = new FAQS();
$FAQS_id = $request->getvalue('request');

$catList=$FAQS->getcategories();

if($FAQS_id>0)
	$FAQS->load($FAQS_id);

$question = $request->postvalue('question');
if($question!='')
{

	$FAQS->question = $request->postvalue('question');
	$FAQS->answer = $request->postvalue('answer');
    $FAQS->category = $request->postvalue('category');
	$FAQS->save();
			  echo'
		  <meta http-equiv="refresh" content="1; url=faqs.php">
<script>
  window.location.href = "faqs.php"
</script>
If you are not redirected automatically, follow the <a href="faqs.php">link</a>';
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage FAQS</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/faqs.php">Manage FAQS</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_faqs.php">Edit/Add FAQS</a></li>
						</ul>
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage FAQS</h1>
			<p></p>
		</div>	

		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" onSubmit="return validate_FAQS();" enctype="multipart/form-data">
					<fieldset>
						<label>Manage FAQS</label>
						
                          
                        
                        
                        
                         <section><label for="textarea_auto">Question<br></label>
							<div><textarea id="question" name="question" <?php /*class="html" */?> rows="4" style="font-size: 16px;"><?php echo $FAQS->question;?></textarea>
                             
							</div>
						</section>
                                                
                         <section><label for="textarea_auto">Category<br></label>
							<div><input list="categoryList" type="text" id="category" name="category"  style="font-size: 16px;" value="<?php echo $FAQS->category;?>" />
                             

 
<datalist id="categoryList">
<?php


foreach($catList as $value){
    
    $catName=str_replace("_", " ", $value[0]);
    
    echo "<option value=\"$value[0]\">$catName</option>";
    
    
   } 
    ?>
    
</datalist>
							</div>
						</section>
                        

                        
                             <section><label for="textarea_auto">Answer<br><span>Note: If the font shows as black and Times New Roman that means that no font is assigned to the element and the font will follow the rules of your site's CSS statements. THIS IS GOOD. You do not need to choose fonts or colors unless you want them unusual.</span></label>
							<div><textarea id="answer" name="answer" <?php /*class="html" */?> rows="12"><?php echo $FAQS->answer;?>&nbsp;</textarea>                    
                        
                        
                           <script language="javascript" type="text/javascript">
							var oEdit2 = new InnovaEditor("oEdit2");
							oEdit2.width = 900;
							oEdit2.height = 400;
							oEdit2.groups = [
        ["group1", "", ["FontName", "FontSize", "Superscript", "ForeColor", "BackColor", "FontDialog", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "TextDialog","RemoveFormat"]],
        ["group2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "Paragraph", "BRK", "Bullets", "Numbering", "Indent", "Outdent"]],
        ["group3", "", ["Table","TableDialog", "Emoticons", "FlashDialog", "BRK", "LinkDialog", "ImageDialog", "YoutubeDialog"]],
        ["group4", "", ["InternalLink", "CharsDialog", "Line", "BRK", "CustomObject", "CustomTag", "MyCustomButton"]],
        ["group5", "", ["SearchDialog", "SourceDialog", "BRK", "Undo", "Redo", "FullScreen"]]
        ];

                                     oEdit2.enableFlickr = false;
                               oEdit2.disableFocusOnLoad = true;
							oEdit2.css = "styles/default.css";
							oEdit2.fileBrowser = "/LiveEditor/assetmanager/asset.php";
							oEdit2.REPLACE("answer");
							</script>
							</div>
						</section>
                        
                          
                        
                        
<!--                        <section>
							<label for="status">Status</label>
							<div>					
								<select name="status" id="status">
									<optgroup label="Status">
										<option answer="active" <?php if($FAQS->status=='active') 		echo "selected";?>>Active</option>
										<option answer="inactive" <?php if($FAQS->status=='inactive') 	echo "selected";?>>Inactive</option>
									</optgroup>
								</select>

							</div>
						</section>
-->                        
                        
                        <section>
							<div><button class="reset">Reset</button><button class="submit" name="manage_service_button" answer="manage_service_button">Submit</button></div>
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