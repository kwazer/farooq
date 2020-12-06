<?php 
session_start();
include 'con.php';
$pb_id = $_REQUEST["pb_id"];
$pb_name = $_REQUEST["pb_name"];
//echo $author_id."<br>".$author_name;
$query = mysqli_query($con,"update publisher set pb_name = '$pb_name' where pb_id = '$pb_id'");
?>
