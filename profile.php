<?php
include_once 'header.php';
if (!isset($_SESSION["shopuser"])) {
    header('location: /login.php');
    exit();
}
include_once 'includes/database.inc.php';
include_once 'includes/helpers.inc.php';


function getAllUserOrders($conn, $userId)
{
    $query = "SELECT i.id, i.name, i.praice, i.image, i.description, sc.id AS sc_id FROM items i INNER JOIN shopping_cart sc ON i.id = sc.item_id WHERE sc.user_id = ? ORDER BY i.name;";
    $stmt = mysqli_stmt_init($conn);
    // check if prepared statement is valid
    if (!mysqli_stmt_prepare($stmt, $query)) {
        include_once('includes/errorscreen.inc.php'); // if there was an error in the query include this script
        errorScreen("could not get user orders from the database", mysqli_stmt_error($stmt)); // use the errorScreen function from the just imported script to display a nicely formatted error
        exit(); // exit this script
    }

    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function getAllUserItems($conn, $userId)
{
    $query = "SELECT * FROM items WHERE user_id=?;";
    $stmt = mysqli_stmt_init($conn);
    // check if prepared statement is valid
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo "could not get user items from the database"; // should never show the user more than that actually rather show an illustration of a sad panda and say something went wrong
        echo mysqli_stmt_error($stmt); // but lets show the error anyway
        mysqli_stmt_close($stmt);
        exit(); // exit this script
    }

    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

$orders = getAllUserOrders($conn, $_SESSION["shopuser"]["id"]);


$items = getAllUserItems($conn, $_SESSION["shopuser"]["id"]);

?>

<link rel="stylesheet" href="styles/styles.css">
<main class="py-4">
    <div class="container">
        <h1>Welcome <?php echo $_SESSION["shopuser"]["name"] ?></h1>
        <?php handleError("failedtocancel", "could not cancel your order") ?>
        <?php handleError("failedtodelete", "could not delete your item") ?>

        <h2 class="mt-5">shopping cart</h2>
        <div class="item-container">
            <!-- create a card for each item -->
            <?php if ($orders) {
                while ($row = mysqli_fetch_array($orders)) { ?>
                    <div class="card p-2 item-card">
                        <img src="<?php echo $row["image"] ?>" alt="">
                        <h2><?php echo $row["name"] ?></h2>
                        <p><?php echo str_replace('.', ',', $row["price"]) ?> Euro</p>
                        <p><?php echo $row["description"] ?></p>
                        <a class="btn btn-danger" href="includes/cancelorder.inc.php?id=<?php echo $row["sc_id"] ?>">
                            cancel
                        </a>
                    </div>
            <?php }
            } ?>
        </div>
        <div class="border-top mt-5">
            <h2 class="mt-5">items you are selling</h2>
            <div class="item-container">
                <!-- create a card for each item -->
                <?php if ($items) {
                    while ($row = mysqli_fetch_array($items)) { ?>
                        <div class="card p-2 item-card">
                            <img src="<?php echo $row["image"] ?>" alt="">
                            <h2><?php echo $row["name"] ?></h2>
                            <p><?php echo str_replace('.', ',', $row["price"]) ?> Euro</p>
                            <p><?php echo $row["description"] ?></p>
                            <a class="btn btn-danger" href="includes/deleteitem.inc.php?id=<?php echo $row["id"] ?>">
                                delete
                            </a>
                        </div>
                <?php }
                } ?>
            </div>
        </div>

    </div>
</main>

<?php
include_once 'footer.php'
?>