<?php
define('TEMPLATE_DIR', '../templates/');
define('LAYOUTS_DIR', 'layouts/');

//TODO попробовать сделать эти пути абсолютными
include "../engine/functions.php";
include "../engine/catalog.php";
include "../engine/menu.php";
include "../engine/log.php";
include "../engine/files.php";
include "../engine/gallery.php";


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
        'url' => '/?page=buh',
        'name' => 'Бугалтерия'
    ],
    [
        'url' => '/?page=gallery',
        'name' => 'Галлерея'
    ],

];
