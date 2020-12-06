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
$arrayDaybook = array();
//echo "<form method = 'POST' action = 'backeditpaymentrunner.php' onsubmit = \"return submit_changes(this)\">";

//$query_list_ledger = mysqli_query($con,"select *,concat(ledger_tenure,ledger_id) as account_no From ledgers join ledger_details using (ledger_id) where ledger_type = 2");
$query_list_ledger = mysqli_query($con,"select * from runner");
while($ro_ledger = mysqli_fetch_array($query_list_ledger))
{
	$arrayLedger[] = $ro_ledger;
}


// $query = mysqli_query($con,"select * from daybook join transaction_type on daybook.transaction_type = transaction_type.type_id join runner on runner.runner_id = daybook.ledger_id where date = str_to_date('$other_ledger','%Y-%m-%d')");
 $query = mysqli_query($con,"select * from daybook join transaction_type on daybook.transaction_type = transaction_type.type_id join runner on runner.runner_id = daybook.ledger_id where date = '$other_ledger'");

echo "<table style = 'width:100%;' id = 'view_table'>";
echo "<tr><th style = 'width:250px;'>Ledger Name</th><th>Date</th><th>Type</th><th>Tr ID</th><th>Bill #</th><th>Amount</th></tr>";
while($row = mysqli_fetch_array($query))
{
	
	$arrayDaybook[] = $row;
}
foreach ($arrayDaybook as $day)
{
		echo "<form id = \"form".$day[sno]."\" method = 'POST' action = 'backeditpaymentrunner.php'>";

	echo "<input type = 'text' value = '".$day[sno]."' name = 'sno' style = 'display:none;'/>";
//	echo "<tr onclick = 'insert_details(this.rowIndex,".$row['transaction_id'].",".$row['type_id'].");'><td>";
	echo "<tr ><td>"; 
//	echo "<form method = 'POST' action = 'backeditpaymentrunner.php' onsubmit = \"return submit_changes(this)\">";

//	echo "<td>";
echo "<input type = 'text' list = 'eexampleList' value = '".$day[runner_name]."' name = 'eexample' id = 'eexample_input' oninput = 'showdatalist_value()' style = 'width:100%;height:28px;' autofocus/>";
echo "<datalist id = 'eexampleList' >";
foreach($arrayLedger as $row_ledger)
{
echo "<option value = '".$row_ledger[runner_name]."' data-id = '".$row_ledger[runner_id]."' id = '".$row_ledger[runner_id]."'>".$row_ledger[runner_id]."</option>";
}
echo "</datalist>";
	echo "</td><td><input type = 'text' style = 'width:80px;' value = '".$day[date]."' name ='date' /></td><td>".$day[type_name]."</td><td>".$day[transaction_id]."</td><td><input name = 'narration' type = 'text' style = 'width:80px;' value = '".$day[narration]."'/></td><td><input type = 'text' value='".$day[amount]."' name  = 'amount'/></td>";
		echo "<input type = 'text' name = 'other_ledgers' value = '".$day[runner_id]."' style = 'display:none;' id = 'other_ledgers'/>";


if($_SESSION['username'] == 'admin')
echo "<td><input type = 'submit' value = 'save'/></td><td ><a>Edit</a></td>"; 
echo "</form>";

echo "</tr>";
}
echo "</table>";
?>
