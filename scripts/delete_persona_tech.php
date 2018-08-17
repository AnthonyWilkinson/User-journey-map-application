<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "motivation delete", "", "");
echo makeSidebar();

$dbConn = databaseConn::getConnection();

$technologyID = $_GET['technologyID'];
$personaID = $_GET['personaID'];

$sql = "DELETE FROM CJ_technologies WHERE technologyID = :technologyID";

$query = $dbConn->prepare($sql);

$query->execute(array(':technologyID' => $technologyID));

header("Location: ../personaEdit.php?personaID=" . $personaID);
