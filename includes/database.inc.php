<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "shop";


$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("connection to db failed" . mysqli_connect_error());
}
