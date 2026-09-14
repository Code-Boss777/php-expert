<?php
//модель работы с пользователями.

//регистрация нового пользователя.
function ergisterNewUser($email, $pwd, $name, $phone, $address) {
    global $db;
    $sql= "INSERT INTO users (email, pwd, name, phone, address)
    VALUES (:email, ;pwd, :name, :phone, ;address)";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        'email' => $email,
        'pwd' => $pwd, 
        'name' =>$name,
        'phone' => $phone,
        'address' => $address
    ]);
    return $db->lastInsertId();
}
