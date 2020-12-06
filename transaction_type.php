<?php
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];
?>
<style>
	.lisst
	{
		color:navy;
	}
</style>
<script>
	
//function del()
//{
//	location.href = 'deleteitem.php?item_id='+item_id;
//}

</script>
<div id = "main-window" style = "width:500px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='transactions.php';\">Back</span><br><hr>";
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;\">";
//echo "<input type = 'text' placeholder ";
echo "</table>";
?>

</div>
