<?php require("../includes/lib/common.php"); ?>
<?php require("../includes/lib/classes/a/faq.php"); ?>
<?php require("../includes/lib/classes/a/users.php"); 
$users = new users();
$users->require_logged_in("login.php");
?>

<?php
$FAQS = new FAQS();

////////// deleteing a record /////////
if($request->getvalue('request')!=''){
	$FAQS->delete($request->getvalue('request'));
}
////////////////// end of deletion ////////////

$FAQSlist = $FAQS->getlist();


?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - FAQS</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/FAQS.php">Manage FAQS</a></li>
                            
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
                
		<div class="g12 nodrop">
			<h1>Manage Website FAQS</h1>
			<p></p>
		</div>	
        		<?php if($FAQSlist!='empty')
				{
					$i = 0;
				?>	
                <table class="datatable">
				<thead>
					<tr>
						<th># </th><th>Question</th><th>Answer</th><th style="width: 150px;">Action</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach($FAQSlist as $list) {  $i++; ?>
					<tr class="gradeX">
						<td><?php echo $i;?></td>
                         <td><?php echo $list['question'];?></td>
                        <td class="c"><?php echo strip_tags(substr($list['answer'],0,100));?></td>
                        <td class="c"><a href="manage_faqs.php?request=<?php echo $list['FAQS_id'];?>">Update</a> | <a href="faqs.php?request=<?php echo $list['FAQS_id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            
           <?php }  else {   echo " Sorry - no record found"; }  ?>
                    
        
		</section>
		<?php include("footer.php");?>
</body>
</html>