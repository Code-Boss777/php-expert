
<?php
include_once '../config/config.php';
include_once '../config/db.php'; 
include_once '../library/mainFunction.php';
//http://localhost:8080/?controller=index&action=test  вводим параметр контроллера в браузере
//определяем какой контроллер будет работать
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';
//определяем с какой функцией будем работать
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';
// //проверяем функцию
// echo 'функция формирующая страницу (экшн) = ' . $actionName . '<br/>';
//подключаем контролле, который ранее прописали в браузере
// include_once '../controllers/' . $controllerName . 'Controller.php';
// //добавляем переменную функции 
// $function = $actionName . 'Action'; 
// //выводим название на экран
// echo 'Полное название вызываемой функции = ' . $function . '<br/>';
// $function(); - Комментим т.к. прописали ее ниже.
//создаем функцию, которая будет выполнять загрузку страницы.Определим константсы префикса и пути к контроллеру 
//константы для обращения к контроллеру
// define('PathPrefix', '../controllers/');
// define('PathPostfix', 'controller.php'); Перенесены в config.php
//создаем функцию
// function loadPage($controllerName, $actionName = 'Index'){
//     include_once PathPrefix . $controllerName . PathPostfix;
//     $function = $actionName . 'Action';
//     $function(); перенесен mainFunction
// }
loadPage($smarty, $controllerName, $actionName) . '<br/>';

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
$i=1; 
do {
    echo $i . '<br/>';
    $i++;
} while ($i<=10);
