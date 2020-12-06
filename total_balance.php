<?php
session_start();
include 'con.php';
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];
$set_date = $_REQUEST["year"];
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

<div id = "main-window" style = "width:780px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
//echo "<form action = \"back".$ledger_type.".php\" method = \"post\" onsubmit = \"return submit_item(this)\">";
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='admin_page.php';\">Back</span><br><span style = 'float:right;'>";
echo "<input type = 'date' onkeypress = \"if(event.keyCode == 13)transaction_types($sno,'$ledger_type',this.value)\"/>";

echo "</span><br><hr>";
?>
    <table style = "width:100%;">
        <th style = 'text-align:left;'>Transaction Type</th><th style = 'text-align:right;'>Amount</th><th style = 'text-align:right;'>Balance</th>
<?php
$total_sum = 0;
    
    $query_opening_balance = mysqli_query($con,"select sum(opening_balance) from ledgers where ledger_type = 2");
    while($row_op = mysqli_fetch_array($query_opening_balance))
    {
        $total_sum = $total_sum - $row_op['sum(opening_balance)'];
        echo "<tr><td style = 'text-align:left;'>Opening Balance</td><td style = 'text-align:right;'>".$row_op['sum(opening_balance)']."</td><td style = 'text-align:right;'>".$row_op['sum(opening_balance)']."</td></tr>";
        
    }
    
if($set_date == undefined)
    $query = mysqli_query($con,"select type_id,type_name,sum(amount) from daybook join transaction_type on transaction_type.type_id = daybook.transaction_type group by transaction_type order by date");
else 
     $query = mysqli_query($con,"select type_id,type_name,sum(amount) from daybook join transaction_type on transaction_type.type_id = daybook.transaction_type where date < '$set_date' group by transaction_type order by date");
//$query = mysqli_query($con,"select *,sum(amount) From daybook join ledgers using(ledger_id) where ledger_type = 2 and month(date) = month(CURDATE()) group by ledger_id,transaction_type,month(date),Year(date) ");
//			echo '	<form method = "post" action= "backusers.php" onsubmit = "return submit_item(this);">';

	while($row = mysqli_fetch_array($query))
	{
//echo "<tr><td>".$row['ledger_id']."</td><td style = 'text-align:left;'>".$row['ledger_name']."</td><td>".$row['month(date)']." / ".$row['Year(date)']."</td><td style = 'text-align:right;'>".$row['sum(amount)']."</td><td style = 'text-align:right;'>$total_sum</td></tr>";
        if($row['type_id'] == 3)
        {
		$total_sum = $total_sum - $row['sum(amount)'];
            echo "<tr><td style = 'text-align:left;'>".$row['type_name']."</td><td style = 'text-align:right;'>".$row['sum(amount)']."</td><td style = 'text-align:right;'>".(round($total_sum,2))."</td></tr>";
        }
//        if($row['type_id'] == 5)
//        {
//            $total_sum = $total_sum + $row['sum(amount)'];
//            echo "<tr><td>".$row['type_name']."</td><td>".$row['sum(amount)']."</td><td>".$total_sum."</td></tr>";

//        }
        if($row['type_id'] == 6)
        {
		$total_sum = $total_sum - $row['sum(amount)'];
            echo "<tr><td style = 'text-align:left;'>".$row['type_name']."</td><td style = 'text-align:right;'>".$row['sum(amount)']."</td><td style = 'text-align:right;'>".$total_sum."</td></tr>";
            
        }
        if($row['type_id'] == 8)
        {
		$total_sum = $total_sum + $row['sum(amount)'];
            echo "<tr><td style = 'text-align:left;'>".$row['type_name']."</td><td style = 'text-align:right;'>".$row['sum(amount)']."</td><td style = 'text-align:right;'>".$total_sum."</td></tr>";
            
        }
	}
if($set_date == undefined)
        $query_receipt = mysqli_query($con,"select sum(amount) from receipt_detail");
else 
 $query_receipt = mysqli_query($con,"select sum(amount) from receipt_detail where date < '$set_date'");        
while($row_receipt = mysqli_fetch_array($query_receipt))
        {
            $total_sum = $total_sum +$row_receipt['sum(amount)'];
            echo "<tr><td style = 'text-align:left;'>receipt</td><td style = 'text-align:right;'>".$row_receipt['sum(amount)']."</td><td style = 'text-align:right;'>".$total_sum."</td></tr>";
            
        }
	echo "	</table> ";
//			echo "</form>";

	?>
		
	

</div>
