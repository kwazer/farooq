<html>
	<body>
		<div style = "width:750px;margin:0 auto;"> 
			<style>
				.oper
				{
					color:olive;
				}
				td
				{
					vertical-align:center;
					text-align:center;
					font-size:15px;
					padding:5px;
				}
				th
				{
					font-weight:normal;
					color:brown;
				}
				
				a 
				{
					text-decoration:none;
					color:inherit;
				}
				.item_list:hover
				{
					color:red;
				}
				

			</style>
<?php 
$cat_id = $_GET["cat_id"];
$cat_name = $_GET["cat_name"];

echo "<div style = \"background:white;padding:10px;text-transform:capitalize;border:0px solid black;width:730px;border-radius:10px 10px 0px 0px;\"><big style = \"font-size:28px;color:grey;letter-spacing:2px;\">".$cat_name."</big>";
//echo "<a style = \"text-decoration:none;color:brown;\" href = \"additem.php?cat_id=".$cat_id."&cat_name=".$cat_name."\"><span style = \"margin-left:10px;border:0px solid black;padding:3px;\">Add Item</span></a><hr></div>";
echo "<a style = \"text-decoration:none;color:brown;\" onclick = \"add_item(".$cat_id.",'".$cat_name."')\"><span style = \"margin-left:10px;border:0px solid black;padding:3px;cursor:pointer;\">Add Item</span></a><hr></div>";
include 'con.php';
//$con = mysqli_connect("localhost","root","password","shop");
$query = mysqli_query($con,"select * from items where publisher = '$cat_id' order by name ");
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;background:ivory;padding:5px;border-radius:0px 0px 10px 10px;\">";
echo "<th>Name</th><th>Quantity</th><th>D.P</th><th>S.P</th><th>C.P</th>";
while($row = mysqli_fetch_array($query))
{
/*	echo "<tr><td><a style = \"text-decoration:none;\" href=\"edititem.php?item_id=".$row['item_id']."&cat_name=".$cat_name."&cat_id=".$cat_id."\">".$row['item_name']."</a></td><td>".$row['item_qty']."</td><td>".$row['sale_price']." ".$row['unit']."</td><td>".$row['item_price']." per/pc</td><td>".$row['position']."</td><td class = \"oper\" ><a href=\"in.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\"> IN</a></td><td class = \"oper\"><a href = \"out.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\">OUT</a></td></tr>";
	$sum = $sum + $row['item_qty'];
*/
	echo "<tr><td class = \"item_list\" ><a  style = \"text-decoration:none;cursor:pointer;color:grey;\" onclick = \"show_itempage('".$cat_name."',$cat_id,".$row['item_id'].")\">".$row['name']."</a></td><td>".$row['quantity']."</td><td>".$row['dealer_rate']."</td><td> ".$row['retail_rate']."</td><td>".$row['cost_price']."</td>";
	//echo "<td class = \"oper\" ><a href=\"in.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\"> IN</a></td><td class = \"oper\"><a href = \"out.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\">OUT</a></td>";
	echo "</tr>";
	$sum = $sum + $row['item_qty'];

}
echo "<tr><td><b>Sum</b></td><td>".$sum."</td></tr>";
echo "</table>";

?>
</div>
</body>
</html>
