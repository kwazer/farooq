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
//print_r($array_ledger);
echo "<form action = \"back".$ledger_type.".php\" method = \"post\" onsubmit = \"return submit_item(this)\">";
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='searchpage.php';\">Back</span><br><hr>";
echo "<input type = 'text' name = 'ledger_id' id = 'uid' style = 'display:none;'/>";
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;\">";
echo "<tr><td class = 'lisst'><span >SNo :</span></td><td><input style = 'width:65%;height:28px;' type = 'text' name = 'receipt_no'/></td></tr>";
echo  "<tr><td></td><td><input type= 'submit' id=\"searchbtn\" style = \"//display:inline;float:right;margin-top:1px;height:23px;\"></td></tr>";
echo "</table>";
echo "</form>";
?>
<div id = 'search_result'>
</div>
</div>
