<?php 
    // function that shows an nicely formatted error screen with the provided message and error 
    function errorScreen($message, $error){
    ?>
        <div class="container">
            <h2>something went wrong :/</h2>
            <div>sad cat</div>
            <h3><?php echo $message ?></h3>
            <h5 class="text-danger"><?php echo $error ?></h5>
        </div>
    <?php
    }
    ?>

