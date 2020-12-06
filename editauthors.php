<?php 
session_start();
include 'con.php';
$author_id = $_REQUEST["author_id"];
$author_name = $_REQUEST["author_name"];
//echo $author_id."<br>".$author_name;
$query = mysqli_query($con,"update author set author_name = '$author_name' where author_id = '$author_id'");
?>
