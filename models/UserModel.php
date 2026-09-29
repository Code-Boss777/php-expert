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