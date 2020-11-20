<?php
include_once 'header.php';
if (!isset($_SESSION["shopuser"])) {
    header('location: /login.php');
    exit();
}
include_once 'includes/database.inc.php';

function getAllUserItems($conn, $userId)
{
    $query = "SELECT i.id, i.name, i.price, i.image FROM items i INNER JOIN shopping_cart sc ON i.id = sc.item_id WHERE sc.user_id = ? ORDER BY i.name;";
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

$items = getAllUserItems($conn, $_SESSION["shopuser"]);
/* var_dump(mysqli_fetch_array($items));
exit(); */
if (!isset($items)) {
    echo "database error";
    exit();
}
?>

<link rel="stylesheet" href="styles/styles.css">
<main>
    <div class="container">
        <div class="item-container">
            <!-- create a card for each item -->
            <?php while ($row = mysqli_fetch_array($items)) : ?>
                <div class="card p-2 item-card">
                    <img src="<?php echo $row["image"] ?>" alt="">
                    <p><?php echo $row["name"] ?></p>
                    <p><?php echo $row["price"] ?> Euro</p>

                </div>
            <?php endwhile ?>
        </div>

    </div>
</main>

<?php
include_once 'footer.php'
?>