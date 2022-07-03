<?php

$searchRoot = 'E:\OpenServer\domains\localhost';
$searchName = 'readme.txt';
$searchResult = [];

/**
 * Поиск файоа пр названию в стартовой папке и во всех ее подпапках
 * @param string $startDir - стартовая папка
 * @param string $nameFile - название искомого файла
 * @param array $searchResult - массив в который сохраняются все результаты поиска
 * @return void
 */
function findFile(string $startDir, string $nameFile, array &$searchResult)
{
    //удаление из результатов scandir системных папок
    $scanned_directory = array_diff(scandir($startDir), array('..', '.', '.git'));

    foreach ($scanned_directory as $value) {
        $newDirectory = $startDir . '\\' . $value;

        // проверка на наличие папок в "новой" директории
        // если найдена, повторный запуск функции
        if (is_dir($newDirectory)) {
           findFile($newDirectory, $nameFile, $searchResult);

            // проверка на наличие искомого файла в директории
            // если найден, записываем в массив
        } elseif ($value === $nameFile) {
            $searchResult[] = $startDir . '\\' . $nameFile;
        }
    }
}
findFile($searchRoot, $searchName, $searchResult);
var_dump($searchResult);