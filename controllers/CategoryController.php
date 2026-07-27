<?php
 include_once '../models/CategoriesModel.php';
 include_once '../models/ProductModels.php';

/**
 * Формирование страницы категории
 *
 * @param object $smarty Шаблонизатор
 */
function indexAction($smarty) {
    // 1. Ловим ID категории из адресной строки (например, /?controller=category&id=2)
    $catId = isset($_GET['id']) ? (int)$_GET['id'] : null;
    if (!$catId) exit();

    // 2. Получаем данные этой конкретной категории и список её товаров
    $rsCategory = getCatById($catId);
    $rsProducts = getProductsByCat($catId);

    // 3. Получаем все категории для левого меню, чтобы оно не исчезало
    $rsCategories = getAllMainCatsWithChildren();

    // 4. Передаем все данные в шаблонизатор Smarty
    $smarty->assign('pageTitle', 'Товары категории ' . $rsCategory['name']);
    $smarty->assign('rsCategory', $rsCategory);
    $smarty->assign('rsProducts', $rsProducts);
    $smarty->assign('rsCategories', $rsCategories);

    // 5. Подгружаем шаблоны страницы
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index'); // Используем index.tpl, так как сетка товаров там такая же!
    loadTemplate($smarty, 'footer');
}
/**
 * Получить данные категории по её ID
 *
 * @param integer $catId ID категории
 * @return array|false Массив с данными категории или false
 */
