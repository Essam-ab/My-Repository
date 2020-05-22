<?php
if (!isset($_SESSION['username']))
    header("location ../index.html");
include "./classes/db.php";
include "./classes/stand.php";
$stand = new Stand();
include "./classes/videotheque.php";
$videotheque = new Videotheque();
include "./classes/user.php";
$user = new User();
include "./classes/region.php";
$region = new Region();
