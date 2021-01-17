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
if(isset($_POST['submit']))
{
    $sql="SELECT password FROM user where username=?" ;
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$_POST['username']]);
        $data = $stmt->fetchAll();
        if(!empty($data))
        {
            foreach($data as $row)
            {
                
            }
        }
    if(!empty($_POST['username']&&$_POST['oldpassword']&&$_POST['newpassword']&&$_POST['confirmpassword']))
    {
        
            if($row['password']!=$_POST['oldpassword'])
            {
                
                header("location:changepassword.php?Invalid=Invalid existing password");
            }
             else if($_POST['confirmpassword']!=$_POST['newpassword'])
             {
                header("location:changepassword.php?Error=Password mismatch error!");
            }
             else
            {
                $sql1="UPDATE user SET password=? WHERE username=?";
                $stmt1=$pdo->prepare($sql1);
                $stmt1->execute([$_POST['newpassword'],$_POST['username']]);
                header("location:login.php?Success=Password changed successfully!");
                
            }
        
     }
    
    else
    {
        header("location:changepassword.php?Empty=Please fill in the details!");
    }
  
    
}
else
{
    echo "Form not set";
}

?>
</body>
</html>