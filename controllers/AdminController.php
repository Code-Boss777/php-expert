<?php
// Контроллер админки

include_once '../models/CategoriesModel.php';
include_once '../models/ProductModels.php';
include_once '../models/OrderModel.php';
include_once '../models/UserModel.php';

/**
 * Главная страница админки (Дашборд)
 */
function indexAction($smarty) {

// //временная отладка
// echo '<pre>';
// var_dump($_SESSION['user']);
// echo 'Значение is_admin';
// var_dump(isset($_SESSION['user']['is_admin']) ? $_SESSION['user']['is_admin'] : 'НЕТ Ключа');
// die('----Стоп Отладки---');
// //Конец отладки  


    // ПРОВЕРКА БЕЗОПАСНОСТИ: пускаем только админов
    if (!isset($_SESSION['user']['is_admin']) || $_SESSION['user']['is_admin'] != 1) {
        redirect('/');
        return;
    }

    // Указываем Smarty использовать шаблоны из папки admin
    $smarty->setTemplateDir(TemplateAdminPrefix);
    $smarty->assign('TemplateWebPath', TemplateAdminWebPath);

    // Передаем данные для шапки
    $smarty->assign('pageTitle', 'Управление сайтом');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminIndex');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * Страница управления категориями
 */
function categoryAction($smarty) {
    if (!isset($_SESSION['user']['is_admin']) || $_SESSION['user']['is_admin'] != 1) {
        redirect('/');
        return;
    }
    
    global $db;
    $smarty->setTemplateDir(TemplateAdminPrefix);
    $smarty->assign('TemplateWebPath', TemplateAdminWebPath);
    
    // Получаем все категории
    $rsCategories = getAllCategories($db);
    
    $smarty->assign('pageTitle', 'Управление категориями');
    $smarty->assign('rsCategories', $rsCategories);
    
    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminCategory');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * AJAX: Сохранение изменений категории
 */
function updatecategoryAction() {
    if (!isset($_SESSION['user']['is_admin']) || $_SESSION['user']['is_admin'] != 1) {
        echo json_encode(['success' => false, 'message' => 'Доступ запрещен']);
        return;
    }
    
    global $db;
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $parentId = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;
    
    if ($id > 0 && !empty($name)) {
        updateCategory($id, $name, $parentId, $db);
        echo json_encode(['success' => true, 'message' => 'Сохранено']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Неверные данные']);
    }
}