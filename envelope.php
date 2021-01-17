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
<title>ENVELOPE</title>
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


<div id="source-html" class="section1" style="margin-top:1.5 cm;margin-bottom:1 cm;margin-right:1.75 cm;margin-top:1.75 cm;">
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
  <table style="margin:0px;cell-spacing:0px">
      <tr>
      <td width=35% valign="top" style="font-family:Arial,sans-serif;font-size:x-small;margin:0;"><?php echo $g['modelno'];?></td>
     <td width="65%" style="font-family:Arial Black,sans-serif;font-size:small;"><?php echo $g['name'];?>,<br><?php echo $g['address'];?>.<br>Ph.<?php echo $g['phoneno'];?></td>
      </tr>
  
  <!-- margin-left:350px;margin-top:0;margin-bottom:0;-->
  <tr></tr>
  <br>
  <tr style="margin:0;">
  <td width="50%" style="font-family:Arial,sans-serif;font-size:xx-small;margin:0;">From:<br>GSTIN: 06AALFG4137D1ZN<br>GARGS IMPORTERS AND TRADERS LLP,<br>Shop No. 206, Style Plaza, Jharsa Road, Sector 15 Part 1,<br>Gurgaon-122001<br>Ph 9871482091
 </td></tr>
   </table>
 
  </div>
    <div class="content-footer">
    <button id="btn-export" onclick="exportHTML();">Click to download</button>
</div>
<script>
  
    function exportHTML(){
       var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
            "xmlns:w='urn:schemas-microsoft-com:office:word' "+
            "xmlns='http://www.w3.org/TR/REC-html40'>"+
            "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title><style>@page section1{size:24.13 cm 10.48 cm;} div.section1 {page: section1;} section1{margin:0;}</style></head><body>";
       var footer = "</body></html>";
       var sourceHTML = header+document.getElementById("source-html").innerHTML+footer;
       
       var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
       var fileDownload = document.createElement("a");
       document.body.appendChild(fileDownload);
       fileDownload.href = source;
       fileDownload.download = 'Envelope_<?php echo $g['name'];?>.doc';
       fileDownload.click();
       document.body.removeChild(fileDownload);
    }
</script>
<!--<script>
function export2Word( document.getElementById("source-html") ) {

   var html, link, blob, url, css;

   css = (
     '<style>' +
     '@page WordSection1{size: 24.13 cm 10.48 cm;mso-page-orientation: landscape;}' +
     'div.WordSection1 {page: WordSection1;}' +
     '</style>'
   );

   html = document.getElementById("source-html").innerHTML;
   blob = new Blob(['\ufeff', css + html], {
     type: 'application/msword'
   });
   url = URL.createObjectURL(blob);
   link = document.createElement('A');
   link.href = url;
   link.download = 'Document';  // default name without extension 
   document.body.appendChild(link);
   if (navigator.msSaveOrOpenBlob ) navigator.msSaveOrOpenBlob( blob, 'Document.doc'); // IE10-11
       else link.click();  // other browsers
   document.body.removeChild(link);
 }
 </script>-->
  </body>
  </html>