<?php
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['User']))
{
    header("location:login.php");
}
//import.php

require_once ('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
include 'data1.php';
//$connect = new PDO("mysql:host=localhost;dbname=example", "root", "");

if($_FILES["import_excel"]["name"] != '')
{
 $allowed_extension = array('xls', 'csv', 'xlsx');
 $file_array = explode(".", $_FILES["import_excel"]["name"]);
 $file_extension = end($file_array);

 if(in_array($file_extension, $allowed_extension))
 {
  $file_name = time() . '.' . $file_extension;
  move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
  //$spreadsheet = new PhpOffice\PhpSpreadsheet();
  $file_type =\PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
  $reader = IOFactory::createReader($file_type);

  $spreadsheet = $reader->load($file_name);

  unlink($file_name);

  $data = $spreadsheet->getActiveSheet()->toArray();

  foreach($data as $row)
  {
   $insert_data = array(
    ':dateleased'  => $row[0],
    ':equipment'  => $row[1],
    ':equipmentno'=>$row[2],
    ':modelno'=>$row[3],
    ':name'  => $row[4],
    ':address'=>$row[5],
   ':phoneno'  => $row[6],
     ':rent'  => $row[7],
    ':sec'  => $row[8],
    ':leasedate'  => $row[9],
    ':enddate'  => $row[10],
    ':period'=>$row[11],
    ':duration'=>$row[12],
    ':paymentrecedupto'=>$row[13],
    ':lastservicedate'=>$row[14],
    ':datepicked'=>$row[15],
    ':carriage'=>$row[16],
    ':email'=>$row[17],
    ':bookingadvance'=>$row[18],
    ':balancedue'=>$row[19],
    ':gstin'=>$row[20],
    ':flag'=>$row[21],
    ':tobepicked'=>$row[22],
    ':comments'=>$row[23]

   );

    $sql = "INSERT INTO leaserecords (dateleased,equipment,equipmentno,modelno,name,address,phoneno,rent,sec,leasedate,enddate,period,duration,paymentrecedupto,lastservicedate,datepicked,carriage,email,bookingadvance,balancedue,gstin,flag,tobepicked,comments) VALUES (:dateleased,:equipment,:equipmentno,:modelno,:name,:address,:phoneno,:rent,:sec,:leasedate,:enddate,:period,:duration,:paymentrecedupto,:lastservicedate,:datepicked,:carriage,:email,:bookingadvance,:balancedue,:gstin,:flag,:tobepicked,:comments)";
   $statement=$pdo->prepare($sql);
   $statement->execute($insert_data);
 }
  $message = '<div class="alert alert-success">Data Imported Successfully</div>';

 }
 else
 {
  $message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
 }
}
else
{
 $message = '<div class="alert alert-danger">Please Select File</div>';
}

echo $message;

?>
</body>
</html>