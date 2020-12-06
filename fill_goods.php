<?php 
$tr_type = $_GET["tr_type"];
$year = $_GET["year"];
$led_id = $_GET["led_id"];
//echo $tr_type." ".$year." ".$led_id;
include 'con.php';
$gr_tot = 0;
//if($tr_type == 9)
//{
	$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from goods_receipt_detail where ledger_id = $led_id and year(date) = '$year'");

$tot_exp = 0;
$tot_net = 0;
$tot_gross = 0;
$tot_peti = 0;
echo "<p style = 'text-align:left;'><button onclick = 'document.getElementById(\"baardana_detail\").innerHTML=\"\";' style = 'background-color:lightgreen;'>Close Page</button>";
echo "<span style = 'float:right;'><button onclick = 'location.href = \"fill_goods.php?tr_type=$tr_type&year=$year&led_id=$led_id\"' style = 'background-color:lightgreen;'>Print</button></span></p>";
echo "<table style = 'width:100%;background:white;'>";
echo "<tr style = 'padding:2px;'><th>Date</th><th>GR No</th><th>Marka</th><th>Peti</th><th>Half</th><th style = ''>Khata</th><th style = ''>Variety</th><th style = ''>Qlty</th><th>Rate</th><th>Amount</th></tr>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr style = 'padding:2px;'><td>".$row['date']."</td><td>".$row['bill_no']."</td><td>".$row['marka']."</td><td>".$row['peti']."</td><td >".$row['dabba']."</td><td style = ''>".$row['khata']."</td><td style = ''>".$row['variety']."</td><td style = ''>".$row['quality']."</td><td>".$row['rate']."</td><td>".$row['amount']."</td></tr>";
	//$gr_tot = $gr_tot + $row['g_amount'];
//$tot_exp = $tot_exp + $row['expenses'];
//$tot_gross = $tot_gross + $row['gross'];
//$tot_net = $tot_net + $row['net_amount'];
//$tot_peti =$tot_peti + $row['peti'];
//$tot_dabba = $tot_dabba + $row['dabba'];
}
//echo "<tr><td colspan = '2' style = 'color:red;font-weight:bold;'>Total</td><td style = 'color:red;font-weight:bold;'>".sprintf("%.0f",$tot_peti)."</td><td style = 'color:red;font-weight:bold;'>".sprintf("%.0f",$tot_dabba)."</td><td style = 'color:red;font-weight:bold;text-align:right;'>".sprintf("%.2f",$tot_gross)."</td><td style = 'color:red;font-weight:bold;text-align:right;'>".sprintf("%.2f",$tot_exp)."</td><td style = 'color:red;font-weight:bold;text-align:right;'>".sprintf("%.2f",$tot_net)."</td></tr>";
echo "</table>";

//}
/*
else
{
	
$tot_exp = 0;
$tot_net = 0;
$tot_gross = 0;
$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from challan_detail where ledger_id = $led_id and year(date) = '$year'");

echo "<p style = 'text-align:left;'><button onclick = 'document.getElementById(\"baardana_detail\").innerHTML=\"\";' style = 'background-color:lightgreen;'>Close Page</button>";
echo "<span style = 'float:right;'><button onclick = 'location.href = \"watakk_detail.php?tr_type=$tr_type&year=$year&led_id=$led_id\"' style = 'background:lightgreen;'>Print</button></span></p>";
echo "<table style = 'width:100%;background:white;'>";
echo "<tr style = 'padding:2px;'><th>Date</th><th>Challan</th><th>Marka</th><th>Peti</th><th>Half</th><th style = 'text-align:right;'>Gross</th><th style = 'text-align:right;'>Expense</th><th style = 'text-align:right;'>Net</th></tr>";
while($row = mysqli_fetch_array($query))
{
	$tot_exp = $tot_exp + $row['expenses'];
$tot_gross = $tot_gross + $row['gross'];
$tot_net = $tot_net + $row['net'];
$tot_peti =$tot_peti + $row['peti'];
$tot_dabba = $tot_dabba + $row['dabba'];
	echo "<tr style = 'padding:2px;'><td>".$row['date']."</td><td>".$row['challan_id']."</td><td>".$row['marka']."</td><td>".$row['peti']."</td><td >".$row['dabba']."</td><td style = 'text-align:right;'>".$row['gross']."</td><td style = 'text-align:right;'>".$row['expenses']."</td><td style = 'text-align:right;'>".$row['net']."</td></tr>";
	//$gr_tot = $gr_tot + $row['g_amount'];
}
echo "<tr><td colspan = '3' style = 'color:red;font-weight:bold;'>Total</td><td style = 'color:red;font-weight:bold;'>".sprintf("%.0f",$tot_peti)."</td><td style = 'color:red;font-weight:bold;'>".sprintf("%.0f",$tot_dabba)."</td><td style = 'color:red;font-weight:bold;text-align:right;'>".sprintf("%.2f",$tot_gross)."</td><td style = 'color:red;font-weight:bold;text-align:right;'>".sprintf("%.2f",$tot_exp)."</td><td style = 'color:red;font-weight:bold;text-align:right;'>".sprintf("%.2f",$tot_net)."</td></tr>";

//echo "<tr><td colspan = '4' style = 'color:red;font-weight:bold;'>Total</td><td style = 'color:red;font-weight:bold;text-align:right;'>".sprintf("%.2f",$gr_tot)."</td></tr>";
echo "</table>";
}
*/
?>
