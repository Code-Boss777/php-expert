<?php
//основные функции

//формирование запрашиваемой страницы

//$controllerName название контроллера
//$actionName название функции обработки страницы
function loadPage($smarty, $controllerName, $actionName = 'Index'){
    include_once PathPrefix . $controllerName . PathPostfix;
    $function = $actionName . 'Action';
    $function($smarty);
}
function loadTemplate($smarty, $templateName) {
     $smarty->display($templateName . TemplatePostfix);
}

function d($value = null, $die = 1) {
echo 'Debug: <br/><pre>';
// print_r($value);
echo '</pre>';

// if($die) die;
}
