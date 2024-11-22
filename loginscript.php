<?php
require_once 'db/dbConnect.php';
$myDB = MySql::getInstance();

session_start();

// Функция для генерации соли
function generateSalt($length = 32)
{
    return bin2hex(random_bytes($length));
}

// Функция для хэширования пароля с использованием соли
function hashPassword($password, $salt)
{
    return hash('sha256', $password . $salt);
}


// Регистрация пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $salt = generateSalt();
    $password_hash = hashPassword($password, $salt);

    $sql = "INSERT INTO users (username, password_hash, salt) VALUES ('$username', '$password_hash', '$salt')";

    // Проверка существования пользователя с таким именем
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $result =  $myDB->select($check_query);

    if (count($result) > 0) {
        $_SESSION['message'] =  "Пользователь с таким именем уже существует.";
        header('Location: online_store.php?content=login');
    } else {
        // Создание нового пользователя
        $salt = generateSalt();
        $password_hash = hashPassword($password, $salt);

        $insert_query = "INSERT INTO users (username, password_hash, salt) VALUES ('$username', '$password_hash', '$salt')";
        $myDB->insert($sql);
        $_SESSION['username'] = $username;

        // Получаем сгенирированный id
        $check_query2 = "SELECT * FROM users WHERE username='$username'";
        $result2 =  $myDB->select($check_query2);
        $_SESSION['user_id'] = $result2[0]['id'];
        $_SESSION['isAdmin'] = $result2[0]['isAdmin'];

        $lastVisitedSection = "online_store.php";
        if (isset($_COOKIE['last_visited_section'])) {
            // Куки существует, получаем значение
            $lastVisitedSection = $_COOKIE['last_visited_section'];
            echo "Последний посещенный раздел: " . $lastVisitedSection;
        }

        $lastVisitedSection = $_COOKIE['last_visited_section'];
        header('Location: ' . $lastVisitedSection);
    }
}

// Вход пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $myDB->select($sql);

    if (count($result) == 1) {
        $row = $result[0];
        $salt = $row['salt'];
        $stored_password_hash = $row['password_hash'];

        $password_hash = hashPassword($password, $salt);

        if ($password_hash === $stored_password_hash) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['isAdmin'] = $row['isAdmin'];

            $lastVisitedSection = "online_store.php";
            if (isset($_COOKIE['last_visited_section'])) {
                // Куки существует, получаем значение
                $lastVisitedSection = $_COOKIE['last_visited_section'];
                echo "Последний посещенный раздел: " . $lastVisitedSection;
            }

            $lastVisitedSection = $_COOKIE['last_visited_section'];
            header('Location: ' . $lastVisitedSection);
        } else {
            $_SESSION['message'] = "Неверные имя пользователя или пароль.";
            header('Location: online_store.php?content=login');
        }
    } else {
        $_SESSION['message'] = "Неверные имя пользователя или пароль.";
        header('Location: online_store.php?content=login');
    }
}
