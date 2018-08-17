<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Add stage", "", "");
echo makeSidebar();

$userJourneyID = $_GET['userJourneyID'];

$dbConn = databaseConn::getConnection();

$insert = "INSERT INTO CJ_stages (stageDesc, userJourneyID) VALUES (:stageDesc, :userJourneyID)";
$result = $dbConn->prepare($insert);
$result->execute(array(':stageDesc' => 'Untitled stage', ':userJourneyID' => $userJourneyID));

$count_stages = "SELECT stageID FROM CJ_stages WHERE userJourneyID = :userJourneyID";
$count_stages_result = $dbConn->prepare($count_stages);
$count_stages_result->execute(array(':userJourneyID' => $userJourneyID));
$count_stages_num = $count_stages_result->rowCount();

$countActions = "SELECT actionID FROM CJ_actions WHERE userJourneyID = :userJourneyID";
$countActionsResult = $dbConn->prepare($countActions);
$countActionsResult->execute(array(':userJourneyID' => $userJourneyID));
$action_count_num = $countActionsResult->rowCount();

if ($action_count_num != 0) {
    $insertActions = "INSERT INTO CJ_actions (actionDesc, userJourneyID) VALUES (:actionDesc, :userJourneyID)";
    $resultActions = $dbConn->prepare($insertActions);
    $resultActions->execute(array(':actionDesc' => '', ':userJourneyID' => $userJourneyID));
}

$countFeelings = "SELECT feelingID FROM CJ_feelings WHERE userJourneyID = :userJourneyID";
$countFeelingsResult = $dbConn->prepare($countFeelings);
$countFeelingsResult->execute(array('userJourneyID' => $userJourneyID));
$feeling_count_num = $countFeelingsResult->rowCount();

if ($feeling_count_num != 0) {
    $insertFeelings = "INSERT INTO CJ_feelings (feelingDesc, userJourneyID) VALUES (:feelingDesc, :userJourneyID)";
    $resultFeelings = $dbConn->prepare($insertFeelings);
    $resultFeelings->execute(array(':feelingDesc' => '', ':userJourneyID' => $userJourneyID));
}

$countGoals = "SELECT goalID FROM CJ_goals WHERE userJourneyID = :userJourneyID";
$countGoalsResult = $dbConn->prepare($countGoals);
$countGoalsResult->execute(array(':userJourneyID' => $userJourneyID));
$goal_count_num = $countGoalsResult->rowCount();

if ($goal_count_num != 0) {
    $insertGoals = "INSERT INTO CJ_goals (goalDesc, userJourneyID) VALUES (:goalDesc, :userJourneyID)";
    $resultGoals = $dbConn->prepare($insertGoals);
    $resultGoals->execute(array(':goalDesc' => '', ':userJourneyID' => $userJourneyID));
}

$countImages = "SELECT imageID FROM CJ_images WHERE userJourneyID = :userJourneyID";
$countImagesResult = $dbConn->prepare($countImages);
$countImagesResult->execute(array(':userJourneyID' => $userJourneyID));
$image_count_num = $countImagesResult->rowCount();

if ($image_count_num != 0) {
    $insertImage = "INSERT INTO CJ_images (imageName, imageURL, userJourneyID) VALUES (:imageName,:imageUrl, :userJourneyID)";
    $resultImages = $dbConn->prepare($insertImage);
    $resultImages->execute(array(':imageName' => '', ':imageUrl' => '', ':userJourneyID' => $userJourneyID));
}

$countOpportunities = "SELECT opportunityID FROM CJ_opportunities WHERE userJourneyID = :userJourneyID";
$countOpportunitiesResult = $dbConn->prepare($countOpportunities);
$countOpportunitiesResult->execute(array(':userJourneyID' => $userJourneyID));
$opp_count_num = $countOpportunitiesResult->rowCount();

if ($opp_count_num != 0) {
    $insertOpportunities = "INSERT INTO CJ_opportunities (opportunityDesc, userJourneyID) VALUES (:oppDesc, :userJourneyID)";
    $resultOpportunities = $dbConn->prepare($insertOpportunities);
    $resultOpportunities->execute(array(':oppDesc' => '', ':userJourneyID' => $userJourneyID));
}

$countPain = "SELECT painPointID FROM CJ_pain_points WHERE userJourneyID = :userJourneyID";
$countPainResult = $dbConn->prepare($countPain);
$countPainResult->execute(array(':userJourneyID' => $userJourneyID));
$pain_count_num = $countPainResult->rowCount();

if ($pain_count_num != 0) {
    $insertPain = "INSERT INTO CJ_pain_points (painPointDesc, userJourneyID) VALUES (:painPointDesc, :userJourneyID)";
    $resultPain = $dbConn->prepare($insertPain);
    $resultPain->execute(array(':painPointDesc' => '', ':userJourneyID' => $userJourneyID));
}

$countThinking = "SELECT thinkingID FROM CJ_thinking WHERE userJourneyID = :userJourneyID";
$countThinkingResult = $dbConn->prepare($countThinking);
$countThinkingResult->execute(array(':userJourneyID' => $userJourneyID));
$thinking_count_num = $countThinkingResult->rowCount();

if ($thinking_count_num != 0) {
    $insertThinking = "INSERT INTO CJ_thinking (thinkingDesc, userJourneyID) VALUES (:thinkingDesc, :userJourneyID)";
    $resultThinking = $dbConn->prepare($insertThinking);
    $resultThinking->execute(array(':thinkingDesc' => '', ':userJourneyID' => $userJourneyID));
}

$countUserNeeds = "SELECT userNeedID FROM CJ_user_needs WHERE userJourneyID = :userJourneyID";
$countUserNeedsResult = $dbConn->prepare($countUserNeeds);
$countUserNeedsResult->execute(array(':userJourneyID' => $userJourneyID));
$needs_count_num = $countUserNeedsResult->rowCount();

if ($needs_count_num != 0) {
    $insertUserNeed = "INSERT INTO CJ_user_needs (userNeedDesc, userJourneyID) VALUES (:userNeedDesc, :userJourneyID)";
    $resultUserNeed = $dbConn->prepare($insertUserNeed);
    $resultUserNeed->execute(array(':userNeedDesc' => '', ':userJourneyID' => $userJourneyID));
}

header('Location:../userjourney.php?userJourneyID=' . $userJourneyID);