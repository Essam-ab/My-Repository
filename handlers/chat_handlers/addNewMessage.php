<?php
include "config.php";

if (isset($_POST['sender'], $_POST['receiver'], $_POST['msg'])) {
    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $msg = $_POST['msg'];
    $sender_id = $user->getUserId($sender);
    $receiver_id = $user->getUserId($receiver);

    if ($sender_id->rowCount() && $receiver_id->rowCount()) {
        foreach ($sender_id->fetchAll(PDO::FETCH_OBJ) as $val)
            $sender_id = $val->use_id;
        foreach ($receiver_id->fetchAll(PDO::FETCH_OBJ) as $val)
            $receiver_id = $val->use_id;

        $message = $chat->addMessage($sender_id, $receiver_id, $msg);
        if ($message->rowCount()) {
            echo 1;
        } else
            echo 0;
    } else {
        echo "cant fetch users ids!";
    }
}
