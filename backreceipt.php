<?php
session_start();
include 'con.php';
//$serial_no = $_REQUEST["bill_no"];
$alpha_serial = $_REQUEST["alpha_serial"];
$date = $_REQUEST["date"];
//$transaction_type = $_REQUEST["transaction_type"];
$ledger_id = $_REQUEST["ledger_id"];
$amount = $_REQUEST["amount"];
$other_ledger = $_REQUEST["example"];
$narration = $_REQUEST["narration"];
$queryCheck = mysqli_query($con,"select * From receipt_detail where alpha_serial = '$alpha_serial' and receipt_no = '$other_ledger' ");
while($rowCheck = mysqli_fetch_array($queryCheck))
{
	$rowFlag = $rowCheck['receipt_no'];
}
//echo $serial_no."<br>".$transaction_type."<br>".$amount;
//$query_selector = mysqli_query($con,"select ")
//$query = mysqli_query($con,"insert into daybook(date,amount,transaction_type,ledger_id,transaction_id,fund_flow,narration) values(CURDATE(),'$amount','$transaction_type','$ledger_id','$serial_no','0')");
if(!isset($rowFlag))
{
$queryDetails = mysqli_query($con,"insert into receipt_detail(ledger_id,narration,date,receipt_no,alpha_serial,amount,runner_id,installment,book_id,log_date) select $ledger_id,'$narration',str_to_Date('".$date."','%d-%m-%Y'),'$other_ledger','$alpha_serial','$amount',runner_id,(select installment from ledger_details where ledger_id = $ledger_id) as installment,book_id,CURDATE() from receipt_books join book_issue using (book_id) where $other_ledger between serial_begin and serial_end and alpha_serial = '$alpha_serial'");
}
else 
{
	echo "receipt already exists";
}


if($queryDetails)
{
	echo "Sucessful";
}
else
{
	echo "Receipt Unsuccessful";
}
//$query_select = mysqli_query($con,"select sno from daybook order by sno desc limit 1");
//while($row = mysqli_fetch_array($query_select))
//{
//	$row_sno = $row['sno'];
//}
//$query_follow_up_entry = mysqli_query($con,"insert into daybook(date,amount,ledger_id,narration,fund_flow) values(CURDATE(),'$amount','$other_ledger','$row_sno','1')");
?>
