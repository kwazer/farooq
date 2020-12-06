<?php
error_reporting(E_ERROR); 
session_start();
include 'con.php';
$sno= $_REQUEST["receipt_no"];
//echo $sno;
//$alpha_serial = $_REQUEST["alpha_serial"];
$arrayLedger = array();
echo "<form method = 'POST' action = 'backeditpending_bills.php' onsubmit = \"return submit_changes(this)\">";

echo "<datalist id = 'eexampleList' >";
foreach($arrayLedger as $row_ledger)
{
echo "<option value = '".$row_ledger[ledger_name]." S/o ".$row_ledger[father_name]."' data-id = '".$row_ledger[ledger_id]."' id = '".$row_ledger[ledger_id]."'>".$row_ledger[account_no]."</option>";
}
echo "</datalist>";
echo "<table style = 'width:100%;'>";
$query  = mysqli_query($con,"select * from pending_bills where sno = $sno");
	while($row = mysqli_fetch_array($query))
{
	echo "<input type = 'text' value = '".$row['sno']."' name = 'sno' style = 'display:none;'/>";
	echo "<tr><td style = 'text-align:left;'>Date</td><td><input type = 'date' style = 'width:100%;' value = '".$row['date']."' name = 'date'/></td></tr>";
	echo "<tr><td style = 'text-align:left;'>Bill No</td><td><input type = 'text' style = 'width:100%;' value = '".$row['bill_no']."' name = 'bill_no'/></td></tr>";
	echo "<tr><td style = 'text-align:left;'>Name</td><td><input type = 'text' value = '".$row['name']."' style = 'width:100%;' name = 'name'/></td></tr>";
	echo "<tr><td style = 'text-align:left;'>Father Name</td><td><input type = 'text' value = '".$row['father_name']."' style = 'width:100%;' name = 'father_name'/></td></tr>";
	echo "<tr><td style = 'text-align:left;'>Address</td><td><input type = 'text' value = '".$row['address']."' name = 'address' style = 'width:100%;'/></td></tr>";
	echo "<tr><td style = 'text-align:left;'>Narration</td><td><input type = 'text' value = '".$row['narration']."' name = 'narration' style = 'width:100%;'/></td></tr>";
	echo "<tr><td style = 'text-align:left;'>Phone</td><td><input type = 'text' value = '".$row['phone']."' name = 'phone' style = 'width:100%;'/></td></tr>";
	echo "<tr><td style = 'text-align:left;'>Phone2</td><td><input type = 'text' value = '".$row['phone2']."' name = 'phone2' style = 'width:100%;'/></td></tr>";
	echo "<tr><td style = 'text-align:left;'>balance</td><td><input type = 'text' value = '".$row['balance']."' name = 'balance' style = 'width:100%;'/></td></tr>";
}
if($_SESSION['username'] == 'admin')
echo "<td><input type = 'submit' value = 'save'/></td></tr>";
echo "</table>";
echo "</form>";

?>
