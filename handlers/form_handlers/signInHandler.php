<?php
include "config.php";

if ($_POST['email']) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = $_POST['phone'];

    $result = $user->checkLoginAndPhone($email, $phone);
    if ($result->rowCount()) {

        include "../session_handlers/sessionStarter.php";
        $username = $user->getUsernameByMail($email);
        foreach ($username->fetchAll(PDO::FETCH_ASSOC) as $val)
            $username = $val['use_username'];
        $_SESSION['username'] = $username;
        $log = $user->userLoggedIn($username);
        if (!$log->rowCount())
            echo 1;
        //echo "error in logging you in!";
        else {
            $_SESSION['userLoggedIn'] = true;
            echo 1;
        }
    } else
        echo 0;
}
