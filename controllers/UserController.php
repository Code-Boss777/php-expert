<?php
// Контроллер пользователя

include_once '../models/UserModel.php';
include_once '../models/CategoriesModel.php';
include_once '../models/CartModels.php';

/**
 * Регистрация нового пользователя (AJAX)
 */
function registerAction() {
    global $db;
    
    // 1. Получаем данные
    $email = isset($_REQUEST['email']) ? trim($_REQUEST['email']) : '';
    $pwd1 = isset($_REQUEST['pwd1']) ? trim($_REQUEST['pwd1']) : '';
    $pwd2 = isset($_REQUEST['pwd2']) ? trim($_REQUEST['pwd2']) : '';
    $name = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : '';
    $phone = isset($_REQUEST['phone']) ? trim($_REQUEST['phone']) : '';
    $address = isset($_REQUEST['address']) ? trim($_REQUEST['address']) : '';
    
    // 2. Проверяем параметры
    $checkResult = checkRegisterParams($email, $pwd1, $pwd2);
    
    if (!$checkResult['success']) {
        echo json_encode($checkResult);
        return;
    }
    
    // 3. Регистрируем
    $userData = registerNewUser($email, $pwd1, $name, $phone, $address);
    
    // 4. Отправляем ответ
    if ($userData['success']) {
        $_SESSION['user'] = $userData['userId'];
    }
    
    echo json_encode($userData);
}