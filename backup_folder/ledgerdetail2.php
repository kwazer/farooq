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
		width:700px;
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
<div id = "sub_main">
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
	
</script>
<?php
echo "<big style = \"color:brown;float:right;width:400px;border-bottom:1px solid brown;text-align:right;letter-spacing:4px;text-transform:capitalize;font-size:23px;\">".$led_name."</big><br>";
//echo "<span style=\"font-size:12px;color:brown;\">Note: press Enter to save changes</span><br>";
echo "<br>";
echo "<span style=\"float:right;margin-left:5px;cursor:pointer;\" onclick = \"editledger(".$led_id.",'".$led_name."')\" >Edit</span><span style=\"float:right;\" onclick = \"deleteledger()\" >Delete</span></br><br>";
//echo "<p><span>Cash received : </span><input autofocus type=\"text\" id = \"cash_reci\"/><span style = \"margin-left:20px;\">Narration : </span><input type=\"text\" id=\"bill_id\" onkeypress=\"if(event.keyCode==13)ledgerentry()\"/></p>";
include 'con.php';
//$con = mysqli_connect("localhost","root","password","kapoor"); 
if($type_id == 3)
$query = mysqli_query($con,"select *,narration as criti,(select transaction_type from daybook where sno = criti) as tran_type from daybook join ledgers on ledgers.ledger_id = daybook.ledger_id where daybook.ledger_id = $led_id");
else
$query = mysqli_query($con,"select *,sum(amount) as total from daybook join ledgers on ledgers.ledger_id = daybook.ledger_id join transaction_type on daybook.transaction_type = transaction_type.type_id where daybook.ledger_id = $led_id group by fund_flow,month(date),year(date)");
echo "<table border = \"1\" style = \"border-collapse:collapse;width:100%;border:0px;\" id = 'view_table'>";
echo "<th>Narration</th><th>Date</th><th>Transaction</th><th>Details </th><th>credit</th><th>Debit</th><th>Total</th>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr onclick = 'insert_details(this.rowIndex,".$row['transaction_id'].",".$row['type_id'].");'><td>".$row['date']."</td><td>".$row['narration']."</td> <td style = 'text-align:right;'>";if($row['tran_type'] == 4)echo "Receipt";if($row['tran_type'] == 6)echo "Loan";if($row['tran_type'] == 3)echo "Sale";else echo "Payment"; echo"</td><td style = 'text-align:left;'>"; 
//	if(isset($row['amount']))
if($type_id == 3)
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

//	echo "<td>";
//	if(isset($row['cash_reci']))
//	echo "<span style = \"cursor:pointer;color:brown;font-size:13px;\" onclick = \"del_led_entry(".$row['entry_ser'].")\">Delete</span>";
//	echo "</td>";
	echo "</tr>";
}

?>
</table>
</div>
