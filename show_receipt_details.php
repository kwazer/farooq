<?php
$tran_id = $_REQUEST["tran_id"];
echo "<a style = 'border:1px solid grey;padding:3px 6px;' href = 'printreceipt.php?tran_id=".$tran_id."'>Print</a>";
include 'con.php';
echo "<table style = 'width:100%;'>";
 $query = mysqli_query($con,"select * from goods_receipt_detail left join ledgers using (ledger_id) where bill_no = $tran_id");
echo "<th>Marka</th><th>Peti</th><th>Half</th><th>Variety</th><th>Quality</th><th>Khata</th><th>Rate</th><th>Amount</th><th>Cr. to ledger</th>"; 
while($row = mysqli_fetch_array($query))
{
	echo "<tr><td>".$row['khata']."</td><td>".$row['peti']."</td><td>".$row['dabba']."</td><td>".$row['variety']."</td><td>".$row['quality']."</td><td>".$row['marka']."</td><td>".$row['rate']."</td><td>".$row['amount']."</td><td><input type = 'text' value = '".$row['ledger_name']."' oninput = 'showdataliist_value(".$row['sno'].")' id = 'example_input".$row['sno']."' list = 'exampleList'/></td></tr>";
}
 echo "</table>";

echo "<datalist id = 'exampleList' >";
$query_list_ledger = mysqli_query($con,"select *,concat(ledger_tenure,ledger_id) as account_no From ledgers join ledger_details using (ledger_id) where ledger_type = 6");
while($row_ledger = mysqli_fetch_array($query_list_ledger))
{
echo "<option style = 'font-weight:heavy;' value = '".$row_ledger['ledger_name']." S/o ".$row_ledger['father_name']." R/O ".$row_ledger['address']."' data-id = '".$row_ledger['account_no']."' id = '".$row_ledger['account_no']."'><span style = 'font-size:18px;'>".$row_ledger['account_no']."</span></option>";
}
echo "</datalist></span>";
?>
