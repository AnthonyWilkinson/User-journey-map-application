<?php ob_start();
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makeLoginPage("viewport", "width=device-width, inital-scale=1", "Forgot password form", "image-background");

if (isset($_POST['forgotPassword'])) {
    $dbConn = databaseConn::getConnection();
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';

    $sql = $dbConn->prepare("SELECT userID from CJ_users where emailAddress = :email");
    $sql->execute(array(':email' => $email));

    $results = $sql->rowCount();

    if ($results > 0) {
        $str = "012345672131289anthwidlhgyfuridhfyetsgafwrteysdmvmvbmxkdlghoyot";
        $str = str_shuffle($str);
        $str = substr($str, 0, 12);
        $_SESSION['email'] = $email;
        $message = "To reset your password, please click on the following link: http://unn-w14011103.newnumyspace.co.uk/customer_journey_map_soultions/reset_password_form.php?forgotPasswordToken='$str'&email='$email'";
        mail($email, "Reset password", $message, "From: doNotReply@customerJourneyMapSolutions.com");
        $updateToken = "UPDATE CJ_users SET forgotPasswordToken='$str' where emailAddress= :email";
        $queryToken = $dbConn->prepare($updateToken);
        $queryToken->execute(array(':email' => $email));
        echo "
        
        <div class=\"stripe\">
        <div class=\"inside-containter\">
        <h1>Check your emails</h1><br>
            <p style='text-align: justify'>Please check your emails for a link to reset your password, if you can't find the email, check your spam or junk email folders</p>
            </div>
            </div>";
    } else {
        echo "
             <div class=\"stripe\">
                <div class=\"inside-containter\">
                    <img src=\"images/logo_black.png\"style=\"width:60%\">
                    <h3>Forgot password</h3>
                    <div class='clear-fix'></div>
                    <Form action=\"forgot_password.php\" method=\"POST\">
                        <label for=\"email\">
                            Email address: <br> <input type=\"email\" name=\"email\" class=\"loginRegInput\">
                        </label><br>
                        <input type=\"submit\" value=\"continue\" class=\"project-button-2\" name=\"forgotPassword\">
                    </Form>
                </div>
            </div>
            <div class=\"ErrorMessagesLogin\">
            <p><b>The following errors occurred:</b></p>
            <li>We couldn't match the email address which you have provided. </li>
            </div>";
    }
} else {
    echo "
    <div class=\"stripe\">
        <div class=\"inside-containter\">
            <img src=\"images/logo_black.png\"style=\"width:60%\">
            <h3>Forgot password</h3>
            <div class='clear-fix'></div>
            <Form action=\"forgot_password.php\" method=\"POST\">
                <label for=\"email\">
                    Email address: <br> <input type=\"email\" name=\"email\" class=\"loginRegInput\">
                </label><br>
                <input type=\"submit\" value=\"continue\" class=\"project-button-2\" name=\"forgotPassword\">
            </Form>
        </div>
    </div>
    ";
}
echo makePageFooter();