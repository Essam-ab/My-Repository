<?php
include "config.php";
include "../session_handlers/sessionStarter.php";

if (isset($_POST['sender'])) {
    $receiver = $user->getUserId($_SESSION['username']);
    $sender = $user->getUserId($_POST['sender']);

    if ($receiver->rowCount() && $sender->rowCount()) {
        foreach ($receiver->fetchAll(PDO::FETCH_OBJ) as $val)
            $receiver_id = $val->use_id;

        foreach ($sender->fetchAll(PDO::FETCH_OBJ) as $val)
            $sender_id = $val->use_id;

        $update = $chat->updateMessageStatus('read', $sender_id, $receiver_id);
        if ($update->rowCount()) {
            echo 1;
        } else {
            echo "there is no such message in the database!";
        }
    }
}
