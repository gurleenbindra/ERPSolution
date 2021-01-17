<?php
include "data1.php";
$sql="SELECT * FROM equipment";
$stmt=$pdo->query($sql);
$stmt->execute();
$result=$stmt->fetchAll();

foreach($result as $row)
{?>
<tr>
    <td><?php echo $row["equipment_id"];?></td>
    <td><?php echo $row["equipment_name"];?></td>
    </tr>
    <?php
}
?>
