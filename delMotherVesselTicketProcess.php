<?php

require_once 'include/common.php';

$dao = new MVTicketDAO();

$old = $dao->retrieve($_GET['id']);
$cid = $old->getContractID();
$dao->remove($_GET['id']);

// send back to listing page
header("Location: processTicketList.php?id=$cid");

?>