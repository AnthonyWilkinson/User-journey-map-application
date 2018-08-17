<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Add user needs", "", "");
echo makeSidebar();

$userJourneyID = $_GET['userJourneyID'];

$dbConn = databaseConn::getConnection();

$getstages = "SELECT stageID, stageDesc from CJ_stages WHERE userJourneyID = :userJourneyID";
$stageResult = $dbConn->prepare($getstages);
$stageResult->execute(array(':userJourneyID' => $userJourneyID));
$stageRS = $stageResult->fetchAll();

foreach ($stageRS as $Stagerow) {
    $insert = "INSERT INTO  CJ_user_needs (userNeedDesc, userJourneyID) VALUES (:userNeedDesc, :userJourneyID)";
    $result = $dbConn->prepare($insert);
    $result->execute(array(':userNeedDesc' => '', ':userJourneyID' => $userJourneyID));
}

header('Location:../userjourney.php?userJourneyID=' . $userJourneyID);