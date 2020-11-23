<?php
include_once 'header.php';
include_once 'includes/database.inc.php';
include_once 'includes/helpers.inc.php';
$result;
if (isset($_GET["q"])) {
    /* if there is a query search for that */
    $query = "SELECT * FROM items WHERE name LIKE '%" . $_GET["q"] . "%'";
    $result = mysqli_query($conn, $query);
} else {
    /* else get all items from db */
    $result = mysqli_query($conn, "SELECT * FROM items");
}

?>
<link rel="stylesheet" href="styles/styles.css">
<main>
    <div class="container">
        <?php handleError("failedtoget", "could not get this item please try again later") ?>
        <div class="item-container">
            <!-- create a card for each item -->
            <?php if ($result) {
                while ($row = mysqli_fetch_array($result)) { ?>
                    <div class="card p-2 item-card">
                        <img src="<?php echo $row["image"] ?>" alt="">
                        <h2><?php echo $row["name"] ?></h2>
                        <p><?php echo str_replace('.', ',', $row["price"])  ?> Euro</p>
                        <p><?php echo $row["description"] ?></p>

                        <a class="btn btn-primary" href="includes/getitem.inc.php?id=<?php echo $row["id"] ?>">
                            buy
                        </a>
                    </div>
            <?php }
            } ?>

        </div>

    </div>
</main>

<?php
include_once 'footer.php'
?>