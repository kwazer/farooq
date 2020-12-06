<?php
include 'con.php';
echo "<table style = 'width:100%;'>";
$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date,daybook.narration as truck_no from daybook left join ledgers using (ledger_id) left join goods_details on goods_details.tran_id = daybook.transaction_id where transaction_type = 16 order by transaction_id desc"); 
echo "<th>Date</th><th>Tran Id</th><th>Amount</th><th>Truck No</th><th>St. From</th><th>St. To</th><th>Controls</th><th>Status</th>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr><td>".$row['date']."</td><td>".$row['transaction_id']."</td><td>".$row['amount']."</td><td style='font-size:14px;'>".$row['truck_no']."</td><td><input type = 'text' value = '".$row['station_from']."' style = 'height:28px;font-size:14px;'/></td><td><input type = 'text' style = 'height:28px;font-size:14px;width:100px;' onkeypress = '' value = '".$row['station_to']."'/></td><td><a style = 'padding:3px 6px;border:1px solid grey;border-radius:2px;background:lightgreen;' onclick = 'show_receipt_details(".$row['transaction_id'].")'>Show</a></td>";
	if($row['status'] == false)
	echo "<td><a style = 'padding:3px 6px;border:1px solid grey;' onclick = 'pay_freight(".$row['transaction_id'].")'>Pay</a></td></tr>";
	else
	echo "<td style = 'color:red;'>Paid</td></tr>";
}
echo "</table>";
?>
