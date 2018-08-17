<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Projects", "", "");
$dbConn = databaseConn::getConnection();

echo makeSidebar(); ?>
    <h1>My projects</h1>
<?php
if (isset($_SESSION['forename'])) {
    $email = $_SESSION['email'];
    $userid = $_SESSION['userID'];
    $projectSql = "SELECT projectID, projectName, projectDesc, emailAddress 
                   FROM CJ_projects 
                   inner join CJ_users on CJ_projects.ownerID = CJ_users.userID 
                   where CJ_projects.ownerID = :userid ";
    $result = $dbConn->prepare($projectSql);
    $result->execute(array(':userid' => $userid));
    $recordSet = $result->fetchAll();
    $numRows = $result->rowCount();
    echo " <a href=\"create_project.php\" class=\"project-button\">Create new project</a>";

    if ($numRows > 0) {
        foreach ($recordSet as $row) {
            $projectID = $row['projectID'];
            echo "
                <div class='project-contain'>
                <p class='project-name'><b>Project name:</b> $row[projectName]</p>
                <p class='project-desc'><b>Project Description:</b> <br> $row[projectDesc]</p>
                <a href='project_overview.php?projectID=$projectID' class='project-button-2'>Open project</a>
                <a href='update_project.php?projectID=$projectID' class='project-button-2'>Edit project</a>
                
                <input type=\"submit\" class=\"project-button-2\" value=\"Delete project\">
                </div>
            ";
        }
    } else {
        echo "<p id='no_projects_P'>There are no projects created.</p>";
    }
} else {
    header('location: login.php');
}
echo makePageFooter();