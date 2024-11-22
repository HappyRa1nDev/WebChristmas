<?php
// 
include "db/dbConnect.php";

session_start();
if (!isset($_SESSION['user_id'])) {
    header ('Location: online_store.php');
}

// Проверяем, был ли отправлен запрос методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, есть ли параметр action в запросе
    if (isset($_POST['action'])) {
        $id_good =intval($_POST['action']);
        $user_id =intval($_SESSION['user_id']);
        $myDB = MySql::getInstance();
        $insert_query = "DELETE FROM `carts` WHERE `user_id`= $user_id AND `goods_id`=$id_good LIMIT 1";
        $response=$myDB->delete($insert_query);
        if ($result) {
            $response['success'] = false;
        } else {
            $response['success'] = false;
        }
        echo json_encode($response);
    }
}
