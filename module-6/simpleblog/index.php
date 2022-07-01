<?php

//массив для хранения заголовков и текстов
$textStorage = [
    [
      'title' => '',
      'text' => '',
    ],
];

$indexNotes = count($textStorage) - 1;

/**
 * Добавляет текст и заголовок в массив $textStorage
 * @param string $title
 * @param string $text
 * @return void
 */
function add(string $title, string $text) : void
{
    global $textStorage, $indexNotes;
    $textStorage[$indexNotes]['title'] = $title;
    $textStorage[$indexNotes]['text'] = $text;
    $indexNotes++;
}

/**
 * удаляет элементы из массива $textStorage
 * @param int $index - указатель на элемент массива
 * @param array $textStorage - массив с текстами
 * @return bool - если элемент массива найден, возврат true, иначе false
 */
function remove(int $index, array &$textStorage) : bool
{
    if (isset($textStorage[$index])) {
        unset($textStorage[$index]);
        $textStorage = array_values($textStorage);
        return true;
    }
    return false;
}

function edit(int $index, string $title, string $text, &$textStorage) : bool
{
    if (isset($textStorage[$index])) {
        $textStorage[$index]['title'] = $title;
        $textStorage[$index]['text'] = $text;
        return true;
    }
    return false;
}

add('Идущий добьется', 'В жизни всякое бывает, но идущий все преодолеет и придет к своей цели');
add('Жизнь без соплей', 'Тяжело, легко, виноват, не виноват - подобные размышления удел неудачников и слабоков. Всему происходящему есть причины. Прими то, что есть, поставь цель и двигайся к ней. Не важно где-ты сейчас, важно где ты будешь через 5-10-20 лет. Хозяин ты. Не требуй, принимай и действуй. Все получится.');
print_r($textStorage);

var_dump(remove(0, $textStorage));
var_dump(remove(5, $textStorage));
print_r($textStorage);

edit(0, 'Обновленный заголовок', 'В жизни всякое бывает, но идущий все преодолеет и придет к своей цели', $textStorage);
print_r($textStorage);

var_dump(edit(5, 'sdfsfg', 'safsf', $textStorage));
