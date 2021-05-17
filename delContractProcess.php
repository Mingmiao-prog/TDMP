<?php

require_once 'include/common.php';

$dao = new ContractDAO();

$dao->remove($_GET['id']);

// send back to listing page
header("Location: contractList.php");

?>