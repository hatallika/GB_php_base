<?php

?>
<h2><?= $product['name'] ?></h2>


<div>
    <img src="../img/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="150"><br>
    Цена: <?= $product['price'] ?> <br>
    Описание: <?= $product['description'] ?><br>
    <button>Купить</button>
    <hr>
    <h3>Отзывы о товаре:</h3>

    <?=$message?>
    <form action="/product/<?php if ($fields): ?>save<? else: ?>add<? endif; ?>/?id=<?=(int)$_GET['id'] ?>" method="post">
        Оставьте отзыв: <br>
        <input type="text" name="id" value="<?=$fields['id']?>" hidden><br>
        <input type="text" name="name" value="<?=$fields['name']?>"><br>
        <input type="text" name="message" value="<?=$fields['feedback']?>"> <br>
        <input type="submit" value="<? if ($fields): ?>Редактировать<? else: ?>Добавить<? endif; ?>">
    </form>
    <?php foreach ($feedback as $value):?>
        <div>
            <strong><?=$value['name']?></strong>: <?=$value['feedback']?>
            <a href="../product/edit/?id=<?= (int)$_GET['id'] ?>&feedback_id=<?=$value['id']?>">[edit]</a>
            <a href="../product/delete/?id=<?= (int)$_GET['id'] ?>&feedback_id=<?=$value['id']?>">[x]</a><br>
        </div>
    <?php endforeach; ?>

</div>

