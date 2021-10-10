<?php
function getCatalog()
{
    return getAssocResult("SELECT id, name, price, image, description, likes FROM products");
}

function getProduct($id)
{
    return getOneResult("SELECT id, name, price, image, description FROM products WHERE id = {$id}");
}

function countCartProducts ($session_id){
    return getOneResult("SELECT SUM(quantity) as count FROM cart WHERE session_id = '{$session_id}'");
}

function doCartAction($action, $cart_id){};
function addLikeGood ($id) {
    executeSql("UPDATE products SET likes = likes + 1 WHERE id = {$id}");
}
function getGoodLikes ($id) {
    return getOneResult("SELECT likes FROM products WHERE id = {$id}")['likes'];
}
