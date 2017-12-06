<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-05
 * Time: 01:20
 */

namespace App\Publico\Model;

require_once(PUBLIC_PATH . "/__model/MainModel.php");

use App\Publico\Model\MainModel;


class Profile extends MainModel
{
    /** @override */
    protected static function init() {
        self::$db_fields = array(
            "user_id",
            "description",
            "pic_url"
        );

        self::$table_name = "Profile";
    }

    public function __construct()
    {
        self::init();

        parent::__construct();
    }

    public function read($data)
    {

        global $session;
        $limit = 1;

        //
        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE user_id = {$session->currently_viewed_user_id}";
        $q .= " LIMIT {$limit}";

        //
        $result_set = self::read_by_query($q);


        global $database;
        $array_of_objs = array();

        while ($row = $database->fetch_array($result_set)) {
            $an_obj = self::instantiate($row);

            //
            array_push($array_of_objs, $an_obj);
        }

        return $array_of_objs;
    }

}