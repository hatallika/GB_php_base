<?php
include "../engine/classSimpleImage.php";
$messages = [
'ok' => 'Файл загружен',
'error' => 'Ошибка загрузки'
];
//var_dump($_FILES);
if(!empty($_FILES)) {
    $path = "gallery_img/big/" . $_FILES['myimage']['name']; // по хорошему привести имена файлов в порядок

    // проверка файла функциями из upload.php материала курса

    if (move_uploaded_file($_FILES['myimage']['tmp_name'], $path)) { // данная функция вернет true || false
        $message = "ok";

        //ресайз изображения через библиотеку
        $image = new SimpleImage();
        $image->load($path);
        $image->resizeToWidth(150);
        $image->save('gallery_img/small/'. $_FILES['myimage']['name']);
    } else {
        $message = "error";
    }
    header("Location: ?page=gallery&status=" . $message);
    die();
}
$message = $messages[$_GET['status']];

?>
<div id="main">
    <div class="post_title"><h2>Моя галерея</h2></div>
    <div class="gallery">
        <?php foreach($files as $img):?>
            <a href="/gallery_img/big/<?=$img?>"><img src="gallery_img/small/<?=$img?>" width="150" height="100" /></a>
        <?php endforeach;?>

        <p class="status">
            Добавить изображение в галерею <?=$message?></p>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="myimage">
            <input type="submit" value="Загрузить">
        </form>


    </div>
</div>


