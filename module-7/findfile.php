<?php

$searchRoot = 'E:\OpenServer\domains\localhost\skillbox\module-7\test_search';
$searchName = 'test.txt';
$searchResult = [];

/**
 * Поиск файла по названию в стартовой папке и во всех ее подпапках
 * @param string $startDir - стартовая папка
 * @param string $nameFile - название искомого файла
 * @param array $searchResult - массив в который сохраняются все результаты поиска
 * @return void
 */
function findFile(string $startDir, string $nameFile, array &$searchResult): void
{
    //удаляем из результатов scandir системные папки и
    //обходим итеративно все элементы массива содержащего строки с названием фалов и папок
    foreach (array_diff(scandir($startDir), array('..', '.', '.git')) as $value) {
        // проверка на наличие папок в директории
        // если найдена, повторный запуск функции
        if (is_dir($startDir . '\\' . $value)) {
           findFile($startDir . '\\' . $value, $nameFile, $searchResult);
            // проверка на наличие искомого файла в директории
            // если искомый файл найден, записываем в массив
        } elseif ($value === $nameFile) {
            $searchResult[] = $startDir . '\\' . $nameFile;
        }
    }
}
findFile($searchRoot, $searchName, $searchResult);
//удаляем из массива пустые файлы
$searchResult = array_filter($searchResult, 'filesize');
//выводим на экран результат
$searchResult ? print_r($searchResult) :
                print_r("В директории $searchRoot и во всех ее подпапках нет непустых файлов $searchName");
