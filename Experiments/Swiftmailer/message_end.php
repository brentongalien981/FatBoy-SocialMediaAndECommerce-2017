<?php
require_once 'config.php';

try {
    // prepare email message
    $message = Swift_Messag::newInstance()
        ->setSubject('Test of Swift Mailer')
//        ->setFrom(['no-reply@foundationphp.com' => 'Foundation PHP'])
        ->setFrom(['bren@fatninjar.sytes.net' => 'FatBren'])
//        ->setTo(['brenallen1.1x10e11@gmail.com' => 'Bren Allen'])
        ->addTo(['brenallen1.1x10e11@gmail.com' => 'Bren Allen'])
//        ->addTo('someone@example.com')
//        ->addTo('yet_someonelse@example.com', 'Someone else')
        ->setBody('This is a test of Swift Mailer');
    echo $message->toString();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>