<?php
// Подключаем модели
include_once '../models/CartModels.php';
include_once '../models/ProductModels.php';
include_once '../models/CategoriesModel.php';

/**
 * Страница товара
 *
 * @param object $smarty Шаблонизатор
 */
function indexAction($smarty) {
    global $db;
    
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    if ($itemId == 0) {
        die('Товар не найден (ID не передан)');
    }
    
    // Передаём $db вторым аргументом
    $rsProduct = getProductById($itemId, $db);

    if (!$rsProduct) {
        die('Товар с таким ID не найден');
    }

    $rsCategories = getAllMainCatsWithChildren();
    $itemInCart = 0;
    if (isset($_SESSION['cart'][$itemId])) {
        $itemInCart = 1;
    }
    $smarty->assign('itemInCart', $itemInCart);
    $smarty->assign('pageTitle', $rsProduct['name']);
    $smarty->assign('rsProduct', $rsProduct);
    $smarty->assign('rsCategories', $rsCategories);


    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'product');
    loadTemplate($smarty, 'footer');
}
