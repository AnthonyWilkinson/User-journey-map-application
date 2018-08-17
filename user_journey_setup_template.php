<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Create user journey map", "", "");

$dbConn = databaseConn::getConnection();
$projectID = $_GET['projectID'];

if (isset($_POST['newJourneyMap'])) {
    //get the inputs from the form
    $userjourneyName = isset($_REQUEST["journeyName"]) ? $_REQUEST["journeyName"] : null;
    $personaid = isset($_REQUEST["persona"]) ? $_REQUEST["persona"] : null;
    //sanitize the inputs
    $userjourneyName = filter_var($userjourneyName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $personaid = filter_var($personaid, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $userjourneyName = filter_var($userjourneyName, FILTER_SANITIZE_SPECIAL_CHARS);
    $personaid = filter_var($personaid, FILTER_SANITIZE_SPECIAL_CHARS);

    $errors = array();

    if (empty($userjourneyName)) {
        $errors[] = "You have not entered a user journey map name";
    }

    if (strlen($userjourneyName) > 225) {
        $errors[] = "Your user journey map name is too long";
    }

    //if errors array is not empty
    if (!empty($errors)) {
        echo "<div class=\"ErrorMessages\">";
        echo "<b>The following errors occurred:</b>";
        foreach ($errors as $currentError) {
            echo '<li>' . $currentError . '</li>';
        }
        echo "</div>";
    } else {
        $createUserjourney = "INSERT INTO CJ_user_journeys (nameOfJourney, projectID, personaID) VALUES (:userjourneyName, :projectID, :personaid)";
        $stmt = $dbConn->prepare($createUserjourney);
        $stmt->execute(array(':userjourneyName' => $userjourneyName, ':projectID' => $projectID, ':personaid' => $personaid));
        // gets the last inserted primary key
        $last_id = $dbConn->lastInsertId();

        $insert_stages = "INSERT INTO CJ_stages (stageDesc, userJourneyID) VALUES (:stage1, :lastID), (:stage2, :lastID), (:stage3, :lastID), (:stage4, :lastID)";
        $stmt_stages = $dbConn->prepare($insert_stages);
        $stmt_stages->execute(array(':stage1' => 'Research travel', ':stage2' => 'Book flight', ':stage3' => 'Pre-travel', ':stage4' => 'Travel:boarding', ':lastID' => $last_id));

        $insert_feelings = "INSERT INTO CJ_feelings (feelingDesc, userJourneyID) VALUES (:feeling1, :lastID), (:feeling2, :lastID), (:feeling3, :lastID), (:feeling4, :lastID)";
        $stmt_feelings = $dbConn->prepare($insert_feelings);
        $stmt_feelings->execute(array(':feeling1' => 'Confused', ':feeling2' => 'Unsure', ':feeling3' => 'Hopeful', ':feeling4' => 'Happy', ':lastID' => $last_id));

        $insert_goals = "INSERT INTO CJ_goals (goalDesc, userJourneyID) VALUES (:goal1, :lastID), (:goal2, :lastID), (:goal3, :lastID), (:goal4, :lastID)";
        $stmt_goals = $dbConn->prepare($insert_goals);
        $stmt_goals->execute(array(':goal1' => 'Research flight options', ':goal2' => 'Book flight tickets', ':goal3' => 'Pack everything which is needed for the travel', ':goal4' => 'Go to the airport and fly to destination', ':lastID' => $last_id));

        $insert_thinking = "INSERT INTO CJ_thinking (thinkingDesc, userJourneyID) VALUES (:thinking1, :lastID), (:thinking2, :lastID), (:thinking3, :lastID), (:thinking4, :lastID)";
        $stmt_thinking = $dbConn->prepare($insert_thinking);
        $stmt_thinking->execute(array(':thinking1' => 'I hope I can find a convenient flight at a good price', ':thinking2' => 'The website is content heavy, not sure what I need to do next', ':thinking3' => 'I could download the airlines application', ':thinking4' => 'Finally on my way', ':lastID' => $last_id));

        $insert_opportunities = "INSERT INTO CJ_opportunities (opportunityDesc, userJourneyID) VALUES (:opp1, :lastID), (:opp2, :lastID), (:opp3, :lastID), (:opp4, :lastID)";
        $stmt_opportunities = $dbConn->prepare($insert_opportunities);
        $stmt_opportunities->execute(array(':opp1' => 'Continue to offer competitive prices', ':opp2' => 'Continue to re-think about the design of the website', ':opp3' => 'Promote the mobile application alot more', ':opp4' => 'Streamline the boarding process', ':lastID' => $last_id));
        header('Location: userjourney.php?userJourneyID=' . $last_id);
    }
}

echo makeSidebar(); ?>

<h1 style="text-align: center">Create a new user journey map</h1>
<form action="#" method="POST" class="projectForm">
    <label>
        User journey map name: <br> <input type="text" name="journeyName" class="projectInput">
    </label><br><br>
    <p><b>Choose a persona to base your user journey on</b></p>
    <?php
    $getPersonas = "SELECT personaID, personaName, projectID FROM CJ_personas WHERE projectID = :projectID";
    $personaResults = $dbConn->prepare($getPersonas);
    $personaResults->execute(array(':projectID' => $projectID));
    $personaRS = $personaResults->fetchAll();
    $personaNumRows = $personaResults->rowCount();
    if ($personaNumRows > 0) {
        foreach ($personaRS as $row) {
            $personaName = $row['personaName'];
            $personaID = $row['personaID'];
            echo "<label><input type='radio' name='persona' value='$personaID'> $personaName </input></label><br>";
        }
        echo "<input type=\"submit\" value=\"Create\" class=\"submitButton\" name=\"newJourneyMap\">";
    } else {
        echo "<p>There are no personas created on this project. You will need to <a href='create-blank-persona.php?projectID=$projectID'> create one </a>before creating a user journey map.</p>";
    }
    ?>

</form>