<?php
include "../engine/classSimpleImage.php";
$messages = [
'ok' => 'Файл загружен',
'error' => 'Ошибка загрузки'
];
//var_dump($_FILES);
if(!empty($_FILES)) {
    $path = "gallery_img/big/" . $_FILES['myimage']['name']; // TODO привести имена файлов в порядок

    // проверка файла
    $blacklist = array(".php", ".phtml", ".php3", ".php4");
    foreach ($blacklist as $item) {
        if(preg_match("/$item\$/i", $_FILES['myimage']['name'])) {
            echo "Загрузка php-файлов запрещена!";
            exit;
        }
    }

    //Проверка на тип файла
    $imageinfo = getimagesize($_FILES['myimage']['tmp_name']);
    if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg') {
        echo "Можно загружать только jpg-файлы, неверное содержание файла, не изображение.";
        exit;
    }

    //загрузка в нужную директорию
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

    <div class="post_title"><h2>Моя галерея</h2></div>
    <div class="gallery">
        <?php foreach($files as $img):?>
            <a rel="gallery" class="photo" href="/gallery_img/big/<?=$img?>"><img src="gallery_img/small/<?=$img?>" width="150" height="100" /></a>
        <?php endforeach;?>

        <p class="status">
            Добавить изображение в галерею <?=$message?></p>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="myimage">
            <input type="submit" value="Загрузить">
        </form>


    </div>


