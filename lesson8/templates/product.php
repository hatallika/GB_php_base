<?php

?>
<h2><?= $product['name'] ?></h2>


<div>
    <form action="/catalog/add/" method="post">
        <input type="text" name="id" value="<?= $product['id'] ?>" hidden>
        <img src="/img/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="150"><br>
        Цена: <?= $product['price'] ?> <br>
        Описание: <?= $product['description'] ?><br>
        <input type="submit" value="Купить">
    </form>
    <hr>
    <h3>Отзывы о товаре:</h3>


    <?=$message?><br>
    <form method="post" action="/product/<?=$action?>/">
        <input type="text" name="id_product" value="<?=$product_id?>" hidden>
        <input type="text" name="id_feedback" value="<?=$id_feed?>" hidden>
        <input type="text" name="name" value="<?=$name?>"><br>
        <input type="text" name="message" value="<?=$text?>"><br>
        <input type="submit" name="ok" value="<?=$button?>">
    </form><hr>
    <div>
        <?php foreach ($result_feedback as $value):?>
            <b><?=$value['name']?> :</b> <?=$value['feedback']?>
            <a href="../product/edit/?id=<?=$product_id?>&id_feed=<?=$value['id']?>">[edit]</a>
            <a href="../product/delete/?id=<?=$product_id?>&id_feed=<?=$value['id']?>">[x]</a><br>
        <?php endforeach;?>
    </div>