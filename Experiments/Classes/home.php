<?php
require_once 'ClassA.php';
require_once 'ClassB.php';

//use ClassA;

$classX = new ClassA();
$classX->greet();
$classX = new ClassB();
$classX->greet();

$classesArray = array("ClassA", "ClassB", "ClassC");
foreach ($classesArray as $class) {
    $classX = new $class;
    $classX->greet();
}
?>