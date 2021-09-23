<?php 

require("../includes/lib/common.php"); 
require("../includes/lib/classes/a/forms.php"); 
require("../includes/lib/classes/a/users.php"); 

$users  = new users(); $users->require_logged_in("login.php");
$forms  = new forms();
$type   = $request->getvalue('type');

############# Deleting a record ##############
if($request->getvalue('request')!=''){
	$forms->delete($request->getvalue('request'));
    header("Location:formqueries.php?type=$type");
    exit();
}


$formRequests = $forms->getlist($type,'id','desc');


?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - <?php echo $type;?></title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/formqueries.php?type=<?=$type;?>">Forms -> <?php echo $type;?></a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1><?php echo strtoupper($type);?></h1>
			<p></p>
		</div>	
        		<?php if($formRequests!='empty') {	mysql_select_db($secondaryDB,$cornerDB); ?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Date</th>
                        <th>Name </th>
                        <th>Email</th>
                        <?php if($type !='emailafriend' &&  $type!='contactus') { ?>
                        <th>Phone</th>
                        <?php } ?>
                        
                        <?php if($type =='contactus') { ?>
                        <th>Subject</th>
                        <?php } ?>
                        
                        <?php if($type =='emailafriend') { ?>
                        <th>Friend Name</th>
                        <th>Friend Email</th>

                        <?php } ?>
                        
                        <?php if($type =='emailafriend' || $type =='moreinfo' || $type =='historyreport') { ?>
                        <th>Comments</th>
                        <?php } ?>
                        
                        <?php if($type =='vehiclesourcing') { ?>
                        <th>Looking for </th>
                        <?php } ?>
                        

                        <?php if($type =='offer') { ?>
                        <th>Offer</th>
                        <?php } ?>
                        
                        <?php if($type =='testdrive') { ?>
                        <th>Best/Time Date</th>
                        <?php } ?>
                        
                        <th>Phone</th>
                        
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($formRequests as $list) { 
                
                    if($list['inventory_id'] > 0 ) {                    
                    $query = "select inventory.*, inventory_bodytype.title as bodytype, inventory_make.title as make, inventory_color.title as color, (select inventory_images.filen from inventory_images where inventory_images.inventory_id = inventory.id order by inventory_images.coverpic DESC LIMIT 1) as image from inventory left join inventory_make on inventory_make.id = inventory.id_make left join inventory_bodytype on inventory_bodytype.id = inventory.id_bodytype left join inventory_color on inventory_color.id = inventory.id_color where inventory.id = ".$list['inventory_id']." ORDER BY image DESC";
                    $result = mysql_query($query,$cornerDB); 
                    $row = mysql_fetch_array($result);
                    }

                ?>
					<tr class="gradeX">
                    
                        <td><?php echo date('F j, Y, g:i a',strtotime($list['date']));?></td>
                        <td><?php echo $list['name'];?> </td>
                        <td><?php echo $list['email'];?>xxxx</td>
                        <?php if($type !='emailafriend') { ?>
                        <td><?php echo $list['phone'];?>yyyy</td>
                        <?php } ?>
                        
                        <?php if($type =='emailafriend') { ?>
                        <td><?php echo $list['friendname'];?></td>
                        <td><?php echo $list['friendemail'];?></td>

                        <?php } ?>
                        
                        <?php if($type =='emailafriend' || $type =='moreinfo' || $type =='historyreport') { ?>
                        <td><?php echo $list['comments'];?></td>
                        <?php } ?>
                        
                        <?php if($type =='vehiclesourcing') { ?>
                        <td><?php echo $list['comments'];?> </td>
                        <?php } ?>
                        

                        <?php if($type =='offer') { ?>
                        <td><?php echo $list['offer'];?></td>
                        <?php } ?>
                        
                        <?php if($type =='testdrive') { ?>
                        <td><?php echo $list['besttime'];?></td>
                        <?php } ?>
                        
                        <td><?php if($list['inventory_id'] >0) { ?><a href="<?php echo HTTP_HOME_URL;?>inventory.php?id=<?php echo $list['inventory_id'];?>"><?php echo $row['year']." ".$row['make']." ".$row['model']; ?><BR><img src='http://carcorneredmonton.com/inventory/images/thumb_<?php echo $row['image']; ?>'></a> <?php } ?></td>
                        <td class="c"><a href="formqueries.php?request=<?php echo $list['id'];?>&type=<?php echo $type;?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>