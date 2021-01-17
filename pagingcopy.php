<?php
include 'data1.php';
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
?><!DOCTYPE html>
<html>
<head>
	<title>CUSTOMER DETAILS</title>
	<!--<link href="com.css" rel="stylesheet">-->
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
	
	<!--<a href="w1.php">Insert Data</a>-->
	 <script>
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#customer_details tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
	
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
</nav><?php
if(!isset($_SESSION['User']))
{
    header("location:login.php");
    
}

?>
<div class="form-group" align="right">
   <input id="search" type="text" placeholder="Search.." align="right">
   </div>
<h2 style="text-align: center"><u>CUSTOMER DETAILS</u></h2>
	<?php
	//define how many results per page
	$results_per_page=10;
	//find out the number of results stored in db
	//$sql="SELECT * FROM leaserecords";
	$number_of_results = $pdo->query('select count(*) from leaserecords')->fetchColumn();

	//determine total number of pages available
	$number_of_pages=ceil($number_of_results/$results_per_page);
	//determine on which page visitor is currently on
	if (!isset($_GET['page'])) 
	{
		$page=1;
	}
	else
	{
		$page=$_GET['page'];
	}
	//determine the sql LIMIT starting number for the results on the displaying page
	$this_page_first_result=($page-1)*$results_per_page;


	//display the links to the page
	for($page=1;$page<=$number_of_pages;$page++)
	{
		if($page==1)
		{?>
			<a href="paging.php?page=<?php echo $page;?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="paging.php?page=<?php echo $page;?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="paging.php?page=<?php echo $page;?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}

	?>
<table id="customer_data" class="table table-striped table-hover">
    
	<thead>
		<th><h3>S.No.</h3></th>
		<!--<th><h3>USERNAME</h3></th>-->
		<th><h3>DATE LEASED</h3></th>
		<th><h3>CUSTOMER'S NAME</h3></th>
		<th><h3>ADDRESS</h3></th>
		<th><h3>PHONE</h3></th>
		<th><h3>LEASING DATE</h3></th>
		<th><h3>END DATE</h3></th>
		<th><h3>EQUIPMENT LEASED</h3></th>
		<th><h3>EQUIPMENT NO.</h3></th>
		<th><h3>MODEL NO.</h3></th>
		<th><h3>PERIOD OF HIRE</h3></th>
		<th><h3>RENT</h3></th>
		<th><h3>SECURITY</h3></th>
		<th><h3>CARRIAGE</h3></th>
		<th><h3>COMMENTS</h3></th>
		<th><h3>EMAIL</h3></th>
		<th><h3>PAYMENT RECEIVED UPTO</h3></th>
		<th><h3>LAST SERVICE DATE</h3></th>
		<th><h3>DATE PICKED</h3></th>


	</thead>
	<tbody id="customer_details">

		<?php					
				$a=1;
				$sql="SELECT * FROM leaserecords ORDER BY id DESC LIMIT $this_page_first_result, $results_per_page";
				$stmt=$pdo->prepare($sql);
				$stmt->execute();
				$data=$stmt->fetchAll();
		// print_r($data);
				foreach ($data as $k)
				 {
						?>
						<tr>
							<td><?php echo $a;?></td>
							<!--<td>// $k['username'];</td>-->
							<td><?php echo $k['dateleased'];?></td>
							<td><?php echo $k['name'];?></td>
							<td><?php echo $k['address'];?></td>
							<td><?php echo $k['phoneno'];?></td>
							<td><?php echo $k['leasedate'];?></td>
							<td><?php echo $k['enddate'];?></td>
							<td><?php echo $k['equipment'];?></td>
							<td><?php echo $k['equipmentno'];?></td>
							<td><?php echo $k['modelno'];?></td>
							<td><?php echo $k['period'];?></td>
							<td><?php echo $k['rent'];?></td>
							<td><?php echo $k['sec'];?></td>
							<td><?php echo $k['carriage'];?></td>
							<td><?php echo $k['comments'];?></td>
							<td><?php echo $k['email'];?></td>
							<td><?php echo $k['paymentrecedupto'];?></td>
							<td><?php echo $k['lastservicedate'];?></td>
							<td><?php echo $k['datepicked'];?></td>

							<td>
      							<a href="editnew.php?id=<?php echo $k['id'];?>" class="btn btn-primary btn-lg active" role="button">EDIT</a>
    						</td>
    						<td>
      							<a href="form.php?id=<?php echo $k['id'];?>" class="btn btn-primary btn-lg active" role="button">CREATE LEASE LETTER</a>
							</td>
						</tr>
						<?php $a++; 
				}
	 ?>
	</tbody>
</table>
 <!--<ul class="pagination">
        <li><a href="?page=1">First</a></li>
        <li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($page < 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($page >= $number_of_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($page >= $number_of_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">Next</a>
        </li>
        <li><a href="?page=<?php echo $number_of_pages; ?>">Last</a></li>
    </ul>-->
</body>
</html> 