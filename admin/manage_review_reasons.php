<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/review_reasons.php"); 
require("../includes/lib/functions/submenuBuilder.php");

$users      = new users();   
$users->require_logged_in("index.php");
$review_reasons    = new review_reasons();
$id    = $request->getvalue('request');
$action     = $request->postvalue('action');


if($id>0)	$review_reasons->load($id);

if($action!='') {
    
        $review_reasons->id = $request->postvalue('id');
        $review_reasons->reason = $request->postvalue('reason');
        $review_reasons->notes = $request->postvalue('notes');
        $review_reasons->date_entered = $request->postvalue('date_entered');

           
           
           
           if($error== '') {
            $review_reasons->save();
            header("Location:review_reasons.php");
           }
           
	
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Review Reasons</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/members.php">Manage Review Reasons</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_members.php">Edit/Add Review Reasons</a></li>
						</ul>
						
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Review Reasons</h1>
			<p></p>
		</div>	
        

        
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						<label>Manage Review Reasons</label>

<section><label  class="formLabel" for="id">Id</label><div><input type="text" class="text" name="id" value="<?php echo $review_reasons->id; ?>"/></div></section>
<section><label  class="formLabel" for="reason">Reason</label><div><input type="text" class="text" name="reason" value="<?php echo $review_reasons->reason; ?>"/></div></section>
<section><label  class="formLabel" for="notes">Notes</label><div><input type="text" class="text" name="notes" value="<?php echo $review_reasons->notes; ?>"/></div></section>
<section><label  class="formLabel" for="date_entered">Date Entered</label><div><input type="date" class="text" name="date_entered" value="<?php echo $review_reasons->date_entered; ?>"/></div></section>
                        
                        
                        <section>
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