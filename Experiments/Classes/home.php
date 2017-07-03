<?php
//require_once 'ClassA.php';
require_once 'ClassB.php';
require_once 'SubclassA.php';



//$classesArray = array("ClassA", "ClassB", "ClassC");
$classesArray = array("SubclassA");
foreach ($classesArray as $class) {
    $classX = new $class;
//    $classX->showStaticSecret();
//    $classX->showFieldA();
    echo "VAR:\$classX::\$theArray:";
    echo "<pre>";
    var_dump($classX::$theArray);
    echo "</pre>";
}
?>