<?php
session_start();
include 'con.php';
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];
$tran_id = $_REQUEST["search_query"];

//echo $tran_id;
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
<div id = "main-window" style = "width:820px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
$query_ledger = mysqli_query($con,"select * from ledgers join ledger_details using (ledger_id) where ledger_type = 6");
echo "<datalist id = 'exampleList'>";
while($row_ledger = mysqli_fetch_array($query_ledger))
{
	echo "<option value = '".$row_ledger['ledger_name']." S/o ".$row_ledger['father_name']."' data-id = '".$row_ledger['ledger_id']."' id = '".$row_ledger['ledger_id']."'>".$row_ledger['ledger_id']."</option>";
}
echo "</datalist>";

$array_ledger = array();
$query_ledger = mysqli_query($con,"select * from ledgers where ledger_type = 6");
while($row_ledger = mysqli_fetch_array($query_ledger))
{
	$array_ledger[] = $row_ledger;
}
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='searchpage.php';\">Back</span><br><hr>";
echo "<table style = 'width:100%;'>";
echo "<tr><td><label style = 'font-size:18px;font-style:italic;'>Enter Watak No</label></td><td><input onkeypress = 'update_query(this.value)' style = 'height:28px;width:100%;' type = 'text' name = 'transaction_id' id = 'transaction_id'/></td><td><button value = 'Search' style = 'font-style:italic;' >Search</button></td></tr>";
echo "</table>";
if(isset($tran_id))
{
	$array_expenses = array();
	$query = mysqli_query($con,"select * from watak_expenses where watak_no = $tran_id");
	while($r = mysqli_fetch_array($query))
	{
		$watak_no = $r['watak_no'];
			//$array_expenses[$watak_no][expense_head] = $r['expense_head'];
			$expense_head = $r['expense_head'];
			$array_expenses[$expense_head] = $r['amount'];
			//$array_expenses[$watak_no][sno] = $r['sno'];
	}
$array_watak_detail = array();
	$query_new = mysqli_query($con,"select * from watak_detail where watak_no = $tran_id");
	while($r = mysqli_fetch_array($query_new))
	{
		$watak_no = $r['watak_no'];
		$array_watak_detail[$watak_no][date] = $r['date'];
		$array_watak_detail[$watak_no][marka] = $r['marka'];
		$array_watak_detail[$watak_no][challan_id] = $r['challan_id'];
		$array_watak_detail[$watak_no][party_name] = $r['party_name'];
		$array_watak_detail[$watak_no][truck] = $r['truck_no'];
	}
//	print_r($array_watak_detail);
$new_variable = "trading Expenses";	
//echo "<form action = 'backsearch_fruit_payment.php' method = 'get' onsubmit = 'return submit_item(this)'>";
echo "<input type = \"text\" name = \"tran_id\" style = 'display:none;' id = \"tran_id\"/>
<table style = 'width:100%;border-collapse:collapse;' border = \"0\">
	<tr><td style = 'width:240px;'>
	<input type = \"text\" style = \"display:none;\" name = \"ledger_id\" id = \"ledger_id\"/>
<table style = 'width:100%;border-collapse:collapse;' border = \"0\">
<tr><td><input id = 'date' style = 'width:100%' name = 'date' type = 'date' class = 'text-watak' value = \"".$array_watak_detail[$watak_no][date]."\"/></td></tr>
<tr><td><input id = 'marka' style = 'width:100%' name = 'marka' type = 'text' class = 'text-watak' placeholder = \"marka\" value  = '".$array_watak_detail[$watak_no][marka]."'/></td></tr>
<tr><td><span style = 'min-width:180px;height:28px;padding:5px 21px 5px 5px;'>Challan #</span><input style = 'width:60%;text-align:right;padding-right:5px;' id = 'challan' name = 'challan' class = 'text-watak' placeholder = \"challan / receipt\" value = '".$array_watak_detail[$watak_no][challan_id]."'/></td></tr>
<tr><td><span style = 'min-width:180px;height:28px;padding:5px 5px;'>Truck #</span><input style = 'width:72%;text-align:right;padding-right:5px;' id = 'truck' name = 'truck' class = 'text-watak' placeholder = \"truck no\" value = \"".$array_watak_detail[$watak_no][truck]."\"/></td></tr>
<tr><td><input name = 'party' style = 'width:100%' class = 'text-watak' placeholder = \"Party Name\" id = 'party' value = '".$array_watak_detail[$watak_no][party_name]."'/></td></tr>
<tr><td><span style = 'min-width:180px;height:28px;padding:5px 20px 5px 5px;'>Freight : </span><input style = 'width:61%;text-align:right;padding-right:5px;' id = 'freight' name = 'freight' class = 'text-watak' placeholder = \"freight per peti\" value = '".$array_expenses[freight]."' title = \"freight per peti\"/></td></tr>
<tr><td><span style = 'min-width:180px;height:28px;padding:5px 11px 5px 5px;'>Commission :</span><input style = 'width:51%;text-align:right;padding-right:5px;' id = 'comm' name = 'comm' class = 'text-watak' placeholder = \"commision in %\" title = \"commision in %\" value = '$array_expenses[commission]'/></td></tr>
<tr><td><span style = 'min-width:180px;height:28px;padding:5px 26px 5px 5px;'>Labour :</span><input style = 'width:60%;text-align:right;padding-right:5px;' id = 'labour' name = 'labour' class = 'text-watak' placeholder = \"labour / peti\" title = \"labour / peti\" value = '$array_expenses[Labour]'/></td></tr>
<tr><td><span style = 'min-width:180px;height:28px;padding:5px 22px 5px 5px;'>Postage :</span><input style = 'width:60%;text-align:right;padding-right:5px;' id = 'postage' name = 'postage' class = 'text-watak' placeholder = \"postage\" title  = \"postage\" value = '$array_expenses[postage]'/></td></tr>
<!--<tr><td><input name 'texp' class = 'text-watak' placeholder = \"trading exp / peti\" title = \"trading exp / peti\" value = \"$t_exp\"/></td></tr>-->

<tr><td><span style = 'min-width:180px;height:28px;padding:5px 1px 5px 5px;'>Association : </span><input style = 'width:56%;text-align:right;padding-right:5px;' id = 'ass' name = 'ass' class = 'text-watak' placeholder = \"association / peti\" title = \"association / peti\" value = '$array_expenses[association]'/></td></tr>";
echo "<tr><td><span style = 'min-width:180px;height:28px;padding:5px 0px 5px 5px;'>V. Expenses : </span><input style = 'width:55%;text-align:right;padding-right:5px;' id = 'texp' name = 'texp' class = 'text-watak' placeholder = \"V exp. / peti\" title = \"trading exp. / peti\" value = '$array_expenses[$new_variable]'/></td></tr>
<tr><td></td></tr>
</table>
</td>
<td style = 'text-align:top;'>
<table style = 'width:100%;border-collapse:collapse;' border = \"0\">
		<tr style = ''><td><input type = 'text' placeholder = 'Peti' oninput = \"lock_other('half')\" name = 'peti' id= 'peti' style = 'width:40px'/></td><td><input style = 'width:40px' type = 'text' id = 'half' oninput = 'lock_other(\"peti\")' placeholder= 'Half' name = 'half'/></td><td><input type = 'text' style = 'width:150px;' name = 'variety' id = 'variety' placeholder = 'Variety'/></td><td><input type = 'text' style = 'width:150px;' placeholder = 'grade / layer' id = 'quality' name= 'quality'/></td><td><input type = 'text' style = 'width:50px' placeholder = 'Rate' onkeyup = \"if(event.keyCode == 13) fill_amount()\" name = 'rate' id = 'rate' /></td><td><input name = 'amount' style = 'width:80px;' id = 'amount' type = 'text' disabled/></td></tr>
<!--		<tr style = 'color:brown;background:peachpuff;font-weight:bold;'><td >Peti</td><td>Half</td><td style = 'width:150px;'>Variety</td><td>Grade / layer</td><td>Rate</td><td style = 'width:50px;'>Amount</td></tr>-->
		<tr><td colspan = '5'></td><td id = \"button_tab\"><input onclick = \"fill_amount()\" type = 'button' value = \"add Items\"/></td></tr>
</table>
";
}
?>
<!--	<div style = "display:none;" id = "but_swap"><button onclick = "fill_amount() ">Add items</button></div>-->
	<div id= 'watak-pod'>
	</div>

</td>
</tr>
</table>

<div id = 'search_result'>

</div>
</div>
