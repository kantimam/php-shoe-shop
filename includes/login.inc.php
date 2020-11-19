<?php
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];


    require_once 'database.inc.php';
    require_once 'functions.inc.php';


    /* handle empty inputs */
    if (empty($email) || empty($password)) {
        header("location: ../login.php?error=inputEmpty");
        exit();
    }

    /* handle loging failure */
    $loggedInUser = logInUser($conn, $email, $password);
    if (!$loggedInUser) {
        header("location: ../login.php?error=invalidCredentials");
        exit();
    };

    /* if login didnt fail we start the session */
    session_start();
    $_SESSION["shopuser"] = $loggedInUser["id"];
    header("location: ../");
} else {
    header("location: ../login.php");
}
