<?php
session_start();
include 'con.php';
//$serial_no = $_REQUEST["bill_no"];
$date = $_REQUEST["date"];
$bill_no = $_REQUEST["bill_no"];
$name = $_REQUEST["name"];
$father = $_REQUEST["father_name"];
$address = $_REQUEST["address"];
$narration = $_REQUEST["narration"];
$balance = $_REQUEST["balance"];
$phone = $_REQUEST["phone"];
$phone2 = $_REQUEST["phone2"];
$query = mysqli_query($con,"insert into pending_bills(date,bill_no,name,father_name,address,narration,balance,phone,phone2) values('$date',$bill_no,'$name','$father','$address','$narration',$balance,$phone,$phone2)");
if($query)
	echo "successful";
else
	echo "unsuccessful".mysqli_error($con);
?>
