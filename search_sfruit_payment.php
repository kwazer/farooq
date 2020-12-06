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
	echo "<option value = '".$row_ledger['ledger_name']." S/o ".$row_ledger['father_name']."' data-id = '".$row_ledger['ledger_id']."' id = '".$row_ledger['ledger_id']."'>".$row_ledger['ledger_tenure'].$row_ledger['ledger_id']."</option>";
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
echo "<tr><td><label style = 'font-size:18px;font-style:italic;'>Enter fruit payment serial</label></td><td><input onkeypress = 'update_query(this.value)' style = 'height:28px;width:100%;' type = 'text' name = 'transaction_id' id = 'transaction_id'/></td><td><button value = 'Search' style = 'font-style:italic;' >Search</button></td></tr>";
echo "</table>";
if(isset($tran_id))
{
//echo "<form action = 'backsearch_fruit_payment.php' method = 'get' onsubmit = 'return submit_item(this)'>";
	echo "<table style = 'width:100%;'>";
	echo "<th>Date</th><th>Party Name</th><th>Amount</th><th>Narration</th>";
$query_search = mysqli_query($con,"select * from daybook join ledgers using (ledger_id) where transaction_type = 13 and transaction_id = '$tran_id'");
while($r = mysqli_fetch_array($query_search))
{
	echo "<input type = 'text' value = '".$r['ledger_id']."' style = 'display:none;' id = 'ledger_id' name = 'ledger_id'/>";
	echo "<input type = 'text' value = '".$r['sno']."' style = 'display:none;' id = 'sno' name = 'sno'/>";
	echo "<tr><td><input type = 'date' value = '".$r['date']."' id = 'date' name = 'date'/></td><td style = 'width:400px;'><input style = 'width:100%;' list = 'exampleList' id = 'b_input' oninput = 'showb_value()' type = 'text' value = '".$r['ledger_name']."' name = 'ledger_name' /></td><td><input type = 'text' value = '".$r['amount']."' id = 'amount' name = 'amount'/></td><td><input type = 'text' value = '".$r['narration']."' name = 'narration' id ='narration' /></td><td><input type = 'button' value = 'save' onclick ='update_sfruit_payment()'/></td></tr>";
}
echo "</table>";
//echo "</form>";
}

?>
<div id = 'search_result'>

</div>
</div>
