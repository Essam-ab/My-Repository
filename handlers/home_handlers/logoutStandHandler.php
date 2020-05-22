<?php
include "config.php";

if (isset($_POST['username'])) {
    $user_id = $user->getUserId($_POST['username']);
    if ($user_id->rowCount()) {
        foreach ($user_id->fetchAll(PDO::FETCH_ASSOC) as $val)
            $user_id = $val['use_id'];
    }
    $logout = $user->logUserOutOfStand($user_id, 'no', (int) $_POST['stand_id']);

    if ($logout->rowCount()) {
        echo 1;
    } else
        echo 0;
}
