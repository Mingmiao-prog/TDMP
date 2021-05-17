<?php

require_once 'include/common.php';

$dao = new BargeTicketDAO();

//$mssi, $caston, $castoff, $amtofcoal, $remarks, $cid
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

$old = $dao->retrieve($_POST['barge_ticket_id']);
$mvid = $old->getMVTicketID();

$bticket= new BargeTicket();

$dao->modify($_POST['barge_ticket_id'], $_POST['barge_name'], @$newcastonmvTime, @$newcastoffmvTime, @$newarrivalppTime, @$newcastonppTime, @$newcastoffppTime, $_POST['discharged_qty'], $_POST['remarks']);

// send back to listing page
header("Location: bargeTicketList.php?id=$mvid");

?>