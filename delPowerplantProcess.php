<?php

require_once 'include/common.php';

$dao = new PowerplantDAO();

$dao->remove($_GET['id']);

// send back to listing page
header("Location: powerplantList.php");

?>