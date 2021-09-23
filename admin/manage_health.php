<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php");
 
require("../includes/lib/classes/a/health.php"); 

require("../includes/lib/functions/submenuBuilder.php");

$users      = new users();   
$users->require_logged_in("index.php");
$health    = new health();
$id    = $request->getvalue('request');
$action     = $request->postvalue('action');


if($id>0)	$health->load($id);


if($action!='') {
    
       $health->id = $request->postvalue('id');
        $health->user_id = $request->postvalue('user_id');
        $health->health_id = $request->postvalue('health_id');
        $health->date = $request->postvalue('date');
        $health->notes = $request->postvalue('notes');

           
           
           
           if($error== '') {
            $health->save();
            header("Location:health.php");
           }
           
	
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Alllergies</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/health.php">Manage Health</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_members.php">Edit/Add Alllergies</a></li>
						</ul>
						
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Health</h1>
			<p></p>
		</div>	
        

        
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						<label>Manage Health</label>



<section><label  class="formLabel" for="user_id">User Id</label><div><input type="text" class="text" name="user_id" value="<?php echo $health->user_id; ?>"/></div></section>
<section><label  class="formLabel" for="health_id">Health Id</label><div><input type="text" class="text" name="health_id" value="<?php echo $health->health_id; ?>"/></div></section>
<section><label  class="formLabel" for="date">Date</label><div><input type="text" class="text" name="date" value="<?php echo $health->date; ?>"/></div></section>
<section><label  class="formLabel" for="notes">Notes</label><div><textarea class="text" name="notes" style="width:80%; height:200px;"/><?php echo $health->notes; ?></textarea></div></section>

<input type="hidden" name="id" value="<?php echo $id;?>">




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