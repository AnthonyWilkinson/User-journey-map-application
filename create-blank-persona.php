<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Create persona", "", "");
echo makeSidebar();
require_once('classes/databaseConn.php');
$dbConn = databaseConn::getConnection();

if (isset($_SESSION['forename'])) {
    $projectID = $_GET['projectID'];
    if (isset($_POST['savePersona'])) {
        $dbConn = databaseConn::getConnection();
        // the file path to upload the images
        $target = "images/" . basename($_FILES['image']['name']);
        $image = $_FILES['image']['name'];
        $name = isset($_REQUEST["personaName"]) ? $_REQUEST["personaName"] : null;
        $occupation = isset($_REQUEST["occupation"]) ? $_REQUEST["occupation"] : null;
        $personaAge = isset($_REQUEST["age"]) ? $_REQUEST["age"] : null;
        $numChildren = isset($_REQUEST["children"]) ? $_REQUEST["children"] : null;
        $martitalStatusPersona = isset($_REQUEST["maritalStatus"]) ? $_REQUEST["maritalStatus"] : null;
        $personaQuote = isset($_REQUEST["quote"]) ? $_REQUEST["quote"] : null;
        $dis = isset($_REQUEST["digitalScale"]) ? $_REQUEST["digitalScale"] : null;
        $personaProfile = isset($_REQUEST["profile"]) ? $_REQUEST["profile"] : null;
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
            $updateSQL = "INSERT INTO CJ_personas (personaName, occupation, age, children, martitalStatus, quote, digitalInclusionScale, personalProfile, image, projectID) values (:personaName, :occupation, :personaAge, :numChildren, :martitalStatusPersona, :personaQuote, :dis, :personaProfile, :image, :projectID)";
            $updateQuery = $dbConn->prepare($updateSQL);
            $updateQuery->execute(array(':personaName' => $name, ':occupation' => $occupation, ':personaAge' => $personaAge, ':numChildren' => $numChildren, ':martitalStatusPersona' => $martitalStatusPersona, ':personaQuote' => $personaQuote, ':dis' => $dis, ':personaProfile' => $personaProfile, ':image' => $image, ':projectID' => $projectID));
            //http://php.net/manual/en/function.move-uploaded-file.php accessed: 10th February
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                echo "Image uploaded successfully";
            } else {
                echo "There was a problem uploading image";
            }
            $last_id = $dbConn->lastInsertId();
            header('Location: persona.php?personaID=' . $last_id);
        }
    }

    echo "<form action='create-blank-persona.php?projectID=$projectID' method='post' enctype=\"multipart/form-data\">";
    echo " <div class=\"section group\" id='personaFirstSection'>
            <div class='col span_5'>
            <h2 class='h2Persona'>Create a persona</h2>
                <input type='submit' class='project-button-2' value='Create persona' name='savePersona'>
            </div>
        </div>";

    echo "
        <div class=\"section group\" id='personaFirstSection'>
            <div class='col span_3'>
                <div class='profile-img-container'>
                    <img src=\"images/default-profile.png\" id=\"image\" class=\"profilePic\">
                 </div>
                 <p style='text-align: center'>Click to upload an image</p>
            </div>
            <div class=\"col span_4\">
                <p style='background-color:whitesmoke'><img src='images/exclamation_mark_icon.png' style='width: 50px; height: 50px'> <b>You can add more sections once the summary has been created.</b></p>
                <input id='uploadfile' type ='file' name='image'>
                <p class='padding1'><label class='personaLabel'>Name of persona:<label/><br> <input type='text'  name='personaName' class='personaInput'> </p><br>
                <label class='personaLabel2'>Personal profile:</label>
                <textarea class='textAreaPersona' name='profile'></textarea>
                <p class='padding1'><label class='personaLabel'>Quote:<label/><br> <input type='text' name='quote' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Occupation:<label/><br> <input type='text' name='occupation' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Age:<label/><br> <input type='text' name='age' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Number of children:<label/><br> <input type='text' name='children' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Marital status:<label/><br> <input type='text' name='maritalStatus' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Digital Inclusion scale:</label> <span id=\"demo\"></span>
                <input type=\"range\" min=\"1\" max=\"9\"  class=\"slider\" id=\"myRange\" name='digitalScale'></p>
                
            </div>
        </div>
    </form>
     ";
}
echo makePageFooter();
?>

<script>
    window.onload = function () {
        sliderAction();
    };
</script>