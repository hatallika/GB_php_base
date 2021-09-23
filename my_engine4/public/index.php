<?php
//$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT']; // добавили абсолютный путь //__DIR__ //dirname(__DIR__)
$DOCUMENT_ROOT = dirname(__DIR__);
include $DOCUMENT_ROOT . "/config/config.php"; // подключили файл конфигурации

$page = 'index';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

//фреймворк
$params = [
    'menu' => $menuItems,
    'layout' => 'main'
];

switch ($page) {
    case 'index':
        $params['title'] = "Главная";
        break;
    case 'buh':
        $params['title'] = "Бухгалтерия";
        $params['files'] = getFiles();
        break;
    case 'gallery':
        $params['title'] = "Галлерея";
        $params['files'] = getGallery();
        $params['layout'] = 'gallery_layout';
        break;
    case 'catalog':
        $params['title'] = "Каталог";
        $params['catalog'] = getCatalog();
        break;
    case 'about':
        $params['title'] = "О нас";
        $params['phone'] = '+7 (925) 453 54 35';
        break;
    case 'apicatalog':
        echo json_encode(getCatalog(),JSON_UNESCAPED_UNICODE);
        die();
    case 'ex':
        $params['title'] = "Упражнения Урок 3";
}
//_log($params, 'params');
//var_dump($params);
echo render($page, $params);

