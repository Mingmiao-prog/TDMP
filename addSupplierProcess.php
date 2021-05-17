<?php

require_once 'include/common.php';

$errors = [
            isMissingOrEmpty ('supplier_name', $_POST['supplier_name']),
        ];
$errors = array_filter($errors);


if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;

    include "addSupplier.php";
    exit();
}

$dao = new SupplierDAO();

$supplier = new Supplier($_POST['supplier_name']);

if ($dao->retrieveByName($supplier->getSupplierName())) {
    $errors[] = "Supplier already exists!";
}
if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    
    include "addSupplier.php";
    exit();
}

$dao->add($supplier);

// send back to listing page
header("Location: supplierList.php");

?>