<?php 
session_start();
$transaction_id = $_REQUEST["sno"];
$type_id = $_REQUEST["type_id"];
include 'con.php';
if($type_id == 1)
{
	$query = mysqli_query($con,"select name,price,qty,amount From purchase_detail join items on items.item_id = purchase_detail.uid where bill_id = $transaction_id");
	$flag = 'true';
}

if($type_id == 2)
{
	$query = mysqli_query($con,"select name,price,qty,amount From bill_detail join items on items.item_id = bill_detail.uid where bill_id = $transaction_id");
		$flag = 'true';
}
if($type_id == 3)
{
	$query = mysqli_query($con,"select name,price,qty,amount From sale_detail join items on items.item_id = sale_detail.uid where bill_id = $transaction_id");
		$flag = 'true';
}

//if()
echo "<table style = 'width:100%;border:2px solid red;border-radius:10px;' >";
echo "<thead style='background:gold;'><th colspan = '5'><p style= 'text-align:right;'><button style = 'border:1px solid white;margin:2px;'>EDIT</button><button style = 'border:1px solid white;margin:2px;'> DELETE</button></p></th></thead>";
echo "<thead style='background:peachpuff;'><th>Name</th><th>qty</th><th >price</th><th >amount</th></thead>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr><td><input style = 'width:100%;border:0px;height:28px;' value = '".$row['name']."' type = 'text' id = 'book_name".$row['sno']."' list = 'namelist'/></td><td>".$row['qty']."</td><td>".$row['price']."</td><td>".$row['amount']."</td></tr>";
}
echo "<datalist id = 'namelist'>";
$query_list_ledger = mysqli_query($con,"select * From items");
while($row_ledger = mysqli_fetch_array($query_list_ledger))
{
echo "<option value = '".$row_ledger['name']."' data-id = '".$row_ledger['item_id']."' id = '".$row_ledger['item_id']."'>".$row_ledger['item_id']."</option>";
}
echo "</datalist>";
echo "</table>";
?>
