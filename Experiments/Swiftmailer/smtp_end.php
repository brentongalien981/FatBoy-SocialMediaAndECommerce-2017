<?php
require_once 'config.php';

$from = 'bren@fatninjar.sytes.net';
$to = 'brenallen1.1x10e11@gmail.com';

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Swift Mailer SMTP Test')
        ->setFrom($from)
        ->setTo($test1)
        ->setBody('This message was sent using the Swift Mailer SMTP transport');

    // create the transport
    $transport = Swift_SmtpTransport::newInstance($smtp_server, 587)
        ->setUsername($username)
        ->setPassword($password);
    $mailer = Swift_Mailer::newInstance($transport);
    $result = $mailer->send($message);
    if ($result) {
        echo "Number of emails sent: $result";
    } else {
        echo "Couldn't send email";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}