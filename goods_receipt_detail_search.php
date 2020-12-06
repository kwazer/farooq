<?php 
error_reporting("E_ERROR");
session_start();
include 'con.php';
$tran_id = $_REQUEST["tran_id"];
//echo "gdgtdt";
echo "<datalist id = 'eList' >";
$query_list_ledger = mysqli_query($con,"select *,concat(ledger_tenure,ledger_id) as account_no From ledgers join ledger_details using (ledger_id) where ledger_type = 6");
while($row_ledger = mysqli_fetch_array($query_list_ledger))
{
echo "<option style = 'font-weight:heavy;' value = '".$row_ledger['ledger_name']." S/o ".$row_ledger['father_name']." R/O ".$row_ledger['address']."' data-id = '".$row_ledger['account_no']."' id = '".$row_ledger['ledger_id']."'><span style = 'font-size:18px;'>".$row_ledger['account_no']."</span></option>";
}
//echo "<option value = 'Rama Books' data-id = '6' id = '6' onKeyUp = 'alert(\"6\");'>6</option>";
//echo "<option value = 'Aatma ram' data-id = '7' id = '7' onKeyUp = 'alert(\"7\");'>7</option>";
echo "</datalist>";
$query = mysqli_query($con,"select * from goods_receipt_detail where bill_no = '$tran_id'");
	echo "<table style = 'width:100%;'>";
//if($query)
//echo "it works";
//else
//print_r($query);
echo mysqli_error($con);
echo "<th>Marka</th><th>Peti</th><th>Half</th><th>Kind</th><th>Variety</th><th>Khata</th></th><th>Rate</th><th>Amount</th>";
echo "<input type = 'text' style = 'display:none;' id = 's_ledger_id'/>";
echo "<tr><td><input list = 'eList' type = 'text' name = 'sfruit_input' id = 'sfruit_input' oninput = 'fill_s_ledger_id()'/></td><td><input id = 'peti' oninput = 'lock_other(\"dabba\")' type = 'text' style = 'width:35px;'/></td><td><input onkeydown = 'lock_other(\"peti\")' id = 'dabba' type = 'text' style = 'width:35px;'/></td><td><input id = 'variety' type = 'text' style = 'width:50px;'/><td><input style = 'width:50px;' id = 'quality' type = 'text' /></td><td><input id = 'marka' type = 'text' /></td><td><input id = 'rate' type = 'text'  style = 'width:50px;' onkeyup = 'addon_details($tran_id)'/></td><td><input id = 'tamount' type = 'text'  style = 'width:70px;' disabled/></td></tr>";
echo "</table><hr style = 'background:red;height:2px;'>";
	echo "<table style = 'width:100%;'>";
while($row = mysqli_fetch_array($query))
{
//	echo "p";
echo "<input type = 'text' style = 'display:none;' id = 's_ledger_id".$row['sno']."' value = '".$row['ledger_id']."'/>";
echo "<tr><td><input list = 'eList' type = 'text' id = 'sfruit_input".$row['sno']."' oninput = 'fill_s_ledger_id_update(".$row['sno'].")' value = '".$row['khata']."'/></td><td><input id = 'peti".$row['sno']."' oninput = 'lock_other(\"dabba\")' value = '".$row['peti']."' type = 'text' style = 'width:35px;'/></td><td><input onkeydown = 'lock_other(\"peti\")' value = '".$row['dabba']."' id = 'dabba".$row['sno']."' type = 'text' style = 'width:35px;'/></td><td><input style = 'width:50px;' id = 'variety".$row['sno']."' value = '".$row['variety']."' type = 'text' style = 'width:100px;'/></td><td><input style = 'width:80px;' id = 'quality".$row['sno']."' value = '".$row['quality']."' type = 'text' /></td><td><input style = 'width:100px;' id = 'marka".$row['sno']."' value = '".$row['marka']."' type = 'text' /></td><td><input id = 'rate".$row['sno']."' value = '".$row['rate']."' type = 'text'  style = 'width:50px;'/></td><td><input id = 'amount".$row['sno']."' type = 'text'  style = 'width:70px;' value = '".$row['amount']."'/></td><td><button onclick = update_goods_receipt(".$row['sno'].")>Save</button><button style = 'left-margin:5px;' onclick = delete_fruit_sale(".$row['sno'].")>Del</button></td></tr>";
}
echo "</table>";

?>
