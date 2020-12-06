<?php 
include 'con.php';
//$narration = $_REQUEST["challan_id"];
$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as new_date from daybook join ledgers using (ledger_id) where transaction_type = 11 and amount IS NULL order by date desc");
echo "<table style = 'width:100%;border-collapse:collapse;' border = '1'>";
echo "<tr style = 'background:peachpuff;color:brown;font-weight:bold;'><td>Date</td><td>Challan no</td><td>Ledger Name</td><td>Transaction Id</td><td>Actions</td></tr>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr style = 'color:blue;' onclick = 'add_watak(".$row['transaction_id'].")'><td>".$row['new_date']."</td><td>".$row['narration']."</td><td style = 'text-align:left;'>".$row['ledger_name']." <span style = 'color:teal;float:right;'> B ".$row['ledger_id']."</span></td><td>".$row['transaction_id']."</td><td><button>Submit Challan</button></td></tr>";
}
echo "</table>";
?>
	
</div>
