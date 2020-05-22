<?php
include "config.php";
include "../session_handlers/sessionStarter.php";

if ($_POST['f_name']) {
    $f_name = filter_input(INPUT_POST, 'f_name', FILTER_SANITIZE_STRING);
    $phoneNumber = $_POST['phoneNumber'];
    $countryName =  $_POST['countryName'];
    $countryIso =  $_POST['countryIso'];
    $dialCode = (int) $_POST['dialCode'];
    $niveau = filter_input(INPUT_POST, 'niveau', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $result = $user->addUser($f_name, $phoneNumber, $countryName, $countryIso, $dialCode, $niveau, $email);
    if ($result->rowCount()) {
        $_SESSION['username'] = $f_name;
        echo 1;
    } else
        echo 0;
}
