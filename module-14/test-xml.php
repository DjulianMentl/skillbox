<?php

$xmlFile = simplexml_load_file('sample.xml');

echo $xmlFile->book->count() . PHP_EOL;
echo $xmlFile->book[2]->author . PHP_EOL;
echo $xmlFile->book[2]->title . PHP_EOL;

$xmlFile->book[2]->author = 'Lev Tolstoy';
$xmlFile->book[2]->title = 'War and peace';
unset($xmlFile->book[11]);

file_put_contents('sample.xml', $xmlFile->asXML());