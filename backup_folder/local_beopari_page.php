<?php 
$ledger_id = $_REQUEST['led_id'];
$ledger_name = $_REQUEST['led_name'];
$type_id = $_REQUEST["type_id"];
include 'con.php';
$array_beopari = array();
$array_challan = array();
$array_payments = array();
//echo $ledger_id;
$query = mysqli_query($con,"select DATE_FORMAT(date,'%d-%m-%Y') as date,transaction_id,narration,transaction_type,amount from daybook where ledger_id = $ledger_id and transaction_type between 14 and 15 order by daybook.date");
while($r = mysqli_fetch_array($query))
{
	$array_beopari[] = $r;
}
//print_r($array_beopari);
$query_challan = mysqli_query($con,"select sum(peti),sum(dabba),sum(amount),bill_no from fruit_sale_detail group by bill_no");
while($r = mysqli_fetch_array($query_challan))
{
	$ser = $r['bill_no'];
	$array_challan[$ser][] = $r;
}
//$query_payments = mysqli_query($con,"select * from daybook where ")
//print_r($array_challan);
echo '<div id = "main-window" style = "width:850px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">';
echo "<h3 style = 'text-transform:capitalize;font-size:19px;color:brown;text-align:center'>L ".$ledger_id."<br><span style = 'color:navy;'>".$ledger_name."</span></h3>";
echo "<span style=\"float:right;margin-left:5px;cursor:pointer;background:lightgreen;padding:5px;letter-spacing:1px;\" onclick = \"editledger(".$ledger_id.",'".$ledger_name."')\" >Edit</span><span style=\"float:right;\" onclick = \"\" ></span></br>";

echo "<table style = 'width:100%;border-collapse:collapse;'>";
echo "<tr style = 'color:brown;border-width:1px;border-bottom-style:solid;border-color:peachpuff;'><td style = 'text-align:left;'>Date</td><td style = 'text-align:left;'>Bill no</td><td style ='text-align:right;'>Payments</td><td style = 'text-align:right;'>P</td ><td style = 'text-align:right;'>H</td><td style = 'text-align:right;'>Amount</td></tr>";
foreach($array_beopari as $new_array)
{
	
	$id = $new_array[1];
	if($new_array[3] == 14)
	{
		$tot_payment = $tot_payment + $new_array[4];
//	echo "<tr><td style = 'text-align:left;'>".$new_array[0]."</td><td style = 'text-align:left;'>".$new_array[2]."</td><td style = 'text-align:right;'>".$new_array[4]."</td><td style = 'text-align:right;'></td><td style = 'text-align:right;'></td><td style = 'text-align:right;'></td><td style = 'text-align:right;'></td><td style = 'text-align:right;'>".$new_array[4]."</td></tr>";
	echo "<tr><td style = 'text-align:left;'>".$new_array[0]."</td><td style = 'text-align:left;'>".$new_array[2]."</td><td style = 'text-align:right;'>".$new_array[4]."</td><td style = 'text-align:right;'></td><td style = 'text-align:right;'></td><td style = 'text-align:right;'></td></tr>";
	
}
	else
	{
		
	echo "<tr><td style = 'text-align:left;'>".$new_array[0]."</td><td style = 'text-align:left;'>".$new_array[1]."</td><td></td><td style = 'text-align:right;'>".$array_challan[$id][0][0]."</td><td style = 'text-align:right;'>".$array_challan[$id][0][1]."</td><td style = 'text-align:right;'>".$array_challan[$id][0][2]."</td><td><button onclick = 'location.href =\"printbill.php?tran_id=".$new_array[1]."\"'>Print</button></td></tr>";
	$tot_peti =  $tot_peti + $array_challan[$id][0][0];
	$tot_half = $tot_half + $array_challan[$id][0][1];
	$tot_gross = $tot_gross + $array_challan[$id][0][2];
	$tot_exp = $tot_exp + $array_challan[$id][0][3];
	$tot_net = $tot_net + $array_challan[$id][0][4];
	
}
}
		$gdp = $gdp - $new_array[4];
$gdp = $gdp + $tot_net;
//echo "<td style = 'text-align:right;'>".sprintf("%.2f", $gdp)."</td></tr>";
echo "<tr style= 'border:2px solid grey;color:blue;font-weight:bold;'><td colspan = '' style = 'font-weight:bold;'>Total</td><td></td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_payment)."</td><td style = 'text-align:right;'>".$tot_peti."</td><td style = 'text-align:right;'>".$tot_half."</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_gross)."</td><td style = 'text-align:right;'>".sprintf("%.2f", $gdp)."</td></tr>";
echo "</table>";
echo "</div>";
//print_r($array_beopari[0]);
?>
