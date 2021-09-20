<?php

define('TEMPLATE_DIR', 'templates/');
define('LAYOUTS_DIR', 'layouts/');

$page = 'index';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

//фреймворк
$params = [];

switch ($page) {
    case 'index':
        $params['title'] = "Главная";
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

echo render($page, $params);

function getCatalog()
{
 return [
     'catalog' => [
         [
             'name' => 'Пицца',
             'price' => 24
         ],
         [
             'name' => 'Чай',
             'price' => 1
         ],
         [
             'name' => 'Яблоко',
             'price' => 12
         ]
     ]

 ];
}

//2 способ пробросить tittle через функцию для render. Тут еще вместо case можно хранение соответствий в массиве организовать.
/*function getTitle($page){
    switch($page){
    case 'index': return "Главная";
    case 'catalog': return "Каталог";
    case 'about': return "О нас";
        default : "Каталог";
    }
}
*/

// ядро
function render($page, $params = []){
    return renderTemplate(LAYOUTS_DIR . 'main', [
            'menu' => renderTemplate('menu2', $params ),
            'content' => renderTemplate($page, $params),
            'title' => $params['title']
            //'title' => getTitle($page)// 2 способ пробросить tittle
        ]
    );

}

//$params = ['menu' => 'код меню', 'catalog' => ['чай'], 'content' => 'Код шаблона']
function renderTemplate($page, $params = []) {
    /*foreach ($params as $key => $value) {
        $$key = $value;
    }*/
    extract($params);
    ob_start();
    include TEMPLATE_DIR . $page .".php";
    return ob_get_clean();
}
