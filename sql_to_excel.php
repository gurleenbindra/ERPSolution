<?php
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['User']))
{
    header("location:login.php");
}

//php_spreadsheet_export.php

include 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
include 'data1.php';

//$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");


$query = "SELECT * FROM leaserecords ORDER BY id";

$statement = $pdo->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

if(isset($_POST["export"]))
{
  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

  $active_sheet->setCellValue('A1', 'S.No');
  $active_sheet->setCellValue('B1', 'Date Leased');
  $active_sheet->setCellValue('C1', 'Equipment');
  $active_sheet->setCellValue('D1', 'Equipment No.');
  $active_sheet->setCellValue('E1', 'Model No.');
  $active_sheet->setCellValue('F1', 'Name');
  $active_sheet->setCellValue('G1', 'Address');
  $active_sheet->setCellValue('H1', 'Phone No.');
  $active_sheet->setCellValue('I1', 'Rent');
  $active_sheet->setCellValue('J1', 'Sec');
  $active_sheet->setCellValue('K1', 'Lease Date');
  $active_sheet->setCellValue('L1', 'End Date');
  $active_sheet->setCellValue('M1', 'Period of Hire');
  $active_sheet->setCellValue('N1', 'Duration of Hire');
  $active_sheet->setCellValue('O1', 'Payment Reced Upto');
  $active_sheet->setCellValue('P1', 'Last Service Date');
  $active_sheet->setCellValue('Q1', 'Date Picked');
  $active_sheet->setCellValue('R1', 'Carriage');
  $active_sheet->setCellValue('S1', 'Email');
  $active_sheet->setCellValue('T1', 'Booking Advance');
  $active_sheet->setCellValue('U1', 'Balance Due');
  $active_sheet->setCellValue('V1', 'Gstin');
  $active_sheet->setCellValue('W1', 'Flag');
  $active_sheet->setCellValue('X1', 'To Be Picked');
  $active_sheet->setCellValue('Y1', 'Comments');



  $count = 2;
    $a=1;
  foreach($result as $row)
  {
    $active_sheet->setCellValue('A' . $count, $a);
    $active_sheet->setCellValue('B' . $count, $row["dateleased"]);
    $active_sheet->setCellValue('C' . $count, $row["equipment"]);
    $active_sheet->setCellValue('D' . $count, $row["equipmentno"]);
    $active_sheet->setCellValue('E' . $count, $row["modelno"]);
    $active_sheet->setCellValue('F' . $count, $row["name"]);
    $active_sheet->setCellValue('G' . $count, $row["address"]);
    $active_sheet->setCellValue('H' . $count, $row["phoneno"]);
   $active_sheet->setCellValue('I' . $count, $row["rent"]);
   $active_sheet->setCellValue('J' . $count, $row["sec"]);
   $active_sheet->setCellValue('K' . $count, $row["leasedate"]);
   $active_sheet->setCellValue('L' . $count, $row["enddate"]);
   $active_sheet->setCellValue('M' . $count, $row["period"]);
   $active_sheet->setCellValue('N' . $count, $row["duration"]);
   $active_sheet->setCellValue('O' . $count, $row["paymentrecedupto"]);
   $active_sheet->setCellValue('P' . $count, $row["lastservicedate"]);
    $active_sheet->setCellValue('Q' . $count, $row["datepicked"]);
    $active_sheet->setCellValue('R' . $count, $row["carriage"]);
    $active_sheet->setCellValue('S' . $count, $row["email"]);
    $active_sheet->setCellValue('T' . $count, $row["bookingadvance"]);
    $active_sheet->setCellValue('U' . $count, $row["balancedue"]);
    $active_sheet->setCellValue('V' . $count, $row["gstin"]);
    $active_sheet->setCellValue('W' . $count, $row["flag"]);
    $active_sheet->setCellValue('X' . $count, $row["tobepicked"]);
    $active_sheet->setCellValue('Y' . $count, $row["comments"]);
    $count = $count + 1;
    $a++;
  }

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);

  $file_name ='exported' .time() . '.' . strtolower($_POST["file_type"]);

  $writer->save($file_name);

  header('Content-Type: application/x-www-form-urlencoded');

  header('Content-Transfer-Encoding: Binary');

  header("Content-disposition: attachment; filename=\"".$file_name."\"");

  readfile($file_name);

  unlink($file_name);

  exit;

}

?>
<!DOCTYPE html>
<html>
   <head>
     <title>Export Data</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </head>
   <body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <li class="navbar-brand"><?php echo $_SESSION['User'] ;?>&nbsp;&nbsp;</li>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="home.php">Home</a></li>
     <!-- <li><a href="paging.php">View Data</a></li>-->
      <li><a href="filter.php">View Data</a></li>
      <li class="dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Insert<b class="caret"></b
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="button.php">Equipment</a></li>
          <li><a class="dropdown-item" href="w1.php">Customer Details</a></li>
      </ul></li>
      <li><a href="mail2.php">Email</a></li>
     <!-- <li><a href="sortform.php">Sort</a></li>-->
      <li><a href="extest.php">Import</a></li>
      <li class="active"><a href="sql_to_excel.php">Export</a></li>
     <!-- <li><a href="export1.php">Export</a></li>-->
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>--><?php
      
      if(isset($_SESSION['User']))
    {?>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
     <?php  }
     else
     {?>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>   
    <?php }
     
     ?>
    </ul>
  </div>
</nav>
<?php 
if($_SESSION['User']!="superadmin")
{
    echo("<div align='center' style='margin-top:18%;font-size:x-large;'><strong>Sorry<br>You cannot access this page!</strong></div>");
    die();
  //  header("location:home.php");
}?>
     <div class="container">
      <br />
      <?php
      $number_of_results = $pdo->query('select count(*) from leaserecords')->fetchColumn();
      
      ?>
      <h3 align="center">Export Data</h3>
      <br />
        <div class="panel panel-default" width="100%">
          <div class="panel-heading" width="auto">
            <form method="post">
              <div class="row">
                <div class="col-md-6">User Data Values= <?php echo $number_of_results;?></div>
                <div class="col-md-4">
                  <select name="file_type" class="form-control input-sm">
                    <option value="Xlsx">Xlsx</option>
                    <option value="Xls">Xls</option>
                    <option value="Csv">Csv</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <input type="submit" name="export" class="btn btn-primary btn-sm" value="Export" />
                </div>
              </div>
            </form>
          </div>
        <!--  <div class="panel-body">-->
          <div class="table-responsive">
           <table class="table table-striped table-bordered">
                <tr>
                 <th><h3>S.No.</h3></th>
                 <th><h3>DATE LEASED</h3></th>
                 <th><h3>EQUIPMENT LEASED</h3></th>
                 <th><h3>EQUIPMENT No.</h3></th>
                 <th><h3>MODEL NO.</h3></th>
                <th><h3>CUSTOMERS NAME</h3></th>
                <th><h3>ADDRESS</h3></th>
                <th><h3>PHONE</h3></th>
                <th><h3>RENT</h3></th>
                <th><h3>SEC</h3></th>
                <th><h3>LEASING DATE</h3></th>
                <th><h3>END DATE</h3></th>
                <th><h3>PERIOD</h3></th>
                <th><h3>DURATION</h3></th>
                <th><h3>PAYMENT RECEIVED UPTO</h3></th>
                <th><h3>LAST SERVICE DATE</h3></th>
                <th><h3>DATE PICKED</h3></th>
                <th><h3>CARRIAGE</h3></th>
                <th><h3>EMAIL</h3></th>
                <th><h3>BOOKING ADVANCE</h3></th>
                <th><h3>BALANCE DUE</h3></th>
                <th><h3>GSTIN</h3></th>
                <th><h3>FLAG</h3></th>
                <th><h3>TO BE PICKED</h3></th>
                <th><h3>COMMENTS</h3></th>
                </tr>
                <?php
                $a=1;
                
                foreach($result as $k)
                {
                  echo '
                  <tr>
                  <td>'. $a.'</td>
                  <td>'. $k['dateleased'].'</td>
                  <td>'. $k['equipment'].'</td>
                  <td>'. $k['equipmentno'].'</td>
                  <td>'. $k['modelno'].'</td>
                  <td>'. $k['name'].'</td>
                  <td>'.$k['address'].'</td>
                  <td>'. $k['phoneno'].'</td>
                  <td>'.$k['rent'].'</td>
                  <td>'. $k['sec'].'</td> 
                  <td>'.$k['leasedate'] .'</td>
                  <td>'.$k['enddate'].'</td>
                  <td>'.$k['period'].'</td>
                  <td>'.$k['duration'].'</td>
                  <td>'.$k['paymentrecedupto'].'</td>
                  <td>'.$k['lastservicedate'].'</td>
                  <td>'. $k['datepicked'].'</td>
                  <td>'.$k['carriage'].'</td>
                  <td>'. $k['email'].'</td> 
                  <td>'. $k['bookingadvance'].'</td>
                  <td>'. $k['balancedue'].'</td>
                  <td>'. $k['gstin'].'</td>
                  <td>'. $k['flag'].'</td>
                  <td>'. $k['tobepicked'].'</td>
                  <td>'. $k['comments'].'</td>
                  </tr>
                  ';
                  $a++;
                }
                ?>

              </table>
          </div>
        <!--  </div>-->
        </div>
     </div>
      <br />
      <br />
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  </body>
</html>
