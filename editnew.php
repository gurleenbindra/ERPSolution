<?php
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['User']))
{
    header("location:login.php");
}
?>
<!DOCTYPE HTML> 
<html>
<head>
<title>EDIT></title>
<?php
include 'data1.php';
?>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js" integrity="sha512-rmZcZsyhe0/MAjquhTgiUcb4d9knaFc7b5xAfju483gbEXTkeJRUMIPk6s3ySZMYUHEcjKbjLjyddGWMrNEvZg==" crossorigin="anonymous"></script>
 <script>
function changeDate() {
  var x = document.getElementById("dateleased").value;
  document.getElementById("leasedate").value = x;
  //return x;
}
</script>
<script type="text/javascript">
	//format (YYYY-MM-DD HH:mm:ss)
function populateDate()
{
//var start_date = '2019-04-23'; 
//var minutes = 5;
var start_date=document.getElementById('leasedate').value;
var minutes=document.getElementById('period').value;
var duration=document.getElementById('duration').value;

// result should be '2019-04-23 20:20:00'
var end_date = moment(start_date).add(minutes, duration).format('YYYY-MM-DD');
document.getElementById('enddate').value=end_date;
//console.log(end_date);
}
</script>
<link href="com.css" rel="stylesheet">
<style>
.alert {
  padding: 20px;
  background-color: #008000;
  color: white;
  position: fixed;
  top: 20%;
  left: 0;
  z-index: 9999;
  width: 100%;
  height: 50px;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
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
      <li class="navbar-brand" href="#"><?php echo $_SESSION['User'] ;?> &nbsp;&nbsp;</li>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="home.php">Home</a></li>
      <!--<li class="active"><a href="paging.php">View Data</a></li>-->
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
<br>
<br>
<br>
<br>
<div align="center">
  <?php
    $id=$_GET['id'];
    $sql='SELECT * FROM  leaserecords where id=?';
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$id]);
    $k1=$stmt->fetchAll();
    foreach($k1 as $g)
    {

    }
  ?>
    <form method='post' action='' id='f1'>
        <?php
        if (!isset($_POST['sub'])) {?>
        <table>
            <!--1-->
            <tr>
                <td>Date Leased:</td>
                <td><input type='date' name='dateleased' id='dateleased' onchange="changeDate()" value="<?php echo $g['dateleased'] ?>"></td>
            </tr>
            <!--2-->
            <tr>
                <td>Name:</td>
                <td><input type='textarea' id='name' name='name' value="<?php echo $g['name'];?>"></td>
            </tr>
            <!--3-->
            <tr>
                <td>Address: </td>
                <td><textarea id='address' name='address' rows="3" cols="50"><?php echo $g['address']; ?></textarea></td>
            </tr>
            <!--4-->
            <tr>
                <td>Phone No.:</td>
                <td><input type='text' id='phoneno' name='phoneno' value="<?php echo $g['phoneno'];?>"></td>
            </tr>
            <!--5-->
            <tr>
                <td>Email:</td>
                <td><input type='email' name='email' id='email' value="<?php echo $g['email'];?>"></td>
            </tr>
            <!--6-->
            <tr>
                <td>Equipment Leased:</td>
                <td><input type='text' id='equipment' name='equipment' value="<?php echo $g['equipment'];?>"></td>
            </tr>
            <!--7-->
            <tr>
                <td>Model No.:</td>
                <td><input type='text' name='modelno' id='modelno' value="<?php echo $g['modelno'];?>"></td>
            </tr>
            
            <!--8-->
            <tr>
                <td>Equipment No.:</td>
                <td><input type='text' name='equipmentno' id='equipmentno' value="<?php echo $g['equipmentno'];?>"></td>
            </tr>
            <!--9-->
            <tr>
                <td>Leasing Date:</td>
                <td><input type='date'name='leasedate' id='leasedate' onchange="populateDate()" value="<?php echo $g['leasedate'];?>"></td>
            </tr>
            <!--10-->
            <tr>
                <td>Period Of Hire:</td>
                <td><input type='number' name='period' id='period' onchange="populateDate()" value="<?php echo $g['period'];?>">
                <select name="duration" id="duration" onchange="populateDate()">
                    
                    <?php if($g['duration']=='days'){;?>
	        	<!--<option value="0">Select Type</option>-->
			  <!--  <option value="days">days</option>-->
			  <option value="<?php echo $g['duration'];?>" selected="selected"><?php echo $g['duration'];?></option>
			    <option value="weeks" >weeks</option>
			    <option value="months">months</option>
		    <?php }
		    else if($g['duration']=='weeks')
		    {?>
		        <option value="<?php echo $g['duration'];?>" selected="selected"><?php echo $g['duration'];?></option>
		        <option value="days">days</option>
			    <option value="months">months</option>
		   <?php }
		   else if($g['duration']=='months')
		   {?>
		        <option value="<?php echo $g['duration'];?>" selected="selected"><?php echo $g['duration'];?></option>
		       <option value="days">days</option>-->
			    <option value="weeks" >weeks</option>
		 <?php  }
		    else
		    {?>
		        <option value="days">days</option>
			    <option value="weeks" >weeks</option>
			    <option value="months">months</option>
		  <?php  }
		    ?>
		    </select></td>
            </tr>
            <!--11-->
            <tr>
                <td>End Date:</td>
                <td><input type='date'name='enddate' id='enddate' value="<?php echo $g['enddate'];?>"></td>
            </tr>
            <!--12-->
            <tr>
                <td>Rent(Incl. of taxes):</td>
                <td><input type='text' name='rent' id='rent' value="<?php echo $g['rent'];?>"></td>
            </tr>
            <!--13-->
            <tr>
                <td>Security:</td>
                <td><input type='text' name='sec' id='sec' value="<?php echo $g['sec'];?>"></td>
            </tr>
            <!--14-->
            <tr>
                <td>Carriage:</td>
                <td><input type='text' name='carriage' id='carriage' value="<?php echo $g['carriage'];?>"></td>
            </tr>
            <!--15-->
            <tr>
                <td>Booking Advance:</td>
                <td><input type="text" name="bookingadvance" id="bookingadvance" value="<?php echo $g['bookingadvance'];?>" ></td>
            </tr>
            <!--16-->
            <tr>
                <td>Balance Due:</td>
                <td><input type="text" name="balancedue" id="balancedue" value="<?php echo $g['balancedue'];?>" ></td>
            </tr>
            <!--17-->
            <tr>
                <td>Payment Received Upto:</td>
                <td><input type='date' name='paymentrecedupto' id='paymentrecedupto' value="<?php echo $g['paymentrecedupto'];?>"></td>
            </tr>
            <!--18-->
            <tr>
                <td>Last Service Date:</td>
                <td><input type='date' name='lastservicedate' id='lastservicedate' value="<?php echo $g['lastservicedate'];?>"></td>
            </tr>
            <!--19-->
            <tr>
                <td>Date Picked:</td>
                <td><input type='date' name='datepicked' id='datepicked' value="<?php echo $g['datepicked'];?>"></td>
            </tr>
            <!--20-->
            <tr>
                <td>GSTIN:</td>
                <td><input type="text" name="gstin" id="gstin" value="<?php echo $g['gstin'];?>" ></td>
            </tr>
            <!--21-->
            <tr>
                <td>Flag:</td>
                <td><input type="text" name="flag" id="flag" value="<?php echo $g['flag'];?>"></td>
            </tr>
            <!--22-->
             <tr>
                <td>To Be Picked:</td>
                <td><input type='date' name='tobepicked' id='tobepicked' value="<?php echo $g['tobepicked'];?>"></td>
            </tr>
            <!--23-->
            <tr>
                <td>Comments:</td>
                <td><textarea id='comments' name='comments' rows="3" cols="50"><?php echo $g['comments'];?></textarea></td>
            </tr>
            <tr>
                <td>Click to Update:</td>
                <td><input type='submit' name='sub'id='submit' value='UPDATE'></td>
            </tr>
        </table>
        <?php }?>
    </form>
    </div>





<?php if (isset($_POST['sub'])) 
 {
 	$name=$_POST['name'];
    $address=$_POST['address'];
    $phone=$_POST['phoneno'];
    $leasingdate=$_POST['leasedate'];
    $enddate=$_POST['enddate'];
    $equipmentleased=$_POST['equipment'];
    $equipmentno=$_POST['equipmentno'];
    $modelno=$_POST['modelno'];
    $periodofhire=$_POST['period'];
    $duration=$_POST['duration'];
    $rent=$_POST['rent'];
    $sec=$_POST['sec'];
    $email=$_POST['email'];
    $carriage=$_POST['carriage'];
    $comments=$_POST['comments'];
    $paymentrecedupto=$_POST['paymentrecedupto'];
    $lastservicedate=$_POST['lastservicedate'];
    $datepicked=$_POST['datepicked'];
    $dateleased=$_POST['dateleased'];
    $gstin=$_POST['gstin'];
    $balancedue=$_POST['balancedue'];
    $flag=$_POST['flag'];
    $bookingadvance=$_POST['bookingadvance'];
    $tobepicked=$_POST['tobepicked'];
    $sql='UPDATE leaserecords Set name =?,
    	address=?,
    	phoneno=?,
    	leasedate=?,
    	enddate=?,
    	equipment=?,
    	equipmentno=?,
    	modelno=?,
    	period=?,
    	duration=?,
    	rent= ?,
    	sec=?,
    	email=?,
    	carriage=?,
    	comments=?,
    	paymentrecedupto=?,
    	lastservicedate=?,
    	datepicked=?,
    	dateleased=?,
    	gstin=?,
    	balancedue=?,
    	flag=?,
    	bookingadvance=?,
    	tobepicked=?
 WHERE id= ?';
 $stmt= $pdo->prepare($sql);
 $stmt->execute([$name, $address,$phone,$leasingdate,$enddate,$equipmentleased,$equipmentno,$modelno,$periodofhire,$duration,$rent,$sec,$email,$carriage,$comments,$paymentrecedupto,$lastservicedate,$datepicked,$dateleased,$gstin,$balancedue,$flag,$bookingadvance,$tobepicked,
 $id]);
?>
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Success!</strong> Value updated.                                      
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
    <table class="table table-striped table-hover">
	<thead>
		<th><h3>S.No.</h3></th>
		<!--<th><h3>USERNAME</h3></th>-->
		<th><h3>DATE LEASED</h3></th>
		<th><h3>CUSTOMER'S NAME</h3></th>
		<th><h3>ADDRESS</h3></th>
		<th><h3>PHONE</h3></th>
		<th><h3>EMAIL</h3></th>
		<th><h3>EQUIPMENT LEASED</h3></th>
		<th><h3>EQUIPMENT NO.</h3></th>
		<th><h3>MODEL NO.</h3></th>
		<th><h3>PERIOD OF HIRE</h3></th>
		<th><h3>DURATION OF HIRE</h3></th>
		<th><h3>LEASING DATE</h3></th>
		<th><h3>END DATE</h3></th>
		<th><h3>RENT</h3></th>
		<th><h3>SECURITY</h3></th>
		<th><h3>CARRIAGE</h3></th>
		<th><h3>BOOKING ADVANCE</h3></th>
		<th><h3>BALANCE DUE</h3></th>
		<th><h3>PAYMENT RECEIVED UPTO</h3></th>
		<th><h3>LAST SERVICE DATE</h3></th>
		<th><h3>DATE PICKED</h3></th>
		<th><h3>GSTIN</h3></th>
		<th><h3>FLAG</h3></th>
		<th><h3>TO BE PICKED</h3></th>
		<th><h3>COMMENTS</h3></th>
	</thead>
	<tbody>
	    <?php	
	            //fetch 
				//$a=1;
				$sql="SELECT * FROM leaserecords WHERE id=?";
				$stmt=$pdo->prepare($sql);
				$stmt->execute([$id]);
				$data=$stmt->fetchAll();
		// print_r($data);
				foreach ($data as $k)
				 {}
				 
						?>
						<tr>
							<td><?php echo $k['id'];?></td>
							<!--<td>// echo $k['username']</td>-->
							<td><?php echo $k['dateleased'];?></td>
							<td><?php echo $k['name'];?></td>
							<td><?php echo $k['address'];?></td>
							<td><?php echo $k['phoneno'];?></td>
							<td><?php echo $k['email'];?></td>
							<td><?php echo $k['equipment'];?></td>
							<td><?php echo $k['equipmentno'];?></td>
							<td><?php echo $k['modelno'];?></td>
							<td><?php echo $k['period'];?></td>
							<td><?php echo $k['duration'];?></td>
							<td><?php echo $k['leasedate'];?></td>
							<td><?php echo $k['enddate'];?></td>
							<td><?php echo $k['rent'];?></td>
							<td><?php echo $k['sec'];?></td>
							<td><?php echo $k['carriage'];?></td>
							<td><?php echo $k['bookingadvance'];?></td>
							<td><?php echo $k['balancedue'];?></td>
							<td><?php echo $k['paymentrecedupto']?></td>
							<td><?php echo $k['lastservicedate']?></td>
							<td><?php echo $k['datepicked'];?></td>
							<td><?php echo $k['gstin'];?></td>
							<td><?php echo $k['flag'];?></td>
							<td><?php echo $k['tobepicked'];?></td>
							<td><?php echo $k['comments'];?></td>
						</tr>
				
		
	</tbody>
	</table>
	
<!--<a href="paging.php">VIEW DATA</a>-->

<?php }?>
</body>
</html>
