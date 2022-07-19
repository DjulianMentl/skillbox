<?php

include_once './module1.php';
include_once './module2.php';

use LibraryTwo\TestToolkit as LibTwo;

$testObjectTwo = new LibTwo\TestClass();
$testObjectOne = new LibraryOne\TestClass();
$testObjectTwo->libraryName();
$testObjectOne->libraryName();
