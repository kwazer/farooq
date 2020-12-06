<?php 
session_start();
include 'con.php';
$bill_no = $_REQUEST["bill_no"]; 
$ledger_id = $_REQUEST["ledger_id"];
$date = $_REQUEST["date"];
//echo $ledger_id." ".$bill_no."<br>";
//$sno = $_REQUEST["bill_no"];
$transaction_type = $_REQUEST["transaction_type"];
$flag = false;
$query_select = mysqli_query($con,"select * from fruit_buffer");
while($row = mysqli_fetch_array($query_select))
{
	$flag = true;
}
if($flag == true)
{
$query = mysqli_query($con,"insert into fruit_sale_detail(peti,dabba,variety,quality,rate,amount,bill_no,date,khata) select peti,dabba,variety,quality,rate,amount,bill_no,date,khata from fruit_buffer");
echo mysqli_error($con);
$query_tot = mysqli_query($con,"insert into daybook (date,amount,transaction_type,transaction_id,ledger_id,log_date) select '$date',sum(amount),15,$bill_no,$ledger_id,CURDATE() from fruit_sale_detail where bill_no = $bill_no");
echo mysqli_error($con);
}
if($query_tot)
header("location:printbill.php?tran_id=".$bill_no);
else
echo mysqli_error($con);
//header("location:transactions.php");
?>
