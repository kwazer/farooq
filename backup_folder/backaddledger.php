<?php 

$father_name = $_REQUEST["father_name"];
$guarantor = $_REQUEST["guarantor"];
$address = $_REQUEST["address"];
$phone_no = $_REQUEST["phone_no"];
$phone_2 = $_REQUEST["phone_2"];
$phonesec = $_REQUEST["phone_no_sec"];
$ledger_name = $_REQUEST["ledger_name"];
$ledger_type = $_REQUEST["ledger_type"];
$opening_bal = $_REQUEST["opening_balance"];
$payment_cycle = $_REQUEST["payment_cycle"];
$gp2 = $_REQUEST["gp2"];
//echo $ledger_name.$ledger_type.$opening_bal;
include 'con.php';

if($ledger_type == 2  or $ledger_type == 6 )
{
	$query = mysqli_query($con,"insert into ledgers(ledger_name,ledger_type,opening_balance,ledger_date) values('$ledger_name',$ledger_type,$opening_bal,CURDATE())");

/*	$querySelect = mysqli_query($con,"select * From ledgers order by ledger_id desc limit 1");
	while($row = mysqli_fetch_array($querySelect))
	{
		$ledger_id = $row['ledger_id'];
	}
	* */
	if($query){
if($ledger_type == 2)
	$queryLedgerDetail = mysqli_query($con,"insert into ledger_details(ledger_id,father_name,address,guarantor,phone_no,phone_2,ledger_tenure,phone_sec,gp2) select ledger_id,'$father_name','$address','$guarantor','$phone_no','$phone_2','$payment_cycle','$phonesec','$gp2' from ledgers order by ledger_id desc limit 1");
else
	$queryLedgerDetail = mysqli_query($con,"insert into ledger_details(ledger_id,father_name,address,guarantor,phone_no,phone_2,ledger_tenure,phone_sec,gp2) select ledger_id,'$father_name','$address','$guarantor','$phone_no','$phone_2','$payment_cycle','$phonesec','$gp2' from ledgers order by ledger_id desc limit 1");
	if($queryLedgerDetail)
	{
			echo "successful";

	}
	else
	{
		echo "unsuccessful Please Fill the Details";
	}
}
	else
	{
		echo "unsuccessful";
	}
}

if($ledger_type == 1 or $ledger_type == 7)
{
	$query = mysqli_query($con,"insert into ledgers(ledger_name,ledger_type,opening_balance,ledger_date) values('$ledger_name',$ledger_type,$opening_bal,CURDATE())");
	if($query)
	{
		echo "successful";
	}
	else
	{
		echo "unsuccessful";
	}
}
//if(!$query)
//{
//	echo "unsuccessful";
//}
?>
