<?php
define('TEMPLATE_DIR', '../templates/');
define('LAYOUTS_DIR', 'layouts/');
define('ENGINE_DIR', '../engine/');
define('MODELS_DIR', '../models/');

/*DB config*/
define('HOST', 'localhost:3307');
define('USER', 'test');
define('PASS', '12345');
define('DB', 'gb1');

//библиотеки
include "../engine/lib/classSimpleImage.php";// библиотека ресайза

//

include DOCUMENT_ROOT . "/engine/functions.php";
include DOCUMENT_ROOT . "/engine/controller.php";
include DOCUMENT_ROOT . "/engine/render.php";
include DOCUMENT_ROOT . "/engine/auth.php";
include DOCUMENT_ROOT . "/engine/db.php";
autoIncludeFromDir(MODELS_DIR); // подключаем файлы автоматически из папки models

//menu
$menuItems = [
    [
        'url' => '/',
        'name' => 'Главная'
    ],
    [
        'url' => '/catalog',
        'name' => 'Каталог',
        'submenu' => [
            [
                'url' => '/cart',
                'name' => 'Корзина<span class="counter"> ('.(getBasketCount()?:'нет товаров').')</span>'
            ],
            [
                'url' => '/orders',
                'name' => 'Мои заказы'
            ],
        ]
    ],
    [
        'url' => '/about',
        'name' => 'О нас'
    ],
    [
        'url' => '/gallery',
        'name' => 'Галлерея'
    ],
    [
        'url' => '/feedback',
        'name' => 'Отзывы'
    ],
    //getAdminMenu()
];
if(is_admin()){
    array_push($menuItems, [
        'url' => '/admin',
        'name' => 'Админка'
    ]);
}


$action ="";
//$messages = include "../config/messages.php";

