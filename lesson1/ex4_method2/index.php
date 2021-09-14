<?php
//Второй способ генерации страницы используя шаблон HTML через include

const URL_IMG = "./images/";
$title = "Главная страница - страница обо мне";
$header = "Информация обо мне";
$current_year = date ( 'Y');
include "./templates/site.php";


