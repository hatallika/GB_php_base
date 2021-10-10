<h2>Корзина товаров</h2>
<?php foreach ($cart as $value):?>
    <div id="cart_item">

        <h3><?=$value['name']?></h3>
        <img src="/img/<?= $value['image'] ?>" alt="<?= $value['name'] ?>" width="150"><br>
        Количество:
        <!--<button class="addItem" data-id="<?=$cart[0]['id']?>"type="button">+</button>-->
        <form class="qnt" action="/cart/delqnt/" method="post"><input type="text" name="qnt_id" value="<?= $value['product_id'] ?>" hidden>
            <input type="submit"value="-">
        </form>
            <?=$value['quantity']?>
        <form class="qnt" action="/cart/addqnt/" method="post"><input type="text" name="qnt_id" value="<?= $value['product_id'] ?>" hidden>
            <input type="submit"value="+">
        </form>
        <br>

        цена: <?=$value['price']?> руб.<br>
        <form action="/cart/del/" method="post">
            <input type="text" name="id" value="<?=$value['cart_id']?>" hidden>
            <!--<input type="submit" value="Удалить">-->
            <button class="delete" data-id="<?=$value['cart_id']?>">Удалить JS</button>
        </form>
    </div>
    <hr>
<?php endforeach; ?>
<?php if(isset ($countCartItems['count'])): ?>
Количество товаров:  <?=$countCartItems['count']?><br>
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

<script>
    let buttonDelete = document.querySelectorAll('.delete');
    buttonDelete.forEach((elem)=>{
        elem.addEventListener('click',()=>{
            let id = elem.getAttribute('data-id');
            (async ()=>{
                const response = await fetch('/api/delete/?id=' + id);
                const answer = await response.json();
                document.getElementById('item'+id).remove();
                document.getElementById('counter').innerText = answer.counter;
            })();
        })
    })
</script>
