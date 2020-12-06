<style>
	th
	{
		background : white;
		color:brown;
		font-weight:normal;
	}
	#main
	{
		margin:0 auto;
		padding:15px;
		width:800px;
	}
	a
	{
		text-decoration:none;
	}
</style>
<div id = "main">
<?php 
$bill_no = $_GET["bill_no"];
$con = mysqli_connect("localhost","root","password","shop");
$query = mysqli_query($con,"select *,bill_detail.item_qty as price from bill_detail join item on bill_detail.item_id = item.item_id where bill_id =$bill_no");
echo "<table border = \"1\" style = \"border-collapse:collapse;width:100%;\">";
echo "<th>Item Name</th><th>Qty</th><th>Price</th><th>Total</th>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr><td>".$row['item_name']."</td><td>".$row['price']."</td><td>".$row['sale_price']."</td><td>".$row['total']."</td></tr>";
$tot = $tot + $row['total'];
}
echo "<tr><td></td><td></td><td></td><td>$tot</td></tr>";
echo "</table>";
?>
<a href="menu4.php?bill_no=<?php echo $bill_no;?>">Add more items</a>
</div>
