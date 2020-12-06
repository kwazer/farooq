<?php
session_start();
include 'con.php';
$sno = $_REQUEST["bill_no"];
	$query_sel = mysqli_query($con,"select bill_no from fruit_sale_detail where sno = $sno");
	while($r = mysqli_fetch_array($query_sel))
	{
		$bil = $r['bill_no'];
	}
$query = mysqli_query($con,"delete from fruit_sale_detail where sno = $sno");
if($query)
{
	$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from fruit_sale_detail where bill_no = $bil) where transaction_type = 15 and transaction_id = '$bil'");
	echo "successful";
} 
?>
