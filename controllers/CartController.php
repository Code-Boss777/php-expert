<?php

// Подключаем модели
include_once '../models/ProductModels.php';
include_once '../models/CartModels.php';
include_once '../models/CategoriesModel.php';

/**
 * Добавление товара в корзину (AJAX)
 * 
 * @param integer $itemId ID товара (передаётся через POST)
 * @return json
 */
function addtocartAction() {
    global $db;
    
    // 1. Получаем ID товара из GET-запроса
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
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
        'cartCntItems' => $cartCount,
        'message' => 'Товар добавлен в корзину'
    ]);
}

function removefromcartAction() {
    global $db;
    
    // Получаем ID товара из GET-запроса
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    if ($itemId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Неверный ID товара']);
        return;
    }
    
    // Удаляем товар из корзины
    $cart = removeFromCart($itemId);
    
    // Получаем общее количество товаров
    $cartCount = getCartCount();
    
    // Отправляем JSON-ответ
    echo json_encode([
        'success' => true,
        'cartCntItems' => $cartCount,
        'message' => 'Товар удалён из корзины'
    ]);
}
function indexAction($smarty) {
    global $db;
//получаем ID товаров из сессии(ключи массива)
$itemIds = isset($_SESSION['cart']) ? array_keys($_SESSION['cart']) : [];

//получаем категории для меню
$rsCategories = getAllMainCatsWithChildren();

//получаем товары из БД по их ID 
$rsProducts = getProductsFromArray($itemIds, $db);

//передаем в шаблон
$smarty->assign('pageTitle', 'Корзина');
$smarty->assign('rsCategories', $rsCategories);
$smarty->assign('rsProducts', $rsProducts);

//загружаем шаблон
loadTemplate($smarty, 'header');
loadTemplate($smarty, 'cart');
loadTemplate($smarty, 'footer');
}