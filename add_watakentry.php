<?php
session_start();
include 'con.php';

$query_ledger = mysqli_query($con,"select * from ledgers join ledger_details using (ledger_id) where ledger_type = 6");
echo "<datalist id = 'sundry_fruit'>";
while($row_ledger = mysqli_fetch_array($query_ledger))
{
	echo "<option value = '".$row_ledger['ledger_name']." S/o ".$row_ledger['father_name']." R/O ".$row_ledger['address']."' data-id = '".$row_ledger['ledger_id']."' id = '".$row_ledger['ledger_id']."'>".$row_ledger['ledger_id']."</option>";

}
echo "</datalist>";

$major_id = "";
$tran_id = $_GET["tran_id"];

$query_major = mysqli_query($con,"select ledger_id,ledger_name from daybook join ledgers using (ledger_id) where transaction_id = '$tran_id' and transaction_type = '9'");
while($rm = mysqli_fetch_array($query_major))
{
//	echo $rm['ledger_id'];
	$major_id = $rm['ledger_id'];
	$major_name = $rm['ledger_name'];
}

//echo $major_id;
$query = mysqli_query($con,"select *,daybook.ledger_id as major_id from daybook join watak_detail on watak_detail.watak_no = daybook.transaction_id where transaction_id = '$tran_id' and transaction_type = '9'");
echo "<h4><button onclick = 'location.href =\"printwatak.php?tran_id=$tran_id\"' style= 'height:28px;padding:0px 5px;font-weight:bold;letter-spacing:1px;background:lightgreen;'>Print</button>";
if($major_id == "")
echo "<span style = 'float:right;'><label style = 'margin-left:12px;font-weight:normal;font-size:17px;'>Transfer to ledger</label><input style = 'margin-left:12px;width:400px;height:28px;padding:5px;' id = 'sundry_fruit_input' placeholder = 'Enter Ledger-name here' type = 'text' list = 'sundry_fruit' oninput  = 'showsf_value();'/><button onclick = 'sub_button()' style ='height:28px;'>Submit to ledger</button></span></h4>";
else
{
if($_SESSION["id"] == "1")
echo "<span style = 'float:right;'><label style = 'margin-left:12px;font-weight:normal;font-size:17px;'>Transfer to ledger</label><input style = 'margin-left:12px;width:400px;height:28px;padding:5px;' id = 'sundry_fruit_input' placeholder = 'Enter Ledger-name here' type = 'text' list = 'sundry_fruit' value = '".$major_name."' oninput  = 'showsf_value();'/><button onclick = 'sub_button()' style ='height:28px;'>Submit to ledger</button></span></h4>";
else
echo "<span style = 'float:right;'><label style = 'margin-left:12px;font-weight:normal;font-size:17px;'>Transfer to ledger</label><input style = 'margin-left:12px;width:400px;height:28px;padding:5px;' disabled id = 'sundry_fruit_input' placeholder = 'Enter Ledger-name here' type = 'text' list = 'sundry_fruit' value = '".$major_name."' oninput  = 'showsf_value();'/><button onclick = '' style ='height:28px;'>Submit to ledger</button></span></h4>";
}
echo "<table style = 'width:100%;border-collapse:collapse;' border = '1'>";
echo "<tr style = 'background:peachpuff;color:brown;font-weight:bold;'><td>Date</td><td>Ch. #</td><td style ='width:120px;'>Marka</td><td>Watak</td><td>P</td><td>H</td><td>Gross</td><td>Expenses</td><td>Net</td></tr>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr style = 'color:blue;' onclick = 'add_watak_entry(".$row['transaction_id'].")'><td>".$row['date']."</td><td>".$row['challan_id']."</td><td>".$row['marka']."</td><td>".$row['transaction_id']."</td><td>".$row['peti']."</td><td>".$row['dabba']."</td><td>".$row['gross']."</td><td>".$row['expenses']."</td><td>".$row['net_amount']."</td></tr>";
}
echo "</table>";

?>

<table style = 'width:100%;border-collapse:collapse;' border = "1">
	<tr><td>P</td><td>H</td><td>variety</td><td>Grade / Layer</td><td>Rate</td><td>Amount</td></tr>
<tr>
<td><input name = 'peti' style = "width:50px;" id = "peti" type = "text"/></td><td><input name = 'peti' style = "width:50px;" id = "peti" type = "text"/></td><td><input name = 'dabba' style = "width:50px;" id = "dabba" type = "text"/></td><td><input type = "text" style = 'width:100%;' id = "kind"/></td><td><input type = "text" id = "gross" style = 'width:80px;'/></td><td><input style = "width:80px;" type = "text" id = "net" onkeypress = "if(event.keyCode == 13)submit_marka(<?php echo $tran_id;?>)"/></td></tr>
<tr><td colspan = "6" style = 'text-align:right;margin-right:40px;'><button onclick = "submit_marka(<?php echo $tran_id;?>)">Submit</button></td></tr>
<!--</table>
<table style = 'width:100%;border-collapse:collapse;' border = '1'>-->
		<tr style = 'background:peachpuff;'><th>P</th><th>H</th><th>Variety</th><th>Grade / Layer</th><th>Rate</th><th>Amount</th></tr>
<?php

$query_list = mysqli_query($con,"select * from watak_items where watak_no = $tran_id order by sno desc");
while($row = mysqli_fetch_array($query_list))
{
	echo "<tr><td>".$row['peti']."</td><td>".$row['dabba']."</td><td>".$row['variety']."</td><td>".$row['quality']."</td><td>".$row['rate']."</td><td>".$row['amount']."</td></tr>";
}
echo "<tr style = 'font-weight:bold;'><td font-size:19px;font-weight:bold;>Total</td><td>$tot_peti</td><td>$tot_half</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_gross)."</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_exp)."</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_net)."</td></tr>";
?>
</table>
