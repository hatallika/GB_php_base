<?php

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