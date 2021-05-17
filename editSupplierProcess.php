<?php

require_once 'include/common.php';

$dao = new SupplierDAO();

$dao->rename($_POST['supplier_id'], $_POST['supplier_name']);

// send back to listing page
header("Location: supplierList.php");

?>