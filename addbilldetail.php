<?php
$sno = $_REQUEST["sno"];
$uid = $_REQUEST["uid"];
$qty = $_REQUEST["qty"];
$type_id = $_REQUEST["type_id"];
$price = $_REQUEST["price"];
$amount = $qty * $price;
//echo $sno." ".$uid." ".$qty." ".$price;
include 'con.php';
if($type_id == 3){
//$query = mysqli_query($con,"update sale_detail set uid = $uid,price = $price,qty = $qty,amount = price*qty where sno = $sno");
$query = mysqli_query($con,"insert into sale_detail(bill_id,uid,price,qty,amount,date) values($sno,$uid,$price,$qty,$amount,CURDATE())");
//$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from sale_detail where bill_id = (select bill_id from sale_detail where sno = $sno)) where transaction_type = 3 and transaction_id = (select bill_id from sale_detail where sno = $sno)");
$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from sale_detail where bill_id = $sno) where transaction_type = 3 and transaction_id = $sno");
}
if($type_id == 10){
//$query = mysqli_query($con,"update sale_detail set uid = $uid,price = $price,qty = $qty,amount = price*qty where sno = $sno");
$query = mysqli_query($con,"insert into baardana_detail(bill_id,uid,price,qty,amount,date) values($sno,$uid,$price,$qty,$amount,CURDATE())");
//$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from sale_detail where bill_id = (select bill_id from sale_detail where sno = $sno)) where transaction_type = 3 and transaction_id = (select bill_id from sale_detail where sno = $sno)");
$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from baardana_detail where bill_id = $sno) where transaction_type = 10 and transaction_id = $sno");
}

if($type_id == 2){
//$query = mysqli_query($con,"update sale_detail set uid = $uid,price = $price,qty = $qty,amount = price*qty where sno = $sno");
$query = mysqli_query($con,"insert into bill_detail(bill_id,uid,price,qty,amount,date) values($sno,$uid,$price,$qty,$amount,CURDATE())");
//$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from sale_detail where bill_id = (select bill_id from sale_detail where sno = $sno)) where transaction_type = 3 and transaction_id = (select bill_id from sale_detail where sno = $sno)");
$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from bill_detail where bill_id = $sno) where transaction_type = 2 and transaction_id = $sno");
}
if($type_id == 1){
$query = mysqli_query($con,"update purchase_detail set uid = $uid,price = $price,qty = $qty,amount = price*qty where sno = $sno");
$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from purchase_detail where bill_id = (select bill_id from purchase_detail where sno = $sno)) where transaction_type = 1 and transaction_id = (select bill_id from purchase_detail where sno = $sno)");
}
?>
