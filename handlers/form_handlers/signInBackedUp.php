<?php
include 'config.php';
include '../session_handlers/sessionStarter.php';

if ($_POST['username']) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $auth = $user->getUserAuth();
    if ($username == $auth[0]['username'] && $password == $auth[0]['password']) {
        $_SESSION['username'] = $username;
        echo 1;
    } else {
        echo 0;
    }
} else
    echo "cant find email in the post array!";
