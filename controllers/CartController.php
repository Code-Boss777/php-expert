<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Подключаем модели
include_once '../models/ProductModels.php';
include_once '../models/CartModels.php';
include_once '../models/CategoriesModel.php';
include_once '../models/orderModel.php';


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
    
    // Получаем количество из POST (из формы корзины)
    $itemCnt = [];
    foreach ($itemIds as $itemId) {
        $postVar = 'itemCnt_' . $itemId; // Исправлена буква V
        // Если пришло в POST - берем оттуда, если нет - из сессии
        $itemCnt[$itemId] = isset($_POST[$postVar]) ? intval($_POST[$postVar]) : $_SESSION['cart'][$itemId];
    }
    
    // Получаем товары из БД (ВОТ ЗДЕСЬ БЫЛА ОШИБКА: $itemIds вместо $itemId)
    $rsProducts = getProductsFromArray($itemIds, $db);
    
    // Считаем итоги и убираем товары с количеством 0
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
    
    // 5. Сохраняем промежуточные данные заказа в сессию
    $_SESSION['saleCart'] = $finalProducts; // Убрана лишняя 'l'
    
    // 6. Получаем категории для меню
    $rsCategories = getAllMainCatsWithChildren();
    
    // 7. Скрывать ли блок логина (если пользователь уже авторизован)
    $hideLoginBox = isset($_SESSION['user']) ? 1 : 0;

    if (isset($_SESSION['user'])) {
        $smarty->assign('arUser', $_SESSION['user']);
    }


    // 8. Передаем в шаблон
    $smarty->assign('pageTitle', 'Оформление заказа'); // Убрана 's'
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $finalProducts); // Исправлено на rsProducts
    $smarty->assign('hideLoginBox', $hideLoginBox);
    
    // 9. Загружаем шаблоны
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'order');
    loadTemplate($smarty, 'footer');
}

/**
 * Сохранение заказа в БД (AJAX)
 */
function saveorderAction() {
    global $db;

    // 1. Проверка авторизации
    if (!isset($_SESSION['user'])) {
        echo json_encode(['success' => false, 'message' => 'Необходимо авторизоваться']);
        return;
    }

    // 2. Достаем ID пользователя (на случай, если в сессии массив, а не число)
    if (is_array($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
    } else {
        $userId = $_SESSION['user']; // Если сохранилось просто число
    }

    // 3. Берем данные из формы
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';

    // 4. Проверяем, есть ли товары
    if (empty($_SESSION['saleCart'])) {
        echo json_encode(['success' => false, 'message' => 'Корзина пуста']);
        return;
    }

    // 5. Вызываем модель
    $orderId = saveOrder($userId, $name, $phone, $address, $_SESSION['saleCart'], $db);

    // 6. Очищаем корзины и отвечаем
    if ($orderId) {
        unset($_SESSION['cart']);
        unset($_SESSION['saleCart']);
        echo json_encode(['success' => true, 'orderId' => $orderId]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ошибка при сохранении заказа']);
    }
}

