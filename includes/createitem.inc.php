<?php
session_start();
if (!isset($_SESSION["shopuser"])) {
    header("location: ../login.php");
    exit();
}
if (isset($_POST["submit"])) {
    require_once 'database.inc.php';

    $userId = $_SESSION["shopuser"]["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $image = $_FILES["image"];
    $description = $_POST["description"];

    /* handle empty inputs */
    if (empty($name) || empty($image) || empty($price)) {
        header("location: ../create.php?error=inputEmpty");
        exit();
    }

    /* handle invalid files */
    $imageName = $image["name"];
    $imageTmpName = $image["tmp_name"];
    $imageError = $image["error"];
    $imageType = $image["type"];

    $imageFileExt = strtolower(end(explode(".",  $imageName)));
    $allowedExt = array("jpg", "jpeg", "png");

    if ($imageError !== 0) {
        header("location: ../create.php?error=fileerror");
        exit();
    }

    if (!in_array($imageFileExt, $allowedExt)) {
        header("location: ../create.php?error=invalidfiletype");
        exit();
    }

    $newImageName = uniqid("", true) . "." . $imageFileExt;
    $filePath = '../uploads/' . $newImageName;
    $uploadSucces = move_uploaded_file($imageTmpName, $filePath);
    if (!$uploadSucces) {
        header("location: ../create.php?error=failedupload");
        exit();
    }

    function createItem($conn, $name, $price, $description, $image, $userId)
    {
        $query = "INSERT INTO items (name, price, description, image, user_id) VALUES (?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        // check if prepared statement is valid
        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../create.php?error=sqlError");
            exit();
        }


        mysqli_stmt_bind_param($stmt, "sdssi", $name, $price, $description, $image, $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    createItem($conn, $name, $price, $description, $filePath, $userId);

    header("location: ../create.php?message=success");
} else {
    header("location: ../create.php?error=failedtocreate");
}
