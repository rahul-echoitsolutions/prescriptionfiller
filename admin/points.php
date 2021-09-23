<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/dealers.php"); 
require("../includes/lib/classes/a/points.php");
require("../includes/lib/classes/a/settings.php");
require("../includes/lib/classes/a/dealer_quotes.php");
$users      		= new users();$users->require_logged_in("login.php");
$points    	= new points();
$settings   = new settings();
$dealers    = new dealers();
$quotes     = new quotes();
$tid  				= $request->getvalue('request');
##################### deleting a record #####
if($tid!=''){
	$points->delete($tid);
    header("Location:points.php");
    exit;
}
#############################################
if($_SESSION['mode']=="admin"){
$pointsList = $points->getlist();
}elseif($_SESSION['mode']=="dealer"){
$pointsList = $points->getlistDealer($_SESSION['user_id']);
$dealers->load($_SESSION['user_id']);

}
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Carcoins</title>
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
        <!-- Start of Bread Crumbs --------------->
        <div class="widget" id="widget_breadcrumb">
					<h3 class="handle">Sections</h3>
					<div>
						<ul class="breadcrumb" data-numbers="true">
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php">Dashboard</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/points.php">Carcoins</a></li>
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   

            	<div class="g12 nodrop">
			<h1 style="display: inline;">Carcoins<br /></h1>
            <?php if($session->get('mode')!='admin') { ?>
             <div style="display:inline; float: left; padding:10px; width:220px; height:110px; border:thin solid #ccc; text-align: center; margin-bottom: 10px;"><h3>YOUR CARCOINS</h3>
              <div style="font-size: 60px; color: green; margin-top:-15px; letter-spacing: -6px; font-family:'PT Sans', sans-serif !important; "><?php  //echo $points->getGrandTotal($dealers->id, $settings->get_value('points_for_quote'));
				
					echo $points->getDealerFreePoints($dealers->id);
				  ?>
            </div><div style=" font-size: 10px; line-spacing:6px;margin-top: -10px; margin-bottom:0px;">Based on <?echo ($points->quoteCoinCount($dealers->id));?> unique <?php echo ($points->quoteCoinCount($dealers->id)==1)? "quote" : "quotes";?>  less your redemptions plus your signing bonus or other awarded points.</div>
            
            
            </div><?php } ?>
			
		</div>	

		</div>	
        		<?php if($pointsList!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Date</th>
                        <th>Dealer</th>
                        <th>Carcoins</th>
                        <th>Description</th>
                           <?php if($session->get('mode')=='admin'){ ?>
					<th>Action</th>
                    <?php } ?>
					</tr>
				</thead>
				<tbody>
                <?php
                 foreach($pointsList as $list) { ?>
                	<?php 
                    $ctt++;
						if($list['dealer_id'] > 0 ) {
						  $dealers->load($list['dealer_id']);
                          }
                    if($ctt==1 AND $session->get('mode')!='admin' ){?>
                    <tr class="gradeX" style="display: xxxnone;">
                    
						<td data-order="1970-01-01">Total Quotes Carcoins</td>
                        
						<td><?php echo $dealers->company_trade_name;?> </td>
                        <td><?echo $quotes->quoteCoinCount($dealers->id)*$settings->get_value('points_for_quote') ;?></td>
                        <td>Carcoins Earned By Issuing Quotes</td>
                        </tr>
                     <?php  }  ?>
					<tr class="gradeX" >
                    
						<td data-order="<?php echo $list['points_date'];?>"><?php echo $list['points_date'];?></td>
						<td><?php echo $dealers->company_trade_name;?></td>
                        <td><?php echo $list['points'];?></td>
                        <td><?php echo $list['points_description'];?></td>
                        <?php if($session->get('mode')=='admin'){ ?>
                        
                        
                        <td class="c">
<a href="manage_points.php?points_id=<?php echo $list['points_id'];?>">Update</a> |
                        <a href="points.php?request=<?php echo $list['points_id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                        
                        
                           <?php } ?>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
           <?php }  else {   echo " Sorry - no record found"; }  ?>
		</section>
		<?php include("footer.php");?>
</body>
</html>