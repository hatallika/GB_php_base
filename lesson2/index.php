<?php

$about = renderTemplate('about', '+7 (925) 453 54 35');
$menu = renderTemplate('menu');
echo renderTemplate('layout', $about, $menu);


function renderTemplate($page, $content='', $menu='') {
    ob_start();
    include $page .".php";
    return ob_get_clean();
}

