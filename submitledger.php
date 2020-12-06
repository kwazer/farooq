<?php 
$ledger_id = $_REQUEST["ledger_id"];
$tran_id = $_REQUEST["tran_id"];
//echo $ledger_id." ".$tran_id;
include 'con.php';
$query = mysqli_query($con,"update daybook set ledger_id = $ledger_id where transaction_id = '$tran_id' and transaction_type = '9'");
if($query)
{
	$query_update = mysqli_query($con,"update daybook set amount = (select net_amount from watak_detail where watak_no = $tran_id) where transaction_id = '$tran_id' and transaction_type = '9'");
$query_update2 = mysqli_query($con,"update watak_detail set ledger_id = $ledger_id where watak_no = $tran_id");
echo "successful";
}
else
echo "unsuccessful";
?>
