<?php
function uploadImageToDB(){
        //загрузка данных об изображениях в таблицу images

        $pathToBig = $_SERVER['DOCUMENT_ROOT'] . '/gallery_img/big';
        $imgName = array_splice(scandir($pathToBig),2);

    //получим массив с именем и размером файлов
        $arraySize = array_map(fn($filename) => ['name' => $filename, 'size' => filesize($pathToBig . "/" . $filename)], $imgName);

    // Подключение к бд
        $db = @mysqli_connect("localhost","test", "12345", "gb1")
        or die('Ошибка: ' . mysqli_connect_error());

    //проверим таблицу на пустоту
        $a = mysqli_query($db,"SELECT COUNT(id) as count FROM images");
        $b = mysqli_fetch_assoc( $a );


        if ($b['count'] == 0) {
            //сформируем SQL запрос из полученных данных
            $insert_sql = "INSERT INTO images (name, size) VALUES ";
            foreach ($arraySize as $image){
                $insert_sql .= "('{$image['name']}', {$image['size']}), ";
            }
            $insert_sql = substr($insert_sql,0,-2); // удалим последний пробел и запятую из запроса


    //выполним запрос
            $result = mysqli_query($db, $insert_sql) or die("Ошибка запроса");
            if ($result) {
                echo "Загружено " . mysqli_affected_rows($db) . " строк.";
            }
        } else {
            echo "В таблице images уже есть данные изображений";
        }

}




