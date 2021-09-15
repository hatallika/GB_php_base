<?php
//Первый способ генерации страницы используя шаблон HTML в одном файле

const URL_IMG = "./images/";
$image1 = "img1.jpg"; $image2 = "img2.jpg";
$title = "Главная страница - страница обо мне";
$header = "Информация обо мне";
$current_year = date('Y');
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<h1><?=$header?></h1>
Краткая биография обо мне
Родился в 1985 году в городе Москва. Закончил в 2008 году МАИ.
На данный момент работаю ведущим инженером в крупной авиакомпании.
Поскольку я люблю авиацию, то хотел бы поделиться несколькими интересными
фотографиями на эту тему
<br><br>
<div>
    <img src = "<?=URL_IMG . $image1?>" height="120">
    <img src = "<?=URL_IMG . $image2?>" height="120">
</div>
<br><br>
<br><br>
<b>Просто пример жирного текста</b>
<br><br>
<?=$current_year?> г.
</body>
</html>
