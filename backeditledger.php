<?php 
$led_id = $_REQUEST["led_id"];
$ledger_type = $_REQUEST["ledger_type"];
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
$emi_installment = $_REQUEST["emi_installment"];
$folio = $_REQUEST["folio"];
$narration = $_REQUEST["narration"];
$open_date = $_REQUEST["open_date"];
$gp2 = $_REQUEST["gp2"];
$sides = $_REQUEST["sides"];
$account = $_REQUEST["account"];
//echo $phonesec;
//echo $ledger_name.$ledger_type.$opening_bal.$led_id;
//echo $emi_installment;
//echo $folio;
include 'con.php';

//$query = mysqli_query($con,"insert into ledgers(ledger_name,ledger_type,opening_balance) values('$ledger_name',$ledger_type,'$opening_bal')");
$query = mysqli_query($con,"update ledgers set ledger_name = '$ledger_name',opening_balance = '$opening_bal',ledger_date='$open_date',sides='$sides',account='$account' where ledger_id = $led_id");


//if($ledger_type == 2)
//{
/*	$querySelect = mysqli_query($con,"select * From ledgers order by ledger_id desc limit 1");
	while($row = mysqli_fetch_array($querySelect))
	{
		$ledger_id = $row['ledger_id'];
	}
	* */
	if($ledger_type == 2 OR $ledger_type == 6)
	$queryLedgerDetail = mysqli_query($con,"update ledger_details set father_name = '$father_name',address = '$address',guarantor = '$guarantor',phone_no = '$phone_no',phone_2 = '$phone_2',ledger_tenure='$payment_cycle',phone_sec = '$phonesec',installment = '$emi_installment',folio = '$folio',narration = '$narration',gp2='$gp2' where ledger_id = '$led_id'");
//}

?>
