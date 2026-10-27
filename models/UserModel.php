<?php
// Модель для работы с пользователями

/**
 * Проверка параметров регистрации
 */
function checkRegisterParams($email, $pwd1, $pwd2) {
    $res = ['success' => true];
    
    if (empty($email)) {
        $res['success'] = false;
        $res['message'] = 'Введите email';
    } elseif (empty($pwd1)) {
        $res['success'] = false;
        $res['message'] = 'Введите пароль';
    } elseif (empty($pwd2)) {
        $res['success'] = false;
        $res['message'] = 'Введите повтор пароля';
    } elseif ($pwd1 !== $pwd2) {
        $res['success'] = false;
        $res['message'] = 'Пароли не совпадают';
    }
    
    return $res;
}

/**
 * Проверка, есть ли email в БД
 */
function checkUserEmail($email, $db) {
    $sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->execute(['email' => $email]);
    return $stmt->fetch();
}

/**
 * Регистрация нового пользователя
 */
function registerNewUser($email, $pwd, $name, $phone, $address) {
    global $db;
    
    $res = ['success' => false];
    
    if (checkUserEmail($email, $db)) {
        $res['message'] = 'Email уже занят';
        return $res;
    }
    
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (email, pwd, name, phone, address) 
            VALUES (:email, :pwd, :name, :phone, :address)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'email' => $email,
        'pwd' => $hashedPwd,
        'name' => $name,
        'phone' => $phone,
        'address' => $address
    ]);
    
    $userId = $db->lastInsertId();
    
    if ($userId) {
        $res['success'] = true;
        $res['userId'] = $userId;
    } else {
        $res['message'] = 'Ошибка создания пользователя';
    }
    
    return $res;
}
/**
 * Обновление данных пользователя (Заготовка)
 * 
 * @param string $name Имя
 * @param string $phone Телефон
 * @param string $address Адрес
 * @param string $pwd1 Новый пароль
 * @param string $pwd2 Повтор нового пароля
 * @param string $curPwd Текущий пароль (для подтверждения)
 * @return array
 */
function updateUserData($name, $phone, $address, $pwd1, $pwd2, $curPwd) {
    global $db;

    $res= ['success' => false];
    $email = $_SESSION['user']['email'];

//получаем текущего пользователя из БД
$stmt = $db->prepare("SELECT * FROM user WHERE email = :email");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user) {
    $res['messege'] = 'Пользователь не найден';
    return $res;
}
// Готовим базовый запрос на обновление
$sql = "UPDATE users SET name = :name, phone = :phone, address = :address";
$params = [
     'name' => $name,
        'phone' => $phone,
        'address' => $address,
        'email' => $emai
];

 // 4. Если введен новый пароль — проверяем и добавляем в запрос
    if (!empty($pwd1)) {
        if ($pwd1 !== $pwd2) {
            $res['message'] = 'Новые пароли не совпадают';
            return $res;
        }
        $sql .= ", pwd = :pwd";
        $params['pwd'] = password_hash($pwd1, PASSWORD_DEFAULT);
    }

    $sql .= " WHERE email = :email";
    
    // 5. Выполняем
    $updateStmt = $db->prepare($sql);
    $updateStmt->execute($params);

    $res['success'] = true;
    $res['message'] = 'Данные сохранены';
    return $res;
}