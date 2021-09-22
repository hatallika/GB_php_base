<?php
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

function renderMenu_($arrMenu){

    $str = '<ul>';
    foreach ($arrMenu as $item){
    $str .= '<li><a href="'. $item['url'] .'">'. $item['name'] .'</a>';

        if (isset($item['submenu'])) {
            $str .= renderMenu_($item['submenu']);
            }
        $str .= '</li>'."\n";
    }

    $str .= '</ul>'."\n";
    return $str;
}

$menu = renderMenu_($menuItems);
?>
<div class="menu">
    <?=$menu?>
</div>
