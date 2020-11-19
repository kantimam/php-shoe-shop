<?php
include_once 'header.php'
?>

<main>
    <div class="container">
        <form action="includes/signup.inc.php" method="post">
            <div class="form-group">
                <label for="user_name">username</label>
                <input type="text" class="form-control" name="name" id="user_name">
            </div>

            <div class="form-group">
                <label for="user_email">email</label>
                <input type="email" class="form-control" name="email" id="user_email">
            </div>

            <div class="form-group">
                <label for="user_password">password</label>
                <input type="password" class="form-control" name="password" id="user_password">
            </div>

            <div class="form-group">
                <label for="user_password_repeat">repeat password</label>
                <input type="password" class="form-control" name="password_repeat" id="user_password_repeat">
            </div>

            <button name="submit" type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>


</main>

<?php
include_once 'footer.php'
?>