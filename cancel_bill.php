<?php 
session_start();
//if($_SESSION["id" == 1])
include 'con.php';
$query = mysqli_query($con,"delete from bill_buffer");
if($query)
{
	echo "cancelled";
}
else
{
	echo "not cancelled";
}
?>

