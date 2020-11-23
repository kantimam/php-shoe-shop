<?php
include_once 'header.php';
/* function that displays a given error if the errortype is set as query param */
include_once 'includes/helpers.inc.php';
?>

<main class="py-4">
    <div class="container">
        <form action="includes/login.inc.php" method="post">

            <div class="form-group">
                <label for="user_email">email</label>
                <input type="email" class="form-control" name="email" id="user_email" required>
            </div>

            <div class="form-group">
                <label for="user_password">password</label>
                <input type="password" class="form-control" name="password" id="user_password" required>
            </div>

            <?php handleError("inputEmpty", "please fill out all the inputs") ?>
            <?php handleError("sqlError", "there was an error on the server try again later") ?>
            <?php handleError("invalidCredentials", "invalid credentials") ?>

            <button name="submit" type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>


</main>

<?php
include_once 'footer.php'
?>