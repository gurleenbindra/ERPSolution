<!DOCTYPE html>
<html lang="en">
<head>
  <title>inhousegymlogin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  
  <style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
<script>
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <?php
        if(isset($_SESSION['User']))
        {
        ?>
      <li class="navbar-brand"><?php echo $_SESSION['User'] ;?> &nbsp;&nbsp;</li>
      <?php
        }
        else
        {
            ?>
      <li class="navbar-brand">User &nbsp;&nbsp;</li>
      <?php
        }
      ?>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="home.php">Home</a></li>
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
<div class="login-form">
    <form action="passwordvalidate.php" method="post">
        <h3 class="text-center">Change Password</h3>  
        <div class="form-group">
             <?php 
            if($_GET['Empty']==true)
            {
                ?>
                <div class="alert alert-warning" role="alert">Please fill in the details!</div>
          <?php
          }
            ?>
            <?php 
            if($_GET['Invalid']==true)
            {
                ?>
                <div class="alert alert-warning" role="alert">Invalid existing Password</div>
          <?php
          }
            ?>
            <?php 
            if($_GET['Error']==true)
            {
                ?>
                <div class="alert alert-warning" role="alert">Password mismatch error!</div>
          <?php
          }
            ?>
            <label>Username</label>
            <input type="text" name='username' class="form-control" placeholder="" >
        </div>
        <div class="form-group">
            <label>Old Password</label>
            <input type="password" id="oldpassword" name='oldpassword' class="form-control" placeholder="" >
            <span toggle="#oldpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name='newpassword' class="form-control" placeholder="" >
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name='confirmpassword' class="form-control" placeholder="" >
        </div>
        <div class="form-group">
            <button type="submit" name='submit' class="btn btn-primary btn-block">Submit</button>
        </div>
        <div class="clearfix">
           <!-- <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="login.php" class="float-right">Login</a>-->
        </div>  
    </form>
    <p class="text-center"><a href="login.php">Login</a></p>
</div>
</body>
</html>
