<?php 

include 'con.php';
//echo "hello";
/* beopari name ledger_id
 * manual challan no narration
 
  * expenses 
 * gross
 * net
 
 
 * truck no ======
 * date date
 * */
echo "<datalist id = 'exampleList' >";
$query_list_ledger = mysqli_query($con,"select * From ledgers where ledger_type = 7");
while($row_ledger = mysqli_fetch_array($query_list_ledger))
{
echo "<option value = '".$row_ledger['ledger_name']."' data-id = '".$row_ledger['ledger_id']."' id = '".$row_ledger['ledger_id']."'>".$row_ledger['ledger_id']."</option>";
}
//echo "<option value = 'Rama Books' data-id = '6' id = '6' onKeyUp = 'alert(\"6\");'>6</option>";
//echo "<option value = 'Aatma ram' data-id = '7' id = '7' onKeyUp = 'alert(\"7\");'>7</option>";
echo "</datalist>";
$query_date = mysqli_query($con,"select * from daybook where transaction_type = '11' order by sno desc");
while($r= mysqli_fetch_array($query_date))
{
	$date = $r['date'];
}
$query_truck = mysqli_query($con,"select * from truck_details order by challan_no desc");
while($r= mysqli_fetch_array($query_truck))
{
	$truck_no = $r['truck_no'];
}

?>
<form action = "createchallan.php" method = "GET">
	<input type = "text" style = "display:none;" name = "ledger_id" id = "ledger_id"/>
<table style = 'width:100%;border-collapse:collapse;' border = "0">
	<tr><td>Date</td><td><input type = "date" name = "date" value = "<?php echo $date;?>" style = "height:28px;width:100%;border:0px;background:peachpuff;"/></td><td>Challan_No</td><td><input style = "font-size:18px;background:peachpuff;height:28px;border:0px;width:100%;" name = "challan_no" type = "text"/></td><td>Truck_No</td><td><input style = "font-size:18px;background:peachpuff;height:28px;border:0px;width:100%;" name = "truck_no" value = "<?php echo $truck_no; ?>" type = "text"/></td></tr>
	<tr><td colspan = "2">Party Name</td><td colspan = "4"><input list = "exampleList" oninput = 'showb_value();' type = "text" style = "font-size:18px;background:peachpuff;width:100%;border:0px;height:28px;" id ="b_input" name = "party_name"/></td></tr>
<tr><td colspan = '2'>Driver name</td><td colspan = '4'><input type = 'text' id = 'driver_name' name = 'driver_name' style = "height:28px;width:100%;border:0px;background:peachpuff;"/></td></tr><tr><td colspan = '2'>Driver Ph #</td><td colspan = '4'><input name = 'phone_no' type = 'text' style = "height:28px;width:100%;border:0px;background:peachpuff;" id = 'phone_no'</td></tr>	
<tr><td colspan = "5"></td><td><input type = "submit" value = "Confirm"/></td></tr>
</table>

</form>
