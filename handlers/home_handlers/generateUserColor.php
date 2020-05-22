<?php
include "config.php";
include "../session_handlers/sessionStarter.php";

// if (isset($_POST['auto'])) {
$color = $user->generateUserColor(0);
if ($color->rowCount())
    return 1;
else
    return 0;
// }
