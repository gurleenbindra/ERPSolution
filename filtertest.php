<?php
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['User']))
{
    header("location:login.php");
}
include 'data1.php';
//get equipment name
$equipment = '';
$query = "SELECT DISTINCT equipment FROM leaserecords ORDER BY equipment ASC";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
 $equipment .= '<option value="'.$row['equipment'].'">'.$row['equipment'].'</option>';
}
//get equipment number
$equipmentno = '';
$query = "SELECT DISTINCT equipmentno FROM leaserecords ORDER BY equipmentno ASC";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
 $equipmentno .= '<option value="'.$row['equipmentno'].'">'.$row['equipmentno'].'</option>';
}
//get model number
$modelno = '';
$query = "SELECT DISTINCT modelno FROM leaserecords ORDER BY modelno ASC";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
 $modelno .= '<option value="'.$row['modelno'].'">'.$row['modelno'].'</option>';
}
//count number of columns
$sql1="SELECT * FROM leaserecords";
 $stmt=$pdo->query($sql1);
 $stmt->execute();
 $n=$stmt->columnCount();
?>
<!DOCTYPE HTML> 
<html>
 <head>
  <title>Customer Details</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.js">
<script src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js" type="text/javascript"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
<style>
               th{
                   background-color: #ADD8E6;
               }
               #header
               {
                background-color: #ADD8E6;
               }
               .navbar-inverse {
                      position: fixed;
                      top: 0;
                      left: 0;
                      z-index: 9999;
                      width: 100%;
                      height: 50px;
                      
                    }
                    
                
</style>
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
      <li class="active"><a href="filter.php">View Data</a></li>
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
 
   </div></nav>
   <br>
   <br>
   <br>
   <div class="horizontal-scrollable" width="100%">
   	<div align="right" id="searchreset">
   	    <button type="button" name="reset" id="reset" class="btn btn-primary">Reset Filters</button>
     <button type="button" name="advancesearch" id="advancesearch" data-toggle="modal" data-target="#filter_data_Modal" class="btn btn-secondary">Advanced Search</button>
    </div>
    <div id="alert_message"></div>
    <table id="customer_data" class="table table-bordered table-striped">
        <h3 align="center"><b><u>Customer Details</u></b></h3>
     <thead>
      <tr>
      <th>S.No.</th>
		<!--<th><h3>USERNAME</h3></th>-->
		<th>DATE LEASED</th>
		<th>CUSTOMER'S NAME</th>
		<th>ADDRESS</th>
		<th>PHONE</th>
		<th>EMAIL</th>
		<th>EQUIPMENT LEASED</th>
		<th>EQUIPMENT NO.</th>
		<th>MODEL NO.</th>
		<th>PERIOD OF HIRE</th>
		<th>DURATION OF HIRE</th>
		<th><a href="#" id="leasedate">LEASING DATE</a></th>
		<th>END DATE</th>
		<th>RENT</th>
		<th>SECURITY</th>
		<th>CARRIAGE</th>
		<th>BOOKING ADVANCE</th>
		<th>BALANCE DUE</th>
		<th>PAYMENT RECEIVED UPTO</th>
		<th>LAST SERVICE DATE</th>
		<th>DATE PICKED</th>
		<th>GSTIN</th>
		<th>FLAG</th>
		<th>TO BE PICKED</th>
		<th>COMMENTS</th>
		<th>EDIT/LEASE LETTER</th>
		<th>DELETE</th>
      </tr>
     </thead>
     <tbody id="data"></tbody>
    </table>
    <br />
    <br />
    <br />
   </div>
   
 </body>
</html>
<div id="filter_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header" id="header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" align="center">Select Filters</h4>
   </div>
   <div class="modal-body" id="filtering">
      <div class="row">     
          <div class="col-md-6">
            <h4 align="center" ><b>EQUIPMENT DETAILS</b></h4>
            <div class="row">
                <label class="col-lg-5 control-label">EquipmentLeased</label>
                <div class="col-md-6">
                    <div class="form-group">
     	                  <select name="filter_equipment" id="filter_equipment" class="form-control" >
                            <option value="">Select Equipment</option>
                            <?php echo $equipment; ?>
                        </select>
                    </div>
                </div>
       </div>
      <div class="row">
            <label class="col-lg-5 control-label">EquipmentNo.</label>
            <div class="col-md-6">
                  <div class="form-group">
     	                  <select name="filter_equipmentno" id="filter_equipmentno" class="form-control" >
                              <option value="">Select Equipment No.</option>
                                 <?php echo $equipmentno; ?>
                         </select>
                  </div>
            </div>
     </div>
     <div class="row">
          <label class="col-lg-5 control-label">ModelNo.</label>
          <div class="col-md-6">
                <div class="form-group">
     	              <select name="filter_modelno" id="filter_modelno" class="form-control" >
                        <option value="">Select Model No.</option>
                        <?php echo $modelno; ?>
                    </select>
                </div>
          </div>
    </div>
</div>
<div class="col-md-6">
  <h4 align="center"><b>CUSTOMER DETAILS</b></h4>
     <div class="row">
          <label class="col-lg-5 control-label">Name</label>
          <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="filter_name" id="filter_name" class="form-control" placeholder="enter name" >
                 </div>
          </div>
     </div>
     <div class="row">
          <label class="col-lg-5 control-label">Address</label>
          <div class="col-md-6">
               <div class="form-group">
                    <input type="text" name="filter_address" id="filter_address" class="form-control" placeholder="enter address" >
                </div>
          </div>
      </div>
      <div class="row">
              <label class="col-lg-5 control-label">PhoneNo.</label>
              <div class="col-md-6">
                    <div class="form-group">
                          <input type="text" name="filter_phoneno" id="filter_phoneno" class="form-control" placeholder="enter phoneno" >
                  </div>
              </div>
      </div>
      <div class="row">  
            <label class="col-lg-5 control-label">Email</label>
            <div class="col-md-6">
                  <div class="form-group">
                        <input type="text" name="filter_email" id="filter_email" class="form-control" placeholder="enter email" >
                  </div>
            </div>
      </div>
</div>
</div>
  <div class="row">
    <div class="col-md-12">
      <h4 align="center"><b>LEASE DETAILS</b></h4>
      <div class="row">
        
           <label class="col-lg-2 control-label">PeriodofHire</label>
           <div class="col-md-4">
                <div class="form-group">
                      <input type="number" name="filter_period" id="filter_period" class="form-control" placeholder="enter period" >
                </div>
          </div>
      </div>
      <div class="row">
        
            <label class="col-lg-2 control-label">Rent</label>
                  <div class="col-md-3">
                        <div class="form-group">
                              <select name="filter_measure" id="filter_measure" class="form-control">
                                      <option value="">Select Order</option>
                                      <option value="lessthan">less than</option>
                                      <option value="greaterthan">greater than</option>
                                      <option value="equalto">equal to</option>
                                      <option value="between">between</option>
                              </select>
                        </div>
                  </div>
                <div class="col-md-3">
                     <div class="form-group">
                          <input type="number" name="filter_onerent" id="filter_onerent" class="form-control" placeholder="enter value1" >
                          <label class="col-lg-2 control-label">Value1</label>
                      </div>
                </div>
                <div class="col-md-3">
                     <div class="form-group">
                          <input type="number" name="filter_tworent" id="filter_tworent" class="form-control" placeholder="enter value2" >
                          <label class="col-lg-2 control-label">Value2</label>
                      </div>
                </div>
      </div>
      <div class="row"> 
           <label class="col-lg-2 control-label">Security</label>
           <div class="col-md-3">
                <div class="form-group">
                     <select name="filter_sec" id="filter_sec" class="form-control">
                            <option value="">Select Order</option>
                            <option value="lessthan">less than</option>
                            <option value="greaterthan">greater than</option>
                            <option value="equalto">equal to</option>
                            <option value="between">between</option>
                     </select>
                </div>
           </div>
          <div class="col-md-3">
               <div class="form-group">
                    <input type="number" name="filter_onesec" id="filter_onesec" class="form-control" placeholder="enter value1" >
                    <label class="col-lg-2 control-label">Value1</label>
               </div>
          </div>
          <div class="col-md-3">
               <div class="form-group">
                    <input type="number" name="filter_twosec" id="filter_twosec" class="form-control" placeholder="enter value2" >
                    <label class="col-lg-2 control-label">Value2</label>
               </div>
          </div>
      </div>
      <div class="row">
           <label class="col-lg-2 control-label">Carriage</label>
           <div class="col-md-3">
                <div class="form-group">
                     <select name="filter_carriage" id="filter_carriage" class="form-control">
                             <option value="">Select Order</option>
                             <option value="lessthan">less than</option>
                             <option value="greaterthan">greater than</option>
                             <option value="equalto">equal to</option>
                             <option value="between">between</option>
                     </select>
                </div>
            </div>
         <div class="col-md-3">
              <div class="form-group">
                   <input type="number" name="filter_onecar" id="filter_onecar" class="form-control" placeholder="enter value1" >
                   <label class="col-lg-2 control-label">Value1</label>
              </div>
         </div>
         <div class="col-md-3">
             <div class="form-group">
                  <input type="number" name="filter_twocar" id="filter_twocar" class="form-control" placeholder="enter value2" >
                  <label class="col-lg-2 control-label">Value2</label>
             </div>
         </div>
      </div>
      <div class="row">
           <label class="col-lg-2 control-label">Comment</label>
           <div class="col-md-4">
                <div class="form-group">
                     <input type="text" name="filter_comments" id="filter_comments" class="form-control" placeholder="enter comment" >
                </div>
           </div>
      </div>
      <div class="row">
           <label class="col-md-1 control-label">Date</label>
           <div class="col-md-3">
                <div class="form-group">
                     <select name="filter_date" id="filter_date" class="form-control" >
                             <option value="">SelectType</option>
                             <option value="leasedate">leasedate</option>
                             <option value="enddate">enddate</option>
                             <option value="dateleased">dateleased</option>
                             <option value="lastservicedate">lastservicedate</option>
                             <option value="datepicked">datepicked</option>
                             <option value="tobepicked">tobepicked</option>
                             <option value="paymentrecedupto">paymentreceivedupto</option>
       
                     </select>
               </div>
         </div>
          <div class="col-md-2">
               <div class="form-group">
                    <select name="filter_order" id="filter_order" class="form-control" >
                            <option value="">SelectOrder</option>
                            <option value="on">on</option>
                            <option value="before">before</option>
                            <option value="after">after</option>
                            <option value="between">between</option>
                    </select>
               </div>
          </div>
          <div class="col-md-3">
               <div class="form-group">
                    <input type="date" name="filter_onedate" id="filter_onedate" class="form-control" placeholder="enter date" >
                    <label class="col-lg-2 control-label">Date1</label>
               </div>
          </div>
          <div class="col-md-3">
               <div class="form-group">
                    <input type="date" name="filter_twodate" id="filter_twodate" class="form-control" placeholder="enter date" >
                    <label class="col-lg-2 control-label">Date2</label>
               </div>
          </div>
      </div>
     <div class="row">
          <div class="form-group" align="center">
               <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>
          </div>
     </div>

  </div>
</div>
</div>
    <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
 </div>
</div>
     	
     	
     	
     

     	
    <!-- <div class="row">
         <div class="col-lg-2"></div>
         <div class="col-lg-1">
     <label class="col-lg-1 control-label">LeaseDate</label>
     </div>
     	<div class="col-md-2">
     	<div class="form-group">
     	<select name="filter_date" id="filter_date" class="form-control" required>
       <option value="">Select Type</option>
       <option value="leasedate">leasedate</option>
       <option value="enddate">before</option>
       <option value="dateleased">after</option>
       <option value="datepicked">between</option>
      </select>
     	</div></div>
     	<div class="col-md-2">
     	<div class="form-group">
     	    <select name="filter_order" id="filter_order" class="form-control" required>
       <option value="">Select Order</option>
       <option value="on">on</option>
       <option value="before">before</option>
       <option value="after">after</option>
       <option value="between">between</option>
      </select>
     	</div></div>
     	<div class="col-md-2">
     	<div class="form-group">
     	<input type="date" name="filter_onedate" id="filter_onedate" class="form-control" placeholder="enter date" >
     	<label class="col-lg-2 control-label">Date1</label>
     	</div></div>
     	<div class="col-md-2">
     	<div class="form-group">
     	<input type="date" name="filter_twodate" id="filter_twodate" class="form-control" placeholder="enter date" >
     	 <label class="col-lg-2 control-label">Date2</label>
     	</div></div>
     	</div>
     	<div class="row">
     	    <div class="col-lg-2"></div>
     	    <div class="col-lg-1">
     	    <label class="col-lg-2 control-label">EndDate</label>
     	    </div>
     	    <div class="col-lg-1">
     	<div class="form-group">
     	    
     	<input type="hidden" name="filter_enddate" id="filter_enddate" class="form-control" placeholder="enter enddate" value="567">
     </div></div>
     <div class="col-md-2">
     	<div class="form-group">
     	    <select name="filter_order" id="filter_order" class="form-control" required>
       <option value="">Select Order</option>
       <option value="on">on</option>
       <option value="before">before</option>
       <option value="after">after</option>
       <option value="between">between</option>
      </select>
     	</div></div>
     	<div class="col-md-2">
     	<div class="form-group">
     	<input type="date" name="filter_onedate" id="filter_onedate" class="form-control" placeholder="enter date" >
     	<label class="col-lg-2 control-label">Date1</label>
     	</div></div>
     	<div class="col-md-2">
     	<div class="form-group">
     	<input type="date" name="filter_twodate" id="filter_twodate" class="form-control" placeholder="enter date" >
     	 <label class="col-lg-2 control-label">Date2</label>
     	</div></div>
     </div>
     <div class="row">
         <div class="col-lg-2"></div>
         <div class="col-lg-1">
         <label class="col-lg-2 control-label">DateLeased</label>
         </div>
     <div class="col-lg-1">
     	<div class="form-group">
     	    
     	<input type="hidden" name="filter_enddate" id="filter_dateleased" class="form-control" placeholder="enter dateleased"  value="123">
     </div></div>
     <div class="col-md-2">
     	<div class="form-group">
     	    <select name="filter_order" id="filter_order" class="form-control" required>
       <option value="">Select Order</option>
       <option value="on">on</option>
       <option value="before">before</option>
       <option value="after">after</option>
       <option value="between">between</option>
      </select>
     	</div></div>
     	<div class="col-md-2">
     	<div class="form-group">
     	<input type="date" name="filter_onedate" id="filter_onedate" class="form-control" placeholder="enter date" >
     	<label class="col-lg-2 control-label">Date1</label>
     	</div></div>
     	<div class="col-md-2">
     	<div class="form-group">
     	<input type="date" name="filter_twodate" id="filter_twodate" class="form-control" placeholder="enter date" >
     	 <label class="col-lg-2 control-label">Date2</label>
     	</div></div>
     </div>
     <div class="row">
         <div class="col-lg-2"></div>
         <div class="col-lg-1">
         <label class="col-lg-2 control-label">LastServiceDate</label>
         </div>
     <div class="col-lg-1">
     	<div class="form-group">
     	<input type="hidden" name="filter_lastservicedate" id="filter_lastservicedate" class="form-control" placeholder="enter lastservicedate" >
     </div></div>
     <div class="col-md-2">
     	<div class="form-group">
     	    <select name="filter_order" id="filter_order" class="form-control" required>
       <option value="">Select Order</option>
       <option value="on">on</option>
       <option value="before">before</option>
       <option value="after">after</option>
       <option value="between">between</option>
      </select>
     	</div></div>
     	<div class="col-md-2">
     	<div class="form-group">
     	<input type="date" name="filter_date1" id="filter_date1" class="form-control" placeholder="enter date" >
     	<label class="col-lg-2 control-label">Date1</label>
     	</div></div>
     	<div class="col-md-2">
     	<div class="form-group">
     	<input type="date" name="filter_date2" id="filter_date2" class="form-control" placeholder="enter date" >
     	 <label class="col-lg-2 control-label">Date2</label>
     	</div></div>
     </div>
     <div class="row">
         <div class="col-lg-2"></div>
         <div class="col-lg-1">
         <label class="col-lg-2 control-label">DatePicked</label>
         </div>
     <div class="col-lg-1">
     	<div class="form-group">
     	    
     	<input type="hidden" name="filter_datepicked" id="filter_datepicked" class="form-control" placeholder="enter datepicked"  value="678">
     </div></div>
     <div class="col-md-2">
     	<div class="form-group">
     	    <select name="filter_order" id="filter_order" class="form-control" required>
       <option value="">Select Order</option>
       <option value="on">on</option>
       <option value="before">before</option>
       <option value="after">after</option>
       <option value="between">between</option>
      </select>
     	</div></div>
     	<div class="col-md-2">
     	<div class="form-group">
     	<input type="date" name="filter_onedate" id="filter_onedate" class="form-control" placeholder="enter date" >
     	<label class="col-lg-2 control-label">Date1</label>
     	</div></div>
     	<div class="col-md-2">
     	<div class="form-group">
     	<input type="date" name="filter_twodate" id="filter_twodate" class="form-control" placeholder="enter date" >
     	 <label class="col-lg-2 control-label">Date2</label>
     	</div></div>
     </div>-->
     
     <!--dropdown date filter-->
     

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
 
   // $.fn.dataTable.moment( 'DD-MM-YYYY' );
  fill_datatable();
  
  function fill_datatable(filter_equipment='',filter_equipmentno='',filter_modelno='',filter_name='',filter_address='',filter_phoneno='',filter_email='',filter_comments='',filter_rent='',filter_sec='',filter_onesec='',filter_twosec='',filter_carriage='',filter_onecar='',filter_twocar='',filter_period='',filter_leasedate='',filter_enddate='',filter_dateleased='',filter_lastservicedate='',filter_datepicked='',filter_date='',filter_order='',filter_onedate='',filter_twodate='',filter_date1='',filter_date2='',filter_measure='',filter_onerent='',filter_tworent='')
  {
      // $.fn.dataTable.moment( 'YYYY-MM-DD HH:mm' );
   var dataTable = $('#customer_data').DataTable({
    "processing" : true,
    "serverSide" : false,
    //"stateSave": true,
    // "rowId": 'extn',
      //  "select": true,
    "order" : [],
    //"searching" : false,
    "ajax" : {
     url:"filterselect.php",
     type:"POST",
     data:{
      filter_equipment:filter_equipment,filter_equipmentno:filter_equipmentno,filter_modelno:filter_modelno,filter_name:filter_name,filter_address:filter_address,filter_phoneno:filter_phoneno,filter_email:filter_email,filter_comments:filter_comments,filter_rent:filter_rent,filter_sec:filter_sec,filter_onesec:filter_onesec,filter_twosec:filter_twosec,filter_carriage:filter_carriage,filter_onecar:filter_onecar,filter_twocar:filter_twocar,filter_period:filter_period,filter_leasedate:filter_leasedate,filter_enddate:filter_enddate,filter_dateleased:filter_dateleased,filter_lastservicedate:filter_lastservicedate,filter_datepicked:filter_datepicked,filter_date:filter_date,filter_order:filter_order,filter_onedate:filter_onedate,filter_twodate:filter_twodate,filter_date1:filter_date1,filter_date2:filter_date2,filter_measure:filter_measure,filter_onerent:filter_onerent,filter_tworent:filter_tworent
     }
    },
    "order": [[ 1, "asc" ]],
    "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="editnew.php?id='+row[0]+'" target="_blank"><b>EDIT</b></a>/<a href="form.php?id='+row[0]+'" target="_blank"><b>LEASE LETTER</b></a>/<a href="return_letter.php?id='+row[0]+'" target="_blank"><b>RETURN LETTER</b></a>/<a href="envelope.php?id='+row[0]+'" target="_blank"><b>ENVELOPE COVER</b></a>';
                   // return '<a href="form.php?id='+row[0]+'">FORM</a>';
                },
               // "orderable": false,
                "targets":<?php echo $n; ?>
            },
            {
                "orderable":false,
                "targets":[-1, -2]
            },
            {
                "width": "100%", "targets":<?php echo ($n-1); ?>
            },
            {
                "type":"date",
                "targets":[11]
            }
            
          /*  {"data": "startdate", "title": "Start Date", "render": function(data, type) {
                return type === 'sort' ? data : moment(data).format('L');
            }}
            {
                "targets": 11,
     "render": '$.fn.dataTable.render.moment('DD-MM-YYYY' )'
            }*/
            ]
   });
   
  }
    $('#customer_data tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
  $('#reset').on('click', function(){
                    dataTable.search( '' ).columns().search( '' ).draw();
                    fill_datatable();
});

  
  $('#filter').click(function(){
         var filter_equipment = $('#filter_equipment').val();
         var filter_equipmentno = $('#filter_equipmentno').val();
         var filter_modelno = $('#filter_modelno').val();
         var filter_name = $('#filter_name').val();
         var filter_address = $('#filter_address').val();
         var filter_phoneno = $('#filter_phoneno').val();
         var filter_email = $('#filter_email').val();
         var filter_comments = $('#filter_comments').val();
         var filter_rent = $('#filter_rent').val();
         var filter_sec = $('#filter_sec').val();
         var filter_onesec = $('#filter_onesec').val();
          var filter_twosec = $('#filter_twosec').val();
         var filter_carriage = $('#filter_carriage').val();
         var filter_onecar = $('#filter_onecar').val();
          var filter_twocar = $('#filter_twocar').val();
         var filter_period = $('#filter_period').val();
         var filter_leasedate = $('#filter_leasedate').val();
         var filter_enddate = $('#filter_enddate').val();
         var filter_dateleased = $('#filter_dateleased').val();
          var filter_lastservicedate = $('#filter_lastservicedate').val();
          var filter_datepicked = $('#filter_datepicked').val();
          var filter_date = $('#filter_date').val();
          var filter_order = $('#filter_order').val();
          var filter_onedate = $('#filter_onedate').val();
          var filter_date1 = $('#filter_date1').val();
          var filter_date2 = $('#filter_date2').val();
          var filter_twodate = $('#filter_twodate').val();
          var filter_measure = $('#filter_measure').val();
          var filter_onerent = $('#filter_onerent').val();
          var filter_tworent = $('#filter_tworent').val();
          
           if(filter_equipment != ''|| filter_equipmentno != '' || filter_modelno != '' || filter_name != '' || filter_address != '' || filter_phoneno != '' || filter_email !='' || filter_comments != '' || filter_rent != '' || filter_sec != '' || filter_onesec !='' || filter_twosec != '' || filter_carriage != '' || filter_onecar != '' || filter_twocar != '' || filter_period != '' || filter_leasedate != '' || filter_enddate != '' || filter_dateleased != '' || filter_lastservicedate != '' || filter_datepicked != '' || filter_date != '' || filter_order != '' || filter_onedate != '' || filter_twodate != '' || filter_date1 != '' || filter_date2 != '' || filter_measure != '' ||filter_onerent != '' || filter_tworent != '' )
           {
                $('#customer_data').DataTable().destroy();
                fill_datatable(filter_equipment,filter_equipmentno,filter_modelno,filter_name,filter_address,filter_phoneno,filter_email,filter_comments,filter_rent,filter_sec,filter_onesec,filter_twosec,filter_carriage,filter_onecar,filter_twocar,filter_period,filter_leasedate,filter_enddate,filter_dateleased,filter_lastservicedate,filter_datepicked,filter_date,filter_order,filter_onedate,filter_twodate,filter_date1,filter_date2,filter_measure,filter_onerent,filter_tworent);
               // $('#add_data_Modal')[0].reset();
                $('#filter_data_Modal').modal('hide'); 
           }
           else
           {
                alert('Select filter option');
                $('#customer_data').DataTable().destroy();
                fill_datatable();
           }
          });
         
           /* $('#reset').click(function()
            {
                $("#filter_data_Modal")[0].reset();
            });*/
            $(document).on('click', '.delete', function(){
                    var id = $(this).attr("id");
                    if(confirm("Are you sure you want to remove this?"))
                     {
                          $.ajax({
                        url:"delete.php",
                         method:"POST",
                        data:{id:id},
                         success:function(data){
                        $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                         $('#customer_data').DataTable().destroy();
                        fill_datatable();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
              function update_data(id, column_name, value)
              {
               $.ajax({
                url:"updaterow.php",
                method:"POST",
                data:{id:id, column_name:column_name, value:value},
                success:function(data)
                {
                 $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                 $('#customer_data').DataTable().destroy();
                 fill_datatable();
                }
               });
               setInterval(function(){
                $('#alert_message').html('');
               }, 5000);
              }
            
              $(document).on('blur', '.update', function(){
               var id = $(this).data("id");
               var column_name = $(this).data("column");
               var type=$(this).data("type");
               var value = $(this).text();
               update_data(id, column_name, value);
              });
              
       /*     $('#leasedate').on( 'click', 'th', function (e){
                e.preventDefault();
                $.ajax({
                    url:"sortdate.php",
                    method:"POST",
                    data:{leasedate:$( this ).attr( "id" )},
                    success:function(data)
                    {
                         $('#customer_data').DataTable().destroy();
                        fill_datatable();
                    }
                });
  */
 });
 
</script>
