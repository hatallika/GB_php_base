<?php
function getDb() {
    static $db = null; // db не обнулится при следующем запуске.
    if(is_null($db)){
        $db = @mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect: " . mysqli_connect_error());
    }
    return $db;
}
//Функция возвращает данные в виде ассоциативного массива
function getAssocResult($sql) {
    $result = @mysqli_query(getDb(), $sql) or die(mysqli_error(getDb()));
    $array_result = [];
    while($row = mysqli_fetch_assoc($result)){
        $array_result[] = $row;
    }

    return $array_result;
}

//WHERE id = 1 // для запроса одной строки
function getOneResult($sql) {
    $result = @mysqli_query(getDb(), $sql) or die(mysqli_error(getDb()));
    return mysqli_fetch_assoc($result);
}

//Запросы на удаление, вставку, изменение UPDATE, INSERT, DELETE
function executeSql($sql){
    @mysqli_query(getDb(), $sql) or die(mysqli_error(getDb()));
    return mysqli_affected_rows(getDb()); //информация по удалению // сколько
}

//функция для развертывания дампа.
function dumpBase(){
    $db = @mysqli_connect(HOST, USER, PASS, DB)
        or die("Could not connect: " . mysqli_connect_error());
    $result = @mysqli_query($db,"SHOW TABLES FROM " . DB ) or die();

    if(mysqli_num_rows($result) === 0) {
        //Загружаем дамп из папки db
        var_dump(dirname(__DIR__) . "/db/gb1.sql");
        $dump = file_get_contents(dirname(__DIR__) . "/db/gb1.sql");
        $a = 0;
        while ($b = strpos($dump,';', $a + 1)) {
            $a = substr($dump, $a + 1, $b - $a);
            mysqli_query($db, $a);
            $a = $b;
        }
        var_dump("Дамп загружен");
    }
}