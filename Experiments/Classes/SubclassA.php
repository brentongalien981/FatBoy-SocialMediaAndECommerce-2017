<?php

require_once 'ClassA.php';

//use Classes\ClassA;

class SubclassA extends Classes\ClassA {

    public $subVar1 = "subValue1";

    public function __construct() {
//        self::$theArray = parent::$theArray;
//        array_push(self::$theArray, "field3");
//        self::$theArray = array_merge(parent::$theArray, self::$theArray);
    }
    
    public function echoFirstVar() {
        parent::echoFirstVar();
        echo "FROM:SubclassA: ClassA \$var1: {$this->var1}<br>";
        echo "FROM:SubclassA: SubclassA \$subVar1: {$this->subVar1}<br>";
        
        echo "*********************<br>";
        echo "After manipulation...<br>";
        $this->var1 = "UNIQUE value1";
        
        parent::echoFirstVar();
        echo "FROM:SubclassA: ClassA \$var1: {$this->var1}<br>";
        echo "FROM:SubclassA: SubclassA \$subVar1: {$this->subVar1}<br>";        
    }    

}

?>