<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/pharmacies.php"); 
require("../includes/lib/classes/a/chains.php");
$users      = new users();$users->require_logged_in("login.php");
$pharmacies    = new pharmacies();
$chains        = new chains();
$id  = $request->getvalue('request');
##################### deleting a record #####
if($id!=''){
	$pharmacies->delete($id);
    header("Location:pharmacies.php");
    exit;
}
#############################################
$provList= $pharmacies->getProvinces();

$options['order_by']="city";
$options['sort_direction']=" ASC ";

$itemList = $pharmacies->getlist($options,$_POST['provinceChoice']);
  
?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Pharmacies</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/pharmacies.php">List Pharmacies</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>List Pharmacies</h1>
			<p></p>
            <h2>Select A Province</h2>
        <form action=""  method="post" target="_SELF"  >
            <select name='provinceChoice'>
            <?php
               
            
            foreach($provList as $key => $provName){
                
           echo"<option value='$provName[0]'>".ucwords($provName[0])." </option>";
                
             }   ?>
            }
	
</select><br /><br />
	<button type="submit" value="submit" />Submit Province</button>
</form><p>Click on any header to sort by that field.<br />Search using multiple search terms to locate a pharmacy. E.g. "Brandon Safeway" or "Winnipeg Shoppers Main"</p>            
		</div>	
        		<?php if($userslist!='empty' AND $_POST['provinceChoice'])
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Chain ID</th><th>Branch ID</th><th>Name</th><th>Address</th><th>City</th><th>Province</th><th>Phone Number</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($itemList as $list) { ?>
					<tr class="gradeX">
						<td><?php 
                        
                        $chains->load($list['chain_id']);
                        
                        echo ($list['chain_id'])? $list['chain_id']." - ".$chains->chain_name :"";?> </td>
                        
                        <td><?php echo $list['branch_no'];?></td>
                        
                            <td><?php echo $list['name'];?></td>
                             <td><?php echo $list['address'];?></td>
                              <td><?php echo ucwords(trim($list['city']));?></td>
                               <td><?php echo $list['province'];?></td>
                        
                        <td><?php echo $list['phone_number'];?></td>
                        
                        <td class="c"><a href="manage_pharmacies.php?request=<?php echo $list['id'];?>">Update</a> | 
                        <a href="pharmacies.php?request=<?php echo $list['id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo ($_POST['provinceChoice'])? " Sorry - no record found" : "Please Choose a Province"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>