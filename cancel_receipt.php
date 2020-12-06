<?php
include 'con.php';
$alpha_serial = $_REQUEST["alpha_serial"];
$receipt_no = $_REQUEST["receipt_no"];
$query = mysqli_query($con,"insert into receipt_detail(receipt_no,alpha_serial,date,cancel_flag) select '$alpha_serial',$receipt_no,1,CURDATE(),book_id from receipt_books where alpha_serial = $alpha_serial and $receipt_no between serial_begin and serial_end");
?>
