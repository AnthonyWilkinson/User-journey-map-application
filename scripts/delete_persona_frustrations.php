<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "motivation delete", "", "");
echo makeSidebar();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbConn = databaseConn::getConnection();

$frustrationID = $_GET['frustrationID'];
$personaID = $_GET['personaID'];

$sql = "DELETE FROM CJ_frustrations WHERE  frustrationID = :frustrationID";

$query = $dbConn->prepare($sql);

$query->execute(array(':frustrationID' => $frustrationID));

header("Location: ../personaEdit.php?personaID=" . $personaID);