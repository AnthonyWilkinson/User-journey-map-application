<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "motivation delete", "", "");
echo makeSidebar();

$dbConn = databaseConn::getConnection();

$challengeID = $_GET['challengeID'];
$personaID = $_GET['personaID'];

$sql = "DELETE FROM  CJ_challenges WHERE  challengeID = :challengeID";

$query = $dbConn->prepare($sql);

$query->execute(array(':challengeID' => $challengeID));


header("Location: ../personaEdit.php?personaID=" . $personaID);


