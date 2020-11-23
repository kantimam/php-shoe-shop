<?php
include_once 'header.php';
if (!isset($_SESSION["shopuser"])) {
    header('location: /login.php');
    exit();
}
include_once 'includes/helpers.inc.php';
include_once 'includes/database.inc.php';

function getAllUserItems($conn, $userId)
{
    $query = "SELECT i.id, i.name, i.price, i.image, i.description FROM items i INNER JOIN shopping_cart sc ON i.id = sc.item_id WHERE sc.user_id = ? ORDER BY i.name;";
    $stmt = mysqli_stmt_init($conn);
    // check if prepared statement is valid
    if (!mysqli_stmt_prepare($stmt, $query)) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

$result = getAllUserItems($conn, $_SESSION["shopuser"]["id"]);

if (!isset($result)) {
    echo "database error";
    exit();
}
?>

<link rel="stylesheet" href="styles/styles.css">
<main class="py-4">
    <div class="container">
        <h1>create an item</h1>
        <?php handleMessage("success", "successfully created") ?>

        <form action="includes/createitem.inc.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="item_name">name</label>
                <input type="text" class="form-control" name="name" id="item_name" required>
            </div>

            <div class="form-group">
                <label for="item_price">price</label>
                <input type="number" step="any" class="form-control" name="price" id="item_price" required>
            </div>

            <div class="form-group">
                <label for="item_image">image</label>
                <input type="file" name="image" id="item_image" required>
            </div>

            <div class="form-group">
                <label for="item_description">description</label>
                <textarea rows="4" class="form-control" name="description" id="item_description"></textarea>
            </div>

            <?php handleError("inputEmpty", "please fill out all the inputs") ?>
            <?php handleError("fileerror", "there was an error in your file") ?>
            <?php handleError("failedupload", "upload failed") ?>
            <?php handleError("invalidfiletype", "invalid image type please only jpg or png") ?>
            <?php handleError("sqlError", "there was an error on the server try again later") ?>
            <button name="submit" type="submit" class="btn btn-primary">create</button>

        </form>
    </div>


</main>

<?php
include_once 'footer.php'
?>