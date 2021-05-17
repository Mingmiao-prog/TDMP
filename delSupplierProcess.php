<?php

require_once 'include/common.php';

$dao = new SupplierDAO();

$dao->remove($_GET['id']);

// send back to listing page
header("Location: supplierList.php");

?>