<?php
/*$menuItems = [ // Здесь храним ссылки на пункты меню, а не генерируем их. На случай, если пользователь захочет ставить любые а не только из движка
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
];*/
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

function renderMenu2($arrMenu){

    $str = '<ul>';
    foreach ($arrMenu as $item){
    $str .= '<li><a href="'. $item['url'] .'">'. $item['name'] .'</a>';

        if (isset($item['submenu'])) {
            $str .= renderMenu2($item['submenu']);
            }
        $str .= '</li>'."\n";
    }

    $str .= '</ul>'."\n";
    return $str;
}

$menu = renderMenu2($menuItems);
?>
<div class="menu">
    <?=$menu?>
</div>
