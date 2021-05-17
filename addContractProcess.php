<?php

require_once 'include/common.php';

$errors = [
    isMissingOrEmpty ('supplier_name', $_POST['supplier_name']),
    isMissingOrEmpty ('powerplant_name', $_POST['powerplant_name']),
    isMissingOrEmpty ('contract_name', $_POST['contract_name']),
];
$errors = array_filter($errors);

if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;

    include "addContract.php";
    exit();
}

$dao = new ContractDAO();

$contract= new Contract($_POST['supplier_name'], $_POST['powerplant_name'], $_POST['contract_name']);

if ($dao->retrieveByName($contract->getContractName())) {
    $errors[] = "Contract already exists!";
}
if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    
    include "addContract.php";
    exit();
}

$dao->add($contract);

// send back to listing page
header("Location: contractList.php");

?>