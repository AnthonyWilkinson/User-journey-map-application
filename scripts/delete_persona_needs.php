<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "motivation delete", "", "");
echo makeSidebar();

$dbConn = databaseConn::getConnection();

$needID = $_GET['needID'];
$personaID = $_GET['personaID'];

$sql = "DELETE FROM CJ_needs WHERE  needID = :needID";

$query = $dbConn->prepare($sql);

$query->execute(array(':needID' => $needID));

header("Location: ../personaEdit.php?personaID=" . $personaID);