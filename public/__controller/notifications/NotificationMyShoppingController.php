<?php

/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-17
 * Time: 23:16
 */

namespace App\Publico\Controller\Notifications;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/NotificationMyShopping.php");


use App\Publico\Controller\MainController;
use NotificationMyShopping;


class NotificationMyShoppingController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function create($data)
    {
        $is_creation_ok = null;

        if (!NotificationMyShopping::does_status_for_invoice_item_exist($data)) {
            // OK Status can be updated.;
            // Then create a new status record.

            // This is a method originally from file "controller_invoice.php".
            $is_creation_ok = NotificationMyShopping::create_invoice_item_status_record($data);
        }


        //
        if ($is_creation_ok) {
            // Create a record in table Notification and NotificationMyShopping.
            // But first, figure out the values for the the attributes
            // of the new obj of type NotificationMyShopping.


            //
            $invoice_id = NotificationMyShopping::get_invoice_id_for_invoice_item($data['invoice_item_id']);

            // Set the $a_sales_notification_obj's attributes by
            // querying the table Invoice with the invoice_id.
            // Remember that these values are equivalent:
            // notified_user_id/buyer,
            // notifier_user_id/seller/actual_user, and
            // invoice_id.
            $data['invoice_id'] = $invoice_id;
            NotificationMyShopping::set_invoice_attribs($data);


            // Now, $data contains all the necessary info.
            // Create a NotificationMyShopping obj.
            $n_mshopping = new NotificationMyShopping();
            $n_mshopping->id = null;
            $n_mshopping->notified_user_id = $data["notified_user_id"];
            $n_mshopping->notifier_user_id = $data["notifier_user_id"];
            $n_mshopping->notification_msg_id = $data["notification_msg_id"];
            $n_mshopping->is_deleted = false;
            $n_mshopping->invoice_item_id = $data["invoice_item_id"];
            $n_mshopping->invoice_item_status_record_id = $data["invoice_item_status_record_id"];
            $is_creation_ok = $n_mshopping->create_with_bool();

        }


        //
        return $is_creation_ok;
    }



    public function read($data)
    {
        return NotificationMyShopping::read_by_section($data['section']);
    }
}