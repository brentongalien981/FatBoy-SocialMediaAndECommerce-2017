<?php

require_once 'config.php';

// Create the message
try {
    // prepare email message

    $message = (new Swift_Message())

            // Give the message a subject
            ->setSubject('Your subject')

            // Set the From address with an associative array
            ->setFrom(['bren@fatninjar.sytes.net' => 'FatBren'])

            // Set the To addresses with an associative array (setTo/setCc/setBcc)
            ->setTo(['brenallen1.1x10e11@gmail.com' => 'Bren Allen'])

            // Give it a body
            ->setBody('Here is the message itself')

//            // And optionally an alternative body
//            ->addPart('<q>Here is the message itself</q>', 'text/html')

//        // Optionally add any attachments
//        ->attach(Swift_Attachment::fromPath('my-document.pdf'))
    ;
    
    echo $message->toString();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>