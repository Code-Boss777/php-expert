<?php 
//контроллер главной страницы


//подключаем модели 
include_once '../models/CartModels.php';
include_once '../models/CategoriesModel.php';
include_once '../models/ProductModels.php';



function testAction(){
    echo 'indexController.php > testAction';
    //Формированиеи главной страницы сайта 
    //Smarty Шаблонизатор
}

function indexAction($smarty){

//подключаем модели
$rsCategories = getAllMainCatsWithChildren();
$rsProducts = getLastProducts(16);
$cartCount = getCartCount();
$smarty->assign('cartCntItems', $cartCount);

    $smarty->assign('pageTitle', 'Главная страница сайта');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
}
