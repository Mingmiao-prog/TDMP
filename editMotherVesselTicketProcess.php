<?php

require_once 'include/common.php';

$dao = new MVTicketDAO();

//$mssi, $caston, $castoff, $amtofcoal, $remarks, $cid

if ($_POST['cast_off']!=""){
    $newcastoffTime = date("Y-m-d H:i:s", strtotime($_POST['cast_off'])) ;
}

$old = $dao->retrieve($_POST['mvticketid']);
$cid = $old->getContractID();

$dao->modify($_POST['mother_vessel_name'], @$newcastoffTime, $_POST['amt_coal'], $_POST['remarks'], $_POST['mvticketid']);

// send back to listing page
header("Location: processTicketList.php?id=$cid");

?>