<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/allergy_descriptions.php"); 

$users      = new users();$users->require_logged_in("login.php");
$allergy_descriptions    = new allergy_descriptions();
$id  = $request->getvalue('request');
##################### deleting a record #####
if($id!=''){
	$allergy_descriptions->delete($id);
    header("Location:allergy_descriptions.php");
    exit;
}
#############################################

$allergylist = $allergy_descriptions->getlist();
  
?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - allergy Descriptions</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/members.php">List allergy Descriptions</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>List allergy Descriptions</h1>
			<p></p>
		</div>	
        		<?php if($userslist!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>allergy Name </th><th>Description</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($allergylist as $list) { ?>
					<tr class="gradeX">
						<td><?php echo $list['allergy_name'];?> <?php echo $list['last_name'];?></td>
                        
                        <td><?php echo $list['allergy_description'];?></td>
                        <td class="c"><a href="manage_allergy_descriptions.php?request=<?php echo $list['id'];?>">Update</a> | 
                        <a href="allergy_descriptions.php?request=<?php echo $list['id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>