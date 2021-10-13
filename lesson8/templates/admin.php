<h2>Заказы</h2>
<div class="orders_admin">
    <?php foreach($orders as $item):?>
        <a href="/order/?id=<?=$item['id']?>">Номер заказа: <?=$item['id']?> </a><br>
        <b>Получатель:</b> <?=$item['name']?> <br>
        <b>Контактные данные:</b> <?=$item['phone']?><br>
        <b>Статус заказа:</b>
        <?=$_SESSION['message_status'.$item['id']]?>
        <form action="/admin/changestatus/" method="post">
            <input type="text" name="order_id" value="<?=$item['id']?>" hidden>
            <select name="status">
                <option value="processing"<?php if ($item['status'] == 'processing') echo 'selected';?>>processing</option>
                <option value="complete" <?php if ($item['status'] == 'complete') echo 'selected';?>>complete</option>
                <option value="cancel" <?php if ($item['status'] == 'cancel') echo 'selected';?>>cancel</option>
                <option value="waiting" <?php if ($item['status'] == 'waiting') echo 'selected';?>>waiting</option>
            </select>
            <input type="submit" name="change" value="Изменить">
        </form>
        <?php unset($_SESSION['message_status'.$item['id']]);?>
        <hr>
    <?endforeach;?>
</div>
