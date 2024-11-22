<!-- <header>
    <div class="mobile-menu-open-button js_mobile_menu_open_button"><i class="fas fa-bars"></i></div>
    <nav class="js_wide_menu">
        <i class="fas fa-times close-mobile-menu js_close_mobile_menu"></i>
        <div class="wrapper-inside">
            <div class="visible-elements">
                <span class="js_mainpage">Главная</span>
                <span class="js_aboutpage">О Магазине</span>
            </div>
        </div>
    </nav>
</header>-->

<header>
    <nav class="menu-items">
        <div class="mobile-menu-open-button js_mobile_menu_open_button"><i class="fas fa-bars"></i></div>
        <div class="js_wide_menu">
            <div class="wrapper-inside">
                <div class="visible-elements">
                    <span class="js_mainpage">Главная</span>
                    <span class="js_aboutpage">О Магазине</span>

                    <?php
                    session_start();
                    if (!isset($_SESSION['username'])) {
                        echo '<span class="js_login">Войти</span>';
                    }
                    else{
                        echo '<span class="js_cart">Корзина</span>';
                        echo '<span class="js_logout">Выйти</span>';
                    }
                    ?>
                </div>
            </div>

        </div>
    </nav>

</header>