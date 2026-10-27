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

    // 3. Регистрируем (ВОТ ЗДЕСЬ БЫЛА ЛИШНЯЯ СКОБКА)
    $userData = registerNewUser($email, $pwd1, $name, $phone, $address);

    // 4. Отправляем ответ
    if ($userData['success']) {
        // Сохраняем данные пользователя в сессию (МАССИВОМ!)
        $_SESSION['user'] = [
            'id' => $userData['userId'],
            'email' => $email,
            'name' => $name ? $name : $email,
            'phone' => $phone,
            'address' => $address
        ];
        $userData['userName'] = $name ? $name : $email;
    }

    echo json_encode($userData);
} // <--- ЗДЕСЬ ПРАВИЛЬНОЕ ЗАКРЫТИЕ ФУНКЦИИ

/**
 * Выход пользователя
 */
function logoutAction() {
    unset($_SESSION['user']);
    unset($_SESSION['cart']);
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
    
    // Сохраняем в сессию МАССИВОМ (чтобы работал $user.name в шаблоне)
    $_SESSION['user'] = [
        'id' => $user['id'],
        'email' => $user['email'],
        'name' => $user['name'] ? $user['name'] : $user['email'],
        'phone' => $user['phone'],
        'address' => $user['address']
    ];
    
    echo json_encode([
        'success' => true,
        'userName' => $_SESSION['user']['name']
    ]);
}

/**
 * Страница пользователя (Личный кабинет)
 */
function indexAction($smarty) {
    // Если пользователь не залогинен - редирект на главную
    if(!isset($_SESSION['user'])) {
        redirect('/');
    }
    
    $rsCategories = getAllMainCatsWithChildren();
    
    // Берем данные пользователя из сессии (ИСПРАВЛЕНА ОПЕЧАТКА $_SESSION-['user'])
    $arUser = $_SESSION['user'];
    
    $smarty->assign('pageTitle', 'Страница пользователя');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('arUser', $arUser);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'user');
    loadTemplate($smarty, 'footer');
}

/**
 * AJAX Обновление данных пользователя
 */
function updateAction() {
    if(!isset($_SESSION['user'])) {
        echo json_encode(['success' => false, 'message' => 'Вы не авторизованы']);
        return;
    }

    $name    = isset($_POST['name']) ? trim($_POST['name']) : '';
    $phone   = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $pwd1    = isset($_POST['pwd1']) ? trim($_POST['pwd1']) : '';
    $pwd2    = isset($_POST['pwd2']) ? trim($_POST['pwd2']) : '';
    $curPwd  = isset($_POST['curPwd']) ? trim($_POST['curPwd']) : '';

    // Вызываем модель
    $res = updateUserData($name, $phone, $address, $pwd1, $pwd2, $curPwd);

    // Если успешно - обновляем сессию
    if($res['success']) {
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['phone'] = $phone;
        $_SESSION['user']['address'] = $address;
        $res['userName'] = $name ? $name : $_SESSION['user']['email'];
    }
    
    echo json_encode($res);
}