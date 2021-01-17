<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Card</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body> 
<div id="source-html" class="section1" style="margin:0px;">
  <?php/*
    $id=$_GET['id'];
    $sql='SELECT * FROM  leaserecords where id=?';
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$id]);
    $k1=$stmt->fetchAll();
    foreach($k1 as $g)
    {

    }*/
  ?>
  <table style="margin:0px;cell-spacing:0px">
     <!-- <tr>
      <td width=35% style="font-family:Arial,sans-serif;font-size:x-small;margin:0;">S-5230, S-5600X</td>
     <td width="65%" style="font-family:Arial Black,sans-serif;font-size:small;"><?php echo $g['name'];?>,<br><?php echo $g['address'];?>.<br>Ph.<?php echo $g['phoneno'];?></td>
      </tr>-->
  
  <!-- margin-left:350px;margin-top:0;margin-bottom:0;-->
  <tr></tr>
  <br>
  <tr style="margin:0;">
  <td width="50%">
      <p style="font-family:Arial,sans-serif;font-size:xx-small;margin:0;">From:<br>GSTIN: 06AALFG4137D1ZN<br>GARGS IMPORTERS AND TRADERS LLP,<br>Shop No. 206, Style Plaza, Jharsa Road, Sector 15 Part 1,<br>Gurgaon-122001<br>Ph 9871482091</p>
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
            "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title><style>@page{mso-page-orientation: landscape; size:29.7cm 21cm;margin:1cm 1cm 1cm 1cm;}@page section1 { }div.section1 { page:section1; }</style></head><body>";
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
</body>
</html>
