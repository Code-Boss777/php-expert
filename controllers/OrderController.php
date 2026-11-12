<?php
// Контроллер для работы с заказами (AJAX)

include_once '../models/OrderModel.php';

/**
 * AJAX: Получить детали конкретного заказа
 */
function getdetailsAction() {
    global $db;
    
    // Берем ID из POST-запроса
    $orderId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($orderId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Неверный ID заказа']);
        return;
    }
    
    $products = getOrderDetails($orderId, $db);
    
    echo json_encode([
        'success' => true,
        'products' => $products
    ]);
}