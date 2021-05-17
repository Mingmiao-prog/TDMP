<?php

require_once 'include/common.php';
require_once 'include/MotherVesselDAO.php';

$dao = new MotherVesselDAO();

$dao->remove($mothervessel);

// send back to listing page
header("Location: mothervesselList.php");

?>