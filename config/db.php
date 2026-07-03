<?php
//инициализация подключения к db
$dblocation = "127.0.0.1";
$dbname = "myshop";
$dbuser = "root";
$dbpassword = "";

try {
    // Создаем подключение через PDO
    $db = new PDO("mysql:host={$dblocation};dbname={$dbname};charset=utf8", $dbuser, $dbpassword);
    
    // Включаем режим вывода ошибок, чтобы сразу видеть косяки в SQL-запросах
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Если подключиться не удалось, выводим понятную ошибку и останавливаем сайт
    echo "Ошибка подключения к БД: " . $e->getMessage();
    exit();
}