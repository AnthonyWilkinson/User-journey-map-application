<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Add feeling", "", "");
echo makeSidebar();

$userJourneyID = $_GET['userJourneyID'];

$dbConn = databaseConn::getConnection();

$getstages = "SELECT stageID, stageDesc from CJ_stages WHERE userJourneyID = :userJourneyID";
$stageResult = $dbConn->prepare($getstages);
$stageResult->execute(array(':userJourneyID' => $userJourneyID));
$stageRS = $stageResult->fetchAll();

foreach ($stageRS as $Stagerow) {
    $insertFeeling = "INSERT INTO CJ_feelings (feelingDesc, userJourneyID) VALUES (:feelingDesc, :userJourneyID)";
    $insertResult = $dbConn->prepare($insertFeeling);
    $insertResult->execute(array(':feelingDesc'=> '', ':userJourneyID' => $userJourneyID));
}

header('Location:../userjourney.php?userJourneyID=' . $userJourneyID);