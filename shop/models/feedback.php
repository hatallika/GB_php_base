<?php
function getALLFeedback($id=0) {
    $sql = "SELECT id, name, feedback FROM feedback WHERE product_id = {$id} ORDER BY id DESC";
    return getAssocResult($sql);
}

function addFeedBack($id) {

    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['message'])));

    $sql = "INSERT INTO feedback (name, feedback, product_id) VALUES ('{$name}','{$feedback}', '{$id}')";
    executeSql($sql);
}

function deleteFeedBack($id){
    //$id = (int)$_GET['id'];
    $sql = "DELETE FROM feedback WHERE id = " . $id;
    executeSql($sql);
}

function editFeedBack($id){
    //$id = (int)$_GET['id'];
    $sql = "SELECT id, name, feedback FROM feedback WHERE id = " . $id;
    return getOneResult($sql);
}

function saveFeedBack($id){

    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['message'])));

    $sql = "UPDATE feedback SET name = '{$name}', feedback = '{$feedback}' WHERE id = {$id}";
    executeSql($sql);
}

function doFeedBackAction($action, $id=0) {
    switch ($action){
        case 'add':
            addFeedBack($id);
            $_SESSION['message'] = 'Сообщение добавлено!';
            break;

        case 'edit':
            return editFeedback($id);

        case 'save':
            saveFeedback($id);
            $_SESSION['message'] = 'Сообщение изменено';
            break;

        case 'delete':
            deleteFeedback($id);
            $_SESSION['message'] = 'Сообщение удалено';
            break;
    }

}