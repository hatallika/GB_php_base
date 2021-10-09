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
<?php if(isset ($countCartItems['count'])): ?>
Количество товаров: <?=$countCartItems?><br>
Сумма товаров <?=$total['summ']?><br>
<?php else:?>
Корзина пустая <br>
 <a href="/catalog">Перейти в каталог</a> <br>
<?php endif;?>


<?php if(!isset($message_order) && isset($countCartItems['count'])):?>
<form action="/order/" method="post">
    <h3>Оформить заказ</h3>
    <input type="text" name="order_name" placeholder="Ваше имя">
    <input type="text" name="phone" placeholder="Ваш номер телефона">
    <input type="submit" name="order_ok" value="Заказать">
</form>
<?php else:?>
<b><?=$message_order?></b>
    <?php endif;?>