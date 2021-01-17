<?php
include 'data1.php';
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['User']))
{
    header("location:login.php");
}
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
	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
	<!--<a href="w1.php">Insert Data</a>-->
	
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
      <li><a href="w1.php">Insert</a></li>
      <li><a href="mail2.php">Email</a></li>
      <li><a href="sortform.php">Sort</a></li>
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
<form name="sort" action="sort1.php"> 
<select name="order"><!--Dropdown for sorting-->
   <option value="id">ID</option>
   <option value="name">Name</option>
   <option value="equipment">Equipment</option>
   <option value="address">Address</option>
   <option value="phoneno">PhoneNo.</option>
   <option value="leasedate">Lease Date</option>
   <option value="enddate">End Date</option>
   <!--<option value="period">Period of Hire</option>-->
   <option value="rent">Rent</option>
   <option value="sec">Security</option>
   <option value="carriage">Carriage</option>
   <option value="lastservicedate">Last Service Date</option>
   <option value="datepicked">Date Picked</option>

</select>
<select name="orderform">
    <option value="ASC">ASC</option>
    <option value="DESC">DESC</option>
</select>
<input type="submit" name="sub" value=" - Sort - " />
</form>


		<h2 style="text-align: center"><u>CUSTOMER DETAILS</u></h2>
	<?php
		//define how many results per page
	/*$results_per_page=3;
	//find out the number of results stored in db
	//$sql="SELECT * FROM leaserecords";
	 echo $number_of_results = $pdo->query('select count(*) from leaserecords')->fetchColumn();

	//determine total number of pages available
	 echo $number_of_pages=ceil($number_of_results/$results_per_page);
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
	echo $this_page_first_result=($page-1)*$results_per_page;


	//display the links to the page
	for($page=1;$page<=$number_of_pages;$page++)
	{
		if($page==1)
		{?>
			<a href="sort1.php?page=<?php echo $page;?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page;?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page;?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}*/

	

	?>
			<table class="table table-striped table-hover">
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
						<tbody>
							<?php 
								/*$column=array('id' => 'id',
											'name'=>'name',
											'address'=>'address',
											'phoneno'=>'phoneno',
											'leasedate'=>'leasedate',
											'enddate'=>'enddate',
											'equipment'=>'equipment',
											'period'=>'period',
											'rent'=>'rent' );*/
								if($_GET['order']=='address')
								{
									if($_GET['orderform']=='ASC')
								{
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
			<a href="sort1.php?page=<?php echo $page . '&order=address'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=address'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=address'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY address ASC LIMIT $this_page_first_result, $results_per_page ";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
									<td><?php echo $a;?></td>
        							<!--<td> $k['username'];</td>-->
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
							}
						if($_GET['orderform']=='DESC')
								{
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
			<a href="sort1.php?page=<?php echo $page . '&order=address'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=address'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=address'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}



								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY address DESC LIMIT $this_page_first_result, $results_per_page ";
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
							}

						}
						if($_GET['order']=='name')
								{
									if($_GET['orderform']=='ASC')
								{
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
			<a href="sort1.php?page=<?php echo $page . '&order=name'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=name'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=name'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY name ASC LIMIT $this_page_first_result, $results_per_page ";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
									<td><?php echo $a;?></td>
        							<!--<td>$k['username'];</td>-->
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
							}
						if($_GET['orderform']=='DESC')
								{
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
			<a href="sort1.php?page=<?php echo $page . '&order=name'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=name'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=name'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}



								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY name DESC LIMIT $this_page_first_result, $results_per_page ";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
									<td><?php echo $a;?></td>
        							<!--<td>$k['username'];</td>-->
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
							}

						}
						if($_GET['order']=='id')
								{
									if($_GET['orderform']=='ASC')
								{
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
			<a href="sort1.php?page=<?php echo $page . '&order=id'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=id'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=id'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY id ASC LIMIT $this_page_first_result, $results_per_page ";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
									<td><?php echo $k['id'];?></td>
        							<!--<td>$k['username'];</td>-->
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
							}
						if($_GET['orderform']=='DESC')
								{
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
			<a href="sort1.php?page=<?php echo $page . '&order=id'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=id'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=id'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}



								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY id DESC LIMIT $this_page_first_result, $results_per_page ";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
									<td><?php echo $k['id'];?></td>
        							<!--<td> $k['username'];</td>-->
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
							}

						}

						if($_GET['order']=='leasedate')
						{
						    if($_GET['orderform']=='ASC')
						    {
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
			<a href="sort1.php?page=<?php echo $page . '&order=leasedate'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=leasedate'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=leasedate'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}

								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY leasedate ASC LIMIT $this_page_first_result, $results_per_page";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
									<td><?php echo $a;?></td>
        							<!--<td> $k['username'];</td>-->
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
						}
						
				 if($_GET['orderform']=='DESC')
						    {
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
			<a href="sort1.php?page=<?php echo $page . '&order=leasedate'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=leasedate'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=leasedate'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}

								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY leasedate DESC LIMIT $this_page_first_result, $results_per_page";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
									<td><?php echo $a;?></td>
        							<!--<td> $k['username'];</td>-->
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
						}
						
					}
						if($_GET['order']=='enddate')
						{
						    if($_GET['orderform']=='ASC')
						    {
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
			<a href="sort1.php?page=<?php echo $page . '&order=enddate' .'&orderform=ASC' ;?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=enddate'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=enddate'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY enddate ASC LIMIT $this_page_first_result, $results_per_page";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
								<td><?php echo $a;?></td>
    							<!--<td> $k['username'];</td>-->
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
						}
                        if($_GET['orderform']=='DESC')
						    {
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
			<a href="sort1.php?page=<?php echo $page . '&order=enddate' .'&orderform=DESC' ;?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=enddate'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=enddate'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY enddate DESC LIMIT $this_page_first_result, $results_per_page";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
								<td><?php echo $a;?></td>
    							<!--<td> $k['username'];</td>-->
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
						}
				}

                        
                        
                        
                        
                        
						if($_GET['order']=='equipment')
						{
						    if($_GET['orderform']=='ASC')
						    {
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
			<a href="sort1.php?page=<?php echo $page . '&order=equipment'.'&orderform=ASC' ;?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=equipment'. '&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=equipment'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY equipment ASC LIMIT $this_page_first_result, $results_per_page ";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
									<td><?php echo $a;?></td>
        							<!--<td> $k['username'];</td>-->
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
						}
						if($_GET['orderform']=='DESC')
						    {
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
			<a href="sort1.php?page=<?php echo $page . '&order=equipment'.'&orderform=DESC' ;?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=equipment'. '&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=equipment'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY equipment DESC LIMIT $this_page_first_result, $results_per_page ";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
									<td><?php echo $a;?></td>
        							<!--<td> $k['username'];</td>-->
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
						}
				}
						
						
					/*	if($_GET['order']=='period')
						{
						    if($_GET['orderform']=='ASC')
						    {
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
			<a href="sort1.php?page=<?php echo $page . '&order=period'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=period'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=period'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY period ASC LIMIT $this_page_first_result, $results_per_page";
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
						}
                        if($_GET['orderform']=='DESC')
						    {
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
			<a href="sort1.php?page=<?php echo $page . '&order=period'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=period'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=period'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY period DESC LIMIT $this_page_first_result, $results_per_page";
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
						}
                    }*/

						if($_GET['order']=='phoneno')
						{
						    if($_GET['orderform']=='ASC')
						    {
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
			<a href="sort1.php?page=<?php echo $page . '&order=phoneno'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=phoneno'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=phoneno'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY phoneno ASC LIMIT $this_page_first_result, $results_per_page";
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
						}
						
						if($_GET['orderform']=='DESC')
						    {
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
			<a href="sort1.php?page=<?php echo $page . '&order=phoneno'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=phoneno'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=phoneno'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY phoneno DESC LIMIT $this_page_first_result, $results_per_page";
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
						}
					}
						
						if($_GET['order']=='rent')
						{
						    if($_GET['orderform']=='ASC')
						    {

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
			<a href="sort1.php?page=<?php echo $page . '&order=rent'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=rent'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=rent'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY rent ASC LIMIT $this_page_first_result, $results_per_page";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
    								<td><?php echo $a;?></td>
        							<!--<td>// echo $k['username'];</td>-->
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
						}
						if($_GET['orderform']=='DESC')
						    {

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
			<a href="sort1.php?page=<?php echo $page . '&order=rent'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=rent'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=rent'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY rent DESC LIMIT $this_page_first_result, $results_per_page";
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
						}
					}
						
						
						
						
			if($_GET['order']=='sec')
						{
						    if($_GET['orderform']=='ASC')
						    {

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
			<a href="sort1.php?page=<?php echo $page . '&order=sec'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=sec'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=sec'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY sec ASC LIMIT $this_page_first_result, $results_per_page";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
    								<td><?php echo $a;?></td>
        							<!--<td>//  $k['username'];</td>-->
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
						}
						if($_GET['orderform']=='DESC')
						    {

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
			<a href="sort1.php?page=<?php echo $page . '&order=sec'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=sec'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=sec'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY sec DESC LIMIT $this_page_first_result, $results_per_page";
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
						}
					}
					
					if($_GET['order']=='carriage')
						{
						    if($_GET['orderform']=='ASC')
						    {

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
			<a href="sort1.php?page=<?php echo $page . '&order=carriage'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=carriage'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=carriage'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY carriage ASC LIMIT $this_page_first_result, $results_per_page";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
    								<td><?php echo $a;?></td>
        							<!--<td>//  $k['username'];</td>-->
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
						}
						if($_GET['orderform']=='DESC')
						    {

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
			<a href="sort1.php?page=<?php echo $page . '&order=carriage'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=carriage'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=carriage'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY carriage DESC LIMIT $this_page_first_result, $results_per_page";
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
						}
					}
				if($_GET['order']=='lastservicedate')
						{
						    if($_GET['orderform']=='ASC')
						    {

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
			<a href="sort1.php?page=<?php echo $page . '&order=lastservicedate'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=lastservicedate'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=lastservicedate'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY lastservicedate ASC LIMIT $this_page_first_result, $results_per_page";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
    								<td><?php echo $a;?></td>
        							<!--<td>//  $k['username'];</td>-->
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
						}
						if($_GET['orderform']=='DESC')
						    {

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
			<a href="sort1.php?page=<?php echo $page . '&order=lastservicedate'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=lastservicedate'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=lastservicedate'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY lastservicedate DESC LIMIT $this_page_first_result, $results_per_page";
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
						}
					}
					
						if($_GET['order']=='datepicked')
						{
						    if($_GET['orderform']=='ASC')
						    {

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
			<a href="sort1.php?page=<?php echo $page . '&order=datepicked'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=datepicked'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=datepicked'.'&orderform=ASC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY datepicked ASC LIMIT $this_page_first_result, $results_per_page";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$data=$stmt->fetchAll();
								// print_r($data);
								foreach ($data as $k)
				 				{
								?>
								<tr>
    								<td><?php echo $a;?></td>
        							<!--<td>//  $k['username'];</td>-->
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
						}
						if($_GET['orderform']=='DESC')
						    {

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
			<a href="sort1.php?page=<?php echo $page . '&order=datepicked'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">First</a>;
		<?php 
		}
		elseif ($page==$number_of_pages)
		 {
			# code...?>
			<a href="sort1.php?page=<?php echo $page . '&order=datepicked'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button">Last</a>;
			<?php
		}
		else
		{		
			?>

		<a href="sort1.php?page=<?php echo $page . '&order=datepicked'.'&orderform=DESC';?>" class="btn btn-primary btn-lg active" role="button"><?php echo $page; ?></a>;
	<?php }
	}
								$a=1;
								$sql="SELECT * FROM leaserecords ORDER BY datepicked DESC LIMIT $this_page_first_result, $results_per_page";
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
						}
					}
					
						?>
				</tbody>
		</table>
				
</body>
</html>