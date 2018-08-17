<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Project overview", "", "");
echo makeSidebar();
$dbConn = databaseConn::getConnection();
$projectID = $_GET['projectID'];

if (isset($_POST['inviteUsers'])) {
    $email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : null;
    // check if email is already a user on the website
    $check_email = "SELECT emailAddress, userID from CJ_users WHERE emailAddress = :email";
    $check_email_result = $dbConn->prepare($check_email);
    $check_email_result->execute(array(':email' => $email));
    $results = $check_email_result->fetchAll();
    if ($results) {
        foreach ($results as $row) {
            $userID = $row['userID'];
            //if true, insert details into the database
            $insert_user = "INSERT INTO CJ_project_shared_users (userID, projectID) VALUES (:userID, :projectID)";
            $insert_user_result = $dbConn->prepare($insert_user);
            $insert_user_result->execute(array(':userID' => $userID, ':projectID' => $projectID));
            // send an email
            $to = $email;
            $subject = 'User journey account created';
            $message = "
                <html>
                <head>
                  <title>New user journey account created</title>
                </head>
                <body>
                  <p>Dear user, You have now been added to another project on User Journey Solutions. Sign in to check the project out. </p>
                 
                  <p>Kind regards, Customer Journey map Solutions </p>
                </body>
                </html>
                ";
            // To send HTML mail, the Content-type header must be set
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';
            // Additional headers
            $headers[] = 'To: $email';
            $headers[] = 'From: noreply@userjourneysolutions.com';
            // Mail it
            mail($to, $subject, $message, implode("\r\n", $headers));
        }
    } else {
        echo "
          <div class=\"ErrorMessages\">
             <b>The following errors occurred:</b>
             <p> The user you have tried to add doesn't exist, they would need to register for an account before allowing them to be shared on a project</p>
          </div>
          <div class='clear-fix'></div>";
    }
}

$getProjectInfo = "SELECT projectName, projectDesc from CJ_projects where projectID = :projectID";
$result = $dbConn->prepare($getProjectInfo);
$result->execute(array(':projectID'=>$projectID));
$recordSet = $result->fetchAll();
if (!empty($recordSet)) {
    foreach ($recordSet as $row) {
        $projectName = $row['projectName'];
        $projectDesc = $row['projectDesc'];


        echo "
        <h1>$projectName</h1>
        <p style=\"margin-left: 3%;\">
            <b>Project description:</b> <br>
            $projectDesc
        </p>
        ";
    }
}
?>
    <div class="halfContainer">

        <input id="tab1" type="radio" name="tabs" checked class="hiddenInput">
        <label for="tab1" class="labelOverivew">Personas</label>

        <input id="tab2" type="radio" name="tabs" class="hiddenInput">
        <label for="tab2" class="labelOverivew">User journey maps</label>


        <section id="content1">
            <p>
                <?php echo "<a href=\"create-blank-persona.php?projectID=$projectID\" class=\"submitButton\" style=\" color: white; text-decoration: none\">Create new (blank)</a>"; ?>
                <?php echo "<a href=\"scripts/persona_template_insert.php?projectID=$projectID\" class=\"submitButton\" style=\" color: white; text-decoration: none\">Create new (template)</a>"; ?>
            </p>
            <?php
            $getPersonas = "SELECT personaID, personaName, projectID FROM CJ_personas WHERE projectID = :projectID";
            $personaResults = $dbConn->prepare($getPersonas);
            $personaResults->execute(array(':projectID'=>$projectID));
            $personaRS = $personaResults->fetchAll();
            $personaNumRows = $personaResults->rowCount();

            if ($personaNumRows > 0) {
                foreach ($personaRS as $row) {
                    $personaID = $row['personaID'];
                    echo "
                        <div id=\"projectOverallContainer\">
                            <p id='personaNameLabel'><b>Persona name:</b> $row[personaName]</p>
                            <a href='scripts/delete_persona.php?personaID=$personaID&projectID=$projectID' type=\"submit\" class=\"actionButtons\">Delete</a>
                            <a href='persona.php?personaID=$personaID' type=\"submit\" class=\"actionButtons\">Open</a>
                        </div>
                    ";
                }
            } else {
                echo "<p>There are no personas created on this project.</p>";
            }
            ?>

        </section>

        <section id="content2">
            <p>
                <?php echo "<a href='user_journey_setup_blank.php?projectID=$projectID' class='submitButton' style=' color: white; text-decoration: none'>Create new (blank)</a>"; ?>
                <?php echo "<a href='user_journey_setup_template.php?projectID=$projectID' class='submitButton' style=' color: white; text-decoration: none'>Create new (template)</a>"; ?>
            </p>

            <?php
            $getUserJourneys = "SELECT userJourneyID, nameOfJourney, projectID FROM CJ_user_journeys WHERE projectID = :projectID";
            $journeyResults = $dbConn->prepare($getUserJourneys);
            $journeyResults->execute(array(':projectID'=>$projectID));
            $journeyRS = $journeyResults->fetchAll();
            $JourneynumRows = $journeyResults->rowCount();

            if ($JourneynumRows > 0) {
                foreach ($journeyRS as $row) {
                    $userJourneyID = $row['userJourneyID'];
                    echo "
                        <div id=\"projectOverallContainer\">
                            <p id='personaNameLabel'><b>User journey name:</b> $row[nameOfJourney]</p>
                            <a href='scripts/delete_user_journey.php?userJourneyID=$userJourneyID&projectID=$projectID' class=\"actionButtons\">Delete</a>
                            <a href='userjourney.php?userJourneyID=$userJourneyID' class='actionButtons'>Open</a>
                        </div>
                    ";
                }
            } else {
                echo "<p>There are no user journeys created on this project.</p>";
            }
            ?>
        </section>
    </div>

    <div class="halfContainer">
    <h1>Users on this project</h1>
    <?php
    $getUsers = "SELECT CJ_project_shared_users.userID, CJ_project_shared_users.projectID, emailAddress 
                 FROM CJ_project_shared_users 
                 INNER JOIN CJ_users on CJ_project_shared_users.userID = CJ_users.userID 
                 WHERE projectID = :projectID";

    $userResults = $dbConn->prepare($getUsers);
    $userResults->execute(array(':projectID'=>$projectID));
    $userRS = $userResults->fetchAll();

    if (!empty($userRS)) {
        echo "
        <table id='usersTable'>
            <tr>
                <th style=\"text-align: left\">Email address</th>
                <th>Remove</th>
            </tr>";
        foreach ($userRS as $userRSResult) {
            $userEmail = $userRSResult['emailAddress'];
            echo "<tr>
                <td style=\"text-align: left\">$userEmail</td>
                <td id='myBtn'>&times;</td>
            </tr>";
        }
        echo "</table>
        ";
    } else {
        echo "<p>There are no users on this project</p>";
    }
    ?>

    <button class="accordion">&or; Invite more users to this project</button>
    <div class="panel">
        <?php $url = "project_overview.php?projectID=$projectID"; ?>
        <Form action="<?php echo $url ?>" method="POST">
            <label for="email">
                <b>Email address: </b><br> <input type="email" name="email">
            </label><br>
            <input type="submit" value="Invite" class="project-button-2 " name="inviteUsers">
        </Form>
    </div>

    <script>
        window.onload = function () {
            accordion();
        };
    </script>
<?php echo makePageFooter(); ?>