<?php
$db = mysqli_connect("localhost", "test", "12345", "gb1");
$message = "";
$buttonText = "Добавить";
$action = "add";
$row = [];

$messages = [
    'ok' => 'Сообщение добавлено',
    'delete' => 'Сообщение удалено',
    'edit' => 'Сообщение изменено',
    'error' => 'Ошибка'
];
//INSERT (CRUD)
if ($_GET['action'] == 'add') {
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback'])));
    $sql = "INSERT INTO feedback (name, feedback) VALUES ('{$name}','{$feedback}')";
    mysqli_query($db, $sql);
    header("Location: /?message=ok");
    die();
}
//DELETE (CRUD)
if ($_GET['action'] == 'delete') {
    $id = (int)$_GET['id'];
    mysqli_query($db, "DELETE FROM feedback WHERE id = " . $id);
    header("Location: /?message=delete");
}

//UPDATE (CRUD) 2 STEP ( EDIT and SAVE VALUES IN INPUT)
if ($_GET['action'] == 'edit') {
    $id = (int)$_GET['id'];
    $sql = "SELECT id, name, feedback FROM feedback WHERE id = " . $id;
    $result = mysqli_query($db, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
    }
    $buttonText = "Править";
    $action = "save";
}

if ($_GET['action'] == 'save') {
    $id = (int)$_POST['id'];
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback'])));
    $sql = "UPDATE feedback SET name = '{$name}', feedback = '{$feedback}' WHERE id = {$id}";
    mysqli_query($db, $sql);
    header("Location: /?message=edit");
}


//READ (CRUD)
$feedbacks = mysqli_query($db,"SELECT id, name, feedback FROM feedback ORDER BY id DESC");



if (isset($_GET['message'])) {
    $message = $messages[$_GET['message']];
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h2>Отзывы</h2>
<?=$message?><br>
<form action="?action=<?=$action?>" method="post">
    <input type="text" name="id" value="<?=$row['id']?>" hidden><br>
    <input type="text" name="name" value="<?=$row['name']?>"><br>
    <input type="text" name="feedback" value="<?=$row['feedback']?>"><br>
    <input type="submit" value="<?=$buttonText?>">
    <hr>
</form>
<div>
    <?php foreach ($feedbacks as $feedback):?>
    <b><?=$feedback['name']?>:</b> <?=$feedback['feedback']?>
        <a href="?action=edit&id=<?=$feedback['id']?>">[edit]</a>
        <a href="?action=delete&id=<?=$feedback['id']?>">[x]</a><br>
    <?php endforeach; ?>
</div>
</body>
</html>
