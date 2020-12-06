<?php 
include 'con.php';
$item_name = $_REQUEST["item_name"];
//$mrp = $_REQUEST["mrp"];
$publisher_discount = $_REQUEST["publisher_discount"];
$dealer_discount = $_REQUEST["dealer_discount"];
$publisher = $_REQUEST["publisher"];

$query_check = mysqli_query($con,"select * from receipt_books where alpha_serial = '$item_name' and ($publisher_discount between serial_begin and serial_end or $dealer_discount between serial_begin and serial_end)");
while($rowCheck = mysqli_fetch_array($query_check))
{
	$arrayCheck[] = $rowCheck;
}
if(count($arrayCheck) != 0)
{
	echo "book already exists";
}
else
{
$query_add_book = mysqli_query($con,"insert into receipt_books(alpha_serial,serial_begin,serial_end) values('$item_name','$publisher_discount','$dealer_discount')");
if($query_add_book)
{
$query_select_issue = mysqli_query($con,"select * from receipt_books order by book_id desc limit 1");
while($row_issue = mysqli_fetch_array($query_select_issue))
{
	$book_id = $row_issue['book_id'];
}
$query_issue = mysqli_query($con,"insert into book_issue(book_id,runner_id,issue_date) values($book_id,$publisher,CURDATE())");
}
}
header('location:itempage.php');
?>
