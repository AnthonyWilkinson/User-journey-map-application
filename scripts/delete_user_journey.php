<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Delete user journey", "", "");
echo makeSidebar();

$dbConn = databaseConn::getConnection();

$userJourneyID = $_GET['userJourneyID'];
$projectID = $_GET['projectID'];


$deleteFeelings = "DELETE from CJ_feelings where userJourneyID = :userJourneyID";
$deleteFeelingsResult = $dbConn->prepare($deleteFeelings);
$deleteFeelingsResult->execute(array(':userJourneyID' => $userJourneyID));

$deleteGoals = "DELETE from CJ_goals where userJourneyID = :userJourneyID";
$deleteGoalsResult = $dbConn->prepare($deleteGoals);
$deleteGoalsResult->execute(array(':userJourneyID' => $userJourneyID));

$deletePain = "DELETE from CJ_pain_points where userJourneyID = :userJourneyID";
$deletePainResult = $dbConn->prepare($deletePain);
$deletePainResult->execute(array(':userJourneyID' => $userJourneyID));

$deleteAction = "DELETE from CJ_actions where userJourneyID = :userJourneyID";
$deleteActionResult = $dbConn->prepare($deleteAction);
$deleteActionResult->execute(array(':userJourneyID' => $userJourneyID));

$deleteopportunities = "DELETE from CJ_opportunities where userJourneyID = :userJourneyID";
$deleteopportunitiesResult = $dbConn->prepare($deleteopportunities);
$deleteopportunitiesResult->execute(array(':userJourneyID' => $userJourneyID));

$deleteThinking = "DELETE from CJ_thinking where userJourneyID = :userJourneyID";
$deleteThinkingResult = $dbConn->prepare($deleteThinking);
$deleteThinkingResult->execute(array(':userJourneyID' => $userJourneyID));

$deleteNeeds = "DELETE from CJ_user_needs where userJourneyID = :userJourneyID";
$deleteNeedsResult = $dbConn->prepare($deleteNeeds);
$deleteNeedsResult->execute(array(':userJourneyID' => $userJourneyID));

$deleteImage = "DELETE from CJ_images where userJourneyID = :userJourneyID";
$deleteImageResult = $dbConn->prepare($deleteImage);
$deleteImageResult->execute(array(':userJourneyID' => $userJourneyID));

$deletestages = "DELETE from CJ_stages where userJourneyID = :userJourneyID";
$deletestageResult = $dbConn->prepare($deletestages);
$deletestageResult->execute(array(':userJourneyID' => $userJourneyID));

$deleteUserjourney = "DELETE from CJ_user_journeys where userJourneyID = :userJourneyID";
$deleteUserjourneyResult = $dbConn->prepare($deleteUserjourney);
$deleteUserjourneyResult->execute(array(':userJourneyID' => $userJourneyID));

header('Location: ../project_overview.php?projectID=' . $projectID);