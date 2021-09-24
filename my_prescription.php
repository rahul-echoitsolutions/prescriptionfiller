<?php
include("includes/head.php");

require("includes/lib/classes/a/prescriptions.php");

require("includes/lib/classes/a/members.php");

require("includes/lib/classes/a/physicians.php");

require("includes/lib/classes/a/pharmacies.php");

$physicians = new physicians();
$prescriptions = new prescriptions();
$members = new members();
$pharmacies = new pharmacies();

$listData = array();

if (isset($_GET['pharmacy'])) {
    $listData = $prescriptions->getPrescriptionByPharmacy($request->getvalue('pharmacy'));
} else if (isset($_GET['physician'])) {
    $listData = $prescriptions->getPrescriptionByPhysician($request->getvalue('physician'));
}

//echo '<pre>';
//print_r($listData);die;
$rooturl = "https://prescriptionfiller.com/";

require_once("Mobile-Detect-2.8.34/Mobile_Detect.php");

$detect = new Mobile_Detect;

$is_mobile = 0;

if ($detect->isMobile()) {

    $a = 1;

    $is_mobile = 1;
}

if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {

    $browser = "Firefox";
}


include("includes/header.php");
?>

<!-- End Page Banner -->

<img src="images/control-panel-logo.jpg" style="width: 100%;">

<!-- Start Content -->

<div id="content" >

    <section>

        <div class="container">
            <!-- Google Font and style definitions -->

            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.js"></script>
            <div class="g12 nodrop"><br /><br />
                <h1>Your Prescriptions</h1>
            </div>	

            <div class="page-content col-lg-12 col-md-12" id="dealerApp"> 

                <div class="page-content">
                    <div class="col-md-12">  
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>Date Entered</th>
                                    <th>Physician</th>
                                    <th>Pharmacy</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Delivery Status</th>
                                    <th>Review Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($listData) { ?>
                                    <?php
                                    foreach ($listData as $presc) {

                                        $pres_image = ($presc['image_binary']) ? "<img src=\"data:image/jpeg;base64, {$presc['image_binary']}\"; style='max-width:70px'>" : '';
                                        $update_btn = "<a title='Update Prescription' href='add_prescription.php?id={$presc['id']}'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\" style=\"font-size:15px;\"></i></a>";
                                        $delete_btn = "<a title='Delete Prescription' class='delete' href='buyers_dashboard.php?action=prescriptions&subaction=delete&pid={$presc['id']}'><i class=\"fa fa-window-close-o\" aria-hidden=\"true\" style=\"font-size:15px;color:red\"></i></a>";
                                        ?>
                                        <tr>
                                            <td><?php echo date("Y-m-d", strtotime($presc['created_at'])); ?></td>
                                           
                                            <?php if (isset($_GET['physician'])){ ?>
                                            <td><?php echo $prescriptions->getPhysician($presc['physician_id']); ?></td>
                                            <?php } else { ?>
                                                <td><a href="my_prescription.php?physician=<?php echo $presc['physician_id']; ?>"><?php echo $prescriptions->getPhysician($presc['physician_id']); ?></a></td>
                                            <?php } ?>
                                            
                                                
                                            <?php if (isset($_GET['pharmacy'])){ ?>
                                            <td><?php echo ucwords($prescriptions->getPharmacy($presc['pharmacy_id'])); ?></a></td>
                                            <?php } else { ?>
                                                <td><a href="my_prescription.php?pharmacy=<?php echo $presc['pharmacy_id']; ?>"><?php echo $prescriptions->getPhysician($presc['physician_id']); ?></a></td>
                                            <?php } ?>
                                                
                                                
                                            <td><?php echo $presc['description']; ?></td>
                                            <td><?php echo $presc['status']; ?></td>
                                            <td><?php echo $presc['delivery_status']; ?></td>
                                            <td><?php echo $presc['review_status']; ?></td>
                                            <td><a href='prescription_details.php?presID="<?php echo $presc['id'] ?>"'><?php echo $pres_image; ?></a></td>
                                            <td><?php echo $update_btn;?> | <?php echo $delete_btn; ?></td>
                                        </tr>

                                    <?php } ?>

<?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>             
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
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