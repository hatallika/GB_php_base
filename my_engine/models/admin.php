<?php

function getAllOrdersForAdmin(){
    return getAssocResult("SELECT id, name, phone, cart_session_id, status FROM orders ORDER BY id DESC");
}

function changeOrderStatus(){
    $status = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['status'])));
    $id = (int)$_POST['order_id'];


    executeSql("UPDATE orders SET status = '{$status}' WHERE id = {$id}");
    $_SESSION['message_status'.$id] = 'Статус изменен';

}