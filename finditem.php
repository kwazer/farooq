<style>
	td
	{
		text-align:left;
	}
</style>
<?php
$str=$_GET['id'];
$type_id = $_GET['type_id'];
$ledger_flag = $_REQUEST["led_flag"];
if ($str!="")
{
	include 'con.php';
//$con=mysqli_connect("localhost","root","password","kapoor");//---------------<<<<<
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if($type_id == 4 || $type_id == 6)
  {
	 if($type_id == 4 || $type_id == 6)
		{
			$query_total="Select * from ledgers join ledger_details using (ledger_id) where ledger_type = '2' and ledger_name LIKE '$str%' limit 10";
		}
	 else
		{
			$query_total="Select * from ledgers join ledger_details using (ledger_id) where ledger_type = '1' and ledger_name LIKE '$str%' limit 10";
		}
	$result=mysqli_query($con,$query_total);
//echo "<select>";	
	while ($row=mysqli_fetch_array($result))
	{
		$item_name=$row[ledger_name];
		$item_id=$row[ledger_id];
		$father_name = $row[father_name];
		$account_no = $row[ledger_tenure].$row[ledger_id];
		if($type_id == 6)
		$account_no = $row[ledger_id];
//		$item_price=$row[item_price];
//		$item_vat_sum=$row[vat_sum];
//		$cat_name = $row['cat_name'];
		
//		echo "<option  id =\"".$item_name."\" value='$item_name' iid='$item_id' price='$item_price' vat_sum='$item_vat_sum'>$item_name</option>";
		echo "<tr><td onclick = \"selecteditem(".$item_id.");\" id = \"".$item_id."\" tabindex = \"".$item_id."\" onkeydown = \"if (event.keyCode == 40) {traverse('up');return false;} if(event.keyCode == 38) {traverse('down');return false;}if(event.keyCode == 13){return false;}else this.onclick();\" >".$item_name." S/o ".$father_name." A/C ".$account_no."</td></tr>";
	}

  }
if($type_id == 5)
  {
	   $query_total="Select * from runner where runner_name LIKE '$str%' limit 10";
		$result=mysqli_query($con,$query_total);
//echo "<select>";	
	while ($row=mysqli_fetch_array($result))
	{
		$item_name=$row[runner_name];
		$item_id=$row[runner_id];
//		$father_name = $row[father_name];
//		$account_no = $row[ledger_tenure].$row[ledger_id];
//		$item_price=$row[item_price];
//		$item_vat_sum=$row[vat_sum];
//		$cat_name = $row['cat_name'];
		
//		echo "<option  id =\"".$item_name."\" value='$item_name' iid='$item_id' price='$item_price' vat_sum='$item_vat_sum'>$item_name</option>";
		echo "<tr><td onclick = \"selecteditem(".$item_id.");\" id = \"".$item_id."\" tabindex = \"".$item_id."\" onkeydown = \"if (event.keyCode == 40) {traverse('up');return false;} if(event.keyCode == 38) {traverse('down');return false;}if(event.keyCode == 13){return false;}else this.onclick();\" >".$item_name."</td></tr>";
	}

  }
if($type_id == 7)
  {
	   $query_total="Select * from ledgers where ledger_name LIKE '$str%' and ledger_type = '1' limit 10";
		$result=mysqli_query($con,$query_total);
//echo "<select>";	
	while ($row=mysqli_fetch_array($result))
	{
		$item_name=$row[ledger_name];
		$item_id=$row[ledger_id];
//		$father_name = $row[father_name];
//		$account_no = $row[ledger_tenure].$row[ledger_id];
//		$item_price=$row[item_price];
//		$item_vat_sum=$row[vat_sum];
//		$cat_name = $row['cat_name'];
		
//		echo "<option  id =\"".$item_name."\" value='$item_name' iid='$item_id' price='$item_price' vat_sum='$item_vat_sum'>$item_name</option>";
		echo "<tr><td onclick = \"selecteditem(".$item_id.");\" id = \"".$item_id."\" tabindex = \"".$item_id."\" onkeydown = \"if (event.keyCode == 40) {traverse('up');return false;} if(event.keyCode == 38) {traverse('down');return false;}if(event.keyCode == 13){return false;}else this.onclick();\" >".$item_name."</td></tr>";
	}

  }
if($ledger_flag == 'true')
  {
 $query_total="Select * from ledgers where ledger_name LIKE '$str%' and ledger_type = '2' limit 10";
	$result=mysqli_query($con,$query_total);
	while ($row=mysqli_fetch_array($result))
	{
		$item_name=$row[ledger_name];
		$item_id=$row[ledger_id];
		//$item_price=$row[item_price];
		//$item_vat_sum=$row[vat_sum];
		//$cat_name = $row['cat_name'];
		echo "<tr><td onclick = \"selecteditem(".$item_id.");\" id = \"".$item_id."\" tabindex = \"".$item_id."\" onkeydown = \"if (event.keyCode == 40) {traverse('up');return false;} if(event.keyCode == 38) {traverse('down');return false;}else this.onclick();\" >".$item_name."</td></tr>";
	}
}

//for items 
  if($type_id == 3 || $type_id == 1 || $type_id == 2 || $type_id == 10)
  {
 $query_total="Select * from items join publisher on publisher.pb_id = items.publisher where name LIKE '$str%' or isbn = '$str' limit 10";
// $query_total="Select * from item join category on category.cat_id = item.cat_id where item_name LIKE '$str%' limit 10";
	$result=mysqli_query($con,$query_total);
//echo "<select>";	
	while ($row=mysqli_fetch_array($result))
	{
		$item_name=$row[name];
		$item_id=$row[item_id];
		$item_price=$row[item_price];
		$item_vat_sum=$row[vat_sum];
		$cat_name = $row[pb_name];
		
//		echo "<option  id =\"".$item_name."\" value='$item_name' iid='$item_id' price='$item_price' vat_sum='$item_vat_sum'>$item_name</option>";
		echo "<tr><td onclick = \"selecteditem(".$item_id.");\" id = \"i".$item_id."\" tabindex = \"".$item_id."\" onkeydown = \"if (event.keyCode == 40) {traverse('up');return false;} if(event.keyCode == 38) {traverse('down');return false;}else this.onclick();\" >".$item_name." ".$cat_name."</td></tr>";
	}
}
//	echo "</select>";
}	
?>
