<?php
include "../session_handlers/sessionStarter.php";
include "config.php";

$result = $user->home_getAllInSiteUsers($_SESSION['username']);
if ($result->rowCount()) {
    $users = [];
    $i = 0;
    foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $val) {
        $users[$i]['user_logged'] = $val['user_logged'];
        $users[$i]['username'] = $val['use_username'];
        $i++;
    }
    echo json_encode($users);
} else
    echo 0;
