<?php
include_once 'header.php'
?>

<main>
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

            <button name="submit" type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>


</main>

<?php
include_once 'footer.php'
?>