<?php session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['User']))
{
    header("location:login.php");
}


?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
</head>
<body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
        <?php
        if(isset($_SESSION['User']))
        {
        ?>
      <li class="navbar-brand"><?php echo $_SESSION['User'] ;?>&nbsp;&nbsp;</li>
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
      <li><a href="home.php">Home</a></li>
      <!--<li><a href="paging.php">View Data</a></li>-->
      <li><a href="filter.php">View Data</a></li>
     <!-- <li><a href="w1.php">Insert</a></li>-->
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
<div>
    </nav>
    <div align="center">
        <div class="col-6 align-self-center">
            <p>Click to add equipment:</p>
     <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">ADD</button>
    </div>
    <div class="col-6 align-self-center" >
        <p>Click to edit equipment:</p>
        <button type="button" name="age" id="age" data-toggle="modal" data-target="#modify_data_Modal" class="btn btn-warning">EDIT</button>
    </div>
   <!-- <div class="col-6 align-self-center" >
        <p>Click to display equipments:</p>
        <button type="button" name="age" id="age" class="btn btn-warning">VIEW</button>
    </div>
    
        <table id="customer_data" class="table">
            <thead>
                <th>Equipment Id</th>
                <th>Equipment Name</th>
            </thead>
            <tbody id="display">
                
            </tbody>
        </table>-->
    </div>
    </div>
</body>
</html>
<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Add Equipment</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
     <label>Enter Equipment name</label>
     <input type="text" name="equipment" id="equipment" class="form-control" />
     <br />
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />

    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>

<div id="modify_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"> Equipment</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="edit_form">
     <label>Old Equipment name</label>
     <input type="text" name="equipment_old" id="equipment_old" value="" class="form-control" />
     <br />
     <label>New Equipment name</label>
     <input type="text" name="equipment_new" id="equipment_new" value="" class="form-control" />
     <br />
     <input type="submit" name="edit" id="edit" value="Edit" class="btn btn-success" />

    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>
<!--
 /* $(document).ready(function()
  {
    $('#insert').click(function()
    {
      var name=$('#equipment').val;
      if(name=='')
      {
        alert("equipment is required");
      }
      else
      {
      $.ajax({
         data:"equipment="+name,
         type: "post",
         url: "insert.php",
         success: function(data){
              alert("Data Save");
         }

          });
    }
    });
  });*/-->
<script>  
$(document).ready(function(){
 $('#insert_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#equipment').val() == "")  
  {  
   alert("Equipment Name is required");  
  }  
  else  
  {  
   $.ajax({  
    url:"add.php",  
    method:"POST",  
    data:$('#insert_form').serialize(),  
    beforeSend:function(){  
     $('#insert').val("Inserting");  
    },  
    success:function(data){  
        //$('#insert').val("Inserted");
     $('#insert_form')[0].reset();  
     $('#add_data_Modal').modal('hide');  
     alert("equipment added");
     $('#customer_data').html(data);  
    }  
   })
  }  
 });
 $('#edit_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#equipment_old').val() == "" || $('#equipment_new').val()=="")  
  {  
   alert("fields are required");  
  }  
  else  
  {  
   $.ajax({  
    url:"update.php",  
    method:"POST",  
    data:$('#edit_form').serialize(),  
    beforeSend:function(){  
     $('#edit').val("Editing");  
    }, 
    success:function(data){  
     $('#edit_form')[0].reset();  
     $('#modify_data_Modal').modal('hide');  
     alert("equipment edited");
     $('#customer_data').html(data);  
    }  
   })  
  }  
 });
 /*$('#view').click(function(){  
 // event.preventDefault();  
   $.ajax({  
    url:"fetchdata.php",  
    method:"POST",  
    dataType:"html"; 
    success:function(data){ 
     $('#display').html(data);  
    }  
   })  
  });*/
 
});
</script>
<script>
$(document).ready(function(){
    

    ('#age').click(function(){  
 // event.preventDefault();  
   $.ajax({  
    url:"fetchdata.php",  
    method:"POST",  
    data:{},
    dataType:"html"; 
    success:function(data){ 
     $('#display').html(data);  
    }  
   })  
  });
});
</script>