<div class="post_title">
    <h2>Моя галерея</h2>
</div>
    <div class="gallery">
        <?php foreach($files as $img):?>
            <a rel="gallery" class="photo" href="/oneimage/?id=<?=$img['id']?>">
                <img src="/gallery_img/small/<?=$img['name']?>" width="150" /></a><?=$img['views']?>
        <?php endforeach;?>

        <p class="status">
            Добавить изображение в галерею <br><?=$message?></p>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="myimage">
            <input type="submit" value="Загрузить">
        </form>
    </div>



