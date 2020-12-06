<?php
session_start();
include 'con.php';
$array_runner = array();
$query_runner = mysqli_query($con,"select * from runner");
while($row_runner = mysqli_fetch_array($query_runner))
{
        $runner_id = $row_runner['runner_id'];
        $array_runner[$runner_id] = $row_runner['runner_name'];
}

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
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='admin_page.php';\">Back</span><span style = \"cursor:pointer;color:brown;margin-left:10px;border:1px solid brown;padding:3px;border-radius:5px;\" onclick = \"location.href='confirm_all_receipt.php';\" >Confirm All Receipts</span><br><hr>";
?>
				
				<table style = "width:100%;border-radius:20px 0px 0px 20px;padding:5px;">
					<thead style = "background:peachpuff;color:grey;border-bottom-style:solid;border-color:black;border-width:1px;"><th style = 'padding:10px;width:150px;'>Date</th><th>Party Name</th><th>Transaction Type</th><th>Serial #</th><th>Bill #</th><th>Amount</th></thead>
<!--					<tbody>-->
				<?php 
				$query_show_daybook = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook join ledgers using (ledger_id)join transaction_type on transaction_type.type_id = daybook.transaction_type where flag = 0");
				while($row = mysqli_fetch_array($query_show_daybook))
				{
					if($row['transaction_type'] != NULL){
					$first_type_id = $row['type_id'];
					if(isset($prev_type_id)){
					if($first_type_id != $prev_type_id )
					{
//						echo "</tbody></table><br>";
//echo 				"<table style = \"width:100%;border-radius:20px 0px 0px 20px;padding:5px;\"><thead style = \"background:peachpuff;color:grey;border-bottom-style:solid;border-color:black;border-width:1px;\">";
echo "<tr style = 'background:peachpuff;'><th>Date</th><th>Party Name</th><th>Transaction Type</th><th>Serial #</th><th>Bill #</th><th>Amount</th></tr>";
//echo "</thead>				<tbody>";
				}
			}					
if($row['transaction_type'] != 5)					
					echo "<tr><td>".$row['date']."</td><td style = 'text-align:left;'>".$row['ledger_name']."</td><td style = 'text-align:left;'>".$row['type_name']."</td><td style = 'text-align:left;'># ".$row['transaction_id']."</td><td>".$row['narration']."</td><td style = 'text-align:right;'>".$row['amount']."</td><td><button onclick = 'confirm_admin(1,".$row['sno'].");'>Confirm</button></td></tr>";
else
{
$new_runner_id = $row['ledger_id'];
					echo "<tr><td>".$row['date']."</td><td style = 'text-align:left;'>".$array_runner[$new_runner_id]."</td><td style = 'text-align:left;'>".$row['type_name']."</td><td style = 'text-align:left;'># ".$row['transaction_id']."</td><td>".$row['narration']."</td><td style = 'text-align:right;'>".$row['amount']."</td><td><button onclick = 'confirm_admin(1,".$row['sno'].");'>Confirm</button></td></tr>";

}
					$prev_type_id = $row['type_id'];

				}
				}
				?>
<!--				</tbody>
				</table><br>
				<table style = 'width:100%;border-radius:20px; 0px 0px 20px;padding:5px;'>-->
<!--					<thead style = "background:peachpuff;color:grey;border-bottom-style:solid;border-color:black;border-width:1px;">-->
					<tr style = 'background:peachpuff;'><th style = 'padding:10px;'>Date</th><th>Party Name</th><th>Transaction Type</th><th>Serial #</th><th>Bill #</th><th>Amount</th></tr>
					<!--</thead>-->
<!--					<tbody>-->
						<?php 
						$query_receipt = mysqli_query($con,"select *,concat(alpha_serial,receipt_no) as receipt,DATE_FORMAT(date,'%d-%m-%Y') as date from receipt_detail join ledgers using (ledger_id) where verify_flag = 0 order by ledger_name");
						while($rowReceipt = mysqli_fetch_array($query_receipt))
						{
							echo "<tr><td>".$rowReceipt['date']."</td><td style = 'text-align:left;'>".$rowReceipt['ledger_name']."</td><td style = 'text-align:left;'>receipt</td><td>".$row['sno']."</td><td style = 'text-align:left;'># ".$rowReceipt['receipt']."</td><td style = 'text-align:right;'>".$rowReceipt['amount']."</td><td><button onclick = 'confirm_admin(2,".$rowReceipt['sno'].")'>Confirm</button></td></tr>";
						}
						?>
<!--					</tbody>-->
				</table>

</div>
