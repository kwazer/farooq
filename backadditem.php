<?php
$name = $_GET["name"];
$rem_qty = $_GET["rem_qty"];
$price = $_GET["price"];
$qty = $_GET["qty"];
$pos = $_GET["pos"]; 
$cat_id = $_GET["cat_id"];
$sprice = $_GET["sprice"];
$unt = $_GET["unt"];
include 'con.php';
//$con = mysqli_connect("localhost","root","password","shop");
$query = mysqli_query($con,"insert into item(item_name,sale_price,item_qty,position,cat_id,qty_rem,item_price,unit) values('$name','$price','$qty','$pos',$cat_id,'$rem_qty','$sprice','$unt')");
?>
