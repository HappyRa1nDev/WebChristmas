<?php
// 
include "db/dbConnect.php";

session_start();


// Проверяем, был ли отправлен запрос методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        $response="bad";
        echo $response;
    } else {
        // Проверяем, есть ли параметр action в запросе
        if (isset($_POST['action'])) {
            $id_good = $_POST['action'];
            $user_id = $_SESSION['user_id'];
            $myDB = MySql::getInstance();
            $insert_query = "INSERT INTO `carts` (`user_id`, `goods_id`) VALUES ($user_id, $id_good)";
            $response = $myDB->insert($insert_query);
            if ($result) {
                $response['success'] = false;
            } else {
                $response['success'] = false;
            }
            echo json_encode($response);
        }
    }
}
