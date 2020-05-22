<?php
include "config.php";
include "../session_handlers/sessionStarter.php";

if (isset($_POST['username'])) {
    $this_user = $_SESSION['username'];
    $other_user = $_POST['username'];

    $this_user_id = $user->getUserId($this_user);
    $other_user_id = $user->getUserId($other_user);

    if ($this_user_id->rowCount() && $other_user_id->rowCount()) {
        foreach ($this_user_id->fetchAll(PDO::FETCH_ASSOC) as $val)
            $this_user_id = $val['use_id'];
        foreach ($other_user_id->fetchAll(PDO::FETCH_ASSOC) as $val)
            $other_user_id = $val['use_id'];

        $msg = $chat->getAllMessages($this_user_id, $other_user_id);
        if ($msg->rowCount()) {
            $messages = [];
            $i = 0;
            foreach ($msg->fetchAll(PDO::FETCH_ASSOC) as $val) {
                if ($val['mes_sender_id'] == $this_user_id)
                    $sender = $this_user;
                else
                    $sender = $other_user;

                if ($val['mes_receiver_id'] == $this_user_id)
                    $receiver = $this_user;
                else
                    $receiver = $other_user;

                //getting user color
                $sender_color = $user->getUserColor($sender);
                $receiver_color = $user->getUserColor($receiver);

                if ($sender_color->rowCount() && $receiver_color->rowCount()) {
                    foreach ($sender_color->fetchAll(PDO::FETCH_OBJ) as $val_color)
                        $sender_color = $val_color->use_color;
                    foreach ($receiver_color->fetchAll(PDO::FETCH_OBJ) as $val_color)
                        $receiver_color = $val_color->use_color;
                } else {
                    echo "cant get user color";
                }

                $messages[$i]['sender_color'] = $sender_color;
                $messages[$i]['receiver_color'] = $receiver_color;
                $messages[$i]['sender'] = $sender;
                $messages[$i]['receiver'] = $receiver;
                $messages[$i]['content'] = $val['mes_content'];
                $messages[$i]['status'] = $val['mes_status'];
                $createDate = new DateTime($val['mes_date']);
                $strip = $createDate->format('Y-m-d');
                $messages[$i]['date'] = $strip;
                $i++;
            }

            echo json_encode($messages);
        } else
            echo 0;
    } else {
        echo "error in trying to get this and other user ids!";
    }
}
