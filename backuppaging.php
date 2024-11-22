<?php

$start = 0;

$rows_per_page = 8;

$products = $myDB->select("SELECT * FROM `goods`");
$nr_of_rows = count($products);

$pages = ceil($nr_of_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$pag_products = array_slice($products, $start, $rows_per_page)
//$myDB->select("SELECT * FROM `goods` LIMIT $start, $rows_per_page");
?>
<section class="product-box">
    <h2>Каталог</h2>
    <div class="row">
        <? foreach ($pag_products as $product) : ?>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 product-parent" data-id="<?= $product['id'] ?>">
                <div class="product">
                    <div class="product-pic" style="background: url('<?= $product['image'] ?>') no-repeat; background-size: auto 100%; background-position: center"></div>
                    <span class="product-name"><?= $product['name'] ?></span>
                    <span class="product_price"><?= $product['price'] ?> руб.</span>
                    <button class="js_buy">Купить</button>
                </div>
            </div>
        <? endforeach ?>
    </div>
</section>
<?php
function createBlockPages($pageUrl, $recordsPerPage)
{
    $start = 0;

    $rows_per_page = $recordsPerPage;
    $myDB = MySql::getInstance();
    $products = $myDB->select("SELECT * FROM `goods`");
    $nr_of_rows = count($products);

    $pages = ceil($nr_of_rows / $rows_per_page);

    if (isset($_GET['page-nr'])) {
        $page = $_GET['page-nr'] - 1;
        $start = $page * $rows_per_page;
    }

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
        echo '<button class="js_buy">Купить</button>';
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
        echo '<a href="' . $pageUrl . '?page-nr=' . $counter . '">' . $counter . '</a>';
    }
    echo '</div>';

}

?>
<div class=page-info>
    <?php echo "Страница " . ($page + 1) . " из " . $pages ?>
</div>
<div class="page-numbers">
    <?php
    for ($counter = 1; $counter <= $pages; $counter++) {
    ?>
        <a href="?page-nr=<?php echo $counter ?>"><?php echo $counter ?></a>
    <?php
    }
    ?>
</div>