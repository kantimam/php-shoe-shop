<?php
include_once 'header.php';
include_once 'includes/database.inc.php';
/* get all items from db */
$result = mysqli_query($conn, "SELECT * FROM items");
?>
<link rel="stylesheet" href="styles/styles.css">
<main>
    <div class="container">
        <div class="item-container">
            <!-- create a card for each item -->
            <?php while ($row = mysqli_fetch_array($result)) : ?>
                <div class="card p-2 item-card">
                    <img src="<?php echo $row["image"] ?>" alt="">
                    <p><?php echo $row["name"] ?></p>
                    <button class="btn btn-primary" data-item-id="<?php echo $row["id"] ?>">
                        buy
                    </button>
                </div>
            <?php endwhile ?>
        </div>

    </div>
</main>
<script>
    const itemCards = document.querySelectorAll('.item-card > button');

    async function getItem(itemId) {
        try {
            const res = await fetch(`includes/getitem.inc.php?id=${itemId}`, {
                redirect: 'follow'
            });
            if (res.redirected) {
                window.location.href = "/shop/login.php"
            }
            const json = await res.json();
            console.log(json);
        } catch (error) {
            /* alert(error) */
        }
    }

    itemCards.forEach(card => {
        card.addEventListener("click", (event) => {
            const itemId = event.target.dataset.itemId;
            getItem(itemId);
        })
    })
</script>
<?php
include_once 'footer.php'
?>