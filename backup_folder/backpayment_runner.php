<?php
session_start();
if($_SESSION['username'] == 'admin')
{
include 'con.php';
$serial_no = $_REQUEST["bill_no"];
$transaction_type = $_REQUEST["transaction_type"];
$ledger_id = $_REQUEST["ledger_id"];
$amount = $_REQUEST["amount"];
$other_ledger = $_REQUEST["other_ledger"];
//echo $serial_no."<br>".$transaction_type."<br>".$amount;

$query = mysqli_query($con,"insert into daybook(date,amount,transaction_type,ledger_id,transaction_id,fund_flow,narration,log_date) values(CURDATE(),$amount,'$transaction_type',$ledger_id,'$serial_no','1','$other_ledger',CURDATE())");
if($query)
{
	echo "sucessful";
}
else
{
	echo "unsuccessful";
}
//$query_select = mysqli_query($con,"select sno from daybook order by sno desc limit 1");
//while($row = mysqli_fetch_array($query_select))
//{
//	$row_sno = $row['sno'];
//}
//$query_follow_up_entry = mysqli_query($con,"insert into daybook(date,amount,ledger_id,narration,fund_flow) values(CURDATE(),'$amount','$other_ledger','$row_sno','0')");
}
?>
