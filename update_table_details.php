<?php
include 'con.php';
/*
$peti = $_REQUEST["peti"];
$half = $_REQUEST["half"];
$variety = $_REQUEST["variety"];
$quality = $_REQUEST["quality"];
$rate = $_REQUEST["rate"];
$amount = $_REQUEST["amount"];
* */
$watak_no = $_REQUEST["watak_no"];
$peti = $_REQUEST["peti"];
$type = $_REQUEST["type"];
$half = $_REQUEST["half"];
$variety = $_REQUEST["variety"];
$quality = $_REQUEST["quality"];
$rate = $_REQUEST["rate"];
$total_amount= $_REQUEST["amount"];
//echo $peti." ".$half." ".$variety." ".$quality." ".$rate." ".$total_amount." ".$watak_no;
//$tran_id = $_REQUEST["tran_id"];
//$query = mysqli_query($con,"insert into watak_items(watak_no,peti,dabba,variety,quality,rate,amount) values('$watak_no','$peti','$half','$variety','$quality','$rate','$total_amount')");//$query_list = mysqli_query($con,"insert into watak_items(peti,dabba,watak_no,variety,quality,rate,amount) values('$peti','$half','$tran_id','$variety','$quality','$rate','$total_amount')");
$query = mysqli_query($con,"update watak_items set peti = '$peti',dabba = '$half',variety = '$variety',quality = '$quality',rate = '$rate',amount = '$total_amount' where sno = '$watak_no'");
if($query)
echo "successful";
else
echo "unsuccessful";
?>
