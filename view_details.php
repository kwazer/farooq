<style>
	.input_boxes
	{
		width:100%;border:0px;height:28px;
	}
</style>
<?php
session_start();
$transaction_id = $_REQUEST["sno"];
$type_id = $_REQUEST["type_id"];
include 'con.php';
if($type_id == 1)
{
	$query = mysqli_query($con,"select sno,name,price,qty,amount,uid From purchase_detail join items on items.item_id = purchase_detail.uid where bill_id = $transaction_id");
	$flag = 'true';
}

if($type_id == 2)
{
	$query = mysqli_query($con,"select sno,name,price,qty,amount,uid From bill_detail join items on items.item_id = bill_detail.uid where bill_id = $transaction_id");
		$flag = 'true';
}
if($type_id == 3)
{
	$query = mysqli_query($con,"select sno,name,price,qty,amount,uid From sale_detail join items on items.item_id = sale_detail.uid where bill_id = $transaction_id");
		$flag = 'true';
}
if($type_id == 10)
{
	$query = mysqli_query($con,"select sno,name,price,qty,amount,uid From baardana_detail join items on items.item_id = baardana_detail.uid where bill_id = $transaction_id");
		$flag = 'true';
}

//if()
echo "<table style = 'width:100%;border:2px solid red;border-radius:10px;' >";
//echo "<thead style='background:goldenrod;'><th colspan = '5'><p style= 'text-align:right;'></p></th></thead>";
echo "<thead style='background:turquoise;'><th>Name</th><th>qty</th><th >price</th><th >amount</th></thead>";
	echo "<input type = 'text' value = '' style = 'display:none'; id = 'uid'/>";
		echo "<input type = 'text' value = '".$type_id."' style = 'display:none'; id = 'type_id'/>";

echo "<tr><td><input type = 'text' placeholder = 'Enter Item Name Here' oninput = 'showdatalist_valueeedit(".$transaction_id.")' style = 'width:100%;border:0px;height:28px;' list = 'namelistt' id = 'item_name'/></td><td><input type = 'text' style = 'width:100%;border:0px;height:28px;' placeholder = 'Enter quantity here' id = 'qty'/><td><input id = 'price' type = 'text' placeholder = 'enter amount here' style = 'width:100%;border:0px;height:28px;'/></td><td><button onclick = 'add_details(".$transaction_id.")'>Submit</button></td></tr>";
while($row = mysqli_fetch_array($query))
{
	echo "<input type = 'text' value = '".$row['uid']."' style = 'display:none'; id = 'uid".$row['sno']."'/>";
	echo "<input type = 'text' value = '".$type_id."' style = 'display:none'; id = 'type_id".$row['sno']."'/>";
	echo "<tr><td><input style = 'width:100%;border:0px;height:28px;' value = '".$row['name']."' type = 'text' id = 'item_name".$row['sno']."' list = 'namelist' oninput = 'showdatalist_valueedit(".$row['sno'].")' /></td><td><input class = 'input_boxes' id = 'qty".$row['sno']."' type = 'text' value = '".$row['qty']."'/></td><td><input value = '".$row['price']."' type = 'text' id = 'price".$row['sno']."' class = 'input_boxes'/></td><td id = 'amount".$row['sno']."'>".$row['amount']."<span style = 'color:red;float:right;border:1px solid black;padding:2px 5px;border-radius:5px;font-size:13px;' onclick = 'delete_details(".$row['sno'].")'>Del</span><span style = 'float:right;border:1px solid black;padding:2px 5px;border-radius:5px;font-size:13px;' onclick = 'update_details(".$row['sno'].")'>save</span></td></tr>";
}
echo "<datalist id = 'namelist'>";
$query_list_ledger = mysqli_query($con,"select * From items");
while($row_ledger = mysqli_fetch_array($query_list_ledger))
{
echo "<option value = '".$row_ledger['name']."' data-id = '".$row_ledger['item_id']."' id = '".$row_ledger['item_id']."'>".$row_ledger['item_id']."</option>";
}
echo "</datalist>";
echo "<datalist id = 'namelistt'>";
$query_list_ledger = mysqli_query($con,"select * From items");
while($row_ledger = mysqli_fetch_array($query_list_ledger))
{
echo "<option value = '".$row_ledger['name']."' data-id = '".$row_ledger['item_id']."' id = '".$row_ledger['item_id']."'>".$row_ledger['item_id']."</option>";
}
echo "</datalist>";
echo "</table>";
?>
