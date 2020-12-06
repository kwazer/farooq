<?php 
session_start();
if($_SESSION["id"] == 1)
{
include 'con.php';
$type_id = $_REQUEST["type_id"];
$sno = $_REQUEST["sno"];
if($type_id == 1)
$query = mysqli_query($con,"update daybook set flag = 1 where sno = $sno");
if($type_id == 2)
$query = mysqli_query($con,"update receipt_detail set verify_flag = 1 where sno = $sno");
if($query)
{
	echo "successful";
	
}
else
{
	echo "unsuccessful";
}
}
?>
