<?php
echo '1. Файл UserModel существует: ' . (file_exists('../models/UserModel.php') ? 'ДА' : 'НЕТ') . '<br>';
echo '2. Путь к файлу: ' . realpath('../models/UserModel.php') . '<br>';
echo '3. Размер файла: ' . filesize('../models/UserModel.php') . ' байт<br>';
echo '4. Кодировка (первые 3 байта): ' . bin2hex(file_get_contents('../models/UserModel.php', false, null, 0, 3)) . '<br>';

// Подключаем
include_once '../models/UserModel.php';

echo '5. checkRegisterParams: ' . (function_exists('checkRegisterParams') ? 'ДА' : 'НЕТ') . '<br>';
echo '6. checkUserEmail: ' . (function_exists('checkUserEmail') ? 'ДА' : 'НЕТ') . '<br>';
echo '7. registerNewUser: ' . (function_exists('registerNewUser') ? 'ДА' : 'НЕТ') . '<br>';