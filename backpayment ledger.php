<?php
session_start();
include 'con.php';
//$serial_no = $_REQUEST["bill_no"];
//$alpha_serial = $_REQUEST["alpha_serial"];
//$date = $_REQUEST["date"];
//$transaction_type = $_REQUEST["transaction_type"];
//$ledger_id = $_REQUEST["ledger_id"];
//$amount = $_REQUEST["amount"];
$other_ledger = $_REQUEST["example"];
//echo $other_ledger;
$arrayLedger = array();
echo "<form method = 'POST' action = 'backeditpaymentledger.php' onsubmit = \"return submit_changes(this)\">";

$query_list_ledger = mysqli_query($con,"select * from ledgers where ledger_type = 1");
while($ro_ledger = mysqli_fetch_array($query_list_ledger))
{
	$arrayLedger[] = $ro_ledger;
}


 $query = mysqli_query($con,"select * from daybook join transaction_type on daybook.transaction_type = transaction_type.type_id join ledgers using (ledger_id) where transaction_type = 7 and transaction_id = $other_ledger");
echo "<table style = 'width:100%;' id = 'view_table'>";
echo "<tr><th style = 'width:250px;'>Ledger Name</th><th>Date</th><th>Type</th><th>Tr ID</th><th>Bill #</th><th>Amount</th></tr>";
while($row = mysqli_fetch_array($query))
{
	echo "<input type = 'text' value = '".$row['sno']."' name = 'sno' style = 'display:none;'/>";
//	echo "<tr onclick = 'insert_details(this.rowIndex,".$row['transaction_id'].",".$row['type_id'].");'><td>";
	echo "<tr onclick = ''><td>";
echo "<input type = 'text' list = 'eexampleList' value = '".$row['ledger_name']."' name = 'eexample' id = 'eexample_input' autocomplete = 'off' oninput = 'showdatalisst_value()' style = 'width:100%;height:28px;' autofocus/>";
echo "<datalist id = 'eexampleList' >";
foreach($arrayLedger as $row_ledger)
{
echo "<option value = '".$row_ledger[ledger_name]."' data-id = '".$row_ledger[ledger_id]."' id = '".$row_ledger[ledger_id]."'>".$row_ledger[ledger_id]."</option>";
}
echo "</datalist>";
	echo "</td><td><input type = 'text' style = 'width:80px;' value = '".$row['date']."' name ='date' /></td><td>".$row['type_name']."</td><td>".$row['transaction_id']."</td><td><input name = 'narration' type = 'text' style = 'width:80px;' value = '".$row['narration']."'/></td><td><input type = 'text'  value='".$row['amount']."' name = 'amount'/></td>";
		echo "<input type = 'text' name = 'other_ledgers' value = '".$row['ledger_id']."' style = 'display:none;' id = 'other_ledgers'/>";

}
if($_SESSION['username'] == 'admin')
echo "<td><input type = 'submit' value = 'save'/></td><td ><a>Edit</a></td></tr>";

echo "</table>";
echo "</form>";
?>
