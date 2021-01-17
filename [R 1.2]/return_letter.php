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
<title>RETURN LETTER></title>
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
  //fetch leaserecord data
    $id=$_GET['id'];
    $sql='SELECT equipment,equipmentno,modelno,name,address,phoneno,leasedate FROM  leaserecords where id=?';
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$id]);
    $k1=$stmt->fetchAll();
    
    //fetch sequence number
    $query='SELECT sequenceno FROM sequencing';
    $statement=$pdo->query($query);
    $statement->execute();
    $l=$statement->fetchAll();
    
    foreach($k1 as $g)
    {

    }
    foreach($l as $row)
    {
        //updating sequence number.
        $new=$row['sequenceno']+1;
        $sql1='UPDATE sequencing SET sequenceno=?';
        $stmt1=$pdo->prepare($sql1);
        $stmt1->execute([$new]);
        
    }
    //fetch model price
    $sqlquery='SELECT model_price FROM models WHERE model_no=?';
    $statement1=$pdo->prepare($sqlquery);
    $statement1->execute([$g['modelno']]);
    $data=$statement1->fetchAll();
    foreach($data as $m)
    {
        
    }

  ?>
  <h4 style="text-align: center;font-family:Lucida Calligraphy,Times New Roman,cursive;"><u>Leasing Return Letter</u></h4>
  <p style="font-family:Lucida Calligraphy,Times New Roman,cursive;font-size:x-small;"><b>GARGS IMPORTERS AND TRADERS LLP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ph:124-4113617</b></p>
  <p style="font-family:Lucida Calligraphy,Times New Roman,cursive;font-size:x-small;"><b>#206,Style Plaza,Near Reliance Fresh,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M.9871482091</b></p>
  <p style="font-family:Lucida Calligraphy,Times New Roman,cursive;font-size:x-small;"><b>Jharsa Road,Sec 15 Part 1,Gurgaon-122001&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;inhousegym@gmail.com</b></p>
  <p style="text-align:center;font-family:Lucida Calligraphy,Times New Roman,cursive;font-size:x-small;"><b>INHOUSEGYM-"We Deliver Health"</b></p>
  <p style="margin:0;font-size:x-small;"><b>GSTIN: 06AALFG4137D1ZN</b></p>
    <hr style="margin:0;">
    <p style="font-size:small;font-family:Calibri,sans-serif;">Sub:<b>Return Of Leased Equipment.</b></p>
    <p style="font-size:small;font-family:Calibri,sans-serif;"><b>Sr. No.-<span style="font-family:Calibri,sans-serif;font-size:medium;"><?php echo $new; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dated&nbsp;<span style="font-family:Calibri,sans-serif;font-size:medium;"><?php echo date("d-m-Y");?></span></b></p>
    <p style="font-family:Calibri,sans-serif;font-size:x-small;"><b>Certified that we had leased<span style="font-family:Calibri,sans-serif;font-size:medium;"> <?php echo $g['equipment'];?>&nbsp;&nbsp;<?php echo $g['equipmentno'];?>&nbsp;&nbsp;<?php echo $g['modelno'];?></span>&nbsp;(Exercise Equipment)  to Mr./Mrs./<span style="font-family:Calibri,sans-serif;font-size:medium;"><?php echo $g['name'].",".$g['address'].".Ph.".$g['phoneno'];?></span></b></p>
    <p style="font-family:Calibri,sans-serif;"><b>Leased wef. <?php echo date("d-m-Y", strtotime($g['leasedate']));?></b></p>
    <p style="font-family:Calibri,sans-serif;"><b>Since the leasing period is over, equipment is being picked back.</b></p>
    <br>
    <p style="font-family:Calibri,sans-serif;"><b>Approximate value of equipment:&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $m['model_price'];?>/-</b></p>
    <br>
    <br>
    <br>
    <p style="text-align: right;"><b>Authorized Signatory</b></p>
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
       fileDownload.download = 'Lease_Return_<?php echo $id;?>_<?php echo $g['name'];?>_<?php echo $g['equipmentno'];?>_<?php echo $g['modelno'];?>.doc';
       fileDownload.click();
       document.body.removeChild(fileDownload);
    }
</script>
  </body>
  </html>