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
    //TODO оптимизировать проверку если пользователь уже авторизован по сессии (проверить ссесию прежде чем использовать coocies)

    if(isset($_COOKIE['hash']) && !isset($_SESSION['login'])){
        $hash = $_COOKIE['hash'];
        $sql = "SELECT * FROM users WHERE hash = '{$hash}'";
        $result = mysqli_query(getDb(), $sql);
        if($result) {
            $row = mysqli_fetch_assoc($result);
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
    $id = $_SESSION['id'];
    $sql = "UPDATE users SET hash = '{$hash}' WHERE users.id = {$id}";
    $result = mysqli_query(getDb(), $sql);
    setcookie("hash", $hash, time() + 36000, '/');
}

function auth($login, $pass){
    $login = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($login)));
    $result = mysqli_query(getDb(), "SELECT * FROM users WHERE login = '{$login}'");
    if($result){
        $row = mysqli_fetch_assoc($result);

        if (password_verify($pass,$row['pass'])){
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $row['id'];
            return true;
        }
    }
    return false;
}