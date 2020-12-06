<?php 
include 'con.php';
$item_id = $_REQUEST["item_id"];
$item_name = $_REQUEST["item_name"];
$item_unit = $_REQUEST["item_unit"];
//$mrp = $_REQUEST["mrp"];
$cost_price = $_REQUEST["publisher_discount"];
$dealer_price = $_REQUEST["dealer_discount"];
$selling_price = $_REQUEST["retail_discount"];
$opening_qty = $_REQUEST["opening_qty"]; 
//$opening_rate = $_GET["opening_rate"];
//$alarm_qty = $_REQUEST["alarm_qty"];
//$isbn = $_REQUEST["isbn"];
//$category = $_GET["category"];
//$author = $_REQUEST["author"];
//$mrp = $_REQUEST["mrp"];
//$uid = $_GET["uid"];
$publisher = $_REQUEST["publisher"];
//$new_author = $_REQUEST["new_author"];
//$new_publisher = $_REQUEST["new_publisher"];

//$opening_stock = $opening_qty * $opening_rate;
//$selling_price = $mrp - (($mrp*$retail_discount)/100);
//$cost_price = $mrp - (($mrp*$publisher_discount)/100);
//$dealer_price = $mrp - (($mrp*$dealer_discount)/100);

//echo $item_id."<br>";
//echo $item_name."<br>";
//echo $mrp."<br>";
//echo $publisher_discount."<br>";
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
//$query_add_book = mysqli_query($con,"insert into items(name,retail_rate,dealer_rate,quantity,author,isbn,publisher,cost_price,dealer_discount,retail_discount,publisher_discount,quantity_alarm,mrp) values('$item_name',$selling_price,$dealer_price,$opening_qty,$author,'$isbn',$publisher,$cost_price,$dealer_discount,$retail_discount,$publisher_discount,$alarm_qty,$mrp)");
//$query_test = mysqli_query($con,"update items set mrp = '$mrp' where item_id = '$item_id'");
$query_update = mysqli_query($con,"update items set name = '$item_name',unit = '$item_unit',retail_rate = '$selling_price',dealer_rate = '$dealer_price', quantity = '$opening_qty', publisher = '$publisher',cost_price = '$cost_price' where item_id = '$item_id'");
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
//header('location:itempage.php');
?>
