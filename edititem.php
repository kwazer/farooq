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
/*	function savves()
	{
//		alert(set_name);
//		alert("recievers data");
		var name = document.getElementById("name_item").value;
		var price = document.getElementById("price_item").value;
		var position = document.getElementById("position_item").value;
		var qty = document.getElementById("qty_item").value;
		var rem_qty = document.getElementById("rem_qty_item").value;
		var sprice = document.getElementById("sprice_item").value;
		var unt = document.getElementById("unt_item").value;
		var model = document.getElementById("model_item").value;
		var type = document.getElementById("type_item").value;
//alert(name+price+position);
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function ()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
//				location.reload();
//				location.href = 'index.php?set_cat='+cat_id;
window.location.assign("itempage.php?set_cat="+cat_id+"&set_name="+set_name);
//alert("it works");
			}
		}
		xmlhttp.open("GET","backedititem.php?name="+name+"&price="+price+"&position="+position+"&item_id="+item_id+"&qty="+qty+"&rem_qty="+rem_qty+"&sprice="+sprice+"&unt="+unt+"&model="+model+"&type="+type,true);
		xmlhttp.send();
	}
	*/
//	function redirect_back()
//	{
//			window.location.assign("itempage.php?set_cat="+cat_id+"&set_name="+set_name);
//			location.href = "itempage.php?set_cat="+cat_id+"&set_name="+set_name;
//	}
</script>
<div id = "main-window" style = "width:500px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<!--<form action = "updateitems.php" method = "get">-->
<?php
echo "<form action = \"updateitems.php\" method = \"post\" onsubmit = \"return submit_item(this)\">";
$array_author = array();
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$cat_name."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"redirect_back(".$cat_id.",'".$cat_name."')\">Back</span><br><hr>";
include 'con.php';
//$con = mysqli_connect("localhost","root","password","pyramid2");
$query_author = mysqli_query($con,"select * from author");
while($row_author = mysqli_fetch_array($query_author))
{
	$array_author[] = $row_author;

}
//print_r($array_author);
$query = mysqli_query($con,"select * From items where item_id = $itemm_id"); 
echo "<table border = \"0\" style = \"border-collapse:collapse;\">";

while($row = mysqli_fetch_array($query))
{
//	echo "<tr></tr>";
echo "<input name = 'item_id' type = 'text' value = '$itemm_id' style = 'display:none;'>";
echo "<input name = 'publisher' type = 'text' value = '$cat_id' style = 'display:none;'>";
	echo "<tr>";
//	echo "<td><span class = \"lisst\">ISBN</span></td><td><input name = 'isbn' id = \"isbn\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['isbn']."\" autofocus onkeypress= \"if(event.keyCode == 13) return isbn_()\" /></td>";
	echo "</tr>";
	
	echo "<tr><td><span class = \"lisst\">Name</span></td><td><input name = 'item_name' id = \"add_item\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['name']."\"/></td></tr>";
	
//	echo "<tr><td><span class = \"lisst\">M.R.P</span></td><td><input name = 'mrp' id = \"mrp\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['mrp']."\"/></td></tr>";
	
	echo "<tr><td><span class = \"lisst\">Dealer Rate</span></td><td><input name = 'dealer_discount' id = \"dealer_price_item\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['dealer_rate']."\"/></td></tr>";
	
	echo "<tr><td><span class = \"lisst\">Retail Rate</span></td><td><input name = 'retail_discount' id = \"sprice_item\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['retail_rate']."\"/></td></tr>";
	
	echo "<tr><td><span class = \"lisst\">Cost Price</span></td><td><input name = 'publisher_discount' id = \"unt_item\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['cost_price']."\"/></td></tr>";

	echo "<tr><td><span class = \"lisst\">Item Qty</span></td><td><input name = 'opening_qty' id = \"qty_item\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['quantity']."\"/></td></tr>";
	echo "<tr><td><span class = \"lisst\">Item Unit</span></td><td><input name = 'item_unit' id = \"item_unit\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['unit']."\"/></td></tr>";
	
//	echo "<tr><td><span class = \"lisst\">Order if less than</span></td><td><input name = 'alarm_qty' id = \"rem_qty_item\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['quantity_alarm']."\"/></td></tr>";

	//echo "<tr><td><span class = \"lisst\">Position</span></td><td><input id = \"position_item\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['position']."\"/></td></tr>";
	
/*	echo "<tr><td><span class = \"lisst\">Author</span></td><td><select name=\"author\" id=\"author\" style = 'width:100%;background:white;padding:5px;font-size:15px;'>";
										foreach($array_author as $authors )
										{
										if($authors['author_id'] == $row['author'])
										echo "<option selected = 'selected' value = ".$authors['author_id'].">".$authors['author_name']."</option>";
										else
										echo "<option value = ".$authors['author_id'].">".$authors['author_name']."</option>";
										}
echo									"</select></td></tr>";
*/

	//echo "<tr><td><span class = \"lisst\">type</span></td><td><input id = \"type_item\" type = \"text\" style = \"padding:5px;font-size:15px;\" value = \"".$row['type']."\" onkeydown = \"if(event.keyCode == 13) savves(".$cat_id.",'".$cat_name."',".$itemm_id.");\"/></td></tr>";

}
echo "</table>";
?>
<input type = "submit"/>
</form>

</div>
