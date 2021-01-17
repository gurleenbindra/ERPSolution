<?php  
include 'data1.php';
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['User']))
{
    header("location:login.php");
}
 //$connect = mysqli_connect("localhost", "root", "", "records");  
 $query ="SELECT * FROM leaserecords ORDER BY dateleased DESC";  
 $result = $pdo->query($query);
 $result->execute();
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Customer Details</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
           <style>
               th{
                   background-color: #ADD8E6;
               }
           </style>
      </head>  
      <body>  
      	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <li class="navbar-brand" href="#"><?php echo $_SESSION['User'] ;?>&nbsp;&nbsp;</li>
    </div>
   <ul class="nav navbar-nav">
      <li ><a href="home.php">Home</a></li>
      <li class="active"><a href="paging.php">View Data</a></li>
      <li><a href="filter.php">Filter</a></li>
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
           <br /><br />  
           <!--<div class="container" width="100%">  -->
                <h3 align="center"><u>CUSTOMER DETAILS</u></h3>  
                <br />  
                <div class="table-responsive" width="100%">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <th>S.No.</th>
    <!--<th><h3>USERNAME</h3></th>-->
    <th>DATE LEASED</th>
    <th>CUSTOMER'S NAME</th>
    <th>ADDRESS</th>
    <th>PHONE</th>
    <th>LEASING DATE</th>
    <th>END DATE</th>
    <th>EQUIPMENT LEASED</th>
    <th>MODEL NO.</th>
    <th>EQUIPMENT NO.</th>
    <th>PERIOD OF HIRE</th>
    <th>RENT</th>
    <th>SECURITY</th>
    <th>CARRIAGE</th>
    <th>COMMENTS</th>
    <th>EMAIL</th>
    <th>PAYMENT RECEIVED UPTO</th>
    <th>LAST SERVICE DATE</th>
    <th>DATE PICKED</th>   
    <th>EDIT/LEASE LETTER</th>  
    <th>EDIT/LEASE LETTER</th>  
                    
                               </tr>  
                          </thead>  
                          <?php  
                          foreach($data =$result->fetchAll() as $row)  
                          {  
                               echo '  
                               <tr>  
           <td>' . $row["id"] . '</td>  
           <td>' . $row["dateleased"] . '</td> 
           <td>' . $row["name"] . '</td>  
           <td>' . $row["address"] . '</td>  
           <td>' . $row["phoneno"] . '</td>  
           <td>' . $row["leasedate"] . '</td>  
          <td>' . $row["enddate"] . '</td>
          <td>' . $row["equipment"] . '</td>
          <td>' . $row["modelno"] . '</td>
          <td>' . $row["equipmentno"] . '</td>
          <td>' . $row["period"] . '</td>
          <td>' . $row["rent"] . '</td>
          <td>' . $row["sec"] . '</td>
          <td>' . $row["carriage"] . '</td>
          <td>' . $row["comments"] . '</td>
          <td>' . $row["email"] . '</td>
          <td>' . $row["paymentrecedupto"] . '</td>
          <td>' . $row["lastservicedate"] . '</td>
          <td>' . $row["datepicked"] . '</td>
          <td>'. $row["id"] .'</td>
          <td>'. $row["id"] .'</td>
          
          
                               </tr>  
                               ';  
                          }  
                          ?>  
                     </table>  
                </div>  
         <!--  </div>  -->
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({
          "order": [[ 1, "asc" ]],
        "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="form.php?id='+row[0]+'" target="_blank"><b>LEASE LETTER</b></a>/<a href="return_letter.php?id='+row[0]+'" target="_blank"><b>RETURN LETTER</b></a>/<a href="envelope.php?id='+row[0]+'" target="_blank"><b>ENVELOPE COVER</b></a>';
                   // return '<a href="form.php?id='+row[0]+'">FORM</a>';
                },
                "targets": 19
            },
            
          // { "order": [[ 1, "asc" ]]},
           /* "columnDefs": [*/
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    //return '<a href="editnew.php?id='+row[0]+'">EDIT</a>';
                    return '<a href="editnew.php?id='+row[0]+'" target="_blank"><b>EDIT</b></a>';
                },
                "targets": 20
            }
            ]
      });
       // "pagingType": "four_button";
       
      });
      

 
 </script>  