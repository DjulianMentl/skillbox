<?php
//
//class MethodTest
//{
//    static function say_hello()
//    {
//        echo "Привет!\n";
//    }
//
//    public function __call($name, $arguments)
//    {
//        // Замечание: значение $name регистрозависимо.
//        echo "Вызов метода '$name' "
//            . implode(', ', $arguments) . "\n";
//    }
//
//}
//
////$classname = 'MethodTest';
////$obj = new MethodTest();
////var_dump($obj);
////$obj->runTest('в контексте объекта');
//
//abstract class Test
//{
//    public $geka = [];
//}


function test_global_ref()
{
    global $obj;
    $new = new stdclass;
    $obj = &$new;
    var_dump($obj);
}

test_global_ref();
var_dump($obj);

function test_global_noref() {
    global $obj;
    $new = new stdclass;
    $obj = $new;
}

test_global_noref();
var_dump($obj);