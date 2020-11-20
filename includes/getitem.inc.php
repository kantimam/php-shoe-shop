<?php
session_start();
if (!isset($_SESSION["shopuser"])) {
    echo $_SESSION["shopuser"];
    /* if user is not logged in send him to the login page */
    //http_response_code(401);
    exit();
}
if (isset($_GET["id"])) {
    require_once 'database.inc.php';

    $itemId = $_GET["id"];
    $userId = $_SESSION["shopuser"];

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

    header('Content-type: application/json');
    if (!buyItem($conn, $userId, $itemId)) {
        http_response_code(500);
        echo json_encode(['message' => 'failed to buy item', 'itemId' => $itemId]);
        exit();
    }


    echo json_encode(['message' => 'succes', 'itemId' => $itemId]);
    /*  */
}
