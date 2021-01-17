<?php
include 'data1.php';
$oldname=$_POST['equipment_old'];
$newname=$_POST['equipment_new'];
//$oldname="cross trainer";
$query="SELECT equipment_id from equipment WHERE equipment_name=?";
$r=$pdo->prepare($query);
$r->execute([$oldname]);
//$r=$pdo->prepare($query);
//$r->execute([':equipment_name'=>$oldname]);
$data=$r->fetch();
foreach($data as $p)
{

}
$i=$p['id'];
//echo $i;
$myquery="SELECT model_id FROM models WHERE equipment_name=?";
$q=$pdo->prepare($myquery);
$q->execute([$oldname]);
$produce=$q->fetchAll();
//$newname="bicycle";
$sql="UPDATE equipment SET equipment_name=? WHERE equipment_id=?";
$result=$pdo->prepare($sql);
$result->execute([$newname,$i]);

foreach($produce as $m)
{
    $mo=$m['model_id'];
   // echo $mo;
   // echo $m['equipment_name'];
$mysql="UPDATE models SET equipment_name=? WHERE model_id=?";
$output=$pdo->prepare($mysql);
$output->execute([$newname,$mo]);
}

?>