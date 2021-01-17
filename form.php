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
<title>LEASE LETTER</title>
<?php
include 'data1.php';
?>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--<link href="com.css" rel="stylesheet">-->
</head>
<body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
     <li class="navbar-brand" href="#"><?php echo $_SESSION['User'] ;?>&nbsp;&nbsp;</li>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="home.php">Home</a></li>
     <!-- <li class="active"><a href="paging.php">View Data</a></li>-->
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
    </ul>
  </div>
</nav>


<div id="source-html">
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
  <h4 style="text-align: center;font-family:Lucida Calligraphy,Times New Roman,cursive;"><u>Leasing Rental Letter</u></h4>
  <p style="font-family:Lucida Calligraphy,Times New Roman,cursive;font-size:x-small;"><b>GARGS IMPORTERS AND TRADERS LLP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ph:124-4113617</b></p>
  <p style="font-family:Lucida Calligraphy,Times New Roman,cursive;font-size:x-small;"><b>#206,Style Plaza,Near Reliance Fresh,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M.9871482091</b></p>
  <p style="font-family:Lucida Calligraphy,Times New Roman,cursive;font-size:x-small;"><b>Jharsa Road,Sec 15 Part 1,Gurgaon-122001&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;inhousegym@gmail.com</b></p>
  <p style="text-align:center;font-family:Lucida Calligraphy,Times New Roman,cursive;font-size:x-small;"><b>INHOUSEGYM-"We Deliver Health"</b></p>
  <p style="margin:0;font-size:x-small;"><b>GSTIN: 06AALFG4137D1ZN</b></p>
    <hr style="margin:0;">
    <p style:"font-size:small;"><b>Sub:</b>Leasing Of Equipment.</p>
    <table id="t1" cellspacing="0" border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;margin-left:auto;margin-right:auto;" height="80%" width="100%">
      <tr border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">Leasing Date </td>
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;"><b><?php echo date("d-m-Y", strtotime($g['leasedate']));?></b></td>
      </tr>
      <tr border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;" >
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">Equipment Leased(eq,eqno.,modelno)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;"><b><?php echo $g['equipment'].','. $g['equipmentno'].','.$g['modelno'];?></b></td>
      </tr>
      <tr border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">Leased To<br><br></td>
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;"><b><?php echo $g['name'];?>,</b><br><b><?php echo $g['address'];?></b>. <br><br><b>PhNo.<?php echo $g['phoneno'];?></b></td>
      </tr>
      <tr border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">Period of Hire</td>
        <td ><b><?php echo $g['period']." ".$g['duration'];?> (from</b>&nbsp; <b><?php echo date("d-m-Y", strtotime($g['leasedate']));?> to <?php echo date("d-m-Y", strtotime($g['enddate']));?>)</b></td>
      </tr>
      <tr border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">Rent <span style="font-size:xx-small;"><i>(Inclusive of Taxes)</i></span>&nbsp;&nbsp;&nbsp;</td>
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;"><b>Rs. <?php echo $g['rent'];?>/-</b><br></td>
      </tr>
      <tr border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">Security <span style="font-size:xx-small;"><i>(Refundable on return of M/c only)</i></span>&nbsp;</td>
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;"><b>Rs.<?php echo $g['sec'];?>/-</b><br></td>
      </tr>
      <tr border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;">Carriages charges&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td border="1px solid #303030" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;"><b><?php echo $g['carriage'];?>/- for Delivery,<?php echo $g['carriage'];?>/- for pick up</b><br>Plus Rs. 50/- per floor if lifted/lowered through stairs</td>
      </tr>
    </table>
    <?php
    $sum=$g['rent']+$g['sec']+$g['carriage']-$g['bookingadvance'];
    $refund=$g['sec']-$g['carriage'];
    ?>
    <p style="font-family:Calibri,sans-serif;">Total payable on delivery = (<?php echo $g['rent']."+".$g['sec']."+".$g['carriage']."-".$g['bookingadvance'].") =".$sum;?>/-</p>
    <p style="font-family:Calibri,sans-serif;">On Pick up <?php echo $g['sec']."-".$g['carriage']."=".$refund;?>/- shall be refunded.</p>
    <p style="margin:0.6mm;font-family:Calibri,sans-serif;">Current Account Details HDFC:</p>
    <p style="margin:0.6mm;font-family:Calibri,sans-serif;">Name: GARGS IMPORTERS AND TRADERS LLP</p>
    <p style="margin:0.6mm;font-family:Calibri,sans-serif;">Current A/c No. 13812000001682</p>
    <p style="margin:0.6mm;font-family:Calibri,sans-serif;">IFSC: HDFC0001381</p>
    <p style="font-family:Calibri,sans-serif;">Other terms and conditions as agreed to thru mail/whatsapp.</p>
    <br>
    <br>
    <p style="text-align: right;"><b>(P.C Garg)</b><br>Designated Partner</p>
    </div>
    <div class="content-footer">
    <button id="btn-export" onclick="exportHTML();">Click to download</button>
</div>
<script>
  
    function exportHTML(){
       var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
            "xmlns:w='urn:schemas-microsoft-com:office:word' "+
            "xmlns='http://www.w3.org/TR/REC-html40'>"+
            "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
       var footer = "</body></html>";
       var sourceHTML = header+document.getElementById("source-html").innerHTML+footer;
       
       var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
       var fileDownload = document.createElement("a");
       document.body.appendChild(fileDownload);
       fileDownload.href = source;
       fileDownload.download = 'Leasing_Letter_<?php echo $g['name']?>_<?php echo date("d-m-Y", strtotime($g['leasedate']));?>_<?php echo $g['modelno'];?>.doc';
       fileDownload.click();
       document.body.removeChild(fileDownload);
    }
</script>
  </body>
  </html>