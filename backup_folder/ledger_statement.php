<style>
	#font-face
	{
   font-family: myFirstFont;
   src: url(sansation_light.woff);
}
   </style>
<script>
			function showdatalist_value(sno)
	{
//		alert("it works");

	var shownvalue = document.getElementById("led_name").value;
	var datalist = document.getElementById("exampleList");
		var value_to_send = document.querySelector("#exampleList option[value='"+shownvalue+"']").id;
other_ledgers = value_to_send;
document.getElementById("led_id").value = value_to_send;
//document.getElementById("submit_form").submit;

	}
</script>
<?php 
error_reporting(E_ERROR);
$ledger_id = $_REQUEST['led_id'];
$ledger_name = $_REQUEST['led_name'];
$s_date = $_REQUEST['s_date'];
$d_date = $_REQUEST['d_date'];
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
	$typ => $opening ,
));

}

	$opening_grade = 0;
	
	
	$query_pre_tota = mysqli_query($con,"select IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 3 and date < '$s_date'),0) + IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 6 and date < '$s_date'),0) - IFNULL((select sum(amount) from receipt_detail where ledger_id = $ledger_id and date < '$s_date'),0) - IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 8 and date < '$s_date'),0) - opening_balance as balance from ledgers where ledger_type = 2 and ledger_id = $ledger_id");
	while($pre_row = mysqli_fetch_array($query_pre_tota))
	{
		$opening_grade = $pre_row['balance'];
		if($opening_grade < 0)
		{
		$array_complete[0][debt] = $opening_grade * -1;
		$array_complete[0][credit] = 0;
	}
		else
		{
		$array_complete[0][credit] = $opening_grade;
		$array_complete[0][debt] = 0;
	}
	}
	
////////////////////////////////////////	

	$array_directions = array();
$queryDirection = mysqli_query($con,"(select ledger_id,ledger_name from ledgers where ledger_type = 6 and ledger_id < $ledger_id order by ledger_id desc limit 1) union (select ledger_id,ledger_name from ledgers where ledger_type = 6 and ledger_id > $led_id order by ledger_id asc limit 1)");
while($rowDirection = mysqli_fetch_array($queryDirection))
{
	$array_directions[] = $rowDirection; 
}
//echo $ledger_id;
//print_r($array_challan);

/////////////////////////////////////////


$net_amount = 0;
echo "<datalist id = 'exampleList' >";
$query_list_ledger = mysqli_query($con,"select *,concat(ledger_tenure,ledger_id) as account_no From ledgers join ledger_details using (ledger_id) where ledger_type = 2");
while($row_ledger = mysqli_fetch_array($query_list_ledger))
{
echo "<option style = 'font-weight:heavy;' value = '".$row_ledger['ledger_name']."  S/O ".$row_ledger['father_name']."  R/O ".$row_ledger['address']."' data-id = '".$row_ledger['account_no']."' id = '".$row_ledger['ledger_id']."'><span style = 'font-size:18px;'>".$row_ledger['account_no']."</span></option>";
}
//echo "<option value = 'Rama Books' data-id = '6' id = '6' onKeyUp = 'alert(\"6\");'>6</option>";
//echo "<option value = 'Aatma ram' data-id = '7' id = '7' onKeyUp = 'alert(\"7\");'>7</option>";
echo "</datalist>";
echo '<div id = "main-window" style = "width:850px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">';
//echo "<span style = 'color:grey;border:1px solid grey;padding:3px;margin:3px;border-radius:3px;' onclick = 'ledger_types(g_ledger,g_ledger_type,".$led_id.")'> <= Back</span>";
//echo "<p style = 'text-align:center;color:blue;font-size:18px;'><span style = ''><span style = 'border:1px solid grey;padding:4px;border-radius:5px;margin-right:5px;color:brown;font-size:12px;' onclick = \"ledgerdetail(".$array_directions[0][0].",'".$array_directions[0][1]."')\"> < Previous</span>A/C No :  </span><span>".$rowLed['ledger_tenure']." <span>".$ledger_id."</span><span style = 'border:1px solid grey;padding:4px;border-radius:5px;margin-left:5px;color:brown;font-size:12px;' onclick = \"ledgerfruit(".$array_directions[1][0].",'".$array_directions[1][1]."')\">Next ></span></span></p>";
//echo "<h3 style = 'text-transform:capitalize;font-size:19px;color:brown;text-align:center;'>Ledger ID : <span style = 'color:navy;'>$ledger_id</span> </h3>";
//echo "<h3 style = 'margin-bottom:0px;text-transform:capitalize;font-size:19px;color:brown;text-align:left'><span style = 'color:navy;'>$ledger_name</span> </h3>";
//echo "<h3 style = 'text-align:left;text-transform:capitalize;font-size:16px;color:brown;font-weight:normal;margin-top:0px;'>S/o $father_name<br>$address<br>Phone : $phone_no / $phone_2</h3>";
//echo "<span style=\"float:right;margin-left:5px;cursor:pointer;background:lightgreen;padding:5px;letter-spacing:1px;\" onclick = \"editledger(".$ledger_id.",'".$ledger_name."')\" >Edit</span><span style=\"float:right;\" onclick = \"\" ></span></br>";
//	echo "<span style = 'color:brown;width:600px;float:left;color:blue'>Reminder: <span style= 'color:navy;'>".$note."</span></span>";
echo "<table style = 'width:100%;'>";
//echo "<tr style = 'text-align:center;' ><td colspan = '7' style = 'border:1px solid black;text-align:center;width:100%;color:black;'><span  style = 'float:right;color:black;font-weight:normal;font-size:12px;'><h4>T : 01951-254400<br>C: 919419434400<br>C: 919018184400<br>C: 919797274400</h4></span><h2 ><span style = 'font-family:Copperplate,Copperplate Gothic Light,fantasy;letter-spacing:1px;'>FAROOQ FRUIT CO</span><br> <span style = 'font-size:15px;color:black;font-weight:normal;'><span style = 'color:black;padding:1px 4px;font-weight:bold;font-style:italic;border-radius:5px;'>Fruit Grower Commission & Forwarding Agents </span><br>55,56 Fruit & Vegetable Market<br>Zaloosa Charari-Sharief, Kashmir - 191112</span></h2></td></tr>";
echo "<tr style = 'text-align:center;' ><td colspan = '7' style = 'border:1px solid black;text-align:center;width:100%;color:black;'><span  style = 'float:right;color:black;font-weight:normal;font-size:12px;'><h4>T : 01951-254400<br>C: 919419434400<br>C: 919018184400<br>C: 919797274400</h4></span><h2 ><span id = 'font-face' style = 'letter-spacing:1px;'><a href= 'ledgers.php' style = 'text-decoration:none;'>FAROOQ ELECTRONICS</a></span><br> <span style = 'font-size:15px;color:black;font-weight:normal;'><span style = 'color:black;padding:1px 4px;font-weight:bold;font-style:italic;border-radius:5px;'>Gulshanabad Charari-Sharief,</span><br> Kashmir - 191112<br>Email : farooqelectronics21@ymail.com</span></h2></td></tr>";
echo "</table>";	
	
	
	
echo "<form id = 'submit_form'>";	
echo "<table style = 'width:100%;border-collapse:collapse;' border = '0'>";
echo "<input = type = 'text' name = 'led_id' style = 'display:none;' id = 'led_id' value = '$ledger_id'/>";
echo "<tr><td>Ledger Name</td><td colspan = '3'><input style = 'font-size:17px;padding:3px;width:100%;border:0px;color:blue;font-weight:bold;' type = 'text' list = 'exampleList' name = 'led_name' id = 'led_name' oninput = 'showdatalist_value()' value = '$ledger_name' autocomplete= 'off'/></td></tr>";
echo "<tr><td>From</td><td><input name = 's_date' value = '$s_date' type = 'date' style = 'border:0px;width:100%;color:blue;font-size:16px;padding:3px;'/></td><td>To</td><td><input type = 'date' style = 'color:blue;border:0px;width:100%;font-size:16px;padding:3px;' name = 'd_date' value = '$d_date'/><input type = 'submit' style = 'display:none;' value = 'confirm'/></td></tr>";
echo "</table>";	
	echo "</form>";
	$pre_total = 0;
/////////////////////////////////////////	
	
	$query_pre_total = mysqli_query($con,"select IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 9),0) + IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 14),0) - IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 13),0) + IFNULL((select sum(net) from challan_detail where ledger_id = $ledger_id),0) - IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 10),0) - opening_balance as balance from ledgers where ledger_type = 6 and ledger_id = $ledger_id");
	while($pre_row = mysqli_fetch_array($query_pre_total))
	{
		$pre_total = $pre_row['balance'];
	}

$query_payment = mysqli_query($con,"select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 13 and date < '$sdate'");
while($r_p = mysqli_fetch_array($query_payment))
{
	$pay_sum = $r_p['sum(amount)'];
	//echo $pay_sum;
}

	$query_new_balance = mysqli_query($con,"select IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 9 and date < '$s_date'),0) - IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 13 and date < '$s_date'),0) + IFNULL((select sum(net) from challan_detail where ledger_id = $ledger_id and date < '$s_date'),0) - IFNULL((select sum(amount) from daybook where ledger_id = $ledger_id and transaction_type = 10 and date < '$s_date'),0) - opening_balance as balance from ledgers where ledger_type = 6 and ledger_id = $ledger_id");
	while($pre_row = mysqli_fetch_array($query_new_balance))
	{
		$opening = $pre_row['balance'];//-$pay_sum;
	}

//echo $opening;


if($pre_total > 0)
echo "<h4 style = 'background:peachpuff;padding:5px;border-radius:20px;text-align:left;color:navy;font-size:17px;'>FRUIT ACCOUNT <span style = 'margin-left:215px;font-size:22px;'><i><b>** Statement **</b></i></span><span style = 'float:right;'>Cr $pre_total</span></h4>";
else
echo "<h4 style = 'background:peachpuff;padding:5px;border-radius:20px;text-align:left;color:navy;font-size:17px;'>FRUIT ACCOUNT <span style = 'margin-left:215px;font-size:22px;'><i><b>** Statement **</b></i></span><span style = 'float:right;'>Dr $pre_total</span></h4>";

echo "<table style = 'width:100%;border-collapse:collapse;'>";
echo "<tr style = 'color:brown;border-width:1px;border-bottom-style:solid;border-color:peachpuff;'><td style = 'text-align:left;'>Date</td><td style = 'text-align:left;'>Transaction</td><td style = 'text-align:right;'># No</td><td style = 'text-align:right;'>Bill/Receipt No</td><td style = 'text-align:right;'>Debit</td><td style = 'text-align:right;'>Credit</td><td style = 'text-align:right;'>Balance</td></tr>";
$gr_peti =0 ;
$gr_dabba =0 ;
$tot_debt = 0;
$tot_cr = 0;
/*if($opening < 0)
{
	//$open_date = $s_date;
	$net_amount = $net_amount - $opening;
	echo "<tr><td style = 'text-align:left;'>$open_date</td><td style = 'text-align:left;'>Opening Balance</td><td></td><td></td><td></td><td style = 'text-align:right;'>$opening</td><td></td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";

}
else
{
	$net_amount = $net_amount + $opening;
	//$open_date = $s_date;
	echo "<tr><td style = 'text-align:left;'>$open_date</td><td style = 'text-align:left;'>Opening Balance</td><td></td><td></td><td></td><td></td><td style ='text-align:right;'>$opening</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";

}
*/
$query = mysqli_query($con,"select *,sum(amount),year(date) as year,month(date) as month from receipt_detail where ledger_id = $ledger_id and date between '$s_date' and '$d_date' group by month(date),year(date)");
while($row = mysqli_fetch_array($query))
{
//	$net_amount = $net_amount + $row['sum(amount)'];
//	$tot_cr = $tot_cr + $row['sum(amount)'];
//	$gr_peti = $gr_peti + $row['sum(peti)'];
//	$gr_dabba = $gr_dabba + $row['sum(dabba)'];
//	echo "<tr onclick = 'fill_watakk(".$row['year'].",9,".$ledger_id.")'><td style = 'text-align:left;'>".$row['date']."</td><td style = 'text-align:left;'>Mandi Watak</td><td></td><td style = 'text-align:right;'>".$row['sum(peti)']."</td><td style = 'text-align:right;'>".$row['sum(dabba)']."</td><td ></td><td style='text-align:right;'>".$row['sum(amount)']."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
	//$
	
	$array_complete[] = 
array(
"date" => $row['date'],
"tran" => "Receipt",
//"P" => $row['sum(peti)'],
//"H" => $row['sum(dabba)'],
"debt" => $row['sum(amount)'],
"year" => $row['year'],
"tr_type" => 9,
"ledger" => $ledger_id,
);
}





$query_challan = mysqli_query($con,"select *,year(date) as year from daybook where transaction_type = 6 and ledger_id = $ledger_id and date between '$s_date' and '$d_date'");
while($row = mysqli_fetch_array($query_challan))
{
/*	$net_amount = $net_amount + $row['sum(net)'];
	$tot_cr = $tot_cr + $row['sum(net)'];
	$gr_peti = $gr_peti + $row['sum(peti)'];
	$gr_dabba = $gr_dabba + $row['sum(dabba)'];
	echo "<tr onclick = 'fill_watakk(".$row['year'].",21,".$ledger_id.")'><td style = 'text-align:left;'>".$row['date']."</td><td style = 'text-align:left;'>Watak</td><td></td><td style = 'text-align:right;'>".$row['sum(peti)']."</td><td style = 'text-align:right;'>".$row['sum(dabba)']."</td><td ></td><td style='text-align:right;'>".$row['sum(net)']."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
*/
	$array_complete[] = array(
"date" => $row['date'],
"tran" => "Credit Loan",
//"P" => $row['sum(peti)'],
//"H" => $row['sum(dabba)'],
"debt" => $row['amount'],
"year" => $row['year'],
"tr_type" => 21,
"ledger" => $ledger_id,
);

	
}
$query = mysqli_query($con,"select *,year(date) as year from daybook where transaction_type = 8 and ledger_id = $ledger_id and date between '$s_date' and '$d_date'");
while($row = mysqli_fetch_array($query))
{
/*	$net_amount = $net_amount - $row['sum(amount)'];
	$tot_debt = $tot_debt + $row['sum(amount)'];
	echo "<tr onclick = 'fill_baardana(".$row['year'].",".$row['transaction_type'].",".$ledger_id.")'><td style = 'text-align:left;'>".$row['date']."</td><td style = 'text-align:left;'>Baardana</td><td></td><td></td><td></td><td style='text-align:right;'>".$row['sum(amount)']."</td><td></td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
*/	$array_complete[] = array(
	"date" => $row['date'],
	"tran" => "Debit Loan",
	"credit" => $row['amount'],
	"year" => $row['year'],
	"tr_type" => $row['transaction_type'],
	"ledger" => $ledger_id,
	);
}

$query_pay = mysqli_query($con,"select *,year(date) as year from daybook where transaction_type = 3 and ledger_id = $ledger_id and date between '$s_date' and '$d_date'");
while($r_pay = mysqli_fetch_array($query_pay))
{
/*	$net_amount = $net_amount - $r_pay['amount'];
	$tot_debt = $tot_debt + $r_pay['amount'];
echo "<tr><td style = 'text-align:left;'>".$r_pay['date']."</td><td style = 'text-align:left;'>Payment</td><td style = 'font-size:13px;text-align:left;'>".$r_pay['narration']."</td><td colspan = '2'></td><td style = 'text-align:right;'>".$r_pay['amount']."</td><td></td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";	
*/
	$array_complete[] = array(
	"date" => $r_pay['date'],
	"tran" => "Whole Sale",
	"debt" => $r_pay['amount'],
	"year" => $r_pay['year'],
	"tr_type" => $r_pay['transaction_type'],
	"ledger" => $ledger_id,
	);
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
for($x=0;$x<$arr_len;$x++)
{
	$net_amount = $net_amount - $array_complete[$x][debt];
	if($array_complete[$x][tran] == 'Opening Balance')
{
$net_amount = $net_amount + ($array_complete[$x][credit]);
}
	else
{
	$net_amount = $net_amount + $array_complete[$x][credit];
}
//}

	$tot_cr = $tot_cr + $array_complete[$x][credit];
	$tot_debt = $tot_debt + $array_complete[$x][debt];
	$gr_peti = $gr_peti + $array_complete[$x][P];
	$gr_dabba = $gr_dabba + $array_complete[$x][H];

	/*
	if($array_complete[$x][tran] == 'Baardana' or $array_complete[$x][tran] == 'Watak' or $array_complete[$x][tran] == 'Mandi Watak')
	{
	if($array_complete[$x][tran] == 'Baardana')
	echo "<tr onclick = 'fill_baardana(".$array_complete[$x][year].",".$array_complete[$x][tr_type].",".$array_complete[$x][ledger].")'><td style = 'text-align:left;'>".$array_complete[$x][date]."</td><td style = 'text-align:left;'>".$array_complete[$x][tran]."</td><td style = 'text-align:left;font-size:13px;'>".$array_complete[$x][part]."</td><td style = 'text-align:right;'>".$array_complete[$x][P]."</td><td style = 'text-align:right;'>".$array_complete[$x][H]."</td><td style = 'text-align:right;'>".$array_complete[$x][debt]."</td><td style = 'text-align:right;'>".$array_complete[$x][credit]."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
	if($array_complete[$x][tran] == 'Watak' or $array_complete[$x][tran] == 'Mandi Watak')
	echo "<tr  onclick = 'fill_watakk(".$array_complete[$x][year].",".$array_complete[$x][tr_type].",".$array_complete[$x][ledger].")'><td style = 'text-align:left;'>".$array_complete[$x][date]."</td><td style = 'text-align:left;'>".$array_complete[$x][tran]."</td><td style = 'text-align:left;font-size:13px;'>".$array_complete[$x][part]."</td><td style = 'text-align:right;'>".$array_complete[$x][P]."</td><td style = 'text-align:right;'>".$array_complete[$x][H]."</td><td style = 'text-align:right;'>".$array_complete[$x][debt]."</td><td style = 'text-align:right;'>".$array_complete[$x][credit]."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
	}
	else
	{
			if($array_complete[$x][tran] == 'Opening Balance' or $array_complete[$x][tran] == 'receipt')
	echo "<tr ><td style = 'text-align:left;'>".$array_complete[$x][date]."</td><td style = 'text-align:left;'>".$array_complete[$x][tran]."</td><td style = 'text-align:left;font-size:13px;'>".$array_complete[$x][part]."</td><td style = 'text-align:right;'>".$array_complete[$x][P]."</td><td style = 'text-align:right;'>".$array_complete[$x][H]."</td><td style = 'text-align:right;'>".sprintf("%.2f",$array_complete[$x][debt])."</td><td style = 'text-align:right;'>".sprintf("%.2f",$array_complete[$x][credit])."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
		else
			*/
	echo "<tr ><td style = 'text-align:left;'>".$array_complete[$x][date]."</td><td style = 'text-align:left;'>".$array_complete[$x][tran]."</td><td style = 'text-align:left;font-size:13px;'>".$array_complete[$x][part]."</td><td style = 'text-align:right;'>".$array_complete[$x][P]."</td><td style = 'text-align:right;'>".$array_complete[$x][H]."</td><td style = 'text-align:right;'>".$array_complete[$x][debt]."</td><td style = 'text-align:right;'>".abs($array_complete[$x][credit])."</td><td style = 'text-align:right;'>".sprintf("%.2f",$net_amount)."</td></tr>";
	//}
}















if($net_amount > 0)
echo "<tr style = 'color:blue;text-align:left;font-weight:bold;border:2px solid grey;'><td colspan = '2'>Total</td><td style = 'text-align:right;'>".$gr_peti."</td><td style = 'text-align:right;'>".$gr_dabba."</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_debt)."</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_cr)."</td><td style = 'text-align:right;'>Cr ".sprintf("%.2f",$net_amount)."</td></tr>";
else
echo "<tr style = 'color:blue;text-align:left;font-weight:bold;border:2px solid grey;'><td colspan = '3'>Total</td><td style = 'text-align:right;'>".$gr_peti."</td><td style = 'text-align:right;'>".$gr_dabba."</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_debt)."</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_cr)."</td><td style = 'text-align:right;'>Dr ".sprintf("%.2f",$net_amount)."</td></tr>";
echo "</table>";

echo "<br><hr>";
echo "<p style = 'text-align:right;'>";
echo "<table style = 'float:right;width:30%;border-collapse:collapse;font-weight:bold;font-size:17px;color:navy;border-bottom-style:solid;border-color:grey;border-width:2px;border-collapse:collapse;' border = '0'>";
echo "<tr><td>Total Debit <span style = 'float:right;'>=</span></td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_debt)."</td></tr>";
echo "<tr><td>Total Credit <span style = 'float:right;'>=</span></td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_cr)."</td></tr>";
echo "<tr style = 'font-size:20px;' ><td style = 'border-top-style:solid;border-color:grey;border-width:2px;'>Balance <span style = 'float:right;'>=</span></td><td style = 'text-align:right;border-top-style:solid;border-color:grey;border-width:2px;font-size:18px;'>";
if($net_amount > 0) echo "<span style = 'color:red;'>Cr</span> ".sprintf("%.2f",$net_amount); else echo "<span style = 'color:green;'>Dr</span> ".sprintf("%.2f",$net_amount);
echo "</td></tr>";
echo "</table>";
echo "</p>";

//echo "<br><hr>";

$query_grp = mysqli_query($con,"select unit,name,sum(qty) as qty,sum(baardana_detail.amount) as g_amount,DATE_FORMAT(daybook.date,'%d-%m-%Y') as date from baardana_detail join items on items.item_id = baardana_detail.uid join daybook on daybook.transaction_id = baardana_detail.bill_id where transaction_type = '10' and ledger_id = '$ledger_id' and daybook.date between '$s_date' and '$d_date' group by uid");
//echo "table list";
echo "<div style = 'position:fixed;bottom:0;'>";
echo "<table style = 'width:850px;border-top-style:solid;border-color:grey;border-width:2px;'>";
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
echo "<p style = 'text-align:center;font-size:20px;letter-spacing:1px;'><i>We appreciate your Hurry but Hurry takes time</i></p>";
echo "</div>";

echo "</div>";

//print_r($array_beopari[0]);
?>
<div id = 'baardana_detail' style = 'width:850px;padding:10px;border-radius:20px;'>
	
</div>
