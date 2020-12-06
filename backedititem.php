<?php
$model = $_GET["model"];
$type = $_GET["type"];
$qty = $_GET["qty"]; 
$rem_qty = $_GET["rem_qty"];
$item_id = $_GET["item_id"];
$name = $_GET["name"];
$price = $_GET["price"];
$position = $_GET["position"];
$sprice = $_GET["sprice"];
$unt = $_GET["unt"];
include 'con.php';
//$con = mysqli_connect("localhost","root","password","shop");
$query = mysqli_query($con,"update item set item_name = '$name',sale_price = $price,position = '$position',item_qty = $qty,qty_rem = $rem_qty,item_price = $sprice,unit = '$unt', model = '$model',type = '$type' where item_id = $item_id");
?>
