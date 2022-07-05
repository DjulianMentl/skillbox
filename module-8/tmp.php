<?php

class Test
{
    public $str;
    public function __construct($str)
    {
        $this->str = $str;
    }

    /**
     * @return mixed
     */
    public function showStr()
    {
        echo $this->str;
    }

    public function showStr1($str)
    {
        echo $str;
    }
}

$test = new Test('Привет');
$test->showStr();
$test->showStr1('sdfsfd');
