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
$amount = $_REQUEST["amount"];
//$other_ledger = $other_ledger * 1;
$other = $other_ledger;
echo $other_ledger." ".$sno;
$queryUpdate = mysqli_query($con,"update daybook set ledger_id = $other_ledger,narration  ='$narration',date ='$date',amount='$amount' where sno = $sno");
$querylog = mysqli_query($con,"insert into updatelog(sno) values($sno)");
//if($queryUpdate)
//echo "successful";
//else
//echo "successful";
}
?>
