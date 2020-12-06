<style>
	input
	{
		border:1px solid grey;
	}
</style>
<?php
$led_id = $_GET["led_id"];
$led_name = $_GET["led_name"];
//echo $led_id;
include 'con.php'; 
$query = mysqli_query($con,"select * From ledgers where led_id = $led_id");
echo "<table>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr><td>Ledger Name</td><td><input type = \"text\" value = \"".$row['led_name']."\"/></td></tr>";
	echo "<tr><td>address</td><td><input type = \"text\" value = \"".$row['address']."\"/></td></tr>";
	echo "<tr><td>opening balance</td><td><input type = \"text\" value = \"".$row['opening_bal']."\"/></td></tr>";
	echo "<tr><td>sub info</td><td><input type = \"text\" value = \"".$row['sides']."\"/></td></tr>";
	echo "<tr><td>cell</td><td><input type = \"text\" value = \"".$row['cell']."\"/></td></tr>";
}
echo "</table>";
?>
