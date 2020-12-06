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
</style>
<?php
$bill_no = $_REQUEST["bill_no"];
$con = mysqli_connect("localhost","root","password","farooq");
echo "<div style = 'margin:0 auto;'>";
echo "<div style = 'margin:0 auto;width:450px;border:1px solid grey;'>";
echo "<table style = 'width:100%;border-collapse:collapse;'>";
if($bill_no != NULL)
$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook join sale_ledgers using(sno) where transaction_type = 2 and transaction_id = $bill_no");
else
$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook join sale_ledgers using(sno) where transaction_type = 2 order by transaction_id desc limit 1");
while($row = mysqli_fetch_array($query))
{
	$ledger_name = $row['ledger_name'];
	$amount = $row['amount'];
	$date = $row['date'];
	$bill_no = $row['transaction_id'];
	$address = $row['address'];
	$phone_no = $row['phone_no'];
}
echo "<tr style = 'text-align:center;'><td colspan = '4' style = 'border:1px solid black;text-align:center;width:100%;color:black;'><span  style = 'float:right;color:black;font-weight:normal;font-size:12px;'><h4>T : 01951-254400<br>C: 919419434400<br>C: 919018184400<br>C: 919797274400</h4></span><h2 ><span style = 'font-family:Copperplate,Copperplate Gothic Light,fantasy;letter-spacing:1px;'>FAROOQ  ELECTRONICS</span><br> <span style = 'font-size:15px;color:black;font-weight:normal'>Gulshan Abad, Charari Sharief<br> Kashmir - 191112<br><span style = 'color:black;'>Email : farooqelectronics21@ymail.com</span></span></h2></td></tr>";
echo "<tr style = 'text-align:left;'><td colspan = '4' style = 'text-align:left;width:100%;color:black;'><span  style = 'float:right;color:black;font-weight:normal;font-size:15px;margin-right:1px;'><h5>Bill # $bill_no<br>Date : $date</h3></span><h4 style = 'margin-left:5px;'>Name : $ledger_name<br>Address :  $address<br>Phone No : $phone_no</h4></td></tr>";
$query_item = mysqli_query($con,"select * from bill_detail join items on items.item_id = bill_detail.uid where bill_id = $bill_no");
echo "<tr><th style = 'text-align:left;padding-left:3px;'>Qty</th><th style = 'border-left-style:none;text-align:left;'>Product</th><th style='text-align:center;'>Rate</th><th style = 'text-align:center;'>Amount</th></tr>";
$sum = 0;
while($row_item = mysqli_fetch_array($query_item))
{
echo "<tr><td colspan = '2' style = 'text-align:left;padding-left:10px;'>".$row_item['qty']." <span style = 'padding-left:10px;'>".$row_item['name']."</span></td><td style = 'text-align:center;'>".$row_item['price']."</td><td style = 'text-align:center;'>".$row_item['amount']."</td></tr>";
	$sum = $sum + $row_item['amount'];
}
echo "<tr><td colspan = '2'></td><td style = 'text-align:center;color:black;padding-top:250px;font-weight:heavy;'>Total</td><td style = 'text-align:center;color:black;padding-top:250px;font-weight:bold;border-right-style:solid;border-width:1px;border-color:black;'>".number_format((float)$sum, 2, '.', '')."</td></tr>";
echo "<tr><td colspan = '4' style = 'text-align:center;padding-top:10px;padding-bottom:10px;font-weight:bold;color:black;'>Warranty ___________________ Months<br><br> <span style = 'font-size:14px;text-transform:uppercase;'>Warranty will be provided through service center</span></td></tr>";
echo "<tr ><td style = 'width:100px;text-align:center;font-size:11px;'>Goods Once Sold will not be taken back or exchange <br> <span style = 'font-size:15px;'>E & O.E</span></td><td style = 'text-align:center;padding-top:30px'>Sig. Of Customer. </td><td style = 'text-align:center;color:black'>VISIT AGAIN<br>Thank You !</td><td style = 'color: black;text-align:center;padding-top:30px;font-weight:bold;'><span style = 'font-weight:normal;'>For</span> <br><span style = 'font-size:14px;'>Farooq Electronics</span></td></tr>";
echo "</table>";

echo "</div>";
echo  "<p style = 'text-align:center;font-weight:bold;font-size:20px;'>We appreciate your Hurry but Hurry takes Time</p>";
echo "</div>";
?>
