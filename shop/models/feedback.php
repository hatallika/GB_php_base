<?php
function getALLFeedback($id = 0) {
    if ($id != 0) {
        $sql = "SELECT id, name, feedback FROM feedback WHERE product_id = {$id} ORDER BY id DESC";

    } else {
        $sql = "SELECT id, name, feedback FROM feedback ORDER BY id DESC";
    }

    return getAssocResult($sql);
}

function addFeedBack($id) {

    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['message'])));
    if ($id == 0) {
        $sql = "INSERT INTO feedback (name, feedback) VALUES ('{$name}','{$feedback}')";
    } else {
        $sql = "INSERT INTO feedback (name, feedback, product_id) VALUES ('{$name}','{$feedback}', '{$id}')";
    }
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
    $result = getOneResult($sql);
    return $result;
}

function saveFeedBack($id){

    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['message'])));

    $sql = "UPDATE feedback SET name = '{$name}', feedback = '{$feedback}' WHERE id = {$id}";
    executeSql($sql);
}

function doFeedBackAction($action, $id) {

    if ($action == 'add') {
        addFeedBack($id);
        $_SESSION['message'] = 'Сообщение добавлено!';
        return 'ok';
    }

    if ($action == 'edit') {
        return editFeedback($id);
    }

    if ($action == 'save') {
        saveFeedback($id);
        $_SESSION['message'] = 'Сообщение изменено';
        return 'save';
    }
    if ($action == 'delete') {
        deleteFeedback($id);
        $_SESSION['message'] = 'Сообщение удалено';
        return 'delete';
    }
}