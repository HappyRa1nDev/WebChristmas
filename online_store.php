<?php
require_once 'db/dbConnect.php';
require_once 'centerBlock.php';
$myDB = MySql::getInstance();
?>
<!DOCTYPE html>
<html>

<head>
	<title>Интернет-магазин новогодней и рождественской атрибутики</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="static/js/script.js"></script>
	<link href="static/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<link href="static/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="vein"></div>
	<div class="main container">
		<?php require_once 'struct/header.php'; ?>
		<div class="basecontent">
		<?php
		getCentralByUrl();
		?>
		</div>
		<?php require_once 'struct/footer.php'; ?>
	</div>
	<div class="overlay js_overlay"></div>
	<div class="popup">
		<h3>Добавление товара</h3><i class="fas fa-times close-popup js_close-popup"></i>
		<div class='js_error'></div>
		<input type="hidden" name="product-id">
		<input type="text" name="gname" placeholder="Название">
		<input type="text" name="gprice" placeholder="Цена">
		<textarea placeholder="Опиание" name="gdesc"></textarea>
		<button class="js_send">Добавить</button>
	</div>
</body>

</html>