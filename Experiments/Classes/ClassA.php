<?php
namespace Classes;

class ClassA {
    protected static $theArray = array("field0", "field1", "field2");
    public $secret = "ClassA Secret";
    public static $staticSecret = "ClassA Static Secret";
    private $fieldA = "ClassA fieldA";
    
    public function showStaticSecret() {
        echo "VAR self::\$staticSecret ==> " . self::$staticSecret . ".<br>";
    }
    
    public function greet() {
        echo "This is ClassA.<br>";
    }
    
    public function getFieldA() {
        return $this->fieldA;
    }
}
?>