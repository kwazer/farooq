<?php
session_start();
include 'con.php';
$serial_no = $_REQUEST["bill_no"];
$date = $_REQUEST["date"];
$transaction_type = $_REQUEST["transaction_type"];
$ledger_id = $_REQUEST["ledger_id"];
$amount = $_REQUEST["amount"];
$other_ledger = $_REQUEST["other_ledger"];
//echo $serial_no."<br>".$transaction_type."<br>".$amount;
$query = mysqli_query($con,"insert into daybook(date,amount,transaction_type,ledger_id,transaction_id,fund_flow,narration,log_date) values(str_to_Date('".$date."','%d-%m-%Y'),'$amount','$transaction_type','$ledger_id','$serial_no','1','$other_ledger',CURDATE())");
if($query)
{
	echo "successful";
}
else
{
	echo "unsuccessful"." ".mysqli_error($con) ;
}
$query_select = mysqli_query($con,"select sno from daybook order by sno desc limit 1");
while($row = mysqli_fetch_array($query_select))
{
	$row_sno = $row['sno'];
}
//$queryCreateReceipt = mysqli_query($con,"insert into daybook(date,transaction_type,fund_flow,transaction_id,ledger_id,narration) select curdate(),'4','0',transaction_id + 1,'$ledger_id','$row_sno' from daybook where transaction_type = 4 order by sno desc limit 1");
//$query_follow_up_entry = mysqli_query($con,"insert into daybook(date,amount,ledger_id,narration,fund_flow) values(CURDATE(),'$amount','$other_ledger','$row_sno','0')");
//OB
?>
