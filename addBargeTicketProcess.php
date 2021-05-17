<?php

require_once 'include/common.php';


$errors = [isMissingOrEmpty('discharged_qty')];
$errors = array_filter($errors);

$mvid = $_POST['mv_ticket_id'];

if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: addBargeTicket.php?id=$mvid");
    exit();
}

function bTicketVal($amt){
    $messages = [];

    if (!is_numeric($amt)) {
        $messages[] = "Amount of Coal should be numeric";
    }
    return $messages;
}
$errors = array_merge($errors, bTicketVal($_POST['discharged_qty'], FALSE));
$dao = new BargeTicketDAO();


if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: addBargeTicket.php?id=$mvid");
} else {

    if ($_POST['cast_on_mv']!=""){
        $newcastonmvTime = date("Y-m-d H:i:s", strtotime($_POST['cast_on_mv'])) ;
    }

    if ($_POST['cast_off_mv']!=""){
        $newcastoffmvTime = date("Y-m-d H:i:s", strtotime($_POST['cast_off_mv'])) ;
    }

    if ($_POST['arrival_pp']!=""){
        $newarrivalppTime = date("Y-m-d H:i:s", strtotime($_POST['arrival_pp'])) ;
    }

    if ($_POST['cast_on_pp']!=""){
        $newcastonppTime = date("Y-m-d H:i:s", strtotime($_POST['cast_on_pp'])) ;
    }

    if ($_POST['cast_off_pp']!=""){
        $newcastoffppTime = date("Y-m-d H:i:s", strtotime($_POST['cast_off_pp'])) ;
    }

    
    $bticket= new BargeTicket($mvid, $_POST['barge_name'], @$newcastonmvTime, @$newcastoffmvTime, @$newarrivalppTime, @$newcastonppTime, @$newcastoffppTime, $_POST['discharged_qty'], $_POST['remarks']);

    $dao->add($bticket);

    header("Location: bargeTicketList.php?id=$mvid");
}


exit();



?>