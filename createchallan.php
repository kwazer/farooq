<body onload = "alert('successful')">
</body>
<?php 
$date = $_GET["date"];
$party_id = $_GET["ledger_id"];
$challan_no = $_GET["challan_no"];
$truck_no = $_GET["truck_no"];
$driver_name = $_GET["driver_name"];
$phone_no = $_GET["phone_no"];
//echo $date." ".$party_id." ".$challan_no;
include 'con.php';
$tran_id = 1;
$query_tran = mysqli_query($con,"select transaction_id from daybook where transaction_type = 11 order by transaction_id desc limit 1");
while($row = mysqli_fetch_array($query_tran))
{
	$tran_id = $row['transaction_id']+1;
}
$query = mysqli_query($con,"insert into daybook(date,transaction_type,transaction_id,narration,ledger_id) values('$date','11',$tran_id,'$challan_no',$party_id)");
if($truck_no != "")
$query_truck = mysqli_query($con,"insert into truck_details(challan_no,truck_no,driver_name,phone_no) values($tran_id,'$truck_no','$driver_name','$phone_no')");
header("location:transactions.php");

?>
