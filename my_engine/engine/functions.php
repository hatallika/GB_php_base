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
function prepareVariables($page){
    global $menuItems;
    $params = [
        'menu' => $menuItems,
        'layout' => 'main'
    ];

    switch ($page) {

        case 'index':
            $params['title'] = "Главная";
            break;

        case 'buh':
            $params['title'] = "Бухгалтерия";
            $params['files'] = getFiles();
            break;

        case 'news':
            $params['news'] = getNews();
            break;

        case 'onenews':
            $id = (int)$_GET['id'];
            $params['news'] = getOneNews($id);
            break;

        case 'gallery':
            $params['title'] = "Галлерея";
            $params['files'] = getGallery();
            $params['layout'] = 'gallery_layout'; // другой главный шаблон галереи
            $messages = [
                'ok' => 'Файл загружен',
                'error' => 'Ошибка загрузки',
                'error_php' => 'Загрузка php-файлов запрещена!',
                'error_not_jpg' => 'Можно загружать только jpg-файлы, неверное содержание файла, не изображение.'
            ];
            if (!empty($_FILES)) {
                uploadGallery();
            }
            //$message = $messages[$_GET['status']];
            $params['message'] = $messages[$_GET['status']];
            break;

        case 'oneimage':
            $id = (int)$_GET['id'];
            addViews($id); // счетчик просмотров
            $params['views'] = getViews($id);
            $params['files'] = getOneImage($id);
            $params['layout'] = 'gallery_layout';
            break;

        case 'catalog':
            $params['title'] = "Каталог";
            $params['catalog'] = getCatalog();
            break;

        case 'about':
            $params['title'] = "О нас";
            $params['phone'] = '+7 (925) 453 54 35';
            break;

        case 'apicatalog':
            echo json_encode(getCatalog(),JSON_UNESCAPED_UNICODE);
            die();

        case 'ex':
            $params['title'] = "Упражнения Урок 3";

        case 'setup':
            $params['title'] = "Загрузка из папки";
            if($_GET['upload'] == 'ok'){
                uploadImageToDB();
            }
    }
    return $params;
}



// ядро
function render($page, $params = []){
    return renderTemplate(LAYOUTS_DIR . $params['layout'], [
            'menu' => '<div class="menu">'. renderMenu($params['menu']) . '</div>',
            'content' => renderTemplate($page, $params),
            'title' => $params['title']
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