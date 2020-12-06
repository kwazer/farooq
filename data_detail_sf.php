<?php 
function data_detail_sf()
{
	echo "<span style = 'color:brown;width:600px;float:left;color:blue'>Note: <span style= 'color:navy;'>".$note."</span></span>";
	if($pre_total > 0)
	echo "<h3 style = 'color:grey;font-weight:normal;letter-spacing:1px;background:peachpuff;padding:5px;border-radius:5px;'>Loans and Sales<span style = 'float:right;color:blue;font-weight:bold;'>Cr $pre_total</span></h3>";
	else
	echo "<h3 style = 'color:grey;font-weight:normal;letter-spacing:1px;background:peachpuff;padding:5px;border-radius:5px;'>Loans and Sales<span style = 'float:right;color:red;font-weight:bold;'>Dr $pre_total</span></h3>";
	echo "<table  style = 'width:100%;' id = 'view_table'>";
	echo "<th>Date</th><th>Transaction</th><th># No</th><th>Bill/Receipt No</th><th>Debit</th><th>Credit</th><th>Balance</th>";
	echo "<tr><td>".$ledger_date."</td><td>Opening Balance</td><td></td><td>$folio</td>";
	if($opening_bal > 0)
	
	echo "<td style = 'text-align:right;'>$opening_bal</td><td></td>";
	else
	echo "<td></td><td style = 'text-align:right;'>$opening_bal</td>";
	echo "<td style = 'text-align:right;'>".$opening_bal."</td></tr>";
	$arrayCumulative = array();
	$querySetCumsum = mysqli_query($con,"set @bsum:= 0");
	$queryCredit = mysqli_query($con,"select narration,type_id,DATE_FORMAT(date,'%d-%m-%Y') as date,type_name,month(date) as month, year(date) as year ,amount,transaction_id, (@bsum := @bsum + amount) as csum from daybook join transaction_type on transaction_type.type_id = daybook.transaction_type where ledger_id = '$led_id' and type_id <> 5 and transaction_type <> 2");
//	$queryCredit = mysqli_query($con,"select * from daybook join transaction_type on transaction_type.type_id = daybook.transaction_type where ledger_id = '$led_id'");
$x=0;
	while($rowCu = mysqli_fetch_array($queryCredit))
	{
//		echo "test";
//$arrayCumulative[] = $rowCu;

		$arrayCumulative[$x][type_id] = $rowCu['type_id'];
		$arrayCumulative[$x][date] = $rowCu['date'];
		$arrayCumulative[$x][type_name] = $rowCu['type_name'];
		$arrayCumulative[$x][narration] = $rowCu['narration'];
		
		$arrayCumulative[$x][amount] = $rowCu['amount'];
		$arrayCumulative[$x][transaction_id] = $rowCu['transaction_id'];
//		if($x = 0)
//		$arrayCumulative[$x][csum] = $arrayCumulative[$x][amount];
		
//		else
//		$arrayCumulative[$x][csum] = $prev_amount + $arrayCumulative[$x][amount];
		
		$prev_amount = $rowCu['amount'];
//		echo "<tr><td>".$rowCu['date']."</td><td>".$rowCu['type_name']."</td><td>".$rowCu['transaction_id']."</td><td>".$rowCu['amount']."</td><td>".$rowCu['csum']."</td></tr>";
		$x = $x + 1;
	}
		////////////////////////////////
	$array_group = array();
	$queryMonthGroups = mysqli_query($con,"select DATE_FORMAT(date,'%d-%m-%Y') as date,'receipt' as type_name, month(date) as month,year(date) as year,sum(amount) as amount , 'none' as transaction_id,'none' as csum from receipt_detail where ledger_id = '$led_id' group by month(date),year(date) order by receipt_detail.date desc");
	while($rowGroup = mysqli_fetch_array($queryMonthGroups))
	{
		
		$arrayCumulative[$x][type_id] = 4;
		$arrayCumulative[$x][date] = $rowGroup['date'];
		$arrayCumulative[$x][type_name] = 'receipt';
		$arrayCumulative[$x][amount] = $rowGroup['amount'];
		$arrayCumulative[$x][narration] = "" ;
		
		$arrayCumulative[$x][transaction_id] = $rowGroup['month']."/".$rowGroup['year'];
		
		$x = $x + 1;
//	$arrayCumulative[] = $rowGroup;	
		$array_group[] = $rowGroup;
	}
	function date_compare($a, $b)
{
    $t1 = strtotime($a['date']);
    $t2 = strtotime($b['date']);
    return $t1 - $t2;
}    
usort($arrayCumulative, 'date_compare');
$rocSum = $rocSum - $opening_bal;
$debsum = 0;
$crsum = 0;
if($rocSum < 0)
$debsum = $debsum + $opening_bal;
else
$crsum = $crsum + $opening_bal;

	foreach($arrayCumulative as $roc)
	{
		//$cumsum = $roc[amount] + $cumsum;
		if($roc[type_name] == 'receipt')
		{
				echo "<tr><td>".$roc[date]."</td><td>".$roc[type_name]."</td><td>".$roc[transaction_id]."</td><td></td><td></td><td style = 'text-align:right;'>".$roc[amount]."</td>";
//				if($rocSum == 0)
//				{
				$rocSum = $rocSum + $roc[amount];
				$crsum = $crsum + $roc[amount];
				echo "<td style = 'text-align:right;'>".number_format((float)$rocSum, 2, '.', '')."</td></tr>";
//			}
//			else
//			{
//				echo "<td>".$roc[amount]."</td></tr>";
//			}
				
			}
			else
			{
				if($roc[type_name] == 'debit loan')
				{
				echo "<tr onclick = 'insert_details(this.rowIndex,".$roc[transaction_id].",".$roc[type_id].");'><td>".$roc[date]."</td><td>".$roc[type_name]."</td><td>".$roc[transaction_id]."</td><td>".$roc[narration]."</td><td></td><td style = 'color:blue;text-align:right;'>".$roc[amount]."</td>";

				$rocSum = $rocSum + $roc[amount];
				$crsum = $crsum + $roc[amount];
				echo "<td style = 'text-align:right;'>".number_format((float)$rocSum, 2, '.', '')."</td></tr>";
}				
				else
				{
				echo "<tr onclick = 'insert_details(this.rowIndex,".$roc[transaction_id].",".$roc[type_id].");'><td>".$roc[date]."</td><td>".$roc[type_name]."</td><td>".$roc[transaction_id]."</td><td>".$roc[narration]."</td><td style = 'color:blue;text-align:right;'>".$roc[amount]."</td><td></td>";

				$rocSum = $rocSum - $roc[amount];
				$debsum = $debsum + $roc[amount];
				echo "<td style = 'text-align:right;'>".number_format((float)$rocSum, 2, '.', '')."</td></tr>";
}
				
			}
					

	}
	
if($rocSum > 0){
//	$rocSum = $rocSum * -1;
	echo "<tr><td></td><td></td><td></td><td style = 'color:red;border-top-style:solid;border-color:black;border-width:1px;border-bottom-style:solid;'> Total </td><td style = 'color:black;border-top-style:solid;border-color:black;border-width:1px;border-bottom-style:solid;text-align:right;'>".number_format((float)$debsum, 2, '.', '')."</td><td style = 'text-align:right;color:black;border-top-style:solid;border-color:black;border-width:1px;border-bottom-style:solid;'>".number_format((float)$crsum, 2, '.', '')."</td><td style = 'font-weight:bold;color:blue;border-top-style:solid;border-color:black;border-width:1px;border-bottom-style:solid;text-align:right;'>Cr ".number_format((float)$rocSum, 2, '.', '')." </td></tr>";}
	else
{
	echo "<tr><td></td><td></td><td></td><td style = 'color:red;border-top-style:solid;border-color:black;border-width:1px;border-bottom-style:solid;'> Total </td><td style = 'color:black;border-top-style:solid;border-color:black;border-width:1px;border-bottom-style:solid;text-align:right;'>".number_format((float)$debsum, 2, '.', '')."</td><td style = 'text-align:right;color:black;border-top-style:solid;border-color:black;border-width:1px;border-bottom-style:solid;'>".number_format((float)$crsum, 2, '.', '')."</td><td style = 'font-weight:bold;color:red;border-top-style:solid;border-color:black;border-width:1px;border-bottom-style:solid;text-align:right;'>Dr ".number_format((float)$rocSum, 2, '.', '')." </td></tr>";
}
	echo "</table>";
	
//	print_r($arrayCumulative);
		echo "<br><hr><h3 style = 'letter-spacing:1px;color:grey;font-weight:normal;background:peachpuff;padding:5px;border-radius:5px;'>Payments</h3>";

}
?>
