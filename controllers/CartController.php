<?php
/**
 * Добавление товара в корзину (AJAX)
 * 
 * @param integer $itemId ID товара (передаётся через POST)
 * @return json
 */
function addtocartAction() {
    global $db;
    
    // 1. Получаем ID товара из POST-запроса (а не GET!)
    $itemId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($itemId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Неверный ID товара']);
        return;
    }
    
    // 2. Проверяем, есть ли товар в БД
    $product = getProductById($itemId, $db);
    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Товар не найден']);
        return;
    }
    
    // 3. Добавляем товар в корзину (сессия)
    $cart = addToCart($itemId);
    
    // 4. Получаем общее количество товаров
    $cartCount = getCartCount();
    
    // 5. Отправляем JSON-ответ
    echo json_encode([
        'success' => true,
        'cartCount' => $cartCount,
        'message' => 'Товар добавлен в корзину'
    ]);
}