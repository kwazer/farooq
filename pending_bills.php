<?php
session_start();
include 'con.php';
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];

//$query_se = mysqli_query($con,"select * From daybook where transaction_type = '$sno' order by transaction_id desc limit 1");
//while($row_se = mysqli_fetch_array($query_se))
//{
	
//	$bil_no = $row_se['transaction_id'];
//}
//	if(isset($bil_no))
//	$bil_no = $bil_no + 1;
//	else
//	$bil_no = 1;

?>
<style>
	.lisst
	{
		color:navy;
		text-align:left;
	}
	
</style>
<script>

//function del()
//{
//	location.href = 'deleteitem.php?item_id='+item_id;
//}

</script>
<div id = "main-window" style = "width:750px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
$query_date = mysqli_query($con,"select DATE_FORMAT(date,'%d-%m-%Y') as date,alpha_serial from receipt_detail order by sno desc limit 1");
while($rowDate = mysqli_fetch_array($query_date))
{
	$date_fill = $rowDate['date'];
	$alpha_serial = $rowDate['alpha_serial'];
}
$array_ledger = array();

$query_ledger = mysqli_query($con,"select * from ledgers where ledger_type between 3 and 4");
while($row_ledger = mysqli_fetch_array($query_ledger))
{
	$array_ledger[] = $row_ledger;
}
//print_r($array_ledger);
echo "<form action = \"back".$ledger_type.".php\" method = \"post\" onsubmit = \"return submit_item(this)\">";

echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='transactions.php';\">Back</span><br><hr>";
//echo "<input type = 'text' name = 'transaction_type' id = 'transaction_type' value = '".$sno."' style = 'display:none;'/>";
//echo "<input type = 'text' name = 'bill_no' id = 'serial_no' value = '".$bil_no."' style = 'display:none;' />";
echo "<input type = 'text' name = 'ledger_id' id = 'uid' style = 'display:none;'/>";
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;\">";
echo "<td><input style = 'width:100%;' type = 'date' name = 'date' /></td><td><input style = 'width:100%;' placeholder = 'bill #' type = 'text' name = 'bill_no'/></td>";
echo "<td><input type = 'text' name = 'name' placeholder = 'Name' style = 'width:100%;'/></td><td><input type = 'text' name = 'father_name' style = 'width:100%;' placeholder = 'Father Name'/></td>";
echo "<td><input type = 'text' name = 'address' style = 'width:100%;' placeholder = 'address'/></td></tr><tr><td><input type = 'text' style = 'width:100%;' placeholder = 'narration' name = 'narration'</td>";
echo "<td><input type = 'text' style = 'width:100%;' name = 'balance' placeholder = 'Balance'/></td>";
echo "<td><input type = 'text' placeholder = 'phone' name = 'phone' style = 'width:100%;'/></td><td><input type = 'text' placeholder = 'phone2' name = 'phone2' style = 'width:100%;'/></td><td colspan = 5><input style = 'background:lightgreen;width:100%;color:navy;border:1px solid grey;height:22px;' type = 'submit'/></td></tr>";
echo "</table>";
echo "</form>";
echo "<table style = 'width:100%;border-collapse:collapse;border-color:blue;' border = '1' >";
echo "<th>Sno</th><th style = 'width:90px;'>Date</th><th>Bill No</th><th style = 'text-align:left;'>Name</th><th style = 'text-align:left;'>Parentage</th><th style = 'text-align:left;'>Address</th><th style = 'text-align:left;'>Narration</th><th style = 'text-align:right;'>Balance</th><th>Phone</th>";
$query_list = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from pending_bills order by sno desc");
while($row = mysqli_fetch_array($query_list))
{
	echo "<tr><td style = 'font-weight:bold;'>".$row['sno']."</td><td style = 'font-size:13px;'>".$row['date']."</td><td>".$row['bill_no']."</td><td style = 'text-align:left;font-weight:bold;'>".$row['name']."</td><td style = 'font-size:13px;text-align:left;'>".$row['father_name']."</td><td style = 'font-size:13px;text-align:left;'>".$row['address']."</td><td style='font-size:13px;'>".$row['narration']."</td><td style = 'text-align:right;'>".$row['balance']."</td><td style = 'font-size:12px;'>".$row['phone']."<br>".$row['phone2']."</td></tr>";
}
echo "</table>";
?>

</div>
