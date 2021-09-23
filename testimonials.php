<?php 
include("includes/lib/configure.php");
$head.="
<title>".THIS_DOMAIN."</title>
<meta name=\"description\" content=\"".SITE_DESCRIPTION."\" />
<meta name=\"robots\" content=\"index,follow\" />
<meta name=\"googlebot\" content=\"index,follow\" />
<meta content=\"General\" name=\"Rating\" />
<meta name=\"language\" content=\"English\" />
<style>
form input{
    border:thin solid #ccc;
    border-radius:5px;
    padding:2px 10px 2px 15px !important;
    }
form  select{
    border:thin solid #ccc;
    border-radius:5px;
    padding:10px 10px 10px 15px !important;
    }
form select option span{
    font-size:50%;
    }
label{
    font-weight:800;
    font-size:11px;
    }
.opt{
    font-size:50%;
    }
.fill {
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden
}
.fill img {
    flex-shrink: 0;
    min-width: 100%;
    min-height: 100%
}
#carImageText p{
    opacity:0;
    transition: opacity 10s;
    -webkit-transition: opacity 10s; /* Safari */
}
.testimonial-quote{
    font-style: italic;
    background-image: url(images/quote.png);
    background-repeat: no-repeat;
    margin: 0;
    padding: 10px 0 0 40px;
}
</style>
";
require("Mobile-Detect-2.8.34/Mobile_Detect.php");
$detect = new Mobile_Detect;
if($detect->isMobile()){
    $a=1;
}
	include("includes/head.php");
    include("includes/header.php");
require("includes/lib/classes/a/testimonials.php"); 
function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}
$test = new testimonials();
$records=$test->getlist();
?>


   <?php
/*	<div class="page-banner" style="margin-top: 100px;">
      <div class="container">
           <div class="row">
          <div class="col-md-6">
            <h2>Testimonials</h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="index.php">Home</a></li>
              <li>Testimonials</li>
            </ul>
          </div>
        </div>
        </div>
      </div>
      */
?>
    <!-- End Page Banner -->
    <!-- Start Content -->
<img src="images/testimonials.jpg" style="width: 100%;">
    <div id="content" >
      <div class="container" style="background-color:rgba(255,255,255,0.8); ">
          <div class="row">
            <div class="col-md-12 top100">
               <!-- Toggle -->
<div class="wrap" style="height: auto !important;" id="about">
    <div class="indent">
     
        <div class="scroll">
            <div class="clearfix pos-rel" style="margin-top: 3px;">
            <h2>Testimonials</h2>
                <div class="grid_14">
                <h3><?=$heading;?>Read what our clients experienced.</h3>
                  <p>
                  <div class="testimonial-list"><br />

                 	 <ul class="testimonial-records">
							 <?php 
                             foreach($records as $record) { ?>
                             <li style="width:98%;" class="testimonial-no-margin">
                                    <div style="" class="testimonial-quote">
                              <?php if($record['image']){?>
                              <img src="images/testimonials/<?php echo $record['image'];?>" align="right" style="margin: 10px 0 10px 10px;">
                              <?php } ?>
                                <?php echo cleanit($record['contents']); ?>
                                         <div class="testimonial-contents">
                                            <span class="testimonial-from-name"><br /><strong>- <?php echo cleanit($record['name']); ?></strong></span>
                                            <?php
                                            if($record['contact']){ ?>
                                            <span class="testimonial-phone"> (<?php echo cleanit($record['contact']); ?>)</span>
                                          <?php  } ?>
                                         </div>
                                    </div>
                                    <div class="testimonial-div-clear"></div><br /><br />
                            </li> 
                            <?PHP } ?>
                     </ul>
                    </div>		  
				  </p>
                  	                <?php if($total_pages>1) { ?>
            	<!--------------------- Paging ------------------------------------------------------------------->
                <p style="float:right; margin-right:150px;">
                   <span class="<?=($page==1)?'pageOn':'pageOff';?>" title="First page"><?php if($page!=1) {?>
                   <a class="pagination_link" href="?<?=$section;?>page=1">&lt;&lt;</a><?php } else echo '&lt;&lt;'; ?></span>
                   <span class="<?=($page==1)?'pageOn':'pageOff';?>" title="Previous page" ><?php if($page>=2) {?>
                   <a class="pagination_link" href="?<?=$section;?>page=<?=$page-1;?>">&lt;</a><?php } else echo '&lt;';?></span>
						<?php for($i=1; $i<=$total_pages; $i++) { ?>
                   				<?php if($page==$i) { ?>
                                    		<span class="pageOn" ><?=$i;?></span>
								<? } else { ?>
                   							<span class="pageOff" ><a class = "pagination_link" href="?<?=$section;?>page=<?=$i;?>"><?=$i;?></a></span>
								<? } ?>
                   		<?php }	// end for loop?>
                  <span class="<?=($page==$total_pages)?'pageOn':'pageOff';?>" title="Next page" >
                  <?php if($page>$total_pages) { ?><a class = "pagination_link" href="<?=$seciont;?>?page=<?=$page+1;?>">&gt;</a><?php } else { ?>
                  &gt;<?php } ?>
                  </span>
                  <span class="<?=($page==$total_pages)?'pageOn':'pageOff';?>" title="Last page (<?=$total_pages;?>)" >
				  <? if($page!=$total_pages) { ?><a class = "pagination_link" href="?<?=$section;?>page=<?=$total_pages;?>">&gt;&gt;</a> 
				  <?php } else {?>
                  &gt;&gt; <?php } ?>
                  </span> 
                  <span style = 'font-weight:800;'><?=$total_records;?> <?php echo PAGES_FOUND ?></span>
                <!-------------------------------- END OF PAGING  ------------------------------>  
                </p>
                <?php } // if total_pages > 0?>
             </div>
            </div>
        </div>
    </div>
  <div class="divider pos_top"></div>
</div>
            </div>
           </div>
</div>
</div>
        <script>
		$('form').wl_Form({
			ajax:false
		});
		</script>
<?php
	include("includes/footer.php");
?>