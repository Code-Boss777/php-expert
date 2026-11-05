<?php
/**
 * Сохранение заказа и товаров в нем
 */
function saveOrder($userId, $name, $phone, $adress, $prosucts, $db) {
    //1. Создаем заказ
    $sql = "INSERT INTO orders (user_id, status, date_created, comment)
    VALUES (:user_id, 0, NOW(), :comment)";
    $comment = $db->prepare($sql);
    $stmt->execute([
        'user_id' => $userId,
        'comment' => $comment
    ]);

    $orderId = $db->lastInsertId();
//2. Добавляем товары в покупку (purchase)
$sqlPurchase = "INSERT INTO purchase (order_id, product_id, price, amont
VALUES (:order_id, :product_id, :price, :amont)";
$stmtPurchase = $db->prepare($sqlPurchase);

foreach ($products as $product) {
    $stmtPurchase->execute([
        'order_id' => $orderId,
        'product_id' => $product['id'],
        'price' => $product['price'],
        'amont' => $product['cnt']
    ]);
}
return $orderId;
}
