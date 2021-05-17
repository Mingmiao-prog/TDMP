<?php

require_once 'include/common.php';

$dao = new ContractDAO();

$dao->modify($_POST['contract_id'], $_POST['contract_name'], $_POST['supplier_name'], $_POST['powerplant_name']);

// send back to listing page
header("Location: contractList.php");

?>