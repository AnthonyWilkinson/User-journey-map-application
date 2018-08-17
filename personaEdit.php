<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Persona edit", "", "");
echo makeSidebar();
require_once('classes/databaseConn.php');
$dbConn = databaseConn::getConnection();
if (isset($_SESSION['forename'])) {
    $personaID = $_GET['personaID'];
    if (isset($_POST['savePersona'])) {
        //set the storage path for image uploads
        $target = "images/" . basename($_FILES['image']['name']);
        //get all of the inputs using the isset method
        $image = $_FILES['image']['name'];
        $name = isset($_REQUEST["personaName"]) ? $_REQUEST["personaName"] : null;
        $occupation = isset($_REQUEST["occupation"]) ? $_REQUEST["occupation"] : null;
        $personaAge = isset($_REQUEST["age"]) ? $_REQUEST["age"] : null;
        $numChildren = isset($_REQUEST["children"]) ? $_REQUEST["children"] : null;
        $martitalStatusPersona = isset($_REQUEST["maritalStatus"]) ? $_REQUEST["maritalStatus"] : null;
        $personaQuote = isset($_REQUEST["quote"]) ? $_REQUEST["quote"] : null;
        $dis = isset($_REQUEST["digitalScale"]) ? $_REQUEST["digitalScale"] : null;
        $personaProfile = isset($_REQUEST["profile"]) ? $_REQUEST["profile"] : null;

        if (isset($_POST["motivation"])) {
            foreach ($_POST["motivation"] as $key => $value) {
                echo $value . "<br>";
                $motivationInsert = "INSERT INTO CJ_motavations (motavationDesc, personaID) VALUES (:value, :personaID )";
                $stmt = $dbConn->prepare($motivationInsert);
                $stmt->execute(array(':value' => $value, ':personaID' => $personaID));
            }
        }

        if (isset($_POST["goal"])) {
            foreach ($_POST["goal"] as $key => $value) {
                echo $value . "<br>";
                $goalInsert = "INSERT INTO CJ_goals_persona (goalDesc, personaID) VALUES (:value, :personaID )";
                $stmt = $dbConn->prepare($goalInsert);
                $stmt->execute(array(':value' => $value, ':personaID' => $personaID));
            }
        }

        if (isset($_POST["need"])) {
            foreach ($_POST["need"] as $key => $value) {
                echo $value . "<br>";
                $needInsert = "INSERT INTO CJ_needs (needDesc, personaID) VALUES (:value, :personaID )";
                $stmt = $dbConn->prepare($needInsert);
                $stmt->execute(array(':value' => $value, ':personaID' => $personaID));
            }
        }

        if (isset($_POST["challeneges"])) {
            foreach ($_POST["challeneges"] as $key => $value) {
                echo $value . "<br>";
                $challenegesInsert = "INSERT INTO CJ_challenges (challengeDesc	, personaID) VALUES (:value, :personaID )";
                $stmt = $dbConn->prepare($challenegesInsert);
                $stmt->execute(array(':value' => $value, ':personaID' => $personaID));
            }
        }

        if (isset($_POST["frustrations"])) {
            foreach ($_POST["frustrations"] as $key => $value) {
                echo $value . "<br>";
                $frustrationsInsert = "INSERT INTO CJ_frustrations (frustrationDesc, personaID) VALUES (:value, :personaID )";
                $stmt = $dbConn->prepare($frustrationsInsert);
                $stmt->execute(array(':value' => $value, ':personaID' => $personaID));
            }
        }

        if (isset($_POST["technologies"])) {
            foreach ($_POST["technologies"] as $key => $value) {
                echo $value . "<br>";
                $technologiesInsert = "INSERT INTO CJ_technologies (technologyDesc, personaID) VALUES (:value, :personaID )";
                $stmt = $dbConn->prepare($technologiesInsert);
                $stmt->execute(array(':value' => $value, ':personaID' => $personaID));
            }
        }
        //sanitize the inputs
        $name = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $occupation = filter_var($occupation, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $personaAge = filter_var($personaAge, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $numChildren = filter_var($numChildren, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $martitalStatusPersona = filter_var($martitalStatusPersona, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $personaQuote = filter_var($personaQuote, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $dis = filter_var($dis, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $personaProfile = filter_var($personaProfile, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
        $occupation = filter_var($occupation, FILTER_SANITIZE_SPECIAL_CHARS);
        $personaAge = filter_var($personaAge, FILTER_SANITIZE_SPECIAL_CHARS);
        $numChildren = filter_var($numChildren, FILTER_SANITIZE_SPECIAL_CHARS);
        $martitalStatusPersona = filter_var($martitalStatusPersona, FILTER_SANITIZE_SPECIAL_CHARS);
        $personaQuote = filter_var($personaQuote, FILTER_SANITIZE_SPECIAL_CHARS);
        $dis = filter_var($dis, FILTER_SANITIZE_SPECIAL_CHARS);
        $personaProfile = filter_var($personaProfile, FILTER_SANITIZE_SPECIAL_CHARS);

        //trim any white space
        trim($personaAge);
        trim($numChildren);
        trim($martitalStatusPersona);
        trim($dis);
        //create an errors array to store the error messages
        $errors = array();

        if (empty($_FILES['image']['tmp_name'])) {

        } else {
            $updateImage = "UPDATE CJ_personas SET image = '$image' where personaID = :personaID";
            $imageQuery = $dbConn->prepare($updateImage);
            $imageQuery->execute(array(':personaID' => $personaID));
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                echo "Image uploaded successfully";
            } else {
                echo "There was a problem uploading image";
            }
        }

        if (empty($name)) {
            //add a error message to errors array
            $errors[] = "You have not entered a name";
        }

        if (empty($occupation)) {
            //add a error message to errors array
            $errors[] = "You have not entered a occupation";
        }
        if (empty($personaAge)) {
            //add a error message to errors array
            $errors[] = "You have not entered a age";
        }
        if (empty($martitalStatusPersona)) {
            //add a error message to errors array
            $errors[] = "You have not entered a marital status";
        }
        if (empty($personaQuote)) {
            //add a error message to errors array
            $errors[] = "You have not entered a quote";
        }
        if (empty($dis)) {
            //add a error message to errors array
            $errors[] = "You have not selected a digital inclusion scale score";
        }
        if (empty($personaProfile)) {
            //add a error message to errors array
            $errors[] = "You have not entered a personal profile";
        }

        //if errors array is not empty
        if (!empty($errors)) {
            echo "<div class=\"ErrorMessages\">";
            echo "<b>The following errors occurred:</b> ";
            foreach ($errors as $currentError) {
                echo '<li>' . $currentError . '</li>';
            }
            echo "</div>";
        } else {
            $updateSQL = "UPDATE CJ_personas SET personaName = :personaName, occupation = :occupation, age = :personaAge, children = :numChildren, martitalStatus = :martitalStatusPersona, quote = :personaQuote, digitalInclusionScale = :dis, personalProfile = :personaProfile where personaID = :personaID";
            $updateQuery = $dbConn->prepare($updateSQL);
            $updateQuery->execute(array(':personaName' => $name, ':occupation' => $occupation, ':personaAge' => $personaAge, ':numChildren' => $numChildren, ':martitalStatusPersona' => $martitalStatusPersona, ':personaQuote' => $personaQuote, ':dis' => $dis, ':personaProfile' => $personaProfile, ':personaID' => $personaID));

            header('Location: persona.php?personaID=' . $personaID);
        }
    }

    echo "<form action='personaEdit.php?personaID=$personaID' method='post' enctype=\"multipart/form-data\">
            <div class=\"section group\" id='personaFirstSection'>
            <div class='col span_5'>
            <h2 class='h2Persona'>Update a persona</h2>
                <input type='submit' class='project-button-2' value='Save persona' name='savePersona'>
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
               <div class='profile-img-container'>
                    <img src=\"images/$image\" class=\"profilePic\" id='image'>
                 </div>
                 <p style='text-align: center'>Click to change image</p>
            </div>
            <div class=\"col span_4\">
                <p class='padding1'><label class='personaLabel'>Name of persona:<label/><br> <input type='text' value='$personaName'  name='personaName' class='personaInput'> </p><br>
                <label class='personaLabel2'>Personal profile:</label>
                <textarea class='textAreaPersona' name='profile'>$profile</textarea>
                <input id='uploadfile' type ='file' value='$image' name='image'>
                <p class='padding1'><label class='personaLabel'>Quote:<label/><br> <input type='text' name='quote' value='$quote' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Occupation:<label/><br> <input type='text' name='occupation' value='$occ' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Age:<label/><br> <input type='text' name='age' class='personaInput' value='$age'> </p>
                <p class='padding1'><label class='personaLabel'>Number of children:<label/><br> <input type='text'  name='children' value='$children' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Marital status:<label/><br> <input type='text' name='maritalStatus' value='$martitalStatus' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Digital Inclusion scale:</label>
                <input type=\"range\" min=\"1\" max=\"9\" style='width:97%;' value='$digitalScale' class=\"slider\" id=\"myRange\" name='digitalScale'></p>
            </div>
        </div>";
    }
    echo "<div class=\"section group\">";
    $getMotivations = "SELECT motavationID, motavationDesc FROM CJ_motavations where personaID = :personaID";
    $getMotivationsResult = $dbConn->prepare($getMotivations);
    $getMotivationsResult->execute(array(':personaID' => $personaID));
    $getMotivationsRS = $getMotivationsResult->fetchAll();
    $getMotivationsCount = $getMotivationsResult->rowCount();

    echo "<div class=\" col span_4 marginLeftPersona\" id='motivationsAdd' >    
                    <h3>Motivations</h3>
                    <button class='buttonPersona' id='motivationBtn'>Add a motivation</button>";
    if ($getMotivationsCount > 0) {
        echo "<ul style='clear: both' >";
        foreach ($getMotivationsRS as $result) {
            $motivationID = $result['motavationID'];
            $motivation = $result['motavationDesc'];
            echo "<li>$motivation<a href='scripts/delete_persona_motivations.php?motavationID=$motivationID&personaID=$personaID' class='deleteX'>&times;</a></li>  ";
        }
        echo "</ul>";
    }
    echo "<div id='motivationAdd'></div>
                </div>";
    $getGoals = "SELECT goalID, goalDesc from CJ_goals_persona where personaID = :personaID ";
    $resultGoals = $dbConn->prepare($getGoals);
    $resultGoals->execute(array(':personaID' => $personaID));
    $recordSetGoals = $resultGoals->fetchAll();
    $goalCount = $resultGoals->rowCount();

    echo " <div class=\"col span_4 marginLeftPersona\" id='goalAdd'>
                    <h3>Goals</h3>
                    <a href='#' class='buttonPersona' id='goalBtn'>Add a goal</a>";
    if ($goalCount > 0) {
        echo "<ul style='clear: both' >";
        foreach ($recordSetGoals as $result) {
            $goal = $result['goalDesc'];
            $goalID = $result['goalID'];
            echo "<li>$goal <a href='scripts/delete_persona_goals.php?goalID=$goalID&personaID=$personaID' class='deleteX'>&times;</a></li>";
        }
        echo "</ul>";
    }
    echo "</div>";

    $getNeeds = "SELECT needID, needDesc from CJ_needs where personaID = :personaID ";
    $resultNeeds = $dbConn->prepare($getNeeds);
    $resultNeeds->execute(array(':personaID' => $personaID));
    $resultNeedsRS = $resultNeeds->fetchAll();
    $rowCountNeeds = $resultNeeds->rowCount();

    echo "<div class=\" col span_4 marginLeftPersona\" id='needs'> 
                <h3>Needs</h3>
                <a href='#' class='buttonPersona' id='needsBtn'>Add a need</a>";
    if ($rowCountNeeds > 0) {
        echo "<ul style='clear: both' >";
        foreach ($resultNeedsRS as $result) {
            $needs = $result['needDesc'];
            $needID = $result['needID'];
            echo "<li>$needs <a href='scripts/delete_persona_needs.php?needID=$needID&personaID=$personaID' class='deleteX'>&times;</a></li>";
        }
        echo "</ul>";
    }
    echo "</div>";

    $getchallenges = "SELECT challengeID, challengeDesc from CJ_challenges where personaID = :personaID";
    $getchallengesResult = $dbConn->prepare($getchallenges);
    $getchallengesResult->execute(array(':personaID' => $personaID));
    $getchallengesRS = $getchallengesResult->fetchAll();
    $CountChallenges = $getchallengesResult->rowCount();

    echo "<div class=\" col span_4 marginLeftPersona\" id='challeneges'> 
                <h3>Challenges</h3>
                <a href='#' class='buttonPersona' id='challenegesBtn'>Add a challenge</a>";
    if ($CountChallenges > 0) {
        echo "<ul style='clear: both' >";
        foreach ($getchallengesRS as $result) {
            $challenges = $result['challengeDesc'];
            $challengeID = $result['challengeID'];
            echo "<li>$challenges <a href='scripts/delete_persona_challenges.php?challengeID=$challengeID&personaID=$personaID' class='deleteX'>&times;</a></li>";
        }
        echo "</ul>";
    }
    echo "</div>";

    $getfrustrations = "SELECT frustrationID, frustrationDesc from CJ_frustrations where personaID = :personaID ";
    $getfrustrationsResult = $dbConn->prepare($getfrustrations);
    $getfrustrationsResult->execute(array(':personaID' => $personaID));
    $getfrustrationsRS = $getfrustrationsResult->fetchAll();
    $countfrustrations = $getfrustrationsResult->rowCount();

    echo "<div class=\" col span_4 marginLeftPersona\" id='frustrations'> 
                <h3>Frustrations</h3>
                <button onclick='addFrustration()' class='buttonPersona' id='frustrationsBtn'>Add a frustration</button>";
    if ($countfrustrations > 0) {
        echo "<ul style='clear: both' >";
        foreach ($getfrustrationsRS as $result) {
            $frustration = $result['frustrationDesc'];
            $frustrationID = $result['frustrationID'];
            echo "<li>$frustration <a href='scripts/delete_persona_frustrations.php?frustrationID=$frustrationID&personaID=$personaID' class='deleteX'>&times;</a></li>";
        }
        echo "</ul>";
    }
    echo "</div>";

    $gettechnologies = "SELECT technologyID, technologyDesc from CJ_technologies where personaID = :personaID ";
    $resulttechnologies = $dbConn->prepare($gettechnologies);
    $resulttechnologies->execute(array(':personaID' => $personaID));
    $resulttechnologiesRS = $resulttechnologies->fetchAll();
    $rowCounttechnologies = $resulttechnologies->rowCount();
    echo "<div class=\" col span_4 marginLeftPersona\" id='tech'> 
                <h3>Technologies</h3>
                <a href='#' class='buttonPersona' id='techBtn'>Add a technology</a>";
    if ($rowCounttechnologies > 0) {
        echo "<ul style='clear: both' >";
        foreach ($resulttechnologiesRS as $result) {
            $tech = $result['technologyDesc'];
            $technologyID = $result['technologyID'];
            echo "<li>$tech <a href='scripts/delete_persona_tech.php?technologyID=$technologyID&personaID=$personaID' class='deleteX'>&times;</a></li>";
        }
        echo "</ul>";
    }
    echo "</div>
        </div>
   
    </form>";
}
echo makePageFooter();
?>

<script>
    window.onload = function () {
        persona_edit_functions();
    };
</script>