<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "motivation delete", "", "");
echo makeSidebar();

$dbConn = databaseConn::getConnection();

$goalID = $_GET['goalID'];
$personaID = $_GET['personaID'];

$sql = "DELETE FROM  CJ_goals_persona WHERE  goalID = :goalID";

$query = $dbConn->prepare($sql);

$query->execute(array(':goalID' => $goalID));

header("Location:../personaEdit.php?personaID=" . $personaID);