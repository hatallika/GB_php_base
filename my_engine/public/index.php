<?php
session_start();
//__DIR__ //dirname(__DIR__)
define("DOCUMENT_ROOT", dirname(__DIR__)); //получили путь выше public
include DOCUMENT_ROOT . "/config/config.php"; // подключили файл конфигурации

//Роутер. Читаем действие которое хочет сделать пользователь
//Читаем параметр page is url, чтобы определить, какую страницу-шаблон хочет видеть пользователь
//По умолчанию index


$url_array = explode('/', $_SERVER['REQUEST_URI']);
$action = $url_array[2];
if ($url_array[1] == "") {
    $page = 'index';
} else {
    $page = $url_array[1];
}

//Контроллер
$params = prepareVariables($page, $action);

//_log($params, 'params');
echo render($page, $params);

