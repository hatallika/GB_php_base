<?php

function getSessionMessage($varname){
    if(isset($_SESSION[$varname])){
        $message = $_SESSION[$varname];
        unset($_SESSION[$varname]);
        return $message;
    }
}

function autoIncludeFromDir($path){
    $files = array_splice(scandir($path),2);
    foreach ($files as $file){
       include $path . $file;
    }
}