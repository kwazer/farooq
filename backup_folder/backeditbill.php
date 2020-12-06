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
$queryUpdate = mysqli_query($con,"update daybook set ledger_id = '$other',narration  ='$narration',date ='$date' where sno = '$sno'");
$flag_update = false;
$query_check = mysqli_query($con,"select * from updatelog where sno = $sno");
while($row_se = mysqli_fetch_array($query_check))
{
	$flag_update = true;
}
if($flag_update == false)
$querylog = mysqli_query($con,"insert into updatelog(sno) values($sno)");

//if($queryUpdate)
//echo "successful";
//else
//echo "successful";
}
?>
