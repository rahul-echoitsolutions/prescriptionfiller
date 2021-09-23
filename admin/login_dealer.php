<?php require("../includes/lib/common.php"); ?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	
	<title><?PHP echo SITE_TITLE;?> Administration | Login</title>
	
	<meta name="description" content="">
	
	
<?php require("includes/header_include.php");
$success=$_GET['success'];
?>	

<style>
    
    html{
        
        background-image: none;
           background-color: #fff;
        }
    header{
        background: none;
         background-color:  #fff;
    }
      form{
        
        background-image: none;
           background-color:  #fff;
        }
    section{
         background-image: none;
         background-color:  #fff;
         background:#fff;
    }
   section #content{
         background-image: none;
         background-color:  #fff;
    }
    .success{
    padding: 50px !important;
    background-color:#CCFFCC;
    border: thin solid green;
    border-radius:10px;
    text-align:center;
    margin: 0 auto;
    color:#000;
    }
        #hideMe {
    -moz-animation: cssAnimation 0s ease-in 5s forwards;
    /* Firefox */
    -webkit-animation: cssAnimation 0s ease-in 8s forwards;
    /* Safari and Chrome */
    -o-animation: cssAnimation 0s ease-in 8s forwards;
    /* Opera */
    animation: cssAnimation 0s ease-in 8s forwards;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
}
    </style>





</head>


<?php $mode="dealer";?>




<body id="login">


<?php
	 if($success){
            echo "<div class='success' id='hideMe'><h3>$success </h3><br /><br />Please login below.</div><div class='both'></div>";
            unset($success);
           
         }
?>




		<header>
			<div id="logo">
			
			</div>
		</header>
        
		<section id="content">
        <div class="alert warning" style="display:none;">Warning</div>
        <div class="alert success" style="display:none;">Success</div>
        
		<form action="" id="loginform" method="post">
        <input type="hidden" id="validate_user_url" name="validate_user_url"  value="validate_admin.php">
         	<fieldset>
				<section><label for="username">Physician Email Address</label>
					<div><input type="text" id="username" name="username" autofocus></div>
				</section>
				<section><label for="password">Physician Password<!--<a href="#">lost password?</a>--></label>
					<div><input type="password" id="password" name="password"></div>
					
				</section>
				<section>
                <input type="hidden" name="mode" id="mode" value="dealer"/>
                    <div><button class="fr submit" id="submit_button">Login</button></div>
				</section>
					
				
			</fieldset>
           
		</form>
		</section>
		<footer>Copyright by <?php echo SITE_URL;?> <?php echo date('Y');?></footer>
		<?php
	// Note: serialized by admin/custom.js  Validated by admin/validate_admin.php
?>
</body>
</html>