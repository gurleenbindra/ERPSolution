<?php
include 'data1.php';
if(isset($_POST["id"]))
{
 $query = "DELETE FROM leaserecords WHERE id = '".$_POST["id"]."'";
 $stmt=$pdo->prepare($query);
 
 if($stmt->execute())
 {
  echo 'Data Deleted';
 }
}
?>
