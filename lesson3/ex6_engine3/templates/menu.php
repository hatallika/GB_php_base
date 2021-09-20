<?php
$menuItems = [
    'index' => 'Главная',
    'catalog' => 'Каталог',
    'catalogspa' => 'Каталог SPA',
    'about' => 'О нас',
    'ex' => 'Упражнения'
    //'ex' => [Задача 1]
];
$menu = '<ul class="menu_ul">';

foreach ($menuItems as $key => $values){

    $menu .= '<li class="menu_li"><a href="/?page='. $key .'">'. $values .'</a></li>';
}
$menu .= "</ul>";
echo $menu;


