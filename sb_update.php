<?php 
$ledger_id = $_REQUEST["ledger_id"];
$sno = $_REQUEST["tran_id"];
//echo $ledger_id." ".$sno;
include 'con.php';
$query = mysqli_query($con,"update challan_detail set ledger_id = $ledger_id where sno = '$sno'");
if($query)
{
//	$query_update = mysqli_query($con,"update daybook set amount = (select net_amount from watak_detail where watak_no = $tran_id) where transaction_id = '$tran_id' and transaction_type = '9'");
echo "successful";
}
else
echo "unsuccessful";
?>
