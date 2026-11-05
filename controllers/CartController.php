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

//Добавляем количество из сессии.
if(!empty($rsProducts)) {
    foreach($rsProducts as &$product) {
        //Берем количество из сессии. Если нет - ставим 1.
        $product['quantity'] = isset($_SESSION['cart'][$product['id']]) 
                       ? $_SESSION['cart'][$product['id']] 
                       : 1;
    }
}

//передаем в шаблон
$smarty->assign('pageTitle', 'Корзина');
$smarty->assign('rsCategories', $rsCategories);
$smarty->assign('rsProducts', $rsProducts);

//загружаем шаблон
loadTemplate($smarty, 'header');
loadTemplate($smarty, 'cart');
loadTemplate($smarty, 'footer');
}

function updatecountAction() {
    global $db;

    $itemId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $count = isset($_POST['count']) ? intval($_POST['count']) : 1;

    if ($itemId <= 0 || $count <= 0) {
        echo json_encode(['success' => false, 'message' => 'Неверные данные']);
        return;
    }
    
    // Обновляем количество в сессии
    updateCartCount($itemId, $count);
    
    // Возвращаем успех
    echo json_encode([
        'success' => true,
        'cartCntItems' => getCartCount()
    ]);
}
/**
 * Страница оформления заказа
 */
function orderAction($smarty) {
    global $db;
// Получаем ID товаров из сессии
$itemIds = isset($_SESSION['cart']) ? array_keys($_SESSION['cart']) : [];

// Если корзина пуста - редирект обратно в корзину
if(empty($itemIds)) {
    redirect('/cart/');
    return;
}
// получаем количествоиз POST (из формы корзины)
$itemCnt = [];
foreach ($itemIds as $itemId) {
    $postvar = 'itemCnt_' . $itemId;
    // Если пришлов POST - берем оттудаа, если нет - из сессии
    $itemCnt[$itemId] = isset($_POST[$postVar]) ? intval(_POST[$postVar]) : $_SESSION['cart'][$itemId];
}
// Получакм товарды из БД
$rsProduct = getProductsFromArray($itemId, $db);
// Считаем итоги и убираем товаары с количеством 0
$finalProducts = [];
foreach ($rsProducts as $product) {
    $cnt = $itemCnt[$product['id']] ?? 0;
    if ($cnt > 0) {
        $product['cnt'] = $cnt;
        $product['realPrice'] = $cnt * $product['price'];
        $finalProducts[] = $product;
    }
}
// Если все товары удалили (ввели 0) - обратно в корзину
if (empty($finalProducts)) {
    redirect('/cart/');
    return;
}
// 5. Сохраняем промужуточноые днные заказа в сессию
$_SESSION['saleCart'] = $finallProducts;

// 6. Получаем категории для меню
$rsCategories = getAllMainCatsWithChildren();

// 7. Скрывать ли блок логина(если пользователь уже авторизован)
$hideLoginBox = isset($_SESSION['user']) ? 1 : 0;

//8. Переадем в шаблон
$smarty->assign('pageTitles', 'Оформление заказа');
$smarty->assign('rsCategories', $rsCategories);
$smarty->assign('rsProsucts', $finalProducts);
$smarty->assign('hideLoginBox', $hideLoginBox);

//9. Загружаем Шаблоны
loadTemplate($smarty, 'header');
loadTemplate($smarty, 'order');
loadTemplate($smarty, 'footer');
}

/**
 * Сохранение заказа в БД (AJAX)
 */
function saveOrderAction() {
    global $db;

    // 1. Если пользователь не авторизован - ошибка
    if (!isset($_SESSION['user'])) {
        echo json_encode(['success' => false, 'message' => 'Необходимо авторизоваться']);
        return;
    }
    //2. Берем данные из формы
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $userId = $_SESSION-['user']['id'];

//3. Проверяем, есть ли товары в корзине заказа 
if (empty($_SESSION['saleCart'])) {
    echo json_encode(['success' => false, 'message' => 'Корзина пуста']);
    return;
}
//4. Сохраняем заказ в БД (функция будет в OrderModel.php)
require_once '../models/OrderModel.php';
$orderId = saveOrder($userId, $name, $phone, $address, $_SESSION['saleCart'], $db);

if ($orderId) {
//5. Очищаем корзины
unset($_SESSION['cart']);
unset($_SESSION['saleCart']);
echo json_encode(['success' => true, 'orderId' => $orderId]);
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибкаа при сохранения заказа']);
    }
}

