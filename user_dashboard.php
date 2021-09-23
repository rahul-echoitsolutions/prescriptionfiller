<?php
	include("includes/head.php");
    include("includes/header.php");
	
   // require("includes/lib/common.php");
    require("includes/lib/classes/a/users.php");
	
    require("includes/lib/classes/a/settings.php");
   
    require_once("Mobile-Detect-2.8.34/Mobile_Detect.php");
    $users				= new users(); $users->require_logged_in("index.php");
   
    $settings           = new settings();

	$deposit_id			= $request->getvalue('request');
    $action				= $request->postvalue('action');
    $img				= $request->getvalue('img');
    $image_array        = array('jpg','gif','png','jpeg');
    ############### getting deposit ID from tenant ID ##########
    ############### getting deposit ID from tenant ID ##########
    ############### getting deposit ID from tenant ID ##########
    if($action == 'get_deposit_id') {
        $tenant_id = $request->postvalue('tenant_id');
        $deposit_id = $deposit_refunds->getDepositIDFromTenantID($tenant_id);
        echo $deposit_id;  
        exit;   
    }
    if($deposit_id > 0 ) $deposit_refunds->load($deposit_id);   
    if($deposit_refunds->id == 0 && $$deposit_id > 0 ) die("<h2>RECORD DOESN'T EXIST</h2>"); 
    if($deposit_refunds->id > 0 ) {
        $suites->load($deposit_refunds->suite_id); 
        $buildings->load($suites->building_id);
    }
    ##################### REMOVE Multi-Files #####################################
    ##################### REMOVE Multi-Files #####################################
    ##################### REMOVE Multi-Files #####################################
    if($img == 'del_multi') {
            $delete_file = $request->getvalue('delete_file');
            $ext         = end(explode(".",$file_name));
            $file_list = explode(':-:',$deposit_refunds->payment_proof);
            unlink("upload/deposits/".$delete_file);
            if(in_array(strtolower($ext),$image_array)) 
            unlink("upload/deposits/Big_".$delete_file);
            $new_file_list = array();
            foreach($file_list as $list) {
                if($list != $delete_file)    $new_file_list[] = $list;
            }
           $deposit_refunds->payment_proof = implode(":-:",$new_file_list);
           if($deposit_id > 0)  $deposit_refunds->save();
           echo 'success';
           exit;
    }

	if($img == 'del_multi_mi') {
				$tenant_id	 = $request->getvalue('tenant_id');
				$delete_file = $request->getvalue('delete_file');
		
				$tenants->load($tenant_id);
				$ext         = end(explode(".",$file_name));
				$file_list = explode(':-:',$deposit_refunds->payment_proof);
				unlink("upload/deposits/".$delete_file);
				if(in_array(strtolower($ext),$image_array)) 
				unlink("upload/deposits/Big_".$delete_file);
				$new_file_list = array();
				foreach($file_list as $list) {
					if($list != $delete_file)    $new_file_list[] = $list;
				}
			   $deposit_refunds->payment_proof = implode(":-:",$new_file_list);
			   if($deposit_id > 0)  $deposit_refunds->save();
			   echo 'success';
			   exit;
		}
    ##################### Uploading Multi-Files #####################################
    ##################### Uploading Multi-Files #####################################
    ##################### Uploading Multi-Files #####################################
    if($img == 'multi' ) {
        $deposit_id     = $request->postvalue("deposit_id");
        $room           = $request->postvalue('room');
		$type			= $request->postvalue('type');
		$tenant_id		= $request->postvalue('tenant_id');
        $room           = ($room == '')?'default':$room;
        $file_list      = array();
		
		if($type == 'moveout') {
			$deposit_refunds->load($deposit_id);
			$file_list = ($deposit_refunds->payment_proof!='')?explode(':-:',$deposit_refunds->payment_proof):'';
			$upload        = "upload/deposits";
		}
		else {
			$tenants->load($tenant_id);
			$file_list = ($tenants->Lease_Files!='')?explode(':-:',$tenants->Lease_Files):'';
			$upload        = "upload/tenantleases";	
		}
		
		
		for($i=0; $i<sizeof($_FILES['payment_proof']['name']);$i++) {
			
            $key        =   $i;
            $file_name 	= 	$_FILES['payment_proof']['name'][$key];
            $file_size 	=	$_FILES['payment_proof']['size'][$key];
            $file_tmp 	=	$_FILES['payment_proof']['tmp_name'][$key];
            $file_type	=	$_FILES['payment_proof']['type'][$key];
            $file_error	=	$_FILES['payment_proof']['error'][$key];
            $file 		= array(
                            "name"		=>	$file_name,
                            "type"		=>	$file_type,
                            "tmp_name"	=>	$file_tmp,
                            "error"		=>  $file_error,
                            "size"		=>	$file_size
            );
			
            if($file_tmp!='') {
                $ext            = end(explode(".",$file_name));
                $file_name      = $room."-".date("Ymd")."-".time().".".$ext;
                $img_flag       = in_array(strtolower($ext),$image_array)?1:0;
                ########## uploading images & resizing ################# 
                if($img_flag==1) {
					
					if($type == 'moveout') {
						$large_file = "Big_".$file_name;
						copy($file_tmp,"{$upload}/$large_file");
						$newName1 = resize_size_step_2($upload,$upload,$large_file,$file_name,150,$file);
					}
					else {
						$file_name = $tenant_id."-".$file_name;
                		copy($file_tmp,"{$upload}/$file_name");
                		//$file_list[] = $file_name."/".$file_category;
					}
                    
                } else {
                ########## uploading Documents #################    
                    copy($file_tmp,"{$upload}/$file_name");
                }
				
				if($file_name != '')
                $file_list[] = ($type == 'moveout')?$file_name:"{$file_name}/Move-In";
		    }
        } ### For loop
		
		if($type== 'moveout') {
        	
			$deposit_refunds->payment_proof = implode(":-:",$file_list);
        	if($deposit_id >0)   $deposit_refunds->save();
			
		} else {
			
			$tenants->Lease_Files = implode(":-:",$file_list);
			
			if($tenant_id >0)   $tenants->save();
		}
        $str = '';
        $i = 0;
        $roomHeaders = $deposit_refunds->getRoomsNamesFromTheImages($file_list);
		
		if($type == 'movein'){
			$roomHeaders = array("Move-In");
		}
		
		foreach($roomHeaders as $head) {
           $str         .= "<tr><td style=background-color:#EEE><strong>$head</strong></td><td style=background-color:#EEE></td></tr>";
           $RoomFiles    = $deposit_refunds->getListOfImagesInaRoom($head,$file_list); 
		   
		   if($type == 'movein'){
			$RoomFiles    = $deposit_refunds->getListOfImagesForMoveIn($head,$file_list); 
		      
		   }
		  	
           $i            = 0;
			 
		   foreach($RoomFiles as $file) {
               if($file == '') continue;
               $i++;
               $tmp             = explode("-",$file);
               if(isset($tmp[1]))  $tmp_name        = $tmp[1]."-".$i;
               else $tmp_name   =  $file;
               $file_ext        = substr($file,-3,3);
			   
			   /*if($type == 'movein'){
				   echo $file."<BR>";
				   $file = strstr($file,'/',true);
				   echo $file; die();
			   }*/
			   
               $file_link       = $upload."/{$file}";
               $bfile_link      = ($type == 'movein')?$file_link:$upload."/Big_{$file}";
               $bfile_link      = in_array($file_ext,$image_array)?$bfile_link:$file_link;
               $prettyPhoto     = in_array($file_ext,$image_array)?'rel="prettyPhoto[gallery_1]"':'target="_blank"';
               if(in_array($file_ext,$image_array)) {
                   $image_src  = '<BR><img src="'.$file_link.'" height="50" target="_blank">';
               } else  $image_src  = '';
               $str .= "<tr><td><a href=\"$bfile_link\" $prettyPhoto title=\"{$tmp[0]}\" >". $tmp_name.$image_src."</a></td>";
               $str .= '<td><a href="downloadfile.php?file='.$bfile_link.'" target="_blank" class="btn i_download btn_small" 
               title="Download File" style="margin-right:4px !important;"></a>';
               $str .= '<a href="'.$bfile_link.'" target="_blank" class="btn i_preview btn_small" title="View"></a> ';
               $str .= '<a href="javascript:;"  file_name="'.$file.'" class="delete_file btn i_cross btn_small" title="Delete"></a> ';
               $str .= '</td></tr>';
            } ### Inner foreach loop
        } ### outer foreach loop
		
		if($type == 'moveout'){
		
			$str .= '<input type="hidden" name="payment_proof_hv" id="payment_proof_hv" value="'.$deposit_refunds->payment_proof.'">';
        	
		} else {
			
		   $str .= '<input type="hidden" name="payment_proof_hv" id="payment_proof_hv" value="'.$tenants->Lease_Files.'">';
        	
		}
        $str .= "<script>$(\"a[rel^='prettyPhoto']\").prettyPhoto({
                        theme: 'light_square',
                        slideshow: 5000,
                        social_tools:false,
                        deeplinking:false,
                        show_title: true,
                        autoplay_slideshow: false
                });</script>";
        echo $str;
        exit;
    }
    #############################################################################
    #############################################################################
    #############################################################################
    $options 				= 	array();
    $options['building_id']	=	$suites->building_id;
    $suiteslist 			= 	$suites->getlist($options); 
    $buildingslist			= 	$buildings->getlist();
    $ownerlist			    = 	$owners->getlist();
    ######### detecting tab / cellphone ##########
    ######### detecting tab / cellphone ##########
    ######### detecting tab / cellphone ##########
    $detect = new Mobile_Detect;
    $mobile_tab = 0;
    if( $detect->isMobile() || $detect->isTablet() ){
        $mobile_tab = 1;
    }
    ######### detecting tab / cellphone ##########
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title>Property Plan - Manage Tenant Refunds</title>
	<meta name="description" content="">
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="css/style.css">
    <?php require("includes/main.php");?>
    <link rel="stylesheet" href="prettyphotos/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
    <script src="prettyphotos/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
    <style>
		#add_new_reason 	{ display:inline-block;position:absolute;margin:10px 0px 0px 20px;}
		.hidden_txtfield	{ margin-left: 172px; margin-top: 4px; position: absolute; }
		.hidden				{ display:none; }
        section label       {display:inline;}
        section div         {display: inline;}
	</style>
</head>
<body>
<?php 
$header_copy="<h3>Unit Camera</h3>";
include("admin_header.php"); ?>
			<?php /*<nav>*/ ?>
			<?php // include("left_navigation.php");?>
		<?php /*</nav>*/ ?>
		<section id="content">
		<form id="form" action="" method="post" autocomplete="off"  enctype="multipart/form-data" style="max-width:100%; overflow:scroll;">
					<fieldset>
                        <section style="display:none;">
							<label for="status" style="display: inline;">Select Owner </label>
							<div style="display: inline;">					
								<select name="owner_id" id="owner_id" required >
									<optgroup label="Select Owner">
                                    <option value="">Please Select</option>
                                    	<?php foreach($ownerlist as $list) { ?>
										<option value="<?php echo $list['rental_user_id'];?>" <?php 
                                        if($deposit_refunds->owner_id==$list['rental_user_id']) echo "selected";?>>
                                        <?php echo $list['full_name']; ?></option>
                                        <?php } ?>
									</optgroup>
								</select>
							</div>
						</section>
                        <section>
							<label for="status" style="display: inline;">Select Building </label>
							<div style="display: inline;">					
								<select name="building_id" id="building_id" required >
									<optgroup label="Select Building">
                                    <option value="">Please Select</option>
                                    	<?php foreach($buildingslist as $list) { ?>
										<option value="<?php echo $list['Building_Id'];?>" <?php 
                                        if($deposit_refunds->building_id==$list['Building_Id']) echo "selected";?>>
                                        <?php echo $list['Building_Address']; ?></option>
                                        <?php } ?>
									</optgroup>
								</select>
							</div>
						</section>
                        <section>
							<label for="status">Select Unit# </span></label>
							<div>					
								<select name="suite_id" id="suite_id" required>
									<optgroup label="Select Suite">
                                    <option value="">Please Select</option>
                                    	<?php foreach($suiteslist as $list) { ?>
										<option value="<?php echo $list['rental_id'];?>" <?php 
										if($deposit_refunds->suite_id==$list['rental_id']) echo "selected";?> date-suite-name="<?php echo $list['title']; ?>">
                                                  <?php echo $list['title']; ?></option>
                                        <?php } ?>
									</optgroup>
								</select>
							</div>
						</section>
                        <section>
							<label for="status">Select Tenant </label>
							<div>					
                            <select name="tenant_name" id="tenant_name" required >
                                <optgroup label="Select Tenant">
                                <option value="">Please Select</option>
                                </optgroup>
                            </select>
                            <input type="hidden" id="tenant_id" name="tenant_id" value="" >
							</div>
						</section>
                        <section>
							<label for="status">Select Room </label>
							<div>					
                                <select name="room" id="room" >
                                    <optgroup label="Select Room">
                                        <option value="">Select Room</option>
                                        <option value="Documents">Documents Only</option>
                                        <option value="Entrance">Entrance</option>
                                        <option value="LivingRoom">Living Room</option>
                                        <option value="DiningRoom">Dining Room</option>
                                        <option value="Kitchen">Kitchen</option>
                                        <option value="Bedroom1">Bedroom #1</option>
                                        <option value="Bedroom2">Bedroom #2</option>
                                        <option value="Bedroom3">Bedroom #3</option>
                                        <option value="Bedroom4">Bedroom #4</option>
                                        <option value="Bathroom1">Bathroom #1</option>
                                        <option value="Bathroom2">Bathroom #2</option>
                                        <option value="Other1">Other #1</option>
                                        <option value="Other2">Other #2</option>
                                        <option value="Other3">Other #3</option>
                                        <option value="Other4">Other #4</option>
                                        <option value="Other5">Other #5</option>
                                    </optgroup>
                                </select>
							</div>
						</section>
                       
                       <section>
							<label for="status">Select Type</label>
							<div>					
                                <input type="radio" id="type1" name="type" value="moveout" checked>Move-Out
                                <input type="radio" id="type2" name="type" value="movein">Move-In
							</div>
						</section>
                       
                        <section><label for="payment_proof">Take Photo</label>
							<div>
                            <input type="file" id="payment_proof" name="payment_proof[]" <?php 
                            if($mobile_tab==1) echo 'accept="image/*"  capture="camera"';?> multiple />
                                <?php $file_list  = explode(":-:",$deposit_refunds->payment_proof); 
                                ?>
                                <table id="uploaded_files_list" <?php if(sizeof($file_list) == 0) echo 'style="display:none;"';?>>
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Action</th>
                                        </tr>
                                     </thead>
                                        <tbody>
                                        <?php
                                         foreach($file_list as $list) { if($list=='') continue; ?>
                                            <tr>
                                                <td><?php 
                                                $image_name=substr(strstr($list,'-'),1);
                                                if(stripos($image_name,".png") OR stripos($image_name,".jpg") OR stripos($image_name,".gif")){
                                                 echo "<img src=\"upload/deposits/$list\"style='height:30px;float:left; margin-left: 20px;' >";
                                                }
                                                echo substr(strstr($list,'-'),1); ?></td>
                                                <td><a href="upload/deposits/<?php 
                                                echo $list;?>" target="_blank" class="btn i_preview btn_small" title="View"></a>  
                                                <a href="javascript:;" file_name="<?php echo $list;?>" class="delete_file btn i_cross btn_small" title="Delete"></a>
                                                </td>
                                            </tr>
                                         <?php } ?>     
                                        </tbody>
                                </table>
        					</div>
						</section>
                               <section style="display:none;">
                        <label for="administrative_notes">Notes <br><span></span></label>
							<div>
                            <textarea id="administrative_notes" name="administrative_notes" rows="8" ><?php 
                            echo cleanit($deposit_refunds->administrative_notes);?></textarea>
							</div>
						</section>
                        <section style="display:none;">
                            <div>
                            <button class="submit" name="manage_building_button" value="manage_building_button">Submit</button></div>
                        </section>
                     </fieldset>
                     <input type="hidden" name="action" value="1">
                    <input name="deposit_id" id="deposit_id" value="" type="hidden">
          </form>              
	</section>
	<?php include("footer.php");?>
        <script>
        $('form').wl_Form({ajax:false});
        $(document).ready(function(){	
            var payment_id = '<?php echo $payment_id;?>';
            var mobile_tab = '<?php echo $mobile_tab;?>';
            if(mobile_tab == 1) {
                $("span.action").html('Take a Picture');
            }
            if(payment_id > 0 ) {
                load_suites(); 
                setTimeout(load_tenants,1500);
                setTimeout(disable_fields,3000);
            }
            $("#building_id").change(function() { load_suites(); });
        });
        function disable_fields() {
            $("#building_id option:not(:selected)").prop('disabled', true);
            $("#suite_id option:not(:selected)").prop('disabled', true);
            $("#tenant_name option:not(:selected)").prop('disabled', true);
        }
        $("#suite_id").on("change",function(){
            var building_id = $("#building_id").val();
            if(building_id  <= 0) {
                alert("Select Building First");
                return false;      
            }  
          load_tenants();
          var owner_id = $('#suite_id').find('option:selected').attr('data-owner-id');
          if(owner_id > 0) {
              $("#owner_id").val(owner_id);
              $("#uniform-owner_id span").html($('#owner_id').find('option:selected').html());
          }
        }); 
		function load_suites() {
            var suite_id    = '<?php echo $deposit_refunds->suite_id;?>';
            var building_id = $("#building_id").val();
            var data1       = '<option value="">Please Select</option>';   
            if(building_id < 1 ) { 
                $('#suite_id').find('option').remove().end().append(data1);
                return false; 
            }
            if(building_id <  0 && suite_id != '') { alert("Please select a Building from the addresses"); return false }
            show_loader();
            var data = { 
                'ajax_building_id'	: building_id,
                'ajax_request'		: 2
                };
                    $.ajax({
                   type: "POST",
                   url: 'manage_tenants.php',
                   data: data, 
                   success: function(data) {
                        hide_loader();
                        if(data != '') {
                             data = data + ''; //<option value=0>All Suites</option>
                            $('#suite_id').find('option').remove().end().append(data).val('<?php echo $deposit_refunds->suite_id;?>');
                            $("#suite_id").val(suite_id);
                            //$("#uniform-suite_id span").html('<?php //echo $tenants->Tenant_Suite_Number;?>');
                        } else  $('#suite_id').find('option').remove().val('');
                   }
            }); 
		}
        function load_tenants() {
            var suite_id 		= $("#suite_id option:selected").attr("data-name");
            //var suite_id 		= $("#suite_id").val();
            var building_id 	= $("#building_id").val();
            if(suite_id == '') { alert("Please select a Unit"); return false }
            show_loader();
            var data = { 
                            'suite_id'			: suite_id,
                            'building_id'		: building_id,
                            'ajax_request'		: 'get_tenant_data',
                            'show_current'      : '1',
                            'show_archive'      : 1 
                        };
            $.ajax({
                   type: "POST",
                   url: 'manage_tenants.php',
                   data: data, // serializes the form's elements.
                   success: function(data)  {
                        hide_loader();
                        if(data != '')	$('#tenant_name').find('option').remove().end().append(data).val('');
                        else 			$('#tenant_name').find('option').remove().val('');
                        var tenant_name = '<?php echo $deposit_refunds->tenant_name;?>';
                        var tenant_id = '<?php echo $deposit_refunds->tenant_id;?>';
                        if(tenant_name != '' && tenant_id != '') {
                        $('#tenant_name option').each(function(index, element) {
                            var id      = $(this).attr('data-tenant-id');
                            var name    = $(this).attr('value');
                            if(name == tenant_name && id == tenant_id) $(this).attr("selected","selected");
                        });
                        }
                        if(tenant_name != '') {
                            //$("#tenant_name").val(tenant_name);
                            $("#uniform-tenant_name span").html(tenant_name);
                            var tenant_id = $("#tenant_name option:selected").attr("data-tenant-id"); 
                            $("#tenant_id").val(tenant_id);
                            //$("#tenant_name option:contains("+tenant_name+")").attr("selected",true); 
                        }
                   }
            }); 
		}
        $("#tenant_name").on("change",function(){
            var tenant_id = $("#tenant_name option:selected").attr("data-tenant-id");
			var type	  = $("input[name=type]:checked").val();
			
			if(type == 'movein') {
				$("#deposit_id").val('');
				return true; 
			}
			
            $("#tenant_id").val(tenant_id);
            var data = {
                "tenant_id" : tenant_id,
                "action" : 'get_deposit_id'
            };
                $.ajax({
                   type: "POST",
                   data:data,
                   url: 'Unit_Camera.php',
                   success: function(data)  {
                       if(data <1) {
                           alert("Deposit Refund Entry Not found for this Tenant");
                           return false;
                       }
                       $("#deposit_id").val(data);
                   }
                });
        });
        $("#payment_proof").on("change",function(){
			
		   var type	  		= $("input[name=type]:checked").val();
           var deposit_id 	= $("#deposit_id").val();
		   var tenant_id	= $("#tenant_id").val();
			
		   if(type == 'movein' && tenant_id == '') {
			   alert("Please select Tenant Information before uploading files");
               return false;
		   }
			
			
           if(type == 'moveout' && deposit_id < 1) {
               alert("Please select Tenant Information before uploading files");
               return false;
           }
           var room = $("#room").val();
           /*if(room == '') {
               alert("Please select a Room");
               return false;
           }*/
           show_loader();
           var formData = new FormData($(this).parents('form')[0]);
            $.ajax({
                url: 'Unit_Camera.php?img=multi&test=1',
                type: 'POST',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                success: function (data) {
                    hide_loader();
                    $("#uploaded_files_list tbody").empty().append(data);
                    $("#uploaded_files_list").show();
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            });
            return false; 
        });
        $('body').on("click",".delete_file",function(){
                var result  = confirm("Are you sure you want to delete?");
                if(result == false ) return false;
                var file_name = $(this).attr('file_name');
                $(this).closest('tr').remove();
                var deposit_id = $("#deposit_id").val();
                show_loader();
                $.ajax({
                   type: "POST",
                   url: 'Unit_Camera.php?img=del_multi&request='+deposit_id+'&delete_file='+file_name,
                   success: function(data)  {
                     //if(data == 'success') $(this).closest('tr').remove();
                    if(deposit_id == '') { 
                        var pph = $("#payment_proof_hv").val();
                        var temp = pph.split(':-:'); 
                        var i = temp.indexOf(file_name);
                        if(i != -1) {
                            temp.splice(i, 1);
                        }
                        var pp = temp.join(':-:');
                        $("#payment_proof_hv").val(pp);
                    }
                     hide_loader();
                   }
                });
        });
		</script>
        <script>
            $(document).ready(function(){
				$("a[rel^='prettyPhoto']").prettyPhoto({
                        theme: 'facebook',
                        slideshow: 5000,
                        autoplay_slideshow: false
                });
            });
        </script>
</body>
</html>








<?php
	include("includes/footer.php");
?>