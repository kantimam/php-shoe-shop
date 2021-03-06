<?php
session_start();
if (!isset($_SESSION["shopuser"])) {
    header("location: ../login.php");
    exit();
}
if (isset($_GET["id"])) {
    require_once 'database.inc.php';

    $userId = $_SESSION["shopuser"]["id"];
    $id = $_GET["id"];

    function deleteOwnItem($conn, $id, $userId)
    {
        $query = "DELETE FROM items WHERE id=? AND user_id=?;";
        $stmt = mysqli_stmt_init($conn);
        // check if prepared statement is valid
        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile.php?error=failedtodelete");
            exit();
        }


        mysqli_stmt_bind_param($stmt, "ii", $id, $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    deleteOwnItem($conn, $id, $userId);


    header("location: ../profile.php");
} else {
    header("location: ../profile.php?error=failedtodelete");
}
