<?php

?>
<h2>Каталог</h2>

<div>
    <?php foreach ($catalog as $product): ?>
        <div>
            <a href="/product/?id=<?= $product['id'] ?>">
                <h2><?= $product['name'] ?></h2>
                <img src="../img/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="150"><br>
                Цена: <?= $product['price'] ?> <br>
                <button>Купить</button>
                <hr>
            </a>
        </div>
    <?php endforeach;?>
</div>