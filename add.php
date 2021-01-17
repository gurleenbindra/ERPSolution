<?php
include 'data1.php';
//if(!empty($_POST))
//{
// $output = '';
$name=$_POST["equipment"];
$sql="INSERT INTO equipment(equipment_name) VALUES (:equipment_name)";
$result=$pdo->prepare($sql);
$result->execute([':equipment_name'=>$name]);
//echo " equipment added";
/*if($result)
{
	$output.='<label class="text-success">Data Inserted</label>';
}
echo $output;*/
//}
?>