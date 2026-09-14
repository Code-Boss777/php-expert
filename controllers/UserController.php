<?php

//Контроллер Пользователя

include_once '../models/UserModel.php';
include_once '../models/CategoriesModel.php';
include_once '../models/CartModels.php';

//регистрация пользователя

function registerAction() {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $pwd1 = isset($_POST['pwd1']) ? trim($_PSOT['pwd1']) : '';
    $pwd2 = isset($_POST['pwd2']) ? trim($_POST['pwd2']) : '';

    //Проверки
    if(empty($email) || empty(pwd1) || empty($pwd2)) {
        echo json_encode(['success' => false, 'message' => 'Заполните все поля']);
        return;
    }
    if ($pwd1 !== $pwd2) {
        echo json_encode(['success' => false, 'message' => 'Пароли не совпадают']);
        return;
    }
    //регистрируем
    $userId = registerNewUser($email, $pwd1, '', '', '');

    if($userId) {
        echo json_encode(['success' => true, 'userId' => $userId]);
    } else {
        echo json_encode(['success => false', 'message' => 'Ошибка регистрации']);
    }
}