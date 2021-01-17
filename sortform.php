<?php
//include 'data1.php';
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['User']))
{
   header("location:login.php"); 
}
?><!DOCTYPE html>
<html>
<head>
	<!--<title>CUSTOMER DETAILS</title>-->
	<!--<link href="com.css" rel="stylesheet">-->
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
	<!--<a href="w1.php">Insert Data</a>
	<h2 style="text-align: center"><u>CUSTOMER DETAILS</u></h2>-->
</head>
<body>
   <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <li class="navbar-brand" href="#"><?php echo $_SESSION['User'] ;?>nbsp;&nbsp;</li>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="home.php">Home</a></li>
      <li><a href="paging.php">View Data</a></li>
      <li><a href="filter.php">Filter</a></li>
      <li><a href="w1.php">Insert</a></li>
      <li><a href="mail2.php">Email</a></li>
      <li class="active"><a href="sortform.php">Sort</a></li>
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



	<!--<a id="f1">-->
<?php //if(!isset($_POST['sub'])) {?>
  <div align="center">
   <h3>select the column for sorting</h3>
   <br>
<form name="sort" action="sort1.php" > 
<select name="order"><!--Dropdown for sorting-->
  <option value="id">ID</option>
   <option value="name">Name</option>
   <option value="equipment">Equipment</option>
   <option value="address">Address</option>
   <option value="phoneno">PhoneNo.</option>
   <option value="leasedate">Lease Date</option>
   <option value="enddate">End Date</option>
  <!-- <option value="period">Period of Hire</option>-->
   <option value="rent">Rent</option>
   <option value="sec">Security</option>
   <option value="carriage">Carriage</option>
   <option value="lastservicedate">Last Service Date</option>
   <option value="datepicked">Date Picked</option>
</select>
<select name="orderform"><!--Dropdown for order of sorting-->
    <option value="ASC">ASC</option>
    <option value="DESC">DESC</option>
</select>
<input type="submit" name="sub" value=" - Sort - " />
</form>
</div>
<?php //}?><!--</a>-->
</body>
</html>