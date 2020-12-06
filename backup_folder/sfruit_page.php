<?php
$ledger_id = $_REQUEST['led_id'];
$ledger_name = $_REQUEST['led_name'];
$type_id = $_REQUEST["type_id"];
include 'con.php';
$array_beopari = array();
$array_challan = array();
$array_complete = array();
$query_opening = mysqli_query($con,"select *,DATE_FORMAT(ledger_date,'%d-%m-%Y') as ledger_date from ledgers join ledger_details using (ledger_id) where ledger_id = $ledger_id");
while($ron = mysqli_fetch_array($query_opening))
{
	$tenure = $ron['ledger_tenure'];
	//if($ron['opening_balance'] < 0)
	//$opening = $ron['opening_balance'] * -1;
	//else
	$opening = $ron['opening_balance'];
	$open_date = $ron['ledger_date'];
	$father_name = $ron['father_name'];
	$address = $ron['address'];
	$phone_no = $ron['phone_no'];
	$phone_2 = $ron['phone_2'];
	$note = $ron['narration'];
	$folio = $ron['folio'];
	if($opening > 0)
	$typ = "debt";
	else
	$typ = "credit";
	$array_complete =
	array (
	array(
		"date" => $open_date,
	"part" => "Folio ".$folio,
	"tran" => "Opening Balance",
	$typ => $opening,
));

}

	$array_directions = array();
$queryDirection = mysqli_query($con,"(select ledger_id,ledger_name from ledgers where ledger_type = 6 and ledger_id < $ledger_id order by ledger_id desc limit 1) union (select ledger_id,ledger_name from ledgers where ledger_type = 6 and ledger_id > $ledger_id order by ledger_id asc limit 1)");
//$queryDirection = mysqli_query($con,"select ledger_id,ledger_name from ledgers where ledger_type = 6");
while($rowDirection = mysqli_fetch_array($queryDirection))
{
//	$ledge_id = $rowDirection['ledger_id'];
		$array_directions[] = $rowDirection;
//	$array_directions[$ledge][ledger_name] = $rowDirection['ledger_name'];
//	$array_directions[$ledge][ledger_id] = $rowDirection['ledger_id'];
}
//echo $ledger_id;
//print_r($array_challan);
$net_amount = 0;
echo '<div id = "main-window" style = "width:850px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">';
echo "<span style = 'color:grey;border:1px solid grey;padding:3px;margin:3px;border-radius:3px;' onclick = 'ledger_types(g_ledger,g_ledger_type,".$led_id.")'> <= Back</span>";
$prev_ledger = $ledger_id -1;
$new_ledger = $ledger_id +1;

echo "<p style = 'text-align:center;color:blue;font-size:18px;'><span style = ''><span style = 'border:1px solid grey;padding:4px;border-radius:5px;margin-right:5px;color:brown;font-size:12px;' onclick = \"ledgerfruit(".$array_directions[0][0].",'".$array_directions[0][1]."')\"> < Previous</span>A/C No :  </span><span>".$tenure." <span>".$ledger_id."</span><span style = 'border:1px solid grey;padding:4px;border-radius:5px;margin-left:5px;color:brown;font-size:12px;' onclick = \"ledgerfruit(".$array_directions[1][0].",'".$array_directions[1][1]."')\">Next ></span></span></p>";
//echo "<h3 style = 'text-transform:capitalize;font-size:19px;color:brown;text-align:center;'>Ledger ID : <span style = 'color:navy;'>$ledger_id</span> </h3>";
echo "<h3 style = 'margin-bottom:0px;text-transform:capitalize;font-size:19px;color:brown;text-align:left'><span style = 'color:navy;'>$ledger_name</span> </h3>";
echo "<h3 style = 'text-align:left;text-transform:capitalize;font-size:16px;color:brown;font-weight:normal;margin-top:0px;'>S/o $father_name<br>$address<br>Phone : $phone_no / $phone_2</h3>";
echo "<span style=\"float:right;margin-left:5px;cursor:pointer;background:lightgreen;padding:5px;letter-spacing:1px;\" onclick = \"editledger(".$ledger_id.",'".$ledger_name."')\" >Edit</span><span style=\"float:right;\" onclick = \"\" ></span></br>";
	echo "<span style = 'color:brown;width:600px;float:left;color:blue'>Reminder: <span style= 'color:navy;'>".$note."</span></span>";

	$pre_total = 0;
	$query_pre_total = mysqli_query($con,"select IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 9),0) + IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 14),0) - IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 13),0) + IFNULL((select sum(net) from challan_detail where ledger_id = $ledger_id),0) - IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 10),0) - opening_balance as balance from ledgers where ledger_type = 6 and ledger_id = $ledger_id");
	while($pre_row = mysqli_fetch_array($query_pre_total))
	{
		$pre_total = $pre_row['balance'];
	}

if($pre_total > 0)
echo "<h4 style = 'background:peachpuff;padding:5px;border-radius:20px;text-align:left;color:navy;font-size:17px;'>FRUIT ACCOUNT<span style = 'float:right;'>Cr $pre_total</span></h4>";
else
echo "<h4 style = 'background:peachpuff;padding:5px;border-radius:20px;text-align:left;color:navy;font-size:17px;'>FRUIT ACCOUNT<span style = 'float:right;'>Dr $pre_total</span></h4>";

echo "<table style = 'width:100%;border-collapse:collapse;'>";
echo "<tr style = 'color:brown;border-width:1px;border-bottom-style:solid;border-color:peachpuff;'><td style = 'text-align:left;'>Date</td><td style = 'text-align:left;'>Transaction</td><td style = 'text-align:left;'>Particulars</td><td style = 'text-align:right;'>P</td ><td style = 'text-align:right;'>H</td><td style = 'text-align:right;'>Debit</td><td style = 'text-align:right;'>Credit</td><td style = 'text-align:right;'>Balance</td></tr>";
$gr_peti =0 ;
$gr_dabba =0 ;
$tot_debt = 0;
$tot_cr = 0;
//if($opening > 0)
//{
//	$net_amount = $net_amount - $opening;
//	echo "<tr><td style = 'text-align:left;'>$open_date</td><td style = 'text-align:left;'>Opening Balance</td><td style = 'text-align:left;font-size:13px;'>Folio $folio</td><td></td><td></td><td style = 'text-align:right;'>$opening</td><td></td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";

//}
//else
//{
//	$net_amount = $net_amount - $opening;
//	echo "<tr><td style = 'text-align:left;'>$open_date</td><td style = 'text-align:left;'>Opening Balance</td><td style = 'text-align:left;font-size:13px;'>Folio $folio</td><td></td><td></td><td></td><td style ='text-align:right;'>$opening</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";

//}
$query = mysqli_query($con,"select sum(amount),DATE_FORMAT(daybook.date,'%d-%m-%Y') as date,sum(peti),sum(dabba),year(daybook.date) as year from daybook join watak_detail on watak_detail.watak_no = daybook.transaction_id where daybook.ledger_id = '$ledger_id' and transaction_type = 9 group by year(daybook.date) order by daybook.date desc");
while($row = mysqli_fetch_array($query))
{
//	$net_amount = $net_amount + $row['sum(amount)'];
//	$tot_cr = $tot_cr + $row['sum(amount)'];
//	$gr_peti = $gr_peti + $row['sum(peti)'];
//	$gr_dabba = $gr_dabba + $row['sum(dabba)'];
//	echo "<tr onclick = 'fill_watakk(".$row['year'].",9,".$ledger_id.")'><td style = 'text-align:left;'>".$row['date']."</td><td style = 'text-align:left;'>Mandi Watak</td><td></td><td style = 'text-align:right;'>".$row['sum(peti)']."</td><td style = 'text-align:right;'>".$row['sum(dabba)']."</td><td ></td><td style='text-align:right;'>".$row['sum(amount)']."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
$array_complete[] =
array(
"date" => $row['date'],
"tran" => "Mandi Watak",
"P" => $row['sum(peti)'],
"H" => $row['sum(dabba)'],
"credit" => $row['sum(amount)'],
"year" => $row['year'],
"tr_type" => 9,
"ledger" => $ledger_id,
);

/*
	$array_complete[][date] = $row['date'];
	$array_complete[tran] = "Mandi Watak";
	$array_complete[P] = $row['sum(peti)'];
	$array_complete[H] = $row['sum(dabba)'];
	$array_complete[credit] = $row['sum(amount)'];
	$array_complete[year] = $row['year'];
	$array_complete[tr_type] = 9;
	$array_complete[ledger] = $ledger_id;
	* */


}
$query_challan = mysqli_query($con,"select sum(net),sum(peti),sum(dabba),DATE_FORMAT(date,'%d-%m-%Y') as date,year(date) as year from challan_detail where challan_detail.ledger_id = $ledger_id group by year(date) order by date desc");
while($row = mysqli_fetch_array($query_challan))
{
//	$net_amount = $net_amount + $row['sum(net)'];
//	$tot_cr = $tot_cr + $row['sum(net)'];
//	$gr_peti = $gr_peti + $row['sum(peti)'];
//	$gr_dabba = $gr_dabba + $row['sum(dabba)'];
//	echo "<tr onclick = 'fill_watakk(".$row['year'].",21,".$ledger_id.")'><td style = 'text-align:left;'>".$row['date']."</td><td style = 'text-align:left;'>Watak</td><td></td><td style = 'text-align:right;'>".$row['sum(peti)']."</td><td style = 'text-align:right;'>".$row['sum(dabba)']."</td><td ></td><td style='text-align:right;'>".$row['sum(net)']."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";

$array_complete[] = array(
"date" => $row['date'],
"tran" => "Watak",
"P" => $row['sum(peti)'],
"H" => $row['sum(dabba)'],
"credit" => $row['sum(net)'],
"year" => $row['year'],
"tr_type" => 21,
"ledger" => $ledger_id,
);

/*

	$array_complete[][date] = $row['date'];
	$array_complete[tran] = "Watak";
	$array_complete[P] = $row['sum(peti)'];
	$array_complete[H] = $row['sum(dabba)'];
	$array_complete[credit] = $row['sum(net)'];
	$array_complete[year] = $row['year'];
	$array_complete[tr_type] = 21;
	$array_complete[ledger] = $ledger_id;
	* */


	//$
}
$query = mysqli_query($con,"select sum(amount),DATE_FORMAT(date,'%d-%m-%Y') as date,year(date) as year,transaction_type,transaction_id from daybook where ledger_id = '$ledger_id' and transaction_type = 10 group by year(date) order by date desc");
while($row = mysqli_fetch_array($query))
{
//	$net_amount = $net_amount - $row['sum(amount)'];
//	$tot_debt = $tot_debt + $row['sum(amount)'];
//	echo "<tr onclick = 'fill_baardana(".$row['year'].",".$row['transaction_type'].",".$ledger_id.")'><td style = 'text-align:left;'>".$row['date']."</td><td style = 'text-align:left;'>Baardana</td><td></td><td></td><td></td><td style='text-align:right;'>".$row['sum(amount)']."</td><td></td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
	$array_complete[] = array(
	"date" => $row['date'],
	"tran" => "Baardana #".$row['transaction_id'],
	"debt" => $row['sum(amount)'],
	"year" => $row['year'],
	"tr_type" => $row['transaction_type'],
	"ledger" => $ledger_id,
	);


/*
	$array_complete[][date] = $row['date'];
	$array_complete[tran] = "Baardana";
	$array_complete[debt] = $row['sum(amount)'];
	$array_complete[year] = $row['year'];
	$array_complete[tr_type] = $row['transaction_type'];
	$array_complete[ledger] = $ledger_id;
*/
	//$
}

$query_pay = mysqli_query($con,"select amount,DATE_FORMAT(date,'%d-%m-%Y') as date,transaction_type,narration,transaction_id from daybook where ledger_id = $ledger_id and transaction_type = 13");
while($r_pay = mysqli_fetch_array($query_pay))
{
//	$net_amount = $net_amount - $r_pay['amount'];
//	$tot_debt = $tot_debt + $r_pay['amount'];
//echo "<tr><td style = 'text-align:left;'>".$r_pay['date']."</td><td style = 'text-align:left;'>Payment</td><td style = 'font-size:13px;text-align:left;'>".$r_pay['narration']."</td><td colspan = '2'></td><td style = 'text-align:right;'>".$r_pay['amount']."</td><td></td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
	$array_complete[] = array(
	"date" => $r_pay["date"],
	"tran" => "Payment #".$r_pay['transaction_id'],
	"part" => $r_pay['narration'],
	"debt" => $r_pay['amount'],
	);

/*
	$array_complete[][date] = $r_pay['date'];
	$array_complete[tran] = "Payment";
	$array_complete[part] = $r_pay['narration'];
	$array_complete[debt] = $row['amount'];
*/
}

$query_pay = mysqli_query($con,"select amount,DATE_FORMAT(date,'%d-%m-%Y') as date,transaction_type,narration from daybook where ledger_id = $ledger_id and transaction_type = 14");
while($r_pay = mysqli_fetch_array($query_pay))
{
//	$net_amount = $net_amount - $r_pay['amount'];
//	$tot_debt = $tot_debt + $r_pay['amount'];
//echo "<tr><td style = 'text-align:left;'>".$r_pay['date']."</td><td style = 'text-align:left;'>Payment</td><td style = 'font-size:13px;text-align:left;'>".$r_pay['narration']."</td><td colspan = '2'></td><td style = 'text-align:right;'>".$r_pay['amount']."</td><td></td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
	$array_complete[] = array(
	"date" => $r_pay["date"],
	"tran" => "receipt",
	"part" => $r_pay['narration'],
	"credit" => $r_pay['amount'],
	);

/*
	$array_complete[][date] = $r_pay['date'];
	$array_complete[tran] = "Payment";
	$array_complete[part] = $r_pay['narration'];
	$array_complete[debt] = $row['amount'];
*/
}



function date_compare($a, $b)
{
    $t1 = strtotime($a['date']);
    $t2 = strtotime($b['date']);
    return $t1 - $t2;
}
usort($array_complete, 'date_compare');

$arr_len = count($array_complete);
$new_len = $arr_len -1;
//for($x=$new_len;$x>=0;$x--)
for($x=0;$x<=$new_len;$x++)
{
	$net_amount = $net_amount - $array_complete[$x][debt];
	if($array_complete[$x][tran] == 'Opening Balance')
	$net_amount = $net_amount + ($array_complete[$x][credit]*-1);
	else
	$net_amount = $net_amount + $array_complete[$x][credit];
//}
	$tot_cr = $tot_cr + $array_complete[$x][credit];
	$tot_debt = $tot_debt + $array_complete[$x][debt];
	$gr_peti = $gr_peti + $array_complete[$x][P];
	$gr_dabba = $gr_dabba + $array_complete[$x][H];
	if($array_complete[$x][tran] == 'Baardana' or $array_complete[$x][tran] == 'Watak' or $array_complete[$x][tran] == 'Mandi Watak')
	{
	if($array_complete[$x][tran] == 'Baardana')
	echo "<tr onclick = 'fill_baardana(".$array_complete[$x][year].",".$array_complete[$x][tr_type].",".$array_complete[$x][ledger].")'><td style = 'text-align:left;'>".$array_complete[$x][date]."</td><td style = 'text-align:left;'>".$array_complete[$x][tran]."</td><td style = 'text-align:left;font-size:13px;'>".$array_complete[$x][part]."</td><td style = 'text-align:right;'>".$array_complete[$x][P]."</td><td style = 'text-align:right;'>".$array_complete[$x][H]."</td><td style = 'text-align:right;'>".$array_complete[$x][debt]."</td><td style = 'text-align:right;'>".$array_complete[$x][credit]."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
	if($array_complete[$x][tran] == 'Watak' or $array_complete[$x][tran] == 'Mandi Watak')
	echo "<tr  onclick = 'fill_watakk(".$array_complete[$x][year].",".$array_complete[$x][tr_type].",".$array_complete[$x][ledger].")'><td style = 'text-align:left;'>".$array_complete[$x][date]."</td><td style = 'text-align:left;'>".$array_complete[$x][tran]."</td><td style = 'text-align:left;font-size:13px;'>".$array_complete[$x][part]."</td><td style = 'text-align:right;'>".$array_complete[$x][P]."</td><td style = 'text-align:right;'>".$array_complete[$x][H]."</td><td style = 'text-align:right;'>".$array_complete[$x][debt]."</td><td style = 'text-align:right;'>".$array_complete[$x][credit]."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
	}
	else
	{
		if($array_complete[$x][tran] == 'receipt')
			echo "<tr ><td style = 'text-align:left;'>".$array_complete[$x][date]."</td><td style = 'text-align:left;'>".$array_complete[$x][tran]."</td><td style = 'text-align:left;font-size:13px;'>".$array_complete[$x][part]."</td><td style = 'text-align:right;'>".$array_complete[$x][P]."</td><td style = 'text-align:right;'>".$array_complete[$x][H]."</td><td style = 'text-align:right;'>".sprintf("%.2f",$array_complete[$x][debt])."</td><td style = 'text-align:right;'>".sprintf("%.2f",$array_complete[$x][credit])."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
else
	echo "<tr ><td style = 'text-align:left;'>".$array_complete[$x][date]."</td><td style = 'text-align:left;'>".$array_complete[$x][tran]."</td><td style = 'text-align:left;font-size:13px;'>".$array_complete[$x][part]."</td><td style = 'text-align:right;'>".$array_complete[$x][P]."</td><td style = 'text-align:right;'>".$array_complete[$x][H]."</td><td style = 'text-align:right;'>".$array_complete[$x][debt]."</td><td style = 'text-align:right;'>".abs($array_complete[$x][credit])."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
}
}







if($net_amount > 0)
echo "<tr style = 'color:blue;text-align:left;font-weight:bold;border:2px solid grey;'><td colspan = '3'>Total</td><td style = 'text-align:right;'>".$gr_peti."</td><td style = 'text-align:right;'>".$gr_dabba."</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_debt)."</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_cr)."</td><td style = 'text-align:right;'>Cr ".sprintf("%.2f",$net_amount)."</td></tr>";
else
echo "<tr style = 'color:blue;text-align:left;font-weight:bold;border:2px solid grey;'><td colspan = '3'>Total</td><td style = 'text-align:right;'>".$gr_peti."</td><td style = 'text-align:right;'>".$gr_dabba."</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_debt)."</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_cr)."</td><td style = 'text-align:right;'>Dr ".sprintf("%.2f",$net_amount)."</td></tr>";
echo "</table>";


echo "</div>";

//print_r($array_beopari[0]);
?>
<div id = 'baardana_detail' style = 'width:850px;padding:10px;border-radius:20px;'>

</div>
