<?php


//2 способ пробросить tittle через функцию для render. Тут еще вместо case можно хранение соответствий в массиве организовать.
/*function getTitle($page){
    switch($page){
    case 'index': return "Главная";
    case 'catalog': return "Каталог";
    case 'about': return "О нас";
        default : "Каталог";
    }
}
*/

// ядро
function render($page, $params = []){
    return renderTemplate(LAYOUTS_DIR . $params['layout'], [
            'menu' => '<div class="menu">'. renderMenu($params['menu']) . '</div>',
            'content' => renderTemplate($page, $params),
            'title' => $params['title'],
            'auth_in_template' => renderTemplate("auth_in_template", $params),

            //'title' => getTitle($page)// 2 способ пробросить tittle
        ]
    );

}

//$params = ['menu' => 'код меню', 'catalog' => ['чай'], 'content' => 'Код шаблона']
function renderTemplate($page, $params = []) {
    /*foreach ($params as $key => $value) {
        $$key = $value;
    }*/
    extract($params);
    ob_start();
    include TEMPLATE_DIR . $page .".php";
    return ob_get_clean();
}

