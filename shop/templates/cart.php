<h2>Корзина товаров</h2>
<?php foreach ($cart as $value):?>
    <div>
        <form action="/cart/del/" method="post">
            <input type="text" name="id" value="<?=$value['cart_id']?>" hidden>
        <h3><?=$value['name']?></h3>
        <img src="/img/<?= $value['image'] ?>" alt="<?= $value['name'] ?>" width="150"><br>
        Количество <?=$value['quantity']?><br>
        цена: <?=$value['price']?> руб.<br>
            <input type="submit" value="Удалить">
        </form>
    </div>
    <hr>
<?php endforeach; ?>
Количество товаров: <?=$countCartItems['count']?><br>
Сумма товаров <?=$total['summ']?>