<?php

class Translator
{
    private $dictionary = ['en' => [], 'de' => [],];
    private $language;

    public function __construct($language)
    {
        $this->language = $language;
        //Английский
        $this->addWord('привет', 'hello', 'en');
        $this->addWord('лес', 'forest', 'en');
        //Немецкий
        $this->addWord('работа', 'arbeit', 'de');
        $this->addWord('лес', 'wald', 'de');

    }

    public function addWord(string $russianWord, string $translate, string $language): void
    {
        if (array_key_exists($russianWord, $this->dictionary[$language])) {
            return;
        }
        $this->dictionary[$language][$translate] = $russianWord;
    }

    public function translate(string $Word): string|false
    {
        if (array_key_exists($Word, $this->dictionary[$this->language])) {
            return $this->dictionary[$this->language][$Word] . PHP_EOL;
        }
        return false;
    }
}

$translationEn = new Translator('en');
$translationDe = new Translator('de');
var_dump($translationEn);

var_dump($translationEn->translate('forest'));
var_dump($translationDe);
