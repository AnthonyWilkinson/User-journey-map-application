<?php ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Update project", "", "");
$dbConn = databaseConn::getConnection();

echo makeSidebar();
$projectID = $_GET['projectID'];
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

//if errors array is not empty
if (!empty($errors)) {
    echo "<div class=\"ErrorMessages\">";
    echo "<b>The following errors occurred:</b> ";
    foreach ($errors as $currentError) {
        echo '<li>' . $currentError . '</li>';
    }
    echo "</div>";
} else {
    $sql = "UPDATE CJ_projects set projectName = :projectName, projectDesc = :projectDesc where projectID = :projectID";
    $query = $dbConn->prepare($sql);
    $query->execute(array(':projectName' => $projectName, ':projectDesc' => $projectDesc, ':projectID' => $projectID));
    header('Location: ../index.php');
}