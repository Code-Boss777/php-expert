<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// 1. ПОДКЛЮЧАЕМ КОНФИГИ (поднимаемся на уровень выше)
include_once '../config/config.php';  // Было 'config/config.php'
include_once '../config/db.php';      // Было 'config/db.php'
include_once '../library/mainFunction.php'; // Было 'library/mainFunction.php'

// 2. ОПРЕДЕЛЯЕМ КОНТРОЛЛЕР И ЭКШН
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// 3. ЗАГРУЖАЕМ СТРАНИЦУ
loadPage($smarty, $controllerName, $actionName);

    //цикл Foreach 
    // $numbers = 1, 10);range(
    // foreach($numbers as $number) {
    //     echo $number . '<br/>';
    // }
    //цикл while
    // $i = 1;
    // while($i<=10) {
    //     echo $i . '<br/>';
    //     $i++;
    // }

    //цикла Do while
    // $i=1; 
    // do {
    //     echo $i . '<br/>';
    //     $i++;
    // } while ($i<=10);
