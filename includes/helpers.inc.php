<?php
/* function that displays a given error if the errortype is set as query param */
function handleError($errorType, $errorMessage)
{
    if (isset($_GET["error"])) {
        if ($_GET["error"] == $errorType) {
            echo '<p class="text-danger">' . $errorMessage . '</p>';
            return;
        }
    }
    return;
}


function handleMessage($messageType, $message)
{
    if (isset($_GET["message"])) {
        if ($_GET["message"] == $messageType) {
            echo '<p class="text-success">' . $message . '</p>';
            return;
        }
    }
    return;
}
