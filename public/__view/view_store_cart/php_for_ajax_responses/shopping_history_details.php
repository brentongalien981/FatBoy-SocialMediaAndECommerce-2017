<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice.php");      ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice_item.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_shipping.php"); ?>











<?php

// TODO: SECTION: Function.
function init_array_of_invoice_items() {
    //
    $array_of_invoice_items = array();

    //
    $query = "SELECT * FROM InvoiceItem ";
    $query .= "WHERE invoice_id = '{$_GET['invoice_id']}'";

    $record_results = InvoiceItem::read_by_query($query);

    global $database;

    $default_str_datetime = "2001-01-01 01:01:01";

    while ($row = $database->fetch_array($record_results)) {
        $array_of_invoice_items[$row['id']] = array("status_start_date" => "2001-01-01 01:01:01");
    }

    return $array_of_invoice_items;

//    return $database->get_num_rows_of_result_set($record_results);
}

function set_latest_status_date_for_invoice_items($array_of_invoice_items) {
    // Copy.
    $updated_array_of_invoice_items = $array_of_invoice_items;
    
    
    //
    foreach ($array_of_invoice_items as $key_of_invoice_item => $value) {
        //
        $query = "SELECT * FROM InvoiceItemStatusRecord ";
        $query .= "WHERE invoice_item_id = {$key_of_invoice_item}";

        $record_results = InvoiceItem::read_by_query($query);

        global $database;
        while ($row = $database->fetch_array($record_results)) {
            if ($row['status_start_date'] >= $value['status_start_date']) {
                // Set a current latest date.
                $updated_array_of_invoice_items[$key_of_invoice_item]['status_start_date'] = $row['status_start_date'];
            }
        }
    }
    
    
    // 
//    $array_of_invoice_items = $updated_array_of_invoice_items;
    return $updated_array_of_invoice_items;
}

function show_invoice_items_table_details() {
    //
    $array_of_invoice_items_old = init_array_of_invoice_items();


    //
    $array_of_invoice_items = set_latest_status_date_for_invoice_items($array_of_invoice_items_old);






    //
    $query = "SELECT II.id,  II.invoice_id, II.price_per_item, II.quantity, ";
    $query .= "MSI.name, ";
    $query .= "IISR.invoice_item_status_id, IISR.status_start_date ";
    $query .= "FROM InvoiceItem II ";
    $query .= "INNER JOIN MyStoreItems MSI ON II.store_item_id = MSI.id ";
    $query .= "INNER JOIN InvoiceItemStatusRecord IISR ON II.id = IISR.invoice_item_id ";
    $query .= "WHERE invoice_id = '{$_GET['invoice_id']}'";

    $record_results = InvoiceItem::read_by_query($query);

    global $database;
    while ($row = $database->fetch_array($record_results)) {
        echo "<tr>";

        echo "<td>";
        echo "{$row['id']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['invoice_id']}";
        echo "</td>";

//        echo "<td>";
//        echo "{$row['store_item_id']}";
//        echo "</td>";

        echo "<td>";
        echo "{$row['name']}";
        echo "</td>";

        echo "<td>";
        echo "\${$row['price_per_item']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['quantity']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['invoice_item_status_id']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['status_start_date']}";
        echo "</td>";

        echo "</tr>";
    }


    // TODO: DEBUG
    echo "<tr>";
    echo "<td colspan='7'>";
    echo "DEBUG: array_of_invoice_items:<br>";
//    echo "<pre>";
    foreach ($array_of_invoice_items as $key => $value) {
        echo "{$key}: {$value['status_start_date']}<br>";
    }
//    print_r($array_of_invoice_items);
//    echo "</pre>";
    echo "</td>";
    echo "</tr>";
}

function show_invoice_items_table_header() {
    echo "<table class='invoice_items_details'>";
    echo "<thead>";
    echo "<td>";
    echo "Id";
    echo "</td>";

    echo "<td>";
    echo "InvoiceId";
    echo "</td>";

//    echo "<td>";
//    echo "StoreItemId";
//    echo "</td>";

    echo "<td>";
    echo "ItemName";
    echo "</td>";

    echo "<td>";
    echo "PricePerItem";
    echo "</td>";

    echo "<td>";
    echo "Quantity";
    echo "</td>";

    echo "<td>";
    echo "StatusId";
    echo "</td>";

    echo "<td>";
    echo "StatusStartDate";
    echo "</td>";

    echo "</thead>";
}

function show_invoice_items() {
    show_invoice_items_table_header();

    show_invoice_items_table_details();

    echo "</table>";
}
?>




<?php

// TODO: SECTION: Meat.
if (!isset($_GET["invoice_id"])) {
//    echo "<div>FUCKING it's not set!!!</div>";
    echo "FUCKING it's not set!!!";
} else {
    show_invoice_items();
//    echo "tae tae tae tae tae";
}
?>

