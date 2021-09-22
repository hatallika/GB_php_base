<?php

define('TEMPLATE_DIR', 'templates/');
define('LAYOUTS_DIR', 'layouts/');

$menuItems = [
    [
        'url' => '/?page=index',
        'name' => 'Главная'
    ],
    [
        'url' => '/?page=catalog',
        'name' => 'Каталог'
    ],
    [
        'url' => '/?page=catalogspa',
        'name' => 'Каталог SPA'
    ],

    [
        'url' => '/?page=about',
        'name' => 'О нас'
    ],
    [
        'url' => '/?page=ex',
        'name' => 'Упражнения',
        'submenu' => [
            [
                'url' => '/?page=ex#1',
                'name' => 'Упражнение1'
            ],
            [
                'url' => '/?page=ex#2',
                'name' => 'Упражнение2'
            ],
            [
                'url' => '/?page=ex#3',
                'name' => 'Упражнение3'
            ],
        ]
    ]

];

$page = 'index';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

//фреймворк
$params = [
    'menu' => $menuItems
];

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
function renderMenu($arrMenu){

    $str = '<ul>';
    foreach ($arrMenu as $item){
        $str .= '<li><a href="'. $item['url'] .'">'. $item['name'] .'</a>';

        if (isset($item['submenu'])) {
            $str .= renderMenu($item['submenu']);
        }
        $str .= '</li>'."\n";
    }

    $str .= '</ul>'."\n";
    return $str;
}


function render($page, $params = []){
    return renderTemplate(LAYOUTS_DIR . 'main', [
            'menu' => '<div class="menu">'. renderMenu($params['menu']) . '</div>',
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
