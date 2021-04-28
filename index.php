<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/services/MailService.php");


$mail = new MailService();
$subject = 'test';
$message = 'test';
$recipient = 'bellahtj@gmail.com';

$mail->sendMail($message, $subject, $recipient);