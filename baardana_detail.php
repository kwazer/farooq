<?php
$tr_type = $_GET["tr_type"];
$year = $_GET["year"];
$led_id = $_GET["led_id"];
//echo $tr_type." ".$year." ".$led_id;
include 'con.php';

//$query_particulars = mysqli_query($con,"select * from items where ");

$array_group = array();
$gr_tot = 0;
$query = mysqli_query($con,"select *,baardana_detail.amount as g_amount,DATE_FORMAT(daybook.date,'%d-%m-%Y') as date from baardana_detail join items on items.item_id = baardana_detail.uid join daybook on daybook.transaction_id = baardana_detail.bill_id where year(daybook.date) = '$year' and transaction_type = '$tr_type' and ledger_id = '$led_id'");
echo "<p style = 'text-align:left;'><button onclick = 'document.getElementById(\"baardana_detail\").innerHTML=\"\";' style = 'background-color:lightgreen;'>Close Page</button>";
echo "<span style = 'float:right;'><button onclick = 'location.href = \"baardana_detail.php?tr_type=$tr_type&year=$year&led_id=$led_id\"' style = 'background-color:lightgreen;'>Print</button></span></p>";
echo "<table style = 'width:100%;background:white;'>";
echo "<tr><th>Date</th><th>#ID</th><th  style = 'text-align:left;width:200px;'>Item name</th><th  style = 'text-align:left;width:250px;'>Folio head</th><th  style = 'text-align:left;'>Qty</th><th>Price</th><th style = 'text-align:right;'>Amount</th></tr>";
while($row = mysqli_fetch_array($query))
{

	echo "<tr><td>".$row['date']."</td><td>".$row['bill_id']."</td><td style = 'text-align:left;'>".$row['name']."</td><td style = 'font-size:12px;text-align:left;'>".$row['narration']."</td><td  style = 'text-align:left;'>".$row['qty']." ".$row['unit']."</td><td>".$row['price']."</td><td style = 'text-align:right;'>".$row['g_amount']."</td></tr>";
	$gr_tot = $gr_tot + $row['g_amount'];
}
echo "<tr><td colspan = '6' style = 'color:red;font-weight:bold;'>Total</td><td style = 'color:red;font-weight:bold;text-align:right;'>".sprintf("%.2f",$gr_tot)."</td></tr>";
echo "</table>";

$pr_tot = 0;
$query_grp = mysqli_query($con,"select *,sum(qty) as qty,sum(baardana_detail.amount) as g_amount,DATE_FORMAT(daybook.date,'%d-%m-%Y') as date from baardana_detail join items on items.item_id = baardana_detail.uid join daybook on daybook.transaction_id = baardana_detail.bill_id where year(daybook.date) = '$year' and transaction_type = '$tr_type' and ledger_id = '$led_id' group by uid");
echo "<table style = 'width:100%;background:white;'>";
echo "<tr>";
while($row = mysqli_fetch_array($query_grp))
{
	if($row['unit'] == 'H' or $row['unit'] == 'P')
	echo "<td><span style = 'color:brown;'>".$row['name']."</span><br>".sprintf("%.0f",$row['qty'])." ".$row['unit']."</td>";
	else
	echo "<td><span style = 'color:brown;'>".$row['name']."</span><br>".$row['qty']." ".$row['unit']."</td>";
//	echo "<tr><td>".$row['date']."</td><td>".$row['name']."</td><td>".$row['qty']." ".$row['unit']."</td><td>".$row['price']."</td><td style = 'text-align:right;'>".$row['g_amount']."</td></tr>";
	$pr_tot = $pr_tot + $row['g_amount'];
}
echo "</tr>";
//echo "<tr><td colspan = '4' style = 'color:red;font-weight:bold;'>Total</td><td style = 'color:red;font-weight:bold;text-align:right;'>".sprintf("%.2f",$pr_tot)."</td></tr>";
echo "</table>";
?>
