<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Update project", "", "");
$dbConn = databaseConn::getConnection();
echo makeSidebar()
?>
    <h1 class="h1_margin">Update project</h1>
<?php
$projectID = $_GET['projectID'];
$getProjectDetails = "SELECT projectID, projectName, projectDesc from CJ_projects where projectID = :projectID";
$getProjectDetailsResults = $dbConn->prepare($getProjectDetails);
$getProjectDetailsResults->execute(array(':projectID' => $projectID));
$getProjectDetailsRS = $getProjectDetailsResults->fetchAll();

foreach ($getProjectDetailsRS as $row) {
    $projectTitle = $row['projectName'];
    $projectDesc = $row['projectDesc'];
    echo "<form action=\"scripts/update_project_action.php?projectID=$projectID\" method=\"POST\" class=\"projectForm\">
    <label>
    <b>Project name:</b> <br> <input type=\"text\" name=\"projectName\" class=\"projectInput\" value=\"$projectTitle\">
    </label><br><br>
    <label>
    <b>Project description:</b><br><textarea name=\"projectDesc\" class=\"projectTextarea\" style='width: 57%; height: 150px;' >$projectDesc</textarea>
    </label> <br>

    <input type=\"submit\" value=\"Update\" class=\"submitButton\" name=\"updateProject\">
</form>";
}

echo makePageFooter();