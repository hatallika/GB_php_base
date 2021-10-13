<h2>Корзина товаров</h2>
<?php if (!empty($cart)):?>
    <?php foreach ($cart as $value):?>
        <div id="item<?=$value['product_id']?>">

            <h3><?=$value['name']?></h3>
            <img src="/img/<?= $value['image'] ?>" alt="<?= $value['name'] ?>" width="150"><br>
            Количество:
            <button class="addqnt" data-id="<?=$value['product_id']?>">+ JS</button>
           <!-- <form class="qnt" action="/cart/delqnt/" method="post"><input type="text" name="qnt_id" value="<?= $value['product_id'] ?>" hidden>
                <input type="submit"value="-">
            </form>-->
                <span id="qnt<?=$value['product_id']?>"><?=$value['quantity']?></span>
            <button class="delqnt" data-id="<?=$value['product_id']?>">- JS</button>
            <!--<form class="qnt" action="/cart/addqnt/" method="post"><input type="text" name="qnt_id" value="<?= $value['product_id'] ?>" hidden>
                <input type="submit"value="+">
            </form>-->
            <br>

            цена: <?=$value['price']?> руб.<br>
            <!-- <form action="/cart/del/" method="post">
                <input type="text" name="id" value="<?=$value['cart_id']?>" hidden>
                <input type="submit" value="Удалить">
            </form>-->
            <button class="delete" data-id="<?=$value['product_id']?>">Удалить JS</button>
            <hr>
        </div>

    <?php endforeach; ?>
<?php else:?>
    Корзина пустая <br>
    <a href="/catalog/">Перейти в каталог</a> <br>
<?php endif;?>

<div id="total">
    <?php if(isset ($countCartItems['count'])): ?>
    Количество товаров:  <span id="countCartItems"><?=$countCartItems['count']?></span><br>
        Сумма товаров <span id="totalPrice"><?=$total['summ']?></span><br>
    <?php endif;?>
</div>
<?php if(!isset($message_order_sent) && isset($countCartItems['count'])):?>
<form action="/order/" method="post">
    <h3>Оформить заказ</h3>
    <input type="text" name="order_name" placeholder="Ваше имя">
    <input type="text" name="phone" placeholder="Ваш номер телефона">
    <input type="submit" name="order_ok" value="Заказать">
</form>
<?php else:?>
<b><?=$message_order_sent?></b>
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

                if (answer.countCartItems == null) {
                    document.getElementById('total').remove();
                } else {
                    document.getElementById('countCartItems').innerText = answer.countCartItems;
                    document.getElementById('totalPrice').innerText = answer.totalPrice['summ'];

                }


            })();
        })
    })


    let buttonAddQnt = document.querySelectorAll('.addqnt');
    buttonAddQnt.forEach((elem)=>{
        elem.addEventListener('click',()=>{
            let id = elem.getAttribute('data-id');
            (async ()=>{
                const response = await fetch('/api/addqnt/?id=' + id);
                const answer = await response.json();
                //document.getElementById('item'+id).remove();
                document.getElementById('qnt'+id).innerText = answer.quantity;
                document.getElementById('countCartItems').innerText = answer.countCartItems;
                document.getElementById('totalPrice').innerText = answer.totalPrice['summ'];
            })();
        })
    })

    let buttonDelQnt = document.querySelectorAll('.delqnt');
    buttonDelQnt.forEach((elem)=>{
        elem.addEventListener('click',()=>{
            let id = elem.getAttribute('data-id');
            (async ()=>{
                const response = await fetch('/api/delqnt/?id=' + id);
                const answer = await response.json();
                if (answer.quantity == null){
                    document.getElementById('item'+id).remove();
                } else {
                    document.getElementById('qnt'+id).innerText = answer.quantity;
                }

                if (answer.countCartItems == null) {
                    document.getElementById('total').remove();
                } else {
                    document.getElementById('countCartItems').innerText = answer.countCartItems;
                    document.getElementById('totalPrice').innerText = answer.totalPrice['summ'];
                }



            })();
        })
    })
</script>
