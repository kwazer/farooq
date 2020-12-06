<?php
include 'con.php';
$tran_id = $_GET["tran_id"];
$query_last = mysqli_query($con,"select transaction_id from daybook where transaction_type = 11 order by transaction_id desc limit 1");
while($row_last = mysqli_fetch_array($query_last))
{
	$last_entry = $row_last['transaction_id'];
}
$query_ledger = mysqli_query($con,"select * from ledgers where ledger_type = 6");
echo "<datalist id = 'sundry_fruit'>";
while($row_ledger = mysqli_fetch_array($query_ledger))
{
	echo "<option value = '".$row_ledger['ledger_name']."' data-id = '".$row_ledger['ledger_id']."' id = '".$row_ledger['ledger_id']."'>".$row_ledger['ledger_id']."</option>";

}
echo "</datalist>";

$array_ledgers = array();
$query_ledger = mysqli_query($con,"select ledger_id,ledger_name from ledgers where ledger_type = '6'");
while($row_led = mysqli_fetch_array($query_ledger))
{
	$ledd_id = $row_led['ledger_id'];
	$array_ledgers[$ledd_id] = $row_led['ledger_name'];
}
//print_r($array_ledgers);
echo "<span style = 'text-align:center;font-weight:bold;color:navy;float:right;'>";
if($tran_id != 1)
{
	$pre_tran = $tran_id - 1;
echo "<span style = 'border:1px solid grey;padding:2px 10px;cursor:pointer;' onclick = 'add_watak(".$pre_tran.")'><= Previous</span>";
}
if($tran_id < $last_entry)
{
$new_tran = $tran_id + 1;
echo "<span style = 'padding:2px 10px;margin-left:100px;border:1px solid grey;cursor:pointer;' onclick = 'add_watak(".$new_tran.")'>Next => </span>";
}
echo "</span>";
$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as new_date from daybook join ledgers using (ledger_id) join truck_details on truck_details.challan_no = daybook.transaction_id where transaction_id = '$tran_id' and transaction_type = '11'");
echo "<table style = 'width:100%;border-collapse:collapse;' border = '1'>";
echo "<tr style = 'background:peachpuff;color:brown;font-weight:bold;'><td>Date</td><td>Challan no</td><td>Ledger Name</td><td>Transaction Id</td><td>Truck No</td></tr>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr style = 'color:blue;' onclick = 'add_watak(".$row['transaction_id'].")'><td>".$row['new_date']."</td><td>".$row['narration']."</td><td>".$row['ledger_name']." <span style = 'color:brown;'>B - ".$row['ledger_id']."</span></td><td>".$row['transaction_id']."</td><td>".$row['truck_no']."</td></tr>";
}
echo "</table>";

?>

<table style = 'width:100%;border-collapse:collapse;' border = "1">
	<tr><td colspan = '2'>Marka</td><td>P</td><td>H</td><td>Kind</td><td>Gross</td><td>Expenses</td><td>Net</td></tr>
<tr>
<td colspan = '2'><input type = "text" name = 'marka' id = "marka" style = "width:100%;"/></td><td><input name = 'peti' style = "width:50px;" id = "peti" type = "text"/></td><td><input name = 'dabba' style = "width:50px;" id = "dabba" type = "text"/></td><td><input type = "text" style = 'width:80px;' id = "kind"/></td><td><input type = "text" id = "gross" style = 'width:80px;'/></td><td><input type = "text" style = 'width:50px;' id = "expenses"/></td><td><input style = "width:80px;" type = "text" id = "net" onkeypress = "if(event.keyCode == 13)submit_marka(<?php echo $tran_id;?>)"/></td></tr>
<tr><td colspan = "8" style = 'text-align:right;margin-right:40px;'><button onclick = "submit_marka(<?php echo $tran_id;?>)">Submit</button></td></tr>
<!--</table>
<table style = 'width:100%;border-collapse:collapse;' border = '1'>-->
		<tr style = 'background:peachpuff;'><th>Marka</th><th>P</th><th>H</th><th  style = 'width:50px;'>Kind</th><th>Gross</th><th>Expenses</th><th>Net</th><th style = 'width:80px;'>Ledger</th></tr>
<?php

$query_list = mysqli_query($con,"select * from challan_detail where challan_id = $tran_id order by sno desc");
while($row = mysqli_fetch_array($query_list))
{
	if($row['ledger_id'] != "")
	{
		$new_led = $row['ledger_id'];
	echo "<tr><td>".$row['marka']."</td><td>".$row['peti']."</td><td>".$row['dabba']."</td><td  style = 'width:50px;'>".$row['kind']."</td><td style = 'text-align:right;'><input type = 'text' style='width:80px;text-align:right;' onkeypress = 'update_amounts(this.value,\"gross\",".$row['sno'].")' disabled value = '".$row['gross']."'/></td><td style = 'text-align:right;'><input type = 'text' style = 'width:80px;text-align:right;'  onkeypress = 'update_amounts(this.value,\"expenses\",".$row['sno'].")' disabled value='".$row['expenses']."'/></td><td style = 'text-align:right;'><input type = 'text' style = 'width:80px;text-align:right;' onkeypress = 'update_amounts(this.value,\"net\",".$row['sno'].")' disabled value = '".$row['net']."'/></td><td><input list = 'sundry_fruit' id = 'sundry_input".$row['sno']."' oninput = 'show_valuesb(".$row['sno'].")' value = '".$array_ledgers[$new_led]."' disabled type = 'text'/></td></tr>";
}
	else
	echo "<tr><td>".$row['marka']."</td><td>".$row['peti']."</td><td>".$row['dabba']."</td><td  style = 'width:50px;'>".$row['kind']."</td><td style = 'text-align:right;'><input type = 'text' style='width:80px;text-align:right;' onkeypress = 'update_amounts(this.value,\"gross\",".$row['sno'].")'  value = '".$row['gross']."'/></td><td style = 'text-align:right;'><input type = 'text' style = 'width:80px;text-align:right;'  onkeypress = 'update_amounts(this.value,\"expenses\",".$row['sno'].")' value='".$row['expenses']."'/></td><td style = 'text-align:right;'><input type = 'text' style = 'width:80px;text-align:right;' onkeypress = 'update_amounts(this.value,\"net\",".$row['sno'].")' value = '".$row['net']."'/></td><td><input list = 'sundry_fruit' id = 'sundry_input".$row['sno']."' oninput = 'show_valuesb(".$row['sno'].")' type = 'text'/></td></tr>";
$tot_peti = $tot_peti + $row['peti'];
$tot_half = $tot_half + $row['dabba'];
$tot_gross = $tot_gross + $row['gross'];
$tot_exp = $tot_exp + $row['expenses'];
$tot_net = $tot_net + $row['net'];
}
echo "<tr style = 'font-weight:bold;'><td font-size:19px;font-weight:bold;>Total</td><td>$tot_peti</td><td>$tot_half</td><td></td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_gross)."</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_exp)."</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_net)."</td></tr>";
?>
</table>
