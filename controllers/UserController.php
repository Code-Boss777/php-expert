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
    // 4. Отправляем ответ
if ($userData['success']) {
    $_SESSION['user'] = $userData['userId'];
    
    // Добавляем имя пользователя в ответ
    $userData['userName'] = $name;
}

echo json_encode($userData);
}
//выход пользователя 
function logoutAction() {
//удаляем сессию пользователя
unset($_SESSION['user']);
//очищаем корзину
unset($_SESSION['cart']);
//перенаправляем на главную
header('Location: /');
exit();
}
/**
 * Авторизация пользователя (AJAX)
 */
function loginAction() {
    global $db;
    
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $pwd = isset($_POST['pwd']) ? trim($_POST['pwd']) : '';
    
    if (empty($email) || empty($pwd)) {
        echo json_encode(['success' => false, 'message' => 'Введите email и пароль']);
        return;
    }
    
    // Ищем пользователя
    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Пользователь не найден']);
        return;
    }
    
    // Проверяем пароль
    if (!password_verify($pwd, $user['pwd'])) {
        echo json_encode(['success' => false, 'message' => 'Неверный пароль']);
        return;
    }
    
    // Сохраняем в сессию
    $_SESSION['user'] = $user['id'];
    
    echo json_encode([
        'success' => true,
        'userName' => $user['name'] ?: $user['email']
    ]);
}