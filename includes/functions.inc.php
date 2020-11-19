<?php


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
