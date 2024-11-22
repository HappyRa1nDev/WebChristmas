<?php
session_start();

include_once "db/dbConnect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['action'])) {
        $num_p=$_GET['action']-1;
        $rows_per_page = 4;
        $start = $rows_per_page*$num_p;

        
        $myDB=MySql::getInstance();
        $products = $myDB->select("SELECT * FROM `goods`");
        echo json_encode($products);
    }
}



if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] == 0) {
    header('Location: online_store.php');
}

// Проверяем, был ли отправлен запрос методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myDB = MySql::getInstance();

    $gname =  $myDB->escape($_POST['name']);
    $gprice = (int)$myDB->escape($_POST['price']);
    $gdescr = $myDB->escape($_POST['descr']);


    $insert_query = "INSERT INTO goods (`name`, `price`, `description`, `image`)
    VALUES
    ('$gname',  $gprice, '$gdescr','static/img/product-8.jpg')";

    $response = $myDB->insert($insert_query);
    echo json_encode(array('success' => true));
}
