<?php
include "config.php";
include  "../session_handlers/sessionStarter.php";

if (isset($_POST['search'])) {
    $result = $user->searchByLastOrFirstName($_POST['search'], $_SESSION['username']);
    if ($result->rowCount()) {
        $output = '';
        foreach ($result->fetchAll(PDO::FETCH_OBJ) as $val) {
            if ($val->user_logged == "yes") {
                $color = "#39ff00";
            } else {
                $color = "red";
            }
            $in_session_user_id = $user->getUserId($_SESSION['username']);
            $other_user_id = $user->getUserId($val->use_username);

            if ($in_session_user_id->rowCount() && $other_user_id->rowCount()) {
                foreach ($in_session_user_id->fetchAll(PDO::FETCH_ASSOC) as $id)
                    $in_session_user_id = $id['use_id'];
                foreach ($other_user_id->fetchAll(PDO::FETCH_ASSOC) as $id)
                    $other_user_id = $id['use_id'];
            }
            $last_message = $chat->getLastMessage($in_session_user_id, $other_user_id);
            if ($last_message->rowCount()) {
                foreach ($last_message->fetchAll(PDO::FETCH_OBJ) as $message)
                    $message = substr($message->mes_content, 0, 11) . '...';
            } else {
                $message  = substr("Parler avec $val->use_username", 0, 11) . '...';
            }
            $output .= '<div class="" id="user_row" name="user_row" user_username="' . $val->use_username . '">
                <article class="user_tag">
                <div class="user_tag_left">
                    <div class="chat_user_image " style="background:' . $val->use_color . ' !important;box-shadow:0px 0px 5px 0px ' . $val->use_color . ';">
                        ' . strtoupper(substr($val->use_username, 0, 1)) . '
                    </div>
                    <i class="fas fa-circle" aria-hidden="true" style="color: ' . $color . '"></i>
                </div>
                <div class="user_tag_right">
                    <h6>' . $val->use_username . '</h6>
                    <br><p>' . $message . '</p>
                </div>
                </article>
             </div>';
        }
        echo $output;
    } else {
        echo 0;
    }
} else
    echo -1;
