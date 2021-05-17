<?php

require_once 'include/common.php';

// isMissingOrEmpty(...) is in common.php
$errors = [isMissingOrEmpty('barge_mssi'), isMissingOrEmpty('barge_name'), isMissingOrEmpty('barge_LOA'), isMissingOrEmpty('barge_capacity')];
$errors = array_filter($errors);

if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: addBarge.php");
    exit();
}

function bargeVal($barge){
    $mssi = $barge[0];
    $loa = $barge[3];
    $capacity = $barge[4];
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


$bargeList = [$_POST['barge_mssi'], $_POST['barge_name'], 'Barge', $_POST['barge_LOA'], $_POST['barge_capacity']];
$errors = array_merge($errors, bargeVal($bargeList, FALSE));
$bargeDAO = new BargeDAO();

if ($bargeDAO->retrieve($_POST['barge_mssi'])) {
    $errors[] = "MSSI already exists!";
}
if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    Header("Location: addBarge.php");
} else {
    
    $barge = new Barge($_POST['barge_mssi'], $_POST['barge_name'], 'Barge', $_POST['barge_LOA'], $_POST['barge_capacity']);
    $add = $bargeDAO->add($barge);
    header("location: bargeList.php");
}


exit();
?>