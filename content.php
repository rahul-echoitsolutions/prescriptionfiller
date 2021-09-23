<?php
if($_GET['page']==''){
   //header("Location:http://".THIS_DOMAIN."/index");
}

	include("includes/head.php");
    include("includes/header.php");
    ////////////  Start Consultation Form        
            $consultForm="<div class=\"consult-form\"><div id=\"form-messages\" style='color:orange; font-weight:bold;'></div><form id=\"ajax-contact\" method=\"post\" action=\"mailer.php\">   
<div style=\"font-size:12px; display:inline-block; text-align:justify; line-height: 16px; color: #333;\">
<div class=\"clear\"></div>
<label class=\"text-name\">FULL NAME</label>
                 <input id=\"name\" class=\"txtarea\" placeholder=\"Enter your full name\" type=\"text\" name=\"name\">
				<label  class=\"text-name\">EMAIL</label>
                 <input id=\"email\" class=\"txtarea2\" placeholder=\"Enter your email\" type=\"text\" name=\"email\">
                 <label class=\"text-name\">SUBJECT</label>
                 <input id=\"subject\" class=\"txtarea2\" placeholder=\"Subject\" type=\"text\" name=\"subject\" value=\"\">
				<label class=\"text-name\">PHONE</label>
                 <input id=\"phone\" class=\"txtarea3\" placeholder=\"###-###-####\" type=\"text\" name=\"phone\">
                 <label class=\"text-name\">BEST TIME TO CALL</label>
                 <input id=\"besttime\" class=\"txtarea3\" placeholder=\"Best Time\" type=\"text\" name=\"besttime\">
                 <label  class=\"text-name\">COMMENTS</label><br />
                 <textarea id=\"comments\" class=\"txtarea8\"   name=\"message\"></textarea>
                 <div class=\"field\">
				<button class=\"contact-btn btn-flat\" type=\"submit\" onclick=\"ga('send', 'pageview', '/virtual/consultation_form.php');\">REQUEST SUPPORT</button>
			</div><span style=\"font-size:10px; display:inline-block; text-align:justify; line-height: 10px; color: #444;\"><input class=\"cbox\" name=\"CASL\" type=\"checkbox\" value=\"I agree to receive emails, texts and other electronic communications containing promotions, news updates and other material regarding ".THIS_DOMAIN." products and services.\" style=\"display:inline-block; width:15px; height:15px; line-height: 10px; margin:0px; font-size: 10px; color:#fff;\" />&nbsp;&nbsp;&nbsp;I agree to receive emails, texts and other electronic communications containing promotions, news updates and other material regarding ".THIS_DOMAIN." products and services. You can withdraw your consent at any time. To learn more, view our <a href=\"privacy-statement\">Privacy Statement</a></span></form>	</div><div style='clear:both;'></div></div>";
////////////// End consultation form
$head.="<script src=\"js/app.js\"></script>
        <style>
        .desc p{margin-bottom:10px !important;}
         .desc li{margin-top:10px !important;}
        
        </style>";

	if(!$contents->title){
	   $contents->title="Page Not Found";
       $contents->image="404_error.jpg";
	}
?>
    <style>     
            .error { background-color:#F00 !important; padding:5px 10px; } 
            .success { padding:8px 11px !important; }
    </style>
    <!-- Start Page Banner -->
    <!-- Start Page Banner -->
<?php
/*	    <div class="page-banner">
      <div class="container">
           <div class="row">
          <div class="col-md-8" style="margin-top: 20px;">
            <h2><?php echo $contents->title; ?><?php //echo ($b)? " For ".$category : "";?></h2>
          </div>
          <div class="col-md-4">
            <ul class="breadcrumbs">
            <li><a href="index.php">Home</a></li>
               <li><?php echo $contents->title; ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    */
?>
    <!-- End Page Banner -->
    <!-- End Page Banner -->
    <!-- Start Content -->
    <div class="col-md-12 innerpage-banner" style=" padding-left: 0px !important; padding-right: 0px !important; top100">


</div>
<div class="clear"></div>


<?php
	
    if($contents->image!='') { 
               
                    $image_url = HTTP_HOME_URL.'images/cms/'.$contents->image;
                   echo "<span><img src='$image_url' width=\"100%\" class=\"topImage\" alt=\"$contents->image_alt\" /><BR></span>"; 
                   } ?><p>&nbsp;</p>

<?php if($contents->image!='') { 
                    $image_url = HTTP_HOME_URL.'images/cms/'.$contents->image;
                    echo "<div class='container'><br><h1 class='banner-heading'>$contents->title</h1></div></div>"; 
                    } ?>

    <div id="content" class="innerpage"> 
      <div class="container" style="background-color:rgba(255,255,255,0.8);">
        <div class="page-content">
          
<?php
if($contents->rightColumn!=''){ 
  
    ?>
    <div class="row top100">
     <div class="col-md-8">
               <!-- Toggle -->
            <div class="xxxxxpanel-group">
            <?php
	if(strpos($contents->description,"[[bitcoin_price]]")){
$url = "https://bitpay.com/api/rates";
$json = file_get_contents($url);
$data = json_decode($json, TRUE);
$rate = $data[5]["rate"];    
$cad_price = 1;    
$bitcoin_price = round( $cad_price / $rate , 8 );
$bitcoinPrice="Price as of ".date("l, F j, Y h:i A").": $ $cad_price Canadian Dollar (CAD) is equal to  $bitcoin_price Bitcoin (BTC)";
$contents->description=str_replace("[[bitcoin_price]]", $bitcoinPrice, $contents->description);      
	}
    if(strpos($contents->description,"[[consult form]]")){
                $contents->description=str_replace("[[consult form]]", $consultForm, $contents->description );
    }
 	//echo nl2br($contents->description); 
     echo $contents->description;
     ?>
      <?php if($contents->content_id == 10) {include('application/_goApplication.php');
                 }  ?>
                <?php if($contents->content_id == 53) {include('mortgage-calculator.php'); }  ?>
                <?php if($contents->content_id == 62) {include('car-loan-calculator.php'); }  ?>
            <!-- End Toggle -->
            </div>
          </div>
           <div class="col-md-4">
     <div class="yyyypanel-group">
     <?php $rightForm="<div class=\"right-column-form\"><div class=\"consultHeadline\">Ask a ".THIS_DOMAIN."  Partner to contact you as soon as possible</div>
        <div id=\"form-messages\"></div>			     
			   <form id=\"ajax-contact2\" method=\"post\" action=\"mailer.php\">
<div style=\"font-size:12px; display:inline-block; text-align:justify; line-height: 12px; color: #fff;\">
<div class=\"clear\"></div>
				<label class=\"text-name\">NAME</label>
                 <input id=\"name\" class=\"txtarea\" placeholder=\"Enter your name\" type=\"text\" name=\"name\">
				<label  class=\"text-name\">EMAIL</label>
                 <input id=\"email\" class=\"txtarea2\" placeholder=\"Enter your email\" type=\"text\" name=\"email\">
				<label class=\"text-name\">PHONE</label>
                 <input id=\"phone\" class=\"txtarea3\" placeholder=\"###-###-####\" type=\"text\" name=\"phone\">
                 <div class=\"field\">
				<button class=\"contact-btn btn-flat\" type=\"submit\" onclick=\"ga('send', 'pageview', '/virtual/right-column-contact-us-form.php');\">CONTACT US</button>
			</div> 
                <input id=\"subject\" type=\"hidden\" name=\"subject\" value=\"CONTACT US\">
                <span style=\"font-size:10px; display:inline-block; text-align:justify; line-height: 10px; color: #fff;\"><input class=\"cbox\" name=\"CASL\" type=\"checkbox\" value=\"I agree to receive emails, texts and other electronic communications containing promotions, news updates and other material regarding the ".THIS_DOMAIN." products and services.\" style=\"display:inline-block; width:15px; height:15px; line-height: 10px; margin:0px; font-size: 10px; color:#fff;\" />
                &nbsp;&nbsp;&nbsp;I agree to receive emails, texts and other electronic communications containing promotions, news updates and other material regarding the <strong>".THIS_DOMAIN."</strong> products and services. You can withdraw your consent at any time. To learn more, view our <a href=\"privacy-statement\">Privacy Statement</a></span>
			   </form></div></div><div style='clear:both;'></div> 										
		";
	/**
 *         <label class=\"text-name\">SUBJECT</label>
 *                  <input id=\"subject\" class=\"txtarea2\" placeholder=\"Subject\" type=\"text\" name=\"subject\" value=\"Free Consultation\">
 *         
 *         <label class=\"text-name\">BEST TIME TO CALL</label>
 *                  <input id=\"besttime\" class=\"txtarea3\" placeholder=\"Best Time\" type=\"text\" name=\"besttime\">
 *                  <label  class=\"text-name\">COMMENTS</label><br />
 *                  <textarea id=\"comments\" class=\"txtarea4\"   name=\"comments\"></textarea>
 */
        $dominionDirect="";
        //<img src=\"images/Dominion-Logo-Direct.jpg\" alt=\"Dominion-Logo-Direct-Lender\" style=\"margin-bottom:20px;\"/>";
  $freakedOut="<a href=\"how-to-get-a-car-loan-with-bad-credit\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/bad-credit-car-loans.jpg\" alt=\"bad-credi-car-loans\"  /></div></a>";
  $freeConsult="<a href=\"free-mortgage-consultation\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/free-consultation-mortgage-car.jpg\" alt=\"free-mortgage-consultation\"  /></div></a>";
  $secondMort="<a href=\"second-mortgage\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/second-mortgages-button.jpg\" alt=\"second-mortgages-button\"  /></div></a>";
  $mortConsol="<a href=\"consolidation-loans-edmonton-alberta\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/mortgage-debt-consolidation.jpg\" alt=\"mortgage-debt-consolidation\"  /></div></a>";
 $constMort="<a href=\"construction-mortgage-home-loan\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/home-construction-mortgage-button.jpg\" alt=\"home-construction-mortgage-button\"  /></div></a>";
  $refiCar="<a href=\"refinancing-a-car-loan\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/refinance-car-save-button.jpg\" alt=\"refinance-car-save-button\"  /></div></a>";
   $titleCar="<a href=\"refinancing-a-car-loan\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/refinance-car-save-button.jpg\" alt=\"refinance-car-save-button\"  /></div></a>";
$debtRelief="<a href=\"consolidation-loans-edmonton-alberta\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/debt-relief-mortgage.jpg\" alt=\"debt-relief-mortgage\"  /></div></a>";
$contents->rightColumn=str_replace("[[debt-relief-mortgage]]",$debtRelief, $contents->rightColumn );
  $homeEquity="<a href=\"edmonton-home-equity-loans-title-loans\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/loan-home-equity.jpg\" alt=\"loan-home-equity\"  /></div></a>";
    $contents->rightColumn=str_replace("[[loan-home-equity]]",$homeEquity, $contents->rightColumn );
  $refiMortgage="<a href=\"mortgage-refinancing-low-rate\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/refinance-mortgage.jpg\" alt=\"refinance-mortgage\"  /></div></a>";
    $contents->rightColumn=str_replace("[[refinance-mortgage]]",$refiMortgage, $contents->rightColumn );
  $firstTime="<a href=\"first-time-home-buyer-edmonton-alberta\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/first-time-home-buyer.jpg\" alt=\"first-time-home-buyer\"  /></div></a>";
    $contents->rightColumn=str_replace("[[first-time-home-buyer]]",$firstTime, $contents->rightColumn );
  $fastCash="<a href=\"vehicle-title-loans-edmonton\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/fast-cash-loans.jpg\" alt=\"fast-cash-loans\"  /></div></a>";
    $contents->rightColumn=str_replace("[[fast-cash-loans]]",$fastCash, $contents->rightColumn );
  $carRefi="<a href=\"refinancing-car-loan-refinance\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/car-refinance.jpg\" alt=\"car-refinance\"  /></div></a>";
    $contents->rightColumn=str_replace("[[car-refinance]]",$carRefi, $contents->rightColumn );
  $titleCar="<a href=\"cash-back-car-loan-refinance\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/cash-back-car-loans.jpg\" alt=\"cash-back-car-loans\"  /></div></a>";
    $contents->rightColumn=str_replace("[[cash-back-car-loans]]",$titleCar, $contents->rightColumn );
    $freeConsultation="<a href=\"free-mortgage-consultation\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/free-consultation.jpg\" alt=\"free-mortgage-consultation\"  /></div></a>";
    $contents->rightColumn=str_replace("[[free consultation]]",$freeConsultation, $contents->rightColumn );
      $mortgageCalculator="<a href=\"mortgage-calculator-alberta\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/mortgage-calculator.jpg\" alt=\"mortgage-calculator\"  /></div></a>";
    $contents->rightColumn=str_replace("[[mortgage calculator]]",$mortgageCalculator, $contents->rightColumn );
   $mortgageConsolidate="<a href=\"debt-consolidation-mortgage-broker-alberta\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/need-to-consolidate-widget.jpg\" alt=\"debt-consolidation-mortgage-broker-alberta\"  /></div></a>";
    $contents->rightColumn=str_replace("[[debt consolidation]]",$mortgageConsolidate, $contents->rightColumn );
   $mortgageRenewal="<a href=\"best-first-mortgage-rates-renewal-alberta\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/time-to-renew-widget-2.jpg\" alt=\"mortgage-renewal\"  /></div></a>";
    $contents->rightColumn=str_replace("[[time to renew]]", $mortgageRenewal, $contents->rightColumn );
   $mortgageEquity="<a href=\"home-equity-mortgage-loan-edmonton-alberta\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/home-equity-loans-widget.jpg\" alt=\"home-equity-loans\"  /></div></a>";
    $contents->rightColumn=str_replace("[[home equity]]",$mortgageEquity, $contents->rightColumn );
   $mortgageCommercial="<a href=\"commercial-mortgage-broker-property\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/need-a-commercial-mortgage.jpg\" alt=\"commercial-mortgage\"  /></div></a>";
    $contents->rightColumn=str_replace("[[commercial mortgage]]",$mortgageCommercial, $contents->rightColumn );
    /////////////
   $mortgageHow="<a href=\"how-it-works-mortgage-financing\" ><div style=\"width:350px; margin-bottom:10px;\"><img src=\"images/widgets/how-it-works.jpg\" alt=\"how-it works\"  /></div></a>";
    $contents->rightColumn=str_replace("[[how it works]]",$mortgageHow, $contents->rightColumn );
     
   
        //$contents->rightColumn= nl2br($contents->rightColumn);
        $contents->rightColumn= $contents->rightColumn;
        $contents->rightColumn=str_replace("[[right form]]", $rightForm, $contents->rightColumn );
        $contents->rightColumn=str_replace("[[freaked out]]", $freakedOut, $contents->rightColumn );
        $contents->rightColumn=str_replace("[[free-consultation-mortgage-car]]", $freeConsult, $contents->rightColumn );
        $contents->rightColumn=str_replace("[[second-mortgages-button]]", $secondMort, $contents->rightColumn );
        $contents->rightColumn=str_replace("[[mortgage-debt-consolidation]]", $mortConsol, $contents->rightColumn );
        $contents->rightColumn=str_replace("[[home-construction-mortgage-button]]",$constMort, $contents->rightColumn );
         $contents->rightColumn=str_replace("[[refinance-car-save-button]]",$refiCar, $contents->rightColumn );
	echo  $contents->rightColumn?>
            <!-- End Toggle -->
            </div>
          </div>
<?php
}else{
?>




<div class="row top50">
            <div class="col-md-12">
               <!-- Toggle -->
               
            <div class="zzzzpanel-group">
        
            
                     
        
            <?php 
            $contents->description=str_replace("[[consult form]]", $consultForm, $contents->description );
            //	echo nl2br($contents->description); 
                echo "<div class='desc'>".$contents->description."</div>";
                ?>
            <!-- End Toggle -->
                <?php //if($contents->content_id == 10) { include('application/_application.php'); }  ?>
                <?php if($contents->content_id == 10) { 				 				include('application/_goApplication.php');
                 }  ?>
                <?php if($contents->content_id == 53) { 				 				include('mortgage-calculator.php'); }  ?>
                <?php if($contents->content_id == 62) { 				 				include('car-loan-calculator.php'); }  ?>
            </div>
          </div>
<?php
	}
?>
          <!-- Divider -->
          <div class="hr1" style="margin-bottom:20px;"></div>
        </div>
      </div>
    </div>
    <!-- End content -->
<?php
	include("includes/footer.php");
?>