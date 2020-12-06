<?php
include 'con.php';
/*
$peti = $_REQUEST["peti"];
$half = $_REQUEST["half"];
$variety = $_REQUEST["variety"];
$quality = $_REQUEST["quality"];
$rate = $_REQUEST["rate"];
$amount = $_REQUEST["amount"];
* */
$peti = $_REQUEST["peti"];
$half = $_REQUEST["half"];
$variety = $_REQUEST["variety"];
$quality = $_REQUEST["quality"];
$rate = $_REQUEST["rate"];
$total_amount= $_REQUEST["amount"];
//echo $peti." ".$half." ".$variety." ".$quality." ".$rate." ".$total_amount." ";
//$tran_id = $_REQUEST["tran_id"];

?>
<table style = 'width:100%;border-collapse:collapse;' border = "1">

		<tr style = 'background:peachpuff;'><th>P</th><th>H</th><th>Variety</th><th>Grade / Layer</th><th>Rate</th><th>Amount</th></tr>
<?php
$query = mysqli_query($con,"insert into watak_buffer(peti,dabba,variety,quality,rate,amount) values('$peti','$half','$variety','$quality','$rate','$total_amount')");//$query_list = mysqli_query($con,"insert into watak_items(peti,dabba,watak_no,variety,quality,rate,amount) values('$peti','$half','$tran_id','$variety','$quality','$rate','$total_amount')");

$query_list = mysqli_query($con,"select * from watak_buffer");
while($row = mysqli_fetch_array($query_list))
{
	echo "<tr><td>".$row['peti']."</td><td>".$row['dabba']."</td><td>".$row['variety']."</td><td>".$row['quality']."</td><td>".$row['rate']."</td><td>".$row['amount']."</td></tr>";
	$tot_peti = $tot_peti + $row['peti'];
	$tot_half = $tot_half +$row['dabba'];
	$tot_amount = $tot_amount + $row['amount'];
}
echo "<tr style = 'font-weight:bold;'><td>$tot_peti</td><td>$tot_half</td><td colspan = '3'></td><td>".sprintf("%.2f",$tot_amount)."</td></tr>";
echo "<tr><td colspan = '6'><button style = 'border:1px solid grey;background:lightgreen;' onclick = 'submit_watak()'>Submit Watak</button></td></tr>";
//echo "<tr style = 'font-weight:bold;'><td font-size:19px;font-weight:bold;>Total</td><td>$tot_peti</td><td>$tot_half</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_gross)."</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_exp)."</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_net)."</td></tr>";
//$query_update_gross = mysqli_query($con,"update watak_detail set gross = gross + $total_amount where watak_no = '$tran_id'");
//$query_update_expenses = mysqli_query($con,"update watak_detail set expenses = expenses + (select sum(amount) from watak_expenses where watak_no = \"".$tran_id."\") where watak_no = '$tran_id'");
//$query_update_net = mysqli_query($con,"update watak_detail set net_amount = (gross - (select sum(amount) from watak_expenses where watak_no = \"".$tran_id."\")) where watak_no = '$tran_id'");

?>
</table>
