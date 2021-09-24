<div class="post_title"><h2>Моя галерея</h2></div>
    <div class="gallery">
        <?php foreach($files as $img):?>
            <a rel="gallery" class="photo" href="/gallery_img/big/<?=$img?>"><img src="gallery_img/small/<?=$img?>" width="150" height="100" /></a>
        <?php endforeach;?>

        <p class="status">
            Добавить изображение в галерею <br><?=$message?></p>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="myimage">
            <input type="submit" value="Загрузить">
        </form>
    </div>


