<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/dealers.php"); 
require("../includes/lib/functions/submenuBuilder.php");
require("../includes/lib/classes/a/points.php"); 
$users      = new users();   $users->require_logged_in("index.php");
$dealers    = new dealers();
$points     = new points();
$user_id    = $request->getvalue('request');
$action     = $request->postvalue('action');
$points_id  = $request->getvalue('points_id');
$dealerList=$dealers->getlist("dealer");
if($_SESSION['mode']=="dealer" OR $_SESSION['mode']=="broker"){
   // echo "Got to line ".__LINE__." in ".__FILE__." and user_id is $user_id  and  _SESSION['mode'] is ".$_SESSION['mode']." AND _SESSION['user_id'] is ".$_SESSION['user_id']."<br />";
    if($user_id <>$_SESSION['user_id'] ){
        header("Location: https://carleado.com/admin/dashboard.php");
        die;
    }
}
if($user_id>0)	$dealers->load($user_id);
if($points_id>0)	$points->load($points_id);



if($action!='') {
           $error = '';
                    $points->points_id = $points->points_id;
                    $points->dealer_id = $request->postvalue('dealer_id');
                    $points->points = $request->postvalue('points');
                    $points->points_description = $request->postvalue('points_description');
                    $points->points_date = $request->postvalue('points_date');
           if($error== '') {
            $points->save();
            header("Location:points.php");
           }
}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Points</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/dealer_points.php">Dealers Points</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_points.php">Edit/Add Points</a></li>
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
                <?php
	if($session->get('mode')=='dealer'){
       if($success){ 
        echo "<div style='width:80%; padding:20px; background-color: #9EE487; border-radius: 20px; text-align:center; font-size:24px;'>$success</div><br />";
       }
	   $pageTitle="<h1>Points</h1>";
       echo $pageTitle;
       }else{
?>
			<h1>Points</h1>
            <?php } ?> 
			<p></p>
		</div>	
        <?php if(@$error!='') { ?> <div class="alert warning "><?php echo $error;?></div><?php } ?>
		<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" id="action" name="action" value="save">
					<fieldset>
<section><label  class="formLabel" for="dealer_id">Dealer<br /><br />
<?php
//	$tot=$points->gettotal($points->dealer_id);
?>
</label><div>
<?php
?>
<select name="dealer_id" />
<option value="">Choose A Dealer</option>
<?php
	foreach($dealerList as $list){
       $select=($list['id']==$points->dealer_id)? "selected":"";
?>
	<option value="<?php echo $list['id'];?>" <?php echo $select;?> ><?php echo $list['company'].' - '.$list['company_trade_name'];?></option>
    <?php }?>
</select>
</div></section>
<section><label  class="formLabel" for="points">Points</label>
<div>
<input type="text" name="points" value="<?php echo $points->points; ?>"/>
</div></section>
<section>
<label  class="formLabel" for="points_description">Points Description</label><div>
<input type="text" name="points_description" value="<?php echo $points->points_description; ?>"/>
</div></section>
<section><label  class="formLabel" for="points_date">Points Date</label><div><input type="text" class="pointsInput date" name="points_date" value="<?php echo $points->points_date; ?>"/></div></section>
                        <section><input type="hidden" name="type" value="dealer"/>
							<div>
                                    <button class="reset">Reset</button>
                                    <button class="submit" name="manage_service_button" value="manage_service_button">Submit</button>
                            </div>
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
            var country = '<?php echo $dealers->country;?>';
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