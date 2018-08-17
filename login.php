<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makeLoginPage("viewport", "width=device-width, inital-scale=1", "Login page", "image-background");

if (isset($_POST['loginAction'])) {
    //connect to the database
    require_once('classes/databaseConn.php');
    $dbConn = databaseConn::getConnection();
    //get all of the inputs using the isset method
    $email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : null;
    $password = isset($_REQUEST["password"]) ? $_REQUEST["password"] : null;
    //sanitize the inputs
    $email = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
    //trim any white space
    trim($email);
    trim($password);
    //create an errors array to store the error messages
    $errors = array();
    //if email is empty
    if (empty($email)) {
        //add a error message to errors array
        $errors[] = "You have not entered a email address";
    }
    // if password is empty
    if (empty($password)) {
        //add a error message to errors array
        $errors[] = "You have not entered a password";
    }
    //if errors array is not empty
    if (!empty($errors)) {
        echo "<div class=\"ErrorMessagesLogin\">";
        echo "<b>The following errors occurred:</b> ";
        foreach ($errors as $currentError) {
            echo '<li>' . $currentError . '</li>';
        }
        echo "</div>";
    } else {
        $sql = "SELECT password from CJ_users where emailAddress = :email";
        $query = $dbConn->prepare($sql);
        $query->execute(array(':email' => $email));
        $results = $query->fetchAll();
        if ($results) {
            foreach ($results as $row) {
                if (password_verify($password, $row['password'])) {
                    $getForename = "SElECT forename from CJ_users where emailAddress = :email";
                    $stmt = $dbConn->prepare($getForename);
                    $stmt->execute(array(':email' => $email));
                    $forename = $stmt->fetchColumn();
                    $getUserID = "SElECT userID from CJ_users where emailAddress = :email";
                    $stmt2 = $dbConn->prepare($getUserID);
                    $stmt2->execute(array(':email' => $email));
                    $userID = $stmt2->fetchColumn();
                    $_SESSION['forename'] = $forename;
                    $_SESSION['email'] = $email;
                    $_SESSION['userID'] = $userID;
                    $_SESSION['logged-in'] = true;
                    header('Location: index.php');
                    exit();
                } else {
                    echo '<div class="ErrorMessagesLogin">
                            <p><b>The following error occurred:</b></p>
                            <li>The email address or password you provided is incorrect. Please try again. </li>
                           </div>';
                }
            }
        } else {
            echo "<div class=\"ErrorMessagesLogin\">
                    <p><b>The following error occurred:</b></p>
                    <li>We couldn't match the email to the password which you have provided. Please try again. </li>
                   </div>";
        }
    }
}
?>
    <div class="stripe">
        <div class="inside-containter">
            <img src="images/logo_black.png" style="width:60%">

            <Form action="login.php" method="POST" style="margin-top:15%;">
                <label for="email">
                    Email address: <br> <input type="email" name="email" class="loginRegInput">
                </label><br>
                <label for="password">
                    Password: <br> <input type="password" name="password">
                </label> <br>
                <p class="float-right"><a href="forgot_password.php">Forgot your password?</a></p>
                <input type="submit" value="Login" class="button " name="loginAction">
            </Form>
        </div>
        <br><br><br><br><br><br>
        <p class="float-left"><a href="registration.php">Create an account</a></p>
    </div>
<?php echo makePageFooter() ?>