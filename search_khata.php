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
tr.border-bottom td
{
border-top: 1px solid red;
}
.heading_element
{
text-align:center;
}
.left-text
{
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
	echo "<option value = '".$row_ledger['ledger_name']."' data-id = '".$row_ledger['ledger_id']."' id = '".$row_ledger['ledger_id']."'>".$row_ledger['ledger_tenure'].$row_ledger['ledger_id']."</option>";
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
echo "<tr><td><label style = 'font-size:18px;font-style:italic;'>Enter Details</label></td><td><input onkeypress = 'update_query(this.value)' style = 'height:28px;width:100%;' type = 'text' name = 'transaction_id' id = 'transaction_id'/></td><td><button value = 'Search' style = 'font-style:italic;' >Search</button></td></tr>";
echo "</table>";
if(isset($tran_id))
{
//echo "<form action = 'backsearch_fruit_payment.php' method = 'get' onsubmit = 'return submit_item(this)'>";
	echo "<table style = 'width:100%;'>";
	$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from goods_receipt_detail where khata LIKE '%$tran_id%'");
	echo "<th>Date</th><th>Khata</th><th>Serial Id</th><th>Peti</th><th>Dabba</th><th>Variety</th><th>Quality</th><th>Rate</th><th>Amount</th>";
$prev = 0;
	while($row = mysqli_fetch_array($query))
	{

		if($row['bill_no'] != $prev)
		echo "<tr class = 'border-bottom'>";
else
echo "<tr style = ''>";
echo "<td>".$row['date']."</td><td>".$row['khata']."</td><td>".$row['bill_no']."</td><td>".$row['peti']."</td><td>".$row['dabba']."</td><td>".$row['variety']."</td><td>".$row['quality']."</td><td>".$row['rate']."</td><td>".$row['amount']."</td><td>".$row['station']."</td></tr>";
		$prev = $row['bill_no'];
	}
	
echo "</table>";
echo "<h2 class = 'heading_element'>Mandi Watak</h2>";
echo "<table style = 'width:100%;'>";
$prev = 0;
echo "<th class = ''>Date</th><th class = 'left-text'>Marka</th><th class = 'left-text'>Party Name</th><th class = 'left-text'>Watak No</th>";
$query2=mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from watak_detail where marka LIKE '%$tran_id%' or party_name LIKE '%$tran_id%'");
while($r = mysqli_fetch_array($query2))
{
         echo "<tr><td>".$r['date']."</td><td class = 'left-text'>".$r['marka']."</td><td class = 'left-text'>".$r['party_name']."</td><td class = 'left-text'>".$r['watak_no']."</td></tr>";
}
echo "</table>";

echo "</table>";
echo "<h2 class = 'heading_element' style = 'letter-spacing:2px;'>Challan</h2>";
echo "<table style = 'width:100%;'>";
$prev = 0;
echo "<th class = ''>Date</th><th class = 'left-text'>Marka</th><th class = 'left-text'>Party Name</th><th class = 'left-text'>challan ID </th>";
$query3=mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from challan_detail join ledgers using (ledger_id) where marka LIKE '%$tran_id%'");
while($r = mysqli_fetch_array($query3))
{
         echo "<tr><td>".$r['date']."</td><td class = 'left-text'>".$r['marka']."</td><td class = 'left-text'>".$r['ledger_name']."</td><td class = 'left-text'>".$r['challan_id']."</td></tr>";
}
echo "</table>";

//echo "</form>";
}

?>
<div id = 'search_result'>

</div>
</div>
