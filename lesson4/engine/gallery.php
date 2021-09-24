<?php
function getGallery(){
    return array_splice(scandir('gallery_img/small'),2);
}

function uploadGallery(){
    include "../engine/lib/classSimpleImage.php";// библиотека ресайза
    $path = "gallery_img/big/" . $_FILES['myimage']['name']; // TODO привести имена файлов в порядок

    // проверка файла
    $blacklist = array(".php", ".phtml", ".php3", ".php4");
    foreach ($blacklist as $item) {
        if (preg_match("/$item\$/i", $_FILES['myimage']['name'])) {
            echo "Загрузка php-файлов запрещена!";
            exit;
        }
    }

    //Проверка на тип файла
    $imageinfo = getimagesize($_FILES['myimage']['tmp_name']);
    if ($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg') {
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
        $image->save('gallery_img/small/' . $_FILES['myimage']['name']);
    } else {
        $message = "error";
    }
    header("Location: ?page=gallery&status=" . $message);
    die();
}



