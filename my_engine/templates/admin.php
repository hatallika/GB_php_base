<h2>Заказы</h2>
<div class="orders_admin">
    <?php foreach($orders as $item):?>
        <a href="/order/?id=<?=$item['id']?>">Номер заказа: <?=$item['id']?> </a><br>
        <b>Получатель:</b> <?=$item['name']?> <br>
        <b>Контактные данные:</b> <?=$item['phone']?>

        <br>
        <hr>
    <?endforeach;?>
</div>
