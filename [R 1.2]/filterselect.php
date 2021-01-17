<?php

include 'data1.php';

$column = array('id', 'dateleased','name', 'address','phoneno','leasedate','enddate','equipment','equipmentno','modelno','period','rent','sec','carriage','comments','email','paymentrecedupto','lastservicedate','datepicked','gstin','balancedue','flag','bookingadvance','tobepicked');

$searchValue = $_POST['search']['value']; // Search value

## Search 
$search = " ";
if($searchValue != ''){
   $search = " AND (id LIKE '%".$searchValue."%' OR dateleased LIKE '%".$searchValue."%' OR name LIKE '%".$searchValue."%' OR address LIKE '%".$searchValue."%' OR phoneno LIKE '%".$searchValue."%' OR leasedate LIKE'%".$searchValue."%' OR enddate LIKE '%".$searchValue."%' OR equipment LIKE '%".$searchValue."%' OR equipmentno LIKE '%".$searchValue."%' OR modelno LIKE '%".$searchValue."%' OR period LIKE '%".$searchValue."%' OR rent LIKE '%".$searchValue."%' OR sec LIKE '%".$searchValue."%' OR carriage LIKE '%".$searchValue."%' OR comments LIKE '%".$searchValue."%' OR email LIKE '%".$searchValue."%' OR paymentrecedupto LIKE '%".$searchValue."%' OR lastservicedate LIKE '%".$searchValue."%' OR datepicked LIKE '%".$searchValue."%' OR gstin LIKE '%".$searchValue."%' OR balancedue LIKE '%".$searchValue."%' OR flag LIKE '%".$searchValue."%' OR bookingadvance LIKE '%".$searchValue."%' OR tobepicked LIKE '%".$searchValue."%') ";
}

$query = "
SELECT * FROM leaserecords 
";
$searchquery="";
if($_POST['filter_equipment'] != '') 
{
    $searchquery .='AND equipment= "'.$_POST['filter_equipment'].'"';
}
if($_POST['filter_equipmentno'] != '') 
{
    $searchquery .='AND equipmentno= "'.$_POST['filter_equipmentno'].'"';
}
if($_POST['filter_modelno'] != '') 
{
    $searchquery .='AND modelno= "'.$_POST['filter_modelno'].'"';
}

if($_POST['filter_name'] != '')
{
     $searchquery .='AND name LIKE "%'.$_POST['filter_name'].'%"';
}
if($_POST['filter_address'] != '')
{
    $searchquery .='AND address LIKE "%'.$_POST['filter_address'].'%"';
}
if($_POST['filter_phoneno'] != '')
{
    $searchquery .='AND phoneno LIKE "%'.$_POST['filter_phoneno'].'%"';
}
if($_POST['filter_email'] != '')
{
    $searchquery .='AND email LIKE "%'.$_POST['filter_email'].'%"';
}
if($_POST['filter_comments'] != '')
{
    $searchquery .='AND comments LIKE "%'.$_POST['filter_comments'].'%"';
}
/*if($_POST['filter_rent'] != '') 
{
    $searchquery .='AND rent= "'.$_POST['filter_rent'].'"';
}*/
if($_POST['filter_measure']=='lessthan' && $_POST['filter_onerent']!='' && $_POST['filter_tworent']=='')
{
    $searchquery .='AND rent < "'.$_POST['filter_onerent'].'"';
}
if($_POST['filter_measure']=='greaterthan' && $_POST['filter_onerent']!='' && $_POST['filter_tworent']=='')
{
    $searchquery .='AND rent > "'.$_POST['filter_onerent'].'"';
}
if($_POST['filter_measure']=='equalto' && $_POST['filter_onerent']!='' && $_POST['filter_tworent']=='')
{
    $searchquery .='AND rent = "'.$_POST['filter_onerent'].'"';
}
if($_POST['filter_measure']=='between' && $_POST['filter_onerent']!='' && $_POST['filter_tworent']!='')
{
    $searchquery .='AND rent BETWEEN "'.$_POST['filter_onerent'].'" AND "'.$_POST['filter_tworent'].'"';
}
/*if($_POST['filter_sec'] != '') 
{
    $searchquery .='AND sec= "'.$_POST['filter_sec'].'"';
}*/
if($_POST['filter_sec']=='lessthan' && $_POST['filter_onesec']!='' && $_POST['filter_twosec']=='')
{
    $searchquery .='AND sec < "'.$_POST['filter_onesec'].'"';
}
if($_POST['filter_sec']=='greaterthan' && $_POST['filter_onesec']!='' && $_POST['filter_twosec']=='')
{
    $searchquery .='AND sec > "'.$_POST['filter_onesec'].'"';
}
if($_POST['filter_sec']=='equalto' && $_POST['filter_onesec']!='' && $_POST['filter_twosec']=='')
{
    $searchquery .='AND sec = "'.$_POST['filter_onesec'].'"';
}
if($_POST['filter_sec']=='between' && $_POST['filter_onesec']!='' && $_POST['filter_twosec']!='')
{
    $searchquery .='AND sec BETWEEN "'.$_POST['filter_onesec'].'" AND "'.$_POST['filter_twosec'].'" ';
}
/*if($_POST['filter_carriage'] != '') 
{
    $searchquery .='AND carriage= "'.$_POST['filter_carriage'].'"';
}*/
if($_POST['filter_carriage']=='lessthan' && $_POST['filter_onecar']!='' && $_POST['filter_twocar']=='')
{
    $searchquery .='AND carriage < "'.$_POST['filter_onecar'].'"';
}
if($_POST['filter_carriage']=='greaterthan' && $_POST['filter_onecar']!='' && $_POST['filter_twocar']=='')
{
    $searchquery .='AND carriage > "'.$_POST['filter_onecar'].'"';
}
if($_POST['filter_carriage']=='equalto' && $_POST['filter_onecar']!='' && $_POST['filter_twocar']=='')
{
    $searchquery .='AND carriage = "'.$_POST['filter_onecar'].'"';
}
if($_POST['filter_carriage']=='between' && $_POST['filter_onecar']!='' && $_POST['filter_twocar']!='')
{
    $searchquery .='AND carriage BETWEEN "'.$_POST['filter_onecar'].'" AND "'.$_POST['filter_twocar'].'" ';
}
if($_POST['filter_period'] != '') 
{
    $searchquery .='AND period LIKE "%'.$_POST['filter_period'].'%"';
}
/*
//leasedate
if($_POST['filter_date'] == 'leasedate' && $_POST['filter_order']=='on' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND leasedate = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_leasedate'] != '' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND leasedate <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_leasedate'] != '' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND leasedate >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_leasedate'] != '' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND leasedate BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}
//enddate
if($_POST['filter_enddate'] != '' && $_POST['filter_order']=='on' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND enddate = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_enddate'] != '' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND enddate <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_enddate'] != '' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND enddate >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_enddate'] != '' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND enddate BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}
//dateleased
if($_POST['filter_enddate'] != '' && $_POST['filter_order']=='on' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND dateleased = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_dateleased'] != '' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND dateleased <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_dateleased'] != '' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND dateleased >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_dateleased'] != '' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND dateleased BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}

//lastservicedate
if($_POST['filter_lastservicedate'] != '' && $_POST['filter_order']=='on' && $_POST['filter_date1'] != '' && $_POST['filter_date2'] == '')
{
    $searchquery .='AND lastservicedate = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_lastservicedate'] != '' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND lastservicedate <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_lastservicedate'] != '' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='ANDlastservicedate >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_lastservicedate'] != '' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND lastservicedate BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}
//datepicked
if($_POST['filter_datepicked'] != '' && $_POST['filter_order']=='on' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND datepicked = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_datepicked'] != '' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND datepicked <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_datepicked'] != '' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND datepicked >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_datepicked'] != '' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND datepicked BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}
*/
//leasedate
if($_POST['filter_date'] == 'leasedate' && $_POST['filter_order']=='on' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND leasedate = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'leasedate' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND leasedate <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'leasedate' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND leasedate >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'leasedate' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND leasedate BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}
//enddate
if($_POST['filter_date'] == 'enddate' && $_POST['filter_order']=='on' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND enddate = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'enddate' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND enddate <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'enddate' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND enddate >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'enddate' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND enddate BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}
//dateleased
if($_POST['filter_date'] == 'dateleased' && $_POST['filter_order']=='on' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND dateleased = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'dateleased' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND dateleased <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'dateleased' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND dateleased >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'dateleased' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND dateleased BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}
//lastservicedate
if($_POST['filter_date'] == 'lastservicedate' && $_POST['filter_order']=='on' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND lastservicedate = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'lastservicedate' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND lastservicedate <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'lastservicedate' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND lastservicedate >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'lastservicedate' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND lastservicedate BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}
//datepicked
if($_POST['filter_date'] == 'datepicked' && $_POST['filter_order']=='on' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND datepicked = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'datepicked' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND datepicked <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'datepicked' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND datepicked >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'datepicked' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND datepicked BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}
//payment reced upto
if($_POST['filter_date'] == 'paymentrecedupto' && $_POST['filter_order']=='on' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND paymentrecedupto = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'paymentrecedupto' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND paymentrecedupto <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'paymentrecedupto' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND paymentrecedupto >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'paymentrecedupto' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND paymentrecedupto BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}
//to be picked
if($_POST['filter_date'] == 'tobepicked' && $_POST['filter_order']=='on' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND tobepicked = "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'tobepicked' && $_POST['filter_order']=='before' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND tobepicked <= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'tobepicked' && $_POST['filter_order']=='after' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] == '')
{
    $searchquery .='AND tobepicked >= "'.$_POST['filter_onedate'].'"';
}
if($_POST['filter_date'] == 'tobepicked' && $_POST['filter_order']=='between' && $_POST['filter_onedate'] != '' && $_POST['filter_twodate'] != '')
{
    $searchquery .='AND tobepicked BETWEEN "'.$_POST['filter_onedate'].'" AND "'.$_POST['filter_twodate'].'"';
}


 $query .= '
 WHERE 1 '.$searchquery. $search.' ';


if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
/*else
{
 $query .= 'ORDER BY dateleased ASC ';
}*/

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $pdo->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $pdo->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();



$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['id'];
  $sub_array[] = $row['dateleased'];
 $sub_array[] = $row['name'];
 $sub_array[] = $row['address'];
  $sub_array[] = $row['phoneno'];
   $sub_array[] = $row['email'];
    $sub_array[] = $row['equipment'];
 $sub_array[] = $row['equipmentno'];
 $sub_array[] = $row['modelno'];
 $sub_array[] = $row['period'];
 $sub_array[] = $row['duration'];
    $sub_array[] = $row['leasedate'];
  $sub_array[] =$row['enddate'];
 $sub_array[] = $row['rent'];
  $sub_array[] = $row['sec'];
   $sub_array[] = $row['carriage'];
   $sub_array[] = $row['bookingadvance'];
   $sub_array[] = $row['balancedue'];
      $sub_array[] = $row['paymentrecedupto'];
       $sub_array[] = $row['lastservicedate'];
        $sub_array[] = '<div contenteditable data-type="date" class="update" data-id="'.$row["id"].'" data-column="datepicked">' . $row["datepicked"] . '</div>';
        $sub_array[] = $row['gstin'];
        $sub_array[] = $row['flag'];
        $sub_array[]='<div contenteditable class="update" data-id="'.$row["id"].'" data-column="tobepicked">' . $row["tobepicked"] . '</div>';
         $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="comments">' . $row["comments"] . '</div>';
        $sub_array[]=$row['id'];
        $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
}

function count_all_data($pdo)
{
 $query = "SELECT * FROM leaserecords";
 $statement = $pdo->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 "draw"       =>  intval($_POST["draw"]),
 "recordsTotal"   =>  count_all_data($pdo),
 "recordsFiltered"  =>  $number_filter_row,
 "data"       =>  $data
);

echo json_encode($output);

?>