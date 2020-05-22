<?php
include "config.php";

if ($_POST['email']) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    // $email = $_POST['email'];
    $username = $user->fetchUsername($email);
    if ($username->rowCount()) {
        foreach ($username->fetchAll(PDO::FETCH_ASSOC) as $val)
            echo $val['use_username'];
    } else
        echo 0;
} else
    echo "cant grab posted email!";
