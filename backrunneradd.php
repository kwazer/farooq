<?php
$pb_name = $_GET["pb_name"];
include 'con.php';
//$con= mysqli_connect("localhost","root","password","pyramid2");
$query = mysqli_query($con,"insert into runner(runner_name) values('$pb_name')"); 
?>
