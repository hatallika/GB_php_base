<?php
function getCatalog()
{
    return getAssocResult("SELECT id, name, price, image, description FROM products");
}

function getProduct($id)
{
    return getOneResult("SELECT id, name, price, image, description FROM products WHERE id = {$id}");
}