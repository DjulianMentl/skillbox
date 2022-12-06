<?php

class HtmlProcessor
{
    // Переменная для сохранения текста без тегов <a>
    private string $storageFormattedText;

    /**
     * @return string
     */
    public function getStorageFormattedText(): string
    {
        return $this->storageFormattedText;
    }

    /**
     * Находит в тексте все ссылки <a>анкор</a> и возвращает текст с анкорами, без тегов <a>
     * @param string $text
     * @return void
     */
    public function formattedText(string $text)
    {
        $this->storageFormattedText = preg_replace('/\<a\s.*?\>(.*?)\<\/a\>/ius','$1', json_decode($text));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['raw_text'])) {

        header('Content-Type: application/json; charset=UTF-8');

        $textObject = new HtmlProcessor();
        $textObject->formattedText($_POST['raw_text']);

        if  (!is_null($textObject->getStorageFormattedText())) {
            echo $textObject->getStorageFormattedText();
        } else {
            http_response_code(500);
        }
}
