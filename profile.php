<?php
include_once 'header.php';
if (!isset($_SESSION["shopuser"])) {
    header('location: /login.php');
    exit();
}
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
<main>
    <div class="container">
        <h1>Welcome <?php echo $_SESSION["shopuser"]["name"] ?></h1>
        <h2>shopping cart</h2>
        <div class="item-container">
            <!-- create a card for each item -->
            <?php if ($result) {
                while ($row = mysqli_fetch_array($result)) { ?>
                    <div class="card p-2 item-card">
                        <img src="<?php echo $row["image"] ?>" alt="">
                        <h2><?php echo $row["name"] ?></h2>
                        <p><?php echo str_replace('.', ',', $row["price"]) ?> Euro</p>
                        <p><?php echo $row["description"] ?></p>

                    </div>
            <?php }
            } ?>
        </div>

    </div>
</main>

<?php
include_once 'footer.php'
?>