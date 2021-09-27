<h2>Новости</h2>
<?php foreach ($news as $item):?>
    <div>
        <a href="/onenews/?id=<?=$item['id']?>"><h3><?=$item['title']?></h3></a>
    </div>
<?php endforeach;?>
