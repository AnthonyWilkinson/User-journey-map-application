<?php ob_start();
require_once('scripts/functions.php');
require_once('classes/databaseConn.php');
echo makeLoginPage("viewport", "width=device-width, inital-scale=1", "Registration page", "image-background");

//check if the registration submit button has been submitted
if (isset($_POST['registrationButton'])) {
    //connect to the database
    require_once('classes/databaseConn.php');
    $dbConn = databaseConn::getConnection();

    //get all of the inputs using the isset method
    $forename = isset($_REQUEST["forename"]) ? $_REQUEST["forename"] : null;
    $surname = isset($_REQUEST["surname"]) ? $_REQUEST["surname"] : null;
    $email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : null;
    $password = isset($_REQUEST["password"]) ? $_REQUEST["password"] : null;
    $confirmPassword = isset($_REQUEST["confirmPassword"]) ? $_REQUEST["confirmPassword"] : null;

    //sanitize the inputs
    $forename = filter_var($forename, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $surname = filter_var($surname, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $email = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $confirmPassword = filter_var($confirmPassword, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $forename = filter_var($forename, FILTER_SANITIZE_SPECIAL_CHARS);
    $surname = filter_var($surname, FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmPassword = filter_var($confirmPassword, FILTER_SANITIZE_SPECIAL_CHARS);

    //trim any white space
    trim($forename);
    trim($surname);
    trim($email);
    trim($password);
    trim($confirmPassword);

    //create an errors array to store the error messages
    $errors = array();

    //check that there is something in each field
    if (empty($forename)) {
        $errors[] = "You have not entered a forename";
    }

    if (empty($surname)) {
        $errors[] = "You have not entered a surname";
    }

    if (empty($email)) {
        $errors[] = "You have not entered a email address";
    }

    if (empty($password)) {
        $errors[] = "You have not entered a password";
    }

    if (empty($confirmPassword)) {
        $errors[] = "You have not confirmed your password";
    }

    //check the right lengths
    if (strlen($forename) > 225) {
        $errors[] = "You have entered more than the max 225 characters length for forename";
    }

    if (strlen($surname) > 225) {
        $errors[] = "You have entered more than the max 225 characters length for surname";
    }

    if (strlen($email) > 225) {
        $errors[] = "You have entered more than the max 225 characters length for email";
    }

    if (strlen($password) > 225) {
        $errors[] = "You have entered more than the max 225 characters length for password";
    }

    if (strlen($confirmPassword) > 225) {
        $errors[] = "You have entered more than the max 225 characters length for confirm password";
    }

    if (strlen($forename) < 2) {
        $errors[] = "You have entered less than the minimum 2 characters length for forename";
    }

    if (strlen($surname) < 2) {
        $errors[] = "You have entered less than the minimum 2 characters length for surname";
    }

    if (strlen($email) < 5) {
        $errors[] = "You have entered less than the minimum 5 characters length for email";
    }

    if (strlen($password) < 5) {
        $errors[] = "You have entered less than the minimum 5 characters length for password";
    }

    if (strlen($confirmPassword) < 5) {
        $errors[] = "You have entered less than the minimum 5 characters length for confirm password";
    }

    //check that password and confirm password both match each other
    if ($password != $confirmPassword) {
        $errors[] = "Your password and confirm password do not match each other";
    }

    //check if email address is already in use
    $emailSQL = "SELECT emailAddress from CJ_users where emailAddress = :email";
    $query = $dbConn->prepare($emailSQL);
    $query->execute(array(':email' => $email));
    $count = $query->rowCount();

    if ($count > 0) {
        $errors[] = "The email which you have provided is already in use. If you have forgotten your password, use the forgot password functionality to reset your password";
    }
    //if errors array is not empty
    if (!empty($errors)) {
        echo "
        <div class=\"stripe\">
        <div class=\"inside-containter\">
            <img src=\"images/logo_black.png\" style=\"width:60%\">
            <form action=\"registration.php\" method=\"post\" style=\"margin-top:15%;\">
                <label for=\"forename\">
                    First name: <br> <input type=\"text\" name=\"forename\" minlength=\"3\" class=\"loginRegInput\">
                </label><br>
                <label for=\"surname\">
                    Surname: <br> <input type=\"text\" name=\"surname\" minlength=\"3\" class=\"loginRegInput\">
                </label><br>
                <label for=\"email\">
                    Email address: <br> <input type=\"email\" name=\"email\">
                </label><br>
                <label for=\"password\">
                    Password: <br> <input type=\"password\" name=\"password\">
                </label><br>
                <label for=\"password_confirm\">
                    Confirm password: <br> <input type=\"password\" name=\"confirmPassword\">
                </label> <br>
                <input type=\"submit\" value=\"Register\" class=\"button\" name=\"registrationButton\">
            </form>
        </div>
        <br><br><br><br>
        <p class=\"float-left\"><a href=\"login.php\">Already have an account?</a></p>
    </div>
        ";
        echo "<div class=\"ErrorMessagesLogin\">";
        echo "<b>The following errors occurred:</b> ";
        foreach ($errors as $currentError) {
            echo '<li>' . $currentError . '</li>';
        }
        echo "</div>";

    } else {
        $password_hash = password_hash($confirmPassword, PASSWORD_BCRYPT);
        $sql = "INSERT INTO CJ_users (forename, surname, emailAddress, password) VALUES (:forename, :surname, :email, :password_hash)";
        $query = $dbConn->prepare($sql);
        $query->execute(array('forename' => $forename, ':surname' => $surname, ':email' => $email, ':password_hash' => $password_hash));
        $to = $email;
        $subject = 'Customer journey map solutions account created';
        $message = "
                <html>
                <head>
                  <title>New Customer journey map solutions account created</title>
                </head>
                <body>
                  <p>Dear $forename, 
                  
                  <br/> Thanks for signing up to Customer journey map solutions. You are now able to login to your account to create your own user experience projects.</p>
                 
                  <p>Kind regards, Customer journey map solutions </p>
                </body>
                </html>
                ";
        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        // Additional headers
        $headers[] = 'To: $email';
        $headers[] = 'From: noreply@simplyuserexperience.com';
        // Mail it
        mail($to, $subject, $message, implode("\r\n", $headers));

        echo "
        <div class=\"stripe\">
            <div class=\"inside-containter\"> 
                <img src=\"images/logo_black.png\" style=\"width:60%\">
                <div class='clear-fix'></div>
                <p>Your account has been created. You can login to your account using the <a href='login.php'>login functionality  </a></p>
            </div>
        </div>";
    }
} else {
    echo " <div class=\"stripe\">
        <div class=\"inside-containter\">
            <img src=\"images/logo_black.png\" style=\"width:60%\">
            <form action=\"registration.php\" method=\"post\" style=\"margin-top:15%;\">
                <label for=\"forename\">
                    First name: <br> <input type=\"text\" name=\"forename\" minlength=\"3\" class=\"loginRegInput\">
                </label><br>
                <label for=\"surname\">
                    Surname: <br> <input type=\"text\" name=\"surname\" minlength=\"3\" class=\"loginRegInput\">
                </label><br>
                <label for=\"email\">
                    Email address: <br> <input type=\"email\" name=\"email\">
                </label><br>
                <label for=\"password\">
                    Password: <br> <input type=\"password\" name=\"password\">
                </label><br>
                <label for=\"password_confirm\">
                    Confirm password: <br> <input type=\"password\" name=\"confirmPassword\">
                </label> <br>
                <input type=\"submit\" value=\"Register\" class=\"button\" name=\"registrationButton\">
            </form>
        </div>
        <br><br><br><br>
        <p class=\"float-left\"><a href=\"login.php\">Already have an account?</a></p>
    </div>";
}

echo makePageFooter();