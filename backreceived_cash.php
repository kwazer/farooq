<?php 
$amount = $_REQUEST["amount"];
$book = $_REQUEST["book"];
include 'con.php';
$query = mysqli_query($con,"select sum(amount) from receipt_detail join receipt_books using (book_id) where receipt_no between serial_begin and serial_end and receipt_detail.book_id = '$book'");
while($row = mysqli_fetch_array($query))
{
	if($row['sum(amount)'] == $amount)
	{
	echo "matches";
	$flag = 1;
}
	else
	{
	echo "mismatches";
	$flag = 0;
}
}

$query_count = mysqli_query($con,"select count(receipt_no) - (select serial_end - serial_begin + 1 from receipt_books where book_id = $book) as total_receipt from receipt_detail join book_issue using (runner_id) join receipt_books using(book_id) where receipt_no between serial_begin and serial_end and book_id = $book");
while($rowCount = mysqli_fetch_array($query_count))
{
	if($rowCount['total_receipt'] != 0)
	{
		$flag = 0;
		echo " and some receipts pending";
	}
}

if($flag == 1)
{
	$query_update = mysqli_query($con,"update receipt_books set cash_received = '$amount', cash_received_date = CURDATE() where book_id = $book");
}
?>
