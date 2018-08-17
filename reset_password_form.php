<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makeLoginPage("viewport", "width=device-width, inital-scale=1", "Reset password form", "image-background");

if (isset($_POST['updatePassword'])) {
    $email = $_SESSION['email'];
    $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
    $confirmPassword = isset($_REQUEST['confirmPassword']) ? $_REQUEST['confirmPassword'] : '';
    $errors = array();
    if (empty($password)) {
        $errors[] = "You need to enter a password";
    }
    if (empty($password)) {
        $errors[] = "You need to confirm your password";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Your passwords do not match each other";
    }
    if (strlen($password) < 6) {
        $errors[] = "Your password needs to more than 6 characters long";
    }
    if (!empty($errors)) {
        echo "
        <div class=\"stripe\">
        <div class=\"inside-containter\">
            <img src=\"images/logo_black.png\"style=\"width:60%:\">
            <h3>Reset password</h3>
            <Form action=\"reset_password_form.php\" method=\"POST\">
                <div class='clear-fix'></div>
                <label for=\"email\">
                    Password: <br> <input type=\"password\" name=\"password\" class=\"loginRegInput\">
                </label><br>
                <div class='clear-fix'></div>
                <label for=\"confirmPassword\">
                    Confirm password: <br> <input type=\"password\" name=\"confirmPassword\" class=\"loginRegInput\">
                </label><br>
                <input type=\"submit\" value=\"continue\" class=\"project-button-2\" name=\"updatePassword\">
            </Form>
        </div>
    </div>
        <div class=\"ErrorMessagesLogin\">";
        echo "<b>The following errors occurred:</b> ";
        foreach ($errors as $currentError) {
            echo '<li>' . $currentError . '</li>';
        }
        echo "</div>";
    } else {
        $dbConn = databaseConn::getConnection();
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $updateUsers = "UPDATE CJ_users SET password= :password_hash, forgotPasswordToken = :forgotPasswordToken where emailAddress = :email ";
        $usersQuery = $dbConn->prepare($updateUsers);
        $usersQuery->execute(array(':password_hash' => $password_hash, ':forgotPasswordToken' => '', 'email' => $email));

        echo "<div class=\"stripe\">
        <div class=\"inside-containter\">
        <img src=\"images/logo_black.png\" style=\"width:60%:\">
        <p>Password updated</p>
        <a href='login.php'>Back to login</a>
        </div></div>";
        //destroys the forgot password session
        session_destroy();
    }
} else {
    if (isset($_SESSION['email'])) {
        echo "
    <div class=\"stripe\">
        <div class=\"inside-containter\">
            <img src=\"images/logo_black.png\"style=\"width:60%:\">
            <h3>Reset password</h3>
            <Form action=\"reset_password_form.php\" method=\"POST\">
                <div class='clear-fix'></div>
                <label for=\"email\">
                    Password: <br> <input type=\"password\" name=\"password\" class=\"loginRegInput\">
                </label><br>
                <div class='clear-fix'></div>
                <label for=\"confirmPassword\">
                    Confirm password: <br> <input type=\"password\" name=\"confirmPassword\" class=\"loginRegInput\">
                </label><br>
                <input type=\"submit\" value=\"continue\" class=\"project-button-2\" name=\"updatePassword\">
            </Form>
        </div>
    </div>
    ";
    } else {
        echo "You can't get access to this page.";
    }
}
echo makePageFooter();