<?php

require_once 'include/common.php';
require_once('include/BargeDAO.php');

$dao = new BargeDAO();

$dao->remove($barge);

// send back to listing page
header("Location: bargeList.php");

?>