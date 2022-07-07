<?php

interface StringWriter
{
    public function writeString($str);
}

class FileWriter implements StringWriter
{
    public function writeString($str)
    {
        file_put_contents('./example.txt', $str);
    }
}

class ScreenWriter implements StringWriter
{
    public function writeString($str)
    {
        echo $str;
    }
}

class StringProcessor
{
    private $writer;
    private $str;
    public function __construct(StringWriter $writer, $str)
    {
        $this->writer = $writer;
        $this->str = $str;
    }

    public function write()
    {
        $this->writer->writeString($this->str);
    }
}

$fileWriter = new FileWriter();
$screenWriter = new ScreenWriter();
$testString = 'Я строка из объекта StringProcessor';

$stringFileProcessor = new StringProcessor($fileWriter, $testString);
$stringScreenProcessor = new StringProcessor($screenWriter, $testString);

$stringFileProcessor->write();
$stringScreenProcessor->write();