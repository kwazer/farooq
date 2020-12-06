<style>
	td
	{
		text-align:center;
	}
	.opbut
	{
//		border:1px solid black;
//		padding:2px;
		color:grey;
//		width:20px;
//		border-radius:10px;
	}
</style>
<?php
$bill_no = $_GET["bill_no"];
$item_id = $_GET["item_id"];
$qty = $_GET["qty"]; 
$con = mysqli_connect("localhost","root","password","shop");
$sel_qty = mysqli_query($con,"select sale_price from item where item_id = $item_id");
$gd = 0;
while($row_pr = mysqli_fetch_array($sel_qty))
{
	$price = $row_pr['sale_price'];
	$tot = $qty*$price;
//	$gd = $gd + $tot;
}
$query_check = mysqli_query($con,"select bill_id,item_id from temp_detail where bill_id = $bill_no");
while($row1 = mysqli_fetch_array($query_check))
{
	if(isset($row1['bill_id']))
	{
		if($row1['bill_id'] == $bill_no && $row1['item_id'] == $item_id)
		{
			$flag = 1;
			
		}
		else
		{
			$flag=0;
		}
	}
	else
	{
		$flag = 0;
	}
}
if($flag == 0)
$query = mysqli_query($con,"insert into temp_detail(item_id,item_qty,total,bill_id) values($item_id,$qty,$tot,$bill_no)");
else
$query = mysqli_query($con,"update temp_detail set item_qty = item_qty + $qty,total=total+$tot where bill_id = $bill_no and item_id = $item_id");
$query_sel = mysqli_query($con,"select *,temp_detail.item_qty as itqy From temp_detail join item on item.item_id = temp_detail.item_id where bill_id = $bill_no");
echo "<table border = \"1\" style = \"border-collapse:collapse;width:600px;\">";
echo "<th>Item Name</th><th>Qty</th><th>Price</th><th>Total</th><th>Options</th>";
while($row = mysqli_fetch_array($query_sel))
{
	echo "<tr>";
	echo "<td>".$row['item_name']."</td><td>".$row['itqy']."</td><td>".$row['sale_price']."</td><td>".$row['total']."</td><td><span class = \"opbut\" onclick = \"item_minus(".$row['sno'].",".$row['item_id'].")\">minus</span><span class = \"opbut\" style = \"margin-left:5px;\">Del</span></td></tr>";
		$gd = $gd + $row['total'];

}
echo "<tr><td></td><td>Total</td><td></td><td>$gd</td></tr>";
echo "</table>";
$query_up = mysqli_query($con,"update item set item_qty = item_qty - $qty where item_id = $item_id");

?>
