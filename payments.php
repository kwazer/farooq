<?php
$cat_id = $_GET["cat_id"];
$cat_name = $_GET["cat_name"];
$itemm_id = $_GET["item_id"]; 

?>
<style>
	.lisst
	{
		color:navy;
	}
</style>
<script>
	
	var item_id = <?php echo $itemm_id;?>;
	var set_name = '<?php echo $cat_name;?>';
	var cat_id = <?php echo $cat_id; ?>;
//	var cat_name = <?php echo $cat_name;?>;
//alert(set_name);
function del()
{
	location.href = 'deleteitem.php?item_id='+item_id;
}

</script>
<div id = "main-window" style = "width:500px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >Authors</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='itempage.php';\">Back</span><br><hr>";
$con = mysqli_connect("localhost","root","password","kapoor");
$query = mysqli_query($con,"select * from author");
echo "<table border = \"0\" style = \"border-collapse:collapse;\">";

while($row = mysqli_fetch_array($query))
{
//	echo "<form action = \"editauthors.php\" method = \"post\" onsubmit = \"return submit_item(this)\">";
//echo "<input value = '".$row['author_id']."' name = 'author_id' style = 'display:none;'>";
	echo "<tr>";
	echo "<td><input name = 'author_name' id = 'author_name".$row['author_id']."' type = \"text\" style = \"padding:5px;font-size:15px;\" onkeydown = \"if(event.keyCode == 13) editauthor(".$row['author_id'].");\" value = \"".$row['author_name']."\"  /></td>";
//	echo "</tr>";
echo "<td><input type = \"button\" value = 'save' onclick = \"editauthor(".$row['author_id'].");\"/></td><td><input type = 'button' value = 'delete'/></td></tr>";
//echo "</form>";

	//echo "<tr><td><span class = \"lisst\">type</span></td><td><input id = \"type_item\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['type']."\" onkeydown = \"if(event.keyCode == 13) savves(".$cat_id.",'".$cat_name."',".$itemm_id.");\"/></td></tr>";

}
echo "</table>";
?>

</div>
