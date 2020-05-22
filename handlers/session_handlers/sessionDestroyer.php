<?php
session_start();
$log = $user->userLoggedOut($_SESSION['username']);
if (!$log->rowCount())
    echo "an error occured while trying to log you out!";
session_unset();
session_destroy();
