<?php
error_reporting(E_ERROR);
session_start();
include 'con.php';
$date_search = $_REQUEST["date"];
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];
$year = $_REQUEST["year"];
if($_REQUEST["year"] == undefined)
{
$select_year = mysqli_query($con,"select distinct year(date) from watak_detail order by year(date) desc limit 1");
while($row_year = mysqli_fetch_array($select_year))
{
$year = $row_year['year(date)'];
}
}
//echo $year;
//$query_se = mysqli_query($con,"select * From daybook where transaction_type = '$sno' order by transaction_id desc limit 1");
//while($row_se = mysqli_fetch_array($query_se))
//{
	
//	$bil_no = $row_se['transaction_id'];
//}
//	if(isset($bil_no))
//	$bil_no = $bil_no + 1;
//	else
//	$bil_no = 1;

?>
<style>
	.lisst
	{
		color:navy;
		text-align:left;
		
	}
	.user_fields
	{
		height:28px;
		font-size:15px;
		padding:5px;
		border-radius: 0px 5px;
		border:1px solid blue;
	}
	th
	{
		font-weight:bold;
		color:brown;
	}
	
</style>
<script>

//function del()
//{
//	location.href = 'deleteitem.php?item_id='+item_id;
//}

</script>
<div id = "main-window" style = "width:780px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<h3 style = 'color:brown;'>>  Mandi Watak Statement</h3>
<?php
//echo "<form action = \"back".$ledger_type.".php\" method = \"post\" onsubmit = \"return submit_item(this)\">";
//echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='admin_page.php';\">Back</span><form action='statements.php' method='GET' style = 'float:right;'><span style = 'font-size:14px;color:brown;padding:8px;'>Enter Date</span><input  type = 'date' placeholder = 'enter date' name = 'date'/><input type = 'submit'/></form><br><hr>";
$array_challan = array();
$array_challan2 = array();
$array_ledger = array();
//$query = mysqli_query($con,"select sum(peti),sum(dabba),sum(expenses),sum(gross),sum(net),challan_id from challan_detail where year(date) = '$year' group by year(date),challan_id");
$query = mysqli_query($con,"select sum(peti),sum(dabba),sum(expenses),sum(gross),sum(net_amount),watak_no from watak_detail where year(date) = '$year' group by year(date)") ;

echo "<h2 style = 'text-align:center;'>";

echo "<select style = 'font-size:17px;background:white;text-decoration:none;' onchange = \"transaction_types('".$sno."','".$ledger_type."',this.value);\">";
$sel_year = mysqli_query($con,"select distinct year(date) from watak_detail order by year(date) desc");
while($row_year = mysqli_fetch_array($sel_year))
{
if($year == $row_year['year(date)'])
echo "<option selected value = '".$row_year['year(date)']."'>".$row_year['year(date)']."</option>";
else 
echo "<option value = '".$row_year['year(date)']."'>".$row_year['year(date)']."</option>";
}

//echo $year;
echo "</select>";
echo "</h2>";
echo "<table style = 'width:100%;'>";
//$query = mysqli_query($con,"select sum(peti),sum(dabba),sum(expenses),sum(gross),sum(net),challan_id from challan_detail group by challan_id");
echo "<th>Peti</th><th>Dabba</th><th>Gross</th><th>Expenses</th><th>Net</th>";
while($row= mysqli_fetch_array($query))
{
echo "<tr><td>".$row['sum(peti)']."</td><td>".$row['sum(dabba)']."</td><td>".$row['sum(gross)']."</td><td>".$row['sum(expenses)']."</td><td>".$row['sum(net_amount)']."</td></tr>";
/*
	$challan = $row[5];
	$array_challan2[] = $row;
*/
//	echo $challan."<br>";
/*
	$array_challan[$challan][peti] = $row['sum(peti)'];
		$array_challan[$challan][dabba] = $row['sum(dabba)'];
			$array_challan[$challan][expenses] = $row['sum(expenses)'];
				$array_challan[$challan][gross] = $row['sum(gross)'];
					$array_challan[$challan][net] = $row['sum(net_amount)'];
*/

}
echo "</table>";
//print_r($array_challan);
//foreach($array_challan2 as $new_array)
//{
//	echo $new_array[5]."<br>";
//}
/*
$ledger_id = 0;
$query_daybook = mysqli_query($con,"select * from daybook join ledgers using (ledger_id) where transaction_type = 9 and year(date) = '$year'  order by ledger_id");
while($ro = mysqli_fetch_array($query_daybook))
{
	$challan_id = $ro['transaction_id'];
//	echo $challan_id."<br>";
	$array_challan[$challan_id][ledger_id]=$ro['ledger_id'];
	$array_challan[$challan_id][ledger_name]=$ro['ledger_name'];
	if($ledger_id != $ro['ledger_id'])
	{
		$ledger = $ro['ledger_id'];
		$array_ledger[$ledger][ledger_name] = $ro['ledger_name'];
		$array_ledger[$ledger][peti] = $array_challan[$challan_id][peti];
			$array_ledger[$ledger][dabba] = $array_challan[$challan_id][dabba];
				$array_ledger[$ledger][expenses] = $array_challan[$challan_id][expenses];
					$array_ledger[$ledger][gross] = $array_challan[$challan_id][gross];
						$array_ledger[$ledger][net] = $array_challan[$challan_id][net];
	}
	else 
	{
		$array_ledger[$ledger][peti] = $array_challan[$challan_id][peti] + $array_ledger[$ledger][peti];
			$array_ledger[$ledger][dabba] = $array_challan[$challan_id][dabba] + $array_ledger[$ledger][dabba];
				$array_ledger[$ledger][expenses] = $array_challan[$challan_id][expenses] + $array_ledger[$ledger][expenses];
					$array_ledger[$ledger][gross] = $array_challan[$challan_id][gross] + $array_ledger[$ledger][gross];
						$array_ledger[$ledger][net] = $array_challan[$challan_id][net] + $array_ledger[$ledger][net];
		
	}
		$ledger_id = $ro['ledger_id'];
	
}
*/
/*
echo "<table style = 'width:100%;border-collapse:collapse;'>";
echo "<th>Name</th><th>P</th><th>H</th><th>Gross</th><th>Expenses</th><th>Net</th>";
$$array_sum = array();
foreach($array_ledger as $new=>$product)
{
	echo "<tr><td style = 'text-align:left'>".$product[ledger_name]."</td><td style = 'text-align:right;'>".$product[peti]."</td><td style = 'text-align:right;'>".$product[dabba]."</td><td style = 'text-align:right;'>".sprintf("%.2f",$product[gross])."</td><td style = 'text-align:right;'>".sprintf("%.2f",$product[expenses])."</td><td style = 'text-align:right;'>".sprintf("%.2f",$product[net])."</td></tr>";
	$array_sum[0] = $array_sum[0] + $product[peti];
	$array_sum[1] = $array_sum[1] + $product[dabba];
	$array_sum[2] = $array_sum[2] + $product[gross];
	$array_sum[3] = $array_sum[3] + $product[expenses];
	$array_sum[4] = $array_sum[4] + $product[net];
	
//	echo $product[3]."<br>";
//	print_r($product);
	$array_product = $product;
}
*/
echo "<tr style = 'font-weight:bold;color:blue;border:2px solid blue;'><td></td><td style = 'text-align:right;'>".$array_sum[0]."</td><td style = 'text-align:right;'>".$array_sum[1]."</td><td style = 'text-align:right;'>".sprintf("%.2f",$array_sum[2])."</td><td style = 'text-align:right;'>".sprintf("%.2f",$array_sum[3])."</td><td style = 'text-align:right;'>".sprintf("%.2f",$array_sum[4])."</td></tr>";
echo "</table>";
//echo $array_product[dabba];
//print_r($array_product);

//print_r($array_challan);
?>
		
	

</div>
