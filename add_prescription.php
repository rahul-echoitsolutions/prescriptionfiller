<?php
include("includes/head.php");

require("includes/lib/classes/a/prescriptions.php");

require("includes/lib/classes/a/members.php");

require("includes/lib/classes/a/physicians.php");

require("includes/lib/classes/a/pharmacies.php");

$physicians = new physicians();

$physicians = new physicians();

$prescriptions = new prescriptions();

$prescription_id = $request->getvalue('id');

$members = new members();

$pharmacies = new pharmacies();

$id = $request->getvalue('request');

$action = $request->postvalue('action');


if ($prescription_id > 0)
    $prescriptions->load($prescription_id);

$members->load($_SESSION['user_id']);

    // Get extended health value from USERS table
    $extendedHealth = $members->medical_insurance_provider . ' ' . $members->carrier_number;

    if (!empty($prescription->extended_health)){
        $extendedHealth = $prescription->extended_health;
    }
   
    // Get extended health value from MEMBERS table
    $extendedHealth = $members->getExtendedHealth($_SESSION['user_id']);

$rooturl = "https://prescriptionfiller.com/";

require_once("Mobile-Detect-2.8.34/Mobile_Detect.php");

$detect = new Mobile_Detect;

if ($detect->isMobile()) {

    $a = 1;

    $is_mobile = 1;
}

if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {

    $browser = "Firefox";
}

if ($action == 'save') {

    $uploaded_file = $_FILES['payment_proof']['tmp_name'];

    if ($uploaded_file != '') {

        $prescriptions->image_binary = base64_encode(file_get_contents($uploaded_file));
    }

    $prescriptions->user_id = $_SESSION['user_id'];
    $prescriptions->physician_id = $request->postvalue('physician_id');
    $prescriptions->pharmacy_id = $request->postvalue('pharmacy_id');
    $prescriptions->description = $request->postvalue('description');
    $prescriptions->extended_health = $request->postvalue('extended_health');
    $prescriptions->urgency = $request->postvalue('urgency');

    if ($prescription_id == "")
        $prescriptions->created_at = date("Y-m-d H:i:s");
    $prescriptions->medical_notes = $request->postvalue('medical_notes');

    $prescriptions->save();

    echo '<script>window.location = "buyers_dashboard.php?action=prescriptions"; </script>';

    die();
}


$options = array();

$options['order_by'] = "";

$doclist = $physicians->getlist();

echo "<section class=\"ff_faqs\">

<div id=\"accordion\">";

$xxi = 0;
?>

<style>

    .inline{

        display:inline-block;

    }

    .outline{

        border:1px solid #ccc;

        padding: 20px;

    }

    input{

        width:80%;

        margin-bottom: 20px;

        padding: 10px;

    }

    label{

        margin-top: 20px;

    }

    .sm{

        font-size:70%;

    }

    .submit{

        background-color:#2681db;

        border:none;

        border-radius:5px;

        padding:10px 60px;

        color:#fff;



    }

</style>





<?php
include("includes/header.php");
?>

<!-- End Page Banner -->

<img src="images/enter-your-prescriptions.jpg" style="width: 100%;">

<!-- Start Content -->

<div id="content" >

    <section>

        <div class="container">


            <!-- Google Font and style definitions -->

            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">

            <link rel="stylesheet" href="css/style.css">

            <div class="g12 nodrop"><br /><br />

                <h1>Enter A New Prescription</h1>

                <p></p>

            </div>	





            <div class="page-content col-lg-12 col-md-12" id="dealerApp"> 

                <div class="page-content">



                    <div class="col-md-12">  





<?php if (@$error != '') { ?> <div class="alert warning "><?php echo $error; ?></div><?php } ?>



                        <form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">



                            <input type="hidden" id="action" name="action" value="save">



                            <fieldset>

                                <label><h3>Enter a New Prescription for <?php echo $members->name; ?></h3></label>



<?php
/*

  <section><label  class="formLabel" for="user_id">Member</label><div>







  <select name="user_id">

  <?php

  $memList=$members->getlist();

  echo "<option value=''>Choose Member</option> ";

  foreach($memList as $list){



  $selected=($prescriptions->user_id==$list['id'])? "selected" :"";



  echo "<option value='".$list['id']."' $selected>".$list['first_name']." ".$list['last_name']."</option> ";

  }

  ?>

  </select>

  </div></section>

 */
?>

                                <section><label  class="formLabel" for="physician_id">Physician</label><div>













                                        <select name="physician_id">

<?php
$options = array();



$options['order_by'] = "last_name";

$options['sort_direction'] = "ASC";



$physList = $physicians->getlist($options);

echo "<option value=''>Choose Physician</option> ";

foreach ($physList as $list) {



    $selected = ($prescriptions->physician_id == $list['id']) ? "selected" : "";



    echo "<option value='" . $list['id'] . "' $selected>" . $list['first_name'] . " " . $list['last_name'] . "</option> ";
}
?>

                                        </select>

                                    </div></section>















                                <section><label  class="formLabel" for="pharmacy_id">Pharmacy&nbsp;&nbsp;&nbsp;&nbsp;<span class="sm">Sorted by City by Name</span></label><div>











                                        <select name="pharmacy_id">

<?php
$options['order_by'] = "city,name";

$options['sort_direction'] = "asc";

$pharmList = $pharmacies->getlist($options);

echo "<option value=''>Choose Pharmacy</option> ";

foreach ($pharmList as $list) {



    $selected = ($prescriptions->pharmacy_id == $list['id']) ? "selected" : "";



    $pharm = ucwords($list['name']) . " - " . ucwords($list['address']) . " - " . ucwords($list['city']);



    echo "<option value='" . $list['id'] . "' $selected>$pharm</option> ";
}
?>

                                        </select>

                                    </div></section>



                                <section><label  class="formLabel" for="description">Description</label><div><input type="text" class="text" name="description" value="<?php echo $prescriptions->description; ?>"/></div></section>

                                <section><label  class="formLabel" for="extended_health">Extended Health</label><div><input type="text" class="text" name="extended_health" value="<?php echo $extendedHealth; ?>"/></div></section>

                                            <?php
                                            /*

                                              <section><label  class="formLabel" for="date_processed">Date Processed</label><div><input type="text" class="date" name="date_processed" value="<?php echo $prescriptions->date_processed; ?>"/></div></section>

                                              <section><label  class="formLabel" for="image">Image</label><div><input type="file" class="text" name="image" value="<?php echo $prescriptions->image; ?>"/></div></section>

                                              <section><label  class="formLabel" for="status">Status</label><div><input type="text" class="text" name="status" value="<?php echo $prescriptions->status; ?>"/></div></section>

                                              <section><label  class="formLabel" for="time_received">Time Received</label><div><input type="text" class="date" name="time_received" value="<?php echo $prescriptions->time_received; ?>"/></div></section>

                                              <section><label  class="formLabel" for="time_processed">Time Processed</label><div><input type="test" class="date" name="time_processed" value="<?php echo $prescriptions->time_processed; ?>"/></div></section>

                                              <section><label  class="formLabel" for="time_shipped">Time Shipped</label><div><input type="text" class="date" name="time_shipped" value="<?php echo $prescriptions->time_shipped; ?>"/></div></section>

                                             */
                                            ?>



                                <section>
                                    <label  class="formLabel" for="urgency">Urgency</label>
                                    <div>
                                        <select name="urgency">
                                            <option value="Normal" <?php echo $prescriptions->urgency == 'Normal' ? 'Selected="selected"': ''; ?>>Normal</option>
                                            <option value="Urgent" <?php echo $prescriptions->urgency == 'Urgent' ? 'Selected="selected"': ''; ?>>Urgent</option>
                                            <option value="Extremely Urgent" <?php echo $prescriptions->urgency == 'Extremely Urgent' ? 'Selected="selected"': ''; ?>>Extremely Urgent</option>
                                        </select>
                                    </div>
                                </section>





                                <?php
                                /*

                                  <section><label  class="formLabel" for="delivery_status">Delivery Status</label><div><input type="text" class="text" name="delivery_status" value="<?php echo $prescriptions->delivery_status; ?>"/></div></section>

                                  <section><label  class="formLabel" for="review_status">Review Status</label><div><input type="text" class="text" name="review_status" value="<?php echo $prescriptions->review_status; ?>"/></div></section>

                                  <section><label  class="formLabel" for="review_reason">Review Reason</label><div><input type="text" class="text" name="review_reason" value="<?php echo $prescriptions->review_reason; ?>"/></div></section>

                                  <section><label  class="formLabel" for="image_path">Image Path</label><div><input type="text" class="text" name="image_path" value="<?php echo $prescriptions->image_path; ?>"/></div></section>

                                  <section><label  class="formLabel" for="fax_id">Fax Id</label><div><input type="text" class="text" name="fax_id" value="<?php echo $prescriptions->fax_id; ?>"/></div></section>

                                  <section><label  class="formLabel" for="udated_at">Udated At</label><div><input type="text" class="text" name="udated_at" value="<?php echo $prescriptions->udated_at; ?>"/></div></section>

                                  <section><label  class="formLabel" for="created_at">Created At</label><div><input type="text" class="text" name="created_at" value="<?php echo $prescriptions->created_at; ?>"/></div></section>



                                 */
                                ?>

                                <section><label  class="formLabel" for="medical_notes">Medical Notes</label><div><textarea class="text" name="medical_notes" style="height:200px; width:80%;"/><?php echo $prescriptions->medical_notes; ?></textarea></div></section>



                                <?php
                                /*



                                  <section><label  class="formLabel" for="tax_status">Tax Status</label><div><input type="text" class="text" name="tax_status" value="<?php echo $prescriptions->tax_status; ?>"/></div></section>

                                  <input type="hidden" name="id" value="<?php echo $id;?>">



                                 */
                                ?>

                                <section><label for="payment_proof">Take Photo (mobile) or Upload Image</label>

                                    <div>

                                        <img src="images/upload-image.png" id="open_fileupload" style="margin: 10 0px;cursor: pointer;">

                                        <input type="file" id="payment_proof" name="payment_proof" <?php if ($mobile_tab == 1) echo 'capture="camera"'; ?> accept="image/jpeg" style="display: none;" />


                                <?php
                                $pres_image = ($prescriptions->image_binary) ? "<BR><img src=\"data:image/jpeg;base64, {$prescriptions->image_binary}\"; style='width:300px; margin:20px; border:3px solid #FFF;'>" : '';

                                echo $pres_image;
                                ?>

                                    </div>

                                </section>





                                <div style="margin-top: 15px;">



                                    <button class="submit" name="manage_service_button" value="manage_service_button" style="cursor: pointer;">Submit</button>

                                </div>

                                </section>

                            </fieldset>

                        </form> 







                    </div>

                </div>             

                </section>

<?php //include("includes/footer.php"); ?>





                <script>

                    $('form').wl_Form({

                        ajax: false

                    });



                    $(document).ready(function (e) {



                        var country = '<?php echo $members->country; ?>';

                        if (country != '')
                            $("#form-country").val(country);



                    });





                    $("input[name=baddress_option]").on("click", function () {

                        var val = $(this).val();



                        if (val == 'o') {



                            /*$(".baddress").show();
                             
                             $("textarea[name=address]").attr('required','required').val('');
                             
                             */

                        } else {



                            $("select[name=billing_country]").val($("select[name=country]").val());

                            $("select[name=billing_province]").val($("select[name=province]").val());

                            $("input[name=billing_city]").val($("input[name=city]").val());

                            $("input[name=billing_street]").val($("input[name=street]").val());

                            $("input[name=billing_postcode]").val($("input[name=postcode]").val());

                        }

                    });



                </script>

                </body>

                </html>









































































            </div>



    </section>

<?php
include("includes/footer.php");
?>

    <script>
        $(document).ready(function () {


            $("#open_fileupload").on("click", function () {
                $("#payment_proof").click();
            });
        });

    </script>