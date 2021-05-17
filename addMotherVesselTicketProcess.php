<?php

require_once 'include/common.php';

$errors = [isMissingOrEmpty('amt_coal')];
$errors = array_filter($errors);

$cid = $_POST['contract_id'];

if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: addTicket.php?id=$cid");
    exit();
}

function mvTicketVal($amt){
    $messages = [];

    if (!is_numeric($amt)) {
        $messages[] = "Amount of Coal should be numeric";
    }
    return $messages;
}
$errors = array_merge($errors, mvTicketVal($_POST['amt_coal'], FALSE));
$dao = new MVTicketDAO();


if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: addTicket.php?id=$cid");
} else {

    if ($_POST['cast_on']!=""){
        $newcastonTime = date("Y-m-d H:i:s", strtotime($_POST['cast_on'])) ;
    }

    if ($_POST['cast_off']!=""){
        $newcastoffTime = date("Y-m-d H:i:s", strtotime($_POST['cast_off'])) ;
    }
    
    $mvticket= new MVTicket($_POST['mv_name'], $cid , $newcastonTime, $newcastoffTime, $_POST['amt_coal'], $_POST['remarks']);

    $dao->add($mvticket);

    header("Location: processTicketList.php?id=$cid");
}


exit();

//$MSSI, $contractID, $castOn, $castOff, $amtOfCoal, $remarks


?>