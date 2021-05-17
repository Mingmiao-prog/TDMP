<?php

require_once 'include/common.php';

$dao = new BargeTicketDAO();

$old = $dao->retrieve($_GET['id']);

$cid = $old->getMVTicketID();
echo ($cid);
$dao->remove($_GET['id']);

// send back to listing page
header("Location: bargeTicketList.php?id=$cid");

?>