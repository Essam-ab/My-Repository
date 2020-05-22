<?php
include "config.php";
include "../session_handlers/sessionStarter.php";

if (isset($_POST['removeNoneSpokenWith'])) {
    $user_in_session = $user->getUserId($_SESSION['username']);

    if ($user_in_session->rowCount()) {
        foreach ($user_in_session->fetchAll(PDO::FETCH_OBJ) as $val)
            $user_in_session_id = $val->use_id;
    }
    $users = $user->getAllSpokenWithUsers($_SESSION['username'], (int) $user_in_session_id);
    if ($users->rowCount()) {
        $all_users = [];
        $i = 0;
        foreach ($users->fetchAll(PDO::FETCH_OBJ) as $val) {
            $all_users[$i]['user_logged'] = $val->user_logged;
            $all_users[$i]['username'] = $val->use_username;
            $i++;
        }
        echo json_encode($all_users);
    } else
        echo "no users online!";
} else if (isset($_POST['checkStandStatus'])) {
    $stand_id = $_POST['stand_id'];
    $users = $user->getAllOnlineOfflineUsers($_SESSION['username']);
    if ($users->rowCount()) {
        $all_users = [];
        $i = 0;
        foreach ($users->fetchAll(PDO::FETCH_OBJ) as $val) {
            $user_id = $user->getUserId($val->use_username);
            if ($user_id->rowCount())
                foreach ($user_id->fetchAll(PDO::FETCH_OBJ) as $x)
                    $user_id = $x->use_id;
            $check = $stand->getUserStatus($user_id, $stand_id, 'yes');
            if ($check->rowCount()) {
                $all_users[$i]['user_logged'] = $val->user_logged;
                $all_users[$i]['username'] = $val->use_username;
                $i++;
            }
        }
        echo json_encode($all_users);
    } else
        echo "no users online!";
} else if (isset($_POST['getOtherSpokenWith'])) {
    $user_in_session = $user->getUserId($_SESSION['username']);

    if ($user_in_session->rowCount()) {
        foreach ($user_in_session->fetchAll(PDO::FETCH_OBJ) as $val)
            $user_in_session_id = $val->use_id;
    }
    $users = $user->getAllSpokenWithChiefs($_SESSION['username'], (int) $user_in_session_id);
    if ($users->rowCount()) {
        $all_users = [];
        $i = 0;
        foreach ($users->fetchAll(PDO::FETCH_OBJ) as $val) {
            $all_users[$i]['user_logged'] = $val->user_logged;
            $all_users[$i]['username'] = $val->use_username;
            $i++;
        }
        echo json_encode($all_users);
    } else
        echo "no users online!";
} else if (isset($_POST['onlyReadMessages'])) {
    $users = $user->getAllOnlineOfflineUsers($_SESSION['username']);
    if ($users->rowCount()) {
        $all_users = [];
        $i = 0;
        foreach ($users->fetchAll(PDO::FETCH_OBJ) as $val) {
            if ($val->use_status == 'read') {
                $all_users[$i]['user_logged'] = $val->user_logged;
                $all_users[$i]['username'] = $val->use_username;
                $all_users[$i]['user_color'] = $val->use_color;
                $i++;
            }
        }
        echo json_encode($all_users);
    } else
        echo "no users online!";
} else if (isset($_POST['auth'])) {
    $users = $user->getAllOnlineOfflineUsersAuth($_SESSION['username']);
    if ($users->rowCount()) {
        $all_users = [];
        $i = 0;
        foreach ($users->fetchAll(PDO::FETCH_OBJ) as $val) {
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
                    $all_users[$i]['last_message'] = substr($message->mes_content, 0, 14) . '...';
            } else {
                $all_users[$i]['last_message'] = substr("Parler avec $val->use_username", 0, 14) . '...';
            }
            $all_users[$i]['user_logged'] = $val->user_logged;
            $all_users[$i]['username'] = $val->use_username;
            $all_users[$i]['user_color'] = $val->use_color;
            $i++;
        }
        echo json_encode($all_users);
    } else
        echo "no users online!";
} else {
    $users = $user->getAllOnlineOfflineUsers($_SESSION['username']);
    if ($users->rowCount()) {
        $all_users = [];
        $i = 0;
        foreach ($users->fetchAll(PDO::FETCH_OBJ) as $val) {
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
                    $all_users[$i]['last_message'] = substr($message->mes_content, 0, 14) . '...';
            } else {
                $all_users[$i]['last_message'] = substr("Parler avec $val->use_username", 0, 14) . '...';
            }
            $all_users[$i]['user_logged'] = $val->user_logged;
            $all_users[$i]['username'] = $val->use_username;
            $all_users[$i]['user_color'] = $val->use_color;
            $i++;
        }
        echo json_encode($all_users);
    } else
        echo "no users online!";
}
