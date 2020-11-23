<?php
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];


    require_once 'database.inc.php';



    /* handle empty inputs */
    if (empty($email) || empty($password)) {
        header("location: ../login.php?error=inputEmpty");
        exit();
    }

    function getUserOrFail($conn, $email)
    {
        $query = "SELECT * FROM users WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);
        // check if prepared statement is valid
        if (!mysqli_stmt_prepare($stmt, $query)) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row;
        } else {
            return false;
        }

        mysqli_stmt_close($stmt);
    }

    function logInUser($conn, $email, $password)
    {
        $user = getUserOrFail($conn, $email);
        if (!$user) {
            return false;
        }
        $pwdValid = password_verify($password, $user["password"]);
        if (!$pwdValid) {
            return false;
        }
        return $user;
    }

    /* handle loging failure */
    $loggedInUser = logInUser($conn, $email, $password);
    if (!$loggedInUser) {
        header("location: ../login.php?error=invalidCredentials");
        exit();
    };

    /* if login didnt fail we start the session */
    session_start();
    $_SESSION["shopuser"] = array();
    $_SESSION["shopuser"]["id"] = $loggedInUser["id"];
    $_SESSION["shopuser"]["name"] = $loggedInUser["name"];
    header("location: ../");
} else {
    header("location: ../login.php");
}
