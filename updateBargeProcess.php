<?php

require_once('include/common.php');
require_once('include/BargeDAO.php');

$dao = new BargeDAO();

$barge->b_mssi = $_POST['update_mssi'];
$barge->b_name = $_POST['update_name'];
$barge->b_type = "Barge";
$barge->b_LOA = $_POST['update_LOA'];
$barge->b_cap = $_POST['update_capacity'];

$dao->modify($barge);

// send back to listing page
header("Location: bargeList.php");

?>