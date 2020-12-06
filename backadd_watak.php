<?php
include 'con.php';
$marka = $_GET["marka"];
$peti = $_GET["peti"];
$dabba = $_GET["dabba"];
$kind = $_GET["kind"];
$gross = $_GET["gross"];
$expenses = $_GET["expenses"];
$net = $_GET["net"];
$tran_id = $_GET["tran_id"];
//echo "reponse text"; 
//echo $marka." ".$peti." ".$dabba." ".$kind." ".$gross." ".$expenses." ".$net." ".$tran_id;
$query_date = mysqli_query($con,"select date from daybook where transaction_id = $tran_id and transaction_type = 11");
while($rd = mysqli_fetch_array($query_date))
{
	$enter_date = $rd['date'];
}
$query = mysqli_query($con,"insert into challan_detail(date,marka,peti,dabba,kind,gross,expenses,net,challan_id) values('$enter_date','$marka','$peti','$dabba','$kind','$gross','$expenses','$net','$tran_id')");
if($query)
{
	echo "successful";
}
else
echo "unsuccessful please try again";
//echo mysqli_error($query);
?>
