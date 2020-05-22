<?php
include "config.php";
include "../session_handlers/sessionStarter.php";

if (isset($_POST['url'])) {
    $result = $user->updateStreamUrl($_POST['url']);
    if ($result->rowCount()) {
        echo 1;
    } else {
        echo 0;
    }
}
