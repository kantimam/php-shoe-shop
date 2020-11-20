<?php
if (!$_SESSION["shopuser"]) {
    /* if user is not logged in send him to the login page */
    http_response_code(401);
    //header('location: ../login.php');
    exit();
}
if (isset($_GET["id"])) {
    $itemId = $_GET["id"];
    require_once 'database.inc.php';

    header('Content-type: application/json');
    echo json_encode(['message' => 'succes', 'itemId' => $itemId]);
    /*  */
}
