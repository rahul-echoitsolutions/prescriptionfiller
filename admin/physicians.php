<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php"); 
require("../includes/lib/classes/a/physicians.php"); 
require("../includes/lib/classes/a/doctor_additional.php");
$users      = new users();$users->require_logged_in("login.php");
$physicians    = new physicians();
$doctor_additional = new doctor_additional();
$id  = $request->getvalue('request');
##################### deleting a record #####
if($id!=''){
	$physicians->delete($id);
    header("Location:physicians.php");
    exit;
}
#############################################

$itemList = $physicians->getlist();
  
?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - physicians</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/physicians.php">List Physicians</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>List Physicians</h1>
			<p></p>
		</div>	
        		<?php if($userslist!='empty')
				{
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th>Physician Name</th><th>Clinics</th><th>Phone</th><th>Email</th><th>Specialty</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($itemList as $list) { ?>
					<tr class="gradeX">
						<td><?php echo $list['first_name']." ".$list['last_name']." ";?> </td>
                        
                        <td><?php 
                        
                        $clinics=explode(",",$list['doctor_additional_id']);
                        

                        
                        foreach($clinics as $value){
                            
                        
                            
                            $doctor_additional->load($value);
                            echo $doctor_additional->office_name."<br />";
                        }
               ?></td>
                        
                        
                        <td><?php echo $list['phone1'];?></td>
                        
                            <td><?php echo $list['email'];?></td>
                        
                        <td><?php echo $list['specialty'];?></td>
                        
                        <td class="c"><a href="manage_physicians.php?request=<?php echo $list['id'];?>">Update</a> | 
                        <a href="physicians.php?request=<?php echo $list['id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>