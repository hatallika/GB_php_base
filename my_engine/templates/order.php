<?php if ($auth): ?>
    <h2>Мои заказы</h2>

    <div class="orders_item">
        <?php if(isset($order)):?>
            Номер заказа: <?=$order[0]['order_id']?><br>
            <h3>Список товаров:</h3>
            <?php foreach ($order as $product):?>
               <h3><?=$product['name']?></h3>
               <img src="/img/<?= $product['image'] ?>" alt="<?=$product['name'] ?>" width="100"><br>
                Количество: <?=$product['quantity']?>
            <?php endforeach;?>
            <br>
            <?=$order_message?><br>
            Контакты:
            <form action="/order/editcontacts/" method="post">
                <input type="text" name="order_id" value="<?=$order[0]['order_id']?>" hidden>
                <input type="text" name="order_name" placeholder="Ваше имя" value="<?=$order[0]['ordername']?>">
                <input type="text" name="phone" placeholder="Ваш номер телефона" value="<?=$order[0]['phone']?>">
                <input type="submit" name="order_change" value="Изменить">
            </form>
        </div>
        <?php else:?>
         Нет такого заказа
        <?php endif;?>

<?php else:?>
Вы не авторизованы, пожалуйста авторизуйтесь!
<?php endif;?>
