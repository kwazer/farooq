<style>
	.control_buttons
	{
		margin:5px;
		padding:2px 10px 2px 10x;
	}
	td,th
	{
		padding:3px;
		
	}
	th
	{
		letter-spacing:1px;
		font-size:16px;
		color:brown;
		font-weight:normal;
		border-bottom-style:solid;
		border-color:grey;
		border-width:1px;
	}
</style>
<?php 
session_start();
$value = $_REQUEST["uid"];
$led_id = $_REQUEST["led_id"];
$qty = $_REQUEST["qty"];
$transaction_type = $_REQUEST["transaction_type"];
//$emiAmount = $_REQUEST["emiAmount"];
//echo $value;
//$con = mysqli_connect("localhost","root","password","ci");
include 'con.php';
$query_check = mysqli_query($con,"select * from bill_buffer where uid = $value");
while($row_check = mysqli_fetch_array($query_check))
{
	$result_query_check = $row_check['uid'];
	$qty = $row_check['qty'];
//	echo $result_query_check."<span>results</span><br>";
//	echo $qty;
//	echo $result_query_check;
}
//echo "results";
if($value != "")
{
if(isset($result_query_check))
{
//	if(isset($qty))
//	$query_update = mysqli_query($con,"update bill_buffer set qty = qty +$qty where uid = '$value'");
//	else
	$query_update = mysqli_query($con,"update bill_buffer set qty = qty +1 where uid = '$value'");
}
else
{
	if(isset($qty))
	$query_insert = mysqli_query($con,"insert into bill_buffer(uid,qty) value('$value',$qty)");
	else
	$query_insert = mysqli_query($con,"insert into bill_buffer(uid,qty) value('$value',1)");

}
}
if($transaction_type == 3)
$query = mysqli_query($con,"select *,qty*dealer_rate as total from bill_buffer join items on bill_buffer.uid = items.item_id ");
else
$query = mysqli_query($con,"select *,qty*retail_rate as total from bill_buffer join items on bill_buffer.uid = items.item_id join author on items.author = author.author_id");
echo "<table style = 'width:100%;border:border-collapse;border-color:grey;border-width:0px;border-style:solid;' >";
//echo "<th>Item Name</th> <th>Qty</th> <th>Price</th><th style = 'text-align:right;'>Total</th>";
while($row = mysqli_fetch_array($query))
{
if($transaction_type == 3)
{
echo "<tr colspan = '4'><td colspan = '2'>".$row['name']."</td><td><input id = 'q".$row['sno']."' onKeyUp = 'if(event.keyCode == 13)alter_qty(".$row['sno'].",this.value,".$row['dealer_rate'].");' style = 'width:50px;text-align:center;' value = '".$row['qty']."' type = 'text'/></td><td><input onKeyUp = 'if(event.keyCode == 13)alter_qty(".$row['sno'].",document.getElementById('q".$row['sno']."').value,this.value);' type = 'text' value = '".$row['dealer_rate']."'/></td><td style = 'text-align:right;' id = 'p".$row['sno']."'>".$row['total']."</td></tr>";
}
else
{
echo "<tr><td>".$row['name']."</td><td><input style = 'width:50px;text-align:center;' value = '".$row['qty']."' type = 'text'/></td><td>".$row['retail_rate']."</td><td>".$row['author_name']."</td><td style = 'text-align:right;'>".$row['total']."</td></tr>";
}
/*$_SESSION['sales_challan'][unique_id][name] =  $row['name'];
$_SESSION['sales_challan'][unique_id][author] =  $row['author'];
$_SESSION['sales_challan'][unique_id][retail_rate] =  $row['retail_rate'];
*/
$grand_total = $grand_total + $row['total'];
}
echo "<tr style = 'border-top-style:solid;border-color:grey;border-width:1px;'><td></td><td></td><td style = 'font-weight:bold;'>Grand Total</td><td style = 'text-align:right;font-weight:bold;' id = 'grand_total'>$grand_total</td></tr>";
//header('location:sales.php');
echo "</table>";




echo "<div style = \"text-align:right;\"><button class = \"control_buttons\" onclick = \"confirm_sales(".$transaction_type.")\">Confirm</button><button class = \"control_buttons\" onclick  = \"cancel_bill()\">Cancel</button></div>";
?>
