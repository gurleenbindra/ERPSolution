<?php
session_start();
unset($_SESSION['User']);
header("location: filter.php");
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
?>