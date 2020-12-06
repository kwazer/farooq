<html>
	<body>
		<div style = "width:750px;margin:0 auto;"> 
			<style>
				.oper
				{
					color:olive;
				}
				td
				{
					vertical-align:center;
					text-align:center;
					font-size:15px;
					padding:5px;
				}
				th
				{
					font-weight:normal;
					color:brown;
				}
				
				a 
				{
					text-decoration:none;
					color:inherit;
				}
				.item_list:hover
				{
					color:red;
				}
				

			</style>
<?php 
$cat_id = $_GET["cat_id"];
$cat_name = $_GET["cat_name"];

echo "<div style = \"background:white;padding:10px;text-transform:capitalize;border:0px solid black;width:730px;border-radius:10px 10px 0px 0px;\"><big style = \"font-size:28px;color:grey;letter-spacing:2px;\">".$cat_name."</big>";
//echo "<a style = \"text-decoration:none;color:brown;\" href = \"additem.php?cat_id=".$cat_id."&cat_name=".$cat_name."\"><span style = \"margin-left:10px;border:0px solid black;padding:3px;\">Add Item</span></a><hr></div>";
echo "<a style = \"text-decoration:none;color:brown;\" onclick = \"add_item(".$cat_id.",'".$cat_name."')\"><span style = \"margin-left:10px;border:0px solid black;padding:3px;cursor:pointer;\">Issue Receipt Book</span></a><a style = \"text-decoration:none;color:brown;\" href='backrunners.php?cat_id=$cat_id&cat_name=$cat_name'><span style = \"margin-left:10px;border:0px solid black;padding:3px;cursor:pointer;\">Print</span></a><a style = \"text-decoration:none;color:brown;\" href='emi_setting.php'><span style = \"margin-left:10px;border:0px solid black;padding:3px;cursor:pointer;\">Back</span></a><hr></div>";
include 'con.php';
//$con = mysqli_connect("localhost","root","password","shop");
$query = mysqli_query($con,"select *,book_issue.book_id  as book_no from book_issue join receipt_books on receipt_books.book_id = book_issue.book_id where runner_id = $cat_id");
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;background:ivory;padding:5px;border-radius:0px 0px 10px 10px;\">";
echo "<th>Book Id</th><th>alpha Serial</th><th>Begin</th><th>Book End</th><th>Issue Date</th><th>Receipt Date</th><th>Confirm</th>";
while($row = mysqli_fetch_array($query))
{
/*	echo "<tr><td><a style = \"text-decoration:none;\" href=\"edititem.php?item_id=".$row['item_id']."&cat_name=".$cat_name."&cat_id=".$cat_id."\">".$row['item_name']."</a></td><td>".$row['item_qty']."</td><td>".$row['sale_price']." ".$row['unit']."</td><td>".$row['item_price']." per/pc</td><td>".$row['position']."</td><td class = \"oper\" ><a href=\"in.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\"> IN</a></td><td class = \"oper\"><a href = \"out.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\">OUT</a></td></tr>";
	$sum = $sum + $row['item_qty'];
*/
$book = $row['book_no'];
	echo "<tr><td class = \"item_list\" ><a  style = \"text-decoration:none;cursor:pointer;color:grey;\" onclick = \"show_itempage('".$cat_name."',$cat_id,".$row['book_no'].",'".$row['alpha_serial']."',".$row['serial_begin'].",".$row['serial_end'].")\">".$row['book_no']."</a></td><td>".$row['alpha_serial']."</td><td>".$row['serial_begin']."</td><td>".$row['serial_end']."</td><td> ".$row['issue_date']."</td>";
	echo "<td>".$row['cash_received_date']."</td>";
	if($row['cash_received_date'] == "")
	echo "<td><input type = 'text' style = 'padding:3px;' placeholder = 'enter amount to confirm' onKeyPress = 'if(event.keyCode == 13)check_amount(this.value,".$book.");'/></td>";
	else
	echo "<td>".$row['cash_received']."</td>";
	//echo "<td class = \"oper\" ><a href=\"in.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\"> IN</a></td><td class = \"oper\"><a href = \"out.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\">OUT</a></td>";
	echo "</tr>";
	$sum = $sum + $row['item_qty'];

}
echo "<tr><td><b>Sum</b></td><td>".$sum."</td></tr>";
echo "</table>";
$arrayLedger = Array();
//$query_list_ledger = mysqli_query($con,"select ledger_id,date,amount,transaction_id,concat('payment ',narration) as mode from daybook where transaction_type = 5 and ledger_id = $cat_id union select receipt_detail.runner_id as ledger_id,issue_date,sum(amount) as amount,book_id as transaction_id,'receipt' as mode from receipt_detail join book_issue using(book_id) where receipt_detail.runner_id = $cat_id group by book_id ");
$query_list_ledger = mysqli_query($con,"select ledger_id,date,amount,transaction_id,concat('payment ',narration) as mode from daybook where transaction_type = 5 and ledger_id = $cat_id union select receipt_detail.runner_id as ledger_id,issue_date,sum(amount) as amount,book_id as transaction_id,'receipt' as mode from receipt_detail join book_issue using(book_id) where receipt_detail.runner_id = $cat_id group by book_id order by date ");
while($ro_ledger = mysqli_fetch_array($query_list_ledger))
{
	$arrayLedger[] = $ro_ledger;
}
//print_r($arrayLedger);
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;background:white;padding:5px;border-radius:10px;\">";
echo "<th>Date</th><th>Tran Type</th><th>Tran/Book #</th><th>Credit</th><th>Debit</th><th>Balance</th>";
$rocSum = 0;
foreach($arrayLedger as $row_ledger)
{
//	echo "this works";
if($row_ledger[mode] == 'receipt')

{
	echo "<tr><td>".$row_ledger[date]."</td><td>".$row_ledger[mode]."</td><td>".$row_ledger[transaction_id]."</td><td></td><td>".$row_ledger[amount]."</td>";
		$rocSum = $rocSum + $row_ledger[amount];
	echo "<td>$rocSum</td></tr>";
}
else
{
	echo "<tr><td>".$row_ledger[date]."</td><td>".$row_ledger[mode]."</td><td>".$row_ledger[transaction_id]."</td><td>".$row_ledger[amount]."</td><td></td>";
	$rocSum = $rocSum - $row_ledger[amount];
	echo "<td>$rocSum</td></tr>";
}

}
echo "</table>";
/*
echo "<form method = 'POST' action = ''>";
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;background:ivory;padding:5px;border-radius:10px;\">";
echo "<caption style = 'margin:10px;border-radius:10px;background:ivory;color:grey;letter-spacing:1px;padding:10px;font-size:25px;'>Payments</caption>";
echo "<th style = 'width:180px;'>Ledger Name</th><th style = 'width:100px;'>Date</th><th>Tr-Id</th><th>Amount</th><th>Narration</th>";
$queryPayment = mysqli_query($con,"select * From daybook join runner on runner.runner_id = daybook.ledger_id where transaction_type = 5 and ledger_id = $cat_id");
while($rowPayment = mysqli_fetch_array($queryPayment))
{
	echo "<input type = 'text' style = 'display:none;' name = 'sno' value = '".$rowPayment['sno']."'/>";
	echo "<tr><td>";
echo "<input type = 'text' list = 'eexampleList' value = '".$rowPayment['runner_name']."' name = 'eexample' id = 'eexample_input' oninput = 'showdatalist_value()' style = 'width:100%;height:28px;' disabled/>";
/*echo "<datalist id = 'eexampleList' >";
foreach($arrayLedger as $row_ledger)
{
echo "<option value = '".$row_ledger[runner_name]."' data-id = '".$row_ledger[runner_id]."' id = '".$row_ledger[runner_id]."'>".$row_ledger[runner_id]."</option>";
}
echo "</datalist>";

	echo "</td><td><input type = 'text' value = '".$rowPayment['date']."' name = 'date' style = 'width:100px;'/></td><td>Payment ".$rowPayment['transaction_id']."</td><td><input type = 'text' value = '".$rowPayment['amount']."' style = 'width:100px;' name= 'amount'/></td><td><input type = 'text' value = '".$rowPayment['narration']."' name = 'narration'/></td><td>Edit</td></tr>";
//	echo "<input type= 'text' value = '".$rowPayment['runner_id']."' name = 'other_ledgers' id = 'other_ledgers' />";
}
echo "</table>";
echo "</form>";
*/
?>
</div>
</body>
</html>
