<?php
include "config.php";

$to = $_POST['mail_to'];
$subject = 'Confirmation d’inscription JPO Virtuelle info@edufrance.tn / 18 Avril';
$message = $_POST['message'];
$headers = "From: " . $_POST['mail_from'];
$headers .= "mailed-by: " . $_POST['mail_from'] . "\r\n";
$headers .= "reply-to: replyto@gmail.com" . "\r\n";
$headers .= "Content-type: text/html\r\n";

mail($to, $subject, $message, $headers);
