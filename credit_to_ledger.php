<?php 
include 'con.php';
$ledger_id = $_REQUEST["ledger_id"];
$sno = $_REQUEST["sno"];
$query = mysqli_query($con,"update goods_receipt_detail set ledger_id = $ledger_id where sno = $sno");

?>
