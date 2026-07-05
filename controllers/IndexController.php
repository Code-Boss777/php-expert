<?php 
//контроллер главной страницы


//подключаем модели 
include_once '../models/CategoriesModel.php'; 


function testAction(){
    echo 'indexController.php > testAction';
    //Формированиеи главной страницы сайта 
    //Smarty Шаблонизатор
}

function indexAction($smarty){

//подключаем модели
$rsCategories = getAllMainCatsWithChildren();

    $smarty->assign('pageTitle', 'Главная страница сайта');
    $smarty->assign('rsCategories', $rsCategories);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
}
