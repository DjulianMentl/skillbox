<?php

class Ticker
{
    private $string;

    /**
     * @param mixed $string
     */
    public function setString($string): void
    {
        if (stripos($string, '<script>') !== false) {
            echo 'Строка содержит инъекцию кода!' . PHP_EOL;
            return;
        }
        $this->string = $string;
    }

    /**
     * @return mixed
     */
    public function getString(): ?string
    {
        return strtoupper($this->string);
    }

    public function __set($name, $value)
    {
        if ($name == 'string') {
            $this->setString($value);
        }
    }

    public function __get($name)
    {
        if ($name == 'string') {
            return $this->getString();
        }
    }
}

$ticker = new Ticker();

$ticker->string = "sfsg";
echo $ticker->string;