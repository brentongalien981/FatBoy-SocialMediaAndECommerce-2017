<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_paypal_account.php"); ?>

<?php // require_once(PUBLIC_PATH . "/__controller/controller_cart_item.php");  ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>










<?php

// TODO: SECTION: Protected page checking.
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() ||
        !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>










<?php

// TODO: SECTION: Functions.
?>











<?php

// TODO: SECTION: For app debug messenger initialization.
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>










<?php

// TODO: SECTION: Meat.

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

//require __DIR__ . "/PayPal-PHP-SDK/autoload.php";
require PRIVATE_PATH . "/external_api/PayPal-PHP-SDK/autoload.php";





// Vars
$business_account_type_code = 2;


$query = "SELECT * FROM UserPayPalAccount ";
$query .= "WHERE user_id = {$session->seller_user_id} ";
$query .= "AND account_type = {$business_account_type_code} LIMIT 1";


$paypal_merchant_obj = UserPayPalAccount::read_by_query_and_instantiate($query)[0];


// Validate the seller paypal account.
if (isset($paypal_merchant_obj->paypal_client_id) && isset($paypal_merchant_obj->paypal_secret_id)) {
    // TODO: LOG
    MyDebugMessenger::add_debug_message("PayPal merchant account is set.");
} else {
    // TODO: LOG
    echo "<br>PayPal merchant account is not set.<br>";
    MyDebugMessenger::add_debug_message("PayPal merchant account is not set.");
}


// API
$api = new ApiContext(
        new OAuthTokenCredential($paypal_merchant_obj->paypal_client_id, $paypal_merchant_obj->paypal_secret_id)
);






// TODO: REMINDER: Change the mode on production.
$api->setConfig([
    'mode' => 'sandbox',
    'http.ConnectionTimeout' => 30,
    'log.LogEnabled' => false,
    'log.FileName' => '',
    'log.LogLevel' => 'FINE',
    'validation.level' => 'log'
]);

// TODO: LOG
MyDebugMessenger::add_debug_message("SUCCESS creating PayPal ApiContext.");
?>