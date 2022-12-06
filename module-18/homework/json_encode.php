<?php


class Text
{
    // Переменная для сохранения текста без тегов <a>
    private $formattedText;

    /**
     * Находит в тексте все ссылки <a>анкор</a> и возвращает текст с анкорами, без тегов <a>
     * @param string $text
     * @return string
     */
    public function formattedText(string $text): string
    {

//        $text = json_decode($text, true, 2147483647);


//            $textNoTegA = preg_replace("/<a.*>(.*)<\/a>/",'$1', $link);
            $textNoTegA = preg_replace('/\<a\s.*?\>(.*?)\<\/a\>/ius','$1', $text);


//        $this->formattedText = json_encode($textNoTegA);
        return  $textNoTegA;
    }
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST' :
        $textObject = new Text();
        header('Content-Type: application/json; charset=UTF-8');
        if (isset($_POST['raw_text'])) {
            $urlContent = json_decode($_POST['raw_text']);
            echo $textObject->formattedText($urlContent);
        } else {
            http_response_code(500);
        }
        break;
}


//function getContent(string $url): false|string
//{
//    $ch = curl_init($url);
//    curl_setopt($ch, CURLOPT_HTTPGET, true);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $urlContent = curl_exec($ch);
//    curl_close($ch);
//
//    return json_encode($urlContent);
//}
//
//$json[] = getContent('http://localhost/skillbox/module-18/homework/test1.html');

// A valid json string
//$json[] = '{"Organization": "PHP Documentation Team"}';

// An invalid json string which will cause an syntax
// error, in this case we used ' instead of " for quotation
//$json[] = "{'Organization': 'PHP Documentation Team'}";

//foreach ($json as $string) {
//    echo 'Decoding: ' . $string;
//    echo PHP_EOL;
//
//    json_decode($string);
//    switch (json_last_error()) {
//        case JSON_ERROR_NONE:
//            echo ' - No errors';
//            break;
//        case JSON_ERROR_DEPTH:
//            echo ' - Maximum stack depth exceeded';
//            break;
//        case JSON_ERROR_STATE_MISMATCH:
//            echo ' - Underflow or the modes mismatch';
//            break;
//        case JSON_ERROR_CTRL_CHAR:
//            echo ' - Unexpected control character found';
//            break;
//        case JSON_ERROR_SYNTAX:
//            echo ' - Syntax error, malformed JSON';
//            break;
//        case JSON_ERROR_UTF8:
//            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
//            break;
//        default:
//            echo ' - Unknown error';
//            break;
//    }
//    echo PHP_EOL;
//}

//$url = 'http://localhost/skillbox/module-18/homework/HtmlProcessor.php';
//
//// Настройка запроса для отправки json через POST
//$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, "raw_text=$json[0]");
//
//$response = curl_exec($ch);
//curl_close($ch);

//var_dump($response);

//$response ? print_r($response) : http_response_code(500);
