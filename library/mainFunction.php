<?php
// Основные системные функции проекта

/**
 * Формирование запрашиваемой страницы
 * 
 * @param object $smarty Шаблонизатор
 * @param string $controllerName Название контроллера
 * @param string $actionName Название функции обработки страницы
 */
function loadPage($smarty, $controllerName, $actionName = 'Index') {
    include_once PathPrefix . $controllerName . PathPostfix;
    
    $function = $actionName . 'Action';
    $function($smarty);
}

/**
 * Отрисовка шаблона страницы
 * 
 * @param object $smarty Шаблонизатор
 * @param string $templateName Имя файла шаблона
 */
function loadTemplate($smarty, $templateName) {
    $smarty->display($templateName . TemplatePostfix);
}

/**
 * Функция отладки (Дамп данных)
 * 
 * @param mixed $value Переменная для вывода на экран
 * @param int $die Флаг остановки скрипта
 */
function d($value = null, $die = 1) {
    echo 'Debug: <br/><pre>';
    print_r($value);
    echo '</pre>';

    if ($die) die;
}

/**
 * Преобразование результата запроса PDO в ассоциативный массив для Smarty
 *
 * @param object $rs Результат выполнения запроса (PDOStatement)
 * @return array|false Массив данных или false
 */
function createSmartyRsArray($rs) {
    if (! $rs) return false;

    // fetchAll мгновенно собирает массив без старых циклов while
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}