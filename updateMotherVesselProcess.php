<?php

require_once 'include/common.php';
require_once('include/MotherVesselDAO.php');

$dao = new MotherVesselDAO();

$mothervessel->mv_mssi = $_POST['update_mssi'];
$mothervessel->mv_name = $_POST['update_name'];
$mothervessel->mv_type = "MV";
$mothervessel->mv_LOA = $_POST['update_LOA'];
$mothervessel->mv_cap = $_POST['update_capacity'];

// var_dump($_POST);

$dao->modify($mothervessel);

// send back to listing page
header("Location: mothervesselList.php");

?>