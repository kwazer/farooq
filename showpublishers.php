<style>
	.lisst
	{
		color:navy;
	}
</style>
<script>
	
function del()
{
	location.href = 'deleteitem.php?item_id='+item_id;
}

</script>
<div id = "main-window" style = "width:500px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >Category</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='itempage.php';\">Back</span><br><hr>";
include 'con.php';
//$con = mysqli_connect("localhost","root","password","pyramid2");
$query = mysqli_query($con,"select * from publisher");
echo "<table border = \"0\" style = \"border-collapse:collapse;\">";

while($row = mysqli_fetch_array($query))
{
//	echo "<form action = \"editauthors.php\" method = \"post\" onsubmit = \"return submit_item(this)\">";
//echo "<input value = '".$row['author_id']."' name = 'author_id' style = 'display:none;'>";
	echo "<tr>";
	echo "<td><input name = 'author_name' id = 'pb_name".$row['pb_id']."' type = \"text\" style = \"padding:5px;font-size:15px;\" onkeydown = \"if(event.keyCode == 13) editpublisher(".$row['pb_id'].");\" value = \"".$row['pb_name']."\"  /></td>";
//	echo "</tr>";
echo "<td><input type = \"button\" value = 'save' onclick = \"editpublisher(".$row['pb_id'].");\"/></td><td><input type = 'button' value = 'delete'/></td></tr>";
//echo "</form>";

	//echo "<tr><td><span class = \"lisst\">type</span></td><td><input id = \"type_item\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['type']."\" onkeydown = \"if(event.keyCode == 13) savves(".$cat_id.",'".$cat_name."',".$itemm_id.");\"/></td></tr>";

}
echo "</table>";
?>

</div>
