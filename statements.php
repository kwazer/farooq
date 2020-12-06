<?php
session_start();
include 'con.php';
$date_search = $_REQUEST["date"];
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];

//$query_se = mysqli_query($con,"select * From daybook where transaction_type = '$sno' order by transaction_id desc limit 1");
//while($row_se = mysqli_fetch_array($query_se))
//{
	
//	$bil_no = $row_se['transaction_id'];
//}
//	if(isset($bil_no))
//	$bil_no = $bil_no + 1;
//	else
//	$bil_no = 1;

?>
<style>
	.lisst
	{
		color:navy;
		text-align:left;
		
	}
	.user_fields
	{
		height:28px;
		font-size:15px;
		padding:5px;
		border-radius: 0px 5px;
		border:1px solid blue;
	}
	
</style>
<script>

//function del()
//{
//	location.href = 'deleteitem.php?item_id='+item_id;
//}

</script>
<div id = "main-window" style = "width:780px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
//echo "<form action = \"back".$ledger_type.".php\" method = \"post\" onsubmit = \"return submit_item(this)\">";
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='admin_page.php';\">Back</span><form action='statements.php' method='GET' style = 'float:right;'><span style = 'font-size:14px;color:brown;padding:8px;'>Enter Date</span><input  type = 'date' placeholder = 'enter date' name = 'date'/><input type = 'submit'/></form><br><hr>";
?>
<?php
if(isset($date_search))
$query = mysqli_query($con,"select *,sum(amount),concat(ledger_tenure,ledger_id) as account_no,month(date),Year(date) from receipt_detail join ledgers using(ledger_id) join ledger_details using (ledger_id) where month(date) = month(str_to_date('$date_search','%Y-%m-%d')) and year(date) = year(str_to_date('$date_search','%Y-%m-%d')) group by ledger_id,month(date),Year(date) ");
else
$query = mysqli_query($con,"select *,sum(amount),concat(ledger_tenure,ledger_id) as account_no,month(date),Year(date) from receipt_detail join ledgers using(ledger_id) join ledger_details using (ledger_id) where month(date) = month(CURDATE())  and year(date) = year(CURDATE()) group by ledger_id,month(date),Year(date) ");
//			echo '	<form method = "post" action= "backusers.php" onsubmit = "return submit_item(this);">';
$total_sum = 0;
?>

	<table style = "width:100%;">
		<th>Account No</th><th style = 'text-align:left;'>Ledger Name</th><th>Month</th><th>Balance</th><th>Total</th>
	<?php 

	while($row = mysqli_fetch_array($query))
	{
		$total_sum = $total_sum + $row['sum(amount)'];
echo "<tr><td>".$row['account_no']."</td><td style = 'text-align:left;'>".$row['ledger_name']."</td><td>".$row['month(date)']."/
".$row['Year(date)']."</td><td style = 'text-align:right;'>".$row['sum(amount)']."</td><td style = 'text-align:right;'>$total_sum</td></tr>";
	}
	echo "	</table> ";
//			echo "</form>";

	?>
		
	

</div>
