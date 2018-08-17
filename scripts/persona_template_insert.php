<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Add feeling", "", "");
echo makeSidebar();

$projectID = $_GET['projectID'];

$dbConn = databaseConn::getConnection();

$updateSQL = "INSERT INTO CJ_personas (personaName, occupation, age, children, martitalStatus, quote, digitalInclusionScale, personalProfile, image, projectID) values (:personaName, :occupation, :age, :children, :martital, :quote , :digital, :profile, :image , :projectID)";
$updateQuery = $dbConn->prepare($updateSQL);
$updateQuery->execute(array(':personaName' => 'John Bloggs', ':occupation' => 'IT Consultant', ':age' => '34', ':children' => '2', ':martital' => 'Married', ':quote' => 'I like software which is simple and easy to use', ':digital' => '8', ':profile' => 'Joe works for a digital agency for 10 years now as a website designer. He finds some of the website design process slightly annoying.', ':image' => 'default-profile.png', ':projectID' => $projectID));
$last_id = $dbConn->lastInsertId();

header('Location:../persona.php?personaID=' . $last_id);