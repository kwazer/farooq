<?php 
$sno = $_REQUEST["sno"];
$ledger_type = $_REQUEST["ledger_type"];
include 'con.php';
$query_list = mysqli_query($con,"select * from ledgers join ledger_details using (ledger_id) where ledger_type = $sno");
echo '<div id = "main-window" style = "width:850px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">';
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;text-transform:capitalize;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='ledgers.php';\">Back</span> <span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"add_ledger(".$sno.")\">Create New ".$ledger_type."</span><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" ><a href= 'ledger_type.php?sno=$sno&ledger_type=$ledger_type' >Print</a></span><br><hr>";

echo "<table style = 'width:100%;'>";
echo "<tr style = 'color:brown;border-width:1px;border-bottom-style:solid;border-color:peachpuff;'><td>Ledger Id</td><td style = 'text-align:left;'>Ledger Name</td><td style = 'text-align:left;'>Father's Name</td><td style = 'text-align:left;'>Address</td></tr>";
//echo "<tr><td>Date</td><td>Challan no</td><td>P</td><td>H</td><d>Gross</d><td>Expenses</td><td>Net</td></tr>";
while($row = mysqli_fetch_array($query_list))
{
	echo "<tr  onclick = 'sfruit_page(".$row['ledger_id'].",\"".$row['ledger_name']."\")' style = 'border-width:1px;border-color:peachpuff;border-bottom-style:solid;'><td style = 'border-bottom-style:solid;border-color:red;border-width:1px;'>F".$row['ledger_id']."</td><td style = 'text-align:left;text-transform:capitalize;font-weight:bold;border-width:1px;border-color:red;border-bottom-style:solid;'>".$row['ledger_name']."</td> <td style='text-align:left;text-transform:capitalize;border-width:1px;border-color:red;border-bottom-style:solid;'>".$row['father_name']."</td><td style = 'text-align:left;text-transform:capitalize;border-color:red;border-bottom-style:solid;border-width:1px;'>".$row['address']."</td></tr>";
}
echo "</table>";
echo "</div>";
?>
