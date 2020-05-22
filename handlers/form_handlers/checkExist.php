<?php
include "config.php";

if (isset($_POST['username'])) {
    $username = $user->checkUsernameExist($_POST['username']);
    if ($username->rowCount())
        echo 1;
    else
        echo 0;
}
if (isset($_POST['email'])) {
    $email = $user->checkEmailExist($_POST['email']);
    if ($email->rowCount()) {
        foreach ($email->fetchAll(PDO::FETCH_ASSOC) as $val)
            $isIt = $val['use_email'];
        if ($isIt == 0 || $isIt == '0')
            echo 0;
        else
            echo 1;
    } else
        echo 0;
}
