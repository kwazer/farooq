<?php
include 'con.php';
$ledger_id = $_REQUEST["ledger_id"];
$sno = $_REQUEST["sno"];
$amount = $_REQUEST["amount"];
$date = $_REQUEST["date"];
$narration = $_REQUEST["narration"];
echo $ledger_id." ".$sno." ".$amount." ".$date;
$query_update = mysqli_query($con,"update daybook set amount = '$amount',ledger_id = '$ledger_id',narration = '$narration',date='$date' where sno = '$sno'");
if($query_update)
echo "successful";
else
echo "unsuccessful";

?>
