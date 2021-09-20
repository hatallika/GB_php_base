<?php
$menuItems = [ // Здесь храним ссылки на пункты меню, а не генерируем их. На случай, если пользователь захочет ставить любые а не только из движка
    'Главная' => '/?page=index',
    'Каталог' => '/?page=catalog',
    'Каталог SPA' => '/?page=catalogspa',
    'О нас' => '/?page=about',
    'Упражнения' => ['/?page=ex',
        'Упражнение 1' => '/?page=ex#1',
        'Упражнение 2' => '/?page=ex#2',
        'Упражнение 3' => '/?page=ex#3',
        'Упражнение 4' => '/?page=ex#4',
        'Упражнение 5' => '/?page=ex#5',
        'Упражнение 6' => '/?page=ex#6',
        'Упражнение 7' => '/?page=ex#7',
        'Упражнение 8' => '/?page=ex#8',
        'Упражнение 9' => '/?page=ex#9'
    ]
];
function renderMenu($arrMenu){

    echo "<ul>"; // не получилось через накопление строки, в рекурсии она обнуляется из-за необходимости задавать строке первое значение.
    foreach ($arrMenu as $key => $value){
        if (is_array($value)) {

            echo '<li class="menu_li"><a href = "'.$value[0].'">'.$key .'</a>';
            renderMenu( array_slice ($value, 1));
        } else {
            echo '<li class="menu_li"><a href = "'.$value.'">'.$key .'</a>';
        }
        echo  '</li>'."\n";
    }
    echo "</ul>"."\n";
}
?>
<div class="menu">
<?php renderMenu($menuItems); ?>
</div>