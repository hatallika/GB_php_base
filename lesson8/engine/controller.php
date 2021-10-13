<?php
//Контроллер
function prepareVariables($page, $action=""){
    //Controller
    global $menuItems;
   /*$params = [
        'menu' => $menuItems,
        'counter' => getBasketCount(),
        'layout' => 'main',
        'auth' => isAuth(),
        'name' => get_user(),
    ];*/
    $params['menu'] = $menuItems;
    $params['counter'] = getBasketCount();
    $params['layout'] = 'main';
    $params['auth'] = isAuth();
    $params['name'] = get_user();

    switch ($page) {
        case 'api':
            if ($action =='addlike'){
                addLikeGood($_GET['id']);
                $likes = getGoodLikes($_GET['id']);
                echo json_encode(['likes' => $likes]);
                die();
            }

            if ($action =='buy'){
                addToCart($_GET['id']);
                echo json_encode(['counter' => getBasketCount()]);
                die();
            }
            if ($action == 'delete'){
                $session_id= session_id();
                deleteFromCart($_GET['id']);
                echo json_encode(['counter' => getBasketCount(),'countCartItems' => getBasketCount(),'totalPrice' => totalPrice($session_id)]);
                die();
            }
            if($action == 'addqnt'){
                $session_id = session_id();
                addOneItem($session_id,$_GET['id']);
                echo json_encode(['quantity' => getQntValue($_GET['id']),'countCartItems' => getBasketCount(),
                    'totalPrice' => totalPrice($session_id)]);
                die();
            }

            if($action == 'delqnt'){
                $session_id = session_id();
                deleteOneItem($session_id,$_GET['id']);
                echo json_encode(['quantity' => getQntValue($_GET['id']),'countCartItems' => getBasketCount(),
                    'totalPrice' => totalPrice($session_id)]);
                die();
            }
            break;

        case 'admin':

            if(!is_admin()){
                die("Доступ запрещен");
            }
            if($action == 'changestatus'){
                changeOrderStatus();

                header("Location: /admin/" );
                die();
            }

            $params['orders'] = getAllOrdersForAdmin();
            $params['message_status'] = getSessionMessage('message_status');

            break;

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
            } else {
                $_SESSION['message']['login'] = 'Не верный логин и пароль';
            }
            header("Location: " . $_SERVER['HTTP_REFERER']);
            die();
            break;

        case 'logout':
            setcookie("hash", '', time() - 3600, '/');
            session_regenerate_id();
            session_destroy();
            header("Location: /");
            die();
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

            $params['message'] = $messages[$_GET['status']]??"";
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
                addToCart($id); // добавляем с учетом количества товара
                header("Location: /catalog/");
                die();
            }


            break;

        case 'cart': //Корзина
            $session_id = session_id();
            $params['title'] = "Корзина";
            $params['cart'] = getCart($session_id); //получение элементов корзины
            $params['total'] = totalPrice($session_id);
            $params['countCartItems'] = countCartProducts($session_id);
            // сообщение если заказ отправлен
            $params['message_order_sent'] = getSessionMessage('message_order_sent');

            if ($action == "del"){
                $cart_id = (int)$_POST['id']; //id уникальной записи в корзине
                deleteFromCart($cart_id);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                die();
            }

            if($action == "delqnt"){
                $product_id = (int)$_POST['qnt_id'];
                deleteOneItem($session_id,$product_id );
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                die();
            }

            if($action == "addqnt"){
                $product_id = (int)$_POST['qnt_id'];
                addOneItem($session_id, $product_id);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                die();
            }
            break;

        case 'order':
            $session_id = session_id();
            $params['order_message'] = getSessionMessage('order_message');

            if (isset($_POST['order_ok'])){
                $order_params = ['name' => $_POST['order_name'], 'phone' =>$_POST['phone']];
                addOrder($session_id, $order_params);
                session_regenerate_id(); // пользователя ждет новая корзина
                $_SESSION['message_order_sent'] = "Заказ отправлен. Ожидайте звонка";
                header("Location: /cart/");
            }
            if ($action == 'editcontacts'){
                changeOrderContacts();
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            if (isset($_GET['id'])){
                $params['order_id'] = (int)$_GET['id'];
                $params['order'] = getOrderDetails($_GET['id']);
            }

            break;

        case 'orders':
            $params['orders'] = getAllorders();
            break;

        case 'product':
            $product_id = (int)$_GET['id'];
            $params['product'] = getProduct($product_id);
            $params['message'] = getSessionMessage('message');

            $params['product_id'] = $product_id;
            doFeedBackAction($params, $action);

            $params['result_feedback'] = getALLFeedback($product_id);

            if (in_array($action,["add", "save", "delete"])) {
                if (empty($_GET['id'])) {
                    $product_id = $_POST['id_product'];
                }
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

        case 'setup':
            $params['title'] = "Загрузка из папки";
            if($_GET['upload'] == 'ok'){
                uploadImageToDB();
            }
            break;

        case 'feedback':
            doFeedBackAction($params, $action);
            $params['feedback'] = getALLFeedback(0);
            $params['message'] = getSessionMessage('message')??"";
            break;

        case 'feedback2':
            $params['feedback'] = getALLFeedback();
            break;

        case 'feedbackapi';
        doApiFeedbackAction($action);
        break;
    }
    return $params;

}