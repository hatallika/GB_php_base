<?php
function getALLFeedback($id) {
    $sql = "SELECT id, name, feedback FROM feedback WHERE product_id = {$id} ORDER BY id DESC";
    return getAssocResult($sql);
}

function addFeedBack($name, $feedback, $id_product) {
    $id_product = (int)$id_product;
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $name)));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $feedback)));

    $sql = "INSERT INTO feedback (name, feedback, product_id) VALUES ('{$name}','{$feedback}', {$id_product})";
    executeSql($sql);
    return mysqli_insert_id(getDb());
}

function deleteFeedBack($id_feed){
    $id_feed = (int)$id_feed;
    $sql = "DELETE FROM feedback WHERE id = " . $id_feed;
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

function doFeedBackAction(&$params, $action) {
    $params['name'] = '';
    $params['text'] = '';
    $params['button'] = '';
    $params['action'] = 'add';
    $params['id_feed'] = '';
    $params['button'] = 'Добавить';

    switch ($action){
        case 'add':
            addFeedBack($_POST['name'], $_POST['message'], $_POST['id_product']);
            $_SESSION['message'] = 'Сообщение добавлено!';
            //header("Location: /feedback/?message=ok");
            break;

        case 'edit':
            $id_feed = (int)$_GET['id_feed'];
            $result_feedback = getAssocResult("SELECT * FROM feedback WHERE id = {$id_feed}");
            $params['name'] = $result_feedback[0]['name'];
            $params['text'] = $result_feedback[0]['feedback'];
            $params['action'] = 'save';
            $params['id_feed'] = $id_feed;
            $params['button'] = 'Править';
            break;

        case 'save':
            $id_feed = (int)$_POST['id_feedback'];
            saveFeedback($id_feed);
            $_SESSION['message'] = 'Сообщение изменено';
            //header("Location: /feedback/?message=edit");
            break;

        case 'delete':
            deleteFeedback($_GET['id_feed']);
            $_SESSION['message'] = 'Сообщение удалено';
            //header("Location: /feedback/?message=delete");
            break;
    }

    function doApiFeedbackAction($action){
        switch ($action){
            case "add":
                $data = json_decode(file_get_contents('php://input')); // получить данные, отправляем в JSON

                $id = addFeedBack($data->name, $data->feedback);
                $response = [
                    'id' => $id,
                    'name' => $data->name,
                    'feedback'=>$data->feedback,
                ];
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                die();
                break;
            case "delete":
                deleteFeedBack($_GET['id']);
                echo json_encode(['response' => 1]);
                die();
                break;

        }
    }


    if($_GET['message'] == 'ok') $params['message'] = "Отзыв добавлен!";
    if($_GET['message'] == 'edit') $params['message'] = "Отзыв изменен!";
    if($_GET['message'] == 'delete') $params['message'] = "Отзыв удален!";


}