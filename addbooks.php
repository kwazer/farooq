<?php 
include 'con.php';
$item_name = $_REQUEST["item_name"];
//$mrp = $_REQUEST["mrp"];
$publisher_discount = $_REQUEST["publisher_discount"];
$dealer_discount = $_REQUEST["dealer_discount"];
$retail_discount = $_REQUEST["retail_discount"];
$cost_price =  $_REQUEST["publisher_discount"];
$opening_qty = $_REQUEST["opening_qty"]; 
//$opening_rate = $_REQUEST["opening_rate"];
//$alarm_qty = $_REQUEST["alarm_qty"];
//$isbn = $_REQUEST["isbn"];
//$category = $_REQUEST["category"];
//$author = $_REQUEST["author"];
//$mrp = $_REQUEST["mrp"];
//$uid = $_REQUEST["uid"];
$publisher = $_REQUEST["publisher"];
//$new_author = $_REQUEST["new_author"];
//$new_publisher = $_REQUEST["new_publisher"];

//$opening_stock = $opening_qty * $opening_rate;
//$selling_price = $mrp - (($mrp*$retail_discount)/100);
//$cost_price = $mrp - (($mrp*$publisher_discount)/100);
//$dealer_price = $mrp - (($mrp*$dealer_discount)/100);
$selling_price = $retail_discount;
$dealer_price = $dealer_discount;
/*
if(isset($new_author))
{
	$query_add_author = mysqli_query($con,"insert into authors(author_name) values('$new_author')");
	$query_author = mysqli_query($con,"select * from authors order by sno desc limit 1");
	while($row_author = mysqli_fetch_array($query_author))
	{
		$author = $row_author['sno'];
	}
}

if(isset($new_publisher))
{
	$query_add_publisher = mysqli_query($con,"insert into publisher(publisher_name) values('$new_publisher')");
	$query_publisher = mysqli_query($con,"select * from publisher order by sno desc limit 1");
	while($row_publisher = mysqli_fetch_array($query_publisher))
	{
		$publisher = $row_publisher['sno'];
	}
}
*/
$query_add_book = mysqli_query($con,"insert into items(name,retail_rate,dealer_rate,quantity,publisher,cost_price) values('$item_name',$selling_price,$dealer_price,$opening_qty,$publisher,$cost_price)");
/*
echo $item_name."<br>";
echo $mrp."<br>";
echo $publisher_discount."<br>";
echo $dealer_discount."<br>";
echo $retail_discount."<br>";
echo $opening_qty."<br>";
echo $opening_rate."<br>";
echo $alarm_qty."<br>";
echo $isbn."<br>";
echo $category."<br>";
echo $author."<br>";
echo $uid."<br>";
echo $opening_stock."<br>";
echo $selling_price."<br>";
echo $cost_price."<br>";
echo $dealer_price."<br>";
echo $publisher;
*/
header('location:itempage.php');
?>
