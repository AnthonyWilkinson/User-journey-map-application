<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "My account", "", "");
echo makeSidebar();
require_once('classes/databaseConn.php');
$dbConn = databaseConn::getConnection();

if (isset($_SESSION['forename'])) {

    $userID = $_GET['userID'];
    echo "<form action='profile.php?userID=$userID' method='post' enctype=\"multipart/form-data\">
            <div class=\"section group\" id='personaFirstSection'>
            <div class='col span_5'>
            <h1 class='h2Persona'>My details</h1>
            </div>
        </div>";
    $getDetails = "SELECT forename, surname, emailAddress FROM CJ_users WHERE userID = :userID";
    $result = $dbConn->prepare($getDetails);
    $result->execute(array(':userID' => $userID));
    $recordSet = $result->fetchAll();

    foreach ($recordSet as $row) {
        $forename = $row['forename'];
        $surname = $row['surname'];
        $emailAddress = $row['emailAddress'];
        echo "


        <div class=\"section group\" id='personaFirstSection'>
            <div class=\"col span_4\">
                <p class='padding1'><label class='personaLabel'>Forename:<label/><br> <input type='text' value='$forename'  name='forename' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Surname:<label/><br> <input type='text' value='$surname'  name='surname' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Email:<label/><br> <input type='email' value='$emailAddress'  name='emailAddress' class='personaInput'> </p>
                <h3>Change password</h3>
                <div class='clear-fix'></div>
                <p class='padding1'><label class='personaLabel'>Old password:<label/><br> <input type='password'  name='oldPassword' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>New password:<label/><br> <input type='password'  name='newPassword' class='personaInput'> </p>
                <p class='padding1'><label class='personaLabel'>Confirm new password:<label/><br> <input type='password'  name='confirmPassword' class='personaInput'> </p>
                <input type='submit' class='project-button-2' value='Update details' name='updateDetails'>
                <a href='#' class='project-button-2' style='background-color: red'>Delete account</a>
            </div>
        </div>";
    }
    echo "</form>";
}
