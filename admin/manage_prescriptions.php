<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/prescriptions.php"); 
require("../includes/lib/classes/a/members.php");
require("../includes/lib/classes/a/physicians.php");
require("../includes/lib/classes/a/pharmacies.php");
require("../includes/lib/functions/submenuBuilder.php");


$users      = new users();   
$users->require_logged_in("index.php");
$prescriptions    = new prescriptions();
$members            = new members();
$physicians         = new physicians();
$pharmacies         = new pharmacies();
$id    = $request->getvalue('request');
$action     = $request->postvalue('action');


if($id>0)	$prescriptions->load($id);

if($action!='') {
    
        //$prescriptions->id = $request->postvalue('id');
                $prescriptions->user_id = $request->postvalue('user_id');
                $prescriptions->physician_id = $request->postvalue('physician_id');
                $prescriptions->pharmacy_id = $request->postvalue('pharmacy_id');
                $prescriptions->description = $request->postvalue('description');
                $prescriptions->extended_health = $request->postvalue('extended_health');
                $prescriptions->date_processed = $request->postvalue('date_processed');
                $prescriptions->image = $request->postvalue('image');
                $prescriptions->status = $request->postvalue('status');
                $prescriptions->time_received = $request->postvalue('time_received');
                $prescriptions->time_processed = $request->postvalue('time_processed');
                $prescriptions->time_shipped = $request->postvalue('time_shipped');
                $prescriptions->urgency = $request->postvalue('urgency');
                $prescriptions->delivery_status = $request->postvalue('delivery_status');
                $prescriptions->review_status = $request->postvalue('review_status');
                $prescriptions->review_reason = $request->postvalue('review_reason');
                $prescriptions->image_path = $request->postvalue('image_path');
                $prescriptions->fax_id = $request->postvalue('fax_id');
                $prescriptions->updated_at = date("Y-m-d");
                $prescriptions->created_at = $request->postvalue('created_at');
                $prescriptions->medical_notes = $request->postvalue('medical_notes');
                $prescriptions->tax_status = $request->postvalue('tax_status');

           
           
           if($error== '') {
            $prescriptions->save();
            header("Location:prescriptions.php");
           }
           
	
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Prescriptions</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/members.php">Manage Prescriptions</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_members.php">Edit/Add Prescriptions</a></li>
						</ul>
						
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Prescriptions</h1>
			<p></p>
		</div>	
        

        
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>

		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<input type="hidden" id="action" name="action" value="save">
		
					<fieldset>
						<label>Manage Prescriptions</label>


<section><label  class="formLabel" for="user_id">Member</label><div>



<select name="user_id">
<?php
$memList=$members->getlist();
    echo "<option value=''>Choose Member</option> ";
foreach($memList as $list){
    
    $selected=($prescriptions->user_id==$list['id'])? "selected" :"";
   
   echo "<option value='".$list['id']."' $selected>".$list['first_name']." ".$list['last_name']."</option> ";
}
?>
 </select>
</div></section>

<section><label  class="formLabel" for="physician_id">Physician Id</label><div>






<select name="physician_id">
<?php
$physList=$physicians->getlist();
    echo "<option value=''>Choose Physician</option> ";
foreach($physList as $list){
    
    $selected=($prescriptions->physician_id==$list['id'])? "selected" :"";
   
   echo "<option value='".$list['id']."' $selected>".$list['first_name']." ".$list['last_name']."</option> ";
}
?>
 </select>
</div></section>







<section><label  class="formLabel" for="pharmacy_id">Pharmacy Id</label><div>





<select name="pharmacy_id">
<?php
$options['order_by']="city"; 
$options['sort_direction']="asc";
$pharmList=$pharmacies->getlist();
    echo "<option value=''>Choose Pharmacy</option> ";
foreach($pharmList as $list){
    
    $selected=($prescriptions->pharmacy_id==$list['id'])? "selected" :"";
    
    $pharm=ucwords($list['name'])." - ".ucwords($list['address'])." - ".ucwords($list['city']);
   
   echo "<option value='".$list['id']."' $selected>$pharm</option> ";
}
?>
 </select>
</div></section>

<section><label  class="formLabel" for="description">Description</label><div><input type="text" class="text" name="description" value="<?php echo $prescriptions->description; ?>"/></div></section>
<section><label  class="formLabel" for="extended_health">Extended Health</label><div><input type="text" class="text" name="extended_health" value="<?php echo $prescriptions->extended_health; ?>"/></div></section>

<section><label  class="formLabel" for="date_processed">Date Processed</label><div><input type="text" class="date" name="date_processed" value="<?php echo $prescriptions->date_processed; ?>"/></div></section>
<section><label  class="formLabel" for="image">Image</label><div><input type="file" class="text" name="image" value="<?php echo $prescriptions->image; ?>"/></div></section>
<section><label  class="formLabel" for="status">Status</label><div><input type="text" class="text" name="status" value="<?php echo $prescriptions->status; ?>"/></div></section>
<section><label  class="formLabel" for="time_received">Time Received</label><div><input type="text" class="date" name="time_received" value="<?php echo $prescriptions->time_received; ?>"/></div></section>
<section><label  class="formLabel" for="time_processed">Time Processed</label><div><input type="test" class="date" name="time_processed" value="<?php echo $prescriptions->time_processed; ?>"/></div></section>
<section><label  class="formLabel" for="time_shipped">Time Shipped</label><div><input type="text" class="date" name="time_shipped" value="<?php echo $prescriptions->time_shipped; ?>"/></div></section>
<section><label  class="formLabel" for="urgency">Urgency</label><div><input type="text" class="text" name="urgency" value="<?php echo $prescriptions->urgency; ?>"/></div></section>
<section><label  class="formLabel" for="delivery_status">Delivery Status</label><div><input type="text" class="text" name="delivery_status" value="<?php echo $prescriptions->delivery_status; ?>"/></div></section>
<section><label  class="formLabel" for="review_status">Review Status</label><div><input type="text" class="text" name="review_status" value="<?php echo $prescriptions->review_status; ?>"/></div></section>
<section><label  class="formLabel" for="review_reason">Review Reason</label><div><input type="text" class="text" name="review_reason" value="<?php echo $prescriptions->review_reason; ?>"/></div></section>
<section><label  class="formLabel" for="image_path">Image Path</label><div><input type="text" class="text" name="image_path" value="<?php echo $prescriptions->image_path; ?>"/></div></section>
<section><label  class="formLabel" for="fax_id">Fax Id</label><div><input type="text" class="text" name="fax_id" value="<?php echo $prescriptions->fax_id; ?>"/></div></section>
<section><label  class="formLabel" for="udated_at">Udated At</label><div><input type="text" class="text" name="udated_at" value="<?php echo $prescriptions->udated_at; ?>"/></div></section>
<section><label  class="formLabel" for="created_at">Created At</label><div><input type="text" class="text" name="created_at" value="<?php echo $prescriptions->created_at; ?>"/></div></section>
<section><label  class="formLabel" for="medical_notes">Medical Notes</label><div><textarea class="text" name="medical_notes" style="height:200px; width:80%;"/><?php echo $prescriptions->medical_notes; ?></textarea></div></section>
<section><label  class="formLabel" for="tax_status">Tax Status</label><div><input type="text" class="text" name="tax_status" value="<?php echo $prescriptions->tax_status; ?>"/></div></section>
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