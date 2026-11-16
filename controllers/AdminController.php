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