<?php

require_once 'ClassA.php';

//use Classes\ClassA;

class SubclassA extends Classes\ClassA {

    public static $staticSecret = "SubclassA Static Secret";
    public $fieldA = "SubclassA fieldA";
    public static $theArray = array("field3", "field-69");

    public function __construct() {
//        self::$theArray = parent::$theArray;
//        array_push(self::$theArray, "field3");
        self::$theArray = array_merge(parent::$theArray, self::$theArray);
    }

    public function greet() {
        parent::greet();
        echo "This is SubclassA.<br>";
        echo "\$this->secret ==> " . $this->secret . ".<br>";
        echo "parent::\$staticSecret ==> " . parent::$staticSecret . ".<br>";
        echo "self::\$staticSecret ==> " . self::$staticSecret . ".<br>";
    }

    public function showStaticSecret() {
//        echo "VAR self::\$staticSecret ==> " . self::$staticSecret . ".<br>";
        parent::showStaticSecret();
    }

    public function showFieldA() {
//        echo "VAR:fieldA: " . parent->fieldA . ".<br>";
    }

    public function getFieldA() {
        return $this->fieldA;
    }

    public function getParentFieldA() {
        return parent::getFieldA();
    }

}

?>