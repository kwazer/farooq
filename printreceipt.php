<style>
	td,th
	{
		border-bottom-style:solid;
		border-width:1px;
		border-left-style:solid;

	}
	th
	{
		text-align:left;
		background:peachpuff;
	}
	table
	{
		//border-right-style:none;
	}
	.center_text
	{
		text-align:center;
		background:peachpuff;
	}
	#expense_table td,#item_table td,#gr_table td,#gr_qty td
	{
		border:none;
	}
</style>
<?php
error_reporting("E_ERROR");
$bill_no = $_REQUEST["tran_id"];
$con = mysqli_connect("localhost","root","password","farooq");
//echo $con;
echo "<div style = 'margin:0 auto;'>";
echo "<div style = 'margin:0 auto;width:450px;border:1px solid grey;'>";
echo "<table style = 'width:100%;border-collapse:collapse;' border ='0' >";
//if($bill_no != NULL)
//{
//echo $bill_no;
/*
$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from watak_detail where watak_no = '$bill_no'");
while($r = mysqli_fetch_array($query))
{
	//echo $r['sno'];
	$pname = $r['party_name '];
	$marka = $r['marka'];
	$challan = $r['challan_id'];
	$truck = $r['truck_no'];
	$date = $r['date'];
	$new_name = $r['party_name'];

}

$query_expenses = mysqli_query($con,"select * from watak_expenses where watak_no = '$bill_no'");
while($row = mysqli_fetch_array($query_expenses))
{
	if($row['expense_head'] == 'freight')
	$freight = $row['amount'];
	if($row['expense_head'] == 'commission')
	$commission = $row['amount'];
	if($row['expense_head'] == 'Labour')
	$labour = $row['amount'];
	if($row['expense_head'] == 'postage')
	$postage = $row['amount'];
	if($row['expense_head'] == 'association')
	$ass = $row['amount'];
	if($row['expense_head'] == 'trading Expenses')
	$v_exp= $row['amount'];
	$tot_exp = $row['amount'] + $tot_exp;
}
* */
//$query_daybook = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook join ledgers using (ledger_id) left join goods_details on goods_details.tran_id = daybook.transaction_id where transaction_type = 16 and transaction_id= $bill_no");
//$query_daybook = mysqli_query("select *,DATE_FORMAT(daybook.date,'%d-%m-%Y') as new_date from goods_details left join daybook on daybook.transaction_id = goods_details.tran_id where transaction_type = 16 and transaction_id = $bill_no");
$query_daybook = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as nre from goods_details left join daybook on daybook.transaction_id = goods_details.tran_id where transaction_type = 16 and transaction_id = $bill_no");
while($r = mysqli_fetch_array($query_daybook))
{
//echo $r['date'];
//echo $r['new_date'];
	$date = $r['date'];
	$p_name = $r['ledger_name'];
	$truck = $r['narration'];
	$station = $r['station_from'];
	$status = $r['status'];
//	echo $r['ledger_name'];
}
//}
//$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook join sale_ledgers using(sno) where transaction_type = 2 and transaction_id = $bill_no");
//else
//$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook join sale_ledgers using(sno) where transaction_type = 2 order by transaction_id desc limit 1");
//while($row = mysqli_fetch_array($query))
//{
//	$ledger_name = $row['ledger_name'];
//	$amount = $row['amount'];
//	$date = $row['date'];
//	$bill_no = $row['transaction_id'];
//	$address = $row['address'];
//	$phone_no = $row['phone_no'];
//}
echo "<tr style = 'text-align:center;'><td colspan = '7' style = 'border:1px solid black;text-align:center;width:100%;color:black;'><span  style = 'float:right;color:black;font-weight:normal;font-size:12px;'><h4>T : 01951-254400<br>C: 919797274400<br>C: 919419434400<br>C: 919018184400</h4></span><h2 ><span style = 'font-family:Copperplate,Copperplate Gothic Light,fantasy;letter-spacing:1px;' onclick = 'location.href = \"transactions.php\"'>FAROOQ FRUIT CO.</span><br> <span style = 'font-size:15px;color:black;font-weight:normal;'><span style = 'color:black;padding:1px 4px;font-weight:bold;font-style:italic;border-radius:5px;'>Fruit Grower Commission & Forwarding Agents </span><br>55,56 Fruit & Vegetable Market<br>Zaloosa Charari-Sharief, Kashmir - 191112</span></h2></td></tr>";
echo "<tr><td colspan = '7' style = 'text-align:center;letter-spacing:1px;font-weight:bold;'>Receipt # $bill_no</td></tr>";
/*
echo "<tr><td colspan = '6'>Watak / Sale # <span style = 'color:navy;font-weight:bold;'>$bill_no</span></td><td colspan = '1'>Challan # <span style = 'color:navy;font-weight:bold;'>$challan</span></td></tr>";
echo "<tr><td colspan = '6'>Name : <span style = 'color:navy;font-weight:bold;'>".$p_name."</span></td><td colspan = '1'>Truck # <span style = 'color:navy;text-transform:uppercase;font-weight:bold;'>$truck</span></td></tr>";
echo "<tr><td colspan = '6'>Marka : <span style = 'color:navy;font-weight:bold;'>".$marka."</span></td><td colspan = '1'>Receipt # </td></tr>";
*/
echo "<tr><td colspan = '4'>Date :<span style = 'color:black;font-weight:bold;'>".$date."</span></td><td colspan = '3'>Status : ";
if($status == false)
echo "<span style = 'color:red;font-weight:bold;'>UNPAID</span>";
else
echo "<span style = 'color:red;font-weight:bold;'>PAID</span>";
echo "</td></tr>";
echo "<tr><td colspan = '4'>Name : <span style = 'color:black;font-weight:bold;text-transform:capitalize;'>".$p_name."</span></td><td colspan = 3>Truck No : <span style = 'color:black;'>$truck</span></td></tr>";
echo "<tr><td colspan = '4'>Folio : <span style = 'color:black;font-weight:bold;'></span></td><td colspan = '3'>Station : <span style = 'color:black;'>$station</span></td></tr>";
echo "</td></tr>";




echo "<tr><td class = 'center_text' style = 'width:100px;'>Khata</td><td class = 'center_text' style = 'text-align:center;'>P</td><td class = 'center_text'>H</td><td class = 'center_text' style = 'font-size:15px;'>Kind</td><td class = 'center_text'>Grade/Lyr</td><td class = 'center_text' style = 'text-align:center;width:60px;'>Freight</td><td class = 'center_text' style = ''>Amount</td></tr>";

echo "<tr><td colspan = 7 style ='height:300px;vertical-align:top;'>";
echo "<table style = 'width:100%;border:none;font-size:13px;' id = 'item_table'>";
$query = mysqli_query($con,"select * from goods_receipt_detail where bill_no = '".$bill_no."'");
$sum = 0;
while($row_item = mysqli_fetch_array($query))
{
	//echo $row['peti'];
	echo "<tr style = 'font-size:14px;'><td style = 'text-align:left;width:125px;'>".$row_item["khata"]."</td><td style = 'text-align:left;'>".$row_item["peti"]."</td><td style = 'text-align:left;'>".$row_item['dabba']."</td><td style = 'text-align:left;font-size:12px;'>".$row_item['variety']."</td><td style = 'text-align:center;margin-left:5px;font-size:12px;width:100px;'>".$row_item['quality']."</td><td style = 'text-align:right;'>".$row_item['rate']."</td><td style = 'text-align:right;'>".$row_item['amount']."</td>";
	echo "</tr>";
	$tot_peti = $tot_peti + $row_item['peti'];
	$tot_dabba = $tot_dabba + $row_item['dabba'];
	$tot_amount = $tot_amount + $row_item['amount'];
}
echo "</table>";
echo "</td>";

//echo "<td style = 'vertical-align:top;'>";
//	echo "<table id = 'expense_table' cell-spacing = '0' cell-padding = '0' border = \"0\" style = 'font-size:13px;border-collapse:collapse;border:none;width:100%;'><tr><td>Freight:</td><td style = 'text-align:right;'> $freight</td></tr><tr><td>Comxn: </td><td style = 'text-align:right;'>$commission</></td></tr><tr><td>Labour</td><td style = 'text-align:right;'> $labour</td></tr><tr><td>Postage</td><td style = 'text-align:right;'> $postage</td></tr><tr><td>Assoc.</td><td style = 'text-align:right;'> $ass</td></tr><tr><td>V. Exp</td><td style = 'text-align:right;'> $v_exp</td></tr></table>";

//echo "</td>";

echo "</tr>";
echo "<tr style = 'font-weight:bold;color:black;'><td></td><td style = 'text-align:right;'>$tot_peti</td><td style = 'text-align:right;'>$tot_dabba</td><td colspan = '3' style = 'text-align:center;'>Total</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_amount)."</td></tr>";
echo "<tr><td colspan = '7'>";

echo "<table style = 'width:100%;' id = 'gr_qty'>";
echo "<tr><td>Total Peti : $tot_peti<br>Total Half : $tot_dabba</td><td>";
echo "<table style = 'width:100%;border:1px solid grey;' id = 'gr_table'>";
echo "<tr><td>Total Amount</td><td style='text-align:right;'>".sprintf("%.2f",$tot_amount)."</td></tr>";
//echo "<tr><td>Gr Total</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_amount)."</td></tr>";
echo "</table>";
echo "</td></tr>";
echo "</table>";

echo "</td></tr>";
$net_amount = $tot_amount - $tot_exp;
echo "<tr><td colspan = '7' style = 'text-align:center;font-weight:bold;color:black;font-size:17px;letter-spacing:1px;'>Net Amount =  ".sprintf("%.2f",$net_amount)."</td></tr>";

echo "</table>";
echo "</div>";
//echo  "<p style = 'text-align:center;font-weight:bold;font-size:20px;'>We appreciate your Hurry but Hurry takes Time</p>";
echo "<table style = 'width:450px;border-collapse:collapse;margin:0 auto;' border ='0' id = 'border_footing'>";
echo "<tr><td style = 'border:none;'colspan = ''><span style = 'font-size:13px;'>Goods are received on the entire responsibility of the sender <br> E & O.E</span>";
echo "<br><span style = 'float:right;'>For FAROOQ FRUIT CO..</span></td></tr>";
echo "</table>";

//echo "<tr><td style = 'border:none;'colspan = '' style =  'text-align:center;font-weight:bold;padding:10px;letter-spacing:1px;color:black;'>Good sale and Prompt service is our motto</td></tr>";
echo "<h3 style = 'margin: 0 auto;width:450;text-align:center;color:black;'>Good Sale and Prompt Service is our motto</h3>";
echo "</div>";
?>
