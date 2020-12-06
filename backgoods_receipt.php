<?php 
session_start();
include 'con.php';
$bill_no = $_REQUEST["bill_no"]; 
//$ledger_id = $_REQUEST["ledger_id"];
$date = $_REQUEST["date"];
$station = $_REQUEST["station"];
$truck_no = $_REQUEST["truck_no"];
$station_to = $_REQUEST["station_to"];
echo $station_to;
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
$query = mysqli_query($con,"insert into goods_receipt_detail(peti,dabba,variety,quality,rate,amount,bill_no,date,khata,marka) select peti,dabba,variety,quality,rate,amount,bill_no,date,khata,marka from fruit_buffer");
echo mysqli_error($con);
$query_goods_details = mysqli_query($con,"insert into goods_details(tran_id,status,station_from,station_to) values ($bill_no,false,'".$station."','$station_to')");
$query_tot = mysqli_query($con,"insert into daybook (date,amount,transaction_type,transaction_id,log_date,narration) select '$date',sum(amount),16,$bill_no,CURDATE(),'$truck_no' from goods_receipt_detail where bill_no = $bill_no");
echo mysqli_error($con);
}
if($query_tot)
//header("location:printreceipt.php?tran_id=".$bill_no);'
echo $bill_no;
else
echo mysqli_error($con);
//header("location:transactions.php");
?>
