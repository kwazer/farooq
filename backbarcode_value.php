<?php
include 'con.php';
$barcode_value = $_REQUEST["barcode_value"];
$query = mysqli_query($con,"select item_id from items where isbn = '$barcode_value'");
while($row =  mysqli_fetch_array($query))
{
	echo $row['item_id'];
} 
?>
