<?php
session_start();
include "con.php"; 
$ledger_id = $_REQUEST["ledger_id"];
$sno = $_REQUEST["bill_no"];
$date = $_REQUEST["date"];
$peti = $_REQUEST["peti"];
$dabba = $_REQUEST["dabba"];
$variety = $_REQUEST["variety"];
$quality = $_REQUEST["quality"];
$amount = $_REQUEST["amount"];
$rate = $_REQUEST["rate"];
$marka = $_REQUEST["marka"];
//echo $date;
//echo $ledger_id." ".$sno." ".$date." ".$peti." ".$dabba." ".$variety." ".$quality." ".$amount." ".$rate;
$query = mysqli_query($con,"insert into fruit_buffer(bill_no,date,peti,dabba,variety,quality,rate,amount,khata,marka) values ($sno,'$date',$peti,$dabba,'$variety','$quality',$rate,$amount,'$ledger_id','$marka')");
//if($query)
//echo "successful";
//else
//echo mysqli_error($con);
echo "<table style = 'width:100%;'>";
echo "<th>Khata</th><th>Peti</th><th>Half</th><th>Variety</th><th>Quality</th><th>Marka</th><th>Rate</th><th>Amount</th><th>Button</th>";
$query = mysqli_query($con,"select * From fruit_buffer");
while($row = mysqli_fetch_array($query))
{
	echo "<tr><td>".$row['khata']."</td><td>".$row['peti']."</td><td>".$row['dabba']."</td><td>".$row['variety']."</td><td>".$row['quality']."</td><td>".$row['marka']."</td><td>".$row['rate']."</td><td>".$row['amount']."</td><td><button onclick = 'clear_item(".$row['sno'].")'>Del</button></td></tr>";
}
//echo "";
echo "</table>";
?>
