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
    <header class="bg-light sticky-top">
        <nav class="navbar container navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php">
                shop
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">

                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                    <?php if (isset($_SESSION["shopuser"])) : ?>
                        <li class="nav-item"><a class="nav-link" href='includes/createitem.inc.php'>add</a></li>
                        <li class="nav-item"><a class="nav-link" href='profile.php'><?php echo $_SESSION["shopuser"]["name"] ?></a></li>
                        <li class="nav-item"><a class="nav-link btn btn-danger text-white" href='includes/logout.inc.php'>logout</a></li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">
                                signup
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                login
                            </a>
                        </li>
                    <?php endif ?>

                </ul>
                <form class="form-inline my-2 my-lg-0" method="GET" action="index.php">
                    <input placeholder="search for name" class="form-control mr-sm-2" type="search" placeholder="Search" name="q">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>

        </nav>
    </header>