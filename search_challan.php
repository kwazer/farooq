<?php
session_start();
include 'con.php';
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];
$challan_id = $_REQUEST["search_query"];
//echo $challan_id;
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
</script>
<div id = "main-window" style = "width:780px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
//print_r($array_ledger);
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='searchpage.php';\">Back</span><br><hr>";
//echo "<form>";
echo "<table style = 'width:100%;'>";
echo "<input type = 'text' value = '$sno' style = 'display:none;' name = 'type_id' id= 'type_id'/>";
echo "<input type = 'text' value = '$ledger_type' style = 'display:none;' name = 'type_name' id = 'type_name'/>";
echo "<tr><td><label style= 'height:28px;padding:1px;margin-right:10px;'><i>Challan No.</i></label></td><td><input onkeypress = 'update_query(this.value)' style = 'padding:1px;height:28px;width:100%;' type = 'text' name = 'search_query' id = 'search_query'/></td><td><input type = 'button' value = 'Search' style = 'height:28px;font-style:italic;' onclick = \"ledger_types(7,'search_challan')\"/></td></tr>";
echo "</table>";
//echo "</form>";
$query_ledger = mysqli_query($con,"select * from ledgers where ledger_type = 7");
echo "<datalist id = 'exampleList'>";
while($row_ledger = mysqli_fetch_array($query_ledger))
{
	echo "<option value = '".$row_ledger['ledger_name']."' data-id = '".$row_ledger['ledger_id']."' id = '".$row_ledger['ledger_id']."'> B ".$row_ledger['ledger_id']."</option>";

}
echo "</datalist>";
$query_fledger = mysqli_query($con,"select * from ledgers where ledger_type = 6");
echo "<datalist id = 'sundry_fruit'>";
while($row_ledger = mysqli_fetch_array($query_fledger))
{
	echo "<option value = '".$row_ledger['ledger_name']."' data-id = '".$row_ledger['ledger_id']."' id = '".$row_ledger['ledger_id']."'> F ".$row_ledger['ledger_id']."</option>";

}
echo "</datalist>";
$array_ledgers = array();
$query_ledger = mysqli_query($con,"select ledger_id,ledger_name from ledgers where ledger_type = '6'");
while($row_led = mysqli_fetch_array($query_ledger))
{
	$ledd_id = $row_led['ledger_id'];
	$array_ledgers[$ledd_id] = $row_led['ledger_name'];
}

if(isset($challan_id))
{
//	echo $challan_id;
$query = mysqli_query($con,"select * from daybook join ledgers using (ledger_id) where transaction_type = 11 and narration = '$challan_id' order by date desc");
echo "<table style = 'width:100%;border-collapse:collapse;' border = '1'>";
echo "<tr style = 'background:peachpuff;color:brown;font-weight:bold;'><td>Date</td><td>Challan no</td><td>Ledger Name</td><td>Tran Id</td><td>Actions</td></tr>";
while($row = mysqli_fetch_array($query))
{
	$new_challan_id = $row['transaction_id'];
	echo "<input type = 'text' name = 'ledger_id' id = 'ledger_id' style = 'display:none;' value = '".$row['ledger_id']."'/>";
//	echo "<tr style = 'color:blue;' onclick = 'add_watak(".$row['transaction_id'].")'><td>".$row['new_date']."</td><td>".$row['narration']."</td><td>".$row['ledger_name']." <span style = 'color:brown;'> -B ".$row['ledger_id']."</span></td><td>".$row['transaction_id']."</td><td><button>Submit Challan</button></td></tr>";
//	echo "<tr style = 'color:blue;'><td><input type = 'date' value = '".$row['date']."' id = 'challan_date'/></td><td style = 'width:100px;'><input style = 'width:100px;' type = 'text' value = '".$row['narration']."' id= 'narration'/></td><td><input list = 'exampleList' id = 'b_input' oninput = 'showb_value()' type = 'text' value = '".$row['ledger_name']."'/> <span style = 'color:brown;'> B ".$row['ledger_id']."</span></td><td>".$row['transaction_id']."</td><td><button onclick = 'update_challan(".$row['sno'].")'>Save Changes</button></td></tr>";
	echo "<tr style = 'color:blue;'><td><input type = 'date' value = '".$row['date']."' id = 'challan_date'/></td><td style = 'width:100px;'><input style = 'width:100px;' type = 'text' value = '".$row['narration']."' id= 'narration'/></td><td><input list = 'exampleList' id = 'b_input' oninput = 'showb_value()' type = 'text' value = '".$row['ledger_name']."'/> </td><td>".$row['transaction_id']."</td><td><button onclick = 'update_challan(".$row['sno'].")'>Save Changes</button></td></tr>";
}
echo "</table>";
echo "<table style = 'width:100%;border-collapse:collapse;' border = \"1\">";
	echo "<tr style = 'background:peachpuff;'><th>Marka</th><th>P</th><th>H</th><th  style = 'width:50px;'>Kind</th><th>Gross</th><th>Expenses</th><th>Net</th><th style = 'width:80px;'>Ledger</th></tr>";
	$query_list = mysqli_query($con,"select * from challan_detail where challan_id = '$new_challan_id' order by sno desc");
while($row = mysqli_fetch_array($query_list))
{
//	if($row['ledger_id'] != "")
//	{
		$new_led = $row['ledger_id'];
	echo "<tr><td><input type = 'text' style='' onkeypress = 'update_amounts(this.value,\"marka\",".$row['sno'].")' value = '".$row['marka']."'/></td><td><input type = 'text' style='width:20px;text-align:right;' onkeypress = 'update_amounts(this.value,\"peti\",".$row['sno'].")' value = '".$row['peti']."'/></td><td><input type = 'text' style='width:20px;' onkeypress = 'update_amounts(this.value,\"dabba\",".$row['sno'].")' value = '".$row['dabba']."'/></td><td  style = 'width:50px;'><input type = 'text' style = 'width:50px;text-align:right;' onkeypress = 'update_amounts(this.value,\"kind\",".$row['sno'].")' value = '".$row['kind']."'/></td><td style = 'width:100px;text-align:right;'><input type = 'text' style='width:80px;text-align:right;' onkeypress = 'update_amounts(this.value,\"gross\",".$row['sno'].")' value = '".$row['gross']."'/></td><td style = 'text-align:right;'><input type = 'text' style = 'width:80px;text-align:right;'  onkeypress = 'update_amounts(this.value,\"expenses\",".$row['sno'].")' value='".$row['expenses']."'/></td><td style = 'text-align:right;'><input type = 'text' style = 'width:80px;text-align:right;' onkeypress = 'update_amounts(this.value,\"net\",".$row['sno'].")' value = '".$row['net']."'/></td><td><input list = 'sundry_fruit' id = 'sundry_input".$row['sno']."' oninput = 'show_valuesb(".$row['sno'].")' value = '".$array_ledgers[$new_led]."' type = 'text'/></td></tr>";
//}
//	else
//	echo "<tr><td>".$row['marka']."</td><td>".$row['peti']."</td><td>".$row['dabba']."</td><td  style = 'width:50px;'>".$row['kind']."</td><td style = 'text-align:right;'><input type = 'text' style='width:80px;text-align:right;' onkeypress = 'update_amounts(this.value,\"gross\",".$row['sno'].")'  value = '".$row['gross']."'/></td><td style = 'text-align:right;'><input type = 'text' style = 'width:80px;text-align:right;'  onkeypress = 'update_amounts(this.value,\"expenses\",".$row['sno'].")' value='".$row['expenses']."'/></td><td style = 'text-align:right;'><input type = 'text' style = 'width:80px;text-align:right;' onkeypress = 'update_amounts(this.value,\"net\",".$row['sno'].")' value = '".$row['net']."'/></td><td><input list = 'sundry_fruit' id = 'sundry_input".$row['sno']."' oninput = 'show_valuesb(".$row['sno'].")' type = 'text'/></td></tr>";
$tot_peti = $tot_peti + $row['peti'];
$tot_half = $tot_half + $row['dabba'];
$tot_gross = $tot_gross + $row['gross'];
$tot_exp = $tot_exp + $row['expenses'];
$tot_net = $tot_net + $row['net'];
}
echo "<tr style = 'font-weight:bold;'><td font-size:19px;font-weight:bold;>Total</td><td>$tot_peti</td><td>$tot_half</td><td></td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_gross)."</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_exp)."</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_net)."</td></tr>";
}

?>
<div id = 'search_result'>

</div>
</div>
