<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Persona", "", "");
echo makeSidebar();
require_once('classes/databaseConn.php');
$dbConn = databaseConn::getConnection();


if (isset($_SESSION['forename'])) {
    $personaID = $_GET['personaID'];
    echo " <div class=\"section group\" id='personaFirstSection'>
            <div class='col span_5'>
                <a href='personaEdit.php?personaID=$personaID' class='project-button-2'> Edit persona </a>
                <a href='#' class='project-button-2'> Export persona </a>
            </div>
        </div>";
    $getPersona = "SELECT personaName, occupation, age, children, martitalStatus, quote, digitalInclusionScale, personalProfile, image
                    FROM CJ_personas
                    WHERE personaID = :personaID";
    $result = $dbConn->prepare($getPersona);
    $result->execute(array(':personaID' => $personaID));
    $recordSet = $result->fetchAll();

    foreach ($recordSet as $row) {
        $personaName = $row['personaName'];
        $occ = $row['occupation'];
        $age = $row['age'];
        $children = $row['children'];
        $quote = $row['quote'];
        $digitalScale = $row['digitalInclusionScale'];
        $profile = $row['personalProfile'];
        $image = $row['image'];
        $martitalStatus = $row['martitalStatus'];
        echo "
        <div class=\"section group\" id='personaFirstSection'>
            <div class='col span_3'>
            <img src=\"images/$image\" class=\"profilePic\">
            </div>
            <div class=\"col span_4\">
                <h1>$personaName</h1>
                <p>$profile</p>
            </div>
        </div>
        <div class=\"section group\">
            <div class='col span_2_of_2'>
                <p><b>Quote:</b>  \"$quote\"</p>
            </div>
        </div>
        <div class='section group'>
            <div class='col span_1_of_2'>
                <p><b>Marital status:</b> $martitalStatus</p>
            </div>
            <div class='col span_1_of_2'>
                <p><b>Occupation:</b> $occ</p>
            </div>
        </div>
        <div class='section group'>
            <div class='col span_1_of_2'>
                <p><b>Age:</b> $age</p>
            </div>
            <div class='col span_1_of_2'>
                <p><b>Number of children:</b> $children</p>
            </div>
        </div>
        <div class='section group'>
            <div class='col span_2_of_2'>
            <p class='padding1'><label class='personaLabel'>Digital Inclusion scale:</label> <span id=\"demo\"></span>
                <input type=\"range\" min=\"1\" max=\"9\" value=\"$digitalScale\" class=\"slider\" id=\"myRange\" name='digitalScale'></p>
            </div>
        </div>
        <div class=\"section group\">";

        $getMotivations = "SELECT motavationDesc from CJ_motavations where personaID = :personaID ";
        $resultMotivations = $dbConn->prepare($getMotivations);
        $resultMotivations->execute(array(':personaID' => $personaID));
        $recordSetMotivations = $resultMotivations->fetchAll();
        $rowCount = $resultMotivations->rowCount();
        if ($rowCount > 0) {

            echo "<div class='col span_1_of_2' >
            <h1 > Motivations</h1 >
                 <ul > ";

            foreach ($recordSetMotivations as $result) {
                $motivation = $result['motavationDesc'];
                echo " <li>$motivation </li > ";
            }
            echo "</ul > ";

            echo "</div > ";
        }

        $getGoals = "SELECT goalDesc from CJ_goals_persona where personaID = :personaID ";
        $resultGoals = $dbConn->prepare($getGoals);
        $resultGoals->execute(array(':personaID' => $personaID));
        $recordSetGoals = $resultGoals->fetchAll();
        $goalCount = $resultGoals->rowCount();
        if ($goalCount > 0) {
            echo "                <div class=\"col span_1_of_2\"><h1>Goals</h1>

                <ul>";
            foreach ($recordSetGoals as $result) {
                $goal = $result['goalDesc'];
                echo "<li>$goal</li>";
            }
            echo "</ul>
            </div>";
        }

        $getNeeds = "SELECT needDesc from CJ_needs where personaID = :personaID ";
        $resultNeeds = $dbConn->prepare($getNeeds);
        $resultNeeds->execute(array(':personaID' => $personaID));
        $resultNeedsRS = $resultNeeds->fetchAll();
        $rowCountNeeds = $resultNeeds->rowCount();
        if ($rowCountNeeds > 0) {
            echo "<div class='col span_1_of_2' >
            <h1 > Needs</h1 >
                 <ul > ";
            foreach ($resultNeedsRS as $result) {
                $need = $result['needDesc'];
                echo " <li>$need </li > ";
            }
            echo "</ul > ";

            echo "</div > ";
        }

        $getchallenges = "SELECT challengeDesc from CJ_challenges where personaID = :personaID ";
        $getchallengesResult = $dbConn->prepare($getchallenges);
        $getchallengesResult->execute(array(':personaID' => $personaID));
        $getchallengesRS = $getchallengesResult->fetchAll();
        $CountChallenges = $getchallengesResult->rowCount();
        if ($CountChallenges > 0) {
            echo "<div class=\"col span_1_of_2\"><h1>Challenges</h1>
                <ul>";
            foreach ($getchallengesRS as $result) {
                $challenge = $result['challengeDesc'];
                echo "<li>$challenge</li>";
            }
            echo "</ul>
            </div>";
        }

        $gettechnologies = "SELECT technologyDesc from CJ_technologies where personaID = :personaID ";
        $resulttechnologies = $dbConn->prepare($gettechnologies);
        $resulttechnologies->execute(array(':personaID' => $personaID));
        $resulttechnologiesRS = $resulttechnologies->fetchAll();
        $rowCounttechnologies = $resulttechnologies->rowCount();
        if ($rowCounttechnologies > 0) {
            echo "<div class='col span_1_of_2' >
            <h1 > Technologies</h1 >
                 <ul > ";
            foreach ($resulttechnologiesRS as $result) {
                $need = $result['technologyDesc'];
                echo " <li>$need </li > ";
            }
            echo "</ul > ";

            echo "</div > ";
        }

        $getfrustrations = "SELECT frustrationDesc from CJ_frustrations where personaID = :personaID ";
        $getfrustrationsResult = $dbConn->prepare($getfrustrations);
        $getfrustrationsResult->execute(array(':personaID' => $personaID));
        $getfrustrationsRS = $getfrustrationsResult->fetchAll();
        $countfrustrations = $getchallengesResult->rowCount();
        if ($countfrustrations > 0) {
            echo "<div class=\"col span_1_of_2\"><h1>Frustrations</h1>
                <ul>";
            foreach ($getfrustrationsRS as $result) {
                $frustrations = $result['frustrationDesc'];
                echo "<li>$frustrations</li>";
            }
            echo "</ul>
            </div>";
        }
        echo "</div>";// end of section group

        echo "</form>";
    }
}
echo makePageFooter();
?>

<script>
    window.onload = function () {
        sliderAction();
    };
</script>