<?php
$sno = $_REQUEST["sno"];
$ledger_type = $_REQUEST["ledger_type"];
?>
<style>
	.lisst
	{
		color:navy;
	}
	.tabs
	{
		text-decoration:none;cursor:pointer;background-color:white;padding:6px;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:1px;text-align:left;
	}
</style>
<script>
	
//function del()
//{
//	location.href = 'deleteitem.php?item_id='+item_id;
//}

</script>
<div id = "main-window" style = "width:850px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='ledgers.php';\">Back</span> <span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"add_ledger(".$sno.")\">Create New ".$ledger_type."</span><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" ><a href= 'ledger_type.php?sno=$sno&ledger_type=$ledger_type' >Print</a></span><br><hr>";
include 'con.php';
if($sno == 2)
{
	$arrayBalance = array();
	//$queryBalance = mysqli_query($con,"select receipt_detail.ledger_id as ledger_no , sum(amount)-(select sum(amount) from daybook where daybook.ledger_id = ledger_no)-opening_balance as balance from receipt_detail join ledgers on ledgers.ledger_id = receipt_detail.ledger_id where ledger_type = 2 group by receipt_detail.ledger_id");
	//$queryBalance = mysqli_query($con,"select daybook.ledger_id as ledger_no,sum(amount) - (select sum(amount) from receipt_detail where receipt_detail.ledger_id = ledger_no) as balance from daybook join ledgers on ledgers.ledger_id = daybook.ledger_id where ledger_type = 2 group by daybook.ledger_id");
	//$queryBalance = mysqli_query($con,"select ledgers.ledger_id as ledger_no ,IFNULL((select sum(amount) from receipt_detail where ledger_id = ledger_no),0) - IFNULL((select sum(amount) from daybook where ledger_id = ledger_no and transaction_type <> 5),0) - opening_balance as balance from ledgers where ledger_type = 2 group by ledgers.ledger_id");
	$queryBalance = mysqli_query($con,"select ledgers.ledger_id as ledger_no ,IFNULL((select sum(amount) from receipt_detail where ledger_id = ledger_no),0) - IFNULL((select sum(amount) from daybook where ledger_id = ledger_no and transaction_type <> 5 and transaction_type <> 8 and transaction_type <> 2),0) + IFNULL((select sum(amount) from daybook where ledger_id = ledger_no and transaction_type =8),0) - opening_balance as balance from ledgers where ledger_type = 2 group by ledgers.ledger_id");
	while($rowBalance = mysqli_fetch_array($queryBalance))
	{
		$ledger_no = $rowBalance['ledger_no'];
		$arrayBalance[$ledger_no] = $rowBalance['balance'];
//	$arrayBalance[$ledger_no]['sum_ins'] = $rowBalance['sum(installment)'];
// 	$arrayBalance[$ledger_no]['sum_rec'] = $rowBalance['sum(receipt_detail.amount)'];
	}
//$queryBalance = mysqli_query($con,"select ledger_id,sum(amount),ledger_details.installment from receipt_detail join ledgers using(ledger_id) join ledger_details using(ledger_id) group by ledger_id");
	$queryBalance = mysqli_query($con,"select ledger_id,sum(amount),ledger_details.installment from receipt_detail join ledgers using(ledger_id) join ledger_details using(ledger_id) where month(date) = (month(CURDATE()) -1) group by month(date),ledger_id order by ledger_id");
	while($rowins = mysqli_fetch_array($queryBalance))
	{
		$arrayBalanceCheck[$ledger_new_id][2]=0;
		$ledger_new_id = $rowins['ledger_id'];
		if($rowins['sum(amount)'] < $rowins['ledger_details.installment'])
		{
			$arrayBalanceCheck[$ledger_new_id][2] = 1;
		}
//	echo $rowins['ledger_id'];
//$arrayBalance[$ledger_new_id]['ins'] = $rowins['sum(installment)'];
//$arrayBalance[$ledger_new_id]['rec'] = $rowins['sum(amount)'];
//echo $arrayBalance[$ledger_new_id][]."<br>";
		$arrayBalanceCheck[$ledger_new_id][0] = $rowins['sum(amount)'];
		$arrayBalanceCheck[$ledger_new_id][1] = $rowins['ledger_details.installment'];
//echo $arrayBalanceCheck[$ledger_id]
	}
//print_r($arrayBalance);
	$query = mysqli_query($con,"select *,concat(ledger_tenure,ledgers.ledger_id) as account_no from ledgers join ledger_details on ledgers.ledger_id = ledger_details.ledger_id where ledger_type = '$sno'");
}
else
{
		$arrayBalance = array();
	//$queryBalance = mysqli_query($con,"select receipt_detail.ledger_id as ledger_no , sum(amount)-(select sum(amount) from daybook where daybook.ledger_id = ledger_no)-opening_balance as balance from receipt_detail join ledgers on ledgers.ledger_id = receipt_detail.ledger_id where ledger_type = 2 group by receipt_detail.ledger_id");
	//$queryBalance = mysqli_query($con,"select daybook.ledger_id as ledger_no,sum(amount) - (select sum(amount) from receipt_detail where receipt_detail.ledger_id = ledger_no) as balance from daybook join ledgers on ledgers.ledger_id = daybook.ledger_id where ledger_type = 2 group by daybook.ledger_id");
	$queryBalance = mysqli_query($con,"select ledgers.ledger_id as ledger_no , IFNULL((select sum(amount) from daybook where transaction_type = 1 and ledger_id = ledger_no),0) - IFNULL((select sum(amount) from daybook where transaction_type = 7 and ledger_id = ledger_no),0) + opening_balance as balance from ledgers where ledger_type = 1 group by ledgers.ledger_id;");
	while($rowBalance = mysqli_fetch_array($queryBalance))
	{
		$ledger_no = $rowBalance['ledger_no'];
		$arrayBalance[$ledger_no] = $rowBalance['balance'];
//	$arrayBalance[$ledger_no]['sum_ins'] = $rowBalance['sum(installment)'];
// 	$arrayBalance[$ledger_no]['sum_rec'] = $rowBalance['sum(receipt_detail.amount)'];
	}

//	$queryBalanceCreditor = mysqli_query($con,"");
	$query = mysqli_query($con,"select * from ledgers where ledger_type = '$sno'");
	
}

///////// general data for all ledgers type 1 and type 2
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;\">";
if($sno == 2){
echo "<tr><th class = \"lio\" style=\"\"><a style = \"text-decoration:none;cursor:pointer;background-color:white;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:0px;color:brown;\" >A/C#</th><th>Ledger Name</th><th>Father Name</th><th>Address</th><th>Phone</th><th>Cr/Dr</th><th>Balance</th></tr>";}
else{
//echo "<tr><td class = \"lio\" style=\"padding:1px;\"><a style = \"text-decoration:none;cursor:pointer;display:block;background-color:white;padding:6px;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:1px;color:brown;\" >Ledger Name</td><td class = \"lio\" style=\"padding:1px;\" colspan = '2'><a style = \"text-decoration:none;cursor:pointer;display:block;background-color:white;padding:6px;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:1px;color:brown;\" >Balance</a></td></tr>";
echo "<th>Ledger Id</th><th>Ledger Name</th><th>Cr/Dr</th><th>Balance</th>";
}

while($row = mysqli_fetch_array($query))
{
//	echo "<form action = \"editauthors.php\" method = \"post\" onsubmit = \"return submit_item(this)\">";
//echo "<input value = '".$row['author_id']."' name = 'author_id' style = 'display:none;'>";
//	echo "<tr>";
$tempLedgerId = $row['ledger_id'];
if($sno == 2)
{
//	echo $arrayBalanceCheck[$tempLedgerId][]
//		if($arrayBalanceCheck[$tempLedgerId][0] < $arrayBalanceCheck[$tempLedgerId][1])
if($arrayBalanceCheck[$tempLedgerId][2] == 1)
		echo "<tr style = 'color:red;background:red;' id = 'ledger".$row['ledger_id']."'>";
else
{
		echo "<tr style = '' id = 'ledger".$row['ledger_id']."' >";
	}
		echo "<td style = \"\" class= 'tabs'><a style = \"text-decoration:none;cursor:pointer;color:blue;font-weight:bold;background-color:white;padding:6px;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:0px;\" onclick = \"ledgerdetail(".$row['ledger_id'].",'".$row['ledger_name']."')\">".$row['account_no']."</a> </td><td class = 'tabs' style = 'font-weight:bold;'>".$row['ledger_name']."</td><td class = 'tabs' style = ''>".$row['father_name']."</td><td class = 'tabs'>".$row['address']."</td><td class = 'tabs'><span style = 'font-size:13px;'>".$row['phone_no']."</span><br><span style = 'font-size:13px;'>".$row['phone_sec']."</span></td><td class = 'tabs'>";
		if($arrayBalance[$tempLedgerId] >0)
		echo "Cr";
		else
		echo "Dr";
//		.$row['phone_no'].
		echo "</td><td class = 'tabs' style = 'text-align:right;'><span style = 'font-weight:bold;background:peachpuff;padding:3px;border-radius:9px;'>".$arrayBalance[$tempLedgerId]."</span></td></tr>";
	}
	else
	{
if($sno == 3)
{
			echo "<tr><td style = \"padding:1px;\"><a style = \"text-decoration:none;cursor:pointer;display:block;background-color:white;padding:6px;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:1px;\" onclick = \"ledgerdetail(".$row['ledger_id'].",'".$row['ledger_name']."')\">K ".$row['ledger_id']."</a> </td>";
		echo "<td style = \"padding:1px;\"><a style = \"text-decoration:none;cursor:pointer;display:block;background-color:white;padding:6px;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:1px;\" onclick = \"ledgerdetail(".$row['ledger_id'].",'".$row['ledger_name']."')\">".$row['ledger_name']."</a> </td>";
}
else
{		echo "<tr><td style = \"padding:1px;\"><a style = \"text-decoration:none;cursor:pointer;display:block;background-color:white;padding:6px;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:1px;\" onclick = \"ledgerdetail(".$row['ledger_id'].",'".$row['ledger_name']."')\">L ".$row['ledger_id']."</a> </td>";
		echo "<td style = \"padding:1px;\"><a style = \"text-decoration:none;cursor:pointer;display:block;background-color:white;padding:6px;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:1px;text-align:left;\" onclick = \"ledgerdetail(".$row['ledger_id'].",'".$row['ledger_name']."')\">".$row['ledger_name']."</a> </td>";
}
echo "		<td class = 'tabs' style = 'text-align:right;'>";
		if($arrayBalance[$tempLedgerId] < 0)
		echo "Dr";
		else
		echo "Cr";
		echo "</td><td class = 'tabs' style = 'text-align:right;'><span style = 'background:peachpuff;padding:3px;border-radius:9px;'>".$arrayBalance[$tempLedgerId]."</span></td></tr>";
	}
//	echo "</tr>";
//echo "<td><input type = \"button\" value = 'save' onclick = \"editauthor(".$row['author_id'].");\"/></td><td><input type = 'button' value = 'delete'/></td></tr>";
//echo "</form>";

	//echo "<tr><td><span class = \"lisst\">type</span></td><td><input id = \"type_item\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['type']."\" onkeydown = \"if(event.keyCode == 13) savves(".$cat_id.",'".$cat_name."',".$itemm_id.");\"/></td></tr>";

}
echo "</table>";
?>

</div>
