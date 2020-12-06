<?php 
session_start();
if($_SESSION['username'] ==  'admin')
{
include 'con.php';
$other_ledger = $_REQUEST["other_ledgers"];
$narration = $_REQUEST["narration"];
$date = $_REQUEST["date"];
//$amount = $_REQUEST["amount"];
$sno = $_REQUEST["sno"];
//$other_ledger = $other_ledger * 1;
$other = $other_ledger;
echo $other_ledger." ".$sno;
$query_select = mysqli_query($con,"select transaction_type from daybook where sno = $sno");
while($row = mysqli_fetch_array($query_select))
{
	$tran_id = $row['transaction_type'];
}
if($tran_id == 2)
{
	$queryUpdate = mysqli_query($con,"update daybook join sale_ledgers using (ledger_id) set ledger_name = '$other',narration  ='$narration',date ='$date' where daybook.sno = '$sno'");
if($queryUpdate)
{
	echo "successful";
}
}
else
$queryUpdate = mysqli_query($con,"update daybook set ledger_id = '$other',narration  ='$narration',date ='$date' where sno = '$sno'");
//if($queryUpdate)
//echo "successful";
//else
//echo "successful";
}
?>
