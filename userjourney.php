<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "User journey map", "", "mainWidth");
echo makeSidebar();
require_once('classes/databaseConn.php');
$dbConn = databaseConn::getConnection();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['forename'])) {


}
$userJourneyID = $_GET['userJourneyID'];

$getPersonaDetails = "SELECT CJ_personas.personaID, personaName, personalProfile, image from CJ_personas inner join CJ_user_journeys on CJ_personas.personaID = CJ_user_journeys.personaID where CJ_user_journeys.userJourneyID = :userJourneyID";
$PersonaResult = $dbConn->prepare($getPersonaDetails);
$PersonaResult->execute(array(':userJourneyID' => $userJourneyID));
$personaRS = $PersonaResult->fetchAll();

$user_journey_details = "SELECT nameOfJourney from CJ_user_journeys WHERE userJourneyID = :userJourneyID";
$user_journey_results = $dbConn->prepare($user_journey_details);
$user_journey_results->execute(array(':userJourneyID' => $userJourneyID));
$user_journey_recordSet = $user_journey_results->fetchAll();


?>

<header>
    <?php
    foreach ($user_journey_recordSet as $name) {
        $JourneyName = $name['nameOfJourney'];
        echo "<h1>$JourneyName</h1>";
    }
    ?>

    <div class="container">
        <?php
        foreach ($personaRS as $personaRow) {
            $imagePersona = $personaRow['image'];
            $personaID = $personaRow['personaID'];
            echo "<img src='images/$imagePersona' class='userJourneyImg'>";
        } ?>
        <div class="overlay" id="myBtn">
            <div class="text">Click for persona <br>details</div>
        </div>
    </div>

</header>
<div class="stageRow">
    <div class="innerRow">
        <?php

        $getstages = "SELECT stageID, stageDesc from CJ_stages WHERE userJourneyID = :userJourneyID";
        $stageResult = $dbConn->prepare($getstages);
        $stageResult->execute(array(':userJourneyID' => $userJourneyID));
        $stageRS = $stageResult->fetchAll();

        foreach ($stageRS as $Stagerow) {
            $stageDesc = $Stagerow['stageDesc'];
            $stageID = $Stagerow['stageID'];
            echo "<div class=\"data-col\" id='editable_stage'  data-id1='$stageID' contenteditable=\"true\">$stageDesc</div>";
        }
        ?>
        <?php echo "<div class=\"addStage\"><a href=\"scripts/addStage.php?userJourneyID=$userJourneyID\">+ Add a stage</a></div>"; ?>
    </div>
</div>


<div class="userjourneycol">
    <div class="innerRow">
        <?php
        $getFeelings = "SELECT feelingID, feelingDesc FROM CJ_feelings WHERE userJourneyID = :userJourneyID";
        $feelingResult = $dbConn->prepare($getFeelings);
        $feelingResult->execute(array(':userJourneyID' => $userJourneyID));
        $feelingRS = $feelingResult->fetchAll();
        foreach ($feelingRS as $feelingRow) {
            $feelingDesc = $feelingRow['feelingDesc'];
            $feelingID = $feelingRow['feelingID'];
            echo "<div class='data-col'>
                <h3>Feelings</h3>
                <div class='clear-fix'></div>
                    <p id='editable_feeling'  data-id1='$feelingID' contenteditable=\"true\">$feelingDesc</p>
            </div>";
        }
        ?>
    </div>
</div>

<div class="userjourneycol">
    <div class="innerRow">
        <?php
        $getGoals = "SELECT goalID, goalDesc FROM CJ_goals WHERE userJourneyID = :userJourneyID";
        $goalResult = $dbConn->prepare($getGoals);
        $goalResult->execute(array(':userJourneyID' => $userJourneyID));
        $goalRS = $goalResult->fetchAll();
        foreach ($goalRS as $goalRow) {
            $goalDesc = $goalRow['goalDesc'];
            $goalID = $goalRow['goalID'];
            echo "<div class='data-col'>
                <h3>Goals</h3>
                <div class='clear-fix'></div>
                    <p id='editable_goal'  data-id1='$goalID' contenteditable=\"true\">$goalDesc</p>
            </div>";
        }
        ?>
    </div>
</div>

<div class="userjourneycol">
    <div class="innerRow">
        <?php
        $getPain = "SELECT painPointID, painPointDesc FROM CJ_pain_points WHERE userJourneyID = :userJourneyID";
        $PainResult = $dbConn->prepare($getPain);
        $PainResult->execute(array(':userJourneyID' => $userJourneyID));
        $PainRS = $PainResult->fetchAll();
        foreach ($PainRS as $painRow) {
            $painDesc = $painRow['painPointDesc'];
            $painID = $painRow['painPointID'];
            echo "<div class='data-col'>
                <h3>Pain points</h3>
                <div class='clear-fix'></div>
                    <p id='editable_pain_point'  data-id1='$painID' contenteditable=\"true\">$painDesc</p>
            </div>";
        }
        ?>
    </div>
</div>

<div class="userjourneycol">
    <div class="innerRow">
        <?php
        $getActions = "SELECT actionID, actionDesc FROM CJ_actions WHERE userJourneyID = :userJourneyID";
        $ActionResult = $dbConn->prepare($getActions);
        $ActionResult->execute(array(':userJourneyID' => $userJourneyID));
        $ActionRS = $ActionResult->fetchAll();
        foreach ($ActionRS as $actionRow) {
            $actionDesc = $actionRow['actionDesc'];
            $actionID = $actionRow['actionID'];
            echo "<div class='data-col'>
                <h3>Actions</h3>
                <div class='clear-fix'></div>
                    <p id='editable_action'  data-id1='$actionID' contenteditable=\"true\">$actionDesc</p>
            </div>";
        }
        ?>
    </div>
</div>

<div class="userjourneycol">
    <div class="innerRow">
        <?php
        $getopportunities = "SELECT opportunityID, opportunityDesc FROM CJ_opportunities WHERE userJourneyID = :userJourneyID";
        $opportunitiesResult = $dbConn->prepare($getopportunities);
        $opportunitiesResult->execute(array(':userJourneyID' => $userJourneyID));
        $opportunitiesRS = $opportunitiesResult->fetchAll();
        foreach ($opportunitiesRS as $opportunitiesRow) {
            $opportunityDesc = $opportunitiesRow['opportunityDesc'];
            $opportunityID = $opportunitiesRow['opportunityID'];
            echo "<div class='data-col'>
                <h3>Opportunities</h3>
                <div class='clear-fix'></div>
                    <p id='editable_opportunities'  data-id1='$opportunityID' contenteditable=\"true\">$opportunityDesc</p>
            </div>";
        }
        ?>
    </div>
</div>

<div class="userjourneycol">
    <div class="innerRow">
        <?php
        $getThinking = "SELECT 	thinkingID, thinkingDesc FROM CJ_thinking WHERE userJourneyID = :userJourneyID";
        $ThinkingResult = $dbConn->prepare($getThinking);
        $ThinkingResult->execute(array(':userJourneyID' => $userJourneyID));
        $thinkingRS = $ThinkingResult->fetchAll();
        foreach ($thinkingRS as $thinkingRow) {
            $thinkingDesc = $thinkingRow['thinkingDesc'];
            $thinkingID = $thinkingRow['thinkingID'];
            echo "<div class='data-col'>
                <h3>Thinking</h3>
                <div class='clear-fix'></div>
                    <p id='editable_thinking'  data-id1='$thinkingID' contenteditable=\"true\">$thinkingDesc</p>
            </div>";
        }
        ?>
    </div>
</div>

<div class="userjourneycol">
    <div class="innerRow">
        <?php
        $getNeeds = "SELECT userNeedID, userNeedDesc FROM CJ_user_needs WHERE userJourneyID = :userJourneyID";
        $needsResult = $dbConn->prepare($getNeeds);
        $needsResult->execute(array(':userJourneyID' => $userJourneyID));
        $needsRS = $needsResult->fetchAll();
        foreach ($needsRS as $needsRow) {
            $needDesc = $needsRow['userNeedDesc'];
            $needID = $needsRow['userNeedID'];
            echo "<div class='data-col'>
                <h3>Needs</h3>
                <div class='clear-fix'></div>
                    <p id='editable_needs'  data-id1='$needID' contenteditable=\"true\">$needDesc</p>
            </div>";
        }
        ?>
    </div>
</div>

<div class="userjourneycol">
    <div class="innerRow">
        <?php
        $getImages = "SELECT imageID, imageName, imageUrl FROM CJ_images WHERE userJourneyID = :userJourneyID";
        $imagesResult = $dbConn->prepare($getImages);
        $imagesResult->execute(array(':userJourneyID' => $userJourneyID));
        $imagesRS = $imagesResult->fetchAll();
        foreach ($imagesRS as $imagesRow) {
            $imageName = $imagesRow['imageName'];
            $imageurl = $imagesRow['imageUrl'];
            echo "<div class='data-col'>
                <div class='clear-fix'></div>
                <div class='profile-img-container' id='image'>
                    <img src='#'>
                   <p><b>+ Add an image</b></p>
                   <form>
                   <input id='uploadfile' type ='file' name='image'>
                    </form>
                 </div>
                   
            </div>";
        }
        ?>
    </div>
</div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <?php
        foreach ($personaRS as $personaRow) {
            $personaName = $personaRow['personaName'];
            $personaID = $personaRow['personaID'];
            $personaProfile = $personaRow['personalProfile'];
            echo " <h1>$personaName</h1>
            <p>$personaProfile</p>";
            echo "<a href=\"personaEdit.php?personaID=$personaID\">Edit persona</a>";
        } ?>


    </div>
</div>

<div id="laneModal" class="modal">
    <div class="modal-content">
        <span class="close" id="close">&times;</span>
        <h1>Add a Section</h1>
        <p>Choose which section you would like to use? If there are none available, this could be down to you already
            using the ones currently available to use.</p>
        <?php
        $countActions = "SELECT actionID FROM CJ_actions WHERE userJourneyID = :userJourneyID";
        $countActionsResult = $dbConn->prepare($countActions);
        $countActionsResult->execute(array(':userJourneyID' => $userJourneyID));
        $action_count_num = $countActionsResult->rowCount();
        if ($action_count_num < 1) {
            echo "<a href='scripts/addActions.php?userJourneyID=$userJourneyID' class=\"project-button-2\">Actions</a>&nbsp;";
        }

        $countFeelings = "SELECT feelingID FROM CJ_feelings WHERE userJourneyID = :userJourneyID";
        $countFeelingsResult = $dbConn->prepare($countFeelings);
        $countFeelingsResult->execute(array(':userJourneyID' => $userJourneyID));
        $feeling_count_num = $countFeelingsResult->rowCount();

        if ($feeling_count_num < 1) {
            echo "<a href='scripts/addFeeling.php?userJourneyID=$userJourneyID' class=\"project-button-2\">Feelings</a>&nbsp;";
        }

        $countGoals = "SELECT goalID FROM CJ_goals WHERE userJourneyID = :userJourneyID";
        $countGoalsResult = $dbConn->prepare($countGoals);
        $countGoalsResult->execute(array(':userJourneyID' => $userJourneyID));
        $goal_count_num = $countGoalsResult->rowCount();

        if ($goal_count_num < 1) {
            echo "<a href='scripts/addGoals.php?userJourneyID=$userJourneyID' class=\"project-button-2\" >Goals</a>&nbsp;";
        }

        $countImages = "SELECT imageID FROM CJ_images WHERE userJourneyID = :userJourneyID";
        $countImagesResult = $dbConn->prepare($countImages);
        $countImagesResult->execute(array(':userJourneyID' => $userJourneyID));
        $image_count_num = $countImagesResult->rowCount();

        if ($image_count_num < 1) {
            echo "<a href='scripts/addImages.php?userJourneyID=$userJourneyID' class=\"project-button-2\">Images</a>&nbsp;";
        }

        $countOpportunities = "SELECT opportunityID FROM CJ_opportunities WHERE userJourneyID = :userJourneyID";
        $countOpportunitiesResult = $dbConn->prepare($countOpportunities);
        $countOpportunitiesResult->execute(array(':userJourneyID' => $userJourneyID));
        $opp_count_num = $countOpportunitiesResult->rowCount();

        if ($opp_count_num < 1) {
            echo "<a href='scripts/addOpp.php?userJourneyID=$userJourneyID' class=\"project-button-2\">Opportunities</a>&nbsp;";
        }

        $countPain = "SELECT painPointID FROM CJ_pain_points WHERE userJourneyID = :userJourneyID";
        $countPainResult = $dbConn->prepare($countPain);
        $countPainResult->execute(array(':userJourneyID' => $userJourneyID));
        $pain_count_num = $countPainResult->rowCount();

        if ($pain_count_num < 1) {
            echo "<a href='scripts/addPainPoints.php?userJourneyID=$userJourneyID' class=\"project-button-2\">Pain points</a>&nbsp;";
        }

        $countThinking = "SELECT thinkingID FROM CJ_thinking WHERE userJourneyID = :userJourneyID";
        $countThinkingResult = $dbConn->prepare($countThinking);
        $countThinkingResult->execute(array(':userJourneyID' => $userJourneyID));
        $thinking_count_num = $countThinkingResult->rowCount();

        if ($thinking_count_num < 1) {
            echo "<a href='scripts/addThinking.php?userJourneyID=$userJourneyID' class=\"project-button-2\">Thinking</a>&nbsp;";
        }

        $countUserNeeds = "SELECT userNeedID FROM CJ_user_needs WHERE userJourneyID = :userJourneyID";
        $countUserNeedsResult = $dbConn->prepare($countUserNeeds);
        $countUserNeedsResult->execute(array(':userJourneyID' => $userJourneyID));
        $needs_count_num = $countUserNeedsResult->rowCount();

        if ($needs_count_num < 1) {
            echo " <a href='scripts/addUserneeds.php?userJourneyID=$userJourneyID' class=\"project-button-2\">User needs</a>&nbsp;";
        }
        ?>

    </div>
</div>
<button style="margin-left: 3.5%;" id="myBtn2" class="project-button-2">+ Add a Section</button>
<script>
    window.onload = function () {
        userJourneyFunctions();
    };
</script>