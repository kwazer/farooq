<style>
	th
	{
		font-weight:normal;
		color:brown;
		
	}
	td
	{
		text-align:center;
	}
	#sub_main
	{
		width:820px;
		margin:0 auto;
		border:1px solid brown;
		padding:15px;
		border-radius:10px;
		background:white;
	}
	input
	{
//		width:200px;
		
	}
</style>
<div id = "sub_main" >
<!--	<ul style="width:780;list-style:none;background-color:peachpuff;padding:10px;color:grey;border-bottom:3px solid grey;margin:-1px auto;border-top:0px solid grey;">
		<li style = "display:inline;margin:0px 10px;"><a href="index.php" style = "text-decoration:none;color:grey;">Home</a></li>
		<li style = "display:inline;margin:0px 10px;"><a href="ledgers.php" style = "text-decoration:none;color:grey;">Ledgers</a></li>
		<li style = "display:inline;margin:0px 10px;">Index</li>
		<li style = "display:inline;margin:0px 10px;">Index</li>
		
	</ul><br>-->
<?php
$led_id = $_GET["led_id"];
$led_name = $_GET["led_name"];
$type_id = $_REQUEST["type_id"];
?>
<script>
	var led_id = <?php echo $led_id;?>;
	function ledgerentry()
	{
		var cash_reci = document.getElementById("cash_reci").value;
		var bill_id = document.getElementById("bill_id").value;
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				location.reload();
			}
		}
		xmlhttp.open("GET","ledgerentry.php?led_id="+led_id+"&cash_reci="+cash_reci+"&bill_id="+bill_id,true);
		xmlhttp.send();
	}
	function del_led_entry(entry_ser)
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				location.reload();
			}
		}
		xmlhttp.open("GET","deledentry.php?entry_ser="+entry_ser,true);
		xmlhttp.send();	
	}
	function deleteledger()
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				location.href = "ledgers.php";
			}
		}
		xmlhttp.open("GET","deleteledger.php?led_id="+led_id,true);
		xmlhttp.send();
	}
	
var table_index = new Array();

var previous_row_no;
	function insert_details(row_number,sno,type_id)
	{
		var view_table = document.getElementById("view_table");
//		alert("it works");
//		alert(row_number);
//alert(sno);	
		if(table_index.includes(row_number))
		{
			var locationIndex = table_index.indexOf(row_number);
			table_index.splice(locationIndex,1);
			row_number = row_number + 1;
			view_table.deleteRow(row_number);
					for(var i=0,len=table_index.length;i<len;i++)
		{
			if(table_index[i] > row_number)
			{
				table_index[i] = table_index[i] - 1;
			}
		}

		}
		else
	{
if(type_id == 3 || type_id == 1)
{
	table_index.push(row_number);

	var target = view_table.rows[row_number];
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{

	if(xhr.readyState == 4 && xhr.status == 200)
	{
		var new_element = document.createElement("tr");
		//new_element.style.display = "block";
		var new_column = document.createElement("td");
		new_column.innerHTML = xhr.responseText;
//		if(g_type_id == 1)
		new_column.colSpan = "7";
//		else
//		new_column.colSpan = "4";
		new_element.appendChild(new_column);
		previous_row_no = row_number;
		target.parentNode.insertBefore(new_element, target.nextSibling);
	}
	}
	xhr.open("GET","view_details.php?sno="+sno+"&type_id="+type_id,true);
	xhr.send();
		
		for(var i=0,len=table_index.length;i<len;i++)
		{
			if(table_index[i] > row_number)
			{
				table_index[i] = table_index[i] + 1;
			}
		}
}
}

	}

function insert_detail(row_number,sno,type_id)
	{
		var view_table = document.getElementById("view_purchase");
		
//		alert(row_number);
//alert(type_id);	
		if(table_index.includes(row_number))
		{
			var locationIndex = table_index.indexOf(row_number);
			table_index.splice(locationIndex,1);
			row_number = row_number + 1;
			view_table.deleteRow(row_number);
					for(var i=0,len=table_index.length;i<len;i++)
		{
			if(table_index[i] > row_number)
			{
				table_index[i] = table_index[i] - 1;
			}
		}

		}
		else
	{

//		table_index[] = row_number;
table_index.push(row_number);
//		if(previous_row_no != "")
//		{
//			var deleter_row = previous_row_no + 1;
			
//			view_table.deleteRow(deleter_row);
//		}
//		alert(view_table.rows[row_number].innerHTML);
if(type_id != 4 && type_id != 5 && type_id != 6)
{
	var target = view_table.rows[row_number];
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{

	if(xhr.readyState == 4 && xhr.status == 200)
	{
		var new_element = document.createElement("tr");
		//new_element.style.display = "block";
		var new_column = document.createElement("td");
		new_column.innerHTML = xhr.responseText;
//		if(g_type_id == 1)
		new_column.colSpan = "7";
//		else
//		new_column.colSpan = "4";
		new_element.appendChild(new_column);
		previous_row_no = row_number;
		target.parentNode.insertBefore(new_element, target.nextSibling);
	}
	}
	xhr.open("GET","view_details.php?sno="+sno+"&type_id="+type_id,true);
	xhr.send();
		
		for(var i=0,len=table_index.length;i<len;i++)
		{
			if(table_index[i] > row_number)
			{
				table_index[i] = table_index[i] + 1;
			}
		}
}
}
//else
//{
//	alert("in array already");
//}		

	}

</script>
<?php
include 'con.php';
if($type_id == 2)
{
		$pre_total = 0;
	$query_pre_total = mysqli_query($con,"select IFNULL((select sum(amount) from receipt_detail where ledger_id = $led_id),0) - IFNULL((select sum(amount) from daybook where ledger_id = $led_id and transaction_type <> 5 and transaction_type <> 8 and transaction_type <> 2),0) + IFNULL((select sum(amount) from daybook where ledger_id = $led_id and transaction_type =8),0) - opening_balance as balance from ledgers where ledger_type = 2 and ledger_id = $led_id");
	while($pre_row = mysqli_fetch_array($query_pre_total))
	{
		$pre_total = $pre_row['balance'];
	}

	$array_directions = array();
$queryDirection = mysqli_query($con,"(select ledger_id,ledger_name from ledgers where ledger_type = 2 and ledger_id < $led_id order by ledger_id desc limit 1) union (select ledger_id,ledger_name from ledgers where ledger_type = 2 and ledger_id > $led_id order by ledger_id asc limit 1)");
while($rowDirection = mysqli_fetch_array($queryDirection))
{
	$array_directions[] = $rowDirection; 
}
//print_r($array_directions);
$queryLedger = mysqli_query($con,"select *,DATE_FORMAT(ledger_date,'%d-%m-%Y') as ledger_date from ledger_details join ledgers using(ledger_id) where ledger_id = $led_id");
while($rowLed = mysqli_fetch_array($queryLedger))
{
	
$opening_bal = $rowLed['opening_balance'] ;
$ledger_date = $rowLed['ledger_date'];
$folio = $rowLed['folio'];
echo "<span style = 'color:grey;border:1px solid grey;padding:3px;margin:3px;border-radius:3px;' onclick = 'ledger_types(g_ledger,g_ledger_type,".$led_id.")'> <= Back</span>";
echo "<span style = 'color:grey;border:1px solid grey;padding:3px;margin:3px;border-radius:3px;' ><a href='ledgerdetail.php?led_id=$led_id&led_name=$led_name&type_id=$type_id'>Print</a></span>";
echo "<p style = 'text-align:center;color:blue;font-size:18px;'><span style = ''><span style = 'border:1px solid grey;padding:4px;border-radius:5px;margin-right:5px;color:brown;font-size:12px;' onclick = \"ledgerdetail(".$array_directions[0][0].",'".$array_directions[0][1]."')\"> < Previous</span>A/C No :  </span><span>".$rowLed['ledger_tenure']." <span>".$led_id."</span><span style = 'border:1px solid grey;padding:4px;border-radius:5px;margin-left:5px;color:brown;font-size:12px;' onclick = \"ledgerdetail(".$array_directions[1][0].",'".$array_directions[1][1]."')\">Next ></span></span></p>";


echo "<big style = \"font-weight:bold;color:brown;width:600px;border-bottom:0px solid brown;text-align:right;letter-spacing:1px;text-transform:capitalize;font-size:23px;\"><span><span  style = 'float:right;font-size:15px;'><span style = 'font-size:13px;'>Guarantor : ".$rowLed['guarantor']."</span><br><span>".$rowLed['phone_2']."</span><br><span>".$rowLed['gp2']."</span></span><span style = 'color:navy;'>".$led_name."</span><br><span style = 'font-size:15px;'><span>S/o ".$rowLed['father_name']."</span><br><span>Address : ".$rowLed['address']."</span><br><span style = 'color:red;'>".$rowLed['phone_no']."</span> <span style = 'margin-left:50px;color:red;'>".$rowLed['phone_sec']."</span><br><span >Installment Amount : </span><span style = ''>".$rowLed['installment']."</span></span></big><br>";
$note = $rowLed['narration'];
//echo "<span style=\"font-size:12px;color:brown;\">Note: press Enter to save changes</span><br>";

}
}
if($type_id == 1)
{
	$query_ledger = mysqli_query($con,"select *,DATE_FORMAT(ledgers.ledger_date,'%d-%m-%Y') as led_date from ledgers join ledger_type on ledgers.ledger_type = ledger_type.sno where ledger_id = $led_id");
	while($row_creditor = mysqli_fetch_array($query_ledger))
	{
		$opening_bal = $row_creditor['opening_balance'];
		$cr_ledger_date = "00-00-0000";
		$cr_ledger_date = $row_creditor['led_date'];
	//	$ledger_date = $row_creditor['ledger_date'];
//		echo $row_creditor['ledger_date'];
		echo "<p style = 'text-align:center;'><big style = 'color:red;'><span> Ledger ID : L ".$row_creditor['ledger_id']."</span></big></p><p><big style = 'color:red;'>".$row_creditor['ledger_name']."</big><br> Acc No: <u>".$row_creditor['account']."</u></p>";
		//echo "<big>Opening Balance :".$opening_bal."</big><big>Ledger Date :".$ledger_date."</big></p>";
	}
}
if($type_id == 3)
{
	$query_ledger = mysqli_query($con,"select *,DATE_FORMAT(ledgers.ledger_date,'%d-%m-%Y') as led_date from ledgers join ledger_type on ledgers.ledger_type = ledger_type.sno where ledger_id = $led_id");
	while($row_creditor = mysqli_fetch_array($query_ledger))
	{
		$opening_bal = $row_creditor['opening_balance'];
		$cr_ledger_date = "00-00-0000";
		$cr_ledger_date = $row_creditor['led_date'];
	//	$ledger_date = $row_creditor['ledger_date'];
//		echo $row_creditor['ledger_date'];
		echo "<p style = 'text-align:center;'><big style = 'color:navy;'><span> Ledger ID : K ".$row_creditor['ledger_id']."</span></big></p><p><big style = 'color:navy;font-weight:bold;'>".$row_creditor['ledger_name']."<br>".$row_creditor['sides']."</big></p>";
		//echo "<big>Opening Balance :".$opening_bal."</big><big>Ledger Date :".$ledger_date."</big></p>";
	}
}
echo "<br>";
echo "<span style=\"float:right;padding:2px;margin-left:5px;cursor:pointer;border:1px solid grey;background:lightgreen;\" onclick = \"editledger(".$led_id.",'".$led_name."')\" >Edit</span><span style=\"float:right;padding:2px;background:lightgreen;border:1px solid grey;\" onclick = \"deleteledger()\" >Delete</span></br><br>";
//echo "<p><span>Cash received : </span><input autofocus type=\"text\" id = \"cash_reci\"/><span style = \"margin-left:20px;\">Narration : </span><input type=\"text\" id=\"bill_id\" onkeypress=\"if(event.keyCode==13)ledgerentry()\"/></p>";

//$con = mysqli_connect("localhost","root","password","kapoor"); 
if($type_id == 3)
$query = mysqli_query($con,"select *,narration as criti,(select transaction_type from daybook where sno = criti) as tran_type from daybook join ledgers on ledgers.ledger_id = daybook.ledger_id where daybook.ledger_id = $led_id and type_id <> 5");
if($type_id == 2)
//$query = mysqli_query($con,"select sum(amount) From receipt_detail join ledgers.ledger_id = receipt_detail.ledger_id where ledgers.ledger_id = $led_id");
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
				echo "<tr onclick = 'insert_details(this.rowIndex,".$roc[transaction_id].",".$roc[type_id].");'><td>".$roc[date]."</td><td>".$roc[type_name]."</td><td>".$roc[transaction_id]."</td><td style = 'font-size:13px;'>".$roc[narration]."</td><td></td><td style = 'color:blue;text-align:right;'>".$roc[amount]."</td>";

				$rocSum = $rocSum + $roc[amount];
				$crsum = $crsum + $roc[amount];
				echo "<td style = 'text-align:right;'>".number_format((float)$rocSum, 2, '.', '')."</td></tr>";
}				
				else
				{
				echo "<tr onclick = 'insert_details(this.rowIndex,".$roc[transaction_id].",".$roc[type_id].");'><td>".$roc[date]."</td><td>".$roc[type_name]."</td><td>".$roc[transaction_id]."</td><td style = 'font-size:13px;'>".$roc[narration]."</td><td style = 'color:blue;text-align:right;'>".$roc[amount]."</td><td></td>";

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


/////////////////////////////////////////////////
else
{
//$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date,sum(amount) as total from daybook join ledgers on ledgers.ledger_id = daybook.ledger_id join transaction_type on daybook.transaction_type = transaction_type.type_id where daybook.ledger_id = $led_id group by fund_flow,month(date),year(date)");
$query = mysqli_query($con,"select *, DATE_FORMAT(date,'%d-%m-%Y') as date From daybook join ledgers using (ledger_id) join transaction_type on transaction_type.type_id = daybook.transaction_type where ledger_id = $led_id order by daybook.date");
}
////////////////////////////////////
if($type_id == 2)
{
	foreach($array_group as $groups)
	{
		echo "<details><summary>";
//		echo "<table style = 'width:100%;'>";
		//echo "<tr><th>Year</th><th>Month</th><th>Amount</th></tr>";
		echo "<span style = 'margin:10px;width:300px;border:1px solid grey;letter-spacing:2px;font-size:16px;color:brown;'><span>".$groups[month]."/".$groups[year]."</span><span style = 'margin-left:5px;color:blue;'> Amount: ".$groups[amount]."</span></span>";
		
//		echo "</table>";
		echo "</summary>";
		$querySetVariable= mysqli_query($con,"set @csum := 0");
$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date,(@csum := @csum + amount) as cumulative_sum from receipt_detail where ledger_id = '$led_id' and month(date) = ".$groups[month]." and year(date) = ".$groups[year]." order by date");

		echo "<table border = \"1\" style = \"border-collapse:collapse;width:100%;border:0px;\" id = 'view_table'>";

echo "<th>Date</th><th>Alpha Serial</th><th>Receipt No</th><th>Narration</th><th>Amount</th><th>Cumulative Sum</th>";
	while($row = mysqli_fetch_array($query))
	{
		echo "<tr><td>".$row['date']."</td><td>".$row['alpha_serial']."</td><td>".$row['receipt_no']."</td><td style = 'font-size:13px;'>".$row['narration']."</td><td>".$row['amount']."</td><td>".$row['cumulative_sum']."</td></tr>";
	}
	echo "</table></details>";
}

}

////////////////////////////////////// ledger for sundry creditors
else
{
	echo "<table border = \"1\" style = \"border-collapse:collapse;width:100%;border:0px;\" id = 'view_purchase' >";

//echo "<th>Narration</th><th>Date</th><th>Transaction</th><th>Details </th><th>credit</th><th>Debit</th><th>Total</th>";
echo "<th>Date</th><th>transaction</th><th># No</th><th>Bill No</th><th>Debit</th><th>Credit</th><th>Balance</th>";

if($opening_bal > 0){
	$rumSum = $rumSum + $opening_bal;
echo "<tr><td>".$cr_ledger_date."</td><td>Opening Balance</td><td></td><td></td><td> </td><td style = 'text-align:right;'>$opening_bal</td><td style = 'text-align:right;'>".$opening_bal." Cr</td></tr>";
}
else{
	$rumSum = $rumSum - $opening_bal;
echo "<tr><td>".$cr_ledger_date."</td><td>Opening Balance</td><td></td><td></td><td style = 'text-align:right;'/>$opening_bal</td><td></td><td style  = 'text-align:right;'>".$opening_bal." Dr</td></tr>";
}
while($row = mysqli_fetch_array($query))
{
//	echo "<tr onclick = 'insert_details(this.rowIndex,".$row['transaction_id'].",".$row['type_id'].");'><td>".$row['date']."</td><td>".$row['narration']."</td> <td style = 'text-align:right;'>";if($row['tran_type'] == 4)echo "Receipt";if($row['tran_type'] == 6)echo "Loan";if($row['tran_type'] == 3)echo "Sale";else echo "Payment"; echo"</td><td style = 'text-align:left;'>"; 
if($row['type_id'] == 1){
	$rumSum = $rumSum + $row['amount'];
	echo "<tr onclick = 'insert_detail(this.rowIndex,".$row['transaction_id'].",".$row['type_id'].");'><td>".$row['date']."</td><td>".$row['type_name']."</td> <td style = 'text-align:right;'>".$row['transaction_id'];
	echo"</td><td style = 'font-size:13px;'>".$row['narration']."</td><td></td><td style = 'text-align:right;'>".$row['amount']."</td>";
if($rumSum  > 0)
	echo "<td style = 'text-align:right;'>".sprintf("%.2f", $rumSum)." Cr</td>"; 
	else
	echo "<td style = 'text-align:right;'>".sprintf("%.2f", $rumSum)." Dr</td>"; 
	}
if($row['type_id'] == 7){
	if($type_id == 3)
	{
	$rumSum = $rumSum + $row['amount'];
	echo "<tr ><td>".$row['date']."</td><td>".$row['type_name']."</td> <td style = 'text-align:right;'>".$row['transaction_id'];
	echo"</td><td style = 'font-size:13px;'>".$row['narration']."</td><td style = 'text-align:right;'></td><td style = 'text-align:right;'>".$row['amount']."</td>"; 
if($rumSum  > 0)
	echo "<td style = 'text-align:right;'>".sprintf("%.2f", $rumSum)." Cr</td>"; 
	else
	echo "<td style = 'text-align:right;'>".sprintf("%.2f", $rumSum)." Dr</td>"; 
}
else
{	$rumSum = $rumSum - $row['amount'];
	echo "<tr ><td>".$row['date']."</td><td>".$row['type_name']."</td> <td style = 'text-align:right;'>".$row['transaction_id'];
	echo"</td><td style = 'font-size:13px;'>".$row['narration']."</td><td style = 'text-align:right;'>".$row['amount']."</td><td></td>"; 
if($rumSum  > 0)
	echo "<td style = 'text-align:right;'>".sprintf("%.2f", $rumSum)." Cr</td>"; 
	else
	echo "<td style = 'text-align:right;'>".sprintf("%.2f", $rumSum)." Dr</td>"; 
}
	}
	if($row['type_id'] == 18)
	{
		$rumSum = $rumSum - $row['amount'];
	echo "<tr ><td>".$row['date']."</td><td>".$row['type_name']."</td> <td style = 'text-align:right;'>".$row['transaction_id'];
	echo"</td><td style = 'font-size:13px;'>".$row['narration']."</td><td style = 'text-align:right;'>".$row['amount']."</td><td></td>"; 
if($rumSum  > 0)
	echo "<td style = 'text-align:right;'>".sprintf("%.2f", $rumSum)." Cr</td>"; 
	else
	echo "<td style = 'text-align:right;'>".sprintf("%.2f", $rumSum)." Dr</td>"; 
	}
	
//	if(isset($row['amount']))
/*if($type_id == 3)
echo $row['ledger_name'];
else
	echo "<a style=\"text-decoration:none;color:grey;\"href=\"billreport.php?bill_no=".$row['transaction_id']."\"># ".$row['transaction_id']."</a>"; 
	
//	else 
//	echo "<span style = \"color:grey;\">".$row['bill_id']."</span>";
if($type_id == 1)
{
if($row['type_id'] == 1)	
	echo "</td><td></td><td style = 'text-align:right;'>".$row['amount']."</td><td>".$row['total']."</td>";
if($row['type_id'] == 5)
	echo "</td><td style = 'text-align:right;'>".$row['amount']."</td><td></td><td>".$row['total']."</td>";
}
if($type_id == 2)

{
if($row['type_id'] == 4)	
	echo "</td><td></td><td style = 'text-align:right;'>".$row['amount']."</td><td>".$row['total']."</td>";
if($row['type_id'] == 3 || $row['type_id'] == 6)
	echo "</td><td style = 'text-align:right;'>".$row['amount']."</td><td></td><td>".$row['total']."</td>";
}
if($type_id == 3)
{
if($row['tran_type'] == 4)
	echo "</td><td style = 'text-align:right;'>".$row['amount']."</td><td></td><td>".$row['total']."</td>";

if($row['tran_type'] == 5)	
	echo "</td><td></td><td style = 'text-align:right;'>".$row['amount']."</td><td>".$row['total']."</td>";

}
if($type_id == 4)
{
	echo "</td><td style = 'text-align:right;'>".$row['amount']."</td><td></td><td>".$row['total']."</td>";
	
}
*/
//	echo "<td>";
//	if(isset($row['cash_reci']))
//	echo "<span style = \"cursor:pointer;color:brown;font-size:13px;\" onclick = \"del_led_entry(".$row['entry_ser'].")\">Delete</span>";
//	echo "</td>";
	echo "</tr>";
	
}
if($rumSum >0)
echo "<tr><td colspan = '5'></td><td style = 'color:red;font-weight:bold;'>Total</td><td style = 'color:red;text-align:right;font-weight:heavy;'><hr> ".sprintf("%.2f", $rumSum)." Cr</td></tr>";
else
echo "<tr><td colspan = '5'></td><td style = 'color:blue;font-weight:bold;'>Total</td><td style = 'color:blue;text-align:right;font-weight:heavy;'>".sprintf("%.2f", $rumSum)." Dr</td></tr>";
echo "</table>";
}

?>
</div>
