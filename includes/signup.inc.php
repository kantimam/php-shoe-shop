<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRe = $_POST["password_repeat"];


    require_once 'database.inc.php';
    require_once 'functions.inc.php';


    /* handle empty inputs */
    if (empty($name) || empty($email) || empty($password) || empty($passwordRe)) {
        header("location: ../signup.php?error=inputEmpty");
        exit();
    }

    /* handle repeat password not matching password */
    if ($password !== $passwordRe) {
        header("location: ../signup.php?error=passwordNoMatch");
        exit();
    }

    function getUserOrFail($conn, $email)
    {
        $query = "SELECT * FROM users WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);
        // check if prepared statement is valid
        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../signup.php?error=sqlError");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $name, $email, $password)
    {
        $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        // check if prepared statement is valid
        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../signup.php?error=sqlError");
            exit();
        }

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    /* check if user with that emial already exists */
    if (getUserOrFail($conn, $email)) {
        header("location: ../signup.php?error=userExists");
        exit();
    }

    /* actually create the user */
    createUser($conn, $name, $email, $password);



    header("location: ../");
} else {
    header("location: ../signup.php");
}
