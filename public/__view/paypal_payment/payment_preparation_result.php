<h4>FILE: __view/paypal_payment/payment_preparation_result.php</h4>

<?php
if (isset($_GET["paypal_payment_preparation_result_msg"])) {
    echo $_GET["paypal_payment_preparation_result_msg"];
}

if (isset($_GET["paypal_invoice_id"])) {
    echo $_GET["paypal_invoice_id"];
}
?>
