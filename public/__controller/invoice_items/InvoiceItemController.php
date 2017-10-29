<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-28
 * Time: 16:28
 */

namespace App\Publico\Controller\InvoiceItems;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/InvoiceItem.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\InvoiceItem;


class InvoiceItemController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read($data)
    {
        return InvoiceItem::read($data);
    }
}