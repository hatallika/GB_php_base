<?php
define('TEMPLATE_DIR', '../templates/');
define('LAYOUTS_DIR', 'layouts/');

/*DB config*/
define('HOST', 'localhost:3307');
define('USER', 'test');
define('PASS', '12345');
define('DB', 'gb1');

//
include $DOCUMENT_ROOT . "/engine/functions.php";
include $DOCUMENT_ROOT . "/engine/catalog.php";
include $DOCUMENT_ROOT . "/engine/menu.php";
include $DOCUMENT_ROOT . "/engine/log.php";
include $DOCUMENT_ROOT . "/engine/files.php";
include $DOCUMENT_ROOT . "/engine/gallery.php"; // модуль галереи
include $DOCUMENT_ROOT . "/engine/db.php";
include $DOCUMENT_ROOT . "/engine/news.php";


//menu
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
    ],
    [
        'url' => '/?page=gallery',
        'name' => 'Галлерея'
    ],
    [
        'url' => '/?page=news',
        'name' => 'Новости'
    ],

];
