<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>inhousegymform</title>
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
      <li ><a href="home.php">Home</a></li>
      <li><a href="paging.php">View Data</a></li>
      <li><a href="filter.php">Filter</a></li>
      <li><a href="w1.php">Insert</a></li>
      <li><a href="mail2.php">Email</a></li>
     <!-- <li><a href="sortform.php">Sort</a></li>-->
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
if(isset($_POST['sub']))
{
    if(empty($_POST['username'])|| empty($_POST['password']))
    {
        header("location:login.php?Empty=Please fill in the details!");
    }
    else
    {
        $sql="SELECT * FROM user where username=? AND password=?" ;
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$_POST['username'],$_POST['password']]);
        $data = $stmt->fetch();
        if(!empty($data))
        {
            $_SESSION['User']=$_POST['username'];
            if(isset($_SESSION['url']))
            {
            $url = $_SESSION['url'];
            header("location:$url");
           // header("location:home.php");
            }
            else 
            {
                $url="/phpspreadsheet/filter.php";
                header("location:$url");
            }
        }
        else
        {
            header("location:login.php?Invalid=Invalid Login Credentials");
        }
        
    }
}
else
{
    echo "Login not set";
}

?>
</body>
</html>