<?php
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['User']))
{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Insert</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
      <li ><a href="phpspreadsheet/home.php">Home</a></li>
      <!--<li><a href="paging.php">View Data</a></li>-->
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
      <!--<li><a href="sortform.php">Sort</a></li>-->
      <li><a href="extest.php">Import</a></li>
      <li><a href="sql_to_excel.php">Export</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
      <?php
      
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
include 'data1.php';
 // $username=$_POST['username'];
  $name=$_POST['name'];
    $address=$_POST['address'];
    $phone=$_POST['phoneno'];
    $leasingdate=$_POST['leasedate'];
    $enddate=$_POST['enddate'];
    $dateleased = date('Y-m-d', strtotime($_POST['dateleased']));
    $equipmentleased=$_POST['sel_equipment'];
    $equipmentno=$_POST['equipmentno'];
    $modelno=$_POST['sel_model'];
    $periodofhire=$_POST['period'];
    $duration=$_POST['duration'];
    $rent=$_POST['rent'];
    $sec=$_POST['sec'];
    $carriage=$_POST['carriage'];
    $email=$_POST['email'];
    $comments=$_POST['comments'];
    $paymentrecedupto=$_POST['paymentrecedupto'];
    $lastservicedate=$_POST['lastservicedate'];
    $datepicked=$_POST['datepicked'];
     $gstin=$_POST['gstin'];
    $balancedue=$_POST['balancedue'];
    $flag=$_POST['flag'];
    $bookingadvance=$_POST['bookingadvance'];
    $tobepicked=$_POST['tobepicked'];
    /*$sql1='SELECT id FROM leaserecords where username=?';
  $stmt1=$pdo->prepare($sql1);
  $stmt1->execute([$username]);
  $data=$stmt1->fetchAll();
  if(!$data)
  {*/
    $sql = "INSERT INTO leaserecords (name,address,phoneno,leasedate,enddate,dateleased,equipment,equipmentno,modelno,period,duration,rent,sec,carriage,email,comments,paymentrecedupto,lastservicedate,datepicked,gstin,balancedue,flag,bookingadvance,tobepicked) VALUES (:name,:address,:phoneno,:leasedate,:enddate,:dateleased,:equipment,:equipmentno,:modelno,:period,:duration,:rent,:sec,:carriage,:email,:comments,:paymentrecedupto,:lastservicedate,:datepicked,:gstin,:balancedue,:flag,:bookingadvance,:tobepicked)";
   $stmt=$pdo->prepare($sql);
   $stmt->execute([':name'=>$name,':address'=>$address,':phoneno'=>$phone,':leasedate'=>$leasingdate,':enddate'=>$enddate,':dateleased'=>$dateleased,':equipment'=>$equipmentleased,':equipmentno'=>$equipmentno,':modelno'=>$modelno,':period'=>$periodofhire,':duration'=>$duration,':rent'=>$rent,':sec'=>$sec,':carriage'=>$carriage,':email'=>$email,':comments'=>$comments,':paymentrecedupto'=>$paymentrecedupto,':lastservicedate'=>$lastservicedate,':datepicked'=>$datepicked,':gstin'=>$gstin,':balancedue'=>$balancedue,':flag'=>$flag,':bookingadvance'=>$bookingadvance,':tobepicked'=>$tobepicked]);
   echo "REGISTERED SUCCESSFULLY";

 /*}
 else
 {
  echo "USERNAME EXISTS";
  ?>
  <button><a href="w1.php">FILL FORM</a></button>
 <?php }*/
?>
<br>
<br>
<!--<button><a href="paging.php">View Data</a></button>-->

</body>
</html>