<?php
define('TEMPLATE_DIR', '../templates/');
define('LAYOUTS_DIR', 'layouts/');

/*DB config*/
define('HOST', 'localhost:3307');
define('USER', 'test');
define('PASS', '12345');
define('DB', 'gb1');

//библиотеки
include "../engine/lib/classSimpleImage.php";// библиотека ресайза

//
include DOCUMENT_ROOT . "/engine/controller.php";
include DOCUMENT_ROOT . "/engine/render.php";
include DOCUMENT_ROOT . "/models/catalog.php";
include DOCUMENT_ROOT . "/models/menu.php";
include DOCUMENT_ROOT . "/models/log.php";
include DOCUMENT_ROOT . "/models/files.php";
include DOCUMENT_ROOT . "/models/gallery.php"; // модуль галереи
include DOCUMENT_ROOT . "/engine/db.php";
include DOCUMENT_ROOT . "/models/news.php";
include DOCUMENT_ROOT . "/models/setup.php";
include DOCUMENT_ROOT . "/models/feedback.php";

//menu
$menuItems = [
    [
        'url' => '/',
        'name' => 'Главная'
    ],
    [
        'url' => '/catalog',
        'name' => 'Каталог'
    ],
    [
        'url' => '/about',
        'name' => 'О нас'
    ],
    [
        'url' => '/ex',
        'name' => 'Упражнения',
        'submenu' => [
            [
                'url' => '/ex#1',
                'name' => 'Упражнение1'
            ],
            [
                'url' => '/ex#2',
                'name' => 'Упражнение2'
            ],
            [
                'url' => '/ex#3',
                'name' => 'Упражнение3'
            ],
        ]
    ],
    [
        'url' => '/gallery',
        'name' => 'Галлерея'
    ],
    [
        'url' => '/feedback',
        'name' => 'Отзывы'
    ]
];


