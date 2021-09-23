<?php
 
error_reporting(0);
$objName="content";
   // require_once("includes/lib/classes/a/faq.php");
	include("includes/head.php");
    include("includes/header.php");
    //$FAQS = new FAQS(); // already opened in the head include.
   // $category=urldecode($_GET['cat']);
$FAQSlist = $FAQList->getlist();
?>
    <!-- Start Page Banner -->
<?php
	/*    <div class="page-banner">
      <div class="container">
           <div class="row">
          <div class="col-md-8"  style="margin-top: 20px;">
            <h2>Frequently Asked Questions <?php //echo ($b)? " For ".$category : "";?></h2>
          </div>
          <div class="col-md-4">
            <ul class="breadcrumbs">
              <li><a href="#">Home</a></li>
              <li>FAQ</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    */
?>
    <!-- End Page Banner -->
    <!-- Start Content -->
    <div id="content">
        
            
         <div style="text-align: center;"><img src="../images/prescriptionfiller-faq-page.jpg" style=" style="margin-top:100px;" /></div>     
            
            
            

      <div class="container">
        <div class="page-content">
          <div class="row">
            <div class="col-md-12 " style="margin-top: 108px;"> 
<h1>Frequently Asked Questions </h1>



	   <section class="ff_faqs">
    <div id="accordion">
       <?php  if($FAQSlist!='empty')
				{
					$i = 0;
				  foreach($FAQSlist as $list) {  
				    $i++; 
                    ?>
        <button class="ff_faq_header btn btn-link collapsed" data-toggle="collapse" data-target="#ff_item_<? echo $i;?>" aria-expanded="false" aria-controls="ff_item_<? echo $i;?>">
            <?php echo $list['question'];?>
        </button>

        <div id="ff_item_<? echo $i;?>" class="collapse" data-parent="#accordion">
            <div class="ff_faq_item">
               <?php echo $list['answer'];?>
            </div>
        </div>
   <?php
  }
  }else{
     $faqCopy= "No Data Available";
  }
  ?>
   
    </div>
</section> 
 </div>
      </div>
    </div>
</div>
<!-- End content -->
	
     
<?php
	include("includes/footer.php");
?>