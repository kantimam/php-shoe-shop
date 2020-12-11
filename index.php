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
<main class="py-4">
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
                        <?php if (isset($_SESSION["shopuser"])) : ?>
                            <a class="btn btn-primary" href="includes/getitem.inc.php?id=<?php echo $row["id"] ?>">
                                order
                            </a>
                        <?php else : ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                                order
                            </button>
                        <?php endif; ?>
                    </div>
            <?php }
            } ?>

        </div>

    </div>
</main>


<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >NOT ALLOWED</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                you need to be logged in in order to order items
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="login.php" class="btn btn-primary">login</a>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'footer.php'
?>