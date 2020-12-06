<?php
$str = $_GET["str"];
$con = mysqli_connect("localhost","root","password","shop");
$query = mysqli_query($con,"select * From item where item_name LIKE '$str%'"); 
while($row = mysqli_fetch_array($query))
{
	echo "<tr><td>".$row['item_name']."</td></tr>";
}
?>
