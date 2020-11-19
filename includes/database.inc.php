<?php

$host = "localhost";
$user = "root";
$password = "";
$name = "shop";


$conn = mysqli_connect($host, $user, $password, $name);

if (!$conn) {
    die("connection to db failed" . mysqli_connect_error());
} else {
    echo "succes";
}
