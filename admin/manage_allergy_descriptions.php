<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/allergy_descriptions.php"); 
require("../includes/lib/functions/submenuBuilder.php");

$users      = new users();   
$users->require_logged_in("index.php");
$allergy_descriptions    = new allergy_descriptions();
$id    = $request->getvalue('request');
$action     = $request->postvalue('action');
if($id>0)	$allergy_descriptions->load($id);

if($action!='') {
    
        $allergy_descriptions->id = $request->postvalue('id');
            $allergy_descriptions->allergy_name = $request->postvalue('allergy_name');
            $allergy_descriptions->allergy_description = $request->postvalue('allergy_description');

           
           
           
           if($error== '') {
            $allergy_descriptions->save();
            header("Location:allergy_descriptions.php");
           }
           
	
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage allergy Descriptions</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/members.php">Manage Allergy Descriptions</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_members.php">Edit/Add Allergy Descriptions</a></li>
						</ul>
						
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Allergy Descriptions</h1>
			<p></p>
		</div>	
        

        
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						<label>Manage Allergy Descriptions</label>


<section><label  class="formLabel" for="allergy_name">Allergy Name</label><div><input type="text" class="text" name="allergy_name" value="<?php echo $allergy_descriptions->allergy_name; ?>"/></div></section>
<section><label  class="formLabel" for="allergy_description">Allergy Description</label><div><textarea class="text" name="allergy_description" style="width:80%; height: 200px;"/><?php echo $allergy_descriptions->allergy_description; ?></textarea></div></section>


                        
                        
                        
                        <section>
                        <input type="hidden" name="id" value="<?php echo $allergy_descriptions->id; ?>"/>
							<div>
                                    <button class="reset">Reset</button>
                                    <button class="submit" name="manage_service_button" value="manage_service_button">Submit</button>
                            </div>
						</section>
                     </fieldset>
          </form>              
			</section>
		<?php //include("includes/footer.php");?>
        
        
        <script>
		$('form').wl_Form({
			ajax:false
		});
        
        $(document).ready(function(e) {
            
            var country = '<?php echo $members->country;?>';
            if(country != '')  $("#form-country").val(country);
            
        });
            
        
            $("input[name=baddress_option]").on("click",function() {
                var val= $(this).val();
                
                if(val == 'o') { 
                    
                        /*$(".baddress").show();
                        $("textarea[name=address]").attr('required','required').val('');
                        */
                }
                else      {
                    
                         $("select[name=billing_country]").val($("select[name=country]").val());
                         $("select[name=billing_province]").val($("select[name=province]").val());
                         $("input[name=billing_city]").val($("input[name=city]").val());
                         $("input[name=billing_street]").val($("input[name=street]").val());
                         $("input[name=billing_postcode]").val($("input[name=postcode]").val());
                }
            });
            
		</script>
</body>
</html>