<?php
if (!isset($_SESSION['username']))
    header("location ../index.html");
include "../classes/db.php";
include "../classes/user.php";
$user = new User();
