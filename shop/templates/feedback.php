<?php
?>
<h2>Отзывы</h2>
<?=$message?>
<form action="/feedback/<?php if ($fields): ?>save<? else: ?>add<? endif; ?>/" method="post">
    Оставьте отзыв: <br>
    <input type="text" name="feedback_id" value="<?=$fields['id']?>" hidden><br>
    <input type="text" name="name" value="<?=$fields['name']?>"><br>
    <input type="text" name="message" value="<?=$fields['feedback']?>"> <br>
    <input type="submit" value="<? if ($fields): ?>Редактировать<? else: ?>Добавить<? endif; ?>">
</form>
<?php foreach ($feedback as $value):?>
<div>
    <strong><?=$value['name']?></strong>: <?=$value['feedback']?>
    <a href="../feedback/edit/?id=<?=$value['id']?>">[edit]</a>
    <a href="../feedback/delete/?id=<?=$value['id']?>">[x]</a><br>
</div>
<?php endforeach; ?>
