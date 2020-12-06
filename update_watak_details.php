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
$watak_no = $_REQUEST["watak_no"];
$peti = $_REQUEST["peti"];
$type = $_REQUEST["type"];
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
if($type == 2)
$query = mysqli_query($con,"insert into watak_items(watak_no,peti,dabba,variety,quality,rate,amount) values('$watak_no','$peti','$half','$variety','$quality','$rate','$total_amount')");//$query_list = mysqli_query($con,"insert into watak_items(peti,dabba,watak_no,variety,quality,rate,amount) values('$peti','$half','$tran_id','$variety','$quality','$rate','$total_amount')");
//if($query)
//$query_update = mysqli_query($con,"update");
$query_list = mysqli_query($con,"select * from watak_items where watak_no = $watak_no");
while($row = mysqli_fetch_array($query_list))
{
	$sno = $row['sno'];
	echo "<tr><td><input style = 'width:40px;' type = 'text'  id = 'peti$sno' value = '".$row['peti']."'/></td><td><input type = 'text' style = 'width:40px;' value = '".$row['dabba']."' id = 'half".$row['sno']."'/></td><td><input type = 'text' style = 'width:100px;' value ='".$row['variety']."' id = 'variety".$row['sno']."'/></td><td><input type = 'text' style = 'width:100px;' value = '".$row['quality']."' id = 'quality".$row['sno']."'/></td><td><input type = 'text' value = '".$row['rate']."' style = 'width:50px;' id = 'rate".$row['sno']."'/></td><td><input type = 'text' style = 'width:80px;' value = '".$row['amount']."' id = 'amount".$row['sno']."'/><button style = 'margin-left:5px;' onclick = 'update_table_details(".$row['sno'].")'>Save</button><button style = 'background:red;border-radius:5px;border:0px;margin-left:3px;color:white;height:22px;width:30px;' onclick = 'delete_table_details(".$row['sno'].")'>X</button></td></tr>";
	$tot_peti = $tot_peti + $row['peti'];
	$tot_half = $tot_half +$row['dabba'];
	$tot_amount = $tot_amount + $row['amount'];
}
echo "<tr style = 'font-weight:bold;'><td>$tot_peti</td><td>$tot_half</td><td colspan = '3'></td><td>".sprintf("%.2f",$tot_amount)."</td></tr>";
//echo "<tr><td colspan = '6'><button style = 'border:1px solid grey;background:lightgreen;' onclick = 'save_watak_details()'>Save Changes</button></td></tr>";
//echo "<tr style = 'font-weight:bold;'><td font-size:19px;font-weight:bold;>Total</td><td>$tot_peti</td><td>$tot_half</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_gross)."</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_exp)."</td><td style = 'text-align:right;'>".sprintf("%.2f", $tot_net)."</td></tr>";
//$query_update_gross = mysqli_query($con,"update watak_detail set gross = gross + $total_amount where watak_no = '$tran_id'");
//$query_update_expenses = mysqli_query($con,"update watak_detail set expenses = expenses + (select sum(amount) from watak_expenses where watak_no = \"".$tran_id."\") where watak_no = '$tran_id'");
//$query_update_net = mysqli_query($con,"update watak_detail set net_amount = (gross - (select sum(amount) from watak_expenses where watak_no = \"".$tran_id."\")) where watak_no = '$tran_id'");

?>
</table>
