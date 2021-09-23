<footer id="footer" style=" border-top: 2px #ccc; max-width:99vw; display:block; position:relative; background-color: #E3E4E5; margin-top: 30px;">
  
		
        
        
        
        <?php
        // adjust footer alignment on home page.
	$homeOffset=($pageName=="home")? " margin-left:14px; " :"";
?>
        
	
    	<div class="container footer-inner col-sm-12"  style="   margin: 0 auto; ">
		  <div class="row" style="margin-left:0px !important;">
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="max-width: 46vw; <?php echo $homeOffset; ?>" >
				
                
                
                <div style="text-align:center;" >
                  <a href="#">
                    <img src="images/logo1-200.png" alt="Logo">
                  </a>
                </div>
                
                
                
                
                
                
                
                
			  <?php
              /*
	<nav class="footer-links text-center pt-2 pt-lg-0">
				<a href="how-it-works" class="scrollto">How It Works</a>
              <a href="blog">Blog</a>
				 <a href="about-us">About Us</a>
			  </nav>
              */
?>
			</div>
            
            
            
            
            
		  <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="max-width: 46vw;">
				<strong class="footer-list-heading">Information</strong>
			  <nav class="footer-links text-center pt-2 pt-lg-0">
              	<a href="how-it-works" class="scrollto">How It Works</a>
              <a href="blog">Blog</a>
				 <a href="about-us">About Us</a>
				<a href="faqs" class="scrollto">FAQs</a>
				
				<a href="contact">Contact Us</a>
			  </nav>
			</div>
			
            
              <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="max-width: 46vw;  <?php echo $homeOffset; ?>">
			  <strong class="footer-list-heading">LEARN MORE</strong>
			  <nav class="footer-links text-center pt-2 pt-lg-0">
				<a href="/terms-of-use" class="scrollto" sytle="letter-spacing:-1px;">Terms & Conditions</a>
				 <a href="/privacy-statement" class="">Privacy Statement</a>
				 
			  </nav>
			</div>
		
        
        
        
          <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="max-width: 46vw; padding-left: 10px;">
			<strong class="footer-list-heading">Connect WITH US</strong>
		  
			  <ul class="footer-icon" >
			
				<li><a href="https://instagram.com/" class="insta-icon"></a></li>
				
			  </ul>
			  
			</div>
    
		  </div>
          
          <div class="col-sm-12">
		  <p class="copy-right-text text-center" style="font-size: 10px !important;">Copyright &copy; 2019 - <?php echo date("Y");?>&nbsp;<a href="index.php" style="color: #00A2E8; font-size:10px;"><?php echo SITE_TITLE; ?></a>.<br />All Rights Reserved.</p>
          </div>
		</div>
  </footer><!-- #footer -->
  <a href="#" class="scrollToTop"></a>
   
   
<script>$(document).ready(function(){
			
		//Check to see if the window is top if not then display button
		$(window).scroll(function(){
			if ($(this).scrollTop() > 100) {
				$('.scrollToTop').fadeIn();
			} else {
				$('.scrollToTop').fadeOut();
			}
		});
		//Click event to scroll to top
		$('.scrollToTop').click(function(){
			$('html, body').animate({scrollTop : 0},800);
			return false;
		});
	});
		
</script>


  <!-- JavaScript Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="<?php echo HTTP_HOME_URL;?>js/jquery.min.js"></script>

<script src="<?php echo HTTP_HOME_URL;?>js/jquery-migrate.min.js"></script>

<script src="<?php echo HTTP_HOME_URL;?>js/easing.min.js"></script>
<script src="<?php echo HTTP_HOME_URL;?>js/wow.min.js"></script>
<?php echo $footer; ?>
<!-- Template Main Javascript File -->
<script src="<?php echo HTTP_HOME_URL;?>js/main.js"></script>
<!-- Swiper JS -->
<script src="<?php echo HTTP_HOME_URL;?>js/swiper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script> 

<?php
//	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

?>
<script src="admin/js/datatables.js"></script>

<script type="text/javascript" src="js/jquery.slicknav.js"></script>

<script>
	jQuery('.dropdown a').click(function(e){
		 e.preventDefault();
		 if($(this).next('ul').length>0)
		 {
		  jQuery(this).next('ul').toggle();
		 }
		 else
		 {
			window.location.href=$(this).attr('href');
		 }
	});
</script>		










<!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.dealers-slider', {
	 slidesPerView: 5,
	 spaceBetween:15,
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
	  autoplay: {
        delay: 1500,
        disableOnInteraction: false,
      },	
      breakpoints: {
	  1200: {
          slidesPerView: 5,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView:4,
          spaceBetween: 20,
        },
		991: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
        640: {
          slidesPerView:3,
          spaceBetween: 10,
        },
		576: {
          slidesPerView:2,
          spaceBetween: 10,
        },
        420: {
          slidesPerView: 1,
          spaceBetween: 10,
        } 
      }
    });
  </script>
   <script>
    var swiper = new Swiper('.testimonial-slider', {
	 slidesPerView: 1,
		centeredSlides:true,
      loop: true,
	  pagination: {
		el: '.swiper-pagination',
		type: 'bullets',
		 clickable: true,
	  },
	  autoplay: {
        delay: 10000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
  <script>
	$(document).ready(function(){

		$(document).on("click",function(event) {

			if($(event.target).attr('class') != 'toggle_menu') {
			
				var navId = ($(event.target).parents("#mySidenav").attr("id"));

				//console.log(navId);

				if(typeof navId === "undefined") {

					$('#mySidenav').attr("style","z-index: 9999999; width: 0px;");

				} else {

					$('#mySidenav').attr("style","z-index: 9999999; width: 300px;");
				}

				var target = $(event.target).attr('class');


				if(typeof target === "undefined") {

					//$('#mySidenav').attr("style","z-index: 9999999; width: 0px;");

				} else if(target == 'sidenav mob-menus') {

					$('#mySidenav').attr("style","z-index: 9999999; width: 300px;");

				} else if(target == 'closebtn') {

					$('#mySidenav').attr("style","z-index: 9999999; width: 0px;");
				}

				console.log(target);
			}
		

		});

	});    


  </script>
    <script>
 $(document).ready(function() {
    /*----------------------------------------------------------------------*/
		/* datatable plugin
		/*----------------------------------------------------------------------*/
		
		$content.find("table.datatable").dataTable({
			"bSort": true,
			"sPaginationType": "full_numbers",
			"aaSorting": [ [0,'desc'] ],
            "iDisplayLength": 50,
            "scrollX": true
		});
     });
        </script>