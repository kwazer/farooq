<?php
session_start();
error_reporting(E_ERROR);
include 'con.php';
$date_search = $_REQUEST["date"];
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];
$year = $_REQUEST["year"];

if($_REQUEST["year"] ==  undefined)
{
$select_year = mysqli_query($con,"select distinct year(date) from baardana_detail order by year(date) desc limit 1");
while($row_year = mysqli_fetch_array($select_year))
{
$year = $row_year['year(date)'];
}
}


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
	
</style>
<script>

//function del()
//{
//	location.href = 'deleteitem.php?item_id='+item_id;
//}

</script>
<div id = "main-window" style = "width:780px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<h3 style = 'color:brown;'>> Baardana Statement</h3>
<table style = "width:100%;border-collapse:collapse;">
<?php
echo "<h2 style = 'text-align:center;'>";
echo "<select style = 'background:white;font-size:19px;' onchange = \"transaction_types($sno,'$ledger_type',this.value)\">";

$query_sel = mysqli_query($con,"select distinct year(date) from baardana_detail order by year(date) desc");
//echo "<select onchange = \"transaction_types($sno,'$ledger_type',this.value)\">";

while($row_year = mysqli_fetch_array($query_sel))
{
if($row_year['year(date)'] == $year)
echo "<option selected value = '".$row_year['year(date)']."'>".$row_year['year(date)']."</option>";
else
echo "<option value = '".$row_year['year(date)']."'>".$row_year['year(date)']."</option>";
}
echo "</select>";
echo "</h2>";
?>
<th>Year</th><th style = 'text-align:left;'>Item Name</th><th style = 'text-align:right;'>Qty</th><th style = 'text-align:left;'></th>
<?php
$query = mysqli_query($con,"select sum(qty),year(date),name,unit from baardana_detail join items on items.item_id = baardana_detail.uid where year(date) = '$year' group by uid,year(date) order by year(date)");
while($row = mysqli_fetch_array($query))
{
	echo "<tr><td>".$row['year(date)']."</td><td style = 'text-align:left;'>".$row['name']."</td><td style = 'text-align:right;'>".$row['sum(qty)']."</td><td style = 'text-align:left;'>".$row['unit']."</td></tr>";
}
?>
		
	

</div>
