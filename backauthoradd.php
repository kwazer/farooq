<?php
$pb_name = $_GET["name"];
$con= mysqli_connect("localhost","root","password","kapoor");
$query = mysqli_query($con,"insert into author(author_name) values('$pb_name')"); 
?>
