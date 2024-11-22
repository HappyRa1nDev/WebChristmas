<?php
include_once 'paginator.php';
function showAbout()
{
    if (isset($_SESSION['username'])) {
        $currentPath = "online_store.php?content=about";
        setcookie("last_visited_section", $currentPath, time() + (30 * 24 * 60 * 60)); // Кука действует 30 дней
    }
    echo "<div>
about text
</div>";
};
function showLoginForm()
{
    echo '

<div class="login-container">
    <div class="login-form">
        <form action="loginscript.php" method="post">
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" id="username" name="username" placeholder="Имя пользователя">
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" placeholder="Пароль">
            </div>
            <button type="submit" name="login">Войти</button>
            <button type="submit" name="register">Зарегистрироваться</button>
        </form>';
    // Проверяем, есть ли сообщение в сессии
    if (isset($_SESSION['message'])) {
        // Выводим сообщение
        echo '<div>' . $_SESSION['message'] . '</div>';

        // Удаляем сообщение из сессии, чтобы оно не появлялось снова при обновлении страницы
        unset($_SESSION['message']);
    }
    echo '       
    </div>
</div>
';
};

function logoutUser()
{
    header('Location: logout.php');
};
function showHome()
{
    if (isset($_SESSION['username'])) {
        $currentPath = "online_store.php";
        setcookie("last_visited_section", $currentPath, time() + (30 * 24 * 60 * 60)); // Кука действует 30 дней
    }

    echo "<div>
    home text
    </div>";

    if (isset($_GET['page-nr'])) {
        $page = $_GET['page-nr'] - 1;
    }

    createBlockPages("online_store.php", 4, $page);
    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
        echo '<span class="js_showPopup">Добавить</span>';
    }
};
function showCart()
{
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: online_store.php?content=main');
    }


    $userId = $_SESSION['user_id'];
    echo "<div>
    cart text " . $userId . " 
    </div>";
    $myDB = MySql::getInstance();
    $sql = "SELECT * FROM goods JOIN carts ON goods.id = carts.goods_id WHERE carts.user_id = $userId";
    $products_incart = $myDB->select($sql);
    //вывожу блок товаров
    echo '<section class="product-box">';
    echo '<h2>Корзина</h2>';
    echo '<div class="row">';
    foreach ($products_incart as $product) {
        echo '<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 product-parent" data-id="' . $product['goods_id'] . '">';
        echo '<div class="product">';
        echo '<div class="product-pic" style="background: url(\'' . $product['image'] . '\') no-repeat; background-size: auto 100%; background-position: center"></div>';
        echo '<span class="product-name">' . $product['name'] . '</span>';
        echo '<span class="product_price">' . $product['price'] . ' руб.</span>';
        echo '<button class="js_RemoveFromCart">Удалить</button>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</section>';
};
function showAboutProduct($pid)
{
    $myDB = MySql::getInstance();
    $sql = "SELECT * FROM goods WHERE id = $pid";
    $products = $myDB->select($sql);
    foreach ($products as $product) {
        echo '<div class="productAbout" data-id="' . $product['id'] . '">';
        echo '<h2>О Товаре</h2>';
        echo '<div id="imageContainer">
                    <img src=' . $product['image'] . ' alt="Описание изображения" width="400" height="300">
                </div>';
        echo '<h3>Название: ' . $product['name'] . '</h3>';
        echo '<h3>Цена: ' . $product['price'] . ' руб.</h3>';
        echo '<h3>Описание</h3>';
        echo '<p>' . $product['description'] . ' </p>';
        echo '<button class="js_addToCart">Добавить в корзину</button>';
        echo '</div>';
    }
}

function getCentralByUrl()
{
    $urltype = 'main';

    if (isset($_GET['content'])) {
        $urltype = $_GET['content'];
    }
    // Пример логики для определения содержимого в зависимости от URL
    if ($urltype == 'about') {
        showAbout();
    } else if ($urltype == 'main') {
        showHome();
    } else if ($urltype == 'login') {
        showLoginForm();
    } else if ($urltype == 'cart') {
        showCart();
    } else if ($urltype == 'logout') {
        logoutUser();
    } else if ($urltype == 'product') {
        if (!isset($_GET['pid'])) {
            header('Location: online_store.php');
        }
        $pid = $_GET['pid'];
        showAboutProduct($pid);
    }
}
