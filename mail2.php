<?php
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['User']))
{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mail</title>
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
      <li class="navbar-brand" href="#"><?php echo $_SESSION['User'] ;?>&nbsp;&nbsp;</li>
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
      <li class="active"><a href="mail2.php">Email</a></li>
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


<?php
//import required files.
include 'data1.php';
require "phpmailer/PHPMailerAutoload.php";
require 'phpmailer/class.smtp.php';
require 'phpmailer/class.phpmailer.php';
//Setup   
$mail=new PHPMailer;
$mail->SMTPDebug=2;
   $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'gurkiratbindra03@gmail.com';                     // SMTP username
    $mail->Password   = 'gurkiratk2003';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;           
   // echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n";
                  
//FROM email
$mail->setFrom("gurkiratbindra03@gmail.com");
//Change to from eamil
$date=date("Y-m-d");
function dateDiffInDays($date1, $date2)  
{ 
    // Calculating the difference in timestamps 
    $diff = strtotime($date2) - strtotime($date1); 
      
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return abs(round($diff / 86400)); 
} 

$sql='SELECT * FROM leaserecords';
$stmt=$pdo->query($sql);
$stmt->execute();
$data=$stmt->fetchAll();
if(!empty($data))
{

			foreach ($data as $k) 
		{
			
			 echo $k['id']."--";
			  $res=dateDiffInDays($date,$k['enddate']);
			$res.'<br />';
			if(($res)==7)
			{

			/*	echo 'hello' .$k['id'];*/
				echo $k['email'].'<br />';
				$mail->clearAddresses();//clear all recipents
				$mail->addAddress($k['email']);
			//TOMAIL
			//Change to whom you want to send.
			$mail->addReplyTo("gurleenk.giit@gmail.com");
			//Change reply email, whom the reciever can reply.
			//addCC
			//addBCC 
			// Attachments
			//Add your attachement here.
			//$mail->addAttachment('git-transport.png',"Git workflow image");         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			// Content
			$mail->isHTML(true);  // Set email format to HTML
			//Change the subject.
			$mail->Subject = 'Reminder!';
			//Change the content as per your wish.
			$mail->Body    = '<h3>'.$k['name'] .', to continue with the package further,you have to pay Rs.' .$k['rent']. ' </h3>';
			//For client not supporting HTML rendering.
			$mail->AltBody = 'This is for non-html content';
			//$mail->send();
			if($mail->send())
			{
			    echo "Success";
			}
			else
			echo "Failure";

		//send sms 
			//$a="Gurleen";
			//$n="9149223543";
			$fields = array(
			    "sender_id" => "FastWP",
			    "message" => "Dear ".$k['name'].", your rental period is expiring soon. Please check your mail for details.",
			    "language" => "english",
			    "route" => "p",
			    "numbers" => $k['phoneno'],
			);

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => json_encode($fields),
			  CURLOPT_HTTPHEADER => array(
			    "authorization: ZNamdxMwbyik7snPuYtI851gplOrJAU40v6VRCTDSEqWeQfcHoYeFZ19casJ0ONE2bPClyipgk6dTfn7",
			    "accept: */*",
			    "cache-control: no-cache",
			    "content-type: application/json"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  echo $response;
			}



				}}
			
		/*	$mail->addBCC($k['email']);}}
			//TOMAIL
			//Change to whom you want to send.
			$mail->addReplyTo("gurkiratbindra03@gmail.com");
			//Change reply email, whom the reciever can reply.
			//addCC
			//addBCC 
			// Attachments
			//Add your attachement here.
			//$mail->addAttachment('git-transport.png',"Git workflow image");         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			// Content
			$mail->isHTML(true);  // Set email format to HTML
			//Change the subject.
			$mail->Subject = 'This is a demo email';
			//Change the content as per your wish.
			$mail->Body    = '<h1>hello chadha</h1>';
			//For client not supporting HTML rendering.
			$mail->AltBody = 'This is for non-html content';
			if($mail->send())
			{
			    echo "Success";
			}
			else
			echo "Failure";*/
			
		
		
}
else
{
	echo "No data found";
}
?>