<?php
function createBlockPages($pageUrl, $recordsPerPage, $page )
{
    $start = $page*$recordsPerPage;

    $rows_per_page = $recordsPerPage;
    $myDB = MySql::getInstance();
    $products = $myDB->select("SELECT * FROM `goods`");
    $nr_of_rows = count($products);

    $pages = ceil($nr_of_rows / $rows_per_page);



    $pag_products = array_slice($products, $start, $rows_per_page);

    //вывожу блок товаров
    echo '<section class="product-box">';
    echo '<h2>Каталог</h2>';
    echo '<div class="row">';
    foreach ($pag_products as $product) {
        echo '<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 product-parent" data-id="' . $product['id'] . '">';
        echo '<div class="product">';
        echo '<div class="product-pic" style="background: url(\'' . $product['image'] . '\') no-repeat; background-size: auto 100%; background-position: center"></div>';
        echo '<span class="product-name">' . $product['name'] . '</span>';
        echo '<span class="product_price">' . $product['price'] . ' руб.</span>';
        echo '<button class="js_aboutProduct">Подробнее</button>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</section>';

    //вывожу номера страниц
    echo '<div class="page-info">';
    echo 'Страница ' . ($page + 1) . ' из ' . $pages;
    echo '</div>';

    echo '<div class="page-numbers">';
    for ($counter = 1; $counter <= $pages; $counter++) {
        echo '<a href="' . $pageUrl. '?page-nr=' . $counter . '">' . $counter . ' </a>';
    }
    echo '</div>';

}

?>