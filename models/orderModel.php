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