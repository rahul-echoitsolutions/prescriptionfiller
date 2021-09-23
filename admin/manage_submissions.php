<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/applications.php"); 
require("../includes/lib/classes/a/users.php"); 

$users = new users();

$apps = new applications();

$users->require_logged_in("login.php");

$apps_id = $request->getvalue('request');

if($apps_id>0){
	$apps->load($apps_id);
    }

$fn = $request->postvalue('vehicle_make');
if($fn!=''){
                $id							    		=	$request->postvalue('id');
				$apps->application_type				    =	$request->postvalue('application_type');
                $apps->vehicle_make                     =	$request->postvalue('vehicle_make');
                $apps->vehicle_model                     =	$request->postvalue('vehicle_model');
                $apps->vehicle_max_price                =	$request->postvalue('vehicle_max_price');
                $apps->vehicle_max_miles                =	$request->postvalue('vehicle_max_miles');
                $apps->vehicle_category                 =	$request->postvalue('vehicle_category');
                $apps->vehicle_body_type                =	$request->postvalue('vehicle_body_type');
                $apps->vehicle_color                    =   $request->postvalue('vehicle_color');
                $apps->vehicle_year_min                 =   $request->postvalue('vehicle_year_min');
                $apps->vehicle_year_max                 =   $request->postvalue('vehicle_year_max');
                $apps->vehicle_transmission             =   $request->postvalue('vehicle_transmission');

                $apps->preferred_contact_method         =   $request->postvalue('preferred_contact_method');
                $apps->preferred_contact_time           =   $request->postvalue('preferred_contact_time');
                $apps->radius                           =   $request->postvalue('radius');
                $apps->fuel_type                        =   $request->postvalue('fuel_type');   
                $apps->engine_type                      =   $request->postvalue('engine_type');
                
                
				$apps->employer_name					=	$request->postvalue('employer_name');
				$apps->loan_type						=	$request->postvalue('loan_type');
                $apps->loan_amount					    =	$request->postvalue('loan_amount');
				$apps->job_time						    =	$request->postvalue('job_time');
                $apps->job_title						=	$request->postvalue('job_title');
				$apps->amount_primary_income			=	$request->postvalue('amount_primary_income');
				$apps->frequency_primary_income			=	$request->postvalue('frequency_primary_income');
				$apps->work_phone						=	$request->postvalue('work_phone');
                $apps->amount_secondary_income		    =	$request->postvalue('amount_secondary_income');
                $apps->frequency_secondary_income		=	$request->postvalue('frequency_secondary_income');
				$apps->first_name					    =	$request->postvalue('first_name');
				$apps->last_name			        	=	$request->postvalue('last_name');
				$apps->address				            =	$request->postvalue('address');
				$apps->email					        =	$request->postvalue('email');
                $apps->city				                =	$request->postvalue('city');
                $apps->province			                =	$request->postvalue('province');
                $apps->mobile_phone                     =   $request->postvalue('mobile_phone');
                $apps->home_phone                       =   $request->postvalue('home_phone');
				$apps->their_employer_name			    =	$request->postvalue('their_employer_name');
                $apps->their_job_time			        =	$request->postvalue('their_job_time');
                $apps->their_job_title			        =	$request->postvalue('their_job_title');
                $apps->their_amount_primary_income		=	$request->postvalue('their_amount_primary_income');
                $apps->their_frequency_primary_income	=	$request->postvalue('their_frequency_primary_income');
                $apps->their_work_phone				    =	$request->postvalue('their_work_phone');
                $apps->their_frequency_secondary_income	=	$request->postvalue('their_frequency_secondary_income');
                $apps->their_amount_secondary_income	=	$request->postvalue('their_amount_secondary_income');
                $apps->their_sin			            =	$request->postvalue('their_sin');
                $apps->their_birthdate			        =	$request->postvalue('their_birthdate');
                $apps->their_first_name			        =	$request->postvalue('their_first_name');
                $apps->their_last_name			        =	$request->postvalue('their_last_name');
                $apps->their_email			            =	$request->postvalue('their_email');
                $apps->their_address			        =	$request->postvalue('their_address');
                $apps->their_city			            =	$request->postvalue('their_city');
                $apps->their_province			        =	$request->postvalue('their_province');
                $apps->their_home_phone			        =	$request->postvalue('their_home_phone');
                $apps->their_mobile_phone			    =	$request->postvalue('their_mobile_phone');
                $apps->vehicle_make_model			    =	$request->postvalue('vehicle_make_model');
                $apps->sin			                    =	$request->postvalue('sin');
                $apps->birthdate			            =	$request->postvalue('birthdate');
                $apps->best_time			            =	$request->postvalue('best_time');
                $apps->customer_comments			    =	$request->postvalue('customer_comments');
                $apps->dateentered			            =	$request->postvalue('dateentered');
                $apps->lastupdated			            =	$request->postvalue('lastupdated');
                $apps->completed			            =	$request->postvalue('completed');
                $apps->dealclosed			            =	$request->postvalue('dealclosed'); 
$apps->save();
header("Location:vehicle_submissions.php");
}
?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Manage Submissions</title>
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
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/vehicle_submissions.php">Manage Contents</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/manage_submissions.php">Manage Contents</a></li>
						</ul>
						<!--<p>
						<a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
						</p>-->
					</div>
				</div>
		<div class="g12 nodrop">
			<h1>Manage Submissions</h1>
			<p></p>
            
            <?php if(@$image_name_exist!='') { ?><div class="alert warning">ERROR : Image with the same name already exists</div> <?php } ?>
            <?php if(@$urlkey_status!='') { ?><div class="alert warning">ERROR : Another page with same URL KEY already exists.</div> <?php } ?>

            
		</div>	

		<form id="form" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" method="post" autocomplete="off" onSubmit="return validate_contents();" enctype="multipart/form-data">
												
					<fieldset>
						<label>Manage Submissions</label>
						         





<section><label for="application_type">Submission Type</label>
<div><input type="text" name="application_type" id="application_type" value="<?php echo $apps->application_type;?>"/></div>
</section>

	       
 <section><label for="loan_amount">Vehicle Make</label>
<div><input type="text" name="vehicle_make" id="loan_amount" value="<?php echo $apps->vehicle_make;?>"/></div>
</section>
<section><label for="vehicle_model">Vehicle Model</label>
<div><input type="text" name="vehicle_model" id="loan_amount" value="<?php echo $apps->vehicle_model;?>"/></div>
</section><section><label for="vehicle_max_price">Vehicle Max Price</label>
<div><input type="text" name="vehicle_max_price" id="vehicle_max_price" value="<?php echo $apps->vehicle_max_price;?>"/></div>
</section>
<section><label for="vehicle_max_miles">Vehicle Max Miles</label>
<div><input type="text" name="vehicle_max_miles" id="vehicle_max_miles" value="<?php echo $apps->vehicle_max_miles;?>"/></div>
</section>
<section><label for="vehicle_category">Vehicle Category</label>
<div><input type="text" name="vehicle_category" id="vehicle_category" value="<?php echo $apps->vehicle_category;?>"/></div>
</section><section><label for="vehicle_body_type">Vehicle Body Type</label>
<div><input type="text" name="vehicle_body_type" id="vehicle_body_type" value="<?php echo $apps->vehicle_body_type;?>"/></div>
</section>               




<section><label for="vehicle_color">Vehicle Color</label>
<div><input type="text" name="vehicle_color" id="vehicle_color" value="<?php echo $apps->vehicle_color;?>"/></div>
</section>  
<section><label for="vehicle_transmission">Vehicle Transmission</label>
<div><input type="text" name="vehicle_transmission" id="vehicle_transmission" value="<?php echo $apps->vehicle_transmission;?>"/></div>
</section> 
<section><label for="vehicle_body_type">Vehicle Engine</label>
<div><input type="text" name="engine_type" id="engine_type" value="<?php echo $apps->engine_type;?>"/></div>
</section>  

<section><label for="vehicle_body_type">Vehicle Fuel Type</label>
<div><input type="text" name="fuel_type" id="fuel_type" value="<?php echo $apps->fuel_type;?>"/></div>
</section>  
<section><label for="vehicle_body_type">Vehicle Body Type</label>
<div><input type="text" name="vehicle_body_type" id="vehicle_body_type" value="<?php echo $apps->vehicle_body_type;?>"/></div>
</section>  

<section><label for="vehicle_body_type">Shopping Radius</label>
<div><input type="text" name="radius" id="radius" value="<?php echo $apps->radius;?>"/></div>
</section>  

               


<section>
<label for="vehicle_max_price">Vehicle Min Year</label>
<div ><select id="from" placeholder="From" class="car_brand" name="vehicle_year_min" ><option value="">Please Choose a Minimum Year</option><?php for($i=date("Y")+1;$i>=1985;$i--){     $syear= ($apps->vehicle_year_min==$i)?"selected" : "";    echo"<option value='$i' $syear >$i</option>";}?></select></div>
</section>


<section>
<label for="vehicle_max_price">Vehicle Max Year</label>
<div ><select id="from" placeholder="From" class="car_brand" name="vehicle_year_max" ><option value="">Please Choose a Maximum Year</option><?php for($i=date("Y")+1;$i>=1985;$i--){     $syear= ($apps->vehicle_year_max==$i)?"selected" : "";    echo"<option value='$i' $syear >$i</option>";}?></select></div>
</section>





<section><label for="loan_amount">Loan Amount</label>
<div><input type="text" name="loan_amount" id="loan_amount" value="<?php echo $apps->loan_amount;?>"/></div>
</section>
<section><label for="employer_name">Company Name</label>
<div><input type="text" name="employer_name" id="employer_name" value="<?php echo $apps->employer_name;?>"/></div>
</section>
<section><label for="job_title">Job Title</label>
<div><input type="text" name="job_title" id="job_title" value="<?php echo $apps->job_title;?>"/></div>
</section>
<section><label for="work_phone">Work Phone</label>
<div><input type="text" name="work_phone" id="work_phone" value="<?php echo $apps->work_phone;?>"/></div>
</section>
<section><label for="first_name">First Name</label>
<div><input type="text" name="first_name" id="first_name" value="<?php echo $apps->first_name;?>"/></div>
</section>
<section><label for="last_name">Last Name</label>
<div><input type="text" name="last_name" id="last_name" value="<?php echo $apps->last_name;?>"/></div>
</section>
<section><label for="email">Email</label>
<div><input type="text" name="email" id="email" value="<?php echo $apps->email;?>"/></div>
</section>
<section><label for="address">Address</label>
<div><input type="text" name="address" id="address" value="<?php echo $apps->address;?>"/></div>
</section>
<section><label for="city">City</label>
<div><input type="text" name="city" id="city" value="<?php echo $apps->city;?>"/></div>
</section>
<section><label for="province">Province</label>
<div><input type="text" name="province" id="province" value="<?php echo $apps->province;?>"/></div>
</section>
<section><label for="best_time">Best Contact Method</label>
<div><input type="text" name="preferred_contact_method" id="preferred_contact_method" value="<?php echo $apps->preferred_contact_method;?>"/></div>
</section>
<section><label for="best_time">Best Time To Call or Contact</label>
<div><input type="text" name="best_time" id="best_time" value="<?php echo $apps->best_time;?>"/></div>
</section>
<section><label for="customer_comments">Customer Comments</label>

<div><textarea name="customer_comments" id="customer_comments" cols="45" rows="5"> <?php echo $apps->customer_comments;?></textarea></div>
</section>
<input type="hidden" name="dateentered" value="<?php echo $apps->dateentered;?>" />
<section><label for="customer_comments"></label>
		<div><button class="reset">Reset</button><button class="submit" name="manage_service_button" value="manage_service_button">Submit</button></div>
</section>
</fieldset>
          </form>              
			</section>
		<?php include("footer.php");?>
        
        
        <script>
		$('form').wl_Form({
			ajax:false
		});
		</script>
</body>
</html>