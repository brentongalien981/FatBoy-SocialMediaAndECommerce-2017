<?php
namespace Classes;

class ClassA {
    public $var1 = "value1";
    
    public function echoFirstVar() {
        echo "FROM:ClassA: ClassA \$var1: {$this->var1}<br>";
    }
}
?>