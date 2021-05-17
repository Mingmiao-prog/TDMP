<?php

require_once 'include/common.php';

$errors = [
    isMissingOrEmpty ('powerplant_name', $_POST['powerplant_name']),
];
$errors = array_filter($errors);

if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;

    include "addPowerplant.php";
    exit();
}

$dao = new PowerplantDAO();

$powerplant= new Powerplant($_POST['powerplant_name']);

if ($dao->retrieveByName($powerplant->getPowerplantName())) {
    $errors[] = "Powerplant already exists!";
}
if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    
    include "addPowerplant.php";
    exit();
}

$dao->add($powerplant);

// send back to listing page
header("Location: powerplantList.php");

?>