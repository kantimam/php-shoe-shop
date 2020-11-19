<?php
include_once 'header.php';
include_once 'includes/database.inc.php';
$result = mysqli_query($conn, "SELECT * FROM items");
?>
<link rel="stylesheet" href="styles/styles.css">
<main>
    <div class="container">
        <div class="item-container">
            <?php while ($row = mysqli_fetch_array($result)) : ?>
                <div class="card p-2 item-card">
                    <img src="<?php echo $row["image"] ?>" alt="">
                    <p><?php echo $row["name"] ?></p>
                    <a class="btn btn-primary" href="<?php echo "includes/getitem?id=" . $row["id"] ?>">
                        buy
                    </a>
                </div>
            <?php endwhile ?>
        </div>

    </div>
</main>

<?php
include_once 'footer.php'
?>