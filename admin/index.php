<?php
require("../includes/lib/common.php");
require("../includes/lib/classes/a/users.php");

if($session->get('user_id')=='')
header("Location:login.php");
else
header("Location:dashboard.php");
?>