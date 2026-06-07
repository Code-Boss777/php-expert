//контроллер главной страницы
<?php 
function testAction(){
    echo 'indexController.php > testAction';
    //Формированиеи главной страницы сайта 
    //Smarty Шаблонизатор
}
function indexAction($smarty){
    $smarty->assign('pageTitle', 'Главная страница сайта');

    loadTemplate($smarty, 'index');
}
