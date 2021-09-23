<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/dealers.php");
require("../includes/lib/classes/a/transactions.php");
require("../includes/lib/classes/a/applications.php"); 
 

$users      = new users();$users->require_logged_in("login.php");
$dealers    = new dealers();
$trans      = new transactions();
$app        = new applications();



//$member_id  = $request->getvalue('request');



$options="";

$transactions=$trans->getlist($options);


if($tid!=''){

	$transactions->delete($tid);

    header("Location:transactions.php");

    exit;

}


##################### deleting a record #####
if($member_id!=''){
	$dealers->delete($member_id);
    header("Location:dealers.php");
    exit;
}
#############################################



?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Transactions</title>
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
							
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php">Admin Dashboard</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/dealers.php">List Dealer Transactions</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>List Dealer Transactions</h1>
			<p></p>
		</div>	
        		<?php if($transactions!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Dealer Name </th><th>Date of Charge</th><th>Vehicle</th><th>Amount</th><th>Status</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($transactions as $list) { ?>
					<tr class="gradeX">
                    
                    <?php
                    	$dealers->load($list['dealer_id']);
                        $app->load($list['member_id']);
?>
						<td><?php echo $dealers->company_trade_name;?></td>
                        <td><?php echo date("F d, Y", strtotime($list['created']));?></td>
                        <td><?php echo $app->vehicle_make." ".$app->vehicle_model;?></td>
                        <td><?php echo "$".number_format($list['amount'],2);?></td>
                        <td><?php echo $list['stripeStatusCode'];?></td>
                        
             
                        <td class="c">

                        <a href="transactions.php?request=<?php echo $list['transaction_id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                        
                        
                        
                        
                      <?php   /* 
                                                <a href="manage_dealers.php?request=<?php echo $list['id'];?>">Update</a> | 
                        <a href="dealers.php?request=<?php echo $list['id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                        */
?>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>