<?php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
//defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);


// Constants
// /Applications/XAMPP/xamppfiles
defined('SITE_ROOT') ? null : 
        define('SITE_ROOT', '/Applications/XAMPP/xamppfiles/htdocs/' . 'myPersonalProjects' . '/FatBoy');
//	define('SITE_ROOT', 'http://localhost/myPersonalProjects/FatBoy');

define("PRIVATE_PATH", SITE_ROOT . "/private");
define("PUBLIC_PATH", SITE_ROOT . "/public");
        
//defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . '/includes');





// 
session_start();





// Required Files
// load config file first
require_once(PRIVATE_PATH . '/includes/config.php');

require_once(PRIVATE_PATH . "/includes/functions_helper/functions_general.php");
require_once(PRIVATE_PATH . "/includes/functions_helper/functions_sqli_escape.php");
require_once(PRIVATE_PATH . "/includes/functions_helper/functions_validation.php");
require_once(PRIVATE_PATH . "/includes/functions_helper/functions_validation2.php");
require_once(PRIVATE_PATH . "/includes/functions_helper/functions_xss_sanitize.php");

require_once(PRIVATE_PATH . "/includes/functions_helper/functions_csrf_request_type.php");
require_once(PRIVATE_PATH . "/includes/functions_helper/functions_csrf_token.php");
// load basic functions next so that everything after can use them
//require_once(LIB_PATH.DS.'functions.php');




//
//require_once(PRIVATE_PATH . "/includes/js_functions.php");
require_once(PRIVATE_PATH . "/helper_classes/validation/Validator.php");




require_once(PUBLIC_PATH .'/__model/my_debug_messenger.php');
//MyDebugMessenger::initialize_debug_message();
require_once(PUBLIC_PATH .'/__model/my_validation_error_logger.php');
//// load core objects
//require_once(LIB_PATH.DS.'session.php');
require_once(PUBLIC_PATH .'/__model/my_database.php');
//require_once(LIB_PATH.DS.'database_object.php');

//// load database-related classes
require_once(PUBLIC_PATH .'/__model/my_user.php');
//require_once(LIB_PATH.DS.'photograph.php');



?>