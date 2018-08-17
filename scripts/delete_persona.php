<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Delete persona", "", "");
echo makeSidebar();

$dbConn = databaseConn::getConnection();

$personaID = $_GET['personaID'];
$projectID = $_GET['projectID'];


$delete_motivations = "DELETE from CJ_motavations where personaID = :personaID";
$delete_motivations_result = $dbConn->prepare($delete_motivations);
$delete_motivations_result->execute(array(':personaID' => $personaID));

$delete_needs = "DELETE from CJ_needs where personaID = $personaID";
$delete_needs_result = $dbConn->prepare($delete_needs);
$delete_needs_result->execute(array(':personaID' => $personaID));

$delete_challenges = "DELETE from CJ_challenges where personaID = :personaID";
$delete_challenges_result = $dbConn->prepare($delete_challenges);
$delete_challenges_result->execute(array(':personaID' => $personaID));

$delete_tech = "DELETE from CJ_technologies where personaID = :personaID";
$delete_tech_result = $dbConn->prepare($delete_tech);
$delete_tech_result->execute(array(':personaID' => $personaID));

$delete_frustrations = "DELETE from CJ_frustrations where personaID = :personaID";
$delete_frustrations_result = $dbConn->prepare($delete_frustrations);
$delete_frustrations_result->execute(array(':personaID' => $personaID));

$delete_goals = "DELETE FROM CJ_goals_persona WHERE personaID = :personaID";
$delete_goals_result = $dbConn->prepare($delete_goals);
$delete_goals_result->execute(array(':personaID' => $personaID));

$delete_persona = "DELETE from CJ_personas where personaID = :personaID";
$delete_persona_result = $dbConn->prepare($delete_persona);
$delete_persona_result->execute(array(':personaID' => $personaID));

header('Location: ../project_overview.php?projectID=' . $projectID);