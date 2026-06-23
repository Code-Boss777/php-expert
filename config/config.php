
<?php
//файл настроек 
//Константа для обращения к контроллерам
define('PathPrefix', '../controllers/');
define('PathPostfix', 'Controller.php');
//используемый шаблонизатор 
$template = 'default';
//пути к файлам шаблонов
define('TemplatePrefix', dirname(__DIR__) . "/www/views/{$template}/");
define('TemplatePostfix', '.tpl');
//Пути в файлам шаблонов в вебространстве
define('TemplateWebPath', "/templates/{$template}/");
//Инициализаци шаблонизатора Smarty
// 1. Подключаем основной файл  Smarty (через папку src)
// require_once('../library/smarty-5.5.1/src/Autoloader.php');
// // 2. Регистрируем автозагрузчик, чтобы PHP знал, где искать все внутренние файлы Smarty
// \Smarty\Autoloader::register();
// // 2. Создаем объект, явно указав его пространство имен (Namespace) через обратный слэш \
// $smarty = new \Smarty\Smarty();

// // 3. Настраиваем папки через обновленный объект конфигурации (это синтаксис Smarty 5)
// $smarty->configuration->setTemplateDir(TemplatePrefix);
// $smarty->configuration->setCompileDir('../tmp/smarty/templates_c');
// $smarty->configuration->setCacheDir('../tmp/smarty/cache');
spl_autoload_register(function ($class) {
    // Проверяем, что запрашиваемый класс относится к Smarty
    if (strpos($class, 'Smarty\\') === 0) {
        // Убираем из имени слово Smarty\ и меняем обратные слэши на обычные
        $file = str_replace('\\', '/', substr($class, 7)) . '.php';
        // Формируем точный путь к файлу внутри папки src
        $path = '../library/smarty-5.5.1/src/' . $file;
        if (file_exists($path)) {
            require_once $path;
        }
    }
});
$smarty = new \Smarty\Smarty();
// $smarty->assign('TemplateWebPath', TemplateWebPath);
// === 3. НАСТРАИВАЕМ РАБОЧИЕ ПАПКИ ===
$smarty->setTemplateDir(TemplatePrefix);
$smarty->setCompileDir('../tmp/smarty/templates_new');
$smarty->setCacheDir('../tmp/smarty/cache');
$smarty->assign('TemplateWebPath', TemplateWebPath);
//отключаем кэширование smarty
$smarty->setCompileCheck(true);
$smarty->setForceCompile(true);
