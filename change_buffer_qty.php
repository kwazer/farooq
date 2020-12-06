<?php
session_start();
include 'con.php'; 
$sno = $_REQUEST["sno"];
$qty = $_REQUEST["qty"];
$type_id = $_REQUEST["type_id"];
$query = mysqli_query($con,"update bill_buffer set qty = $qty where sno = $sno");
if($type_id == 2)
$query_select = mysqli_query($con,"select sum(qty*retail_rate) as total from bill_buffer join items on items.item_id = bill_buffer.uid");
if($type_id == 3)
$query_select = mysqli_query($con,"select sum(qty*dealer_rate) as total from bill_buffer join items on items.item_id = bill_buffer.uid");
if($type_id == 1)
{
$query_select = mysqli_query($con,"select sum(qty*cost_price) as total from bill_buffer join items on items.item_id = bill_buffer.uid");
	
}
while($row = mysqli_fetch_array($query_select))
{
	echo $row['total'];
}
?>
