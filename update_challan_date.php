<?php
include 'con.php';
$date = $_REQUEST["date"];
$ledger_id = $_REQUEST["ledger_id"];
$challan_id = $_REQUEST["challan_id"];
$sno = $_REQUEST["sno"];
echo $ledger_id;
$query = mysqli_query($con,"update daybook set date = '$date',narration='$challan_id',ledger_id = '$ledger_id' where sno = '$sno'");
$query_select = mysqli_query($con,"select transaction_id from daybook where sno = $sno");
while($row = mysqli_fetch_array($query_select))
{
	$new_tran = $row['transaction_id'];
}
if($query)
{
	$query_challan_update = mysqli_query($con,"update challan_detail set date = '$date' where challan_id = $new_tran");
if($query_challan_update)
  echo "sucessful";
}
?>
