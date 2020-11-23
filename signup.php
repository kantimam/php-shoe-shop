<?php
include_once 'header.php';
/* function that displays a given error if the errortype is set as query param */
include_once 'includes/helpers.inc.php';
?>

<main>
    <div class="container">
        <form action="includes/signup.inc.php" method="post">
            <div class="form-group">
                <label for="user_name">name</label>
                <input type="text" class="form-control" name="name" id="user_name" required>
            </div>

            <div class="form-group">
                <label for="user_email">email</label>
                <input type="email" class="form-control" name="email" id="user_email" required>
                <?php handleError("userExists", "user with this email already exists") ?>
            </div>

            <div class="form-group">
                <label for="user_password">password</label>
                <input type="password" class="form-control" name="password" id="user_password" required>
            </div>

            <div class="form-group">
                <label for="user_password_repeat">repeat password</label>
                <input type="password" class="form-control" name="password_repeat" id="user_password_repeat" required>
                <?php handleError("passwordNoMatch", "passwords do not match") ?>
            </div>

            <?php handleError("inputEmpty", "please fill out all the inputs") ?>
            <?php handleError("sqlError", "there was an error on the server try again later") ?>
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>


</main>

<?php
include_once 'footer.php'
?>