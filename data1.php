<?php
$username="root";
$pass="";

$pdo=new PDO("mysql:host=localhost;dbname=entries", $username, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::FETCH_ASSOC, PDO::FETCH_OBJ);
?>