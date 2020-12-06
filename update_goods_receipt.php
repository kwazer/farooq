<?php
session_start();
include "con.php"; 
$ledger_id = $_REQUEST["ledger_id"];
$sno = $_REQUEST["bill_no"];
//$date = $_REQUEST["date"];
$peti = $_REQUEST["peti"];
$dabba = $_REQUEST["dabba"];
$variety = $_REQUEST["variety"];
$quality = $_REQUEST["quality"];
$marka = $_REQUEST["marka"];
//$amount = $_REQUEST["amount"];
$rate = $_REQUEST["rate"];
$amount = 0;
if($peti != "")
$amount = $amount + ($rate * $peti);
if($dabba != "")
$amount = $amount + ($rate * ($dabba/2));
//echo $sno;
//echo $ledger_id." ".$sno." ".$date." ".$peti." ".$dabba." ".$variety." ".$quality." ".$amount." ".$rate;
//$query = mysqli_query($con,"insert into fruit_buffer(bill_no,date,peti,dabba,variety,quality,rate,amount,ledger_id) values ($sno,'$date',$peti,$dabba,'$variety','$quality','$rate','$amount',$ledger_id)");
$query = mysqli_query($con,"update goods_receipt_detail set khata = '$ledger_id',peti = $peti,dabba = $dabba,variety='$variety',quality = '$quality',rate='$rate',amount='$amount',marka='$marka' where sno = '$sno'");
if($query)
{
	echo "successful";
//	$new_query = mysqli_query($con,"select bill_no from fruit_sale_detail where sno = '$sno'");
	$new_query = mysqli_query($con,"select bill_no from goods_receipt_detail where sno = '$sno'");
	while($r = mysqli_fetch_array($new_query))
	{
		$bill = $r['bill_no'];
	}
	$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from goods_receipt_detail where bill_no = $bill) where transaction_type = 16 and transaction_id = '$bill'");
}
else
echo mysqli_error($con);
?>
