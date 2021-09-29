<?php
function getGallery(){
    //return array_splice(scandir('gallery_img/small'),2);
    dumpBase();
    // получение имен файлов из базы
    return getAssocResult("SELECT id, name FROM images ORDER BY views DESC");
}

function getOneImage($id) {
    return getOneResult("SELECT name FROM images WHERE id =" . $id);
}

//добавить файл в БД
function addImageToDB($arr){
    return executeSql("INSERT INTO images (name, size) VALUES ('{$arr['name']}',{$arr['size']})");
}

//увеличить просмотры
function addViews($id){
    executeSql("UPDATE images SET views = views + 1 WHERE id = ". $id);

}
function getViews($id){
    return getOneResult("SELECT views FROM images WHERE id = ". $id);
}


function uploadGallery(){

    $path = "gallery_img/big/" . $_FILES['myimage']['name']; // TODO привести имена файлов в порядок

    // проверка файла
    $blacklist = array(".php", ".phtml", ".php3", ".php4");
    foreach ($blacklist as $item) {
        if (preg_match("/$item\$/i", $_FILES['myimage']['name'])) {
            $message = "error_php";
            header("Location: gallery/?status=" . $message);
            exit;
        }
    }

    //Проверка на тип файла
    $imageinfo = getimagesize($_FILES['myimage']['tmp_name']);

    if ($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg') {
        $message = "error_not_jpg";
        header("Location: gallery/?status=" . $message);
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

    //Загрузка в БД
    addImageToDB(['name' => $_FILES['myimage']['name'], 'size' => $_FILES['myimage']['size']]);

    header("Location: gallery/?status=" . $message);
    die();
}
