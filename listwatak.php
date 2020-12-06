<?php
include 'con.php';
$array_fruit = array();
$query_sfruit = mysqli_query($con,"select ledger_id,ledger_name from ledgers where ledger_type = 6");
while($r = mysqli_fetch_array($query_sfruit))
{
	$ledg_id = $r['ledger_id'];
	$array_fruit[$ledg_id] = $r['ledger_name'];
}
$tran_id;
$query = mysqli_query($con,"select *,daybook.ledger_id as major_id from daybook join watak_detail on watak_detail.watak_no = daybook.transaction_id where transaction_type = 9 order by daybook.transaction_id desc");
//echo "<button>Print</button";
echo "<table style = 'width:100%;border-collapse:collapse;' border = '1'>";
echo "<tr style = 'background:peachpuff;color:brown;font-weight:bold;'><td>Date</td><td>Ch. #</td><td style = 'width:120px;'>Marka</td><td style = 'width:50px;'>Watak</td><td>P</td><td>H</td><td>Gross</td><td>Expenses</td><td>Net</td><td>Actions</td></tr>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr style = 'color:blue;' onclick = 'add_watak_entry(".$row['transaction_id'].")'><td>".$row['date']."</td><td>".$row['challan_id']."</td><td style = 'text-align:left;'>".$row['marka']."</td><td>".$row['transaction_id']."</td><td>".$row['peti']."</td><td>".$row['dabba']."</td><td>".$row['gross']."</td><td><div class = 'tooltip'>".$row['expenses']."<span class = 'tooltiptext' id = 'tool".$row['sno']."'>";

	echo "<table style = 'width:80%;'>";
//echo "<tr><th>Date</th><th>Qty</th></tr>";
//foreach($array_purchase[$new_mat_id] as $express_id)
//{
//	echo "<tr><td>".$express_id[date]."</td><td>".$express_id[qty]."</td></tr>";
//}
echo "</table>";
$new_led = $row['major_id'];
//if()
	echo "</span></div></td><td>".$row['net_amount']."</td><td><input type='text' value = '".$array_fruit[$new_led]."' name = 'ledger_input'"; echo " disabled style = 'height:28px;width:100%;'/></td></tr>";
}
echo "</table>";
?>

</div>
