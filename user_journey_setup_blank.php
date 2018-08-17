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

        $createUserjourney = "INSERT INTO CJ_stages (stageDesc, userJourneyID) VALUES (:stage, :last_id)";
        $stmt2 = $dbConn->prepare($createUserjourney);
        $stmt2->execute(array(':stage' => '', ':last_id' => $last_id));

        header('Location: userjourney.php?userJourneyID=' . $last_id);
    }

}
echo makeSidebar();

?>

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
        echo "<p>There are no personas created on this project. You will need to <a href='create-blank-persona.php?projectID=$projectID' style='text-decoration: underline'> create one </a>before creating a user journey map.</p>";
    }
    ?>

</form>


