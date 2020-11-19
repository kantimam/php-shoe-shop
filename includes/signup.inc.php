<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $name = $_POST["name"];
    $name = $_POST["name"];

    echo $name;
} else {
    header("location: ../signup.php");
}
