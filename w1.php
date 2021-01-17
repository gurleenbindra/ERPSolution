<?php
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['User']))
{
header("location:login.php");
}
?>
<!DOCTYPE HTML> 
<html lang="en">
<head>
<title>Form></title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="com.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js" integrity="sha512-rmZcZsyhe0/MAjquhTgiUcb4d9knaFc7b5xAfju483gbEXTkeJRUMIPk6s3ySZMYUHEcjKbjLjyddGWMrNEvZg==" crossorigin="anonymous"></script>
 <script>
function changeDate() {
  var x = document.getElementById("dateleased").value;
  document.getElementById("leasedate").value = x;
 // return x;
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
<?php 
include 'data1.php';
?>
</head>
<body>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <li class="navbar-brand" href="#"><?php echo $_SESSION['User'] ;?>&nbsp;&nbsp;</li>
    </div>
   <ul class="nav navbar-nav">
      <li ><a href="home.php">Home</a></li>
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
    <!--  <li><a href="sortform.php">Sort</a></li>-->
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
     <?php //echo date("Y-m-d"); ?>
    </ul>
  </div>
</nav>
<div align="center">
  <h3>Insert the values below: </h3>
<form method="post" action="insert2.php" id="f1">
<table>
    <tr>
<td>Date Leased:</td>
<td><input type="date" name="dateleased" id="dateleased" onchange="changeDate()" value="<?php echo date("Y-m-d"); ?>"></td>

</tr>
  <tr>
  <td>Name:</td>
  <td><input type="text" id="name" name="name" required>
  </td>
</tr>
<!--<tr>
  <td>Username:</td>
  <td><input type="text" id="username" name="username" minlength="8" required>
  </td>
</tr>-->
<tr>
  <td>Address:</td>
  <td><textarea id='address' name='address' rows="3" cols="50"></textarea>
  </td>
</tr>
<tr>
  <td>Phone No.:</td>
  <td><input type="text" id="phoneno" name="phoneno" placeholder="1234567890" >
  </td>
</tr>
<tr>
    <td>Email:</td>
    <td><input type="email" name="email" id="email" placeholder="abc@example.com" ></td>
</tr>
<tr>
  <td>Equipment Leased:</td>
  <td>
		    	<!-- equipment dropdown -->
		        <select id='sel_equipment' name='sel_equipment' >
		          	<option value='0' >Select Equipment</option>
		          	<?php 
		          	## Fetch equipment
					$stmt = $pdo->prepare("SELECT * FROM equipment ORDER BY equipment_id");
					$stmt->execute();
					$equipmentList = $stmt->fetchAll();

					foreach($equipmentList as $e){
						echo "<option value='".$e['equipment_name']."'>".$e['equipment_name']."</option>";
					}
		          	?>
		        	</select>
		      	</td>
</tr>
<tr>
<td>Model No.:</td>
<td>
			        <select id='sel_model' name='sel_model' >
			          	<option value='0' >select Model No.</option>
			          	
			        </select>
		      	</td>
</tr>
<tr>
    <td>Equipment No.:</td>
    <td><input type="text" name="equipmentno" id="equipmentno" placeholder="T1" ></td>
</tr>
<tr>
    <td>Leasing Date:</td>
    <td><input type="date"name="leasedate" id="leasedate" onchange="populateDate()" value="<?php echo date("Y-m-d"); ?>"></td>
</tr>
<tr>
    <td>Period of Hire</td>
    <td><input type="number" name="period" id="period" placeholder="6" onchange="populateDate()">
    <select name="duration" id="duration" onchange="populateDate()">
		<!--	<option value="0">Select Type</option>-->
			<option value="days">days</option>
			<option value="weeks" selected="selected">weeks</option>
			<option value="months">months</option>
		</select></td>
</tr>
<tr>
    <td>End Date:</td>
    <td><input type="date"name="enddate" id="enddate" ></td>
</tr>
<tr>
    <td>Rent(Incl. of Taxes):</td>
    <td><input type="text" name="rent" id="rent" placeholder="6500" ></td>
</tr>
<tr>
    <td>Security Charge:</td>
    <td><input type="text" name="sec" id="sec" placeholder="6500" ></td>
</tr>
<tr>
    <td>Carriage:</td>
    <td><input type="text" name="carriage" id="carriage" placeholder="500" ></td>
</tr>
<tr>
    <td>Booking Advance:</td>
    <td><input type="text" name="bookingadvance" id="bookingadvance" placeholder="200"</td>
</tr>
<tr>
    <td>Balance Due:</td>
    <td><input type="text" name="balancedue" id="balancedue" placeholder="500" ></td>
</tr>
<tr>
    <td>Payment Received upto:</td>
    <td><input type="date" name="paymentrecedupto" id="paymentrecedupto" placeholder="220" ></td>
</tr>
<tr>
    <td>Last Service Date:</td>
    <td><input type="date" name="lastservicedate" id="lastservicedate"></td>
</tr>
<tr>
    <td>Date Picked:</td>
    <td><input type="date" name="datepicked" id="datepicked" placeholder="" ></td>
</tr>
<tr>
    <td>GSTIN:</td>
    <td><input type="text" name="gstin" id="gstin" placeholder="" ></td>
</tr>

<tr>
    <td>Flag:</td>
    <td><input type="text" name="flag" id="flag" placeholder="" ></td>
</tr>
<tr>
    <td>To Be Picked:</td>
    <td><input type="date" name="tobepicked" id="tobepicked"></td>
</tr>
<tr>
    <td>Comments:</td>
    <td><textarea id='comments' name='comments' rows="3" cols="50"></textarea></td>
</tr>
<tr>
    <td>Click to Submit</td>
    <td><input type="submit" name="sub" value="submit"></td>
</tr>
</table>
<script type="text/javascript">
	$(document).ready(function(){

		// equipment
		$('#sel_equipment').change(function(){

			var equipid = $(this).val();
			
			// Empty model dropdown
			$('#sel_model').find('option').not(':first').remove();
		//	$('#sel_city').find('option').not(':first').remove();

			// AJAX request
			$.ajax({
				url: 'ajaxfile.php',
				type: 'post',
				data: {request: 1, equipid: equipid},
				dataType: 'json',
				success: function(response){
					
					var len = response.length;

		            for( var i = 0; i<len; i++)
		            {
		                var id = response[i]['id'];
		                var name = response[i]['name'];
		                    
		                $("#sel_model").append("<option value='"+id+"'>"+name+"</option>");

		            }
				}
			});
			
		});
	});
	</script>
</form>

</div>
</body>
</html> 
