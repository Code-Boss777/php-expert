<?php
function saveOrder($userId, $name, $phone, $address, $products, $db) {
    
    $comment = "Имя: {$name}\nТел: {$phone}\nАдрес: {$address}";

    $sql = "INSERT INTO orders (user_id, status, date_created, comment)
            VALUES (:user_id, 0, NOW(), :comment)";
            
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'user_id' => $userId,
        'comment' => $comment
    ]);

    $orderId = $db->lastInsertId();

    $sqlPurchase = "INSERT INTO purchase (order_id, product_id, price, amount)
                    VALUES (:order_id, :product_id, :price, :amount)";
                    
    $stmtPurchase = $db->prepare($sqlPurchase);

    foreach ($products as $product) {
        $stmtPurchase->execute([
            'order_id' => $orderId,
            'product_id' => $product['id'],
            'price' => $product['price'],
            'amount' => $product['cnt'] // В контроллере мы передаем 'cnt'
        ]);
    }
    
    return $orderId;
}

/**
 *  Получить список заказов пользователя
 */

function getOrdersByUser($userId, $db) {
    $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY id DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchALL(PDO::FETCH_ASSOC);
}

/**
 * Получить товары конкретного заказа
 */
function getOrderDetails($orderId, $db) {
    $sql = "SELECT p.name, p.price, pu.amount 
            FROM purchase pu
            INNER JOIN products p ON pu.product_id = p.id
            WHERE pu.order_id = :order_id";
            
    $stmt = $db->prepare($sql);
    
    // ВОТ ЗДЕСЬ ДОЛЖНО БЫТЬ СТРОГО 'order_id' (как и в SQL-запросе выше)
    $stmt->execute(['order_id' => $orderId]); 
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}