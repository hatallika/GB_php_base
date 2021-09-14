<?php
//Третий способ генерации страницы используя шаблон HTML через пассивный шаблон

const URL_IMG = "./images/";
$title = "Главная страница - страница обо мне";
$header = "Информация обо мне";
$current_year = date ( 'Y');

$content = file_get_contents("./templates/site.html");
$content = str_replace("{{ title }}", $title, $content);
$content = str_replace("{{ header }}", $header, $content);
$content = str_replace("{{ URL_IMG }}", URL_IMG, $content);
$content = str_replace("{{ current_year }}", $current_year, $content);

echo $content;


