<?php
	include("includes/head.php");
    include("includes/header.php");
?>


      <section class="pt-3 pb-3 mt-0 align-items-bottom d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-image: url(images/doctor-with-tablet-pc-and-prescription-at-clinic-1920-modified2.jpg); background-position:center;">
        <div class="container">
<img src="images/logo1-200.png" style="margin-top:20px; margin-left:auto; margin-right: auto; position: absolute;  left: calc(50% - 75px); margin: 0;">
          <div class="row  justify-content-md-start align-items-end d-flex  h-30 " style="margin-top:10px;">
        <?php
	   $textbg=($is_mobile)? " background-color:#fff; opacity:90%; border-radius: 30px; padding-top:20px;" :'';
?>  
            <div class="col-12   h-xxx50 text-center" style="margin-top: 220px; <?php echo $textbg; ?>">
              <h1 class="text-uppercase  text-center  mb-2 mt-xxx5"><strong>PRESCRIPTIONs MADE EASY</strong> </h1>
              <p class="lead    mb-3">It's quick. It's easy. Get your prescriptions filled the PRESCRIPTION FILLER way!</p>
              <p>
                <a href="#formLink" class="btn btn-primary shadow-lg btn-round mt-2 mr-2 mb-2 ml-0  btn-lg  ">Get started now </a>
              </p>
             <?php
/*	 <div class="btn-container-wrapper p-relative d-block  zindex-1">
                <a class="btn btn-link btn-lg   mt-md-3 mb-4 scroll align-self-center " href="#formLink">
                  <i class="fa fa-angle-down fa-lg "></i>
                </a>
              </div>*/
?>
            </div>
          </div>
        </div>
      </section>
      <section class="pt-5 pb-5 pb-0">
      
        <div class="container">
          <div class="row  text-center align-content-center justify-content-between ">
            <a name="formLink"></a><div class="col-12 col-md-7 text-left align-self-center ">
            <a id="#error"></a>
    

              <h2  class="mb-4"><strong>Get Started Here</strong></h2>
              <p class="lead">Just fill in your name and email address to get started. It's easy!</p>
              <p class="text-h3 mt-4">
              </p>
            </div>
            <div class="col-12  col-md-5 ">
              <div class="card shadow-lg text-left h-100">
                <div class="card-body">
                  <form action="new_user.php" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">First name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="first_name" placeholder="First Name">
                    </div>
                  <div class="form-group">
                      <label for="exampleInputName1">Last name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="last_name" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <button type="submit" class="btn btn-block btn-lg mt-3 btn-primary">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="pb-5 pt-5">
        <div class="container">
          <div class="row my-4">
            <div class="col-sm-6">
              <dl class=" ">
                <dd class="mb-5   d-flex justify-content-between">
                  <div class="featured-list-icon mt-1 mr-md-2">
                    <i class="far fa-2x fa-gem text-primary  rounded p-3"></i>
                  </div>
                  <div class="featured-list-content pl-4">
                    <h3>Feature title</h3>
                    <p>
                      Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. 
                    </p>
                  </div>
                </dd>
                <dd class="mb-5   d-flex justify-content-between">
                  <div class="featured-list-icon mt-1 mr-md-2">
                    <i class="far fa-2x fa-gem text-primary  rounded p-3"></i>
                  </div>
                  <div class="featured-list-content pl-4">
                    <h3>Feature title</h3>
                    <p>
                      Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. 
                    </p>
                  </div>
                </dd>
                <dd class="mb-5   d-flex justify-content-between">
                  <div class="featured-list-icon mt-1 mr-md-2">
                    <i class="far fa-2x fa-gem text-primary  rounded p-3"></i>
                  </div>
                  <div class="featured-list-content pl-4">
                    <h3>Feature title</h3>
                    <p>
                     Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. 
                    </p>
                  </div>
                </dd>
              </dl>
            </div>
            <div class="col-sm-6">
              <dl class=" ">
                <dd class="mb-5   d-flex justify-content-between">
                  <div class="featured-list-icon mt-1 mr-md-2">
                    <i class="far fa-2x fa-gem text-primary  rounded p-3"></i>
                  </div>
                  <div class="featured-list-content pl-4">
                    <h3>Feature title</h3>
                    <p>
                      Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. 
                    </p>
                  </div>
                </dd>
                <dd class="mb-5   d-flex justify-content-between">
                  <div class="featured-list-icon mt-1 mr-md-2">
                    <i class="far fa-2x fa-gem text-primary  rounded p-3"></i>
                  </div>
                  <div class="featured-list-content pl-4">
                    <h3>Feature title</h3>
                    <p>
                      Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. 
                    </p>
                  </div>
                </dd>
                <dd class="mb-5   d-flex justify-content-between">
                  <div class="featured-list-icon mt-1 mr-md-2">
                    <i class="far fa-2x fa-gem text-primary  rounded p-3"></i>
                  </div>
                  <div class="featured-list-content pl-4">
                    <h3>Feature title</h3>
                    <p>
                     Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. Please supply copy for this item. 
                    </p>
                  </div>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </section>
      <section class="mt-0 align-items-bottom d-flex bg-primary" style="min-height: 40vh; background-size: cover;">
        <div class="container">
          <div class="row  justify-content-start align-items-center   d-flex  h-100 ">
            <div class="col-sm-12 col-md-12  h-70 ">
              <h1 class="display-4 text-white mb-2 mt-5"><strong>Subscribe to our Newsletter</strong> </h1>
              <p class="lead  text-white mb-3">Learn ways to save on your prescriptions and get the best value.</p>
              <div class="justify-content-start d-flex mt-3 mb-1">
                <div class=" d-flex mt-3 mb-1">
                  <div class="input-group mb-3 shadow-lg">
                    <input type="text" class="form-control form-control-lg" placeholder="Enter Your Email" aria-label="Email" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-warning " type="button">Subscribe</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section style="" class="pt-xxx5 pb-5">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
              <h2 class="  text-center mb-5 mt-5">
                <strong>WHY EVERYONE USES PRESCRIPTIONFILLER </strong>
              </h2>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4  text-right" style="margin-top:30px;">
              <div class="my-3 card card-body shadow p-4">
                <div class="row align-items-center text-md-center text-lg-left">
                  <div class="col-12 col-md-9 mt-3 mt-lg-0">
                    <h4 class="">
                      FREE
                    </h4>
                    <p class="  sm-font-size text-dark-gray mb-0">
                      There is no charge to use PrescriptionFiller 
                    </p>
                  </div>
                  <div class="col-sm-12 col-sm-3 col-md-3 text-center px-0">
                    <div class="icon-wrap text-primary my-3">
                      <i class="icon p-4 border-primary bg-light text-primary md-font-size rounded-circle fa fa-mobile fa-lg"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="my-3 card card-body shadow p-4 ">
                <div class="row align-items-center d-flex text-md-center text-lg-left">
                  <div class="col-sm-12 col-md-9 mt-3 mt-lg-0">
                    <h4 class="">
                      WE CONNECT YOU TO YoUR PHARMACY
                    </h4>
                    <p class=" mb-0">
                     We forward your prescription straight to your pharmacy of choice. You just have to bring in the original
                    </p>
                  </div>
                  <div class="col-12 col-sm-3 col-md-3 text-center px-0">
                    <div class="icon-wrap text-primary my-3">
                      <i class="icon p-4 border-primary bg-light text-primary md-font-size rounded-circle fa fa-tint fa-lg"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="my-3 card card-body shadow p-4">
                <div class="row align-items-center text-md-center text-lg-left">
                  <div class="col-sm-12 col-md-9 mt-3 mt-lg-0">
                    <h4 class="">
                      CONVENIENCE
                    </h4>
                    <p class="  mb-0">
                      Send your prescription and pick it up. Avoid wait times
                    </p>
                  </div>
                  <div class="col-sm-12 col-sm-3 col-md-3 text-center px-0">
                    <div class="icon-wrap text-primary my-3">
                      <i class="icon p-4 border-primary bg-light text-primary md-font-size rounded-circle fa fa-lock fa-lg"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4  hidden-xsd-none d-sm-block  text-center">
              <div id="carousel-327990" class="carousel slide">
                <ol class="carousel-indicators bottom dark-indicators">
                  <li data-target="#carousel-327990" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-327990" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-327990" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item carousel-item active">
                    <img class="img-fluid img-center selected-img" src="images/user1.jpg" alt="">
                  </div>
                  <div class="item left carousel-item">
                    <img class="img-fluid img-center" src="images/doctor1.jpg" alt="">
                  </div>
                  <div class="item next left carousel-item">
                    <img class="img-fluid img-center" src="images/pharmasist1.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 text-left" style="margin-top:30px;">
              <div class="my-3 card card-body shadow p-4 ">
                <div class="row align-items-center d-flex text-md-center text-lg-left">
                  <div class="col-sm-12 col-sm-3 col-md-3 text-center px-0">
                    <div class="icon-wrap text-primary my-3">
                      <i class="icon p-4 border-primary bg-light text-primary md-font-size rounded-circle fa fa-tint fa-lg"></i>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-9 mt-3 mt-lg-0">
                    <h4 class="">
                     PRIVACY and SECURITY
                    </h4>
                    <p class=" mb-0">
                      ALL information provided is confidential.
                    </p>
                  </div>
                </div>
              </div>
              <div class="my-3 card card-body shadow p-4">
                <div class="row align-items-center text-md-center text-lg-left">
                  <div class="col-sm-12 col-sm-3 col-md-3 text-center px-0">
                    <div class="icon-wrap text-primary my-3">
                      <i class="icon p-4 border-primary bg-light text-primary md-font-size rounded-circle fa fa-lock fa-lg"></i>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-9 mt-3 mt-lg-0">
                    <h4 class="">
                      RECORD Of PReVIOUS PRESCRIPTION
                    </h4>
                    <p class="  mb-0">
                      Access your previously filled prescriptions.
                    </p>
                  </div>
                </div>
              </div>
              <div class="my-3 card card-body shadow p-4">
                <div class="row align-items-center text-md-center text-lg-left">
                  <div class="col-sm-12 col-sm-3 col-md-3 text-center px-0">
                    <div class="icon-wrap text-primary my-3">
                      <i class="icon p-4 border-primary bg-light text-primary md-font-size rounded-circle fa fa-mobile fa-lg"></i>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-9 mt-3 mt-lg-0">
                    <h4 class="">
                     EASY TO USE
                    </h4>
                    <p class="  sm-font-size text-dark-gray mb-0">
                      User Friendly.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="mt-0 mb-xxx5 pb-0 bg-dark cover" style="min-height: 50vw; background: url(images/pills.jpg)">
        <div class="container">
          <div class="row d-flex justify-content-center align-items-center" style="min-height: 50vw; ">
            <div class="col-md-7">
              <div class="card">
                <div class="card-body text-center p-5">
                  <h3 class="pb-2 h3 mt-1 font-weight-bold text-danger">Get Started Now</h3>
                  <p class="lead font-weight-bold">Click on the button below to upload your prescription.</p>
                  <a href="add_prescription.php" class="btn btn-lg btn-round btn-lg btn-danger btn-rised ml-md-4 mt-md-4">Upload Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      
      
      
      <?php /*
      <section class="mb-0 mt-0">
        <div class="footer text-white">
          <div class="   bg-dark pt-5 pb-5">
            <div class="container">
              <div class="row">
                <div style="text-align:center;" class="col-xl-6 col-lg-5 col-md-4 mb-3 mb-md-0">
                  <a href="#">
                    <img src="images/logo1-200.png" alt="Logo">
                  </a>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-8">
                  <div class="list-group">
                    <a href="#" class="list-group-item p-2 d-flex border-0 justify-content-between align-items-center bg-dark px-0">
                      <div class="d-flex align-items-center">
                        <span class="mb-0 h5 text-white">How It Works</span>
                      </div>
                      <i class="fas fa-chevron-right text-white"> </i>
                    </a>
                    <a href="#" class="list-group-item p-2 border-0 d-flex justify-content-between align-items-center bg-dark px-0">
                      <div class="d-flex align-items-center">
                        <span class="mb-0 h5 text-white">Sign Up Now</span>
                      </div>
                      <i class="fas fa-chevron-right text-white"> </i>
                    </a>
                    <a href="#" class="list-group-item p-2 border-0 d-flex justify-content-between align-items-center bg-dark px-0">
                      <div class="d-flex align-items-center">
                        <span class="mb-0 h5 text-white">About Us</span>
                      </div>
                      <i class="fas fa-chevron-right text-white"> </i>
                    </a>
                  </div>
                  <ul class="list-unstyled mt-2 mt-md-3">
                    <li class="py-1 pl-2">
                      <a href="#" class="text-white">Support Center</a>
                    </li>
                    <li class="py-1 pl-2">
                      <a href="#" class="text-white">Terms &amp; Conditions</a>
                    </li>
                    <li class="py-1 pl-2">
                      <a href="#" class="text-white">Privacy Policy</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="row justify-content-between align-items-center mt-3 mt-md-4">
                <div class="col-lg-auto col-12 order-lg-2">
                  <ul class="list-unstyled d-flex mb-lg-0">
                    <li class="text-white mx-2">
                      <a href="#">
                        <i class="fab fa-facebook text-white"></i>
                      </a>
                    </li>
                    <li class="text-white mx-2">
                      <a href="#">
                        <i class="fab fa-twitter text-white"></i>
                      </a>
                    </li>
                    <li class="text-white mx-2">
                      <a href="#">
                        <i class="fab fa-youtube text-white"></i>
                      </a>
                    </li>
                    <li class="text-white mx-2">
                      <a href="#">
                        <i class="fab fa-linkedin text-white"></i>
                      </a>
                    </li>
                    <li class="text-white mx-2">
                      <a href="#">
                        <i class="fab fa-instagram text-white"></i>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col order-lg-1">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      */
      
      include("includes/footer.php");
      
       ?>
      
      <!-- jQuery is required -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
    </body>
</html>