<?php
//Контроллер
function prepareVariables($page, $action=""){
    //Controller
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
                $message = uploadGallery();
                header("Location: gallery/?status=" . $message);
            }
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

        case 'product':
            var_dump($_SERVER);
            $product_id = (int)$_GET['id'];
            $params['product'] = getProduct($product_id);
            //Отзывы
            $messages = [
                'ok' => 'Сообщение добавлено',
                'delete' => 'Сообщение удалено',
                'edit' => 'Сообщение изменено',
                'error' => 'Ошибка'
            ];
            $params['feedback'] = getALLFeedback($product_id);
            $params['message'] = $messages[$_GET['message']];

            if ($_POST["id"]){
                $id = (int)$_POST['id'];
            } else {
                $id = (int)$_GET['feedback_id'];
                if($action == "add"){
                    $id = $product_id;
                }
            }

            if ($action == "edit") {
                $params['fields'] = doFeedBackAction($action, $id);
            }

            if (in_array($action,["add", "save", "delete"])) {
                header("Location: /product/?id={$product_id}&message=" . doFeedBackAction($action, $id));
            }
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
            break;
        case 'setup':
            $params['title'] = "Загрузка из папки";
            if($_GET['upload'] == 'ok'){
                uploadImageToDB();
            }
            break;
        case 'feedback':
            $messages = [
                'ok' => 'Сообщение добавлено',
                'delete' => 'Сообщение удалено',
                'edit' => 'Сообщение изменено',
                'error' => 'Ошибка'
            ];
            $params['feedback'] = getALLFeedback();
            $params['message'] = $messages[$_GET['message']];

            if ($_POST["id"]){
                $id = (int)$_POST['id'];
            } else {
                $id = (int)$_GET['id'];
            }

            if ($action == "edit") {
                $params['fields'] = doFeedBackAction($action, $id);
            }

            if (in_array($action,["add", "save", "delete"])) {
                header("Location: /feedback/?message=" . doFeedBackAction($action, $id));
            }
            break;
    }
    return $params;

}