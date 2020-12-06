<?php 
session_start();
include 'con.php';
$sno = $_REQUEST["sno"];
$query = mysqli_query($con,"delete from fruit_buffer where sno = '$sno'");
if($query)
{
echo "<table style = 'width:100%;'>";
echo "<th>Khata</th><th>Peti</th><th>Half</th><th>Variety</th><th>Quality</th><th>Rate</th><th>Amount</th><th>Button</th>";
$query_new = mysqli_query($con,"select * From fruit_buffer");
while($row = mysqli_fetch_array($query_new))
{
	echo "<tr><td>".$row['khata']."</td><td>".$row['peti']."</td><td>".$row['dabba']."</td><td>".$row['variety']."</td><td>".$row['quality']."</td><td>".$row['rate']."</td><td>".$row['amount']."</td><td><button onclick = 'clear_item(".$row['sno'].")'>Del</button></td></tr>";
}
//echo "";
echo "</table>";	
}
	else
echo mysqli_error($con);
?>
