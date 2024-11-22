<?php

// Определение функции для автозагрузки классов
function autoload_classes($class_name) {
    $file_path = 'db/dbConnect.php';
    if (file_exists($file_path)) {
        require_once $file_path;
    }
}

// Регистрация функции в качестве автозагрузчика классов
spl_autoload_register('autoload_classes');


// $PDO = PdoConnect::getInstance();
// $sql = "
// 	CREATE TABLE IF NOT EXISTS goods
// 	(
// 		id int NOT NULL AUTO_INCREMENT,
// 		name varchar(255) NOT NULL,
// 		price varchar(255) NOT NULL,
// 		image varchar(255) NOT NULL,
// 		PRIMARY KEY(id)
// 	) CHARSET=utf8
// ";
// $res = $PDO->PDO->query($sql);

// $PDO = PdoConnect::getInstance();
// $sql = "
// INSERT INTO goods (`name`, `price`, `image`)
// VALUES
// ('Шоколадный дед мороз', '100 руб.', 'static/img/product-2.png'),
// ('Новогодняя Ёлка', '9900 руб.', 'static/img/product-3.jpg'),
// ('Сладкая коробка', '600 руб.', 'static/img/product-4.jpg'),
// ('Фигурка деда мороза', '2000 руб.', 'static/img/product-5.jpg'),
// ('Новогодний шар', '3000 руб.', 'static/img/product-6.jpg'),
// ('Шар на елку', '300 руб.', 'static/img/product-7.jpg'),
// ('Мишура', '120 руб.', 'static/img/product-8.jpg'),
// ('Гирлянда \"Лампочки\"', '1200 руб.', 'static/img/product-9.jpg'),
// ('Новогоднее шампанское', '240 руб.', 'static/img/product-10.jpg'),
// ('Коробка конфет', '250 руб.', 'static/img/product-11.jpg'),
// ('Подарок \"Сюрприз\"', '900 руб.', 'static/img/product-12.jpg'),
// ('Звезда на Елку', '400 руб.', 'static/img/product-13.jpg'),
// ('Шапка новогодняя', '600 руб.', 'static/img/product-14.jpg'),
// ('Бенгальские огни', '100 руб.', 'static/img/product-15.jpg'),
// ('Хлопушка', '80 руб.', 'static/img/product-16.png')
// ";
// $res = $PDO->PDO->query($sql);



//var_dump($res);
include 'db/dbConnect.php';
$myDB=MySql::getInstance();
$products =$myDB->select("SELECT * FROM `goods`");
//var_dump($products);
//echo json_encode($products);
//MySql::getInstance();

// $myDB->insert("INSERT INTO goods (`name`, `price`, `description` `image`)
// VALUES
// ('Шоколадный дед мороз', 100, 'description 1','static/img/product-2.png'),
// ('Новогодняя Ёлка', 9900, 'description 2','static/img/product-3.jpg'),
// ('Сладкая коробка', 600, 'description 3','static/img/product-4.jpg'),
// ('Фигурка деда мороза', 2000, 'description 4','static/img/product-5.jpg'),
// ('Новогодний шар', 3000, 'description 5','static/img/product-6.jpg'),
// ('Шар на елку', 300, 'description 6','static/img/product-7.jpg'),
// ('Мишура', 120, 'description 7','static/img/product-8.jpg'),
// ('Гирлянда \"Лампочки\"', 1200, 'description 8','static/img/product-9.jpg'),
// ('Новогоднее шампанское', 240 руб, 'description 9','static/img/product-10.jpg'),
// ('Коробка конфет', 250, 'description 10','static/img/product-11.jpg'),
// ('Подарок \"Сюрприз\"', 900, 'description 11','static/img/product-12.jpg'),
// ('Звезда на Елку', 400 , 'description 12','static/img/product-13.jpg'),
// ('Шапка новогодняя', 600, 'description 13','static/img/product-14.jpg'),
// ('Бенгальские огни', 100 руб, 'description 14', 'static/img/product-15.jpg'),
// ('Хлопушка', 80, 'description 15','static/img/product-16.png')");

//$myDB->insert('INSERT INTO goods (name, price, image) VALUES ("ssssssssss", "10 руб.", "static/img/product-2.png")');
//$myDB->delete('DELETE FROM goods WHERE name = "ssssssssss"');


$test_array = array(
    'key1' => 'value1',
    'key2' => array(
        'key21' => 'value21',
        'key22' => 22,
        'key23' => array('value231', 232, 233.01, 'value234'),
    ),
    'key3' => 'value3',
);
//$myDB->pretty_var_dump($products);
// session_start();
// $_SESSION['myDB'] = $myDB;

header ('Location: online_store.php');
//include 'online_store.php';