<?php
include "config.php";
include "../session_handlers/sessionStarter.php";

if (isset($_POST['stand_id'])) {
    $user_id = $user->getUserId($_SESSION['username']);
    if ($user_id->rowCount()) {
        foreach ($user_id->fetchAll(PDO::FETCH_OBJ) as $val)
            $user_id = $val->use_id;
    }
    $result = $user->getLastNotReadMessage((int) $_POST['stand_id'], $_SESSION['username'],  $user_id);
    if ($result->rowCount()) {
        $has_unread_message = [];
        $i = 0;
        foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $val) {
            $username = $user->getUsername($val['mes_sender_id']);
            if ($username->rowCount()) {
                foreach ($username->fetchAll(PDO::FETCH_OBJ) as $val)
                    $username = $val->use_username;
            } else
                echo "cant get username";
            // echo $username . " has an unread message!";
            $has_unread_message[$i] = $username;
            $i++;
        }
        echo json_encode($has_unread_message);
    } else {
        // echo 0;
        // echo "this user has no unread message!";
    }
}
