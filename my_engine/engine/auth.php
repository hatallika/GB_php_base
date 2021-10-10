<?php

function getMessageAuth(){

    if (isset($_SESSION['message']['login'])) {
        $message = $_SESSION['message']['login'];
        unset($_SESSION['message']['login']);
    }
    return $message;
}

function get_user()
{
    return $_SESSION['login'];
}

function isAuth(){ // авторизован ли кто-то

    if(isset($_COOKIE['hash']) && !isset($_SESSION['login'])){
        $hash = $_COOKIE['hash'];
        $sql = "SELECT * FROM users WHERE hash = '{$hash}'";
        $row = getOneResult($sql);
        if($row) {
            $user = $row['login'];
            if (!empty($user)){
                $_SESSION['login'] = $user;
                $_SESSION['id'] = $row['id'];
            }
        }
    }
    return isset($_SESSION['login']);
}

function updateHash(){
    $hash = uniqid(rand(), true);
    $id = (int)$_SESSION['id'];
    $sql = "UPDATE users SET hash = '{$hash}' WHERE users.id = {$id}";
    executeSql($sql);
    setcookie("hash", $hash, time() + 36000, '/');
}

//проверка логина и пароля
function auth($login, $pass){
    $login = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($login)));
    $passDB = getOneResult("SELECT * FROM users WHERE login = '{$login}'");
    if (password_verify($pass,$passDB['pass'])){
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $passDB['id'];
        return true;
    }

    return false;
}