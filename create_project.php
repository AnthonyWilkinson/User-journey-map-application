<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Create a project", "", "");

if (isset($_POST['newProjectaction'])) {
    //connect to the database
    require_once('classes/databaseConn.php');
    $dbConn = databaseConn::getConnection();
    //get all of the inputs using the isset method
    $projectName = isset($_REQUEST["projectName"]) ? $_REQUEST["projectName"] : null;
    $projectDesc = isset($_REQUEST["projectDesc"]) ? $_REQUEST["projectDesc"] : null;
    //sanitize the inputs
    $projectName = filter_var($projectName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $projectDesc = filter_var($projectDesc, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    $projectName = filter_var($projectName, FILTER_SANITIZE_SPECIAL_CHARS);
    $projectDesc = filter_var($projectDesc, FILTER_SANITIZE_SPECIAL_CHARS);

    //create an errors array to store the error messages
    $errors = array();
    if (empty($projectName)) {
        $errors[] = "You have not entered a project name";
    }

    if (empty($projectDesc)) {
        $errors[] = "You have not entered a project description";
    }

    //check the right lengths
    if (strlen($projectName) > 225) {
        $errors[] = "You have entered more than the max 225 characters length for project name";
    }

    if (strlen($projectDesc) > 400) {
        $errors[] = "You have entered more than the max 400 characters length for project description";
    }

    if (strlen($projectName) < 2) {
        $errors[] = "You need to have a minimum of 2 characters length for project name";
    }

    if (strlen($projectDesc) < 2) {
        $errors[] = "You need to have a minimum of 2 characters length for project description";
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
        $email = $_SESSION['email'];
        $getUserID = "SELECT userID from CJ_users where emailAddress = :email";
        $stmt2 = $dbConn->prepare($getUserID);
        $stmt2->execute(array(':email' => $email));
        $userID = $stmt2->fetchColumn();
        $sql = "INSERT INTO CJ_projects (projectName, projectDesc, ownerID) VALUES (:projectName, :projectDesc, :userID)";
        $query = $dbConn->prepare($sql);
        $query->execute(array(':projectName' => $projectName, ':projectDesc' => $projectDesc, ':userID' => $userID));
        header('Location: index.php');
    }
}

echo makeSidebar();
?>

<h1 class="h1_margin">Create a new project</h1>
<form action="create_project.php" method="POST" class="projectForm">
    <label>
        <b>Project name:</b> <br> <input type="text" name="projectName" class="projectInput">
    </label><br><br>
    <label>
        <b>Project description:</b> <br> <textarea name="projectDesc" class="projectTextarea"> </textarea>
    </label> <br>
    <input type="submit" value="Create" class="submitButton " name="newProjectaction">
</form>

<?php echo makePageFooter(); ?>

