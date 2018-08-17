<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "motivation delete", "", "");
echo makeSidebar();

$dbConn = databaseConn::getConnection();

$motivationID = $_GET['motavationID'];
$personaID = $_GET['personaID'];

$sql = "DELETE FROM  CJ_motavations WHERE  motavationID = :motivationID";

$query = $dbConn->prepare($sql);

$query->execute(array(':motivationID' => $motivationID));

header("Location: ../personaEdit.php?personaID=" . $personaID);