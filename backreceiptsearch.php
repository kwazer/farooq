<?php 
session_start();
include 'con.php';
$receipt_no= $_REQUEST["receipt_no"];
$alpha_serial = $_REQUEST["alpha_serial"];
$arrayLedger = array();
echo "<form method = 'POST' action = 'backeditreceipt.php' onsubmit = \"return submit_changes(this)\">";

$query_list_ledger = mysqli_query($con,"select *,concat(ledger_tenure,ledger_id) as account_no From ledgers join ledger_details using (ledger_id) where ledger_type = 2");
while($ro_ledger = mysqli_fetch_array($query_list_ledger))
{
	$arrayLedger[] = $ro_ledger;
}
 $query = mysqli_query($con,"select *,concat(alpha_serial,receipt_no) as receipt from receipt_detail join ledgers using (ledger_id) where alpha_serial = '$alpha_serial' and receipt_no = '$receipt_no'");
echo "<table style = 'width:100%;'>";
echo "<th>Ledger Name</th><th>Date</th><th>Tr ID</th><th>Amount</th><th>Narration</th>";
while($row = mysqli_fetch_array($query))
{
	echo "<input type = 'text' value = '".$row['sno']."' name = 'sno' style = 'display:none;'/>";
	echo "<tr><td>";
echo "<input type = 'text' list = 'eexampleList' value = '".$row['ledger_name']."' name = 'eexample' id = 'eexample_input' oninput = 'showdatalistt_value()' style = 'width:100%;height:28px;' autofocus/>";
echo "<datalist id = 'eexampleList' >";
foreach($arrayLedger as $row_ledger)
{
echo "<option value = '".$row_ledger[ledger_name]." S/o ".$row_ledger[father_name]."' data-id = '".$row_ledger[ledger_id]."' id = '".$row_ledger[ledger_id]."'>".$row_ledger[account_no]."</option>";
}
echo "</datalist>";

	echo "</td><td><input name = 'date' type = 'text' value = '".$row['date']."'/></td><td>".$row['receipt']."</td><td><input name = 'amount' type = 'text' value = '".$row['amount']."'/></td><td><input name = 'narration' type = 'text' value = '".$row['narration']."'/></td>";
	echo "<input type = 'text' name = 'other_ledgers' value = '".$row['ledger_id']."' style = 'display:none;' id = 'other_ledgers'/>";
}
if($_SESSION['username'] == 'admin')
echo "<td><input type = 'submit' value = 'save'/></td></tr>";
echo "</table>";
echo "</form>";

?>
