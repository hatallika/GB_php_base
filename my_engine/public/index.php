<?php
//__DIR__ //dirname(__DIR__)
define("DOCUMENT_ROOT", dirname(__DIR__)); //получили путь выше public
include DOCUMENT_ROOT . "/config/config.php"; // подключили файл конфигурации

$url_array = explode('/', $_SERVER['REQUEST_URI']);

if ($url_array[1] == "") {
    $page = 'index';
} else {
    $page = $url_array[1];
}

//фреймворк
$params = prepareVariables($page);
//_log($params, 'params');
echo render($page, $params);

