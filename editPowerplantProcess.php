<?php

require_once 'include/common.php';

$dao = new PowerplantDAO();

$dao->rename($_POST['powerplant_id'], $_POST['powerplant_name']);

// send back to listing page
header("Location: powerplantList.php");

?>