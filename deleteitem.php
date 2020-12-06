<?php
$item_id = $_GET["item_id"];
$con = mysqli_connect("localhost","root","password","shop");
$query = mysqli_query($con,"delete from item where item_id = $item_id");
header('location:itempage.php');
?>
