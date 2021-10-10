<?php
function addOrder($session_id, $params){
    if (isAuth()){
        $login = get_user();
        $user_id = getOneResult("SELECT id FROM users WHERE login = '{$login}'")['id'];
        executeSql("INSERT INTO orders (name, phone, cart_session_id, user_id) VALUES ('{$params['name']}','{$params['phone']}', '{$session_id}', {$user_id})");
    } else {
        executeSql("INSERT INTO orders (name, phone, cart_session_id) VALUES ('{$params['name']}','{$params['phone']}', '{$session_id}')");
    }
}

function getAllOrders(){
    $login = get_user();
        return getAssocResult("SELECT orders.id as id, name, phone, cart_session_id
                    FROM orders, users WHERE orders.user_id = users.id AND login = '{$login}'");
}

function getOrderDetails($id){
    $id = (int)$id;
    $session = getOneResult("SELECT cart_session_id as session FROM orders WHERE id={$id}")['session'];
    return  getCartFromOrder($session);
}

function getCartFromOrder($session){
    return getAssocResult("SELECT c.id as cart_id, c.product_id, p.name, p.price, p.image , c.quantity,
       o.id as order_id, o.name ordername, o.phone 
                        FROM products p JOIN cart c 
                        ON c.product_id = p.id AND c.session_id = '{$session}'
                        JOIN orders o ON c.session_id = o.cart_session_id");
}

function changeOrderContacts(){
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['order_name'])));
    $phone = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['phone'])));
    $id = (int)$_POST['order_id'];
    executeSql("UPDATE orders SET name = '{$name}', phone = '{$phone}' WHERE id = {$id}");
    $_SESSION['order_message'] = 'Контактные данные изменены';
};

