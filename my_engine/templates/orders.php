<?php if ($auth): ?>
<h2>Мои заказы</h2>
    <?php foreach ($orders as $items):?>

        <a href="/order/?id=<?=$items['id']?>">Номер заказа: <?=$items['id']?> </a><br>
        <b>Получатель:</b> <?=$items['name']?> <br>
        <b>Контактные данные:</b> <?=$items['phone']?>
        <br>
        <hr>
    <?php endforeach;?>
<?php else:?>
    Вы не авторизованы, пожалуйста авторизуйтесь!
<?php endif;?>
