<?php
session_start();
include 'con.php';
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];

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
	.list_hover:hover
	{
		background:blue;
	}
	
</style>
<script>
	
//function del()
//{
//	location.href = 'deleteitem.php?item_id='+item_id;
//}

</script>
<div id = "main-window" style = "width:700px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
/*$array_ledger = array();

$query_ledger = mysqli_query($con,"select * from ledgers where ledger_type between 3 and 4");
while($row_ledger = mysqli_fetch_array($query_ledger))
{
	$array_ledger[] = $row_ledger;
}
//print_r($array_ledger);
*/
?>
<!--<ul style = 'list-style:none;display:block;background:black;color:ivory;padding:4px;font-size:13px;'>
	<li style = 'display:inline;border:1px solid black;padding:3px 8px;margin:0px;' class = 'list_hover'>By Barcode</li>
	<li style = 'display:inline;border:1px solid black;padding:3px 8px;margin:0px;' class = 'list_hover'>By Name</li>
</ul>-->
<?php

//{
//echo "<form action = \"back".$ledger_type.".php\" method = \"post\" onsubmit = \"if(event.keyCode == 13){return false;} else{return submit_sale(this);}\">";
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type." Report</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='daybook.php';\">Back</span><br><hr>";
$query_se = mysqli_query($con,"select * From daybook join ledgers on ledgers.ledger_id = daybook.ledger_id where transaction_type = '$sno' and date = CURDATE() order by transaction_id ");
echo "<table style = 'width:100%;' id = 'view_table'>";
echo "<th>date</th><th>serial #</th><th>Party Name</th><th>Amount</th>";
while($row_se = mysqli_fetch_array($query_se))
{
	echo "<tr onclick = 'insert_details(this.rowIndex,".$row_se['transaction_id'].");'><td>".$row_se['date']."</td><td>".$row_se['transaction_id']."</td><td>".$row_se['ledger_name']."</td><td>".$row_se['amount']."</td></tr>";
}

//echo "</form>";
//}
?>
</table>
</div>
