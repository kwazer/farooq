<?php 
error_reporting(E_ERROR);
session_start();
if($_SESSION['username'] == 'admin')
{
include 'con.php';
$sno = $_REQUEST["sno"];
$date = $_REQUEST["date"];
$bill_no = $_REQUEST["bill_no"];
$name = $_REQUEST["name"];
$father = $_REQUEST["father_name"];
$address = $_REQUEST["address"];
$narration = $_REQUEST["narration"];
$balance = $_REQUEST["balance"];
$phone = $_REQUEST["phone"];
$phone2 = $_REQUEST["phone2"];
//echo $sno." ".$date." ".$bill_no." ".$father." ".$name." ".$address." ".$narration." ".$balance." ".$phone." ".$phone2;
$query = mysqli_query($con,"update pending_bills set name = '$name',date = '$date',bill_no = $bill_no,father_name='$father',address='$address',narration='$narration',balance='$balance',phone='$phone',phone2='$phone2' where sno = $sno");
if($query)
echo "successful";
else
echo "successful";
}
?>
