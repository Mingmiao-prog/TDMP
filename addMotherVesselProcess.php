<?php

require_once 'include/common.php';

// isMissingOrEmpty(...) is in common.php
$errors = [isMissingOrEmpty('mothervessel_mssi'), isMissingOrEmpty('mothervessel_name'), isMissingOrEmpty('mothervessel_LOA'), isMissingOrEmpty('mothervessel_capacity')];
$errors = array_filter($errors);

if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: addMotherVessel.php");
    exit();
}

function mothervesselVal($mothervessel){
    $mssi = $mothervessel[0];
    $loa = $mothervessel[3];
    $capacity = $mothervessel[4];
    $messages = [];
    if (!is_numeric($mssi) || strlen($mssi) != 9) {
        $messages[] = "MSSI should be 9 digits long";
    }

    if (!is_numeric($loa)) {
        $messages[] = "LOA should be numeric";
    }

    if (!is_numeric($capacity)) {
        $messages[] = "Capacity should be numeric";
    }
    return $messages;
}

$mothervesselList = [$_POST['mothervessel_mssi'], $_POST['mothervessel_name'], 'MV', $_POST['mothervessel_LOA'], $_POST['mothervessel_capacity']];
$errors = array_merge($errors, mothervesselVal($mothervesselList, FALSE));
$mvDAO = new MotherVesselDAO();

if ($mvDAO->retrieve($_POST['mothervessel_mssi'])) {
    $errors[] = "MSSI already exists!";
}
if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    Header("Location: addMotherVessel.php");
} else {
    
    $mothervessel = new MotherVessel($_POST['mothervessel_mssi'], $_POST['mothervessel_name'], 'MV', $_POST['mothervessel_LOA'], $_POST['mothervessel_capacity']);
    $add = $mvDAO->add($mothervessel);
    header("location: mothervesselList.php");
}


exit();
?>