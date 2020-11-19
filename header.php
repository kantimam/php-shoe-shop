<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- get bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                asd
            </div>
            <ul>
                <li>
                    <a href="index.php">
                        home
                    </a>
                </li>
                <?php if (isset($_SESSION["shopuser"])) : ?>
                    <li><a href='profile.php'>profile</a></li>
                    <li><a href='includes/logout.inc.php'>logout</a></li>
                <?php else : ?>
                    <li>
                        <a href="signup.php">
                            signup
                        </a>
                    </li>
                    <li>
                        <a href="login.php">
                            login
                        </a>
                    </li>
                <?php endif ?>

            </ul>
        </nav>
    </header>