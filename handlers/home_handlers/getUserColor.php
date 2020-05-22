<?php
include "config.php";
include "../session_handlers/sessionStarter.php";
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $user_color = $user->getUserColor($username);

    if ($user_color->rowCount()) {
        foreach ($user_color->fetchAll(PDO::FETCH_OBJ) as $val_color)
            $user_color = $val_color->use_color;

        echo $user_color;
    } else {
        echo "cant get user color";
    }
}
