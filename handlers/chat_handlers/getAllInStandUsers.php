<?php
include "config.php";
include "../session_handlers/sessionStarter.php";

if (isset($_POST['stand_id'])) {
    $result = $user->getAllInStandUsers($_POST['stand_id'], $_SESSION['username']);
    if ($result->rowCount()) {
        $users = [];
        $i = 0;
        foreach ($result->fetchAll(PDO::FETCH_OBJ) as $val) {
            $users[$i]['user_logged'] = $val->user_logged;
            $users[$i]['username'] = $val->use_username;
            $users[$i]['joined_at'] = $val->joined_at;
            $users[$i]['left_at'] = $val->left_at;
            $i++;
        }
        echo json_encode($users);
    } else
        echo "no users in this stand!";
} else {
    echo 0;
}
