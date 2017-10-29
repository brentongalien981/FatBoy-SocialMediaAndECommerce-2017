<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-28
 * Time: 02:16
 */

namespace App\Publico\Controller\Invoices;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/Invoice.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\Invoice;


class InvoiceController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read($data)
    {
        return Invoice::read($data);
    }
}