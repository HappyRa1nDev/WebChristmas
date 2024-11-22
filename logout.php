<?php
session_start();
session_unset();
session_destroy();//удаляем с сервера
header ('Location: online_store.php');
exit;
?>

