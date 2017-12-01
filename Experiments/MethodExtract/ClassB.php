<?php

namespace MethodExtract;

require_once("ClassA.php");

use MethodExtract\ClassA;

class ClassB extends ClassA
{



    /**
     * ClassB constructor.
     */
    public function __construct()
    {
        self::$db_fields = array(
            "id",
            "title",
            "message"
        );

        self::$table_name = "tilapia";

        parent::__construct();



        //
        echo "Calling method getAttributes().";
        var_dump($this->get_attributes());

    }

}


$obj = new ClassB();
$obj->id = 69;
$obj->title = "Putang title";
$obj->message = "Putang message yan oh";
var_dump($obj);
echo $obj->create();
//$obj->id = 1;
//$obj->
//$obj->title = "The fucking title";
//$obj->message = "I  just don't give a fook about maunee!";

//var_dump($obj);
//$obj->showParentProperties();
//$obj->showChildProperties();
//$obj->showAttributesExistence();
//$obj->showChildAttributesExistence();
//$obj->showParentAttributesExistence();
//echo "<pre>";
//print_r($obj);
//echo "</pre>";
//
//$obj->showAttributesExistence();
?>