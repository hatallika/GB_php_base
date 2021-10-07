<?php
//Контроллер
function prepareVariables($page, $action=""){
    //Controller
    global $menuItems;
    $params = [
        'menu' => $menuItems,
        'layout' => 'main',
        'auth' => isAuth(),
        'name' => get_user()
    ];

    switch ($page) {

        case 'index':
            $params['title'] = "Главная";
            break;

        case 'login':

            $login = $_POST['login'];
            $pass = $_POST['pass'];
            if (auth($login,$pass)) {
                if (isset($_POST['save'])) {
                    updateHash();
                }
                header("Location: " . $_SERVER['HTTP_REFERER']);
                die();
            } else {
                $_SESSION['message']['login'] = 'Не верный логин и пароль';
                header("Location: " . $_SERVER['HTTP_REFERER']);
                die();
            }
            break;
        case 'logout':
            setcookie("hash", '', time() - 3600, '/');
            session_regenerate_id();
            session_destroy();
            header("Location: /");
            die();
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
            if (!empty($_FILES)) {
                $message = uploadGallery();
                header("Location: gallery/?status=" . $message);
            }
            $params['files'] = getGallery();
            $params['layout'] = 'gallery_layout'; // другой главный шаблон галереи
            $messages = [
                'ok' => 'Файл загружен',
                'error' => 'Ошибка загрузки',
                'error_php' => 'Загрузка php-файлов запрещена!',
                'error_not_jpg' => 'Можно загружать только jpg-файлы, неверное содержание файла, не изображение.'
            ];

            $params['message'] = $messages[$_GET['status']];
            break;

        case 'oneimage':
            $id = (int)$_GET['id'];
            addViews($id); // счетчик просмотров
            $params['files'] = getOneImage($id);
            $params['layout'] = 'gallery_layout';
            break;

        case 'catalog':
            $session_id = session_id();

            $params['title'] = "Каталог";
            $params['catalog'] = getCatalog();
            $params['countCartItems'] = countCartProducts($session_id);

            if ($action == "add") {
                $id = (int)$_POST['id'];
                addToCart($id, $session_id); // добавляем с учетом количества товара
                header("Location: /catalog/");
                die();
            }

            break;

        case 'cart': //Корзина
            $session_id = session_id();
            $params['title'] = "Корзина";
            $params['cart'] = getCart($session_id);
            $params['total'] = totalPrice($session_id);
            $params['countCartItems'] = countCartProducts($session_id);
            // если заказ отправлен
            if(isset($_SESSION['message']['order'])){
                $params['message_order'] = $_SESSION['message']['order'];
                unset($_SESSION['message']['order']);
            }


            if ($action == "del"){
                $cart_id = (int)$_POST['id']; //id уникальной записи в корзине
                deleteFromCart($cart_id);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                die();
            }

            break;

        case 'order':
            $session_id = session_id();

            if (isset($_POST['order_ok'])){
                $order_params = ['name' => $_POST['order_name'], 'phone' =>$_POST['phone']];
                addOrder($session_id, $order_params);
                session_regenerate_id(); // пользователя ждет новая корзина
                $_SESSION['message']['order'] = "Заказ отправлен. Ожидайте звонка";
                header("Location: /cart/");
            }
            break;

        case 'product':
            $product_id = (int)$_GET['id'];
            $params['product'] = getProduct($product_id);
            if(isset($_SESSION['message'])){
                $params['message'] = $_SESSION['message'];
                unset($_SESSION['message']);
            }

            $params['feedback'] = getALLFeedback($product_id);
            //$params['message'] = $messages[$_GET['message']];

            if ($_POST["id"]){
                $id = (int)$_POST['id'];
            } else {
                $id = (int)$_GET['feedback_id'];
                if($action == "add"){
                    $id = $product_id;
                }
            }

            $params['fields'] = doFeedBackAction($action, $id);

            if (in_array($action,["add", "save", "delete"])) {

                //header("Location: /product/?id={$product_id}&message=" . doFeedBackAction($action, $id));
                header("Location: /product/?id=" . $product_id);

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
            if(isset($_SESSION['message'])){
                $params['message'] = $_SESSION['message'];
                unset($_SESSION['message']);
            }

            $params['feedback'] = getALLFeedback();


            if ($_POST["id"]){
                $id = (int)$_POST['id'];
            } else {
                $id = (int)$_GET['id'];
            }

            if($_POST["feedback_id"]){
                $id = (int)$_POST['feedback_id'];
            }

            if ($action == "edit") {
                $params['fields'] = doFeedBackAction($action, $id);
            }

            if (in_array($action,["add", "save", "delete"])) {
                doFeedBackAction($action, $id);
                header("Location: /feedback/");
            }
            break;
    }
    return $params;

}