<?php
include 'data1.php';
if(isset($_POST["id"]))
{
 $value = $_POST["value"];
 $d=date('Y-m-d',strtotime($value));
 $query = "UPDATE leaserecords SET ".$_POST["column_name"]."='".$d."' WHERE id = ?";
 $stmt=$pdo->prepare($query);
 $stmt->execute([$_POST['id']]);
 
  echo 'Data Updated';

}
?>