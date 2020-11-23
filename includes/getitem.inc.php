<?php
session_start();
if (!isset($_SESSION["shopuser"])) {
    header("location: ../login.php");
    exit();
}
if (isset($_GET["id"])) {
    require_once 'database.inc.php';

    $itemId = $_GET["id"];
    $userId = $_SESSION["shopuser"]["id"];

    function buyItem($conn, $userId, $itemId)
    {
        $query = "INSERT INTO shopping_cart (user_id, item_id) VALUES(?, ?);";
        $stmt = mysqli_stmt_init($conn);
        // check if prepared statement is valid
        if (!mysqli_stmt_prepare($stmt, $query)) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "ss", $userId, $itemId);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        return true;
    }

    if (!buyItem($conn, $userId, $itemId)) {
        header("location: ../index.php?error=failedtoget");
        exit();
    }


    header("location: ../profile.php");
} else {
    header("location: ../index.php?error=failedtoget");
}
