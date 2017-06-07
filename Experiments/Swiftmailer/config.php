<?php
/*
 * $loader needs to be a relative path to an autoloader script.
 * Swift Mailer's autoloader is swift_required.php in the lib directory.
 * If you used Composer to install Swift Mailer, use vendor/autoload.php.
 */
$loader = __DIR__ . '/../../private/external_api/swiftmailer/vendor/autoload.php';

require_once $loader;

/*
 * Login details for mail server
 */
$smtp_server = 'mail.noip.com';
$username = 'bren@fatninjar.sytes.net';
$password = 'mnBS8bo3BLGk';

/*
 * Email addresses for testing
 * The first two are associative arrays in the format
 * ['email_address' => 'name']. The rest contain just
 * an email address as a string.
 */
$from = ['bren@fatninjar.sytes.net' => 'FatBren'];
$to = ['brenallen1.1x10e11@gmail.com' => 'Bren Allen', 'odox700@gmail.com' => 'Odox'];
$test1 = [];
$testing = '';
$test2 = '';
$test3 = '';
$secret = '';
$private = '';
?>