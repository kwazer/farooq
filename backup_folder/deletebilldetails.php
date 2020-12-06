<?php 
$sno = $_REQUEST["sno"];
$uid = $_REQUEST["uid"];
$qty = $_REQUEST["qty"];
$type_id = $_REQUEST["type_id"];
$price = $_REQUEST["price"];
echo $sno." ".$uid." ".$qty." ".$price;
include 'con.php';
if($type_id == 3){
	$query_bill_id = mysqli_query($con,"select bill_id from sale_detail where sno = $sno");
	while($row = mysqli_fetch_array($query_bill_id))
	{
		$bill_id = $row['bill_id'];
	}
//$query = mysqli_query($con,"update sale_detail set uid = $uid,price = $price,qty = $qty,amount = price*qty where sno = $sno");
$query = mysqli_query($con,"delete from sale_detail where sno = $sno");
$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from sale_detail where bill_id = $bill_id) where transaction_type = 3 and transaction_id = $bill_id");
}
if($type_id == 1){
$query = mysqli_query($con,"update purchase_detail set uid = $uid,price = $price,qty = $qty,amount = price*qty where sno = $sno");
$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from purchase_detail where bill_id = (select bill_id from purchase_detail where sno = $sno)) where transaction_type = 1 and transaction_id = (select bill_id from purchase_detail where sno = $sno)");
}

?>
