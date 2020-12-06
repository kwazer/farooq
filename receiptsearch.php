<?php
session_start();
include 'con.php';
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];
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
<div id = "main-window" style = "width:820px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
$query_date = mysqli_query($con,"select DATE_FORMAT(date,'%d-%m-%Y') as date,alpha_serial from receipt_detail order by sno desc limit 1");
while($rowDate = mysqli_fetch_array($query_date))
{
	$date_fill = $rowDate['date'];
	$alpha_serial = $rowDate['alpha_serial'];
}
$array_ledger = array();

$query_ledger = mysqli_query($con,"select * from ledgers where ledger_type between 3 and 4");
while($row_ledger = mysqli_fetch_array($query_ledger))
{
	$array_ledger[] = $row_ledger;
}
//print_r($array_ledger);
echo "<form action = \"back".$ledger_type.".php\" method = \"post\" onsubmit = \"return submit_item(this)\">";
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='searchpage.php';\">Back</span><br><hr>";
echo "<input type = 'text' name = 'ledger_id' id = 'uid' style = 'display:none;'/>";
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;\">";
echo "<tr><td class = 'lisst'><span >Receipt No :</span></td><td><input style = 'width:35%;height:28px;' type = 'text' name = 'alpha_serial' placeholder = 'alpha serial' value = '$alpha_serial' /><input style = 'width:65%;height:28px;' type = 'text' name = 'receipt_no'/></td></tr>";
echo  "<tr><td></td><td><input type= 'submit' id=\"searchbtn\" style = \"//display:inline;float:right;margin-top:1px;height:23px;\"></td></tr>";
echo "</table>";
echo "</form>";
?>
<div id = 'search_result'>
</div>
</div>
