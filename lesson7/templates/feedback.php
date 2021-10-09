<?php
?>
<h2>Отзывы</h2>
<?=$message?>
<form action="/feedback/<?=$action?>/" method="post">
    Оставьте отзыв: <br>
    <input type="text" name="id_feedback" value="<?=$id_feed?>" hidden><br>
    <input type="text" name="name" value="<?=$name?>"><br>
    <input type="text" name="message" value="<?=$text?>"> <br>
    <input type="submit" value="<?=$button?>">
</form>
<?php foreach ($feedback as $value):?>
<div>
    <strong><?=$value['name']?></strong>: <?=$value['feedback']?>
    <a href="../feedback/edit/?id_feed=<?=$value['id']?>">[edit]</a>
    <a href="../feedback/delete/?id_feed=<?=$value['id']?>">[x]</a><br>
</div>
<?php endforeach; ?>
