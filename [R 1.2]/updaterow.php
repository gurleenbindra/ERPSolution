<?php
include 'data1.php';
if(isset($_POST["id"]))
{
 $value = $_POST["value"];
 $query = "UPDATE leaserecords SET ".$_POST["column_name"]."='".$value."' WHERE id = ?";
 $stmt=$pdo->prepare($query);
 $stmt->execute([$_POST['id']]);
 
  echo 'Data Updated';

}
?>