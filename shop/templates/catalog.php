<?php

?>
<h2>Каталог</h2>
<div><a href="/cart/">Корзина (<?=$countCartItems['count']?>)</a></div>
<div>
    <?php foreach ($catalog as $product): ?>
        <form action="/catalog/add/" method="post">
        <div>
            <input type="text" name="id" value="<?= $product['id'] ?>" hidden>
            <a href="/product/?id=<?= $product['id'] ?>">
                <h2><?= $product['name'] ?></h2>
                <img src="/img/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="150"><br>
                Цена: <?= $product['price'] ?> <br>
                <input type="submit" value="Купить">
        </form>
                <hr>
            </a>
        </div>
    <?php endforeach;?>
</div>